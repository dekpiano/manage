<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConAdminEvaluateEditGrade extends CI_Controller {
var  $title = "แผงควบคุม";
	public function __construct() {
        parent::__construct();
        $this->load->model('admin/ModAdminSaveScore');
		
		if (empty($this->session->userdata('fullname'))) {		
			redirect('LoginAdmin','refresh');
		}

        $data['check_status'] = $this->db->where('admin_rloes_userid',$this->session->userdata('login_id'))->get('tb_admin_rloes')->row();
        if(@$data['check_status']->admin_rloes_status == "admin" || @$data['check_status']->admin_rloes_status == "manager"){
            
        }else{
            $this->session->set_flashdata(array('msg'=>'OK','messge'=> 'คุณไม่มีสิทธ์ในระบบจัดข้อมูลนี้ ติดต่อเจ้าหน้าที่คอม','alert'=>'error'));
            redirect('welcome','refresh');
        }

    }

    function check_grade($sum) {
        if (($sum > 100) || ($sum < 0)) {
             $grade = "ไม่สามารถคิดเกรดได้ คะแนนเกิน";
        } else if (($sum >= 79.5) && ($sum <= 100)) {
             $grade = 4;
        } else if (($sum >= 74.5) && ($sum <= 79.4)) {
             $grade = 3.5;
        } else if (($sum >= 69.5) && ($sum <= 74.4)) {
             $grade = 3;
        } else if (($sum >= 64.5) && ($sum <= 69.4)) {
             $grade = 2.5;
        } else if (($sum >= 59.5) && ($sum <= 64.4)) {
             $grade = 2;
        } else if (($sum >= 54.5) && ($sum <= 59.4)) {
             $grade = 1.5;
        } else if (($sum >= 49.5) && ($sum <= 54.4)) {
             $grade = 1;
        } else if ($sum <= 49.4) {
             $grade = 0;
        }
        return $grade;
    }
    
    public function AdminEvaluateEditGradeMain($Term,$Year){   
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['admin'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $data['title'] = "แสดงผลการเรียน 0 ร";	
        $data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $data['OnOffSaveScore'] = $this->db->where('onoff_id >= 2')->where('onoff_id <= 5')->get('tb_register_onoff')->result();
        $data['OnOffSaveScoreSystem'] = $this->db->where('onoff_id',6)->get('tb_register_onoff')->result();
        $data['CheckYearRegis'] = $this->db->select('RegisterYear')->group_by('RegisterYear')->get('tb_register')->result();
        
        $data['result'] = $this->db->select('
                            skjacth_academic.tb_register.SubjectID,
                            skjacth_academic.tb_register.RegisterYear,
                            skjacth_academic.tb_register.TeacherID,
                            skjacth_personnel.tb_personnel.pers_prefix,
                            skjacth_personnel.tb_personnel.pers_firstname,
                            skjacth_personnel.tb_personnel.pers_lastname,
                            skjacth_academic.tb_subjects.SubjectName,
                            skjacth_academic.tb_subjects.SubjectCode,
                            skjacth_academic.tb_register.RegisterClass
                            ')
                            ->from('skjacth_academic.tb_register')
                            ->join('skjacth_academic.tb_subjects','skjacth_academic.tb_subjects.SubjectID = skjacth_academic.tb_register.SubjectID')
                            ->join('skjacth_personnel.tb_personnel','skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_register.TeacherID')
                            ->where('RegisterYear',$Term.'/'.$Year)
                            ->group_by('SubjectCode')
                            ->get()->result();
        
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminEvaluateEditGrade/AdminEvaluateEditGradeMain.php');
        $this->load->view('admin/layout/Footer.php');

       
        
    }

    public function AdminEvaluateEditGradeUpdate($term,$yaer,$subject){
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $data['title'] = "บันทึกคะแนนผลการเรียน 0 ร";	
       
        $data['check_student'] = $this->db->select('
                                    tb_register.SubjectID,
                                    tb_register.RegisterYear,
                                    tb_register.RegisterClass,
                                    tb_register.Score100,
                                    tb_register.TeacherID,
                                    tb_subjects.SubjectCode,
                                    tb_subjects.SubjectName,
                                    tb_register.StudyTime,
                                    tb_subjects.SubjectID,
                                    tb_subjects.SubjectUnit,
                                    tb_subjects.SubjectHour,
                                    tb_students.StudentID,
                                    tb_students.StudentPrefix,
                                    tb_students.StudentFirstName,
                                    tb_students.StudentLastName,
                                    tb_students.StudentNumber,
                                    tb_students.StudentClass,
                                    tb_students.StudentCode,
                                    tb_students.StudentStatus,
                                    tb_students.StudentBehavior,
                                    tb_register.Grade,
                                    tb_register.Grade_Type
                                ')
                                ->from('tb_register')
                                ->join('tb_subjects','tb_subjects.SubjectID = tb_register.SubjectID')
                                ->join('tb_students','tb_students.StudentID = tb_register.StudentID')
                                //->where('TeacherID',$this->session->userdata('login_id'))
                                //>where('tb_register.Grade <=',0)
                                ->where('tb_students.StudentBehavior !=','จำหน่าย')
                                ->where('tb_register.RegisterYear',$term.'/'.$yaer)
                                ->where('tb_subjects.SubjectYear',$term.'/'.$yaer)
                                ->where('tb_register.SubjectID',urldecode($subject))                                
                                //->or_where('tb_register.Grade_Type','เรียนซ้ำครั้งที่ 1')
                                ->order_by('tb_students.StudentClass','ASC')
                                ->order_by('tb_students.StudentNumber','ASC')
                                ->get()->result();
           // echo '<pre>'; print_r($data['check_student']);exit();          
        $data['Teacher'] = $DBpersonnel->select('pers_prefix,pers_firstname,pers_lastname')->where('pers_id',@$data['check_student'][0]->TeacherID)->get('tb_personnel')->row();            
        

        $check_idSubject = $this->db->where('SubjectID',urldecode($subject))->where('SubjectYear',$term.'/'.$yaer)->get('tb_subjects')->row();
        
        $data['set_score'] = $this->db->where('regscore_subjectID',$check_idSubject->SubjectID)->get('tb_register_score')->result();
        $data['onoff_savescore'] = $this->db->where('onoff_id >=',2)->where('onoff_id <=',5)->get('tb_register_onoff')->result();

        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminEvaluateEditGrade/AdminEvaluateEditGrade.php');
        $this->load->view('admin/layout/Footer.php');
        

    }

    public function insert_score_0W(){ 
        $checkOnOff = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $TimeNum = $this->input->post('TimeNum');
        foreach ($this->input->post('StudentID') as $num => $value) {
           //print_r($this->input->post('TimeNum'));
            // print_r($this->input->post('SubjectCode'));
            $study_time = $this->input->post('study_time');
            
            if((($TimeNum*80)/100) > $study_time[$num]){
                $Grade = "มส";
            }else{
                if(in_array("ร",$this->input->post($value))){
                    $Grade = "ร";
                }else{
                    $Grade = $this->check_grade(array_sum($this->input->post($value)));
                }
            }

            $key = array('StudentID' => $value,'SubjectID' => $this->input->post('SubjectCode'), 'RegisterYear' => $this->input->post('RegisterYear'));
          

            $checkScore100 = $this->db->select('Score100')->where($key)->get('tb_register')->result();
            if($checkScore100[0]->Score100 === implode("|",$this->input->post($value))){
                $data = array('Score100' => implode("|",$this->input->post($value)),'Grade'  => $Grade,'StudyTime' => $study_time[$num]);
            }else{
                $data = array('Score100' => implode("|",$this->input->post($value)),'Grade'  => $Grade,'StudyTime' => $study_time[$num],'Grade_Type'=> 'แก้ 0 ร','Grade_UpdateTime'=>date('Y-m-d H:i:s'));
            }
           
          echo $this->db->update('tb_register',$data,$key);
        }

    }
     

}


?>
