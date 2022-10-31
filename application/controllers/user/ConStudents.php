<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConStudents extends CI_Controller {
var  $title = "แผงควบคุม";

	public function __construct() {
		parent::__construct();

        $this->DBSKJ = $this->load->database('skj', TRUE);
        $this->DBPERS = $this->load->database('personnel', TRUE);
    }


    public function index(){ 
        $data['title'] = "หน้าแรก";
        $data['description'] = "หน้าหลัก";     
        $data['full_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $data['banner'] = "";
        $data['CheckOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $this->load->view('user/layout/HeaderUser.php',$data);
        $this->load->view('user/Students/PageStudentsHome.php');
        $this->load->view('user/layout/FooterUser.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }

    public function Home(){      
        
        $data['title'] = "หน้าแรก";
        $data['description'] = "หน้าแรก";  
        $data['full_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $data['banner'] = "";
        
        $data['CheckOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $this->load->view('user/layout/Header.php',$data);
        $this->load->view('user/Students/PageStudentsHome.php');
        $this->load->view('user/layout/FooterUser.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }

    public function StudentsList(){  
        $data['title'] = "รายชื่อนักเรียนและครูที่ปรึกษา";
        $data['description'] = "ตรวจสอบรายชื่อนักเรียนและครูที่ปรึกษา";
        $data['full_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $data['banner'] = base_url('uploads/banner/StudentList/bannerStu.png');;

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
        $data['banner'] = "";

        $data['Exam'] = $this->db->order_by('exam_id','DESC')->limit(6)->get('tb_exam_schedule')->result();
        $this->load->view('user/layout/HeaderUser.php',$data);
        $this->load->view('user/PageExamSchedule.php');
        $this->load->view('user/layout/FooterUser.php');
    }

    public function ExamScheduleOnline(){
        $data['title'] = "ตารางสอบ Online";
        $data['description'] = "ตารางสอบ Online";  
        $data['full_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $data['banner'] = base_url("uploads/banner/ExamScheduleOnline/banner.png");

        $data['Exam'] = $this->db->order_by('exam_id','DESC')->limit(6)->get('tb_exam_schedule')->result();
        $this->load->view('user/layout/HeaderUser.php',$data);
        $this->load->view('user/PageExamScheduleOnline.php');
        $this->load->view('user/layout/FooterUser.php');
    }

    public function ClassSchedule(){
        $data['title'] = "ตารางเรียน";
        $data['description'] = "ตารางเรียน";  
        $data['full_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $data['banner'] = base_url("uploads/banner/class_schedule/banner.png");;
        
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
        $data['banner'] = "";

        $this->load->view('user/layout/HeaderUser.php',$data);
        $this->load->view('user/PageClassSchedule.php');
        $this->load->view('user/layout/FooterUser.php');
    }

    //-----ห้องเรียนออนไลน์ ------
    public function LearningOnline(){
        $data['lear'] =	$this->DBSKJ->get('tb_learning')->result(); //กลุ่มสาระ
         $data['title'] = "ห้องเรียนออนไลน์";
         $data['description'] = "ห้องเรียนออนไลน์";  
         $data['full_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";        
         $data['banner'] = base_url('uploads/banner/RoomOnline/bannerRoomOnline.png');
         
         $data['room'] = $this->db->select('skjacth_academic.tb_room_online.*,
                                            skjacth_personnel.tb_personnel.pers_prefix,
                                            skjacth_personnel.tb_personnel.pers_firstname,
                                            skjacth_personnel.tb_personnel.pers_lastname,
                                            skjacth_personnel.tb_personnel.pers_img')
                                            ->join('skjacth_personnel.tb_personnel','skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_room_online.roomon_teachid','LEFT')
                                ->where('roomon_classlevel',$this->input->get('s'))
                                ->from('tb_room_online')
                                ->get()->result();
        $data['keyroom'] = $this->input->get('s');
         $this->load->view('user/layout/HeaderUser.php',$data);
         $this->load->view('user/LearnOnline/PageLearnOnlineDetail.php');
         $this->load->view('user/layout/FooterUser.php');
     }

     public function LearningOnlineDetail($key){
        $data['lear'] =	$this->DBSKJ->get('tb_learning')->result(); //กลุ่มสาระ
         $data['title'] = "ห้องเรียนออนไลน์";
         $data['description'] = "ห้องเรียนออนไลน์";  
         $data['full_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
         $data['banner'] = base_url('uploads/banner/RoomOnline/bannerRoomOnline.png');

         $this->load->view('user/layout/HeaderUser.php',$data);
         $this->load->view('user/LearnOnline/PageLearnOnlineDetail.php');
         $this->load->view('user/layout/FooterUser.php');
     }


     public function PageReportLearnOnline(){ 
        $data['lear'] =	$this->DBSKJ->get('tb_learning')->result(); //กลุ่มสาระ
        $data['title'] = "แบบรายงานการเรียนการสอนออนไลน์";
        $data['description'] = "แบบรายงานการเรียนการสอนออนไลน์";  
        $data['full_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $data['banner'] = "";

        $this->load->view('user/layout/HeaderUser.php',$data);
        $this->load->view('user/PageReportLearnOnline.php');
        $this->load->view('user/layout/FooterUser.php');
     }



    

}


?>
