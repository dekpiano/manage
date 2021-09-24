<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConStudentExtraSubject extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('student/ModStudentExtraSubject');
		if ($this->session->userdata('fullname') == '' || $this->session->userdata('status') == "admin") {
            
			redirect('Login','refresh');
		}

    }

    public function ExtraSubject(){  
        $data['title'] = "รายชื่อวิชาเลือกเพิ่มเติม";
        $data['ExtraSetting'] = $this->db->get('tb_extra_setting')->result();
        $data['Extra'] = $this->db->order_by('extra_key_room','ASC')->get('tb_extra_subject')->result();
        $data['ExtraGroupBy'] = $this->db->select('extra_key_room,extra_grade_level')->group_by('extra_key_room')->get('tb_extra_subject')->result();       
        $data['register'] = $this->db->select('tb_extra_register.*,
                                            tb_extra_subject.extra_key_room')
                                    ->from('tb_extra_subject')
                                    ->join('tb_extra_register','tb_extra_register.fk_extra_id = tb_extra_subject.extra_id','LEFT')
                                    ->where('fk_std_id',$this->session->userdata('StudentCode'))
                                    ->get()->result();
        $data['CountRegister'] = $this->db->select('fk_extra_id')->get('tb_extra_register')->result();                         
        //echo '<pre>';print_r($data['CountRegister']);exit();
        $data['ChooseOnly'] = count($data['register']);
        $data['student'] = $this->db->select("StudentCode,StudentClass")->where('StudentCode',$this->session->userdata('StudentCode'))->get('tb_student_express')->result();
        $this->load->view('student/layout/HeaderStudent.php',$data);
        $this->load->view('student/ExtraSubject/PageRegisterExtra.php');
        $this->load->view('student/layout/FooterStudent.php');
    }   
    
    public function ReadMe(){  
        $data['title'] = "อ่านก่อนข้อตกลง";        
        $data['Extra'] = $this->db->get('tb_extra_subject')->result();
        $data['ExtraSetting'] = $this->db->get('tb_extra_setting')->result();
        $this->load->view('student/layout/HeaderStudent.php',$data);
        $this->load->view('student/ExtraSubject/PageReadMe.php');
        $this->load->view('student/layout/FooterStudent.php');
    }   

    public function RegisterExtra(){  
        $data = array(
            'regis_ex_datecreated' => date('Y-m-d H:i:s'), 
            'regis_ex_active' => '',
            'fk_extra_id' => $this->input->post('ExtraID'),
            'fk_std_id' => $this->session->userdata('StudentCode'),
        );
        echo $this->ModStudentExtraSubject->ExtraSubject_Add($data);
    }   

    public function CheckRegister(){  
        $data['title'] = "ตรวจสอบสถานะการลงทะเบียน";
        $data['ExtraSetting'] = $this->db->get('tb_extra_setting')->result();
        $data['CheckRegister'] = $this->db->select('tb_extra_subject.extra_year,
                                                    tb_extra_subject.extra_term,
                                                    tb_extra_subject.extra_course_name,
                                                    tb_extra_subject.extra_course_code,
                                                    tb_extra_subject.extra_course_teacher,
                                                    tb_extra_register.fk_std_id,
                                                    tb_extra_register.fk_extra_id,
                                                    tb_extra_register.regis_ex_id,
                                                    tb_extra_register.regis_ex_datecreated,
                                                    tb_student_express.StudentPrefix,
                                                    tb_student_express.StudentFirstName,
                                                    tb_student_express.StudentLastName,
                                                    tb_student_express.StudentNumber,
                                                    tb_student_express.StudentClass')
                                        ->from('tb_extra_register') 
                                        ->join('tb_extra_subject','tb_extra_subject.extra_id = tb_extra_register.fk_extra_id')   
                                        ->join('tb_student_express','tb_student_express.StudentCode = tb_extra_register.fk_std_id')   
                                        ->where('fk_std_id',$this->session->userdata('StudentCode'))                                
                                         ->get()->result();

        $this->load->view('student/layout/HeaderStudent.php',$data);
        $this->load->view('student/ExtraSubject/PageCheckRegister.php');
        $this->load->view('student/layout/FooterStudent.php');
    }


    public function CheckStudentRegisterSubject(){  
      
       $result = $this->db->select('tb_extra_register.*,
                                    tb_student_express.StudentPrefix,
                                    tb_student_express.StudentFirstName,
                                    tb_student_express.StudentLastName,
                                    tb_student_express.StudentClass')
                            ->from('tb_extra_register')
                            ->join('tb_student_express','tb_student_express.StudentCode = tb_extra_register.fk_std_id')
                            ->where('fk_extra_id',$this->input->post('ExtraId'))->get()->result();
       echo json_encode($result);
    }

   


}


?>