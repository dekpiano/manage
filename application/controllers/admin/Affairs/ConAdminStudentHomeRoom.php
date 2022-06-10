<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConAdminStudentHomeRoom extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('admin/ModAdminExtraSubject');
		if (empty($this->session->userdata('fullname'))) {		
			redirect('LoginAdmin','refresh');
		}

    }

    public function index(){  

    } 

    // ------------------ ตั้งค่าระบบ ---------------------------
    public function PageSettingHomeRoom(){ 

        $data['title'] = "ตั้งค่าระบบโฮมรูม";
        $DBpersonnel = $this->load->database('personnel', TRUE); //ฐานข้อมูลบุคลากร
        $DBaffairs = $this->load->database('affairs', TRUE); //ฐานข้อมูลงานกิจการนักเรียน
        $data['Time'] = $DBaffairs->select('set_homeroom_time')->where('set_homeroom_id',1)->get('tb_checkhomeroom_setting')->result();
       // print_r($data['Time']);exit();
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
        $this->load->view('admin/Affairs/AdminAffairs/AdminStudentHomeRoom/AdminPageSettingHomeRoom.php');
        $this->load->view('admin/layout/Footer.php');

    }

    public function UpdateTimeHomeRoom() {  
        $DBaffairs = $this->load->database('affairs', TRUE); //ฐานข้อมูลงานกิจการนักเรียน

        $data = array('set_homeroom_time' => $this->input->post('set_homeroom_time'));
        $result = $DBaffairs->update('tb_checkhomeroom_setting',$data,'set_homeroom_id=1');
        echo $result;
    }

    
    

}


?>
