<?php
class ModAdminPresonnel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		
    }

	public function Personnel_Insert($data)
	{		
				$DBpersonnel = $this->load->database('personnel', TRUE); 
		return 	$DBpersonnel->insert('tb_personnel',$data);
	}

    public function Presonnel_Update($data,$id)
	{		
				$DBpersonnel = $this->load->database('personnel', TRUE); 
				$DBpersonnel->where('pers_id',$id);
		return 	$DBpersonnel->update('tb_personnel',$data);
	}

	public function Personnel_Delete($data)
	{		
				$DBpersonnel = $this->load->database('personnel', TRUE); 
				$DBpersonnel->where('pers_id',$data);
		return 	$DBpersonnel->delete('tb_personnel');
	}
}