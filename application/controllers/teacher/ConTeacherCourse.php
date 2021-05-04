<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConTeacherCourse extends CI_Controller {
var  $title = "หน้าแรก";
	public function __construct() {
		parent::__construct();
		
		if ($this->session->userdata('fullname') == '' && !$this->session->userdata('status') == 'admin') {      
			redirect('welcome','refresh');
		}

        $this->load->model('teacher/ModTeacherCourse');

    }


    public function Course(){      
        $data['title'] = "แผนการสอน";
        $data['OnOff'] = $this->db->select('seplanset_status')->get('tb_send_plan_setup')->result();
        $data['plan'] = $this->db->where('seplan_usersend',$this->session->userdata('login_id'))->get('tb_send_plan')->result();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/course/plan/plan_main.php');
        $this->load->view('teacher/layout/footer_teacher.php');
        
    }

    public function send_plan(){
        $data['title'] = "ส่งงาน";
        $data['OnOff'] = $this->db->select('seplanset_status')->get('tb_send_plan_setup')->result();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/course/plan/plan_send.php');
        $this->load->view('teacher/layout/footer_teacher.php');
    }

    public function edit_plan($id){
        $data['title'] = "แก้ไขงาน";
        $data['plan'] = $this->db->where('seplan_ID',$id)->get('tb_send_plan')->result();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/course/plan/plan_edit.php');
        $this->load->view('teacher/layout/footer_teacher.php');
    }

    public function check_plan($id = null){
        $data['title'] = "ตรวจสอบงาน";
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
        $SetPlan = $this->db->get('tb_send_plan_setup')->result();
        //print_r($SetPlan); exit();
        $this->load->library('upload',$config);
        $this->upload->initialize($config); 
        if($this->upload->do_upload("seplan_file")){
            $data = array('upload_data' => $this->upload->data());
 
            $insert =  array('seplan_namesubject'=> $this->input->post('seplan_namesubject'),
                            'seplan_coursecode'=> $this->input->post('seplan_coursecode'),
                            'seplan_typeplan'=> $this->input->post('seplan_typeplan'),
                            'seplan_typesubject'=> $this->input->post('seplan_typesubject'),
                            'seplan_createdate'=> date('Y-m-d H:i:s'),
                            'seplan_year'=> $SetPlan[0]->seplanset_year,
                            'seplan_term'=> $SetPlan[0]->seplanset_term,
                            'seplan_file'=> $data['upload_data']['file_name'],
                            'seplan_usersend'=> $this->session->userdata('login_id'),
                            'seplan_learning'  => $this->session->userdata('pers_learning'),
                            'seplan_status1' => "รอตรวจ",
                            'seplan_status2' => "รอตรวจ" 
                         );
             
            $result= $this->ModTeacherCourse->plan_insert($insert);
            echo $result;
            
        }else{
            $error = $this->upload->display_errors();
            echo $error;
        }
        
     }

     function update_plan(){
        $id_plan = $this->input->post('seplan_ID');
        $checkdata = $this->db->select('seplan_ID,seplan_file')->where('seplan_ID',$id_plan)->get('tb_send_plan')->result();
        $SetPlan = $this->db->get('tb_send_plan_setup')->result();

        //echo $_FILES['seplan_file']['error']; exit();
        if($_FILES['seplan_file']['error'] <= 0){
            $config['upload_path']= "uploads/academic/course/plan/";
            $config['allowed_types'] = '*';
            //$config['encrypt_name'] = TRUE;
            
            //print_r($SetPlan); exit();
            $this->load->library('upload',$config);
            $this->upload->initialize($config); 
            if($this->upload->do_upload("seplan_file")){
                $data = array('upload_data' => $this->upload->data());
     
                $update =  array('seplan_namesubject'=> $this->input->post('seplan_namesubject'),
                                'seplan_coursecode'=> $this->input->post('seplan_coursecode'),
                                'seplan_typeplan'=> $this->input->post('seplan_typeplan'),
                                'seplan_createdate'=> date('Y-m-d H:i:s'),
                                'seplan_year'=> $SetPlan[0]->seplanset_year,
                                'seplan_term'=> $SetPlan[0]->seplanset_term,
                                'seplan_typesubject'=> $SetPlan[0]->seplan_typesubject,
                                'seplan_file'=> $data['upload_data']['file_name'],
                                'seplan_usersend'=> $this->session->userdata('login_id'),
                                'seplan_learning'  => $this->session->userdata('pers_learning'),
                                'seplan_status1' => "รอตรวจ",
                                'seplan_status2' => "รอตรวจ" 
                             );
              
                @unlink("./uploads/academic/course/plan/".$checkdata[0]->seplan_file);
                 
                $result= $this->ModTeacherCourse->plan_update($update,$id_plan);
                echo $result;
                
            }else{
                $error = $this->upload->display_errors();
                echo $error;
            }
        }else{
            $update =  array('seplan_namesubject'=> $this->input->post('seplan_namesubject'),
                                'seplan_coursecode'=> $this->input->post('seplan_coursecode'),
                                'seplan_typeplan'=> $this->input->post('seplan_typeplan'),
                                'seplan_createdate'=> date('Y-m-d H:i:s'),
                                'seplan_year'=> $SetPlan[0]->seplanset_year,
                                'seplan_term'=> $SetPlan[0]->seplanset_term,
                                'seplan_typesubject'=> $this->input->post('seplan_typesubject'),
                                'seplan_usersend'=> $this->session->userdata('login_id'),
                                'seplan_learning'  => $this->session->userdata('pers_learning'),
                                'seplan_status1' => "รอตรวจ",
                                'seplan_status2' => "รอตรวจ" 
                             );
                            
                $result= $this->ModTeacherCourse->plan_update($update,$id_plan);
                echo $result;
        }
     }

     public function delete_plan($id)
   {
    $checkdata = $this->db->select('seplan_ID,seplan_file')->where('seplan_ID',$id)->get('tb_send_plan')->result();
    @unlink("./uploads/academic/course/plan/".$checkdata[0]->seplan_file);

       $this->db->delete('tb_send_plan', array('seplan_ID' => $id));
       echo 'Deleted successfully.';
   }

     function setting_plan(){         
        $data['title'] = "ตั้งค่า";
        $data['SetPlan'] = $this->db->get('tb_send_plan_setup')->result();
        //print_r($date['SetPlan']); exit();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/course/plan/plan_setting_plan.php');
        $this->load->view('teacher/layout/footer_teacher.php');
     }

     function setting_UpdatePlan(){
         $dateS = str_replace('/', '-', $this->input->post('seplanset_startdate'));
         $startdate = date('Y-m-d H:i:s',strtotime($this->input->post('seplanset_startdate')));
         $dateE = str_replace('/', '-', $this->input->post('seplanset_enddate'));
         $enddate = date('Y-m-d H:i:s',strtotime($this->input->post('seplanset_enddate')));
            $data = array('seplanset_startdate' => $startdate,
            'seplanset_enddate' => $enddate,
            'seplanset_usersetup' => $this->session->userdata('login_id'),
            'seplanset_year' => $this->input->post('seplanset_year'),
            'seplanset_term' => $this->input->post('seplanset_term'),
            'seplanset_status' => $this->input->post('seplanset_status'));
        //print_r($data); exit();
            $result = $this->ModTeacherCourse->plan_setting($data,1);
            if($result > 0){
                $this->session->set_flashdata(array('status'=>'success','msg'=> 'YES','messge' => "ตั้งค่าสำเร็จ"));
               
            }else{
                $this->session->set_flashdata(array('status'=>'error','msg'=> 'YES','messge' => "ตั้งค่าไม่สำเร็จ".$result));
               
            }
            redirect('Teacher/Course/Setting','refresh');
     }

     function UpdateStatus1(){
       // echo $this->input->post('status1');
        $id =  $this->input->post('planId');
        $data = array('seplan_status1' => $this->input->post('status1'),
                        'seplan_checkdate1' => date('Y-m-d H:i:s')
                        );
        $result = $this->ModTeacherCourse->plan_UpdateStatus1($data,$id);
        if($result == 1){
            $data = $this->db->select('seplan_status1,seplan_status2')->where('seplan_ID',$id)->get('tb_send_plan')->result();
            echo json_encode($data);
        }
     }
     function UpdateStatus2(){
        // echo $this->input->post('status1');
         $id =  $this->input->post('planId');
         $data = array('seplan_status2' => $this->input->post('status2'),
                         'seplan_checkdate2' => date('Y-m-d H:i:s')
                         );
         $result = $this->ModTeacherCourse->plan_UpdateStatus2($data,$id);
         if($result == 1){
            $data = $this->db->select('seplan_status1,seplan_status2')->where('seplan_ID',$id)->get('tb_send_plan')->result();
            echo json_encode($data);
        }
      }



}


?>