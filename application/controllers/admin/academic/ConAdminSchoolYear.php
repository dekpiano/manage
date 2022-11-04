<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConAdminSchoolYear extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('admin/ModAdminClassRoom');
		if (empty($this->session->userdata('fullname'))) {		
			redirect('LoginAdmin','refresh');
		}

        $this->load->library('Classroom');

        $data['check_status'] = $this->db->where('admin_rloes_userid',$this->session->userdata('login_id'))->get('tb_admin_rloes')->row();
        if(@$data['check_status']->admin_rloes_status == "admin" || @$data['check_status']->admin_rloes_status == "manager"){
            
        }else{
            $this->session->set_flashdata(array('msg'=>'OK','messge'=> 'คุณไม่มีสิทธ์ในระบบจัดข้อมูลนี้ ติดต่อเจ้าหน้าที่คอม','alert'=>'error'));
            redirect('welcome','refresh');
        }

    }

    public function SchoolYear(){           
        //echo $data; exit();
        $result = $this->db->update('tb_schoolyear',array('schyear_year' => $this->input->post('schyear_year')),'schyear_id=1');
        print_r($result);
    }

}


?>
