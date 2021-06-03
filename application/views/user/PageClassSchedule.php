<div class="main-wrapper">
    <section class="cta-section theme-bg-light py-5">
        <div class="container text-center">
            <h2 class="heading">ตารางเรียน</h2>
        </div>
        <!--//container-->
        
        <div class="row justify-content-center mt-3">
            <div class="col-4">
                <form class="form-inline justify-content-center" action="<?=base_url('user/ConStudents/SearchClassSchedule')?>" method="get">
                    <select name="studentList" class="custom-select studentList mr-2">
                    <?php $room = array('1/1'=>'1.1','1/2'=>'1.2', '1/3'=>'1.3', '1/4'=>'1.4', '2/1'=>'2.1', '2/2'=>'2.2', '2/3'=>'2.3', '2/4'=>'2.4', '3/1'=>'3.1', '3/2'=>'3.2', '3/3'=>'3.3', '3/4'=>'3.4', '4/1'=>'4.1', '4/2'=>'4.2', '4/3'=>'4.3', '4/4'=>'4.4', '5/1'=>'5.1', '5/2'=>'5.2', '5/3'=>'5.3', '5/4'=>'5.4', '6/1'=>'6.1', '6/2'=>'6.2','6/3'=>'6.3','6/4'=>'6.4'); ?>
                        <option value="">ค้นหาตารางเรียน</option>
                        <?php foreach ($room as $key => $v_room) :?>
                            <option value="<?=$key?>">ม.<?=$key?></option>                            
                        <?php   endforeach; ?>     
                    </select>
                    <button type="submit" class="btn btn-primary pl-3"><i class="fa fa-search" aria-hidden="true"></i> ค้นหา</button>              
                     
                </form>
            </div>
        </div>
    </section>
    <section class="we-offer-area text-center ">
        <div class="container-fluid">
              
            <?php if(isset($_GET['studentList'])) :             
                if($_GET['studentList'] == ""){
                    echo "<h2>กรุณาเลือกห้องเรียน</h2>"; 
                }  else{ ?>
                <?php foreach ($schedule as $key => $v_schedule) :?>
                    <h4 class="mt-4">ตารางเรียนห้อง ม.<?=$v_schedule->schestu_classname?></h4>
                <h5>                
                <a href="<?=base_url();?>uploads/academic/class_schedule/<?=$v_schedule->schestu_filename?>">
               ==> กรณีไฟล์ไม่โหลดให้คลิกดูรายชื่อที่นี่ <==
                </a>
                </h5>
                    <iframe src="<?=base_url();?>uploads/academic/class_schedule/<?=$v_schedule->schestu_filename?>" width="100%" height="800px">
                </iframe>   
                <?php endforeach; ?>
             <?php   }
            ?>    

                        
            <?php endif; ?>
        </div>
        
        
    </section>

</div>
<!--//main-wrapper-->