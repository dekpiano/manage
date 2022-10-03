<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConAdminGeneralPersonnel extends CI_Controller {
var  $title = "แผงควบคุม";
	public function __construct() {
		parent::__construct();
		
		if (empty($this->session->userdata('fullname'))) {		
			redirect('welcome','refresh');
		}

        $data['check_status'] = $this->db->where('admin_rloes_userid',$this->session->userdata('login_id'))->get('tb_admin_rloes')->row();
        if(@$data['check_status']->admin_rloes_status == "admin" || @$data['check_status']->admin_rloes_status == "manager"){
            
        }else{
            $this->session->set_flashdata(array('msg'=>'OK','messge'=> 'คุณไม่มีสิทธ์ในระบบจัดข้อมูลนี้ ติดต่อเจ้าหน้าที่คอม','alert'=>'error'));
            redirect('welcome','refresh');
        }

        $this->DBSKJ = $this->load->database('skj', TRUE);
        $this->DBPers = $this->load->database('personnel', TRUE);
    }


    public function PageAdminGeneralMain(){      
        $data['title'] = "หน้าแรกบุคคลกร";
        $data['admin'] = $this->DBPers->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
       
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/General/PageAdminGeneralMain.php');
        $this->load->view('admin/layout/Footer.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();        
    }

    public function ShowDataPersonnel(){
        $data = [];
       
        $personnel = $this->DBPers->select("tb_personnel.pers_id, 
		tb_personnel.pers_prefix, 
		tb_personnel.pers_firstname, 
		tb_personnel.pers_lastname, 
		tb_personnel.pers_position, 
		tb_personnel.pers_learning, 
		tb_position.posi_name, 
		tb_personnel.pers_username, 
		tb_personnel.pers_phone, 
		tb_learning.lear_namethai,
		tb_personnel.pers_academic,
		tb_personnel.pers_img,
		tb_personnel.pers_numberGroup,
        tb_personnel.pers_status")
        ->from('tb_personnel')
        ->join($this->DBSKJ->database.'.tb_position','tb_personnel.pers_position = tb_position.posi_id','LEFT')
		->join($this->DBSKJ->database.'.tb_learning','tb_personnel.pers_learning = tb_learning.lear_id','LEFT')
        ->get()->result();

        foreach($personnel as $record){
            
            $data[] = array( 
                "TeacherName" =>  $record->pers_prefix.$record->pers_firstname.' '.$record->pers_lastname,
                "TeacherID" => $record->pers_id,
                "pers_position" => $record->posi_name,
                "pers_learning" => $record->lear_namethai,
                "pers_status" => $record->pers_status,
            );
           
        }   

        $output = array(
            "data" =>  $data
        );

       // echo '<pre>'; print_r($Register);              
      
       echo json_encode($output);

    }



}


?>
