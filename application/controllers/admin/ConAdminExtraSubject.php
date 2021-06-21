<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConAdminExtraSubject extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('admin/ModAdminExtraSubject');
		if ($this->session->userdata('fullname') == '' && $this->session->userdata('status') == "user") {		
			redirect('Login','refresh');
		}

    }

    public function index(){   

        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['admin'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        
		$data['title'] = "วิชาเพิ่มเติม";
        $data['ExtraSubject'] = $this->db->get('tb_extra_subject')->result();
        
        
        $data['NameTeacher'] = $DBpersonnel->select('pers_id,pers_prefix,pers_firstname,pers_lastname,pers_position,pers_learning')
        ->from('tb_personnel')
        ->where('pers_position !=','posi_001')
        ->where('pers_position !=','posi_002')
        ->where('pers_position !=','posi_007')
        ->where('pers_position !=','posi_008')
        ->where('pers_position !=','posi_009')
        ->where('pers_position !=','posi_010')
        ->order_by('pers_learning')
        ->get()->result();

        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/AdminExtraSubject/AdminExtraSubjectMain.php');
        $this->load->view('admin/layout/Footer.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }
    
    public function AddExtraSubject(){   
        //print_r(implode("|",$this->input->post('extra_grade_level'))); exit();
        $dataExtraSubject = array('extra_year'=>$this->input->post('extra_year'),
                                'extra_term'=>$this->input->post('extra_term'),
                                'extra_course_code'=>$this->input->post('extra_course_code'),
                                'extra_course_name'=>$this->input->post('extra_course_name'),
                                'extra_course_teacher'=>$this->input->post('extra_course_teacher'),
                                'extra_grade_level'=>implode("|",$this->input->post('extra_grade_level')),
                                'extra_number_students'=>$this->input->post('extra_number_students'),
                                'extra_comment'=>$this->input->post('extra_comment')
                            );
        print_r($this->ModAdminExtraSubject->ExtraSubject_Add($dataExtraSubject));
    }

    public function EditExtraSubject(){         
        $re = $this->db->where('extra_id', $this->input->post('Extraid'))->get('tb_extra_subject')->result();
        echo json_encode($re);
    }

    public function UpdateExtraSubject(){ 
             
        $dataExtraSubject = array('extra_year'=>$this->input->post('extra_year'),
                                'extra_term'=>$this->input->post('extra_term'),
                                'extra_course_code'=>$this->input->post('extra_course_code'),
                                'extra_course_name'=>$this->input->post('extra_course_name'),
                                'extra_course_teacher'=>$this->input->post('extra_course_teacher'),
                                'extra_grade_level'=>implode("|",$this->input->post('extra_grade_level')),
                                'extra_number_students'=>$this->input->post('extra_number_students'),
                                'extra_comment'=>$this->input->post('extra_comment')
                            );
        print_r($this->ModAdminExtraSubject->ExtraSubject_Update($dataExtraSubject,$this->input->post('extra_id')));
    }

}


?>
