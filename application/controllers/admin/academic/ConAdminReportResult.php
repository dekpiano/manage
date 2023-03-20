<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConAdminReportResult extends CI_Controller {
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

    function getClient()
    {
        require_once APPPATH. '../vendor/google_sheet/vendor/autoload.php';
    
        // configure the Google Client
        $client = new \Google_Client();
        $client->setApplicationName('Google Sheets API');
        $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $client->setAccessType('offline');
        // credentials.json is the key file we downloaded while setting up our Google Sheets API
        $path = 'service_key.json';
        $client->setAuthConfig($path);

        // configure the Sheets Service
        $service = new \Google_Service_Sheets($client);
         
        return $service;
    }

    public function AdminReportPersonMain(){   
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['admin'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $data['stu'] = $this->db->select("tb_students.StudentID,
                                    tb_students.StudentNumber,
                                    tb_students.StudentClass,
                                    tb_students.StudentCode,
                                    tb_students.StudentPrefix,
                                    tb_students.StudentFirstName,
                                    tb_students.StudentLastName,
                                    tb_students.StudentStatus")
                            ->where('StudentStatus','1/ปกติ')
                            ->get('tb_students')->result();
        //echo '<pre>'; print_r($stu); exit();
        $data['title'] = "รายงานผลการเรียนรายบุคคล";

        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminReportResults/AdminReportPersonMain.php');
        $this->load->view('admin/layout/Footer.php');
        
    }

    public function AdminReportTeacherSaveScoreMain($Term,$year){   
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $data['Teacher'] = $DBpersonnel->select('
        skjacth_personnel.tb_personnel.pers_prefix,
        skjacth_personnel.tb_personnel.pers_firstname,
        skjacth_personnel.tb_personnel.pers_lastname,
        skjacth_personnel.tb_personnel.pers_id,
        skjacth_personnel.tb_personnel.pers_learning,
        skjacth_personnel.tb_personnel.pers_position,
        skjacth_skj.tb_position.posi_name,
        skjacth_skj.tb_learning.lear_namethai,
        skjacth_personnel.tb_personnel.pers_status')
        ->from('skjacth_personnel.tb_personnel')
        ->join('skjacth_skj.tb_position','skjacth_skj.tb_position.posi_id = skjacth_personnel.tb_personnel.pers_position')
        ->join('skjacth_skj.tb_learning','skjacth_skj.tb_learning.lear_id = skjacth_personnel.tb_personnel.pers_learning')
        //->where('pers_id',$this->session->userdata('login_id'))
        ->get()->result();
        $data['CheckYearSaveScore'] = $this->db->select('RegisterYear')->group_by('RegisterYear')->get('tb_register')->result();
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $data['Term'] = $Term;
        $data['Year'] = $year;       
        //echo '<pre>'; print_r($data['CheckYearSaveScore']); exit();
        $data['title'] = "รายงานผลการบันทึกคะแนนครูผู้สอน";

        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminReportResults/AdminReportTeacherSaveScoreMain.php');
        $this->load->view('admin/layout/Footer.php');
        
    }

    public function AdminReportTeacherSaveScoreCheck($Term,$year,$TeacID){  
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $data['Teacher'] = $DBpersonnel->select('pers_prefix,pers_firstname,pers_lastname')
        ->where('pers_id',$TeacID)
        ->get('tb_personnel')->row();

        $data['title'] = "รายงานผลการบันทึกคะแนนของ".$data['Teacher']->pers_prefix.$data['Teacher']->pers_firstname.' '.$data['Teacher']->pers_lastname.' ปีการศึกษา '.$Term.'/'.$year; 

        $data['checkSubject'] = $this->db->select('
        tb_register.SubjectCode,
        tb_subjects.SubjectName')
        ->from('tb_register')
        ->join('tb_subjects','tb_subjects.SubjectCode = tb_register.SubjectCode')
        ->where('TeacherID',$TeacID)
        ->where('RegisterYear',$Term.'/'.$year)
        ->group_by('SubjectCode')
        ->get()->result();
        
        //echo '<pre>'; print_r($data['checkSubject']); exit();

        $data['CheckScore'] = $this->db->select('
        tb_register.SubjectCode,
        tb_register.Score100,
        tb_register.RegisterYear,
        tb_register.RegisterClass,
        tb_register.TeacherID,
        tb_register.StudentID,
        tb_students.StudentClass,
        tb_students.StudentPrefix,
        tb_students.StudentFirstName,
        tb_students.StudentLastName,
        tb_students.StudentCode,
        tb_students.StudentNumber,
        tb_students.StudentBehavior
        ')->from('tb_register')
        ->join('tb_students','tb_students.StudentID = tb_register.StudentID')
        ->where('tb_register.RegisterYear',$Term.'/'.$year)
        ->where('tb_register.TeacherID',$TeacID)
        ->order_by('StudentClass','ASC')
        ->order_by('StudentNumber','ASC')
        ->get()->result();
        
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $data['Term'] = $Term;
        $data['Year'] = $year;
        
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminReportResults/AdminReportTeacherSaveScoreCheck.php');
        $this->load->view('admin/layout/Footer.php');

    }

    public function AdminReportRoomMain(){   
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $data['admin'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        $data['CheckYear'] = $this->db->select('RegisterYear')->group_by('RegisterYear')->get('tb_register')->result();
        $keyroom = $this->input->post("keyroom");
        $SubRoom1 = explode('.',$keyroom);
        $SubRoom2 = explode('/',@$SubRoom1[1]);        
        $KeyCheckYear = $this->input->post("KeyCheckYear");
        $SubKeyCheckYear = explode('/',$KeyCheckYear);
        $Term = @$SubKeyCheckYear[0];
        $year = @$SubKeyCheckYear[1];
        $Class = @$SubRoom2[0];
        $Room = @$SubRoom2[1];
        if(!isset($keyroom)){
            $data["Nodata"] = 0;
            $data['totip'] = "";
            $data['keyroom'] = '';
            $data['KeyCheckYear'] = $KeyCheckYear;
        }else{
            $data["Nodata"] = 1;
            $data['keyroom'] = $keyroom;
            $data['KeyCheckYear'] = $KeyCheckYear;
            $data['totip'] = "ระดับชั้น ".$keyroom;
            
            $data['stu'] = $this->db->select("tb_students.StudentID,
                                    tb_students.StudentNumber,
                                    tb_students.StudentClass,
                                    tb_students.StudentCode,
                                    tb_students.StudentPrefix,
                                    tb_students.StudentFirstName,
                                    tb_students.StudentLastName")
                            ->where('StudentStatus','1/ปกติ')
                            ->where('StudentClass',$keyroom)     
                            ->order_by('tb_students.StudentNumber','ASC')
                            ->get('tb_students')->result();

            $data['subject'] = $this->db->select("
                            tb_register.SubjectCode,
                            tb_subjects.SubjectName,
                            tb_subjects.SubjectUnit")
                    ->from('tb_register')
                    ->join('tb_students','tb_students.StudentID = tb_register.StudentID')
                    ->join('tb_subjects','tb_subjects.SubjectCode = tb_register.SubjectCode')
                    ->where('RegisterYear',$KeyCheckYear)
                    ->where('StudentStatus','1/ปกติ')
                    ->where('StudentClass',$keyroom)                                
                    ->where('tb_register.SubjectCode !=','I30301')
                    ->where('tb_register.SubjectCode !=','I20201')
                    ->group_by('tb_register.SubjectCode')                                
                    ->get()->result();

                            $CheckSub = [];
                            foreach ($data['stu'] as $key => $value) {
                                
                                $CheckSub[$key][] = $value->StudentID;
                                $CheckSub[$key][] = $value->StudentNumber;
                                $CheckSub[$key][] = $value->StudentPrefix.$value->StudentFirstName.' '.$value->StudentLastName;
                                $CheckSub[$key][] = $value->StudentCode;
                    
                    
                                $check_sub = array();
                                $da = $this->CheckData($Term,$year,$Class,$Room,$value->StudentID);
                                    foreach ($da as $key22 => $v_da) {
                                        $check_sub[] = $v_da->SubjectCode;
                                    }
                                   // echo '<pre>'; print_r($check_sub);
                    
                                 foreach ($data['subject'] as $key1 => $v_Check) {
                                   // echo array_search($v_Check->SubjectCode, $check_sub);
                                    if(array_search($v_Check->SubjectCode, $check_sub) >= 0){
                                        $dat = $this->CheckValue($Term,$year,$Class,$Room,$value->StudentID,$v_Check->SubjectCode);
                                       
                                        $CheckSub[$key][] = $v_Check->SubjectCode.'/'.@$dat[0]->Grade;
                                    }else{
                                        $CheckSub[$key][] = $v_Check->SubjectCode.'/';
                                    }
                                   
                                }
                               
                            }
                    
                            $data['CheckSub'] = $CheckSub;

                           // echo '<pre>';print_r($CheckSub); exit();   
                                


        }
        
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $data['title'] = "รายงานผลการเรียนรายห้องเรียน";

        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminReportResults/AdminReportRoomMain.php');
        $this->load->view('admin/layout/Footer.php');
        
    }

    public function AdminStudentsScore($IdStudent){      
        $data['title'] = "ผลการเรียนนักเรียนรายบุคคล";
        $data['ExtraSetting'] = $this->db->get('tb_extra_setting')->result();
        $data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $data['scoreYear'] = $this->db->select('
                                    tb_register.RegisterClass,
                                    tb_register.RegisterYear,
                                    tb_register.StudentID
                                    ')
                                    ->from('tb_register')
                                    ->where('StudentID',$IdStudent)
                                    ->group_by('tb_register.RegisterYear')
                                    ->order_by('tb_register.RegisterClass asc','tb_register.RegisterYear asc')
                                    ->get()->result();
         //echo '<pre>';print_r($data['scoreYear']); exit();
        $data['scoreStudent'] = $this->db->select('tb_register.StudentID,
                                        tb_register.SubjectCode,
                                        tb_register.Score100,
                                        tb_register.Grade,
                                        tb_register.RegisterYear,
                                        tb_register.RegisterClass,
                                        tb_subjects.SubjectName,
                                        tb_subjects.SubjectUnit,
                                        tb_subjects.SubjectYear,
                                        tb_subjects.SubjectType,
                                        tb_subjects.FirstGroup')
                                    ->from('tb_register')
                                    ->join('tb_subjects', 'tb_register.SubjectCode = tb_subjects.SubjectCode')
                                    ->where('StudentID',$IdStudent)
                                    ->where('tb_register.SubjectCode !=','I30301')
                                    ->where('tb_register.SubjectCode !=','I20201')
                                    ->order_by('tb_subjects.SubjectType asc')
                                    ->order_by('tb_subjects.FirstGroup asc','tb_subjects.SubjectCode asc')
                                    ->get()->result();
        $data['stu'] =  $this->db->select('
                            StudentClass,
                            StudentCode,
                            StudentPrefix,
                            StudentFirstName,
                            StudentLastName 
                            ')
                            ->where('StudentID',$IdStudent)->get('tb_students')->row();
        $data['CheckOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        
        $this->load->helper('array');
        $service = $this->getClient();
        $spreadsheetId = '1eMgeASo3Vqxh8O0pERAJ0WO_9MLVx4wkuiJEFjquAfQ';
        
        $range_checkChunum = 'ชุมนุม!A3:F1000';  // TODO: Update placeholder value.
        $response_checkChunum = $service->spreadsheets_values->get($spreadsheetId, $range_checkChunum);
        $numRows_checkChunum = $response_checkChunum->getValues() != null ? count($response_checkChunum->getValues()) : 0;
       
        $range_ruksun = 'ลูกเสือ!A3:F1000';  // TODO: Update placeholder value.
        $response_ruksun = $service->spreadsheets_values->get($spreadsheetId, $range_ruksun);
        $numRows_ruksun = $response_ruksun->getValues() != null ? count($response_ruksun->getValues()) : 0;
      
       $checkChunum = [];
       foreach ($response_checkChunum->values as $key => $value) {
        $checkChunum[] = $value[1];
       }   
       $data['checkChunum']  = $checkChunum;
     
       $checkRuksun = [];
       foreach ($response_ruksun->values as $key => $value) {
        $checkRuksun[] = $value[1];
       }   
       $data['checkRuksun']  = $checkRuksun;
       $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminReportResults/AdminReportStudentsResult.php');
        $this->load->view('admin/layout/Footer.php');
              
    }

    public function AdminReportSummaryTeacher(){
        $DBSkj = $this->load->database('skj', TRUE);
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $data['title'] = "รายงานสรุปผลสัมฤทธิ์ทางการเรียน";
        $data['lern'] = $DBSkj->get('tb_learning')->result();

        $data['Keylern'] = $this->input->get('SelLern');
        //echo $date['Keylern']; exit();      
       
        $data['Showdata'] = $this->db->select('
                            COUNT(CASE WHEN tb_register.Grade = 4 then 1 else null end) AS G4_0,
                            COUNT(CASE WHEN tb_register.Grade = 3.5 then 1 else null end) AS G3_5,
                            COUNT(CASE WHEN tb_register.Grade = 3 then 1 else null end) AS G3_0,
                            COUNT(CASE WHEN tb_register.Grade = 2.5 then 1 else null end) AS G2_5,
                            COUNT(CASE WHEN tb_register.Grade = 2 then 1 else null end) AS G2_0,
                            COUNT(CASE WHEN tb_register.Grade = 1.5 then 1 else null end) AS G1_5,
                            COUNT(CASE WHEN tb_register.Grade = 1 then 1 else null end) AS G1_0,
                            COUNT(CASE WHEN tb_register.Grade = "0" then 1 else null end) AS G0,
                            COUNT(CASE WHEN tb_register.Grade = "ร" then 1 else null end) AS G_W,
                            COUNT(CASE WHEN tb_register.Grade = "มส" then 1 else null end) AS G_MS,
                            COUNT(skjacth_academic.tb_students.StudentClass) AS SumStu,
                            skjacth_academic.tb_students.StudentClass,
                            skjacth_academic.tb_students.StudentBehavior,
                            skjacth_academic.tb_register.RegisterYear,
                            skjacth_academic.tb_register.TeacherID,
                            skjacth_academic.tb_register.Grade,
                            skjacth_academic.tb_register.SubjectCode,
                            skjacth_personnel.tb_personnel.pers_prefix,
                            skjacth_personnel.tb_personnel.pers_firstname,
                            skjacth_personnel.tb_personnel.pers_lastname,
                            skjacth_personnel.tb_personnel.pers_learning,
                            skjacth_academic.tb_subjects.SubjectName,
                            skjacth_academic.tb_subjects.SubjectType,
                            skjacth_academic.tb_subjects.SubjectUnit                                                   
                            ')
                            ->from('skjacth_academic.tb_register')
                            ->join('skjacth_academic.tb_students','skjacth_academic.tb_students.StudentID = skjacth_academic.tb_register.StudentID')
                            ->join('skjacth_personnel.tb_personnel','skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_register.TeacherID')
                            ->join('skjacth_academic.tb_subjects','skjacth_academic.tb_subjects.SubjectCode = skjacth_academic.tb_register.SubjectCode')
                            ->where('RegisterYear','1/2565')
                            ->where('pers_learning',$data['Keylern'])
                            ->where('StudentBehavior','ปกติ')
                            ->group_by('tb_students.StudentClass,tb_register.SubjectCode')
                            ->order_by('TeacherID,StudentClass')
                            ->get()->result();        

        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminReportResults/AdminReportAcademicSummary.php');
        $this->load->view('admin/layout/Footer.php');

    }

    public function ReportScoreRoomMain($Term,$year,$Class,$Room){
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['title'] = "รายงานผลการบันทึกคะแนน (รายห้องเรียน)"; 
        $data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $data['Room'] = $this->classroom->ListRoom();

        $data['stu'] = $this->db->select('tb_students.StudentID,tb_students.StudentNumber,tb_students.StudentClass,tb_students.StudentCode,tb_students.StudentPrefix,tb_students.StudentFirstName,tb_students.StudentLastName,tb_register.Score100,tb_register.SubjectCode')
        ->from('tb_students')
        ->join('tb_register','tb_students.StudentID = tb_register.StudentID')
        ->where('tb_register.RegisterYear',$Term.'/'.$year) 
        ->where('tb_students.StudentStatus','1/ปกติ')
        ->where('tb_students.StudentClass','ม.'.$Class.'/'.$Room)        
        ->group_by('StudentCode') 
        ->order_by('tb_students.StudentNumber','ASC')
        ->get()->result();

        $data['RegisSubject'] = $this->db
        ->select('tb_register.SubjectCode,
        tb_subjects.SubjectName')
        ->from('tb_register')
        ->join('tb_students','tb_students.StudentID = tb_register.StudentID')
        ->join('tb_subjects','tb_subjects.SubjectCode = tb_register.SubjectCode')
        ->where('tb_register.RegisterYear',$Term.'/'.$year)  
        ->where('tb_students.StudentClass','ม.'.$Class.'/'.$Room)  
        ->order_by('SubjectCode','ASC')
        ->group_by('SubjectCode') 
        ->get()->result();
        
                  
        $CheckSub = [];
        foreach ($data['stu'] as $key => $value) {
            
            $CheckSub[$key][] = $value->StudentID;
            $CheckSub[$key][] = $value->StudentNumber;
            $CheckSub[$key][] = $value->StudentPrefix.$value->StudentFirstName.' '.$value->StudentLastName;
            $CheckSub[$key][] = $value->StudentCode;


            $check_sub = array();
            $da = $this->CheckData($Term,$year,$Class,$Room,$value->StudentID);
                foreach ($da as $key22 => $v_da) {
                    $check_sub[] = $v_da->SubjectCode;
                }
               // echo '<pre>'; print_r($check_sub);

             foreach ($data['RegisSubject'] as $key1 => $v_Check) {
               // echo array_search($v_Check->SubjectCode, $check_sub);
                if(array_search($v_Check->SubjectCode, $check_sub) >= 0){
                    $dat = $this->CheckValue($Term,$year,$Class,$Room,$value->StudentID,$v_Check->SubjectCode);
                   
                    $CheckSub[$key][] = $v_Check->SubjectCode.'/'.@$dat[0]->Score100;
                }else{
                    $CheckSub[$key][] = $v_Check->SubjectCode.'/';
                }
               
            }
           
        }

        $data['CheckSub'] = $CheckSub;
       //echo '<pre>'; print_r($data['CheckSub']);  exit();
        
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $data['Term'] = $Term;
        $data['Year'] = $year;
        
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminReportResults/AdminReportScoreRoomMain.php');
        $this->load->view('admin/layout/Footer.php');
    }

    public function CheckData($Term,$year,$Class,$Room,$IDstu){
        $Check = $this->db->select('
        tb_register.Score100,
        tb_register.SubjectCode,
        tb_students.StudentID
        ')
        ->from('tb_register')
        ->join('tb_students','tb_students.StudentID = tb_register.StudentID')
        ->where('tb_register.RegisterYear',$Term.'/'.$year) 
        ->where('tb_students.StudentClass','ม.'.$Class.'/'.$Room)
        ->where('tb_students.StudentID',$IDstu)
        ->order_by('SubjectCode','ASC')
        ->get()->result();

        return $Check;
    }

    public function CheckValue($Term,$year,$Class,$Room,$IDstu,$IDSubjuct){
        $Check = $this->db->select('
        tb_register.Score100,
        tb_register.SubjectCode,        
        tb_register.Grade,
        tb_students.StudentID
        ')
        ->from('tb_register')
        ->join('tb_students','tb_students.StudentID = tb_register.StudentID')
        ->where('tb_register.RegisterYear',$Term.'/'.$year) 
        ->where('tb_students.StudentClass','ม.'.$Class.'/'.$Room)
        ->where('tb_students.StudentID',$IDstu)
        ->where('tb_register.SubjectCode',$IDSubjuct)
        ->order_by('SubjectCode','ASC')
        ->get()->result();

        return $Check;
    }


    public function AdminReportEnrollMain(){
        $DBadmission = $this->load->database('admission', TRUE);      
        $data['title'] = "รายงานการรับสมัครนักเรียน"; 
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $data['SelYear'] = $DBadmission->select('recruit_year')->group_by('recruit_year')->get('tb_recruitstudent')->result();
        $data['CheckYearadmission'] = $DBadmission->select('openyear_year')->get('tb_openyear')->row();

        //echo '<pre>'; print_r($SelDataStudent);exit();
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminReportResults/AdminReportEnrollMain.php');
        $this->load->view('admin/layout/Footer.php');
    }

    public function AdminReportEnrollData(){
        $DBadmission = $this->load->database('admission', TRUE);
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data = [];
        $keyYear = $this->input->post('keyYear');

        $SelDataStudent = $DBadmission->select('
        skjacth_admission.tb_recruitstudent.recruit_id,
        skjacth_admission.tb_recruitstudent.recruit_regLevel,
        skjacth_admission.tb_recruitstudent.recruit_prefix,
        skjacth_admission.tb_recruitstudent.recruit_firstName,
        skjacth_admission.tb_recruitstudent.recruit_lastName,
        skjacth_admission.tb_recruitstudent.recruit_tpyeRoom,
        skjacth_admission.tb_recruitstudent.recruit_category,
        skjacth_admission.tb_recruitstudent.recruit_status,
        skjacth_admission.tb_recruitstudent.recruit_statusSurrender,
        skjacth_admission.tb_recruitstudent.recruit_idCard,
        skjacth_personnel.tb_students.stu_UpdateConfirm
        ')
        ->from('skjacth_admission.tb_recruitstudent')
        ->join('skjacth_personnel.tb_students','skjacth_admission.tb_recruitstudent.recruit_idCard = skjacth_personnel.tb_students.stu_iden','LEFT')
        ->where('tb_recruitstudent.recruit_year',$keyYear)        
        ->get()->result();

        foreach($SelDataStudent as $record){
            
            $data[] = array( 
                "recruit_id" => $record->recruit_id,
                "recruit_regLevel" => $record->recruit_regLevel,
                "recruit_Fullname" => $record->recruit_prefix.$record->recruit_firstName.' '.$record->recruit_lastName,
                "recruit_tpyeRoom" => $record->recruit_tpyeRoom,
                "recruit_category" => $record->recruit_category,
                "recruit_status" => $record->recruit_status,
                "stu_UpdateConfirm" => $record->stu_UpdateConfirm,
                "recruit_statusSurrender" => $record->recruit_statusSurrender,
                "recruit_idCard" => $record->recruit_idCard
            );
           
        }   
        $output = array(
            "data" =>  $data
        );
       echo json_encode($output);
    }

    public function AdminReportEnrollDetailStudent($IDStu){
        $DBadmission = $this->load->database('admission', TRUE);
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['title'] = "ข้อมูลนักเรียนรายบุคคล"; 
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();

        $CkeckIDEN = $DBadmission->select('recruit_idCard,recruit_regLevel,recruit_img')->where('recruit_id',$IDStu)->get('tb_recruitstudent')->row();
        $data['recruit_regLevel'] =  $CkeckIDEN->recruit_regLevel;
        $data['recruit_img'] =  $CkeckIDEN->recruit_img;
        $data['DataStudent'] = $DBpersonnel->where('stu_iden',$CkeckIDEN->recruit_idCard)->get('tb_students')->row();

        //echo '<pre>'; print_r($data['DataStudent']); exit();
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminReportResults/AdminReportEnrollDetailStudent.php');
        $this->load->view('admin/layout/Footer.php');
    }
    

}


?>