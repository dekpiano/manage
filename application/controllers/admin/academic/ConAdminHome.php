<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConAdminHome extends CI_Controller {
var  $title = "แผงควบคุม";
	public function __construct() {
		parent::__construct();
		
		if (empty($this->session->userdata('fullname'))) {		
			redirect('LoginAdmin','refresh');
		}

    }


    public function AdminHome(){      
        $data['title'] = "หน้าแรก";
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['admin'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/AdminHome.php');
        $this->load->view('admin/layout/Footer.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }



}


?>
