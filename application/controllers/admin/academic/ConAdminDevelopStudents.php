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

        // ชื่อตารางชุมนุม
        $data['TotalClubs'] = $this->db->where('club_year', '2567')
        ->where('club_trem', '1')
        ->get('tb_clubs')->result();
        // จำนวนนักเรียนลงทะเบียน
        $data['TotalStudent'] = $this->db->select('COUNT(tb_club_members.member_student_id) AS StudentAll')
        ->from('tb_club_members')
        ->join('tb_clubs','tb_club_members.member_club_id = tb_clubs.club_id')
        ->where('club_year', '2567')->where('club_trem', '1')
        ->get()->result();
        //นับจำนวนครู
        $data['TotalTeacher'] = $this->db->select("SUM(LENGTH(club_faculty_advisor) - LENGTH(REPLACE(club_faculty_advisor, '|', '')) + 1) AS total_advisors")
        ->where('club_year', '2567')
        ->where('club_trem', '1')
        ->get('tb_clubs')->result();
        // ชุมนุมยอดนิยม
        $data['ClubPopula'] = $this->db->select('
        tb_clubs.club_id,
        tb_clubs.club_name,
        COUNT(tb_club_members.member_student_id) AS total_members
        ')->from('tb_clubs')
        ->join('tb_club_members','tb_club_members.member_club_id = tb_clubs.club_id','left')
        ->group_by('tb_clubs.club_id')
        ->order_by('total_members','DESC')
        ->limit(1)->get()->row();


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
        $clubs = array();
        $clubs = $this->db->select('skjacth_academic.tb_clubs.*,
        GROUP_CONCAT(CONCAT(pers_prefix,pers_firstname," ",pers_lastname) SEPARATOR ", ") as advisor_names,
        skjacth_personnel.tb_personnel.pers_prefix,
        skjacth_personnel.tb_personnel.pers_firstname,
        skjacth_personnel.tb_personnel.pers_lastname')
        ->from('skjacth_academic.tb_clubs')
        ->join('skjacth_personnel.tb_personnel','FIND_IN_SET(skjacth_personnel.tb_personnel.pers_id , REPLACE(club_faculty_advisor, "|", ",")) > 0','LEFT')
        ->where('club_year',$ExYear[1])
        ->where('club_trem',$ExYear[0])
        ->group_by('club_id')
        ->get()->result();

        foreach ($clubs as $club) {
          
            //$clubs['advisor_names'] = $club->club_faculty_advisor;
        }
        
        echo json_encode([ "filters" => [
            "year" => $year
        ],
        'data' => $clubs]); // ส่งข้อมูลกลับในรูปแบบ JSON

    }


    public function ClubsInsert(){
        $advisors = json_decode($this->input->post('advisors'));
        
        $data = [
            'club_name' => $this->input->post('club_name'),
            'club_description' => $this->input->post('club_description'),
            'club_faculty_advisor' => implode('|',$advisors),
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
        $advisors = json_decode($this->input->post('advisors'));
        $data = [
            'club_name' => $this->input->post('club_name'),
            'club_description' => $this->input->post('club_description'),
            'club_faculty_advisor' => implode('|',$advisors),
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


    public function ClubsAddStudentToClub(){
        
        $student_ids = $this->input->post('student_ids'); 
        $club_id = $this->input->post('club_id');
        

        if (empty($student_ids)) {
            echo json_encode(['status' => false, 'message' => 'กรุณาเลือกนักเรียน']);
            return;
        }

        //เช็ดข้อมูลซ้ำ
        $this->db->select('
        CONCAT(StudentCode," ",StudentPrefix,StudentFirstName," ",StudentLastName," ",tb_students.StudentClass) AS Fullname,        
        tb_students.StudentID,
        tb_students.StudentNumber,
        tb_club_members.member_club_id,
        tb_club_members.member_student_id');
        $this->db->from('tb_club_members');
        $this->db->join('tb_students', 'tb_students.StudentID = tb_club_members.member_student_id');
        $this->db->where('member_club_id',$club_id);
        $this->db->where_in('member_student_id',$student_ids);
        $result = $this->db->get()->result_array();
        $duplicate_students = array_column($result, 'Fullname');

        if (!empty($duplicate_students)) {
            echo json_encode([
                'status' => 'duplicate',
                'duplicate_students' => $duplicate_students,
            ]);
            return;
        }

        $data = [];
        foreach ($student_ids as $student_id) {
            $data[] = [
                'member_club_id ' => $club_id, 
                'member_student_id' => $student_id,
                'member_join_date' => date('Y-m-d'),
                'member_role' => 'Member'
            ];
        }
        // เพิ่มนักเรียนเข้าชุมนุม
        $result = $this->db->insert_batch('tb_club_members', $data);
        
        if ($result) {
           
            $this->db->where('member_club_id',$club_id);
            $all_students = $this->db->get('tb_club_members')->result_array();

            echo json_encode([
                'status' => 'success',
                'message' => 'บันทึกสำเร็จ',
                'all_students' => $all_students,
            ]);
        } else {
            echo json_encode(['status' => false, 'message' => 'เกิดข้อผิดพลาด']);
        }

    }

    public function ClubsTbShowStudentList(){

    $club_id = $this->input->get('club_id');

    $this->db->select('
    CONCAT(StudentPrefix,StudentFirstName," ",StudentLastName) AS Fullname,
    tb_students.StudentCode,
    tb_students.StudentID,
    tb_students.StudentClass,
    tb_students.StudentNumber,
    tb_club_members.member_club_id');
    $this->db->from('tb_club_members');
    $this->db->join('tb_students', 'tb_students.StudentID = tb_club_members.member_student_id');
    $this->db->where('member_club_id', $club_id);
    $this->db->order_by('StudentClass,StudentNumber','ASC');
    $query = $this->db->get();
    echo json_encode($query->result_array());

    }

    public function ClubDeleteStudentToClub(){

        $club_id = $this->input->post('club_id');
        $student_id = $this->input->post('student_id');
        // ลบข้อมูลนักเรียนออกจากชุมนุม
        $this->db->where('member_club_id', $club_id);
        $this->db->where('member_student_id', $student_id);
        $this->db->delete('tb_club_members');

        if ($this->db->affected_rows() > 0) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'ไม่สามารถลบข้อมูลได้']);
        }
    }

    //------------------------ แดชบอร์ด --------------------------
    // ดูนักเรียนลงทะเบียน
    public function ClubGetClassroom(){

        $query = $this->db->query("SELECT DISTINCT StudentClass FROM tb_students WHERE StudentStatus = '1/ปกติ' ORDER BY StudentClass ASC");
        $classrooms = $query->result_array();
        echo json_encode(['classrooms' => $classrooms]);
    }

    public function ClubGetStudentRegisterClub(){
        $classFilter = $this->input->get('classFilter');
        $this->db->select('
            IFNULL(tb_clubs.club_name, "ยังไม่ได้เลือกชุมนุม") AS club_status,
            tb_clubs.club_id,
            tb_clubs.club_name,
            tb_students.StudentClass,
            tb_students.StudentCode,
            tb_students.StudentNumber,
            CONCAT(StudentPrefix,StudentFirstName," ",StudentLastName) AS Fullname
        ');
        $this->db->from('tb_students');
        $this->db->join('tb_club_members','tb_club_members.member_student_id = tb_students.StudentID','left');
        $this->db->join('tb_clubs','tb_club_members.member_club_id = tb_clubs.club_id','left');
        $this->db->where('tb_students.StudentStatus', '1/ปกติ');
        if (!empty($classFilter)) {
            $this->db->where('tb_students.StudentClass', $classFilter); // กรองตามห้องเรียน
        }
        $query =  $this->db->get()->result_array();
        echo json_encode(['data' => $query]);
    }



}


