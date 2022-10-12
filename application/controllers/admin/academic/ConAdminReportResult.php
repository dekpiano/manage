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

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }

    public function AdminReportRoomMain(){   
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['admin'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        $keyroom = $this->input->post("keyroom");
        if(!isset($keyroom)){
            $data["Nodata"] = 0;
            $data['totip'] = "";
            $data['keyroom'] = '';
        }else{
            $data["Nodata"] = 1;
            $data['keyroom'] = $keyroom;
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
                                ->where('RegisterYear','1/2565')
                                ->where('StudentStatus','1/ปกติ')
                                ->where('StudentClass',$keyroom)
                                ->group_by('tb_register.SubjectCode')                                
                                ->get()->result();

            $data['check'] = $this->db->select("
                                        tb_students.StudentID,
                                        tb_register.Grade,                                      
                                        tb_register.SubjectCode")
                                ->from('tb_register')
                                ->join('tb_students','tb_students.StudentID = tb_register.StudentID')
                                ->where('RegisterYear','1/2565')
                                ->where('StudentStatus','1/ปกติ')
                                ->where('StudentClass',$keyroom)                              
                                //->group_by('tb_register.SubjectCode')               
                                ->get()->result();

                                // $result=array_diff_key($data['stu'],$data['check']);
                                 //echo '<pre>';print_r($data['subject']);

                                // $firstNames = array_column($data['check'], 'Grade','StudentID');
                                // echo '<pre>';print_r($data['check']);

                               // exit();

        }
        

        $data['title'] = "รายงานผลการเรียนรายห้องเรียน";

        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminReportResults/AdminReportRoomMain.php');
        $this->load->view('admin/layout/Footer.php');
        
    }

    public function AdminStudentsScore($IdStudent){      
        $data['title'] = "ผลการเรียนนักเรียนรายบุคคล";
        $data['ExtraSetting'] = $this->db->get('tb_extra_setting')->result();
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
       
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminReportResults/AdminReportStudentsResult.php');
        $this->load->view('admin/layout/Footer.php');
              
    }

    public function AdminReportSummaryTeacher(){
        $DBSkj = $this->load->database('skj', TRUE);
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

    
    

}


?>