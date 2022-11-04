<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConAdminExamSchedule extends CI_Controller {
var  $title = "แผงควบคุม";
	public function __construct() {
		parent::__construct();
		
		$this->load->model('admin/ModAdminExamSchedule');
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

    public function AdminExamScheduleMain(){   
		$DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['admin'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
		$data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
		$data['title'] = "ตารางสอบ";		
		$this->db->select('*');
		$this->db->from('tb_exam_schedule');
		$this->db->order_by('exam_id','DESC');
		$data['exam_schedule'] = $this->db->get()->result();

		
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminExamSchedule/AdminExamScheduleMain.php');
        $this->load->view('admin/layout/Footer.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }
    
    public function add(){   
		$DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['admin'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();

		$data['title'] = "ตารางสอบ";
		$data['icon'] = '<i class="far fa-plus-square"></i>';
		$data['color'] = 'primary';
		
		$this->db->select('*');
		$this->db->from('tb_exam_schedule');
		$this->db->order_by('exam_id','DESC');
		$data['exam_schedule'] = $this->db->get()->result();

		$data['ClassRoom'] = $this->db->group_by('Reg_Class')->get('tb_regclass')->result();
		//print_r($data['ClassRoom']);
		
		$num = @explode("_", $data['exam_schedule'][0]->exam_id);
        $num1 = @sprintf("%03d",$num[1]+1);
        $data['exam_schedule'] = 'exam_'.$num1;
        $data['action'] = 'insert_exam_schedule';

        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminExamSchedule/AdminExamScheduleForm.php');
        $this->load->view('admin/layout/Footer.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
	}
	
	public function insert_exam_schedule()
	{
		//print_r($_FILES);
		
		$config['upload_path']   = 'uploads/academic/exam_schedule/'; //Folder สำหรับ เก็บ ไฟล์ที่  Upload
         $config['allowed_types'] = 'pdf|PDF'; //รูปแบบไฟล์ที่ อนุญาตให้ Upload ได้
         $config['max_size']      = 0; //ขนาดไฟล์สูงสุดที่ Upload ได้ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
         $config['encrypt_name']  = true; //กำหนดเป็น true ให้ระบบ เปลียนชื่อ ไฟล์  อัตโนมัติ  ป้องกันกรณีชื่อไฟล์ซ้ำกัน
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('exam_filename'))
			{
				$data = array('upload_data' => $this->upload->data());

				$data_insert = array(
						'exam_id' => $this->input->post('exam_id'),
						'exam_type' => $this->input->post('exam_type'),
						'exam_term' => $this->input->post('exam_term'),
						'exam_year' => $this->input->post('exam_year'),
						'exam_filename' => $data['upload_data']['file_name'],
						'exam_create' => date('Y-m-d H:i:s'),
						'exam_user' => $this->session->userdata('login_id')
					);
				if($this->ModAdminExamSchedule->exam_schedule_insert($data_insert) == 1){
					$this->session->set_flashdata(array('alert'=> 'success','messge' => 'บันทึกข้อมูลสำเร็จ'));
					redirect('Admin/ExamSchedule', 'refresh');
				}
			}
			else
			{
				$error = array('error' => $this->upload->display_errors());
				//print_r($error['error']);
				$this->session->set_flashdata(array('alert'=> 'error','messge' => 'เพิ่มได้แค่ไฟล์ PDF '));
				redirect('Admin/ExamSchedule/add', 'refresh');
			}
		
	}

	public function delete_exam_schedule($data,$img)
	{	
		@unlink("./uploads/academic/exam_schedule/".$img);
		if($this->ModAdminExamSchedule->exam_schedule_delete($data) == 1){
			$this->session->set_flashdata(array('alert'=> 'success','messge' => 'ลบข้อมูลสำเร็จ'));
			redirect('Admin/ExamSchedule', 'refresh');
		}
	}

    

}


?>
