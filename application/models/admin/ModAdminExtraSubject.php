<?php
class ModAdminExtraSubject extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		
    }

    public function ExtraSubject_Add($data)
	{		
		return $this->db->insert('tb_regclass',$data);
	}
}