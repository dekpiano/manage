<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConAdminClassSchedule extends CI_Controller {
var  $title = "แผงควบคุม";
	public function __construct() {
		parent::__construct();
		
		 // โหลดไลบรารี upload และ image_lib
		 $this->load->library('upload');
		 $this->load->library('image_lib');

		$this->load->model('admin/ModAdminClassSchedule');
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

    public function AdminClassScheduleMain(){   
		$DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['admin'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
		$data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
$data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
		$data['title'] = "ตารางเรียน";		
		$this->db->select('*');
		$this->db->from('tb_class_schedule');
		$this->db->order_by('schestu_classname','ASC');
		$data['class_schedule'] = $this->db->get()->result();

		
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminClassSchedule/AdminClassScheduleMain.php');
        $this->load->view('admin/layout/Footer.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }
    
    public function add(){   
		$DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['admin'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
		$data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
$data['checkOnOff'] = $this->db->select('*')->from('tb_register_onoff')->get()->result();
		$data['title'] = "ตารางเรียน";
		$data['icon'] = '<i class="far fa-plus-square"></i>';
		$data['color'] = 'primary';
		
		$this->db->select('*');
		$this->db->from('tb_class_schedule');
		$this->db->order_by('schestu_id','DESC');
		$data['class_schedule'] = $this->db->get()->result();

		$data['ClassRoom'] = $this->db->group_by('Reg_Class')->get('tb_regclass')->result();
		//print_r($data['ClassRoom']);
		
		$num = @explode("_", $data['class_schedule'][0]->schestu_id);
        $num1 = @sprintf("%03d",$num[1]+1);
        $data['class_schedule'] = 'schestu_'.$num1;
        $data['action'] = 'insert_class_schedule';

        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminClassSchedule/AdminClassScheduleForm.php');
        $this->load->view('admin/layout/Footer.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
	}
	
	public function insert_class_schedule()
	{
		// print_r($_FILES); 
		// print_r($_POST); 
		// exit();
		
		$config['upload_path']   = 'uploads/academic/class_schedule/'; //Folder สำหรับ เก็บ ไฟล์ที่  Upload
         $config['allowed_types'] = 'pdf|PDF|JPG|jpg|png|PNG|jpeg'; //รูปแบบไฟล์ที่ อนุญาตให้ Upload ได้
         $config['max_size']      = 0; //ขนาดไฟล์สูงสุดที่ Upload ได้ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
         $config['encrypt_name']  = true; //กำหนดเป็น true ให้ระบบ เปลียนชื่อ ไฟล์  อัตโนมัติ  ป้องกันกรณีชื่อไฟล์ซ้ำกัน
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('schestu_filename'))
			{
				$data = $this->upload->data();

				 // ปรับขนาดรูปภาพ
				 $resize_config['image_library'] = 'gd2';
				 $resize_config['source_image'] = $data['full_path'];
				 $resize_config['maintain_ratio'] = TRUE;
				 $resize_config['width'] = 2048;
				 $resize_config['height'] = 1080;
	 
				 $this->image_lib->initialize($resize_config);

				 if (!$this->image_lib->resize()) {
					echo $this->image_lib->display_errors();
				 }else{
					$data_insert = array(
						'schestu_id' => $this->input->post('schestu_id'),
						'schestu_name' => $this->input->post('schestu_name'),
						'schestu_classname' => $this->input->post('schestu_classname'),
						'schestu_filename' => $data['file_name'],
						'schestu_term' => $this->input->post('schestu_term'),
						'schestu_year' => $this->input->post('schestu_year'),
						'schestu_datetime' => date('Y-m-d H:i:s'),
						'schestu_user' => $this->session->userdata('login_id')
					);
					if($this->ModAdminClassSchedule->class_schedule_insert($data_insert) == 1){
						echo 1;
					}
				 }
			
				$this->image_lib->clear();

				
			}
			else
			{
				$error = array('error' => $this->upload->display_errors());
				print_r($error['error']);
				
				
			}
		
	}

	public function delete_class_schedule($data,$img)
	{	
		@unlink("./uploads/academic/class_schedule/".$img);
		if($this->ModAdminClassSchedule->class_schedule_delete($data) == 1){
			$this->session->set_flashdata(array('alert'=> 'success','messge' => 'ลบข้อมูลสำเร็จ'));
			redirect('Admin/Acade/Course/ClassSchedule', 'refresh');
		}
	}

    

}


?>
