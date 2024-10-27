<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConAdminRegisterSubject extends CI_Controller {
var  $title = "แผงควบคุม";
	public function __construct() {
        parent::__construct();
        $this->load->model('admin/ModAdminRegisterSubject');
		
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

    public function update_row($RegisterYear,$SubjectCode, $data) {
        // อัปเดตข้อมูลของแถวเดียวโดยใช้ ID เป็นเงื่อนไข
        $this->db->where('RegisterYear', $RegisterYear);
        $this->db->where('SubjectCode', $SubjectCode);
        $this->db->update('tb_register', $data);
    }

    public function update_data_with_foreach() {
        

        // เริ่มต้น transaction
        $this->db->trans_start();


        $da = $this->db->select('SubjectYear,SubjectCode,SubjectID')->get('tb_subjects')->result();
        // เตรียมข้อมูลตัวอย่าง
        $data = [];
        for ($i = 1501; $i <= 1793; $i++) {
            $data[] = [
                'SubjectID' => $da[$i]->SubjectID,
                'SubjectCode' => $da[$i]->SubjectCode,
                'SubjectYear' => $da[$i]->SubjectYear
            ];
        }

        //echo '<pre>';print_r($data);exit();
        // ใช้ foreach อัปเดตข้อมูลทีละแถว
        foreach ($data as $row) {
            //echo '<pre>';print_r($row);
            $this->update_row($row['SubjectYear'], $row['SubjectCode'],['SubjectCode' => $row['SubjectID']]);
        }
        //exit();
        
        // สรุป transaction (commit หรือ rollback)
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            // กรณีอัปเดตล้มเหลว
            echo "Error updating data";
        } else {
            // กรณีอัปเดตสำเร็จ
            echo "Data updated successfully";
        }
    }

    public function AdminRegisterSubjectMain(){   
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['admin'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        $data['GroupYear'] = $this->db->select('SubjectYear')->group_by('SubjectYear')->order_by('SubjectYear','ASC')->get('tb_subjects')->result();

        //$this->update_data_with_foreach(); exit();
       
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $data['title'] = "วิชาเรียน";	
        $data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminRegisterSubject/AdminRegisterSubjectMain.php');
        $this->load->view('admin/layout/Footer.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }

    public function AdminRegisterSubjectSelect(){ 
      
        $CheckYear = $this->db->get('tb_schoolyear')->result();
        $data = [];
        if($this->input->post('keyYear')){
            $subject = $this->db->where('SubjectYear',$this->input->post('keyYear'))->get('tb_subjects')->result();
        }else{
            $subject = $this->db->where('SubjectYear',$CheckYear->schyear_year)->get('tb_subjects')->result();
        }
       
        foreach($subject as $record){
            $data[] = array( 
                "SubjectYear" => $record->SubjectYear,
                "SubjectCode" => $record->SubjectCode,
                "SubjectName" => $record->SubjectName,
                "FirstGroup" => $record->FirstGroup,
                "SubjectClass" => $record->SubjectClass,
                "SubjectYear" => $record->SubjectYear,
                "SubjectID" => $record->SubjectID,
                "keyYear" => $this->input->post('keyYear')
            );

        }
        $output = array(
            "data" =>  $data,           
        );
        echo json_encode($output);
    }


    public function AdminRegisterSubjectInsert(){ 

        $check_subject = $this->db->where('SubjectCode',$this->input->post('SubjectCode'))
                ->where('SubjectYear',$this->input->post('SubjectYear'))
                ->get('tb_subjects')->num_rows();

        if($check_subject > 0){
            echo 0 ;

        }else{
            $data = array('SubjectCode' => $this->input->post('SubjectCode'),
            'SubjectName' => $this->input->post('SubjectName'),
            'SubjectUnit' => $this->input->post('SubjectUnit'),
            'SubjectHour' => $this->input->post('SubjectHour'),
            'SubjectType' => $this->input->post('SubjectType'),
            'FirstGroup' => $this->input->post('FirstGroup'),
            'SecondGroup' => $this->input->post('SecondGroup'), 
            'SubjectClass' => $this->input->post('SubjectClass'),
            'SubjectYear' => $this->input->post('SubjectYear'));  
             echo $this->ModAdminRegisterSubject->ModSubjectInsert($data);
    
        }
        
       
    }

    public function AdminRegisterSubjectUpdate(){      
        $data = array('SubjectCode' => $this->input->post('Up_SubjectCode'),
        'SubjectName' => $this->input->post('Up_SubjectName'),
        'SubjectUnit' => $this->input->post('Up_SubjectUnit'),
        'SubjectHour' => $this->input->post('Up_SubjectHour'),
        'SubjectType' => $this->input->post('Up_SubjectType'),
        'FirstGroup' => $this->input->post('Up_FirstGroup'),
        'SecondGroup' => $this->input->post('Up_SecondGroup'), 
        'SubjectClass' => $this->input->post('Up_SubjectClass'),
        'SubjectYear' => $this->input->post('Up_SubjectYear'));  
        $key = $this->input->post('Up_SubjectID');
        echo $this->ModAdminRegisterSubject->ModSubjectUpdate($data,$key);
    }
    public function AdminRegisterSubjectEdit(){ 
       echo json_encode($this->ModAdminRegisterSubject->ModSubjectEdit($this->input->post('KeySubj'))); 
    }

    public function AdminRegisterSubjectDelete($id){ 
        echo $this->ModAdminRegisterSubject->ModSubjectDelete($id); 
    }


}


?>
