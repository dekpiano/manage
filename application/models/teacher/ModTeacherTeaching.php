<?php
class ModTeacherTeaching extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		
    }

    function RoomOnlineInsert($data){        
        $result = $this->db->insert('tb_room_online',$data);
        return $result;
    }
    function RoomOnlineUpdate($data,$id){        
        $result = $this->db->update('tb_room_online',$data,'roomon_id="'.$id.'"');
        return $result;
    }
    public function RoomOnlineDelete($data)
	{		
				$this->db->where('roomon_id', $data);
		return 	$this->db->delete('tb_room_online');
	}
 
}