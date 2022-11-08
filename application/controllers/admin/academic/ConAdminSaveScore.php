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

        $data['check_status'] = $this->db->where('admin_rloes_userid',$this->session->userdata('login_id'))->get('tb_admin_rloes')->row();
        if(@$data['check_status']->admin_rloes_status == "admin" || @$data['check_status']->admin_rloes_status == "manager"){
            
        }else{
            $this->session->set_flashdata(array('msg'=>'OK','messge'=> 'คุณไม่มีสิทธ์ในระบบจัดข้อมูลนี้ ติดต่อเจ้าหน้าที่คอม','alert'=>'error'));
            redirect('welcome','refresh');
        }

    }

    public function AdminSaveScoreMain(){   
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['admin'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $data['title'] = "บันทึกผลการเรียน";	
        $data['OnOffSaveScore'] = $this->db->where('onoff_id >= 2')->where('onoff_id <= 5')->get('tb_register_onoff')->result();
        $data['OnOffSaveScoreSystem'] = $this->db->where('onoff_id',6)->get('tb_register_onoff')->result();
        
        $data['result'] = $this->db->select('
                            skjacth_academic.tb_register.SubjectCode,
                            skjacth_academic.tb_register.RegisterYear,
                            skjacth_academic.tb_register.TeacherID,
                            skjacth_personnel.tb_personnel.pers_prefix,
                            skjacth_personnel.tb_personnel.pers_firstname,
                            skjacth_personnel.tb_personnel.pers_lastname,
                            skjacth_academic.tb_subjects.SubjectName,
                            skjacth_academic.tb_register.RegisterClass
                            ')
                            ->from('skjacth_academic.tb_register')
                            ->join('skjacth_academic.tb_subjects','skjacth_academic.tb_subjects.SubjectCode = skjacth_academic.tb_register.SubjectCode')
                            ->join('skjacth_personnel.tb_personnel','skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_register.TeacherID')
                            ->where('RegisterYear','1/2565')
                            ->group_by('SubjectCode')
                            ->get()->result();
        
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminSaveScore/AdminSaveScoreMain.php');
        $this->load->view('admin/layout/Footer.php');

       
        
    }

    public function AdminSaveScoreGrade($term,$yaer,$subject){



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
