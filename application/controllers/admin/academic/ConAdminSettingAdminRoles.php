<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConAdminSettingAdminRoles extends CI_Controller {
var  $title = "แผงควบคุม";
	public function __construct() {
        parent::__construct();
        $this->load->model('admin/ModAdminRegisterSubject');
		
		if (empty($this->session->userdata('fullname'))) {		
			redirect('LoginAdmin','refresh');
		}

    }

    public function AcademicSettingAdminRoles(){      
        $data['title'] = "บทบาทในวิชาการ";	
        $DBpersonnel = $this->load->database('personnel', TRUE); //ฐานข้อมูลบุคลากร
        $DBaffairs = $this->load->database('affairs', TRUE); //ฐานข้อมูลงานกิจการนักเรียน
        $data['Manager'] = $this->db->select('admin_rloes_userid,admin_rloes_id,admin_rloes_nanetype')->get('tb_admin_rloes')->result();
        //echo '<pre>'; print_r($data['Manager']); exit();
        $data['NameTeacher'] = $DBpersonnel->select('pers_id,pers_prefix,pers_firstname,pers_lastname,pers_position,pers_learning')
         ->from('tb_personnel')
         ->order_by('pers_learning')
         ->get()->result();
        
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminSettingAdminRoles/AdminSettingAdminRolesMain.php');
        $this->load->view('admin/layout/Footer.php');

    }

  
    public function AcademicSettingManager() {      
 
        $data = array('admin_rloes_userid' => $this->input->post('TeachID'));
        $result = $this->db->update('tb_admin_rloes',$data,'admin_rloes_id=1');
        echo $result;
    }

    public function AcademicSettingDeputy() {      
 
        $data = array('admin_rloes_userid' => $this->input->post('TeachID'));
        $result = $this->db->update('tb_admin_rloes',$data,'admin_rloes_id=2');
        echo $result;
    }

    public function AcademicSettingLeader() {      
 
        $data = array('admin_rloes_userid' => $this->input->post('TeachID'));
        $result = $this->db->update('tb_admin_rloes',$data,'admin_rloes_id=3');
        echo $result;
    }

    public function AcademicSettingAdmin() {      
 
        $data = array('admin_rloes_userid' => $this->input->post('TeachID'));
        $result = $this->db->update('tb_admin_rloes',$data,'admin_rloes_id="'.$this->input->post('AdminID').'"');
        echo $result;
    }




}


?>
