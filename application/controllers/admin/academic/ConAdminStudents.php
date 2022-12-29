<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ConAdminStudents extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('admin/ModAdminStudents');
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

     // Our service account access key
     $googleAccountKeyFilePath = 'service_key.json';
     putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $googleAccountKeyFilePath);
 
     // Create new client
     $client = new Google_Client();
     // Set credentials
     $client->useApplicationDefaultCredentials();
 
     // Adding an access area for reading, editing, creating and deleting tables
     $client->addScope('https://www.googleapis.com/auth/spreadsheets');
 
     $service = new Google_Service_Sheets($client);
 
     // you spreadsheet ID
     
    return $service;
}

    public function AdminStudentsMain($Key = null){ 
        $data['CountAllStu'] = $this->db->select('COUNT(StudentBehavior) AS stuall')
        ->where('StudentBehavior','ปกติ')
        ->or_where('StudentBehavior','ขาดเรียนนาน')
        ->get('tb_students')->result();
        $data['CountNormalStu'] = $this->db->select('COUNT(StudentBehavior) AS stunormal')
        ->where('StudentBehavior','ปกติ')
        ->get('tb_students')->result();
        $data['CountAbsentStu'] = $this->db->select('COUNT(StudentBehavior) AS stuabsent')
        ->where('StudentBehavior','ขาดเรียนนาน')
        ->get('tb_students')->result();

        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();

        if(urldecode($Key) == "ปกติ"){
           $ta = "StudentBehavior='ปกติ' OR StudentBehavior='ขาดเรียนนาน'";           
        } elseif(urldecode($Key) == 'จำหน่าย'){
            $ta = "StudentBehavior!='ปกติ'  AND StudentBehavior = ''";            
        }else{
            $ta = 1;
        }       
        if($Key != 'All'){
            $DBpersonnel = $this->load->database('personnel', TRUE); 
            $data['admin'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
            $data['stu'] = $this->db->select('StudentID,
                                            StudentNumber,
                                            StudentClass,
                                            StudentCode,
                                            StudentPrefix,
                                            StudentFirstName,
                                            StudentLastName,
                                            StudentIDNumber,
                                            StudentStatus,
                                            StudentBehavior,
                                            StudentStudyLine')
                                            ->where($ta) 
                                            ->get('tb_students')->result();     
                                           
        }

 //echo '<pre>'; print_r($data['stu']);  exit(); 
       
		$data['title'] = "จัดการข้อมูลนักเรียน";
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminStudents/AdminStudentsMain.php');
        $this->load->view('admin/layout/Footer.php');

    }

    public function AdminStudentsUpdate(){
        $this->load->helper('array');
        
            
        
        $service = $this->getClient();
        $spreadsheetId = '1Je4jmVm3l84xDMAJDqQtdrRB13wWwFl2Fy2b7FvX1Ec';
        
        $range = 'stu1!A2:K1000';  // TODO: Update placeholder value.

        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $numRows = $response->getValues() != null ? count($response->getValues()) : 0;
       
        $checkStu = [];
        $re = $this->db->select('StudentIDNumber,StudentStatus')
        ->where('StudentBehavior','ปกติ')
        ->where('StudentStatus','1/ปกติ')
        ->or_where('StudentBehavior','ขาดเรียนนาน')
        ->get('tb_students')->result();
        foreach ($re as $key => $v_re) {
            $checkStu[] = $v_re->StudentIDNumber;
        }
        //sset($response->values[775][10])
       // echo '<pre>';print_r($re);exit();
        for ($i=0; $i < $numRows; $i++) { 
            if(isset($response->values[$i][10]) == 1){
               $StudyLine = $response->values[$i][10];
            }else{
                $StudyLine = '';
            }
            if (in_array($response->values[$i][7], $checkStu))
            {
             $arrayName = array('StudentNumber' => $response->values[$i][0], 
                                'StudentClass' => $response->values[$i][1],
                                'StudentCode' => $response->values[$i][2], 
                                'StudentPrefix' => $response->values[$i][3], 
                                'StudentFirstName' => $response->values[$i][4], 
                                'StudentLastName' => $response->values[$i][5],
                                'StudentDateBirth' => $response->values[$i][6],
                                'StudentStatus' => $response->values[$i][8],
                                'StudentBehavior' => $response->values[$i][9],
                                'StudentStudyLine' => $StudyLine);
            $this->ModAdminStudents->Students_Update($arrayName,$response->values[$i][7]);
            }
          else
            {
                $arrayName = array('StudentNumber' => $response->values[$i][0], 
                'StudentClass' => $response->values[$i][1],
                'StudentCode' => $response->values[$i][2], 
                'StudentPrefix' => $response->values[$i][3], 
                'StudentFirstName' => $response->values[$i][4], 
                'StudentLastName' => $response->values[$i][5],
                'StudentIDNumber' => $response->values[$i][7],
                'StudentDateBirth' => $response->values[$i][6],
                'StudentStatus' => $response->values[$i][8],
                'StudentBehavior' => $response->values[$i][9],
                'StudentStudyLine' => $StudyLine);
                $this->ModAdminStudents->Students_Inaert($arrayName);
            }
        }
        $this->session->set_flashdata(array('status'=> 'success','messge' => 'อัพเดพข้อมูลสำเร็จ','msg'=>'YES'));
        redirect('Admin/Acade/Registration/Students/ปกติ', 'location');
    }

    public function AdminStudentsMain1(){   

        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['admin'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        
		$data['title'] = "นักเรียน";
       
        //echo '<pre>';print_r($studentOdd) ; exit();
        $inputFileName = 'uploads/m.11.xls';//ชื่อไฟล์ Excel ที่ต้องการอ่านข้อมูล
 
        $spreadsheet = IOFactory::load($inputFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        foreach ($sheetData as $key => $v_sheetData) {
            
           if($key != 1){
            //echo '<pre>'; print_r($v_sheetData['E']);
            $studentOdd = $this->db->select('StudentCode')->where('StudentCode',$v_sheetData['E'])->get('tb_student_express')->num_rows();
            if($studentOdd == 1){
                echo "มีแล้ว";
            }else{
                echo  "ยังไม่มี";
            }
            echo '<br>';
            
           }
                
                
            // if (in_array($v_sheetData['E'],$studentOdd->StudentCode)){
            // echo 'ซ้ำกัน<br>'.$studentOdd->StudentCode;
            // }else{
            //     echo 'ไม่ซ้ำกัน<br>'.$studentOdd->StudentCode;
            // }
             
        }
        exit();
        
        //echo '<pre>'; print_r($sheetData);
        

        // $this->load->view('admin/layout/Header.php',$data);
        // $this->load->view('admin/AdminStudents/AdminStudentsMain.php');
        // $this->load->view('admin/layout/Footer.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }

    public function AdminUpdateStudentBehavior(){
        if($this->input->post('ValueBehavior') == 'ขาดเรียนนาน' || $this->input->post('ValueBehavior') == 'ปกติ'){
            $data = array('StudentBehavior' => $this->input->post('ValueBehavior'));
            $this->db->update('tb_students',$data,'StudentID="'.$this->input->post('KeyStuId').'"');
            echo $this->input->post('ValueBehavior');
        }else{
            $data = array('StudentBehavior' => $this->input->post('ValueBehavior'));
            echo $this->db->update('tb_students',$data,'StudentID="'.$this->input->post('KeyStuId').'"');
        }
        
    }
    
    public function AdminStudentsDelete($id){   
      
        print_r($this->ModAdminStudents->Students_Delete($id));
    }

   
}


?>