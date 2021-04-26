<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConTeacherCourse extends CI_Controller {
var  $title = "หน้าแรก";
	public function __construct() {
		parent::__construct();
		
		if ($this->session->userdata('fullname') == '' && $this->session->userdata('status') == "user") {      
			redirect('welcome','refresh');
		}

        $this->load->model('teacher/ModTeacherCourse');

    }


    public function Course(){      
        
        $data['plan'] = $this->db->where('seplan_usersend',$this->session->userdata('login_id'))->get('tb_send_plan')->result();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/course/plan/plan_main.php');
        $this->load->view('teacher/layout/footer_teacher.php');
        
    }

    public function send_plan(){
        $this->load->view('teacher/layout/header_teacher.php');
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/course/plan/plan_send.php');
        $this->load->view('teacher/layout/footer_teacher.php');
    }

    public function check_plan($id = null){
        $DBskj = $this->load->database('skj', TRUE); 
        $data['lean'] = $DBskj->get('tb_learning')->result();
        $data['ID'] = $id;
        //echo '<pre>'; print_r($lean); exit();
        $data['checkplan'] = $this->db->select("skjacth_academic.tb_send_plan.*,
                                                skjacth_personnel.tb_personnel.pers_prefix,
                                                skjacth_personnel.tb_personnel.pers_firstname,
                                                skjacth_personnel.tb_personnel.pers_lastname")
                                                ->join('skjacth_personnel.tb_personnel','skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_send_plan.seplan_usersend')
                            ->where('seplan_learning',$id)
                            ->get('tb_send_plan')->result();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/course/plan/plan_check.php');
        $this->load->view('teacher/layout/footer_teacher.php');
    }
    
    function insert_plan(){

        $config['upload_path']= "uploads/academic/course/plan/";
        $config['allowed_types'] = '*';
        //$config['encrypt_name'] = TRUE;
         
        $this->load->library('upload',$config);
        $this->upload->initialize($config); 
        if($this->upload->do_upload("seplan_file")){
            $data = array('upload_data' => $this->upload->data());
 
            $insert =  array('seplan_namesubject'=> $this->input->post('seplan_namesubject'),
                            'seplan_coursecode'=> $this->input->post('seplan_coursecode'),
                            'seplan_typeplan'=> $this->input->post('seplan_typeplan'),
                            'seplan_createdate'=> date('Y-m-d H:i:s'),
                            'seplan_year'=> '',
                            'seplan_term'=> '',
                            'seplan_file'=> $data['upload_data']['file_name'],
                            'seplan_usersend'=> $this->session->userdata('login_id'),
                            'seplan_learning'  => $this->session->userdata('pers_learning') 
                         );
             
            $result= $this->ModTeacherCourse->plan_insert($insert);
            echo $result;
            
        }else{
            $error = $this->upload->display_errors();
            echo $error;
        }
        
     }


     function setting_plan(){
        $data['title'] = "ตั้งค่า";
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/course/plan/plan_setting_plan.php');
        $this->load->view('teacher/layout/footer_teacher.php');
     }


}


?>
