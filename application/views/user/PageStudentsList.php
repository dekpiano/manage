<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="main-wrapper">
                <section class="cta-section theme-bg-light py-5">
                    <div class="container text-center  mb-5">
                        <h2 class="heading">รายชื่อนักเรียน ปีการศึกษา <?=$schoolyear->schyear_year?></h2>
                        <div class="intro"></div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-heade bg-primary p-3 text-white">
                                    รายชื่อนักเรียน แบบรายห้อง
                                </div>
                                <div class="card-body">
                                    <form class="form-inline justify-content-center" action="?" method="get">
                                        <div class="input-group">
                                            <select name="studentList" class="form-select form-select-lg">
                                                <?php $room = array('1/1'=>'1.1','1/2'=>'1.2', '1/3'=>'1.3', '1/4'=>'1.4','1/5'=>'1.5','1/6'=>'1.6', '2/1'=>'2.1', '2/2'=>'2.2', '2/3'=>'2.3', '2/4'=>'2.4', '3/1'=>'3.1', '3/2'=>'3.2', '3/3'=>'3.3', '3/4'=>'3.4', '4/1'=>'4.1', '4/2'=>'4.2', '4/3'=>'4.3', '4/4'=>'4.4','4/5'=>'4.5','4/6'=>'4.6', '5/1'=>'5.1', '5/2'=>'5.2', '5/3'=>'5.3', '5/4'=>'5.4', '6/1'=>'6.1', '6/2'=>'6.2','6/3'=>'6.3','6/4'=>'6.4'); ?>
                                                <option value="">ค้นหานักเรียน</option>
                                                <?php foreach ($room as $key => $v_room) :?>
                                                <option <?=$key==@$_GET['studentList']?'selected':''?>
                                                    value="<?=$key?>">
                                                    ม.<?=$key?>
                                                </option>
                                                <?php   endforeach; ?>
                                            </select>
                                            <button type="submit" class="btn-primary text-white"><i class="fa fa-search"
                                                    aria-hidden="true"></i> ค้นหานักเรียน</button>
                                        </div>

                                    </form>

                                </div>
                            </div>

                        </div>
                        <!-- <div class="col-md-6">
                            <div class="card">
                                <div class="card-heade bg-primary p-3 text-white">
                                    รายชื่อนักเรียน แบบรายวิชา
                                </div>
                                <div class="card-body">
                                    <form class="form-inline justify-content-center" action="?" method="get">
                                        <div class="input-group">
                                            <select name="studentList" class="form-select form-select-lg">
                                                <option value="">ค้นหานักเรียน</option>
                                                <?php foreach ($SelectSubject as $key => $v_SelectSubject) :?>
                                                <option <?=$key==@$_GET['studentList']?'selected':''?>
                                                    value="<?=$key?>">
                                                    <?=$v_SelectSubject->SubjectCode.' '.$v_SelectSubject->SubjectName?>
                                                </option>
                                                <?php   endforeach; ?>
                                            </select>
                                            <button type="submit" class="btn-primary text-white"><i class="fa fa-search"
                                                    aria-hidden="true"></i> ค้นหานักเรียน</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div> -->
                    </div>
                    <!--//container-->

                </section>
                <?php if(@$_GET['studentList']): ?>
                <div class="text-center">
                    <h4>
                        รายชื่อนักเรียนชั้นมัธยมศึกษาปีที่ <?=@$_GET['studentList']?> ปีการศึกษา
                        <?=$schoolyear->schyear_year?>
                    </h4>
                </div>
                <div class="text-center mb-3 ">
                    <h5>
                        ครูที่ปรึกษา
                        <?php foreach ($TeacRoom as $key => $v_TeacRoom) {
                            echo $v_TeacRoom->pers_prefix.$v_TeacRoom->pers_firstname.' '.$v_TeacRoom->pers_lastname.' ';
                        } ?>
                    </h5>
                    <div class="mt-4 mb-4">
                    <a target="_blank" href="<?=base_url('StudentsList/Print/'.@$_GET['studentList'].'/All')?>"
                        class="btn-info  btn-lg text-white PrintNameRoom">
                        <i class="fa fa-print" aria-hidden="true"></i> พิมพ์ใบรายชื่อ
                    </a>
                    </div>
                   
                </div>
                <?php endif; ?>

                <nav id="orders-table-tab"
                    class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4" role="tablist">
                    <?php foreach ($checkLine as $key => $v_checkLine) :
                            ?>
                    <a class="flex-sm-fill text-sm-center nav-link SelStudyLine" id="tab-<?=$key?>-tab"
                        data-bs-toggle="tab" key_studyline="<?=$v_checkLine->StudentStudyLine;?>"
                        key_room="<?php $SubRoom = explode('.',$v_checkLine->StudentClass); echo $SubRoom[1] ;?>"
                        href="#tab-<?=$key?>" role="tab" aria-controls="tab-<?=$key?>" aria-selected="false"
                        tabindex="-1"><?=$key == 0 ?"รายชื่อทั้งหมด":$v_checkLine->StudentStudyLine?></a>
                    <?php endforeach; ?>
                </nav>
                <div class="tab-content" id="orders-table-tab-content">
                    <?php foreach ($checkLine as $key_tab => $v_checkLine) : ?>
                    <div class="tab-pane fade <?=$key_tab == 0 ?"active":""?> <?=$key_tab == 0 ?"show":""?>"
                        id="tab-<?=$key_tab?>" role="tabpanel" aria-labelledby="tab-<?=$key_tab?>-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0 text-left">
                                        <thead>
                                            <tr class="text-center">
                                                <th class="cell" rowspan="2">ที่</th>
                                                <th class="cell" rowspan="2">เลขประจำตัว</th>
                                                <th class="cell" rowspan="2">ชื่อ - นามสกุล</th>
                                                <th class="cell" rowspan="2">หลักสูตร</th>
                                                <th class="cell" rowspan="2">สถานะ</th>
                                                <th colspan="20">งาน</th>
                                            </tr>
                                            <tr class="text-center">
                                                <?php for ($i=1; $i <= 20; $i++) : ?>
                                                <th class="cell"><?=$i;?></th>
                                                <?php endfor; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($selStudent as $key => $v_selStudent) : 
                                        if($key_tab == 0){ ?>
                                            <tr>
                                                <td class="cell text-center"><?=$v_selStudent->StudentNumber?></td>
                                                <td class="cell text-center"><span
                                                        class="truncate"><?=$v_selStudent->StudentCode?></span></td>
                                                <td class="cell">
                                                    <?=$v_selStudent->StudentPrefix.$v_selStudent->StudentFirstName.' '.$v_selStudent->StudentLastName?>
                                                </td>
                                                <td class="cell text-center"><?=$v_selStudent->StudentStudyLine?></td>
                                                <td class="cell text-center"><?=$v_selStudent->StudentBehavior?></td>
                                                <?php for ($i=1; $i <= 20; $i++) : ?>
                                                <td class="cell"></td>
                                                <?php endfor; ?>
                                            </tr>
                                            <?php }else {                                        
                                            if($v_selStudent->StudentStudyLine == $v_checkLine->StudentStudyLine):
                                            ?>
                                            <tr>
                                                <td class="cell text-center"><?=$v_selStudent->StudentNumber?></td>
                                                <td class="cell text-center"><span
                                                        class="truncate"><?=$v_selStudent->StudentCode?></span></td>
                                                <td class="cell">
                                                    <?=$v_selStudent->StudentPrefix.$v_selStudent->StudentFirstName.' '.$v_selStudent->StudentLastName?>
                                                </td>
                                                <td class="cell text-center"><?=$v_selStudent->StudentStudyLine?></td>
                                                <td class="cell text-center"><?=$v_selStudent->StudentBehavior?></td>
                                                <?php for ($i=1; $i <= 20; $i++) : ?>
                                                <td class="cell"></td>
                                                <?php endfor; ?>
                                            </tr>
                                            <?php endif; }?>
                                            <?php endforeach; ?>

                                        </tbody>
                                    </table>
                                </div>
                                <!--//table-responsive-->

                            </div>
                            <!--//app-card-body-->
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>


            </div>
        </div>
    </div>
</div>
<!--//main-wrapper-->