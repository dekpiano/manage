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

	public function validlogin()
	{	
	
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
 
			if($this->input->server('REQUEST_METHOD') == TRUE){
				if($this->Model_login->record_count($username, $password) == 1)
				{
					$result = $this->Model_login->fetch_user_login($username, $password);
					$this->session->set_userdata(array('login_id' => $result->StudentID,'StudentCode' => $result->StudentCode,'fullname'=> $result->StudentPrefix.$result->StudentFirstName.' '.$result->StudentLastName,'status'=> 'user','class' => $result->StudentClass));

					set_cookie('username_cookie',$username,'3600'); 
					set_cookie('password_cookie',$password,'3600');

					$this->session->set_userdata(array('login_id' => $result->StudentID,'StudentCode' => $result->StudentCode,'fullname'=> $result->StudentPrefix.$result->StudentFirstName.' '.$result->StudentLastName,'status'=> 'user'));

				 redirect('Home');
					//echo "Yes";

				}
				else
				{
					$this->session->set_flashdata(array('msgerr'=> 'NO'));
					// redirect('login');

					redirect('Login', 'refresh');
				}
			}
	}

	public function LoginAdmin()
	{	
		
	
			$username = $this->input->post('username');
			$password = md5(md5($this->input->post('password')));
			
			
			if($this->input->server('REQUEST_METHOD') == TRUE){
				if($this->Model_login->record_count_admin($username, $password) == 1)
				{

					$result = $this->Model_login->fetch_admin_login($username, $password);
					$this->session->set_userdata(array('login_id' => $result->pers_id,'pers_learning' => $result->pers_learning,'fullname'=> $result->pers_prefix.$result->pers_firstname.' '.$result->pers_lastname,'status'=> 'admin','class' => $result->StudentClass,'img' => $result->pers_img));

					set_cookie('username_cookie',$username,'3600'); 
					set_cookie('password_cookie',$password,'3600');

				 redirect('Teacher/Home');
					//echo "Yes";

				}
				else
				{
					
					$this->session->set_flashdata(array('msgerr'=> 'NO'));
					// redirect('login');
					redirect('Home', 'refresh');
				}
			}
	}		



	public function logout()
	{
		delete_cookie('username_cookie'); 
		delete_cookie('password_cookie'); 
		$this->session->sess_destroy();
		redirect('Login', 'refresh');
	}

	public function LogoutTeacher()
	{
		delete_cookie('username_cookie'); 
		delete_cookie('password_cookie'); 
		$this->session->sess_destroy();
		redirect('welcome', 'refresh');
	}

}