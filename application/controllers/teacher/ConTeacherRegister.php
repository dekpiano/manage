<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConTeacherRegister extends CI_Controller {
var  $title = "หน้าแรก";
	public function __construct() {
		parent::__construct();
		
		if (empty($this->session->userdata('fullname')) && !$this->session->userdata('status') == 'admin') {      
			redirect('welcome','refresh');
		}
        $this->DBpersonnel = $this->load->database('personnel', TRUE); 
        $this->DBaffairs = $this->load->database('affairs', TRUE);
        $this->CheckHomeVisitManager = $this->DBaffairs->select('homevisit_set_id,homevisit_set_manager')->where('homevisit_set_id',1)->get('tb_homevisit_setting')->first_row();
    }

    public function SaveScoreMain(){      
        $data['title']  = "หน้าบันทึกผลการเรียนหลัก";
        $data['teacher'] = $this->DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        
        $data['check_subject'] = $this->db->select('
                                    tb_register.SubjectCode,
                                    tb_register.RegisterYear,
                                    tb_register.RegisterClass,
                                    tb_register.TeacherID,
                                    tb_subjects.SubjectName,
                                    tb_subjects.SubjectID,
                                    tb_subjects.SubjectUnit,
                                    tb_subjects.SubjectHour
                                ')
                                ->from('tb_register')
                                ->join('tb_subjects','tb_subjects.SubjectCode = tb_register.SubjectCode')
                                ->where('TeacherID',$this->session->userdata('login_id'))
                                ->group_by('tb_register.SubjectCode')
                                ->get()->result();
        
        //echo '<pre>'; print_r($data['check_subject']);exit();
        
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/register/SaveScore/SaveScoreMain.php');
        $this->load->view('teacher/layout/footer_teacher.php');        
    }

    public function SaveScoreAdd($term,$yaer,$subject){      
        $data['title']  = "บันทึกผลการเรียน";
        $data['teacher'] = $this->DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        
        $data['check_student'] = $this->db->select('
                                    tb_register.SubjectCode,
                                    tb_register.RegisterYear,
                                    tb_register.RegisterClass,
                                    tb_register.Score100,
                                    tb_register.TeacherID,
                                    tb_subjects.SubjectName,
                                    tb_subjects.SubjectID,
                                    tb_subjects.SubjectUnit,
                                    tb_subjects.SubjectHour,
                                    tb_students.StudentID,
                                    tb_students.StudentPrefix,
                                    tb_students.StudentFirstName,
                                    tb_students.StudentLastName,
                                    tb_students.StudentNumber,
                                    tb_students.StudentClass,
                                    tb_students.StudentCode
                                ')
                                ->from('tb_register')
                                ->join('tb_subjects','tb_subjects.SubjectCode = tb_register.SubjectCode')
                                ->join('tb_students','tb_students.StudentID = tb_register.StudentID')
                                ->where('TeacherID',$this->session->userdata('login_id'))
                                ->where('RegisterYear',$term.'/'.$yaer)
                                ->where('tb_register.SubjectCode',urldecode($subject))
                                ->order_by('tb_students.StudentClass','ASC')
                                ->order_by('tb_students.StudentNumber','ASC')
                                ->get()->result();
        $check_idSubject = $this->db->where('SubjectCode',urldecode($subject))->where('SubjectYear',$term.'/'.$yaer)->get('tb_subjects')->row();
        $data['set_score'] = $this->db->where('regscore_subjectID',$check_idSubject->SubjectID)->get('tb_register_score')->result();
        
      // echo '<pre>'; print_r($data['set_score']);exit();
        
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/register/SaveScore/SaveScoreAdd.php');
        $this->load->view('teacher/layout/footer_teacher.php');        
    }

    public function insert_score(){ 

        foreach ($this->input->post('StudentID') as $key => $value) {
            // print_r($value);
            // print_r($this->input->post('SubjectCode'));
            // print_r($this->input->post('RegisterYear'));
            // print_r(implode("|",$this->input->post($value)));
            $key = array('StudentID' => $value,'SubjectCode' => $this->input->post('SubjectCode'), 'RegisterYear' => $this->input->post('RegisterYear'));
            $data = array('Score100' => implode("|",$this->input->post($value)));
            echo $this->db->update('tb_register',$data,$key);
        }
        
        
    }

    public function setting_score($key){      
       

        if($key == "form_insert_score"){
            $list = array('before_middle','test_midterm','after_midterm','final_exam');
            $score = array('before_middle_score','test_midterm_score','after_midterm_score','final_exam_score');
            for ($i=0; $i <= 3 ; $i++) { 
                $data = array('regscore_subjectID' => $this->input->post("regscore_subjectID"),
                'regscore_namework' => $this->input->post($list[$i]),
                'regscore_score' => $this->input->post($score[$i]) ); 
                $this->db->insert('tb_register_score',$data);           
            }
            echo 1;
        }elseif($key == "form_update_score"){
            $list = array('before_middle','test_midterm','after_midterm','final_exam');
            $score = array('before_middle_score','test_midterm_score','after_midterm_score','final_exam_score');
            for ($i=0; $i <= 3 ; $i++) { 
                $data = array(
                    'regscore_score' => $this->input->post($score[$i]) 
                ); 
                $uplist = array('regscore_namework' => $this->input->post($list[$i]),
                              'regscore_subjectID' =>$this->input->post("regscore_subjectID"));
                $this->db->update('tb_register_score',$data,$uplist);           
            }
            echo 1;
        }
       
    }
    
    public function edit_score(){  
        $edit_score = $this->db->where('regscore_subjectID',$this->input->post('subid'))->get('tb_register_score')->result();
        if($edit_score){
            echo json_encode($edit_score);
        }else{
            echo 0;
        }
        
    }

}


?>