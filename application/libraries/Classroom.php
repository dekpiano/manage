<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Classroom {

    function ListRoom(){ 

        $list  = array('1/1','1/2','1/3','1/4','2/1','2/2','2/3','2/4','3/1','3/2','3/3','3/4','4/1','4/2','4/3','4/4','5/1','5/2','5/3','5/4','6/1','6/2','6/3','6/4');

        return $list;

    }

    function GroupSaraMain(){ 

        $list  =  array('1/ภาษาไทย','2/คณิตศาสตร์','3/วิทยาศาสตร์และเทคโนโลยี','4/สังคมศึกษา ศาสนาและวัฒนธรรม','5/สุขศึกษาและพลศึกษา','6/ศิลปะ','7/การงานอาชีพ','8/ภาษาต่างประเทศ','9/การศึกษาค้นคว้าด้วยตนเอง (IS)');
        return $list;

    }
    function GroupSaraSecond(){ 

        $list  =  array('11/ภาษาไทย',
                        '21/คณิตศาสตร์',
                        '31/วิทยาศาสตร์',
                        '32/คอมพิวเตอร์',
                        '41/สังคมศึกษา',
                        '42/ภูมิศาสตร์',
                        '43/ประวัติศาสตร์',
                        '44/ศาสนาและวัฒนธรรม',
                        '45/หน้าที่พลเมือง',
                        '51/สุขศึกษา',
                        '52/พลศึกษา',
                        '61/ศิลปะ',
                        '62/ทัศนศิลป์',
                        '63/นาฏศิลป์',
                        '64/ดนตรี',
                        '71/งานบ้านและคหกรรม',
                        '72/งานเกษตร',
                        '73/งานช่าง',
                        '74/ธุรกิจและบัญชี',
                        '81/ภาษาอังกฤษ',
                        '84/ภาษาจีน',
                        '9/การค้นคว้าอิสระ (IS)'
                    );
        return $list;

    }

    function LevelClass(){ 

        $list  = array('ม.1','ม.2','ม.3','ม.4','ม.5','ม.6');
        return $list;
    }



}