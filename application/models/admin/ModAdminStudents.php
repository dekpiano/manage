<?php
class ModAdminStudents extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		
    }

    public function Students_Inaert($data)
	{		
		return $this->db->insert('tb_students',$data);
	}

	public function Students_Update($data,$ID)
	{	
		return $this->db->update('tb_students',$data,'StudentIDNumber='.$ID);
	}

}