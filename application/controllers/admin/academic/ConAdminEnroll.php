<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConAdminEnroll extends CI_Controller {
var  $title = "แผงควบคุม";
	public function __construct() {
        parent::__construct();
        $this->load->model('admin/ModAdminAcademinResult');
		
		if (empty($this->session->userdata('fullname'))) {		
			redirect('LoginAdmin','refresh');
		}
        $this->DBPers = $this->load->database('personnel', TRUE);

        $data['check_status'] = $this->db->where('admin_rloes_userid',$this->session->userdata('login_id'))->get('tb_admin_rloes')->row();
        if(@$data['check_status']->admin_rloes_status == "admin" || @$data['check_status']->admin_rloes_status == "manager"){
            
        }else{
            $this->session->set_flashdata(array('msg'=>'OK','messge'=> 'คุณไม่มีสิทธ์ในระบบจัดข้อมูลนี้ ติดต่อเจ้าหน้าที่คอม','alert'=>'error'));
            redirect('welcome','refresh');
        }
    }

    public function AdminEnrollMain(){   
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['admin'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $data['title'] = "หน้าหลัก | ลงทะเบียนเรียน";	

        $data['GroupYear'] = $this->db->select('SubjectYear')->group_by('SubjectYear')->order_by('SubjectYear','ASC')->get('tb_subjects')->result();

        //echo "<pre>"; print_r($data['GroupYear']); exit();

        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminEnroll/AdminEnrollMain.php');
        $this->load->view('admin/layout/Footer.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }

    public function AdminEnrollAdd($Term,$Year){
        $data['title'] = "เพิ่มรายชื่อการลงทะเบียนเรียน";
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $DBpersonnel = $this->load->database('personnel', TRUE);
        $CheckYear = $this->db->get('tb_schoolyear')->result();
        $data['teacher'] = $DBpersonnel->select('pers_id,pers_img,pers_prefix,pers_firstname,pers_lastname')
        ->where('pers_learning !=',"")
        ->get('tb_personnel')->result();
        $data['subject'] = $this->db->where('SubjectYear',$Term.'/'.$Year)->get('tb_subjects')->result();
        
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminEnroll/AdminEnrollFormAdd.php');
        $this->load->view('admin/layout/Footer.php');
    }

    public function AdminEnrollEdit($codeSub,$TeachID){
        $data['title'] = "แก้ไขรายชื่อการลงทะเบียนเรียน";
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $DBpersonnel = $this->load->database('personnel', TRUE);
        $CheckYear = $this->db->get('tb_schoolyear')->result();
        $data['teacher'] = $DBpersonnel->select('pers_id,pers_img,pers_prefix,pers_firstname,pers_lastname')
                                        ->where('pers_learning !=',"")
                                        ->get('tb_personnel')->result();
        $data['Register'] = $this->db->select("tb_register.RegisterYear,
                                    tb_subjects.SubjectName,
                                    tb_subjects.SubjectID,
                                    tb_register.SubjectCode,
                                    tb_register.StudentID,
                                    tb_register.TeacherID,
                                    tb_students.StudentCode,
                                    tb_students.StudentClass,
                                    tb_students.StudentNumber,
                                    tb_students.StudentPrefix,
                                    tb_students.StudentFirstName,
                                    tb_students.StudentLastName   
                                    ")
                                    ->from('tb_register')
                                    ->join('tb_subjects', 'tb_subjects.SubjectCode = tb_register.SubjectCode')
                                    ->join('tb_students', 'tb_students.StudentID = tb_register.StudentID')
                                    //->where('RegisterYear',$CheckYear[0]->schyear_year) 
                                    ->where('TeacherID',$TeachID)
                                    ->where('SubjectID',$codeSub)
                                    ->get()->result();

        
      
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminEnroll/AdminEnrollFormEdit.php');
        $this->load->view('admin/layout/Footer.php');
    }

    public function AdminEnrollDelete($codeSub,$TeachID){
        $data['title'] = "ถอนรายชื่อการลงทะเบียนเรียน";
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
$data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $DBpersonnel = $this->load->database('personnel', TRUE);
        $CheckYear = $this->db->get('tb_schoolyear')->result();
        $data['teacher'] = $DBpersonnel->select('pers_id,pers_img,pers_prefix,pers_firstname,pers_lastname')
                                        ->where('pers_learning !=',"")
                                        ->get('tb_personnel')->result();

        $data['Register'] = $this->db->select("tb_register.RegisterYear,
                                    tb_subjects.SubjectName,
                                    tb_subjects.SubjectID,
                                    tb_register.SubjectCode,
                                    tb_register.StudentID,
                                    tb_register.TeacherID,
                                    tb_students.StudentCode,
                                    tb_students.StudentClass,
                                    tb_students.StudentNumber,
                                    tb_students.StudentPrefix,
                                    tb_students.StudentFirstName,
                                    tb_students.StudentLastName   
                                    ")
                                    ->from('tb_register')
                                    ->join('tb_subjects', 'tb_subjects.SubjectCode = tb_register.SubjectCode')
                                    ->join('tb_students', 'tb_students.StudentID = tb_register.StudentID')
                                    //->where('RegisterYear',$CheckYear[0]->schyear_year) 
                                    ->where('TeacherID',$TeachID)
                                    ->where('SubjectID',$codeSub)
                                    ->get()->result();
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminEnroll/AdminEnrollFormDelete.php');
        $this->load->view('admin/layout/Footer.php');
    }

    public function AdminEnrollSelect(){

        $subject = $this->db->select('StudentID,StudentNumber,StudentCode,StudentPrefix,StudentFirstName,StudentLastName,StudentClass')
                            ->where('StudentClass','ม.'.$this->input->post('KeyRoom'))
                            ->where('StudentStatus','1/ปกติ')
                            ->order_by('StudentNumber')
                            ->get('tb_students')->result();
       
        echo json_encode($subject);
        
    }

    public function AdminEnrollShow(){
        $CheckYear = $this->db->get('tb_schoolyear')->result();
        $Register = $this->db->select("tb_register.RegisterYear,
                                    tb_subjects.SubjectName,
                                    tb_subjects.SubjectID,
                                    tb_register.SubjectCode,
                                    tb_register.StudentID,
                                    tb_register.TeacherID,
                                    tb_students.StudentCode,
                                    tb_students.StudentClass,
                                    tb_students.StudentNumber,
                                    tb_students.StudentPrefix,
                                    tb_students.StudentFirstName,
                                    tb_students.StudentLastName,                                    
                                    skjacth_personnel.tb_personnel.pers_firstname,
                                    skjacth_personnel.tb_personnel.pers_prefix,
                                    skjacth_personnel.tb_personnel.pers_lastname   
                                    ")
                                    ->from('tb_register')
                                    ->join('tb_subjects', 'tb_subjects.SubjectCode = tb_register.SubjectCode')
                                    ->join('tb_students', 'tb_students.StudentID = tb_register.StudentID')
                                    ->join('skjacth_personnel.tb_personnel', 'skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_register.TeacherID')
                                    ->where('RegisterYear',$this->input->post('yearid')) 
                                    ->where('TeacherID',$this->input->post('teachid'))
                                    ->where('SubjectID',$this->input->post('subid'))
                                    ->order_by('StudentClass')
                                    ->order_by('StudentNumber')                                    
                                    ->get()->result();
        //print_r($Register) ; //subid

        echo json_encode($Register);

    }

    public function AdminEnrollInsert(){

       $chk_Subject = $this->db->where('SubjectID',$this->input->post('subjectregis'))->get('tb_subjects')->result();       
       print_r($chk_Subject[0]->SubjectCode);
       print_r($chk_Subject[0]->SubjectYear);
       print_r($chk_Subject[0]->SubjectClass);
       print_r($this->input->post('teacherregis'));
       print_r($this->input->post('to'));
        
       foreach ($this->input->post('to') as $key => $value) {
        $a =  array('StudentID' => $value,
        'SubjectCode' => $chk_Subject[0]->SubjectCode,
        'RegisterYear' => $chk_Subject[0]->SubjectYear,
        'RegisterClass' => $chk_Subject[0]->SubjectClass,
        'TeacherID' => $this->input->post('teacherregis')
        );   
        echo $data = $this->db->insert('tb_register',$a);
       }     
    }

    public function AdminEnrollUpdate(){

        $chk_Subject = $this->db->where('SubjectID',$this->input->post('subjectregisupdate'))->get('tb_subjects')->result();

        foreach ($this->input->post('to') as $key => $value) {
         $a =  array('StudentID' => $value,
         'SubjectCode' => $chk_Subject[0]->SubjectCode,
         'RegisterYear' => $chk_Subject[0]->SubjectYear,
         'RegisterClass' => $chk_Subject[0]->SubjectClass,
         'TeacherID' => $this->input->post('teacherregis')
         );   
         echo $data = $this->db->insert('tb_register',$a);
        }     
     }

     public function AdminEnrollDel(){

        $chk_Subject = $this->db->where('SubjectID',$this->input->post('subjectregisupdate'))->get('tb_subjects')->result();

        foreach ($this->input->post('to') as $key => $value) {
         $a =  array('StudentID' => $value,
         'SubjectCode' => $chk_Subject[0]->SubjectCode,
         'RegisterYear' => $chk_Subject[0]->SubjectYear,
         'RegisterClass' => $chk_Subject[0]->SubjectClass,
         'TeacherID' => $this->input->post('teacherregis')
         );   
             $this->db->where($a);
        echo $this->db->delete('tb_register');
        }     
     }

    public function AdminEnrollSubject(){ 
        $CheckYear = $this->db->get('tb_schoolyear')->result();
        $data = [];
        $keyYear = $this->input->post('keyYear');
        //$subject = $this->db->where('SubjectYear','1/2565')->get('tb_subjects')->result();
       
        $Register = $this->db->select("
                                    skjacth_academic.tb_register.SubjectCode,
                                    skjacth_academic.tb_subjects.SubjectName,
                                    skjacth_academic.tb_subjects.FirstGroup,
                                    skjacth_academic.tb_register.RegisterClass,
                                    skjacth_academic.tb_register.TeacherID,
                                    skjacth_academic.tb_subjects.SubjectID,
                                    skjacth_academic.tb_subjects.SubjectYear,
                                    skjacth_personnel.tb_personnel.pers_firstname,
                                    skjacth_personnel.tb_personnel.pers_prefix,
                                    skjacth_personnel.tb_personnel.pers_lastname")
                                ->from('tb_register')
                                ->join('tb_subjects', 'tb_subjects.SubjectCode = tb_register.SubjectCode')
                                ->join('skjacth_personnel.tb_personnel', 'skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_register.TeacherID')
                                ->where('tb_subjects.SubjectYear',$keyYear)
                                ->group_by('SubjectCode')
                                ->group_by('RegisterClass')
                                ->get()->result();

        //echo '<pre>'; print_r($Register);   exit();    

        foreach($Register as $record){
            
            $data[] = array( 
                "SubjectYear" => $record->SubjectYear,
                "SubjectCode" => $record->SubjectCode,
                "SubjectName" => $record->SubjectName,
                "FirstGroup" => $record->FirstGroup,
                "SubjectClass" => $record->RegisterClass,
                "SubjectID" => $record->SubjectID,
                "TeacherName" =>  $record->pers_prefix.$record->pers_firstname.' '.$record->pers_lastname,
                "TeacherID" => $record->TeacherID
            );
           
        }   

        $output = array(
            "data" =>  $data
        );

      
      
       echo json_encode($output);
    }

    public function AdminEnrollCancel(){

      
         $a =  array(
         'SubjectCode' => $this->input->post('KeySubject'),
         'TeacherID' => $this->input->post('KeyTeacher')
         );   
             $this->db->where($a);
        echo $this->db->delete('tb_register');
            
     }

}


?>
