<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConTeacherStudentSupport extends CI_Controller {
var  $title = "หน้าแรก";
	public function __construct() {
		parent::__construct();
		
		if (empty($this->session->userdata('fullname')) && !$this->session->userdata('status') == 'admin') {      
			redirect('welcome','refresh');
		}
        // if($this->session->userdata('CheckStatusPassword') == ""){
        //     redirect('Teacher/Profile','refresh');
        // }
//echo $this->session->userdata('fullname'); exit();
    }

    public function SupStdMain(){      
        $data['title']  = "หน้าแรก";
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $DBaffairs = $this->load->database('affairs', TRUE);

        $data['CClass'] = $CClass = $this->db->where('class_teacher',$this->session->userdata('login_id'))->get('tb_regclass')->result();
        $checkStatus = strlen($CClass[0]->Reg_Class);
        if($checkStatus == 3){
            $data['AllAffairs'] = $DBaffairs->where('s_homevisit_class',$CClass[0]->Reg_Class)->order_by('s_homevisit_class')->get('tb_send_homevisit')->result();
        }elseif($checkStatus == 1){           
            $data['AllAffairs'] = $DBaffairs->where('s_homevisit_year','2564')->order_by('s_homevisit_class')->get('tb_send_homevisit')->result();
        }
              
        //echo '<pre>'; print_r($CClass); exit();
        $data['teacher'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();

        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/StudentSupport/SupStdMain.php');
        $this->load->view('teacher/layout/footer_teacher.php');
        
    }

    public function SupStdAdd(){  
        $DBaffairs = $this->load->database('affairs', TRUE);
        $CClass = $this->db->where('class_teacher',$this->session->userdata('login_id'))->get('tb_regclass')->result();
        $CheckClsss = $DBaffairs
                        ->where('s_homevisit_class',$CClass[0]->Reg_Class)
                        ->where('s_homevisit_year',$this->input->post('s_homevisit_year'))
                        ->get('tb_send_homevisit')
                        ->num_rows();
        //echo '<pre>'; print_r($CheckClsss);  exit();
        if($CheckClsss > 0){
            $this->session->set_flashdata(array('status'=>'info','msg'=>'YES','messge'=>'ข้อมูลซ้ำ ,ได้บันทึกไว้แล้ว กรุณาตรวจสอบอีกครั้ง'));
            redirect('Teacher/SupStdMain');
        }else{
            $data = array('s_homevisit_year' => $year = $this->input->post('s_homevisit_year'),
            's_homevisit_class' => $CClass[0]->Reg_Class,
            's_homevisit_date' => date('Y-m-d H:i:s'),
            's_homevisit_status' => "รอตรวจ",
            's_homevisit_teac_id' => $this->session->userdata('login_id')); 
            $add = $DBaffairs->insert('tb_send_homevisit',$data);
            if($add){
            $this->session->set_flashdata(array('status'=>'success','msg'=>'YES','messge'=>'บันทึกข้อมูลไว้แล้ว และให้เพิ่มไฟล์ตามเมนูที่กำหนด'));
            redirect('Teacher/SupStdMain');
            }
        }
        
    }
    public function Add_filecoversheet(){ 
        $DBaffairs = $this->load->database('affairs', TRUE);
        //echo var_dump(is_dir("./uploads/affairs/helpstd/filecoversheet/")); exit();
        $AffID= $this->input->post('AffID'); 
        $delfile = $DBaffairs->select('s_homevisit_id,s_homevisit_filecoversheet')->where('s_homevisit_id',$AffID)->get('tb_send_homevisit')->result();   
        if($delfile[0]->s_homevisit_filecoversheet != NULL){
            unlink('./uploads/affairs/helpstd/filecoversheet/'.$delfile[0]->s_homevisit_filecoversheet);
        }     
        $config['upload_path']= "./uploads/affairs/helpstd/filecoversheet/";
        $config['allowed_types']='*';
        $config['file_name'] = date('YmdHis').'_'.$_FILES["s_homevisit_filecoversheet"]['name'];
         
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if($this->upload->do_upload("s_homevisit_filecoversheet")){
            $data = array('upload_data' => $this->upload->data());
            $image= $data['upload_data']['file_name'];         
                      
             $arrayName = array('s_homevisit_filecoversheet' =>$image);
            $result= $DBaffairs->update('tb_send_homevisit',$arrayName,'s_homevisit_id='.$AffID);
            echo json_decode($AffID);
        }else{
            print_r($this->upload->display_errors()); 
        }
    }

    public function Add_homevisit_fileSDQ(){ 
        $DBaffairs = $this->load->database('affairs', TRUE);
        $AffID= $this->input->post('AffID'); 
        $delfile = $DBaffairs->select('s_homevisit_id,s_homevisit_fileSDQ')->where('s_homevisit_id',$AffID)->get('tb_send_homevisit')->result();   
        if($delfile[0]->s_homevisit_fileSDQ != NULL){
            unlink('./uploads/affairs/helpstd/fileSDQ/'.$delfile[0]->s_homevisit_fileSDQ);
        } 
        $config['upload_path']= "./uploads/affairs/helpstd/fileSDQ/";
        $config['allowed_types']='*';
        $config['file_name'] = date('YmdHis').'_'.$_FILES["s_homevisit_fileSDQ"]['name'];
         
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if($this->upload->do_upload("s_homevisit_fileSDQ")){
            $data = array('upload_data' => $this->upload->data());
            $image= $data['upload_data']['file_name']; 
           
             $arrayName = array('s_homevisit_fileSDQ' =>$image);
            $result= $DBaffairs->update('tb_send_homevisit',$arrayName,'s_homevisit_id='.$AffID);
            echo json_decode($AffID);
        }else{
            print_r($this->upload->display_errors()); 
        }
    }

    public function Add_homevisit_filerecordform(){ 
        $DBaffairs = $this->load->database('affairs', TRUE);
        $AffID= $this->input->post('AffID'); 
        $delfile = $DBaffairs->select('s_homevisit_id,s_homevisit_filerecordform')->where('s_homevisit_id',$AffID)->get('tb_send_homevisit')->result();   
        if($delfile[0]->s_homevisit_filerecordform != NULL){
            unlink('./uploads/affairs/helpstd/filerecordform/'.$delfile[0]->s_homevisit_filerecordform);
        } 
        $config['upload_path']= "./uploads/affairs/helpstd/filerecordform/";
        $config['allowed_types']='*';
        $config['file_name'] = date('YmdHis').'_'.$_FILES["s_homevisit_filerecordform"]['name'];
         
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if($this->upload->do_upload("s_homevisit_filerecordform")){
            $data = array('upload_data' => $this->upload->data());
            $image= $data['upload_data']['file_name']; 
           
             $arrayName = array('s_homevisit_filerecordform' =>$image);
            $result= $DBaffairs->update('tb_send_homevisit',$arrayName,'s_homevisit_id='.$AffID);
            echo json_decode($AffID);
        }else{
            print_r($this->upload->display_errors()); 
        }
    }

    public function Add_homevisit_filesummary(){ 
        $DBaffairs = $this->load->database('affairs', TRUE);
        $AffID= $this->input->post('AffID'); 
        $delfile = $DBaffairs->select('s_homevisit_id,s_homevisit_filesummary')->where('s_homevisit_id',$AffID)->get('tb_send_homevisit')->result();   
        if($delfile[0]->s_homevisit_filesummary != NULL){
            unlink('./uploads/affairs/helpstd/filesummary/'.$delfile[0]->s_homevisit_filesummary);
        } 
        $config['upload_path']= "./uploads/affairs/helpstd/filesummary/";
        $config['allowed_types']='*';
        $config['file_name'] = date('YmdHis').'_'.$_FILES["s_homevisit_filesummary"]['name'];
         
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if($this->upload->do_upload("s_homevisit_filesummary")){
            $data = array('upload_data' => $this->upload->data());
            $image= $data['upload_data']['file_name']; 
           
             $arrayName = array('s_homevisit_filesummary' =>$image);
            $result= $DBaffairs->update('tb_send_homevisit',$arrayName,'s_homevisit_id='.$AffID);
            echo json_decode($AffID);
        }else{
            print_r($this->upload->display_errors()); 
        }
    }

    public function confrim_status(){ 
        $DBaffairs = $this->load->database('affairs', TRUE);
        $AffID= $this->input->post('AffID'); 
        $status= $this->input->post('s_homevisit_status'); 
               
   
             $arrayName = array('s_homevisit_status' =>$status);
            $result= $DBaffairs->update('tb_send_homevisit',$arrayName,'s_homevisit_id='.$AffID);
            echo json_decode($result);
      
    }


   
}


?>