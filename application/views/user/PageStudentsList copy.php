<?php 
if(isset($_GET['studentList'])) {
        if($_GET['studentList'] == '1.1'){
            $lineClass = 'https://line.me/R/ti/g/vcXaCpmgnc';
        }elseif($_GET['studentList'] == '1.2'){
            $lineClass = 'http://line.me/ti/g/yzRNfXFvyd';
        }elseif($_GET['studentList'] == '1.3'){
            $lineClass = 'https://line.me/ti/g/_wk7_vKctP';
        }elseif($_GET['studentList'] == '1.4'){
            $lineClass = 'http://line.me/ti/g/YYNi7CZyFS';
        }elseif($_GET['studentList'] == '2.1'){
            $lineClass = 'https://line.me/R/ti/g/u040TVvh_i';
        }elseif($_GET['studentList'] == '2.2'){
            $lineClass = 'https://line.me/ti/g/SvDwPmS-mm';
        }elseif($_GET['studentList'] == '2.3'){
            $lineClass = '';
        }elseif($_GET['studentList'] == '2.4'){
            $lineClass = 'http://line.me/ti/g/ZpOsNbqDdr';
        }elseif($_GET['studentList'] == '3.1'){
            $lineClass = 'https://line.me/R/ti/g/KdRwD-6KAI';
        }elseif($_GET['studentList'] == '3.2'){
            $lineClass = 'https://line.me/ti/g/20mSMrXWb_';
        }elseif($_GET['studentList'] == '3.3'){
            $lineClass = 'https://line.me/ti/g/LcQ645FWaZ';
        }elseif($_GET['studentList'] == '3.4'){
            $lineClass = 'https://line.me/ti/g/KGA9-4bOoL';
        }elseif($_GET['studentList'] == '4.1'){
            $lineClass = 'https://line.me/ti/g/HgcBhOv4VM';
        }elseif($_GET['studentList'] == '4.2'){
            $lineClass = 'https://line.me/ti/g/uVoNjoBKLy';
        }elseif($_GET['studentList'] == '4.3'){
            $lineClass = '';
        }elseif($_GET['studentList'] == '4.4'){
            $lineClass = 'https://line.me/R/ti/g/QyTYGoY0wB';
        }elseif($_GET['studentList'] == '5.1'){
            $lineClass = 'https://line.me/R/ti/g/v-5H1JrGWb';
        }elseif($_GET['studentList'] == '5.2'){
            $lineClass = 'https://line.me/R/ti/g/nm6izwQ0oL';
        }elseif($_GET['studentList'] == '5.3'){
            $lineClass = 'https://line.me/ti/g/QCmr9QSarQ';
        }elseif($_GET['studentList'] == '5.4'){
            $lineClass = 'https://line.me/ti/g/dpdnN1AHnk';
        }elseif($_GET['studentList'] == '6.1'){
            $lineClass = '';
        }elseif($_GET['studentList'] == '6.2'){
            $lineClass = 'https://line.me/R/ti/g/ndEUF1dQck';
        }elseif($_GET['studentList'] == '6.3'){
            $lineClass = 'https://line.me/R/ti/g/p5fKhYcO8v';
        }elseif($_GET['studentList'] == '6.4'){
            $lineClass = 'https://line.me/ti/g/z8Wkn8869s';
        }
    }
        ?>

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="main-wrapper">
                <section class="cta-section theme-bg-light py-5">
                    <div class="container text-center">
                        <h2 class="heading">รายชื่อนักเรียน ปีการศึกษา 2565 </h2>
                        <div class="intro"></div>
                    </div>
                    <!--//container-->
                    <div class="row justify-content-center mt-3">
                        <div class="col-4">
                            <form class="form-inline justify-content-center" action="?" method="get">
                                <select name="studentList" class="form-select form-select-lg mb-3">
                                    <?php $room = array('1/1'=>'1.1','1/2'=>'1.2', '1/3'=>'1.3', '1/4'=>'1.4', '2/1'=>'2.1', '2/2'=>'2.2', '2/3'=>'2.3', '2/4'=>'2.4', '3/1'=>'3.1', '3/2'=>'3.2', '3/3'=>'3.3', '3/4'=>'3.4', '4/1'=>'4.1', '4/2'=>'4.2', '4/3'=>'4.3', '4/4'=>'4.4', '5/1'=>'5.1', '5/2'=>'5.2', '5/3'=>'5.3', '5/4'=>'5.4', '6/1'=>'6.1', '6/2'=>'6.2','6/3'=>'6.3','6/4'=>'6.4'); ?>
                                    <option value="">ค้นหานักเรียน</option>
                                    <?php foreach ($room as $key => $v_room) :?>
                                    <option <?=$v_room==@$_GET['studentList']?'selected':''?>  value="<?=$v_room?>">ม.<?=$key?></option>
                                    <?php   endforeach; ?>
                                </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn-primary mb-3 btn-lg text-white"><i class="fa fa-search"
                                    aria-hidden="true"></i> ค้นหานักเรียน</button>

                        </div>

                        </form>

                    </div>
                </section>
                <section class="we-offer-area text-center ">
                    <div class="container-fluid">
                        <?php if(isset($_GET['studentList']) && $_GET['studentList'] != '') :?>
                        <div class="row justify-content-center">

                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-header bg-success text-white">
                                        Line ครูที่ปรึกษาของนักเรียน ม.<?=$_GET['studentList'];?>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="text-center mb-3">
                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/LINE_logo.svg/640px-LINE_logo.svg.png"
                                                        alt="classroom" class="w-25">
                                                </div>
                                                <p>ลิ้งก์ครูที่ปรึกษา : <a href="<?=$lineClass;?>" target="_blank"
                                                        rel="noopener noreferrer"><?=$lineClass;?></a> </p>
                                            </div>
                                            <!-- <div class="col-md-5">
                                                <p><b>หรือ</b> scan qr-code:</p>
                                                <p>
                                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=<?=$lineClass;?>"
                                                        alt="" class="w-50">
                                                </p>
                                            </div> -->
                                        </div>



                                    </div>
                                </div>
                            </div>

                        </div>
                        <?php endif; ?>
                        <?php if(isset($_GET['studentList'])) :             
                if($_GET['studentList'] == ""){
                    echo "<h2>กรุณาเลือกห้องเรียน</h2>"; 
                }  else{ ?>
                        <h4>
                            <a href="uploads/academic/studentList/<?=$_GET['studentList']?>.pdf">
                                ==> กรณีไฟล์ไม่โหลดให้คลิกดูรายชื่อที่นี่ <== </a>
                        </h4>
                        <iframe src="uploads/academic/studentList/<?=$_GET['studentList']?>.pdf" width="100%"
                            height="1200px">
                        </iframe>
                        <?php   }
            ?>


                        <?php endif; ?>
                    </div>


                </section>

            </div>
        </div>
    </div>
</div>
<!--//main-wrapper-->