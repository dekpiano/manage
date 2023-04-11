<style>
.border-left-primary {
    border-left: .25rem solid #5BC3D5 !important;
}
</style>
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h2 class="heading">จัดการข้อมูล<?=$title;?></h2>
        </div>
        <hr>
        <!--//container-->
        </section>
        <section class="we-offer-area mt-5">
            <div class="container-fluid">

                <?php if($check_student): ?>
                <div class="card">
                    <div class="card-body">

                        <div>
                            <div class="form-group row justify-content-center mb-3">
                                <div class="col-md-6 d-flex justify-content-center">
                                    <div>
                                        ครูผู้สอน :<br>
                                        รายวิชา :
                                    </div>
                                    <div class="ms-3">
                                        <?=$Teacher->pers_prefix.$Teacher->pers_firstname.' '.$Teacher->pers_lastname;?><br>
                                        <?=$check_student[0]->SubjectCode.' '.$check_student[0]->SubjectName?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <form class="form_score">

                                <table id="tb_score" class="table table-hover table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th colspan="5">ข้อมูลนักเรียน</th>
                                            <th colspan="7">การประเมินผลการเรียน</th>
                                        </tr>
                                        <tr>
                                            <th>ชั้น</th>
                                            <th>เลขที่</th>
                                            <th>เลขประจำตัว</th>
                                            <th width="200">ชื่อ - นามสกุล</th>
                                            <?php 
                                        if(floatval($check_student[0]->SubjectUnit) == 0.5){ $TimeNum = 20; }
                                        elseif(floatval($check_student[0]->SubjectUnit) == 1){$TimeNum = 40;}
                                        elseif(floatval($check_student[0]->SubjectUnit) == 1.5){$TimeNum = 60;}
                                        ?>
                                            <th width="">เวลาเรียน<br> <small>(<?=intval($TimeNum);?> ชั่วโมง)</small>
                                            </th>
                                            <?php 
                                    $sum_scoer = 0;
                                    foreach ($set_score as $key => $v_set_score): 
                                        $sum_scoer += $v_set_score->regscore_score;
                                    ?>
                                            <th class="h6">
                                                <?=$v_set_score->regscore_namework?><br>
                                                (<?=$v_set_score->regscore_score?>)
                                            </th>
                                            <?php endforeach; ?>
                                            <th class="h6">คะแนนรวม (<?=$sum_scoer?>)</th>
                                            <th class="h6">เกรด</th>
                                            <th class="h6">สถานะนักเรียน</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($check_student as $key => $v_check_student) :
                                          
                                            if(1==1):  
                                            
                                        ?>
                                        <tr>
                                            <th class="align-middle text-center"><?=$v_check_student->StudentClass?>
                                            </th>
                                            <td class="align-middle text-center fw-bold"><?=$v_check_student->StudentNumber?>
                                            </td>
                                            <td class="align-middle text-center fw-bold"><?=$v_check_student->StudentCode?></td>
                                            <td class="align-middle fw-bold">
                                                <?=$v_check_student->StudentPrefix?><?=$v_check_student->StudentFirstName?>
                                                <?=$v_check_student->StudentLastName?> <br>
                                                <small class="fw-normal"><?=($v_check_student->Grade_Type);?></small> 
                                                <input type="text" class="form-control sr-only" id="StudentID"
                                                    name="StudentID[]" value="<?=$v_check_student->StudentID?>">
                                                <input type="text" class="form-control sr-only" id="SubjectCode"
                                                    name="SubjectCode" value="<?=$check_student[0]->SubjectCode?>">
                                                <input type="text" class="form-control sr-only" id="RegisterYear"
                                                    name="RegisterYear" value="<?=$check_student[0]->RegisterYear?>">
                                                <input type="text" class="form-control sr-only" id="TimeNum"
                                                    name="TimeNum" value="<?=$TimeNum?>">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control study_time KeyEnter"
                                                    id="study_time" check-time="<?=$TimeNum;?>" name="study_time[]"
                                                    value="<?=$v_check_student->StudyTime == "" ?"":$v_check_student->StudyTime?>"
                                                    autocomplete="off">
                                            </td>
                                            <?php 
                                        foreach ($set_score as $key => $v_set_score): 
                                        $s = explode("|",$v_check_student->Score100);
                                        if($onoff_savescore[0]->onoff_name == $v_set_score->regscore_namework){
                                            $onoff_status = $onoff_savescore[0]->onoff_status;
                                        }elseif($onoff_savescore[1]->onoff_name == $v_set_score->regscore_namework){
                                            $onoff_status = $onoff_savescore[1]->onoff_status;
                                        }elseif($onoff_savescore[2]->onoff_name == $v_set_score->regscore_namework){
                                            $onoff_status = $onoff_savescore[2]->onoff_status;
                                        }elseif($onoff_savescore[3]->onoff_name == $v_set_score->regscore_namework){
                                            $onoff_status = $onoff_savescore[3]->onoff_status;
                                        }
                                        
                                        ?>
                                            <td>
                                                <input type="text" class="form-control check_score KeyEnter"
                                                    check-score-key="<?=$v_set_score->regscore_score?>"
                                                    id="<?=$v_check_student->StudentID?>"
                                                    name="<?=$v_check_student->StudentID?>[]"
                                                    value="<?=$v_check_student->Score100 == "" ?"0":$s[$key]?>"
                                                    <?=$checkOnOff[6]->onoff_status == "off"?"readonly":""?>
                                                    autocomplete="off">
                                            </td>
                                            <?php endforeach; ?>
                                            <td class="align-middle">
                                                <div class="subtot text-center font-weight-bold"></div>
                                            </td>
                                            <td class="align-middle">
                                                <div class="grade text-center font-weight-bold"></div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <?php 
                                            if($v_check_student->StudentBehavior == "ปกติ"){ 
                                                echo '<span class="text-success">'.$v_check_student->StudentBehavior.'</span>';
                                            }else{
                                                echo '<span class="text-danger">'.$v_check_student->StudentBehavior.'</span>';
                                            }
                                            ?>
                                            </td>
                                        </tr>
                                        <?php 
                                        endif;
                                    endforeach; 
                                    ?>
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary "><i class="bi bi-pencil-square"></i>
                                        บันทึกคะแนน</button>
                                    <a href="" class="btn btn-warning float-end"><i class="bi bi-printer"></i>
                                        พิมพ์รายงาน</a>
                                </div>
                            </form>


                        </div>

                    </div>
                </div>
                <?php else: ?>
                <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                    <div class="inner">
                        <div class="app-card-body text-center">
                            <h3 class=""> ไม่มีนักเรียน เรียนซ้ำ ในรายวิชานี้!</h3>
                            <a class="btn app-btn-primary"
                                href="#" onclick="javascript:history.go(-1)">กลับหน้าหลัก</a>
                        </div>
                    </div>
                </div>

                <?php endif; ?>





            </div>
        </section>

    </div>
    <!--//main-wrapper-->