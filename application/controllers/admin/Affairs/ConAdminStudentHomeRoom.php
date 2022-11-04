<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConAdminStudentHomeRoom extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('admin/ModAdminExtraSubject');
		if (empty($this->session->userdata('fullname'))) {		
			redirect('LoginAdmin','refresh');
		}
        $this->DBpersonnel = $this->load->database('personnel', TRUE); //ฐานข้อมูลบุคลากร
        $this->DBaffairs = $this->load->database('affairs', TRUE); //ฐานข้อมูลงานกิจการนักเรียน
    }

    public function TeacRoom(){
        $DBpersonnel = $this->load->database('personnel', TRUE);
        $teacher = $this->db->select('skjacth_personnel.tb_personnel.pers_prefix,
        skjacth_personnel.tb_personnel.pers_firstname,
        skjacth_personnel.tb_personnel.pers_lastname,
        skjacth_personnel.tb_personnel.pers_id,
        skjacth_academic.tb_regclass.Reg_Year,
        skjacth_academic.tb_regclass.Reg_Class')
        ->join($DBpersonnel->database.'.tb_personnel','skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_regclass.class_teacher')
        ->where('pers_id',$this->session->userdata('login_id'))
        ->where('Reg_Year','2565')
        ->get('tb_regclass')->result();

        return $teacher;
    }

    public function index(){  

    } 

    public function PageHomeRoomDashboard($key){ 
        $data['title'] = "แดชบอร์ดโฮมรูม";
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $data['Time'] = $this->DBaffairs->select('set_homeroom_time')->where('set_homeroom_id',1)->get('tb_checkhomeroom_setting')->result();
        
         //print_r($date); exit();
        $data['showHR'] = $this->DBaffairs->where('chk_home_date',date('Y-m-d', strtotime($key)))                               
                                ->order_by('chk_home_room','ASC')
                                ->get('tb_checkhomeroom')                                
                                ->result();
              

        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Affairs/AdminAffairs/AdminStudentHomeRoom/AdminPageHomeRoomDashboard.php');
        $this->load->view('admin/layout/Footer.php');
    }

    function ChartHomeRoomAll(){
        $data['teacher'] = $this->TeacRoom();
        $checif = array('chk_home_term'=>'1',
                            'chk_home_yaer'=>'2565'
                        );                                        
        $ChkHomeRoom = $this->DBaffairs->select('*')
                ->where($checif)
                ->where('chk_home_date',date('Y-m-d',strtotime($this->input->post('key'))))
                ->order_by('chk_home_date','DESC')
                ->get('tb_checkhomeroom')->result();
    
        $home_ma=0;$home_khad=0;$home_sahy=0;  $home_la=0; $home_kid=0; $home_hnee=0;
        for ($i=0; $i < count($ChkHomeRoom); $i++) {  
            $ChkHomeRoom[$i]->chk_home_ma !== "" ? $home_ma += count(explode('|', $ChkHomeRoom[$i]->chk_home_ma)) : $home_ma += 0;
            $ChkHomeRoom[$i]->chk_home_khad !== "" ? $home_khad +=  count(explode('|', $ChkHomeRoom[$i]->chk_home_khad)) : $home_khad += 0;
            $ChkHomeRoom[$i]->chk_home_sahy !== "" ? $home_sahy +=  count(explode('|', $ChkHomeRoom[$i]->chk_home_sahy)) : $home_sahy += 0;
            $ChkHomeRoom[$i]->chk_home_la !== "" ? $home_la +=  count(explode('|', $ChkHomeRoom[$i]->chk_home_la)) : $home_la += 0;            
            $ChkHomeRoom[$i]->chk_home_kid !== "" ? $home_kid +=  count(explode('|', $ChkHomeRoom[$i]->chk_home_kid)) : $home_kid += 0;
            $ChkHomeRoom[$i]->chk_home_hnee !== "" ? $home_hnee +=  count(explode('|', $ChkHomeRoom[$i]->chk_home_hnee)) : $home_hnee += 0;
        }
      
        $data = [$home_ma,$home_khad,$home_sahy,$home_la,$home_kid,$home_hnee];
        echo json_encode($data);

    }

    // ------------------ ตั้งค่าระบบ ---------------------------
    public function PageSettingHomeRoom(){ 
        $data['SchoolYear'] = $this->db->get('tb_schoolyear')->row();
        $data['title'] = "ตั้งค่าระบบโฮมรูม";        
        $data['Time'] = $this->DBaffairs->select('set_homeroom_time')->where('set_homeroom_id',1)->get('tb_checkhomeroom_setting')->result();
       // print_r($data['Time']);exit();
        $data['NameTeacher'] = $this->DBpersonnel->select('pers_id,pers_prefix,pers_firstname,pers_lastname,pers_position,pers_learning')
         ->from('tb_personnel')
         ->where('pers_position !=','posi_001')
         ->where('pers_position !=','posi_002')
         ->where('pers_position !=','posi_007')
         ->where('pers_position !=','posi_008')
         ->where('pers_position !=','posi_009')
         ->where('pers_position !=','posi_010')
         ->order_by('pers_learning')
         ->get()->result();
        $this->load->view('admin/layout/Header.php',$data);
        $this->load->view('admin/Affairs/AdminAffairs/AdminStudentHomeRoom/AdminPageSettingHomeRoom.php');
        $this->load->view('admin/layout/Footer.php');

    }

    public function UpdateTimeHomeRoom() {  
        $data = array('set_homeroom_time' => $this->input->post('set_homeroom_time'));
        $result = $this->DBaffairs->update('tb_checkhomeroom_setting',$data,'set_homeroom_id=1');
        echo $result;
    }

    
    

}


?>
