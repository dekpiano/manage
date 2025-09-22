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
    $path = dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))));
		require $path . '/librarie_skj/google_sheet/vendor/autoload.php';

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
        $data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $data['CountAllStu'] = $this->db->select('COUNT(StudentBehavior) AS stuall')
        ->where('StudentStatus','1/ปกติ')
        ->get('tb_students')->result();
        $data['CountNormalStu'] = $this->db->select('COUNT(StudentBehavior) AS stunormal')
        ->where('StudentStatus','1/ปกติ')
        ->where('StudentBehavior !=','ขาดเรียนนาน')
        ->get('tb_students')->result();
        $data['CountAbsentStu'] = $this->db->select('COUNT(StudentBehavior) AS stuabsent')
        ->where('StudentBehavior','ขาดเรียนนาน')
        ->where('StudentStatus','1/ปกติ')
        ->get('tb_students')->result();

        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();

        if(urldecode($Key) == "ปกติ"){
           $ta = "StudentStatus='1/ปกติ'";           
        } elseif(urldecode($Key) == 'จำหน่าย'){
            $ta = "StudentBehavior!='ปกติ'  AND StudentBehavior = ''";            
        }else{
            $ta = 1;
        }       
        if($Key != 'All'){
              
                                           
        }


       
		$data['title'] = "จัดการข้อมูลนักเรียน";
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminStudents/AdminStudentsMain.php');
        $this->load->view('admin/layout/Footer.php');

    }

    public function AdminStudentsNormal(){
        $data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
             
        $this->load->library('classroom');
		$data['class_list'] = $this->classroom->ListRoom();
        $data['school_years'] = $this->db->order_by('schyear_year','desc')->get('tb_schoolyear')->result();

            // echo '<pre>'; print_r($data['stu']);  exit(); 
            $data['title'] = "จัดการข้อมูลนักเรียนปกติ";
            $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
            $this->load->view('admin/layout/Header.php',$data);
            $this->load->view('admin/Academic/AdminStudents/AdminStudentsNormal.php',$data);
            $this->load->view('admin/layout/Footer.php');

    }

    public function AdminStudentsNormalShow($Key){
        if(urldecode($Key) == "Normal"){
            $Keyword = "StudentStatus = '1/ปกติ'";
        }else{
            $Keyword = "StudentStatus != '1/ปกติ'";
        }
       
        $this->db->select('StudentID,
        StudentNumber,
        StudentClass,
        StudentCode,
        StudentPrefix,
        StudentFirstName,
        StudentLastName,
        StudentIDNumber,
        StudentStatus,
        StudentBehavior,
        StudentStudyLine');
        $this->db->where($Keyword); 

        $classFilter = $this->input->post('classFilter');
        if(!empty($classFilter)){
            $this->db->where('StudentClass', $classFilter);
        }

        $school_year = $this->input->post('school_year');
        if(!empty($school_year)){
            $this->db->where('StudentSchoolYear', $school_year);
        }

        $stu = $this->db->get('tb_students')->result();   

        $data = [];
        foreach($stu as $record){
            $data[] = array( 
                "StudentCode" => $record->StudentCode,
                "StudentID" => $record->StudentID,
                "Fullname" => $record->StudentPrefix.$record->StudentFirstName.' '.$record->StudentLastName,
                "StudentClass" => $record->StudentClass,
                "StudentNumber" => $record->StudentNumber,
                "StudentStudyLine" => $record->StudentStudyLine,
                "StudentStatus" => $record->StudentStatus,
                "StudentBehavior" => $record->StudentBehavior
            );

        }
        $output = array(
            "data" =>  $data,           
        );


        echo json_encode($output);

    }

    public function AdminStudentsUpdate(){
        $this->load->helper('array');
        
        $service = $this->getClient();
        $spreadsheetId = '1Je4jmVm3l84xDMAJDqQtdrRB13wWwFl2Fy2b7FvX1Ec';
        
        $range = 'stu1!A2:K1000';  // TODO: Update placeholder value.

        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $numRows = $response->getValues() != null ? count($response->getValues()) : 0;
       
        $checkStu = [];
        $re = $this->db->select('StudentCode,StudentIDNumber,StudentStatus')        
        //->where('StudentStatus','1/ปกติ')
        ->get('tb_students')->result();
        foreach ($re as $key => $v_re) {
            $checkStu[] = $v_re->StudentCode;
        }
        
        //echo '<pre>';print_r($response);exit();
        for ($i=0; $i < $numRows; $i++) { 
            if(isset($response->values[$i][10]) == 1){
               $StudyLine = $response->values[$i][10];
            }else{
                $StudyLine = '';
            }

            if (in_array($response->values[$i][2], $checkStu))
            {
             $arrayName = array('StudentNumber' => $response->values[$i][0], 
                                'StudentClass' => $response->values[$i][1],
                                //'StudentCode' => $response->values[$i][2], 
                                'StudentPrefix' => $response->values[$i][3], 
                                'StudentFirstName' => $response->values[$i][4], 
                                'StudentLastName' => $response->values[$i][5],
                                //'StudentDateBirth' => $response->values[$i][6],
                                'StudentStatus' => $response->values[$i][8],
                                'StudentBehavior' => $response->values[$i][9],
                                'StudentStudyLine' => $StudyLine);
            $this->ModAdminStudents->Students_Update($arrayName,$response->values[$i][2]);
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
        redirect('Admin/Acade/Registration/Students/Normal', 'location');
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

    public function AdminUpdateStudentStatus(){
        if($this->input->post('ValueStudentStatus') == 'ขาดเรียนนาน' || $this->input->post('ValueStudentStatus') == 'ปกติ'){
            $data = array('StudentStatus' => $this->input->post('ValueStudentStatus'));
            $this->db->update('tb_students',$data,'StudentID="'.$this->input->post('KeyStuId').'"');
            echo $this->input->post('ValueStudentStatus');
        }else{
            $data = array('StudentStatus' => $this->input->post('ValueStudentStatus'));
            echo $this->db->update('tb_students',$data,'StudentID="'.$this->input->post('KeyStuId').'"');
        }
        
    }
    
    public function AdminStudentsDelete($id){   
      
        print_r($this->ModAdminStudents->Students_Delete($id));
    }

  
    
    // Chart นักเรียนทั้งหมด
    public function getDashboardData(){
        header('Content-Type: application/json');

        // 1. ดึงข้อมูลสรุปเพศ
        $gender_count = $this->ModAdminStudents->get_gender_count();

        // 2. ดึงข้อมูลนักเรียนตามระดับชั้น (แยกชาย/หญิง)
        $students_by_class_from_db = $this->ModAdminStudents->get_students_by_class();
        
        //print_r($students_by_class_from_db); exit();
        // สร้างโครงข้อมูล 6 ระดับชั้น โดยให้มีค่าเริ่มต้นเป็น 0
        $class_counts = [
            '1' => ['male' => 0, 'female' => 0],
            '2' => ['male' => 0, 'female' => 0],
            '3' => ['male' => 0, 'female' => 0],
            '4' => ['male' => 0, 'female' => 0],
            '5' => ['male' => 0, 'female' => 0],
            '6' => ['male' => 0, 'female' => 0]
        ];

        // นำข้อมูลจากฐานข้อมูลมาอัปเดตในโครงที่เตรียมไว้
        foreach($students_by_class_from_db as $class) {
            if (array_key_exists($class->class_level, $class_counts)) {
                $class_counts[$class->class_level]['male'] = (int)$class->male_count;
                $class_counts[$class->class_level]['female'] = (int)$class->female_count;
            }
        }

        // เตรียมข้อมูลสำหรับส่งให้ Chart.js
        $class_labels = [];
        $male_data = [];
        $female_data = [];
        foreach ($class_counts as $level => $counts) {
            $class_labels[] = 'ม.' . $level;
            $male_data[] = $counts['male'];
            $female_data[] = $counts['female'];
        }

        // 3. ดึงข้อมูลนักเรียนล่าสุด
        $recent_students = $this->ModAdminStudents->get_recent_students(5);

        // จัดรูปแบบข้อมูลสำหรับส่งกลับเป็น JSON
        $data = [
            'gender_count' => [
                'male' => $gender_count->male_students ?? '0',
                'female' => $gender_count->female_students ?? '0'
            ],
            'students_by_class' => [
                'labels' => $class_labels,
                'datasets' => [
                    [
                        'label' => 'ชาย',
                        'data' => $male_data,
                        'backgroundColor' => 'rgba(54, 162, 235, 0.5)'
                    ],
                    [
                        'label' => 'หญิง',
                        'data' => $female_data,
                        'backgroundColor' => 'rgba(255, 99, 132, 0.5)'
                    ]
                ]
            ],
            'recent_students' => $recent_students
        ];

        echo json_encode($data);
    }

    public function AdminStudentsData(){
        $data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $data['title'] = "จัดการข้อมูลนักเรียน LEC";
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminStudents/AdminStudentsDataLEC.php');
        $this->load->view('admin/layout/Footer.php');

    }

    

    public function get_student_details($student_id)
    {
        header('Content-Type: application/json');
        $this->load->library('classroom');

        $student_data = $this->ModAdminStudents->get_student_by_id($student_id);
        $class_list = $this->classroom->ListRoom();
        $study_line_list = $this->classroom->studentStudyLineOptions();
        
        if ($student_data && !empty($student_data->StudentDateBirth)) {
            // Convert Buddhist year to Gregorian year for input type="date"
            $Ex = explode('/', $student_data->StudentDateBirth);
            $gregorian_year = $Ex[2];
            $student_data->StudentDateBirth = sprintf("%04d-%02d-%02d", $gregorian_year,$Ex[1],$Ex[0]);
        }
        
        $response_data = [
            'student_data' => $student_data,
            'class_list'   => $class_list,
            'study_line_list' => $study_line_list
        ];

        echo json_encode($response_data);
        exit; // Ensure no further output
    }

    public function update_student_details()
    {
        header('Content-Type: application/json');

        $student_id = $this->input->post('StudentID');
        $student_id_number = $this->input->post('StudentIDNumber'); // Use StudentIDNumber

        if (empty($student_id) || empty($student_id_number)) {
            echo json_encode(['status' => 'error', 'message' => 'Missing Student ID or National ID Number.']);
            return;
        }

        // Convert Gregorian year from form to Buddhist year for database
        $student_date_birth_gregorian = $this->input->post('StudentDateBirth');
        $student_date_birth_buddhist = null;
        if (!empty($student_date_birth_gregorian)) {
            list($gregorian_year, $month, $day) = explode('-', $student_date_birth_gregorian);
            $buddhist_year = (int)$gregorian_year + 543;
            $student_date_birth_buddhist = sprintf('%04d-%02d-%02d', $buddhist_year, $month, $day);
        }

        // Data for default tb_students
        $data_main = [
            'StudentPrefix' => $this->input->post('StudentPrefix'),
            'StudentFirstName' => $this->input->post('StudentFirstName'),
            'StudentLastName' => $this->input->post('StudentLastName'),
            'StudentClass' => $this->input->post('StudentClass'),
            'StudentNumber' => $this->input->post('StudentNumber'),
            'StudentStudyLine' => $this->input->post('StudentStudyLine'),
            'StudentStatus' => $this->input->post('StudentStatus'),
            'StudentBehavior' => $this->input->post('StudentBehavior'),
            'StudentIDNumber' => $this->input->post('StudentIDNumber'),
            'StudentDateBirth' => $student_date_birth_buddhist // Use converted Buddhist year
        ];

        // Data for personnel.tb_students
        $data_personnel = [
            'stu_nickName' => $this->input->post('stu_nickName'),
            'stu_phone' => $this->input->post('stu_phone'),
            'stu_email' => $this->input->post('stu_email'),
            'stu_bloodType' => $this->input->post('stu_bloodType'),
            'stu_diseaes' => $this->input->post('stu_diseaes'),
            'stu_nationality' => $this->input->post('stu_nationality'),
            'stu_race' => $this->input->post('stu_race'),
            'stu_religion' => $this->input->post('stu_religion'),
            'stu_wieght' => $this->input->post('stu_wieght'),
            'stu_hieght' => $this->input->post('stu_hieght'),
            // Home Address
            'stu_hCode' => $this->input->post('stu_hCode'),
            'stu_hNumber' => $this->input->post('stu_hNumber'),
            'stu_hMoo' => $this->input->post('stu_hMoo'),
            'stu_hRoad' => $this->input->post('stu_hRoad'),
            'stu_hTambon' => $this->input->post('stu_hTambon'),
            'stu_hDistrict' => $this->input->post('stu_hDistrict'),
            'stu_hProvince' => $this->input->post('stu_hProvince'),
            'stu_hPostCode' => $this->input->post('stu_hPostCode'),
            // Current Address
            'stu_cNumber' => $this->input->post('stu_cNumber'),
            'stu_cMoo' => $this->input->post('stu_cMoo'),
            'stu_cRoad' => $this->input->post('stu_cRoad'),
            'stu_cTumbao' => $this->input->post('stu_cTumbao'),
            'stu_cDistrict' => $this->input->post('stu_cDistrict'),
            'stu_cProvince' => $this->input->post('stu_cProvince'),
            'stu_cPostcode' => $this->input->post('stu_cPostcode'),
            // General Info
            'stu_birthTambon' => $this->input->post('stu_birthTambon'),
            'stu_birthDistrict' => $this->input->post('stu_birthDistrict'),
            'stu_birthProvirce' => $this->input->post('stu_birthProvirce'),
            'stu_birthHospital' => $this->input->post('stu_birthHospital'),
            'stu_numberSibling' => $this->input->post('stu_numberSibling'),
            'stu_firstChild' => $this->input->post('stu_firstChild'),
            'stu_numberSiblingSkj' => $this->input->post('stu_numberSiblingSkj'),
            'stu_parenalStatus' => $this->input->post('stu_parenalStatus'),
            'stu_presentLife' => $this->input->post('stu_presentLife'),
            'stu_personOther' => $this->input->post('stu_personOther'),
            'stu_disablde' => $this->input->post('stu_disablde'),
            'stu_talent' => $this->input->post('stu_talent'),
            'stu_natureRoom' => $this->input->post('stu_natureRoom'),
            'stu_farSchool' => $this->input->post('stu_farSchool'),
            'stu_travel' => $this->input->post('stu_travel'),
            'stu_gradLevel' => $this->input->post('stu_gradLevel'),
            'stu_schoolfrom' => $this->input->post('stu_schoolfrom'),
            'stu_schoolTambao' => $this->input->post('stu_schoolTambao'),
            'stu_schoolDistrict' => $this->input->post('stu_schoolDistrict'),
            'stu_schoolProvince' => $this->input->post('stu_schoolProvince'),
            'stu_usedStudent' => $this->input->post('stu_usedStudent'),
            'stu_inputLevel' => $this->input->post('stu_inputLevel'),
            'stu_phoneUrgent' => $this->input->post('stu_phoneUrgent'),
            'stu_phoneFriend' => $this->input->post('stu_phoneFriend'),
            'stu_future_education' => $this->input->post('stu_future_education'),
            'stu_career_interest' => $this->input->post('stu_career_interest')
        ];

        // Remove null values to avoid overwriting existing data with empty strings
        $data_main = array_filter($data_main, function($value) { return $value !== null && $value !== ''; });
        $data_personnel = array_filter($data_personnel, function($value) { return $value !== null && $value !== ''; });

        $success = $this->ModAdminStudents->update_student_data($student_id, $student_id_number, $data_main, $data_personnel);

        if ($success) {
            echo json_encode(['status' => 'success', 'message' => 'บันทึกข้อมูลนักเรียนเรียบร้อยแล้ว']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล']);
        }
    }

}


?>