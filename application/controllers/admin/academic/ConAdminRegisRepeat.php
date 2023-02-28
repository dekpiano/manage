<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConAdminRegisRepeat extends CI_Controller {
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

    public function AdminRegisRepeatMain(){   
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['admin'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $data['title'] = "ลงทะเบียนเรียน (ซ้ำ)";	

        $data['GroupYear'] = $this->db->select('SubjectYear')->group_by('SubjectYear')->order_by('SubjectYear','ASC')->get('tb_subjects')->result();

        //echo "<pre>"; print_r($data['GroupYear']); exit();

        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminRegisRepeat/AdminRegisRepeatMain.php');
        $this->load->view('admin/layout/Footer.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }

    public function AdminRegisRepeatDetail($Term,$Year,$IDSubject){
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['admin'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $data['title'] = "ลงทะเบียนเรียนซ้ำนักเรียนรายวิชา";

        $data['DataRepeat'] = $this->db->select("
        tb_students.StudentID,
        tb_students.StudentPrefix,
        tb_students.StudentFirstName,
        tb_students.StudentLastName,
        tb_students.StudentClass,
        tb_students.StudentCode,
        tb_students.StudentNumber,
        tb_subjects.SubjectName,
        tb_subjects.SubjectYear,
        tb_register.SubjectCode,
        tb_register.RegisterYear,
        tb_register.Grade,
        tb_register.Grade_Type")
        ->from('tb_register')
        ->join('tb_subjects', 'tb_subjects.SubjectCode = tb_register.SubjectCode')
        ->join('tb_students', 'tb_students.StudentID = tb_register.StudentID')
        ->where('tb_register.RegisterYear',$Term.'/'.$Year)
        ->where('tb_subjects.SubjectYear',$Term.'/'.$Year)
        ->where('tb_register.SubjectCode',urldecode($IDSubject))
        ->order_by('StudentClass','ASC')
        ->order_by('StudentNumber','ASC')
        ->get()->result();

        

        //echo '<pre>'; print_r($data['DataRepeat']); exit();

        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminRegisRepeat/AdminRegisRepeatAdd.php');
        $this->load->view('admin/layout/Footer.php');
    }

    public function AdminRegisRepeatAdd(){
        $data['title'] = "เพิ่มรายชื่อการลงทะเบียนเรียน";
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $DBpersonnel = $this->load->database('personnel', TRUE);
        $CheckYear = $this->db->get('tb_schoolyear')->result();

        $CheckRepeat = $this->db->select('onoff_detail')->where('onoff_name','เรียนซ้ำ')->get('tb_register_onoff')->result();
        
        $CheckStudent = $this->db->select('StudentID')
        ->where('RegisterYear',$this->input->post('YearRepeat'))
        ->where('SubjectCode',$this->input->post('SubjectRepeat'))
        ->get('tb_register')->result();   

        $IdStuRepeat = array();
        $CountUpSucceed =0;

        if($this->input->post('SelRepeat')){        
            foreach ($this->input->post('SelRepeat') as $key => $value) {
                array_push($IdStuRepeat,$value);
            }
            foreach ($CheckStudent as $key => $v_CheckStudent) {
                if(in_array($v_CheckStudent->StudentID,$IdStuRepeat)){
                     $DataUpdateRepeat = array('Grade_Type' => $CheckRepeat[0]->onoff_detail);
                     $this->db->where('RegisterYear',$this->input->post('YearRepeat'));
                     $this->db->where('SubjectCode',$this->input->post('SubjectRepeat'));
                     $this->db->where('StudentID',$v_CheckStudent->StudentID);
                    $CountUpSucceed += $this->db->update('tb_register',$DataUpdateRepeat);
                }else{
                    $DataUpdateRepeat = array('Grade_Type' => "");
                    $this->db->where('RegisterYear',$this->input->post('YearRepeat'));
                    $this->db->where('SubjectCode',$this->input->post('SubjectRepeat'));
                    $this->db->where('StudentID',$v_CheckStudent->StudentID);
                   $CountUpSucceed += $this->db->update('tb_register',$DataUpdateRepeat);
                }
            }
        }else{
                 $DataUpdateRepeat = array('Grade_Type' => "");
                 $this->db->where('RegisterYear',$this->input->post('YearRepeat'));
                 $this->db->where('SubjectCode',$this->input->post('SubjectRepeat'));
                $CountUpSucceed += $this->db->update('tb_register',$DataUpdateRepeat);
           
             
        }
       
        if($CountUpSucceed > 0){
            echo "สำเร็จ";
        }else{
            echo 0;
        }

      
      
        // $this->load->view('admin/layout/Header.php',$data);
        // $this->load->view('admin/Academic/AdminRegisRepeat/AdminRegisRepeatAdd.php');
        // $this->load->view('admin/layout/Footer.php');
    }

    public function AdminRegisRepeatEdit($codeSub,$TeachID){
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
        $this->load->view('admin/Academic/AdminRegisRepeat/AdminRegisRepeatFormEdit.php');
        $this->load->view('admin/layout/Footer.php');
    }

    public function AdminRegisRepeatDelete($codeSub,$TeachID){
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
        $this->load->view('admin/Academic/AdminRegisRepeat/AdminRegisRepeatFormDelete.php');
        $this->load->view('admin/layout/Footer.php');
    }

    public function AdminRegisRepeatSelect(){

        $subject = $this->db->select('StudentID,StudentNumber,StudentCode,StudentPrefix,StudentFirstName,StudentLastName,StudentClass')
                            ->where('StudentClass','ม.'.$this->input->post('KeyRoom'))
                            ->where('StudentStatus','1/ปกติ')
                            ->order_by('StudentNumber')
                            ->get('tb_students')->result();
       
        echo json_encode($subject);
        
    }

    public function AdminRegisRepeatShow1(){
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
                                    //->where('RegisterYear',$CheckYear[0]->schyear_year) 
                                    ->where('TeacherID',$this->input->post('teachid'))
                                    ->where('SubjectID',$this->input->post('subid'))
                                    ->order_by('StudentClass')
                                    ->order_by('StudentNumber')                                    
                                    ->get()->result();
        //print_r($Register) ; //subid

        echo json_encode($Register);

    }

    public function AdminRegisRepeatInsert(){

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

    public function AdminRegisRepeatUpdate(){

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

     public function AdminRegisRepeatDel(){

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

    public function AdminRegisRepeatShow(){ 
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
                                ->where('tb_register.RegisterYear',$keyYear)
                                ->where('tb_subjects.SubjectYear',$keyYear)
                                ->group_by('SubjectCode')
                                ->group_by('TeacherID')
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

    public function AdminRegisRepeatCancel(){

      
         $a =  array(
         'SubjectCode' => $this->input->post('KeySubject'),
         'TeacherID' => $this->input->post('KeyTeacher')
         );   
             $this->db->where($a);
        echo $this->db->delete('tb_register');
            
     }

}


?>
