<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConTeacherTeaching extends CI_Controller {
var  $title = "หน้าแรก";
	public function __construct() {
		parent::__construct();
		
		if (empty($this->session->userdata('fullname')) && !$this->session->userdata('status') == 'admin') {      
			redirect('welcome','refresh');
		}
        $this->load->model('teacher/ModTeacherTeaching');
    }

    public function CheckHomeRoom(){      
        $data['title']  = "โฮมรูม";
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['teacher'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/Teaching/CheckName/CheckHomeRoom.php');
        $this->load->view('teacher/layout/footer_teacher.php');
        
    }

    public function CheckTeaching(){      
        $data['title']  = "เช็คชื่อการสอน";
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['teacher'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/Teaching/CheckName/CheckHomeRoom.php');
        $this->load->view('teacher/layout/footer_teacher.php');
        
    }


    // ห้องเรียนออนไลน์

    public function RoomOnlineMain(){      
        $data['title']  = "หน้าหลักห้องเรียนออนไลน์";
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['teacher'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        $data['RoomOnline'] =$this->db->get('tb_room_online')->result();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/Teaching/RoomOnline/RoomOnlineMain.php');
        $this->load->view('teacher/layout/footer_teacher.php');        
    }

    function AddRoomOnline(){ 
        $insert =  array('roomon_coursecode'=> $this->input->post('roomon_coursecode'),
            'roomon_coursename'=> $this->input->post('roomon_coursename'),
            'roomon_classlevel'=> $this->input->post('roomon_classlevel'),    
            'roomon_teachid'=> $this->session->userdata('login_id'),
            'roomon_linkroom' => $this->input->post('roomon_linkroom'),
            'roomon_year' => $this->input->post('roomon_year'),
            'roomon_term' => $this->input->post('roomon_term'),
            'roomon_datecreate' => date('Y-m-d H:i:s')
        );
        echo $result = $this->ModTeacherTeaching->RoomOnlineInsert($insert); 
    }

    function EditRoomOnline(){
        $edit = $this->db->where('roomon_id ',$this->input->post('roomid'))->get('tb_room_online')->result();
        echo json_encode($edit); 
    }

    function UpdateRoomOnline(){ 
        //echo $this->input->post('roomon_year'); exit();
        $update =  array('roomon_coursecode'=> $this->input->post('roomon_coursecode'),
            'roomon_coursename'=> $this->input->post('roomon_coursename'),
            'roomon_classlevel'=> $this->input->post('roomon_classlevel'), 
            'roomon_linkroom' => $this->input->post('roomon_linkroom'),
            'roomon_year' => $this->input->post('roomon_year'),
            'roomon_term' => $this->input->post('roomon_term')
        );
        $id = $this->input->post('roomon_id');
        echo $result = $this->ModTeacherTeaching->RoomOnlineUpdate($update, $id); 
    }

    function DeleteRoomOnline(){
        $id = $this->input->post('roomid');
        echo $result = $this->ModTeacherTeaching->RoomOnlineDelete($id); 
    }

}


?>
