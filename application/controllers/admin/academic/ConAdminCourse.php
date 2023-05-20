<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConAdminCourse extends CI_Controller {
var  $title = "แผงควบคุม";
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


    public function SendPlanMain(){      
        $data['title'] = "ข้อมูลการส่งแผน";
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $posi = array('pers_position' => 'posi_003' , 'pers_position' => 'posi_004' ,'pers_position' => 'posi_005','pers_position' => 'posi_006');
        $data['Teacher'] = $DBpersonnel->select('pers_id,pers_img,pers_prefix,pers_firstname,pers_lastname')->where('pers_status','กำลังใช้งาน')
        ->where('pers_position','posi_003')
        ->or_where('pers_position','posi_004')
        ->or_where('pers_position','posi_005')
        ->or_where('pers_position','posi_006')
        ->get('tb_personnel')->result();
       
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $data['CheckYearSendPlan'] = $this->db->select('seplan_year,seplan_term')
        ->group_by('seplan_year,seplan_term')
        ->get('tb_send_plan')->result();        
        $data['CheckYear'] = $this->db->get('tb_send_plan_setup')->result();
        $data['year'] = $data['CheckYear'][0]->seplanset_year;
        $data['term'] = $data['CheckYear'][0]->seplanset_term;

        $data['Subject'] = $this->db->where('SubjectYear',$data['CheckYear'][0]->seplanset_term.'/'.$data['CheckYear'][0]->seplanset_year)->get('tb_subjects')->result();

        $data['Plan'] = $this->db->select('skjacth_personnel.tb_personnel.pers_id,
                                        skjacth_personnel.tb_personnel.pers_prefix,
                                        skjacth_personnel.tb_personnel.pers_firstname,
                                        skjacth_personnel.tb_personnel.pers_lastname,
                                        skjacth_personnel.tb_personnel.pers_learning,
                                        skjacth_academic.tb_send_plan.*')
                                        ->from('skjacth_academic.tb_send_plan')
                                        ->join('skjacth_personnel.tb_personnel','skjacth_academic.tb_send_plan.seplan_usersend = skjacth_personnel.tb_personnel.pers_id','LEFT')
                                        ->where('seplan_year',$data['year'])
                                        ->where('seplan_term',$data['term'])
                                        ->group_by('seplan_coursecode,pers_id')->get()->result();

        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminSendPlan/AdminSendPlanTeacher.php');
        $this->load->view('admin/layout/Footer.php');
    }

    public function UpdateSendPlanTeacher(){
        $DBpersonnel = $this->load->database('personnel', TRUE);        

        $CheckSubject = $this->db->where('SubjectID',$this->input->post('SelectSubject'))
        ->get('tb_subjects')->result();  
         
        $SubYear = explode('/',$CheckSubject[0]->SubjectYear);
        $Checkplan = $this->db->where('seplan_coursecode',$CheckSubject[0]->SubjectCode) 
                    ->where('seplan_usersend',$this->input->post('SelectTeacher'))
                    ->where('seplan_year',$SubYear[1])
                    ->where('seplan_term',$SubYear[0])
                    ->get('tb_send_plan')->num_rows();
    
        if($Checkplan <= 0){
       
            $CheckTeacher = $DBpersonnel->select('pers_learning')->where('pers_id',$this->input->post('SelectTeacher'))->get('tb_personnel')->result();
        $status=$this->input->post('seplan_sendcomment');
        $textToStore = nl2br(htmlentities($status, ENT_QUOTES, 'UTF-8'));   

        $typePlan  = array('บันทึกตรวจใช้แผน','แบบตรวจแผนการจัดการเรียนรู้','โครงการสอน','แผนการสอนหน้าเดียว','แผนการสอนเต็ม','บันทึกหลังสอน');

        
            foreach ($typePlan as $key => $v_typePlan) {
                $SubjectType = explode('/',$CheckSubject[0]->SubjectType);
                $SubjectYear = explode('/',$CheckSubject[0]->SubjectYear);
                $SubjectClass = explode('.',$CheckSubject[0]->SubjectClass);

                $insert =  array('seplan_namesubject'=> $CheckSubject[0]->SubjectName,
                    'seplan_coursecode'=>  $CheckSubject[0]->SubjectCode,
                    'seplan_typesubject'=> $SubjectType[1],                   
                    'seplan_year'=> $SubjectYear[1],
                    'seplan_term'=> $SubjectYear[0],                  
                    'seplan_status1' => "รอตรวจ",
                    'seplan_status2' => "รอตรวจ",
                    'seplan_sendcomment' =>  $textToStore,
                    'seplan_gradelevel' => $SubjectClass[1],
                    'seplan_typeplan' => $v_typePlan,
                    'seplan_usersend' => $this->input->post('SelectTeacher'),
                    'seplan_learning' => $CheckTeacher[0]->pers_learning
                );
                $result= $this->db->insert('tb_send_plan',$insert); 
            }
           echo 1; 
        }else{
            echo 0;
        }

 
     
    }


    public function UpdateSettingSendPlan(){

        $data = array('seplanset_startdate' => $this->input->post('seplanset_startdate'),
        'seplanset_enddate' => $this->input->post('seplanset_enddate'),
        'seplanset_term' => $this->input->post('seplanset_term'),
        'seplanset_year' => $this->input->post('seplanset_year'));

        echo $this->db->update('tb_send_plan_setup',$data,'seplanset_ID=1');
       // print_r($this->input->post());
    }


}


?>