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
        $data['banner'] = base_url('uploads/banner/StudentList/bannerStu.png');
        $data['schoolyear'] = $this->db->get('tb_schoolyear')->row();

        $data['SelectSubject'] = $this->db->select('SubjectCode,SubjectName')
        ->where('SubjectYear',$data['schoolyear']->schyear_year)
        ->order_by('FirstGroup','ASC')
        ->get('tb_subjects')->result();

        
       
        $subYear = explode('/',$data['schoolyear']->schyear_year);
        $data['TeacRoom'] = $this->db->select('
        skjacth_personnel.tb_personnel.pers_prefix,
        skjacth_personnel.tb_personnel.pers_firstname,
        skjacth_personnel.tb_personnel.pers_lastname,
        skjacth_academic.tb_regclass.Reg_Class
        ')
        ->from('skjacth_academic.tb_regclass')
        ->join('skjacth_personnel.tb_personnel','skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_regclass.class_teacher')
        ->where('Reg_Year',$subYear[1])
        ->where('Reg_Class',@$_GET['studentList'])
        ->get()->result();

        $data['checkLine'] = $this->db->select('StudentClass,StudentStudyLine')
        ->where('StudentClass','ม.'.@$_GET['studentList'])
        ->group_by('StudentStudyLine')
        ->get('tb_students')->result();
        $data['selStudent'] = $this->db->select('StudentNumber,StudentCode,StudentPrefix,StudentFirstName,StudentLastName,StudentStudyLine,StudentBehavior')
        ->from('tb_students')
        ->where('StudentStatus','1/ปกติ')  
        ->where('StudentBehavior !=','จำหน่่าย')      
        ->where('StudentClass','ม.'.@$_GET['studentList'])
        ->order_by('StudentNumber','ASC')
        ->get()->result();
                
        $this->load->view('user/layout/HeaderUser.php',$data);
        $this->load->view('user/PageStudentsList.php');
        $this->load->view('user/layout/FooterUser.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }

    public function StudentsPrintRoom($Class,$Room,$StudyLine = 0){
        
        $path = (dirname(dirname(dirname(dirname(dirname(__FILE__))))));
		require $path . '/librarie_skj/mpdf/vendor/autoload.php';

        $live_mpdf = new \Mpdf\Mpdf(
            array(
                'format' => 'A4',
                'mode' => 'utf-8',
                'default_font' => 'thsarabun',
                'default_font_size' => 12,
                'margin_top' => 5,
	            'margin_left' => 5,
	            'margin_right' => 5,
	            'mirrorMargins' => 0
            )
        );

        $data['schoolyear'] = $this->db->get('tb_schoolyear')->row();
        $subYear = explode('/',$data['schoolyear']->schyear_year);

        

        $NameRoom = 'ม.'.$Class.'/'.$Room;
        $data['SubRoom'] = explode('.',$NameRoom);
        $data['TeacRoom'] = $this->db->select('
        skjacth_personnel.tb_personnel.pers_prefix,
        skjacth_personnel.tb_personnel.pers_firstname,
        skjacth_personnel.tb_personnel.pers_lastname,
        skjacth_academic.tb_regclass.Reg_Class
        ')
        ->from('skjacth_academic.tb_regclass')
        ->join('skjacth_personnel.tb_personnel','skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_regclass.class_teacher')
        ->where('Reg_Year',$subYear[1])
        ->where('Reg_Class',$data['SubRoom'][1])
        ->get()->result();

        //echo '<pre>'; print_r($data['TeacRoom']); exit();

        $data['checkLine'] = $this->db->select('StudentStudyLine')
        ->where('StudentClass',$NameRoom)
        ->group_by('StudentStudyLine')
        ->get('tb_students')->result();

        if($StudyLine == "All"){
            $data['selStudent'] = $this->db->select('StudentNumber,StudentCode,StudentPrefix,StudentFirstName,StudentLastName,StudentStudyLine,StudentBehavior')
            ->from('tb_students')
            ->where('StudentStatus','1/ปกติ')  
            ->where('StudentBehavior !=','จำหน่่าย')      
            ->where('StudentClass',$NameRoom)
            ->order_by('StudentNumber','ASC')
            ->get()->result();
        }else{
            $data['selStudent'] = $this->db->select('StudentNumber,StudentCode,StudentPrefix,StudentFirstName,StudentLastName,StudentStudyLine,StudentBehavior')
            ->from('tb_students')
            ->where('StudentStatus','1/ปกติ')  
            ->where('StudentBehavior !=','จำหน่่าย')      
            ->where('StudentClass',$NameRoom)
            ->where('StudentStudyLine',$StudyLine)
            ->order_by('StudentNumber','ASC')
            ->get()->result();
        }

        // true
        $ReportFront = $this->load->view('user/PageStudentsListPrint',$data,true);        
        $live_mpdf->WriteHTML($ReportFront);
        $live_mpdf->Output('filename.pdf', \Mpdf\Output\Destination::INLINE); 
    }
    
    public function ExamSchedule(){
        $data['title'] = "ตารางสอบ";
        $data['description'] = "ตารางสอบ";  
        $data['full_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $data['banner'] = base_url('assets/images/ExamSchedule/banner.jpg');

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