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
                                    tb_students.StudentLastName,
                                    tb_students.StudentStatus")
                            ->where('StudentStatus','1/ปกติ')
                            ->where('StudentClass',$keyroom)                            
                            ->order_by('tb_students.StudentNumber','ASC')
                            ->get('tb_students')->result();
       
        $data['subject'] = $this->db->select("
                                        tb_students.StudentID,
                                        tb_students.StudentClass,
                                        tb_students.StudentNumber,
                                        tb_register.Score100,
                                        tb_register.Grade,
                                        tb_register.SubjectCode,
                                        tb_register.StudyTime,
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
                                        tb_students.StudentClass,
                                        tb_students.StudentStatus,
                                        tb_register.Score100,
                                        tb_register.Grade,
                                        tb_register.StudyTime,                                       
                                        tb_register.SubjectCode,
                                        tb_subjects.SubjectName")
                                ->from('tb_register')
                                ->join('tb_students','tb_students.StudentID = tb_register.StudentID')
                                ->join('tb_subjects','tb_subjects.SubjectCode = tb_register.SubjectCode')
                                ->where('RegisterYear','1/2565')
                                ->where('StudentStatus','1/ปกติ')
                                ->where('StudentClass',$keyroom)
                                //->group_by('tb_register.SubjectCode')                                
                                ->get()->result();

        }
        

        //echo '<pre>'; print_r($data['check']); exit();
        $data['title'] = "รายงานผลการเรียนรายห้องเรียน";

        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminReportResults/AdminReportRoomMain.php');
        $this->load->view('admin/layout/Footer.php');
        
    }
    
    

}


?>
