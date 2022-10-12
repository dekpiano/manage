<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConStudentHome extends CI_Controller {
var  $title = "ผลการเรียน";
	public function __construct() {
		parent::__construct();
		
		if ($this->session->userdata('fullname') == '' || $this->session->userdata('status') == "admin") {
            
			redirect('Login','refresh');
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


    public function Home(){
        $data['title'] = "หน้าแรก";
        $data['ExtraSetting'] = $this->db->get('tb_extra_setting')->result();
        $this->load->view('student/layout/HeaderStudent.php',$data);
        $this->load->view('student/PageStudentHome.php');
        $this->load->view('student/layout/FooterStudent.php');
    }

    public function score(){      
        $data['title'] = "ผลการเรียน";
        $data['ExtraSetting'] = $this->db->get('tb_extra_setting')->result();
        $data['scoreYear'] = $this->db->select('
                                    tb_register.RegisterClass,
                                    tb_register.RegisterYear,
                                    tb_register.StudentID
                                    ')
                                    ->from('tb_register')
                                    ->where('StudentID',$this->session->userdata('login_id'))
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
                                    ->where('StudentID',$this->session->userdata('login_id'))
                                    ->where('tb_register.SubjectCode !=','I30301')
                                    ->where('tb_register.SubjectCode !=','I20201')
                                    ->order_by('tb_subjects.SubjectType asc')
                                    ->order_by('tb_subjects.FirstGroup asc','tb_subjects.SubjectCode asc')
                                    ->get()->result();
      
        $data['CheckOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
       // echo '<pre>'; print_r($data['scoreStudent']); exit();
        $data['stu'] =  $this->db->select('
                                    StudentClass,
                                    StudentCode,
                                    StudentPrefix,
                                    StudentFirstName,
                                    StudentLastName 
                                    ')
                                 ->where('StudentID',$this->session->userdata('login_id'))->get('tb_students')->row();

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


        $this->load->view('student/layout/HeaderStudent.php',$data);
        $this->load->view('student/PageAcademicResult.php');
        $this->load->view('student/layout/FooterStudent.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }



}


?>