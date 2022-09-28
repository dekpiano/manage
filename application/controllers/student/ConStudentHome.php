<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConStudentHome extends CI_Controller {
var  $title = "ผลการเรียน";
	public function __construct() {
		parent::__construct();
		
		if ($this->session->userdata('fullname') == '' || $this->session->userdata('status') == "admin") {
            
			redirect('Login','refresh');
		}

    }

    public function Home(){
        $data['title'] = "หน้าแรก";
        $data['ExtraSetting'] = $this->db->get('tb_extra_setting')->result();
        $this->load->view('student/layout/HeaderStudent.php',$data);
        $this->load->view('student/PageStudentHome.php');
        $this->load->view('student/layout/FooterStudent.php');
    }

    public function score(){      
        $data['title'] = "ผลการเรียน";
        $data['ExtraSetting'] = $this->db->get('tb_extra_setting')->result();
        $data['scoreYear'] = $this->db->select('
                                    tb_register.RegisterClass,
                                    tb_register.RegisterYear,
                                    tb_register.StudentID
                                    ')
                                    ->from('tb_register')
                                    ->where('StudentID',$this->session->userdata('login_id'))
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
                                    ->where('StudentID',$this->session->userdata('login_id'))
                                    ->order_by('tb_subjects.SubjectType asc')
                                    ->order_by('tb_subjects.FirstGroup asc','tb_subjects.SubjectCode asc')
                                    ->get()->result();
      
        $data['CheckOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        //echo '<pre>'; print_r($this->session->userdata('login_id')); exit();

        $this->load->view('student/layout/HeaderStudent.php',$data);
        $this->load->view('student/PageAcademicResult.php');
        $this->load->view('student/layout/FooterStudent.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }



}


?>