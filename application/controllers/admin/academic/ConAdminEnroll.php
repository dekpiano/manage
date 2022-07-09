<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConAdminEnroll extends CI_Controller {
var  $title = "แผงควบคุม";
	public function __construct() {
        parent::__construct();
        $this->load->model('admin/ModAdminAcademinResult');
		
		if (empty($this->session->userdata('fullname'))) {		
			redirect('LoginAdmin','refresh');
		}
        $this->DBPers = $this->load->database('personnel', TRUE);
    }

    public function AdminEnrollMain(){   
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['admin'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        
        $data['title'] = "หน้าหลัก | ลงทะเบียนเรียน";	
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminEnroll/AdminEnrollMain.php');
        $this->load->view('admin/layout/Footer.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }

    public function AdminEnrollAdd(){
        $data['title'] = "เพิ่มการลงทะเบียนเรียน";
        $DBpersonnel = $this->load->database('personnel', TRUE);
        $data['teacher'] = $DBpersonnel->select('pers_id,pers_img,pers_prefix,pers_firstname,pers_lastname')
                                        ->where('pers_learning !=',"")
                                        ->get('tb_personnel')->result();
        $data['subject'] = $this->db->where('SubjectYear','1/2565')->get('tb_subjects')->result();

        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminEnroll/AdminEnrollFormAdd.php');
        $this->load->view('admin/layout/Footer.php');
    }

    public function AdminEnrollEdit($codeSub,$TeachID){
        $data['title'] = "แก้ไขการลงทะเบียนเรียน";
        $DBpersonnel = $this->load->database('personnel', TRUE);
        $data['teacher'] = $DBpersonnel->select('pers_id,pers_img,pers_prefix,pers_firstname,pers_lastname')
                                        ->where('pers_learning !=',"")
                                        ->get('tb_personnel')->result();

        $data['Register'] = $this->db->select("tb_register.RegisterYear,
                                    tb_subjects.SubjectName,
                                    tb_register.SubjectCode,
                                    tb_register.StudentID,
                                    tb_register.TeacherID,
                                    tb_students.StudentCode,
                                    tb_students.StudentNumber,
                                    tb_students.StudentPrefix,
                                    tb_students.StudentFirstName,
                                    tb_students.StudentLastName,
                                    tb_students.StudentClass                                    
                                    ")
                                    ->from('tb_register')
                                    ->join('tb_subjects', 'tb_subjects.SubjectCode = tb_register.SubjectCode')
                                    ->join('tb_students', 'tb_students.StudentID = tb_register.StudentID')
                                    ->where('RegisterYear','1/2565') 
                                    ->where('TeacherID',$TeachID)
                                    ->where('SubjectID',$codeSub)
                                    ->order_by('StudentNumber')
                                    ->get()->result();

        //echo '<pre>'; print_r($Register);

        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminEnroll/AdminEnrollFormEdit.php');
        $this->load->view('admin/layout/Footer.php');
    }

    public function AdminEnrollSelect(){

        $subject = $this->db->select('StudentID,StudentNumber,StudentCode,StudentPrefix,StudentFirstName,StudentLastName,StudentClass')
                            ->where('StudentClass','ม.'.$this->input->post('KeyRoom'))
                            ->where('StudentStatus','1/ปกติ')
                            ->order_by('StudentNumber')
                            ->get('tb_students')->result();
       
        echo json_encode($subject);

    }

    public function AdminEnrollInsert(){

       $chk_Subject = $this->db->where('SubjectID',$this->input->post('subjectregis'))->get('tb_subjects')->result();
       print_r($chk_Subject[0]->SubjectCode);
       print_r($chk_Subject[0]->SubjectYear);
       print_r($chk_Subject[0]->SubjectClass);
       print_r($this->input->post('teacherregis'));
       print_r($this->input->post('to'));

        
       foreach ($this->input->post('to') as $key => $value) {
        $a =  array('StudentID' => $value,
        'SubjectCode' => $chk_Subject[0]->SubjectCode,
        'RegisterYear' => $chk_Subject[0]->SubjectYear,
        'RegisterClass' => $chk_Subject[0]->SubjectClass,
        'TeacherID' => $this->input->post('teacherregis')
        );   
        echo $data = $this->db->insert('tb_register',$a);

       }
     
    }

    public function AdminEnrollSubject(){ 
        $data = [];
        //$subject = $this->db->where('SubjectYear','1/2565')->get('tb_subjects')->result();
       
        $Register = $this->db->select("skjacth_academic.tb_register.RegisterYear,
                                    skjacth_academic.tb_register.SubjectCode,
                                    skjacth_academic.tb_subjects.SubjectName,
                                    skjacth_academic.tb_subjects.FirstGroup,
                                    skjacth_academic.tb_register.RegisterClass,
                                    skjacth_academic.tb_register.TeacherID,
                                    skjacth_academic.tb_subjects.SubjectID,
                                    skjacth_personnel.tb_personnel.pers_firstname,
                                    skjacth_personnel.tb_personnel.pers_prefix,
                                    skjacth_personnel.tb_personnel.pers_lastname")
                                ->from('tb_register')
                                ->join('tb_subjects', 'tb_subjects.SubjectCode = tb_register.SubjectCode')
                                ->join('skjacth_personnel.tb_personnel', 'skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_register.TeacherID')
                                ->where('RegisterYear','1/2565')
                                ->group_by('SubjectCode')
                                ->group_by('TeacherID')
                                ->group_by('RegisterClass')
                                ->get()->result();

        foreach($Register as $record){
            
            $data[] = array( 
                "SubjectYear" => $record->RegisterYear,
                "SubjectCode" => $record->SubjectCode,
                "SubjectName" => $record->SubjectName,
                "FirstGroup" => $record->FirstGroup,
                "SubjectClass" => $record->RegisterClass,
                "SubjectID" => $record->SubjectID,
                "TeacherName" =>  $record->pers_prefix.$record->pers_firstname.' '.$record->pers_lastname,
                "TeacherID" => $record->TeacherID
            );
           
        }   

        $output = array(
            "data" =>  $data
        );

       // echo '<pre>'; print_r($Register);              
      
       echo json_encode($output);
    }

    

}


?>
