<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConAdminRoomOnline extends CI_Controller {
var  $title = "หน้าแรก";
	public function __construct() {
		parent::__construct();
		
		if (empty($this->session->userdata('fullname')) && !$this->session->userdata('status') == 'admin') {      
			redirect('welcome','refresh');
		}
        $this->load->model('teacher/ModTeacherTeaching');
    }

      // ห้องเรียนออนไลน์

    public function RoomOnlineMain(){      
        $data['title']  = "หน้าหลักห้องเรียนออนไลน์";
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['teacher'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        $data['RoomOnline'] =$this->db->get('tb_room_online')->result();
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
        $this->load->view('admin/Academic/AdminRoomOnline/AdminRoomOnlineMain.php');
        $this->load->view('admin/layout/Footer.php');     
    }

    function AddRoomOnline(){ 

        $array = array('roomon_coursecode'=> $this->input->post('roomon_coursecode'),           
            'roomon_classlevel'=> implode("|",$this->input->post('roomon_classlevel')),    
            'roomon_teachid'=> $this->input->post('roomon_teachid'),
            'roomon_year' => $this->input->post('roomon_year'),
            'roomon_term' => $this->input->post('roomon_term')
        );
        $count = $this->db->where($array)->count_all_results('tb_room_online');
        if($count == 0){
            $insert =  array('roomon_coursecode'=> $this->input->post('roomon_coursecode'),
            'roomon_coursename'=> $this->input->post('roomon_coursename'),
            'roomon_classlevel'=> implode("|",$this->input->post('roomon_classlevel')),    
            'roomon_teachid'=> $this->input->post('roomon_teachid'),
            'roomon_linkroom' => $this->input->post('roomon_linkroom'),
            'roomon_liveroom' => $this->input->post('roomon_liveroom'),
            'roomon_note' => $this->input->post('roomon_note'),
            'roomon_year' => $this->input->post('roomon_year'),
            'roomon_term' => $this->input->post('roomon_term'),
            'roomon_datecreate' => date('Y-m-d H:i:s')
        );
        echo $result = $this->ModTeacherTeaching->RoomOnlineInsert($insert); 
        }else{
            echo 2;
        }

        
    }

    function EditRoomOnline(){
        $edit = $this->db->where('roomon_id',$this->input->post('roomid'))->get('tb_room_online')->result();
        echo json_encode($edit); 
    }

    function UpdateRoomOnline(){ 
        //echo $this->input->post('roomon_teachid'); exit();
      $update =  array('roomon_coursecode'=> $this->input->post('roomon_coursecode'),
            'roomon_coursename'=> $this->input->post('roomon_coursename'),
            'roomon_classlevel'=> implode("|",$this->input->post('roomon_classlevel')), 
            'roomon_linkroom' => $this->input->post('roomon_linkroom'),
            'roomon_teachid' => $this->input->post('roomon_teachid'),
            'roomon_liveroom' => $this->input->post('roomon_liveroom'),
            'roomon_note' => $this->input->post('roomon_note'),
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
