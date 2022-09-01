<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConAdminAcademinResult extends CI_Controller {
var  $title = "แผงควบคุม";
	public function __construct() {
        parent::__construct();
        $this->load->model('admin/ModAdminAcademinResult');
		
		if (empty($this->session->userdata('fullname'))) {		
			redirect('LoginAdmin','refresh');
		}

        $data['check_status'] = $this->db->where('admin_rloes_userid',$this->session->userdata('login_id'))->get('tb_admin_rloes')->row();
        if(@$data['check_status']->admin_rloes_status == "admin" || @$data['check_status']->admin_rloes_status == "manager"){
            
        }else{
            $this->session->set_flashdata(array('msg'=>'OK','messge'=> 'คุณไม่มีสิทธ์ในระบบจัดข้อมูลนี้ ติดต่อเจ้าหน้าที่คอม','alert'=>'error'));
            redirect('welcome','refresh');
        }

    }

    public function AdminAcademinResultMain(){   
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['admin'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        
        $data['title'] = "ผลการเรียน";	
        $data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminAcademicResult/AdminAcademicResultMain.php');
        $this->load->view('admin/layout/Footer.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }
    
    public function CheckOnOff(){   
        echo $this->ModAdminAcademinResult->UpdateOnOff($this->input->post('check'));

    }

    public function add(){   

		$data['title'] = "ตารางเรียน";
		$data['icon'] = '<i class="far fa-plus-square"></i>';
		$data['color'] = 'primary';
		
		$this->db->select('*');
		$this->db->from('tb_class_schedule');
		$this->db->order_by('schestu_id','DESC');
		$data['class_schedule'] = $this->db->get()->result();
		
		$num = @explode("_", $data['class_schedule'][0]->schestu_id);
        $num1 = @sprintf("%03d",$num[1]+1);
        $data['class_schedule'] = 'schestu_'.$num1;
        $data['action'] = 'insert_class_schedule';

        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminClassSchedule/AdminClassScheduleForm.php');
        $this->load->view('admin/layout/Footer.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }
    

}


?>
