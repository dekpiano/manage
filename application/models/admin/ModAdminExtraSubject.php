<?php
class ModAdminExtraSubject extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		
    }

    public function ExtraSubject_Add($data)
	{		
		return $this->db->insert('tb_extra_subject',$data);
	}

	public function ExtraSubject_Update($data,$id)
	{		
		return $this->db->update('tb_extra_subject',$data,"extra_id='".$id."'");
	}
}