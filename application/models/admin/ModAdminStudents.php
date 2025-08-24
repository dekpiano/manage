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
		return $this->db->update('tb_students',$data,'StudentCode='.$ID);
	}

	public function Students_Delete($id)
	{	
		$this->db->where('StudentCode', $id);
		return 	$this->db->delete('tb_students');
	}

    public function get_gender_count()
    {
        $query = $this->db->select("
            SUM(CASE WHEN StudentPrefix = 'นาย' OR StudentPrefix = 'เด็กชาย' THEN 1 ELSE 0 END) AS male_students,
            SUM(CASE WHEN StudentPrefix = 'นางสาว' OR StudentPrefix = 'เด็กหญิง' THEN 1 ELSE 0 END) AS female_students
        ")
        ->where('StudentStatus', '1/ปกติ')
        ->get('tb_students');
        return $query->row();
    }

    public function get_students_by_class()
    {
        $query = $this->db->select("
            SUBSTRING(StudentClass, 3, 1) as class_level,
            SUM(CASE WHEN StudentPrefix = 'นาย' OR StudentPrefix = 'เด็กชาย' THEN 1 ELSE 0 END) AS male_count,
            SUM(CASE WHEN StudentPrefix = 'นางสาว' OR StudentPrefix = 'เด็กหญิง' THEN 1 ELSE 0 END) AS female_count
        ")
        ->where('StudentStatus', '1/ปกติ')
        ->group_by('class_level')
        ->order_by('class_level', 'ASC')
        ->get('tb_students');
        return $query->result();
    }

    public function get_recent_students($limit = 5)
    {
        $query = $this->db->select('StudentCode, StudentClass, StudentPrefix, StudentFirstName, StudentLastName, StudentStatus')
        ->order_by('StudentID', 'DESC') 
        ->limit($limit)
        ->get('tb_students');
        
        $students = $query->result();
        // สร้าง Fullname
        foreach ($students as $student) {
            $student->Fullname = $student->StudentPrefix . $student->StudentFirstName . ' ' . $student->StudentLastName;
        }
        return $students;
    }

}