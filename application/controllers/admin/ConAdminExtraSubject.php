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
		$this->db->select('*');
        $this->db->from('tb_regclass');
        $this->db->join($DBpersonnel->database.'.tb_personnel','tb_personnel.pers_id = tb_regclass.class_teacher');
		$this->db->order_by('Reg_Class','ASC');
        $data['ExtraSubject'] = $this->db->get()->result();
        
        
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
        $dataExtraSubject = array('Reg_Year'=>$this->input->post('year'),
                                'Reg_Class'=>$this->input->post('ExtraSubject'),
                                'class_teacher'=>$this->input->post('teacher'));
        print_r($this->ModAdminExtraSubject->ExtraSubject_Add($dataExtraSubject));
    }

}


?>
