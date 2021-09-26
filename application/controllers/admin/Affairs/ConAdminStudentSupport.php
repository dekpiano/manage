<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConAdminStudentSupport extends CI_Controller {

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
    public function PageMainSetting(){ 

        $data['title'] = "ตั้งค่าระบบเยี่ยมบ้านนักเรียน/SDQ";
        $DBpersonnel = $this->load->database('personnel', TRUE); //ฐานข้อมูลบุคลากร
        $DBaffairs = $this->load->database('affairs', TRUE); //ฐานข้อมูลงานกิจการนักเรียน
        $data['Manager'] = $DBaffairs->select('homevisit_set_manager')->get('tb_homevisit_setting')->result();
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
        $this->load->view('admin/AdminAffairs/AdminStudentSupport/AdminHomeVisit/AdminPageMainSetting.php');
        $this->load->view('admin/layout/Footer.php');

    }

    public function HomeVisitSettingManager() {  
        $DBaffairs = $this->load->database('affairs', TRUE); //ฐานข้อมูลงานกิจการนักเรียน

        $data = array('homevisit_set_manager' => $this->input->post('TeachID'));
        $result = $DBaffairs->update('tb_homevisit_setting',$data,'homevisit_set_id=1');
        echo $result;
    }
    

}


?>
