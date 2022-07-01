<?php
class ModAdminRegisterSubject extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		
    }

    public function UpdateOnOff($check)
	{
		$this->db->where('onoff_ID',1);
		return $this->db->update('tb_register_onoff',array('onoff_status' => $check));
	}

	public function ModSubjectInsert($data)
	{				
		return  $this->db->insert('tb_subjects',$data);
	}

	public function ModSubjectDelete($id)
	{	
		$this->db->where('SubjectID', $id);
		return 	$this->db->delete('tb_subjects');
	}
}