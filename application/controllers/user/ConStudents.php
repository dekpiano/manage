<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConStudents extends CI_Controller {
var  $title = "แผงควบคุม";

	public function __construct() {
		parent::__construct();

        $this->DBSKJ = $this->load->database('skj', TRUE);
    }


    public function index(){ 
        $data['title'] = "หน้าแรก";
        $data['description'] = "หน้าหลัก";     
        $data['full_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $data['CheckOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $this->load->view('user/layout/HeaderUser.php',$data);
        $this->load->view('user/Students/PageStudentsHome.php');
        $this->load->view('user/layout/FooterUser.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }

    public function Home(){      
        
        $data['CheckOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $this->load->view('user/layout/Header.php',$data);
        $this->load->view('user/Students/PageStudentsHome.php');
        $this->load->view('user/layout/FooterUser.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }

    public function StudentsList(){  
        $data['title'] = "รายชื่อนักเรียนและที่ปรึกษา";
        $data['description'] = "ตรวจสอบรายชื่อนักเรียนและครูที่ปรึกษา";
        $data['full_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        
        $data['selStudent'] = $this->db->select('StudentNumber,StudentCode,StudentPrefix,StudentFirstName,StudentLastName')->from('tb_students')->where('StudentClass','ม.4/1')->get()->result();
        
        $this->load->view('user/layout/HeaderUser.php',$data);
        $this->load->view('user/PageStudentsList.php');
        $this->load->view('user/layout/FooterUser.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }
    
    public function ExamSchedule(){
        $data['title'] = "ตารางสอบ";
        $data['description'] = "ตารางสอบ";  
        $data['full_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $data['Exam'] = $this->db->order_by('exam_id','DESC')->limit(6)->get('tb_exam_schedule')->result();
        $this->load->view('user/layout/HeaderUser.php',$data);
        $this->load->view('user/PageExamSchedule.php');
        $this->load->view('user/layout/FooterUser.php');
    }

    public function ClassSchedule(){
        $data['title'] = "ตารางเรียน";
        $data['description'] = "ตารางเรียน";  
        $data['full_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $data['schedule'] = $this->db->order_by('schestu_id','DESC')->get('tb_class_schedule')->result();
        $this->load->view('user/layout/HeaderUser.php',$data);
        $this->load->view('user/PageClassSchedule.php');
        $this->load->view('user/layout/FooterUser.php');
    }

    public function SearchClassSchedule(){

       $key_studentList = $this->input->get('studentList');
       $data['schedule'] = $this->db->where('schestu_classname', $key_studentList)->get('tb_class_schedule')->result();
      //echo '<pre>'; print_r( $data['schedule'] ); exit();
        $data['title'] = "ตารางเรียน";
        $data['description'] = "ตารางเรียน";  
        $data['full_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $this->load->view('user/layout/HeaderUser.php',$data);
        $this->load->view('user/PageClassSchedule.php');
        $this->load->view('user/layout/FooterUser.php');
    }

    public function LearningOnline(){

        $data['lear'] =	$this->DBSKJ->get('tb_learning')->result(); //กลุ่มสาระ
         $data['title'] = "ห้องเรียนออนไลน์";
         $data['description'] = "ห้องเรียนออนไลน์";  
         $data['full_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
         $this->load->view('user/layout/HeaderUser.php',$data);
         $this->load->view('user/PageLearningOnline.php');
         $this->load->view('user/layout/FooterUser.php');
     }


     public function PageReportLearnOnline(){ 
        $data['lear'] =	$this->DBSKJ->get('tb_learning')->result(); //กลุ่มสาระ
        $data['title'] = "แบบรายงานการเรียนการสอนออนไลน์";
        $data['description'] = "แบบรายงานการเรียนการสอนออนไลน์";  
        $data['full_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $this->load->view('user/layout/HeaderUser.php',$data);
        $this->load->view('user/PageReportLearnOnline.php');
        $this->load->view('user/layout/FooterUser.php');
     }



    

}


?>
