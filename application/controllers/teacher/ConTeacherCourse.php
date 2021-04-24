<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConTeacherCourse extends CI_Controller {
var  $title = "หน้าแรก";
	public function __construct() {
		parent::__construct();
		
		if ($this->session->userdata('fullname') == '' && $this->session->userdata('status') == "user") {      
			redirect('Login','refresh');
		}

    }


    public function Course(){      
        
        $this->load->view('teacher/layout/header_teacher.php');
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/course/plan/plan_main.php');
        $this->load->view('teacher/layout/footer_teacher.php');
        
    }

    public function send_plan(){
        $this->load->view('teacher/layout/header_teacher.php');
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/course/plan/plan_send.php');
        $this->load->view('teacher/layout/footer_teacher.php');
    }

    public function check_plan($id = null){
        $DBskj = $this->load->database('skj', TRUE); 
        $data['lean'] = $DBskj->get('tb_learning')->result();
        $data['ID'] = $id;
        //echo '<pre>'; print_r($lean); exit();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/course/plan/plan_check.php');
        $this->load->view('teacher/layout/footer_teacher.php');
    }



}


?>
