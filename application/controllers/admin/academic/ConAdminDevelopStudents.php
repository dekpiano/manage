<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConAdminDevelopStudents extends CI_Controller {
var  $title = "กิจกรรมพัฒนาผู้เรียน";
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

       // echo '<pre>'; print_r($data['check_status']->admin_rloes_status); exit();


    }

    public function AllData(){
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();       
        $data['CheckYear'] = $this->db->get('tb_send_plan_setup')->result();

        return $data;
    }


    public function ClubsMain(){       
        $data = $this->AllData();
        $data['title'] = "หน้าแรกชุมนุม";

        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminDevelopStudents/Clubs/AdminClubsMain.php');
        $this->load->view('admin/layout/Footer.php');

    }

    public function ClubsAll(){  
        $data = $this->AllData();
        $data['title'] = "ชุมนุมทัังหมด";

        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['Teacher'] = $DBpersonnel->select('pers_id,pers_img,pers_prefix,pers_firstname,pers_lastname')->where('pers_status','กำลังใช้งาน')
        ->where('pers_position','posi_003')
        ->or_where('pers_position','posi_004')
        ->or_where('pers_position','posi_005')
        ->or_where('pers_position','posi_006')
        ->where('pers_status','กำลังใช้งาน')
        ->get('tb_personnel')->result();

        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminDevelopStudents/Clubs/AdminClubsAll.php');
        $this->load->view('admin/layout/Footer.php');
        
    }

    public function ClubsShow(){

        $clubs = $this->db->get('tb_clubs')->result();
        echo json_encode(['data' => $clubs]); // ส่งข้อมูลกลับในรูปแบบ JSON

    }


    public function ClubsInsert(){
        $data = [
            'club_name' => $this->input->post('club_name'),
            'club_description' => $this->input->post('club_description'),
            'club_faculty_advisor' => $this->input->post('club_faculty_advisor'),
            'club_year' => $this->input->post('club_year'),
            'club_trem' => $this->input->post('club_trem'),
            'club_max_participants' => $this->input->post('club_max_participants'),
            'club_status' => 'open',
            'club_established_date' => date('Y-m-d'),
        ];

        if($this->db->insert('tb_clubs', $data)){
            echo 1;
        } else{
            echo 0;
        }
      

    }


}