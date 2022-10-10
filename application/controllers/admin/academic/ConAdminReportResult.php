<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConAdminReportResult extends CI_Controller {
var  $title = "แผงควบคุม";
	public function __construct() {
        parent::__construct();
        $this->load->model('admin/ModAdminSaveScore');
		
		if (empty($this->session->userdata('fullname'))) {		
			redirect('LoginAdmin','refresh');
		}

        $data['check_status'] = $this->db->where('admin_rloes_userid',$this->session->userdata('login_id'))->get('tb_admin_rloes')->row();
        if(@$data['check_status']->admin_rloes_status == "admin" || @$data['check_status']->admin_rloes_status == "manager"){
            
        }else{
            $this->session->set_flashdata(array('msg'=>'OK','messge'=> 'คุณไม่มีสิทธ์ในระบบจัดข้อมูลนี้ ติดต่อเจ้าหน้าที่คอม','alert'=>'error'));
            redirect('welcome','refresh');
        }

    }

    public function AdminReportPersonMain(){   
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['admin'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();

        $data['stu'] = $this->db->select("tb_students.StudentID,
                                    tb_students.StudentNumber,
                                    tb_students.StudentClass,
                                    tb_students.StudentCode,
                                    tb_students.StudentPrefix,
                                    tb_students.StudentFirstName,
                                    tb_students.StudentLastName,
                                    tb_students.StudentStatus")
                            ->where('StudentStatus','1/ปกติ')
                            ->get('tb_students')->result();
        //echo '<pre>'; print_r($stu); exit();
        $data['title'] = "รายงานผลการเรียนรายบุคคล";

        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminReportResults/AdminReportPersonMain.php');
        $this->load->view('admin/layout/Footer.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }

    public function AdminReportRoomMain(){   
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['admin'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        $keyroom = $this->input->post("keyroom");
        if(!isset($keyroom)){
            $data["Nodata"] = 0;
            $data['totip'] = "";
            $data['keyroom'] = '';
        }else{
            $data["Nodata"] = 1;
            $data['keyroom'] = $keyroom;
            $data['totip'] = "ระดับชั้น ".$keyroom;
            
            $data['stu'] = $this->db->select("tb_students.StudentID,
                                    tb_students.StudentNumber,
                                    tb_students.StudentClass,
                                    tb_students.StudentCode,
                                    tb_students.StudentPrefix,
                                    tb_students.StudentFirstName,
                                    tb_students.StudentLastName")
                            ->where('StudentStatus','1/ปกติ')
                            ->where('StudentClass',$keyroom)  
                            ->order_by('tb_students.StudentNumber','ASC')
                            ->get('tb_students')->result();
       
        $data['subject'] = $this->db->select("
                                        tb_register.SubjectCode,
                                        tb_subjects.SubjectName,
                                        tb_subjects.SubjectUnit")
                                ->from('tb_register')
                                ->join('tb_students','tb_students.StudentID = tb_register.StudentID')
                                ->join('tb_subjects','tb_subjects.SubjectCode = tb_register.SubjectCode')
                                ->where('RegisterYear','1/2565')
                                ->where('StudentStatus','1/ปกติ')
                                ->where('StudentClass',$keyroom)
                                ->group_by('tb_register.SubjectCode')                                
                                ->get()->result();

            $data['check'] = $this->db->select("
                                        tb_students.StudentID,
                                        tb_register.Grade,                                      
                                        tb_register.SubjectCode")
                                ->from('tb_register')
                                ->join('tb_students','tb_students.StudentID = tb_register.StudentID')
                                ->where('RegisterYear','1/2565')
                                ->where('StudentStatus','1/ปกติ')
                                ->where('StudentClass',$keyroom)                              
                                //->group_by('tb_register.SubjectCode')               
                                ->get()->result();

                                // $result=array_diff_key($data['stu'],$data['check']);
                                 //echo '<pre>';print_r($data['subject']);

                                // $firstNames = array_column($data['check'], 'Grade','StudentID');
                                // echo '<pre>';print_r($data['check']);

                               // exit();

        }
        

        $data['title'] = "รายงานผลการเรียนรายห้องเรียน";

        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminReportResults/AdminReportRoomMain.php');
        $this->load->view('admin/layout/Footer.php');
        
    }

    public function AdminStudentsScore($IdStudent){      
        $data['title'] = "ผลการเรียนนักเรียนรายบุคคล";
        $data['ExtraSetting'] = $this->db->get('tb_extra_setting')->result();
        $data['scoreYear'] = $this->db->select('
                                    tb_register.RegisterClass,
                                    tb_register.RegisterYear,
                                    tb_register.StudentID
                                    ')
                                    ->from('tb_register')
                                    ->where('StudentID',$IdStudent)
                                    ->group_by('tb_register.RegisterYear')
                                    ->order_by('tb_register.RegisterClass asc','tb_register.RegisterYear asc')
                                    ->get()->result();
         //echo '<pre>';print_r($data['scoreYear']); exit();
        $data['scoreStudent'] = $this->db->select('tb_register.StudentID,
                                        tb_register.SubjectCode,
                                        tb_register.Score100,
                                        tb_register.Grade,
                                        tb_register.RegisterYear,
                                        tb_register.RegisterClass,
                                        tb_subjects.SubjectName,
                                        tb_subjects.SubjectUnit,
                                        tb_subjects.SubjectYear,
                                        tb_subjects.SubjectType,
                                        tb_subjects.FirstGroup')
                                    ->from('tb_register')
                                    ->join('tb_subjects', 'tb_register.SubjectCode = tb_subjects.SubjectCode')
                                    ->where('StudentID',$IdStudent)
                                    ->order_by('tb_subjects.SubjectType asc')
                                    ->order_by('tb_subjects.FirstGroup asc','tb_subjects.SubjectCode asc')
                                    ->get()->result();
        $data['stu'] =  $this->db->select('
                            StudentClass,
                            StudentCode,
                            StudentPrefix,
                            StudentFirstName,
                            StudentLastName 
                            ')
                            ->where('StudentID',$IdStudent)->get('tb_students')->row();
        $data['CheckOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        //echo '<pre>'; print_r($this->session->userdata('login_id')); exit();
       
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminReportResults/AdminReportStudentsResult.php');
        $this->load->view('admin/layout/Footer.php');
        
        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }

    
    

}


?>
