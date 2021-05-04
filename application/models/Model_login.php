<?php
class Model_login extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		
	}

	public function record_count_student($username,$password)
	{
		$this->db->where('StudentCode',$username);
		$this->db->where('StudentIDNumber',$password);
		return $this->db->count_all_results('tb_students');
	}

	public function fetch_student_login($username,$password)
	{
		$this->db->where('StudentCode',$username);
		$this->db->where('StudentIDNumber',$password);
		$query = $this->db->get('tb_students');
		return $query->row();
	}

	public function record_count_teacher($username,$password)
	{
		$DBpersonnel = $this->load->database('personnel', TRUE); 
		$DBpersonnel->where('pers_username',$username);
		$DBpersonnel->where('pers_password',$password);
		return $DBpersonnel->count_all_results('tb_personnel');
	}

	public function fetch_teacher_login($username,$password)
	{
		$DBpersonnel = $this->load->database('personnel', TRUE); 
		$DBpersonnel->where('pers_username',$username);
		$DBpersonnel->where('pers_password',$password);
		$query = $DBpersonnel->get('tb_personnel');
		return $query->row();
	}

	public function record_count_admin($username,$password)
	{
		$DBpersonnel = $this->load->database('personnel', TRUE); 
		$DBpersonnel->where('pers_username',$username);
		$DBpersonnel->where('pers_password',$password);
		return $DBpersonnel->count_all_results('tb_personnel');
	}

	public function fetch_admin_login($username,$password)
	{
		$DBpersonnel = $this->load->database('personnel', TRUE); 
		$DBpersonnel->where('pers_username',$username);
		$DBpersonnel->where('pers_password',$password);
		$query = $DBpersonnel->get('tb_personnel');
		return $query->row();
	}

}