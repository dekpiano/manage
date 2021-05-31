<div class="main-wrapper">
    <section class="cta-section theme-bg-light py-5">
        <div class="container text-center">
            <h2 class="heading">รายชื่อนักเรียน ปีการศึกษา 2564  </h2>
            <div class="intro">Welcome to Student System</div>
        </div>
        <!--//container-->
        
        <div class="row justify-content-center mt-3">
            <div class="col-4">
                <form class="form-inline justify-content-center" action="?" method="get">
                    <select name="studentList" class="custom-select studentList mr-2">
                    <?php $room = array('1/1'=>'1.1','1/2'=>'1.2', '1/3'=>'1.3', '1/4'=>'1.4', '2/1'=>'2.1', '2/2'=>'2.2', '2/3'=>'2.3', '2/4'=>'2.4', '3/1'=>'3.1', '3/2'=>'3.2', '3/3'=>'3.3', '3/4'=>'3.4', '4/1'=>'4.1', '4/2'=>'4.2', '4/3'=>'4.3', '4/4'=>'4.4', '5/1'=>'5.1', '5/2'=>'5.2', '5/3'=>'5.3', '5/4'=>'5.4', '6/1'=>'6.1', '6/2'=>'6.2','6/3'=>'6.3','6/4'=>'6.4'); ?>
                        <option value="">ค้นหานักเรียน</option>
                        <?php foreach ($room as $key => $v_room) :?>
                            <option value="<?=$v_room?>">ม.<?=$key?></option>                            
                        <?php   endforeach; ?>     
                    </select>
                    <button type="submit" class="btn btn-primary pl-3"><i class="fa fa-search" aria-hidden="true"></i> ค้นหา</button>              
                     
                </form>
            </div>
        </div>
    </section>
    <section class="we-offer-area text-center ">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-4 col-6 mb-5">               
                <?php if(isset($_GET['studentList']) && $_GET['studentList'] != '') :?>   
                    <h2>qr code ห้อง ม.<?php $d =  explode(".",$_GET['studentList']) ; echo $d[0].'/'.$d[1];?></h2>
                    แสกน Qr Code เข้ากลุ่มห้องครูที่ปรึกษา
                    <img src="<?=base_url('uploads/academic/studentList/qrcode/'.$_GET['studentList'].'.jpg');?>" alt="" class="w-100">
                   
                    <?php endif; ?>
                </div>
            </div>       
            <?php if(isset($_GET['studentList'])) :             
                if($_GET['studentList'] == ""){
                    echo "<h2>กรุณาเลือกห้องเรียน</h2>"; 
                }  else{ ?>
                <h4>
                <a href="uploads/academic/studentList/<?=$_GET['studentList']?>.pdf">
               ==> กรณีไฟล์ไม่โหลดให้คลิกดูรายชื่อที่นี่ <==
                </a>
                </h4>
 <iframe src="uploads/academic/studentList/<?=$_GET['studentList']?>.pdf" width="100%" height="1200px">
                </iframe>   
             <?php   }
            ?>    

                        
            <?php endif; ?>
        </div>
        
        
    </section>

</div>
<!--//main-wrapper-->