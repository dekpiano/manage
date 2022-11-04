<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConAdminGeneralPersonnel extends CI_Controller {
var  $title = "แผงควบคุม";
	public function __construct() {
		parent::__construct();

		$this->load->library('settingpresonnal');
        $this->load->model('admin/General/ModAdminPresonnel');

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
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $data['admin'] = $this->DBPers->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        $data['position'] = $this->DBSKJ->get('tb_position')->result();
        $data['learning'] = $this->DBSKJ->get('tb_learning')->result();
        //echo '<pre>'; print_r($data['position']); exit();
        $this->DBPers->select('*');
		$this->DBPers->from('tb_personnel');
		$this->DBPers->order_by('pers_id','DESC');
		$data['pers'] =	$this->DBPers->get()->result();		
		$num = @explode("_", $data['pers'][0]->pers_id);
        $num1 = @sprintf("%03d",$num[1]+1);
        $data['pers_id'] = 'pers_'.$num1;
    
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/General/AdminPresonnel/PagePresonnelMain.php');
        $this->load->view('admin/layout/Footer.php');      
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
                "pers_img" => $record->pers_img
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

    public function InsertDataPersonnel()
	{
        if($_FILES['pers_img']['error'] == 0){
            // print_r($_FILES['pers_img']['error']);
            // exit();
            $config['upload_path']   = 'uploads/General/Personnel/'; //Folder สำหรับ เก็บ ไฟล์ที่  Upload
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
    
                        $cover_image = $this->resizeImage($this->upload->data(),600,800,70);
                    
                        $data_update = array(
                            'pers_id' => $this->input->post('pers_id'),
                            'pers_status' => $this->input->post('pers_status'),
                            'pers_prefix' => $this->input->post('pers_prefix'),
                            'pers_firstname' => $this->input->post('pers_firstname'),
                            'pers_lastname' => $this->input->post('pers_lastname'),
                            'pers_britday' => $this->input->post('pers_britday'),
                            'pers_phone' => $this->input->post('pers_phone'),
                            'pers_address' => $this->input->post('pers_address'),
                            'pers_username' => $this->input->post('pers_username'),
                            'pers_position' => $this->input->post('pers_position'),
                            'pers_learning' => $this->input->post('pers_learning'),
                            'pers_academic' => $this->input->post('pers_academic'),
                            'pers_groupleade' => $this->input->post('pers_groupleade'),
                            'pers_dataUpdate' => date('Y-m-d H:i:s'),
                            'pers_userEdit' => $this->session->userdata('login_id'),
                            'pers_img' => $data['upload_data']['file_name']
                        );
            
                        echo $this->ModAdminPresonnel->Personnel_Insert($data_update);
                }
                else
                {
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error['error']);
                  
                    
                    
                }
        }else{
         
            $data_update = array(
                'pers_id' => $this->input->post('pers_id'),
                'pers_status' => $this->input->post('pers_status'),
                'pers_prefix' => $this->input->post('pers_prefix'),
                'pers_firstname' => $this->input->post('pers_firstname'),
                'pers_lastname' => $this->input->post('pers_lastname'),
                'pers_britday' => $this->input->post('pers_britday'),
                'pers_phone' => $this->input->post('pers_phone'),
                'pers_address' => $this->input->post('pers_address'),
                'pers_username' => $this->input->post('pers_username'),
                'pers_position' => $this->input->post('pers_position'),
                'pers_learning' => $this->input->post('pers_learning'),
                'pers_academic' => $this->input->post('pers_academic'),
                'pers_groupleade' => $this->input->post('pers_groupleade'),
                'pers_dataUpdate' => date('Y-m-d H:i:s'),
                'pers_userEdit' => $this->session->userdata('login_id')
            );

            echo $this->ModAdminPresonnel->Personnel_Insert($data_update);
        }
	}


	public function UpdateDataPersonnel($IDPres = null)
	{
        if($_FILES['pers_img']['error'] == 0){
            
            $img = $this->DBPers->select('pers_img')->where('pers_id',$IDPres)->get('tb_personnel')->row();
            //exit();
            $config['upload_path']   = 'uploads/General/Personnel/'; //Folder สำหรับ เก็บ ไฟล์ที่  Upload
             $config['allowed_types'] = 'gif|jpg|jpeg|png'; //รูปแบบไฟล์ที่ อนุญาตให้ Upload ได้
             $config['max_size']      = 0; //ขนาดไฟล์สูงสุดที่ Upload ได้ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
             $config['max_width']     = 0; //ขนาดความกว้างสูงสุด (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
             $config['max_height']    = 0;  //ขนาดความสูงสูงสดุ (กรณีไม่จำกัดขนาด กำหนดเป็น 0)
             $config['encrypt_name']  = true; //กำหนดเป็น true ให้ระบบ เปลียนชื่อ ไฟล์  อัตโนมัติ  ป้องกันกรณีชื่อไฟล์ซ้ำกัน
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('pers_img'))
                {
                    @unlink("./uploads/General/Personnel/".$img->pers_img);
                        $data = array('upload_data' => $this->upload->data());	
                        $cover_image = $this->resizeImage($this->upload->data(),600,800,70);
                    
                        $data_update = array(
                            'pers_status' => $this->input->post('pers_status'),
                            'pers_prefix' => $this->input->post('pers_prefix'),
                            'pers_firstname' => $this->input->post('pers_firstname'),
                            'pers_lastname' => $this->input->post('pers_lastname'),
                            'pers_britday' => $this->input->post('pers_britday'),
                            'pers_phone' => $this->input->post('pers_phone'),
                            'pers_address' => $this->input->post('pers_address'),
                            'pers_username' => $this->input->post('pers_username'),
                            'pers_position' => $this->input->post('pers_position'),
                            'pers_learning' => $this->input->post('pers_learning'),
                            'pers_academic' => $this->input->post('pers_academic'),
                            'pers_groupleade' => $this->input->post('pers_groupleade'),
                            'pers_dataUpdate' => date('Y-m-d H:i:s'),
                            'pers_userEdit' => $this->session->userdata('login_id'),
                            'pers_img' => $data['upload_data']['file_name']
                        );
            
                        echo $this->ModAdminPresonnel->Presonnel_Update($data_update,$this->input->post('pers_id'));
                }
                else
                {
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error['error']);
                  
                    
                    
                }
        }else{
         
            $data_update = array(
                'pers_status' => $this->input->post('pers_status'),
                'pers_prefix' => $this->input->post('pers_prefix'),
                'pers_firstname' => $this->input->post('pers_firstname'),
                'pers_lastname' => $this->input->post('pers_lastname'),
                'pers_britday' => $this->input->post('pers_britday'),
                'pers_phone' => $this->input->post('pers_phone'),
                'pers_address' => $this->input->post('pers_address'),
                'pers_username' => $this->input->post('pers_username'),
                'pers_position' => $this->input->post('pers_position'),
                'pers_learning' => $this->input->post('pers_learning'),
                'pers_academic' => $this->input->post('pers_academic'),
                'pers_groupleade' => $this->input->post('pers_groupleade'),
                'pers_dataUpdate' => date('Y-m-d H:i:s'),
                'pers_userEdit' => $this->session->userdata('login_id')
            );

            echo $this->ModAdminPresonnel->Presonnel_Update($data_update,$this->input->post('pers_id'));
        }
	}

    public function DeletePersonnel()
	{
        @unlink("./uploads/General/Personnel/".$this->input->post('KeyImg'));
		$this->ModAdminPresonnel->Personnel_Delete($this->input->post('KeyTeacher'));
	}





}


?>
