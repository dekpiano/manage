<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConAdminExtraSubject extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('admin/ModAdminExtraSubject');
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

    public function index(){   

        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['admin'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
$data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
		$data['title'] = "ลงทะเบียนวิชาเพิ่มเติม";
        $ExtraSetting = $this->db->get('tb_extra_setting')->result();
        $data['ExtraSubject'] = $this->db->where('extra_year',$ExtraSetting[0]->extra_setting_year)
                                        ->where('extra_term',$ExtraSetting[0]->extra_setting_term)
                                        ->get('tb_extra_subject')->result();
        $data['CountStudentRegister'] = $this->db->select('tb_extra_register.fk_std_id,
                                                        COUNT(tb_extra_register.fk_std_id) AS CountAll,
                                                        tb_extra_register.fk_extra_id
                                                        ')->group_by('tb_extra_register.fk_extra_id')
                                                        ->get('tb_extra_register')->result();
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
        $this->load->view('admin/Academic/AdminExtraSubject/AdminExtraSubjectMain.php');
        $this->load->view('admin/layout/Footer.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }
    
    public function AddExtraSubject(){   
        //print_r(implode("|",$this->input->post('extra_grade_level'))); exit();
        $dataExtraSubject = array('extra_year'=>$this->input->post('extra_year'),
                                'extra_term'=>$this->input->post('extra_term'),
                                'extra_key_room'=>$this->input->post('extra_key_room'),
                                'extra_course_code'=>$this->input->post('extra_course_code'),
                                'extra_course_name'=>$this->input->post('extra_course_name'),
                                'extra_course_teacher'=>$this->input->post('extra_course_teacher'),
                                'extra_grade_level'=>implode("|",$this->input->post('extra_grade_level')),
                                'extra_number_students'=>$this->input->post('extra_number_students'),
                                'extra_comment'=>$this->input->post('extra_comment')
                            );
        print_r($this->ModAdminExtraSubject->ExtraSubject_Add($dataExtraSubject));
    }

    public function EditExtraSubject(){         
        $re = $this->db->where('extra_id', $this->input->post('Extraid'))->get('tb_extra_subject')->result();
        echo json_encode($re);
    }

    public function UpdateExtraSubject(){ 
             
        $dataExtraSubject = array('extra_year'=>$this->input->post('extra_year'),
                                'extra_term'=>$this->input->post('extra_term'),
                                'extra_key_room'=>$this->input->post('extra_key_room'),
                                'extra_course_code'=>$this->input->post('extra_course_code'),
                                'extra_course_name'=>$this->input->post('extra_course_name'),
                                'extra_course_teacher'=>$this->input->post('extra_course_teacher'),
                                'extra_grade_level'=>implode("|",$this->input->post('extra_grade_level')),
                                'extra_number_students'=>$this->input->post('extra_number_students'),
                                'extra_comment'=>$this->input->post('extra_comment')
                            );
        print_r($this->ModAdminExtraSubject->ExtraSubject_Update($dataExtraSubject,$this->input->post('extra_id')));
    }

    // ------------------ ตั้งค่าระบบ ---------------------------
    public function SystemMainExtraSubject(){ 

        $data['title'] = "ตั้งค่าระบบ";
        $data['OnoffSystem'] = $this->db->get('tb_extra_setting')->result();
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminExtraSubject/AdminExtraSystemMain.php');
        $this->load->view('admin/layout/Footer.php');

    }

    public function ExtraSettingOnoff() {
        $data = array('extra_setting_onoff' =>$this->input->post('onoff') );
        $result = $this->db->update('tb_extra_setting',$data,'extra_setting_id=1');
        echo $result;
    }

    public function ExtraSettingTerm() {
        $data = array('extra_setting_term' => $this->input->post('Term'));
        $result = $this->db->update('tb_extra_setting',$data,'extra_setting_id=1');
        if($result == 1){
            echo $this->input->post('Term');
        }else{
            echo 0;
        }
    }

    public function ExtraSettingYear() {
        $data = array('extra_setting_year' => $this->input->post('Year'));
        $result = $this->db->update('tb_extra_setting',$data,'extra_setting_id=1');
        if($result == 1){
            echo $this->input->post('Year');
        }else{
            echo 0;
        }
    }

    public function ExtraSettingDateStart() {
       // echo $this->input->post('DateStart'); exit();
        $data = array('extra_setting_datestart' => $this->input->post('DateStart'));
        $result = $this->db->update('tb_extra_setting',$data,'extra_setting_id=1');
        if($result == 1){
            echo date('d-m-Y H:i', strtotime($this->input->post('DateStart')));
        }else{
            echo 0;
        }
    }

    public function ExtraSettingDateEnd() {
        // echo $this->input->post('DateStart'); exit();
         $data = array('extra_setting_dateend' => $this->input->post('DateEnd'));
         $result = $this->db->update('tb_extra_setting',$data,'extra_setting_id=1');
         if($result == 1){
             echo date('d-m-Y H:i', strtotime($this->input->post('DateEnd')));
         }else{
             echo 0;
         }
     }

     public function ExtraReport() {
        $data['title'] = "รายงาน";
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
$data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $ExtraSetting = $this->db->get('tb_extra_setting')->result();
        $data['OnoffSystem'] = $this->db->get('tb_extra_setting')->result();
        $data['Report'] = $this->db->select('tb_extra_subject.extra_year,
                                                tb_extra_subject.extra_term,
                                                tb_extra_subject.extra_course_name,
                                                tb_extra_subject.extra_course_code,
                                                tb_extra_subject.extra_course_teacher,
                                                tb_extra_register.fk_std_id,
                                                tb_extra_register.fk_extra_id,
                                                tb_extra_register.regis_ex_id,
                                                tb_extra_register.regis_ex_datecreated,
                                                tb_student_express.StudentPrefix,
                                                tb_student_express.StudentFirstName,
                                                tb_student_express.StudentLastName,
                                                tb_student_express.StudentNumber,
                                                tb_student_express.StudentClass')
                                        ->from('tb_extra_register') 
                                        ->join('tb_extra_subject','tb_extra_subject.extra_id = tb_extra_register.fk_extra_id')   
                                        ->join('tb_student_express','tb_student_express.StudentCode = tb_extra_register.fk_std_id')   
                                        ->where('extra_year',$ExtraSetting[0]->extra_setting_year)
                                        ->where('extra_term',$ExtraSetting[0]->extra_setting_term)
                                        ->get()->result();
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminExtraSubject/AdminExtraReport.php');
        $this->load->view('admin/layout/Footer.php');
     }



}


?>
