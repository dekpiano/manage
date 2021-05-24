<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ConTeacherCourse extends CI_Controller {
var  $title = "หน้าแรก";
	public function __construct() {
		parent::__construct();
		
		if ($this->session->userdata('fullname') == '' && !$this->session->userdata('status') == 'admin') {      
			redirect('welcome','refresh');
		}
        if($this->session->userdata('CheckStatusPassword') == ""){
            redirect('Teacher/Profile','refresh');
        }

        $this->load->model('teacher/ModTeacherCourse');

    }


    public function Course(){      
        $data['title'] = "แผนการสอน";
        $data['OnOff'] = $this->db->select('*')->get('tb_send_plan_setup')->result();
        $data['plan'] = $this->db->where('seplan_usersend',$this->session->userdata('login_id'))->get('tb_send_plan')->result();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/course/plan/plan_main.php');
        $this->load->view('teacher/layout/footer_teacher.php');
        
    }

    public function send_plan(){ 
        $data['title'] = "ส่งงาน";
        $data['OnOff'] = $this->db->select('*')->get('tb_send_plan_setup')->result();
        $tiemstart = $data['OnOff'][0]->seplanset_startdate;
        $tiemEnd = $data['OnOff'][0]->seplanset_enddate;
        $timeNow = date('Y-m-d H:i:s');
        if($tiemstart < $timeNow  &&  $tiemEnd > $timeNow && $data['OnOff'][0]->seplanset_status == "on"){   
            $this->load->view('teacher/layout/header_teacher.php',$data);
            $this->load->view('teacher/layout/navbar_teaher.php');
            $this->load->view('teacher/course/plan/plan_send.php');
            $this->load->view('teacher/layout/footer_teacher.php');
        }else{
            $this->session->set_flashdata(array('status'=>'warning','msg'=> 'YES','messge' => "<h2>ระบบปิดอยู่ </h2><br>ยังไม่ถึงกำหนดส่งงาน  หรือ เกินกำหนดส่งงาน<br>ติดต่อหัวงานหลักสูตร"));         
            redirect('Teacher/Course','refresh');       
        }
       
    }

    public function edit_plan($id){
        $data['title'] = "แก้ไขงาน";
        $data['plan'] = $this->db->where('seplan_ID',$id)->get('tb_send_plan')->result();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/course/plan/plan_edit.php');
        $this->load->view('teacher/layout/footer_teacher.php');
    }

    public function check_plan($id = null){
        $data['title'] = "ตรวจสอบงาน";
        $DBskj = $this->load->database('skj', TRUE); 
        $data['lean'] = $DBskj->get('tb_learning')->result();
        $data['ID'] = $id;
        //echo '<pre>'; print_r($lean); exit();
        $data['checkplan'] = $this->db->select("skjacth_academic.tb_send_plan.*,
                                                skjacth_personnel.tb_personnel.pers_prefix,
                                                skjacth_personnel.tb_personnel.pers_firstname,
                                                skjacth_personnel.tb_personnel.pers_lastname")
                                                ->join('skjacth_personnel.tb_personnel','skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_send_plan.seplan_usersend')
                            ->where('seplan_learning',$id)
                            ->get('tb_send_plan')->result();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/course/plan/plan_check.php');
        $this->load->view('teacher/layout/footer_teacher.php');
    }
    
    function insert_plan(){

        $status=$this->input->post('seplan_sendcomment');
       $textToStore = nl2br(htmlentities($status, ENT_QUOTES, 'UTF-8'));
        
        $config['upload_path']= "uploads/academic/course/plan/";
        $config['allowed_types'] = '*';
        //$config['encrypt_name'] = TRUE;
        $SetPlan = $this->db->get('tb_send_plan_setup')->result();
        //print_r($SetPlan); exit();
        $this->load->library('upload',$config);
        $this->upload->initialize($config); 
        if($this->upload->do_upload("seplan_file")){
            $data = array('upload_data' => $this->upload->data());
 
            $insert =  array('seplan_namesubject'=> $this->input->post('seplan_namesubject'),
                            'seplan_coursecode'=> $this->input->post('seplan_coursecode'),
                            'seplan_typeplan'=> $this->input->post('seplan_typeplan'),
                            'seplan_typesubject'=> $this->input->post('seplan_typesubject'),
                            'seplan_createdate'=> date('Y-m-d H:i:s'),
                            'seplan_year'=> $SetPlan[0]->seplanset_year,
                            'seplan_term'=> $SetPlan[0]->seplanset_term,
                            'seplan_file'=> $data['upload_data']['file_name'],
                            'seplan_usersend'=> $this->session->userdata('login_id'),
                            'seplan_learning'  => $this->session->userdata('pers_learning'),
                            'seplan_status1' => "รอตรวจ",
                            'seplan_status2' => "รอตรวจ",
                            'seplan_sendcomment' =>  $textToStore,
                            'seplan_gradelevel' => $this->input->post('seplan_gradelevel')
                         );
             
            $result= $this->ModTeacherCourse->plan_insert($insert);
            echo $result;
            
        }else{
            $error = $this->upload->display_errors();
            echo $error;
        }
        
     }

     function update_plan(){
        $status=$this->input->post('seplan_sendcomment');
        $textToStore = $status;

        $id_plan = $this->input->post('seplan_ID');
        $checkdata = $this->db->select('seplan_ID,seplan_file')->where('seplan_ID',$id_plan)->get('tb_send_plan')->result();
        $SetPlan = $this->db->get('tb_send_plan_setup')->result();

        //echo $_FILES['seplan_file']['error']; exit();
        if($_FILES['seplan_file']['error'] <= 0){
            $config['upload_path']= "uploads/academic/course/plan/";
            $config['allowed_types'] = '*';
            //$config['encrypt_name'] = TRUE;
            
            //print_r($SetPlan); exit();
            $this->load->library('upload',$config);
            $this->upload->initialize($config); 
            if($this->upload->do_upload("seplan_file")){
                $data = array('upload_data' => $this->upload->data());
     
                $update =  array('seplan_namesubject'=> $this->input->post('seplan_namesubject'),
                                'seplan_coursecode'=> $this->input->post('seplan_coursecode'),
                                'seplan_typeplan'=> $this->input->post('seplan_typeplan'),
                                'seplan_year'=> $SetPlan[0]->seplanset_year,
                                'seplan_term'=> $SetPlan[0]->seplanset_term,
                                'seplan_typesubject'=> $this->input->post('seplan_typesubject'),
                                'seplan_file'=> $data['upload_data']['file_name'],
                                'seplan_usersend'=> $this->session->userdata('login_id'),
                                'seplan_learning'  => $this->session->userdata('pers_learning'),
                                'seplan_status1' => "รอตรวจ",
                                'seplan_status2' => "รอตรวจ",
                                'seplan_sendcomment' =>  $textToStore,
                                'seplan_gradelevel' => $this->input->post('seplan_gradelevel')
                             );
              
                @unlink("./uploads/academic/course/plan/".$checkdata[0]->seplan_file);
                 
                $result= $this->ModTeacherCourse->plan_update($update,$id_plan);
                echo $result;
                
            }else{
                $error = $this->upload->display_errors();
                echo $error;
            }
        }else{
            $update =  array('seplan_namesubject'=> $this->input->post('seplan_namesubject'),
                                'seplan_coursecode'=> $this->input->post('seplan_coursecode'),
                                'seplan_typeplan'=> $this->input->post('seplan_typeplan'),
                                'seplan_year'=> $SetPlan[0]->seplanset_year,
                                'seplan_term'=> $SetPlan[0]->seplanset_term,
                                'seplan_typesubject'=> $this->input->post('seplan_typesubject'),
                                'seplan_usersend'=> $this->session->userdata('login_id'),
                                'seplan_learning'  => $this->session->userdata('pers_learning'),
                                'seplan_status1' => "รอตรวจ",
                                'seplan_status2' => "รอตรวจ",
                                'seplan_sendcomment' =>  $textToStore,
                                'seplan_gradelevel' => $this->input->post('seplan_gradelevel')
                             );
                            
                $result= $this->ModTeacherCourse->plan_update($update,$id_plan);
                echo $result;
        }
     }

     public function delete_plan($id)
   {
    $checkdata = $this->db->select('seplan_ID,seplan_file')->where('seplan_ID',$id)->get('tb_send_plan')->result();
    @unlink("./uploads/academic/course/plan/".$checkdata[0]->seplan_file);

       $this->db->delete('tb_send_plan', array('seplan_ID' => $id));
       echo 'Deleted successfully.';
   }

     function setting_plan(){         
        $data['title'] = "ตั้งค่า";
        $data['SetPlan'] = $this->db->get('tb_send_plan_setup')->result();
        //print_r($date['SetPlan']); exit();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/course/plan/plan_setting_plan.php');
        $this->load->view('teacher/layout/footer_teacher.php');
     }

     function setting_UpdatePlan(){
         $dateS = str_replace('/', '-', $this->input->post('seplanset_startdate'));
         $startdate = date('Y-m-d H:i:s',strtotime($this->input->post('seplanset_startdate')));
         $dateE = str_replace('/', '-', $this->input->post('seplanset_enddate'));
         $enddate = date('Y-m-d H:i:s',strtotime($this->input->post('seplanset_enddate')));
            $data = array('seplanset_startdate' => $startdate,
            'seplanset_enddate' => $enddate,
            'seplanset_usersetup' => $this->session->userdata('login_id'),
            'seplanset_year' => $this->input->post('seplanset_year'),
            'seplanset_term' => $this->input->post('seplanset_term'),
            'seplanset_status' => $this->input->post('seplanset_status'));
        //print_r($data); exit();
            $result = $this->ModTeacherCourse->plan_setting($data,1);
            if($result > 0){
                $this->session->set_flashdata(array('status'=>'success','msg'=> 'YES','messge' => "ตั้งค่าสำเร็จ"));
               
            }else{
                $this->session->set_flashdata(array('status'=>'error','msg'=> 'YES','messge' => "ตั้งค่าไม่สำเร็จ".$result));
               
            }
            redirect('Teacher/Course/Setting','refresh');
     }

     function UpdateStatus1(){
       // echo $this->input->post('status1');
        $id =  $this->input->post('planId');
        if($this->input->post('status1') == "ผ่าน"){
            $data = array('seplan_status1' => $this->input->post('status1'),
            'seplan_checkdate1' => date('Y-m-d H:i:s'),
            'seplan_inspector1' => $this->session->userdata('login_id'),
            'seplan_comment1' => ""
            );
         }else{
            $data = array('seplan_status1' => $this->input->post('status1'),
            'seplan_checkdate1' => date('Y-m-d H:i:s'),
            'seplan_inspector1' => $this->session->userdata('login_id')
            );
         }
        $result = $this->ModTeacherCourse->plan_UpdateStatus1($data,$id);
        if($result == 1){
            $data = $this->db->select('seplan_status1,seplan_status2')->where('seplan_ID',$id)->get('tb_send_plan')->result();
            echo json_encode($data);
        }
     }
     function UpdateStatus2(){
        // echo $this->input->post('status1');
         $id =  $this->input->post('planId');
         if($this->input->post('status2') == "ผ่าน"){
            $data = array('seplan_status2' => $this->input->post('status2'),
            'seplan_checkdate2' => date('Y-m-d H:i:s'),
            'seplan_inspector2' => $this->session->userdata('login_id'),
            'seplan_comment2' => ""
            );
         }else{
            $data = array('seplan_status2' => $this->input->post('status2'),
            'seplan_checkdate2' => date('Y-m-d H:i:s'),
            'seplan_inspector2' => $this->session->userdata('login_id')
            );
         }
         
                         
         $result = $this->ModTeacherCourse->plan_UpdateStatus2($data,$id);
         if($result == 1){
            $data = $this->db->select('seplan_status1,seplan_status2')->where('seplan_ID',$id)->get('tb_send_plan')->result();
            echo json_encode($data);
        }
      }

      function CheckComment1(){
        // echo $this->input->post('status1');
         $id =  $this->input->post('planId');
        $result = $this->db->select('seplan_ID,seplan_comment1')->where('seplan_ID',$id)->get('tb_send_plan')->result();
        
        echo json_encode($result);
      }

      function UpdateComment1(){
        // echo $this->input->post('status1');
         $id =  $this->input->post('planId');
         $seplan_comment1 =  $this->input->post('seplan_comment1');
         $data = array('seplan_comment1' =>  $seplan_comment1);
         $result = $this->ModTeacherCourse->plan_UpdateStatus1($data,$id);
         echo ($result);
      }

      function CheckComment2(){
        // echo $this->input->post('status1');
         $id =  $this->input->post('planId');
        $result = $this->db->select('seplan_ID,seplan_comment2')->where('seplan_ID',$id)->get('tb_send_plan')->result();
        
        echo json_encode($result);
      }

      function UpdateComment2(){
        // echo $this->input->post('status1');
         $id =  $this->input->post('planId');
         $seplan_comment2 =  $this->input->post('seplan_comment2');
         $data = array('seplan_comment2' =>  $seplan_comment2);
         $result = $this->ModTeacherCourse->plan_UpdateStatus2($data,$id);
         echo ($result);
      }


      public function report_plan($key = null){
        
        $data['ID'] = $key;
        $data['thai'] = urldecode($key);
        $data['title'] = "รายงาน";       
        $DBskj = $this->load->database('skj', TRUE); 
        $data['lean'] = $DBskj->get('tb_learning')->result();
        $data['setupplan'] = $this->db->get('tb_send_plan_setup')->result();
        
        if(isset($_GET['select_lean'])){
            $idLearn = $_GET['select_lean'];
        }else{
            $idLearn = $this->session->userdata('pers_learning');
        }
        $data['checkplan'] = $this->db->select("skjacth_academic.tb_send_plan.*,
                                                skjacth_personnel.tb_personnel.pers_prefix,
                                                skjacth_personnel.tb_personnel.pers_firstname,
                                                skjacth_personnel.tb_personnel.pers_lastname")
                                                ->join('skjacth_personnel.tb_personnel','skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_send_plan.seplan_usersend')
                            ->where('seplan_learning',$idLearn)
                            ->where('seplan_typeplan',$data['thai'])
                            ->group_by('seplan_coursecode')
                            ->order_by('pers_firstname')
                            ->get('tb_send_plan')->result();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/course/plan/plan_report.php');
        $this->load->view('teacher/layout/footer_teacher.php');
    }

    public function report_plan_print($key = null,$leanKey = null){
        //echo urldecode($key); exit();
        $data['ID'] = $key;
        $data['thai'] = urldecode($key);
        $data['title'] = "รายงาน";
        $DBskj = $this->load->database('skj', TRUE); 
        
        $setupplan = $this->db->get('tb_send_plan_setup')->result();

        if($leanKey){
            $idLearn = $leanKey;
        }else{
            $idLearn = $this->session->userdata('pers_learning');
        }
        $lean = $DBskj->where('lear_id',$idLearn)->get('tb_learning')->result();

        //echo '<pre>'; print_r($lean); exit();
        $checkplan = $this->db->select("skjacth_academic.tb_send_plan.*,
                                                skjacth_personnel.tb_personnel.pers_prefix,
                                                skjacth_personnel.tb_personnel.pers_firstname,
                                                skjacth_personnel.tb_personnel.pers_lastname")
                                                ->join('skjacth_personnel.tb_personnel','skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_send_plan.seplan_usersend')
                            ->where('seplan_learning',$idLearn)
                            ->where('seplan_typeplan',$data['thai'])
                            ->group_by('seplan_coursecode')
                            ->order_by('pers_firstname')
                            ->get('tb_send_plan')->result();
    //     $this->load->view('teacher/course/plan/plan_report_print.php',$data);
    
            $spreadsheet = new Spreadsheet();
            $spreadsheet->getDefaultStyle()->getFont()->setName('TH SarabunPSK');
            $spreadsheet->getDefaultStyle()->getFont()->setSize(16);
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->getStyle('A1:I5')->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER) //Set vertical center
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER) //Set horizontal center
            ->setWrapText(true); //Set wrap

            $styleArray = [
                'font' => [
                    'bold' => true,
                ]                
            ];            
            $spreadsheet->getActiveSheet()->getStyle('A1:I5')->applyFromArray($styleArray);
            
            $f = array('A','B','C','D','E','F','G','H','I' );
            foreach ($f as $key => $v_f) {
                $spreadsheet->getActiveSheet()->getColumnDimension($v_f)->setAutoSize(true);
            }

            $styleArray = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '00000000'],
                    ],
                ],
            ];
           
            

            $sheet->setCellValue('A1', 'ทะเบียนส่งโครงการสอน');
            $sheet->mergeCells('A1:I1');
            $sheet->setCellValue('A2', 'กลุ่มสาระการเรียนรู้'.$lean[0]->lear_namethai);
            $sheet->mergeCells('A2:I2');
            $sheet->setCellValue('A3', 'ภาคเรียนที่ '.$setupplan[0]->seplanset_term.' ปีการศึกษา '.$setupplan[0]->seplanset_year);
            $sheet->mergeCells('A3:I3');
            
            $sheet->setCellValue('A4', 'ที่');
            $sheet->mergeCells('A4:A5');
            $sheet->setCellValue('B4', 'ชื่อ-นามสกุล');
            $sheet->mergeCells('B4:B5');
            $sheet->setCellValue('C4', 'รายวิชา');
            $sheet->mergeCells('C4:D4');
            $sheet->setCellValue('C5', 'พื้นฐาน');
            $sheet->setCellValue('D5', 'เพิ่มเติม');
            $sheet->setCellValue('E4', 'ชื่อวิชา');
            $sheet->mergeCells('E4:E5');
            $sheet->setCellValue('F4', 'รหัสวิชา');
            $sheet->mergeCells('F4:F5');
            $sheet->setCellValue('G4', 'ระดับชั้น');
            $sheet->mergeCells('G4:G5');
            $sheet->setCellValue('H4', 'วัน/เดือน/ปี');
            $sheet->mergeCells('H4:H5');
            $sheet->setCellValue('I4', 'หมายเหตุ');
            $sheet->mergeCells('I4:I5');


            $start_row=6; 
            foreach ($checkplan as $key => $v_checkplan) {
                $sheet->getStyle('A4:I'.$start_row)->applyFromArray($styleArray);

                $sheet->setCellValue('A'.$start_row, $key+1);
                $sheet->setCellValue('B'.$start_row, $v_checkplan->pers_prefix.$v_checkplan->pers_firstname.' '.$v_checkplan->pers_lastname);
                $sheet->setCellValue('C'.$start_row, $v_checkplan->seplan_typesubject=="พื้นฐาน" ? '✓' : '');
                $sheet->setCellValue('D'.$start_row, $v_checkplan->seplan_typesubject=="เพิ่มเติม" ? '✓' : '');
                $sheet->setCellValue('E'.$start_row, $v_checkplan->seplan_namesubject);
                $sheet->setCellValue('F'.$start_row, $v_checkplan->seplan_coursecode);
                $sheet->setCellValue('G'.$start_row, 'ม.'.$v_checkplan->seplan_gradelevel);
                $sheet->setCellValue('H'.$start_row, $this->datethai->thai_date_fullmonth(strtotime($v_checkplan->seplan_createdate)));
                $sheet->setCellValue('I'.$start_row, '');

                $sheet->getStyle('C6:I'.$start_row)->getAlignment()
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER) //Set vertical center
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER) //Set horizontal center
                ->setWrapText(true); //Set wrap

                $start_row++; 
            }
            $sheet->getStyle('A6:A'.($start_row))->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER) //Set vertical center
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER) //Set horizontal center
            ->setWrapText(true);
            $sheet->getStyle('D'.($start_row+3).':F'.($start_row+4))->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER) //Set vertical center
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER) //Set horizontal center
            ->setWrapText(true); //Set wrap
            $sheet->setCellValue('D'.($start_row+2), 'ลงชื่อ…………………………………………………….หัวหน้ากลุ่มสาระการเรียนรู้'.$lean[0]->lear_namethai);
            $sheet->mergeCells('D'.($start_row+2).':I'.($start_row+2));
            $sheet->setCellValue('D'.($start_row+3), '('.$this->session->userdata('fullname').')');
            $sheet->mergeCells('D'.($start_row+3).':F'.($start_row+3));
            $sheet->setCellValue('D'.($start_row+4), $this->datethai->thai_date_fullmonth(strtotime(date("Y-m-d"))));
            $sheet->mergeCells('D'.($start_row+4).':F'.($start_row+4));

            $writer = new Xlsx($spreadsheet);
            
            $filename = 'name-of-the-generated-file';
            
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="แบบรายงานส่ง'. $data['thai'].'-'.$lean[0]->lear_namethai.'.xlsx"'); 
            header('Cache-Control: max-age=0');
            
            $writer->save('php://output'); // download file 
    }

}


?>