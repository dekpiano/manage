<?php
class ModAdminSaveScore extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		
    }

    public function UpdateOnOffSaveScore($key,$value)
	{

		$this->db->where('onoff_id',$key);		
		return $this->db->update('tb_register_onoff',array('onoff_status' => $value));
	}
}