<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConAdminClassRoom extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('admin/ModAdminClassRoom');
		if (empty($this->session->userdata('fullname'))) {		
			redirect('LoginAdmin','refresh');
		}

        $this->load->library('Classroom');

        $data['check_status'] = $this->db->where('admin_rloes_userid',$this->session->userdata('login_id'))->get('tb_admin_rloes')->row();
        if(@$data['check_status']->admin_rloes_status == "admin" || @$data['check_status']->admin_rloes_status == "manager"){
            
        }else{
            $this->session->set_flashdata(array('msg'=>'OK','messge'=> 'คุณไม่มีสิทธ์ในระบบจัดข้อมูลนี้ ติดต่อเจ้าหน้าที่คอม','alert'=>'error'));
            redirect('welcome','refresh');
        }

    }

    public function AdminClassMain(){   

        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['admin'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        
		$data['title'] = "ห้องเรียน / ที่ปรึกษา / ครูหัวหน้าระดับ";		
		$this->db->select('*');
        $this->db->from('tb_regclass');
        $this->db->join($DBpersonnel->database.'.tb_personnel','tb_personnel.pers_id = tb_regclass.class_teacher');
		$this->db->order_by('Reg_Class','ASC');
        $data['classRoom'] = $this->db->get()->result();
        
        $data['NameTeacher'] = $DBpersonnel->select('pers_id,pers_prefix,pers_firstname,pers_lastname,pers_position')
        ->from('tb_personnel')
        ->where('pers_position !=','posi_001')
        ->where('pers_position !=','posi_002')
        ->where('pers_position <','posi_007')
        ->order_by('pers_learning')
        ->get()->result();

        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Academic/AdminClassRoom/AdminClassRoomMain.php');
        $this->load->view('admin/layout/Footer.php');
            
    }
    
    public function AddClassRoom(){   
        $dataClassRoom = array('Reg_Year'=>$this->input->post('year'),
                                'Reg_Class'=>$this->input->post('classroom'),
                                'class_teacher'=>$this->input->post('teacher'));
        print_r($this->ModAdminClassRoom->ClassRoom_Add($dataClassRoom));
    }

    public function DeleteClassRoom($data){           
        //echo $data; exit();
        print_r($this->ModAdminClassRoom->ClassRoom_Delete($data));
        $this->session->set_flashdata(array('msg'=> 'YES','status'=> 'success','messge' => 'ลบข้อมูลสำเร็จ'));
        redirect('Admin/Registration/ClassRoom');
    }

}


?>
