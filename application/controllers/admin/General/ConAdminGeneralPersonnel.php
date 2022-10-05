<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConAdminGeneralPersonnel extends CI_Controller {
var  $title = "แผงควบคุม";
	public function __construct() {
		parent::__construct();
		$this->load->library('settingpresonnal');
		if (empty($this->session->userdata('fullname'))) {		
			redirect('welcome','refresh');
		}

        $data['check_status'] = $this->db->where('admin_rloes_userid',$this->session->userdata('login_id'))->get('tb_admin_rloes')->row();
        if(@$data['check_status']->admin_rloes_status == "admin" || @$data['check_status']->admin_rloes_status == "manager"){
            
        }else{
            $this->session->set_flashdata(array('msg'=>'OK','messge'=> 'คุณไม่มีสิทธ์ในระบบจัดข้อมูลนี้ ติดต่อเจ้าหน้าที่คอม','alert'=>'error'));
            redirect('welcome','refresh');
        }

        $this->DBSKJ = $this->load->database('skj', TRUE);
        $this->DBPers = $this->load->database('personnel', TRUE);
    }


    public function PageAdminGeneralMain(){      
        $data['title'] = "หน้าแรกบุคคลกร";
        $data['admin'] = $this->DBPers->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
    
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/General/PageAdminGeneralMain.php');
        $this->load->view('admin/layout/Footer.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();        
    }

    public function ShowDataPersonnel(){
        $data = [];
       
        $personnel = $this->DBPers->select("tb_personnel.pers_id, 
		tb_personnel.pers_prefix, 
		tb_personnel.pers_firstname, 
		tb_personnel.pers_lastname, 
		tb_personnel.pers_position, 
		tb_personnel.pers_learning, 
		tb_position.posi_name, 
		tb_personnel.pers_username, 
		tb_personnel.pers_phone, 
		tb_learning.lear_namethai,
		tb_personnel.pers_academic,
		tb_personnel.pers_img,
		tb_personnel.pers_numberGroup,
        tb_personnel.pers_status")
        ->from('tb_personnel')
        ->join($this->DBSKJ->database.'.tb_position','tb_personnel.pers_position = tb_position.posi_id','LEFT')
		->join($this->DBSKJ->database.'.tb_learning','tb_personnel.pers_learning = tb_learning.lear_id','LEFT')
        ->get()->result();

        foreach($personnel as $record){
            
            $data[] = array( 
                "TeacherName" =>  $record->pers_prefix.$record->pers_firstname.' '.$record->pers_lastname,
                "TeacherID" => $record->pers_id,
                "pers_position" => $record->posi_name,
                "pers_learning" => $record->lear_namethai,
                "pers_status" => $record->pers_status,
            );
           
        }   

        $output = array(
            "data" =>  $data
        );

       // echo '<pre>'; print_r($Register);              
      
       echo json_encode($output);

    }

    public function EditDataPersonnel(){
        $personnel = $this->DBPers->select("tb_personnel.*,
		tb_position.posi_name, 
		tb_learning.lear_namethai")
        ->from('tb_personnel')
        ->join($this->DBSKJ->database.'.tb_position','tb_personnel.pers_position = tb_position.posi_id','LEFT')
		->join($this->DBSKJ->database.'.tb_learning','tb_personnel.pers_learning = tb_learning.lear_id','LEFT')
        ->where('pers_id',$this->input->post('KeyPresID'))
        ->get()->result();
        echo json_encode($personnel);
    }

    private function resizeImage($file,$width,$height,$quality){
		$image = $file;
		$this->load->library('image_lib'); 
		$config['image_library'] = 'gd2';
		$config['source_image'] = $image['full_path'];
		$config['maintain_ratio'] = FALSE; // ปรับขนาดโดยยังรักษาสัดส่วนของรูปไว้
		$config['quality'] = $quality; // ความละเอียดของรูปใหม่สูงสุด 100
		$config['width'] = $width; // ความกว้างของรูปภาพ
		$config['height'] = $height; // ความสูงของรูปภาพ
		$image = base_url("uploads/".$image['file_name']);		
		$this->image_lib->initialize($config);
		if ( ! $this->image_lib->resize())
		{
		  echo $this->image_lib->display_errors();
		}
	}

	public function UpdateDataPersonnel()
	{
        if($_FILES['pers_img']['error'] == 0){
            // print_r($_FILES['pers_img']['error']);
            // exit();
            $config['upload_path']   = 'uploads/General/Personnal/'; //Folder สำหรับ เก็บ ไฟล์ที่  Upload
             $config['allowed_types'] = 'gif|jpg|jpeg|png'; //รูปแบบไฟล์ที่ อนุญาตให้ Upload ได้
             $config['max_size']      = 0; //ขนาดไฟล์สูงสุดที่ Upload ได้ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
             $config['max_width']     = 0; //ขนาดความกว้างสูงสุด (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
             $config['max_height']    = 0;  //ขนาดความสูงสูงสดุ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
             $config['encrypt_name']  = true; //กำหนดเป็น true ให้ระบบ เปลียนชื่อ ไฟล์  อัตโนมัติ  ป้องกันกรณีชื่อไฟล์ซ้ำกัน
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('pers_img'))
                {
                    $data = array('upload_data' => $this->upload->data());				
    
                    // $data_insert = array(
                    //         'banner_name' => $this->input->post('banner_name'),
                    //         'banner_img' => $data['upload_data']['file_name'],
                    //         'banner_date' => date('Y-m-d H:i:s'),
                    //         'banner_linkweb' => $this->input->post('banner_linkweb'),
                    //         'banner_status' => "on",
                    //         'banner_personnel_id' => $this->session->userdata('login_id')
                    //     );
    
                        $cover_image = $this->resizeImage($this->upload->data(),600,800,70);
                        echo "บักทึกสำเร็จ";
                   
                }
                else
                {
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error['error']);
                  
                    
                    
                }
        }else{
            echo "ไม่ได้เลือกรูปภาพ";
        }
		
		
	}





}


?>
