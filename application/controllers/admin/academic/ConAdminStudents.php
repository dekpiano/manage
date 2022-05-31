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
    }

    function getClient()
{
    require_once APPPATH. 'libraries/vendor/autoload.php';

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

    public function AdminStudentsMain(){ 
                
     
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
                                        StudentStatus')
                                        ->where('StudentStatus','1/ปกติ')
                                        ->get('tb_students')->result();        
		$data['title'] = "นักเรียน";
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminStudents/AdminStudentsMain.php');
        $this->load->view('admin/layout/Footer.php');

    }

    public function AdminStudentsUpdate(){
        $this->load->helper('array');
        $service = $this->getClient();
        $spreadsheetId = '13mTh9NNdzk37s3nMYSfYyI1UZ_Dwz2hi3Rbv2i0OTQ0';
        
        $range = 'stu1!A2:I1000';  // TODO: Update placeholder value.

        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $numRows = $response->getValues() != null ? count($response->getValues()) : 0;
       
        $checkStu = [];
        $re = $this->db->select('StudentIDNumber,StudentStatus')->where('StudentStatus','1/ปกติ')->get('tb_students')->result();
        foreach ($re as $key => $v_re) {
            $checkStu[] = $v_re->StudentIDNumber;
        }

        //print_r($checkStu);exit();
        for ($i=0; $i < $numRows; $i++) { 

            if (in_array($response->values[$i][6], $checkStu))
            {
             $arrayName = array('StudentNumber' => $response->values[$i][0], 
                                'StudentClass' => $response->values[$i][1],
                                'StudentCode' => $response->values[$i][2], 
                                'StudentPrefix' => $response->values[$i][3], 
                                'StudentFirstName' => $response->values[$i][4], 
                                'StudentLastName' => $response->values[$i][5],
                                'StudentDateBirth' => $response->values[$i][7],
                                'StudentStatus' => $response->values[$i][8]);
            $this->ModAdminStudents->Students_Update($arrayName,$response->values[$i][6]);
            }
          else
            {
                $arrayName = array('StudentNumber' => $response->values[$i][0], 
                'StudentClass' => $response->values[$i][1],
                'StudentCode' => $response->values[$i][2], 
                'StudentPrefix' => $response->values[$i][3], 
                'StudentFirstName' => $response->values[$i][4], 
                'StudentLastName' => $response->values[$i][5],
                'StudentIDNumber' => $response->values[$i][6],
                'StudentDateBirth' => $response->values[$i][7],
                'StudentStatus' => $response->values[$i][8]);
                $this->ModAdminStudents->Students_Inaert($arrayName);
            }
            
            
           
        }
      // print_r($response);
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
    
    public function AddStudents(){   
        $dataStudents = array('Reg_Year'=>$this->input->post('year'),
                                'Reg_Class'=>$this->input->post('Students'),
                                'class_teacher'=>$this->input->post('teacher'));
        print_r($this->ModAdminStudents->Students_Add($dataStudents));
    }

}


?>