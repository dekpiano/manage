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

        $data['YearAll'] = $this->ClubsViweYearAll();

        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminDevelopStudents/Clubs/AdminClubsAll.php');
        $this->load->view('admin/layout/Footer.php');
        
    }

    public function ClubsShow(){
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $year = urldecode($this->input->get('year')); // รับค่าปีการศึกษาจาก AJAX
        $ExYear = explode("/",$year);
        $clubs = $this->db->select('skjacth_academic.tb_clubs.*,
        skjacth_personnel.tb_personnel.pers_prefix,
        skjacth_personnel.tb_personnel.pers_firstname,
        skjacth_personnel.tb_personnel.pers_lastname')
        ->from('skjacth_academic.tb_clubs')
        ->join('skjacth_personnel.tb_personnel','skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_clubs.club_faculty_advisor')
        ->where('club_year',$ExYear[1])
        ->where('club_trem',$ExYear[0])
        ->get()->result();

        
        echo json_encode([ "filters" => [
            "year" => $year
        ],
        'data' => $clubs]); // ส่งข้อมูลกลับในรูปแบบ JSON

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

    public function ClubsEdit($id){

        $data = $this->db->get_where('tb_clubs', ['club_id' => $id])->row_array();
        echo json_encode($data);
    }

    public function ClubsUpdate(){

        $data = [
            'club_name' => $this->input->post('club_name'),
            'club_description' => $this->input->post('club_description'),
            'club_faculty_advisor' => $this->input->post('club_faculty_advisor'),
            'club_year' => $this->input->post('club_year'),
            'club_trem' => $this->input->post('club_trem'),
            'club_max_participants' => $this->input->post('club_max_participants'),
        ];
        $id = $this->input->post('club_id');
        $this->db->where('club_id', $id);
        $Update = $this->db->update('tb_clubs', $data);

        echo $Update;
    }

    public function ClubsDelete($id){

        $this->db->where('club_id', $id);
        $result = $this->db->delete('tb_clubs');
        if ($result) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function ClubsViweYearAll(){

        $this->db->select('club_year,club_trem');
        $this->db->from('tb_clubs');
        $this->db->group_by(['club_year', 'club_trem']); // รวมปีและเทอมที่ไม่ซ้ำ
        $this->db->order_by('club_year', 'DESC'); // เรียงปีการศึกษาล่าสุดลงไป
        $this->db->order_by('club_trem', 'ASC'); // เรียงเทอม
        return $this->db->get()->result_array();

        
    }

    public function ClubsStudentList(){

        $this->db->select('StudentID, CONCAT(StudentPrefix,StudentFirstName," ",StudentLastName," ",StudentClass," เลขที่ ",StudentNumber) AS FullName,StudentClass');
        $this->db->where('StudentStatus','1/ปกติ');
        $this->db->order_by('StudentClass','ASC');
        $this->db->order_by('StudentNumber','ASC');
        $query = $this->db->get('tb_students');
        $students = $query->result_array();


        echo json_encode($students);
    }
}