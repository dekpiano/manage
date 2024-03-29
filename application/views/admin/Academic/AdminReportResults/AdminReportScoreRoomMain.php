<style>
.border-left-primary {
    border-left: .25rem solid #5BC3D5 !important;
}

.textAlignVer1 {
    display: block;
    filter: flipv fliph;
    -webkit-transform: rotate(-90deg);
    -moz-transform: rotate(-90deg);
    transform: rotate(-90deg);
    position: relative;
    width: 20px;
    white-space: nowrap;
}


thead {
    position: sticky;
    top: 0;
    background-color: #fff;
}

.NameFix {
    position: sticky;
    left: 0;
    background: #fff;
}
</style>
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-fluid d-flex justify-content-between">
            <div class="col-auto justify-content-start">
                <h1 class="app-page-title"><?=$title;?></h1>
            </div>
            <div class="col-auto justify-content-md-end">
                <div class="page-utilities">
                    <input type="text" id="term" value="<?=$this->uri->segment('5')?>" style="display:none;">
                    <input type="text" id="year" value="<?=$this->uri->segment('6')?>" style="display:none;">

                    <div class="row g-2 ">
                        <div class="col-auto me-2">
                            <select class="form-select w-auto" name="KeyCheckYear" id="KeyCheckYear">
                                <option selected="" value="">ปีการศึกษา...</option>
                                <?php foreach ($CheckYear as $key => $v_CheckYear) : ?>
                                <option
                                    <?=$this->uri->segment('5').'/'.$this->uri->segment('6') == $v_CheckYear->RegisterYear ?'selected':''?>
                                    value="<?=$v_CheckYear->RegisterYear?>">
                                    <?=$v_CheckYear->RegisterYear?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-auto">
                            <form action="<?=base_url('Admin/Acade/Evaluate/ReportScoreRoomMain/1/2565')?>"
                                method="post" class="d-flex align-items-center">
                                <!-- <label for="">ระดับชั้น</label> -->
                                <select class="form-select w-auto ms-2" name="SelectRoomReportScore"
                                    id="SelectRoomReportScore">
                                    <option value="">เลือกห้องเรียน</option>
                                    <?php foreach ($Room as $key => $v_Room) : ?>
                                    <option
                                        <?=$this->uri->segment('7').'/'.$this->uri->segment('8') == $v_Room ?"selected":""?>
                                        value="<?=$v_Room?>">ม.<?=$v_Room?></option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- <button class="btn app-btn-primary clickLoder ms-3" type="submit">ค้นหา</button> -->
                            </form>
                        </div>
                    </div>
                    <!--//row-->
                </div>
                <!--//table-utilities-->
            </div>
        </div>
        <!--//container-->
        </section>
        <section class="we-offer-area">
            <?php if($CheckSub): ?>
            <div class="container-fluid">

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive" style="overflow-y: scroll;height: 750px;">
                            <table class="table table-hover table-bordered mb-0 text-left" id="">
                                <thead>
                                    <tr class="text-center">
                                        <th class="cell">เลขที่</th>
                                        <th class="cell">เลขประจำตัว</th>
                                        <th class="cell">ชื่อ - นามสกุล</th>
                                        <?php foreach ($RegisSubject as $key => $v_RegisSubject): ?>
                                        <th class="cell" colspan="4">
                                            <div class="textAlignVer">
                                                <?=$v_RegisSubject->SubjectCode?><br>
                                                <?=$v_RegisSubject->SubjectName?>
                                            </div>
                                        </th>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <th class="" colspan="3"></th>
                                        <?php foreach ($RegisSubject as $key => $v_RegisSubject): ?>
                                        <th class="">ก่อน</th>
                                        <th class="">สอบ</th>
                                        <th class="">หลัง</th>
                                        <th class="">สอบ</th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php                                    
                                    foreach ($CheckSub as $key => $v_stu) :
                                        //echo '<pre>'; print_r($v_stu);
                                    ?>

                                    <tr>

                                        <td class="text-center "> <?=$v_stu[1]?></td>
                                        <td class="text-center "><?=$v_stu[3]?></td>
                                        <td class="text-nowrap "><?=$v_stu[2]?></td>
                                        <?php $i = 4;
                                        
                                        foreach ($RegisSubject as $key1 => $v_RegisSubject): 
                                            $sub = explode("/",@$v_stu[$i]);
                                            //echo '<pre>'; print_r($sub);
                                            if($v_RegisSubject->SubjectCode == $sub[0] || $sub[1] != ""):
                                                $score = explode("|",@$sub[1]);
                                        ?>
                                        <td class="text-center"><?php echo @$score[0];  ?></td>
                                        <td class="text-center"><?php echo @$score[1];  ?></td>
                                        <td class="text-center"><?php echo @$score[2];  ?></td>
                                        <td class="text-center"><?php echo @$score[3];  ?></td>
                                        <?php else : ?>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <?php endif; ?>
                                        <?php $i++; endforeach; ?>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                <div class="inner">
                    <div class="app-card-body p-3 p-lg-4">
                        <div class="row">
                            <div class="col-md-12 text-center align-self-center">
                                <h2 class="heading">กรุณาเลือกปีการศึกษาและห้องเรียนก่อน !</h2>
                                <div class="intro">ระบบรายงานผลการบันทึกคะแนน (รายห้องเรียน)</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php endif;?>

    </div>
    </section>

</div>
<!--//main-wrapper-->