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

    public function AdminEnrollSelect(){

        $subject = $this->db->select('StudentID,StudentNumber,StudentCode,StudentPrefix,StudentFirstName,StudentLastName')
                            ->where('StudentClass','ม.'.$this->input->post('KeyRoom'))
                            ->where('StudentStatus','1/ปกติ')
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

    

}


?>
