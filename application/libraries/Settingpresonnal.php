<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Settingpresonnal {

    function GroupSaraMain(){ 
        $list  =  array('ภาษาไทย','คณิตศาสตร์','วิทยาศาสตร์และเทคโนโลยี','สังคมศึกษา ศาสนาและวัฒนธรรม','สุขศึกษาและพลศึกษา','ศิลปะ','การงานอาชีพ','ภาษาต่างประเทศ');
        return $list;
    }
    function GroupPosition(){ 
        $list  =  array('ผู้อำนวยการสถานศึกษา','รองผู้อำนวยการสถานศึกษา','ครู','ครูผู้ช่วย','ครูจ้างเหมา','พนักงานจ้างเหมา','พนักงานจ้างเหมาตามภารกิจ','ผู้ฝึกสอนกีฬา','พนักงานทั่วไป');
        return $list;
    }

    function GroupAcademic(){ 
        $list  =  array('ชำนาญการ','ชำนาญการพิเศษ','เชี่ยวชาญ','เชี่ยวชาญพิเศษ');
        return $list;
    }
    

    


}