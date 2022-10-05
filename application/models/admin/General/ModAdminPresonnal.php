<?php
class ModAdminPresonnal extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		
    }

    public function Presonnal_Update($data,$id)
	{		
				$DBpersonnel = $this->load->database('personnel', TRUE); 
				$DBpersonnel->where('pers_id',$id);
		return 	$DBpersonnel->update('tb_personnel',$data);
	}
}