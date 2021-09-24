<?php
class ModAdminStudents extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		
    }

    public function Students_Add($data)
	{		
		return $this->db->insert('tb_regclass',$data);
	}
}