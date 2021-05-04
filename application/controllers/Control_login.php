<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control_login extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Model_login');
	}

	public static $title = "เข้าสู่ระบบ";
	public static $description = "ระบบ Login โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์";
 	
 	public function dataAll(){
		$data['full_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
 		$data['title'] = self::$title;
		$data['description'] = self::$description; 		

		return $data;
 	}

	public function Login_main()
	{
		if(!empty(get_cookie('username_cookie')) && !empty(get_cookie('password_cookie')) ){
					 redirect('Logout');				
		}else{
			$data = $this->dataAll();
					$this->load->view('login/loginMain.php');
		}
	}

	public function LoginStudent(){
		$this->load->view('login/loginStudent.php');
	}

	public function LoginTeacher(){
		$this->load->view('login/loginTeacher.php');
	}

	public function check_student()
	{	
	
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
 
			if($this->input->server('REQUEST_METHOD') == TRUE){
				if($this->Model_login->record_count_student($username, $password) == 1)
				{
					$result = $this->Model_login->fetch_student_login($username, $password);
					$this->session->set_userdata(array('login_id' => $result->StudentID,'StudentCode' => $result->StudentCode,'fullname'=> $result->StudentPrefix.$result->StudentFirstName.' '.$result->StudentLastName,'status'=> 'user','class' => $result->StudentClass));

					set_cookie('username_cookie',$username,'3600'); 
					set_cookie('password_cookie',$password,'3600');

					$this->session->set_userdata(array('login_id' => $result->StudentID,'StudentCode' => $result->StudentCode,'fullname'=> $result->StudentPrefix.$result->StudentFirstName.' '.$result->StudentLastName,'status'=> 'user'));

				 redirect('Home');
					//echo "Yes";

				}
				else
				{
					$this->session->set_flashdata(array('status'=>'OK','msgerr'=> 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง','alert'=>'error'));
					// redirect('login');

					redirect('LoginStudent');
				}
			}
	}

	public function check_teacher()
	{	
			$username = $this->input->post('username');
			$password = md5(md5($this->input->post('password')));
			
			
			if($this->input->server('REQUEST_METHOD') == TRUE){
				if($this->Model_login->record_count_teacher($username, $password) == 1)
				{

					$result = $this->Model_login->fetch_teacher_login($username, $password);
					$this->session->set_userdata(array('login_id' => $result->pers_id,'pers_learning' => $result->pers_learning,'fullname'=> $result->pers_prefix.$result->pers_firstname.' '.$result->pers_lastname,'status'=> 'admin','class' => $result->StudentClass,'img' => $result->pers_img,'groupleade'=>$result->pers_groupleade));

					set_cookie('username_cookie',$username,'3600'); 
					set_cookie('password_cookie',$password,'3600');

				 redirect('Teacher/Home');
					//echo "Yes";

				}
				else
				{					
					$this->session->set_flashdata(array('status'=>'OK','msgerr'=> 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง','alert'=>'error'));
					// redirect('login');
					redirect('LoginTeacher');
				}
			}
	}		



	public function logout()
	{
		delete_cookie('username_cookie'); 
		delete_cookie('password_cookie'); 
		$this->session->sess_destroy();
		redirect('LoginStudent', 'refresh');
	}

	public function LogoutTeacher()
	{
		delete_cookie('username_cookie'); 
		delete_cookie('password_cookie'); 
		$this->session->sess_destroy();
		redirect('welcome', 'refresh');
	}

}