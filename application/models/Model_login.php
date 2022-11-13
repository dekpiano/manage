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

	public function record_count_teacher1($username,$password)
	{
		$DBpersonnel = $this->load->database('personnel', TRUE); 
		$DBpersonnel->where('pers_username',$username);
		$DBpersonnel->where('pers_password',$password);
		return $DBpersonnel->count_all_results('tb_personnel');
	}

	public function fetch_teacher_login1($username,$password)
	{
		$DBacademic = $this->load->database('default', TRUE); 
		$DBpersonnel = $this->load->database('personnel', TRUE); 
		$DBgeneral = $this->load->database('general', TRUE);

		$query = $DBpersonnel->select('
			skjacth_personnel.tb_personnel.pers_id,
			skjacth_personnel.tb_personnel.pers_prefix,
			skjacth_personnel.tb_personnel.pers_firstname,
			skjacth_personnel.tb_personnel.pers_lastname,
			skjacth_personnel.tb_personnel.pers_img,
			skjacth_personnel.tb_personnel.pers_groupleade,
			skjacth_personnel.tb_personnel.pers_learning,
			skjacth_general.tb_admin_rloes.admin_rloes_id AS general_rloes_id,
			skjacth_academic.tb_admin_rloes.admin_rloes_id AS academic_rloes_id,
			skjacth_general.tb_admin_rloes.admin_rloes_nanetype AS general_nanetype,
			skjacth_academic.tb_admin_rloes.admin_rloes_nanetype AS academic_nanetype,
			skjacth_academic.tb_admin_rloes.admin_rloes_status AS academic_status,
			skjacth_general.tb_admin_rloes.admin_rloes_status AS general_status
		')
		->from('skjacth_personnel.tb_personnel')
		->join('skjacth_general.tb_admin_rloes','skjacth_general.tb_admin_rloes.admin_rloes_userid = skjacth_personnel.tb_personnel.pers_id','left')
		->join('skjacth_academic.tb_admin_rloes','skjacth_academic.tb_admin_rloes.admin_rloes_userid = skjacth_personnel.tb_personnel.pers_id','left')
		->where('pers_username',$username)
		->where('pers_password',$password)
		->get();

		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}

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

	public function check_login_teacher($email)
	{
		$DBpersonnel = $this->load->database('personnel', TRUE); 
		$DBpersonnel->where('pers_username',$email);
		$query = $DBpersonnel->get('tb_personnel');
		return $query->num_rows();
	}

	function fetch_teacher_login($id)
	{
		$DBacademic = $this->load->database('default', TRUE); 
		$DBpersonnel = $this->load->database('personnel', TRUE); 
		$DBgeneral = $this->load->database('general', TRUE);

		$query = $DBpersonnel->select('
			skjacth_personnel.tb_personnel.pers_id,
			skjacth_personnel.tb_personnel.pers_prefix,
			skjacth_personnel.tb_personnel.pers_firstname,
			skjacth_personnel.tb_personnel.pers_lastname,
			skjacth_personnel.tb_personnel.pers_img,
			skjacth_personnel.tb_personnel.pers_groupleade,
			skjacth_personnel.tb_personnel.pers_learning,
			skjacth_general.tb_admin_rloes.admin_rloes_id AS general_rloes_id,
			skjacth_academic.tb_admin_rloes.admin_rloes_id AS academic_rloes_id,
			skjacth_general.tb_admin_rloes.admin_rloes_nanetype AS general_nanetype,
			skjacth_academic.tb_admin_rloes.admin_rloes_nanetype AS academic_nanetype,
			skjacth_academic.tb_admin_rloes.admin_rloes_status AS academic_status,
			skjacth_general.tb_admin_rloes.admin_rloes_status AS general_status
		')
		->from('skjacth_personnel.tb_personnel')
		->join('skjacth_general.tb_admin_rloes','skjacth_general.tb_admin_rloes.admin_rloes_userid = skjacth_personnel.tb_personnel.pers_id','left')
		->join('skjacth_academic.tb_admin_rloes','skjacth_academic.tb_admin_rloes.admin_rloes_userid = skjacth_personnel.tb_personnel.pers_id','left')
		->where('pers_username', $id)
		->get();
		

		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}

	function Update_user_data($data, $id)
		{
		$DBpersonnel = $this->load->database('personnel', TRUE); 
		$DBpersonnel->where('pers_username', $id);
		$DBpersonnel->update('tb_personnel', $data);
		}

}