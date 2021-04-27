<?php
class ModTeacherCourse extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		
    }

    function plan_insert($data){        
        $result = $this->db->insert('tb_send_plan',$data);
        return $result;
    }

    function plan_setting($data,$id){
        $result = $this->db->update('tb_send_plan_setup',$data,'seplanset_ID='.$id);
        return $result;
    }
 
}