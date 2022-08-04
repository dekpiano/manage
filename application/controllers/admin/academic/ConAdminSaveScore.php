<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConAdminSaveScore extends CI_Controller {
var  $title = "แผงควบคุม";
	public function __construct() {
        parent::__construct();
        $this->load->model('admin/ModAdminSaveScore');
		
		if (empty($this->session->userdata('fullname'))) {		
			redirect('LoginAdmin','refresh');
		}

    }

    public function AdminSaveScoreMain(){   
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['admin'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        
        $data['title'] = "บันทึกผลการเรียน";	
        $data['OnOffSaveScore'] = $this->db->where('onoff_id >= 2')->where('onoff_id <= 5')->get('tb_register_onoff')->result();
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminSaveScore/AdminSaveScoreMain.php');
        $this->load->view('admin/layout/Footer.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }
    
    public function CheckOnOffSaveScore(){   

        if($this->input->post('check') == "true"){
			$value = "on";
		}elseif($this->input->post('check') == "false"){
			$value = "off";
		}

        echo  $this->ModAdminSaveScore->UpdateOnOffSaveScore($this->input->post('key'),$value);
        

    }

    

}


?>
