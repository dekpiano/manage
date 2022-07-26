<!-- Page Header-->
<style>
.services .card1 {
    padding: 10px;
    border: none;
    cursor: pointer;
    border: groove;
}

.services .card1:hover {
    background-color: #fff;
}

.services .card1 span {
    font-size: 14px;
}

.g-1 {
    padding: 10px 15px;
    margin: 0;
}

table thead,
table tfoot {
    position: sticky;
}

table thead {
    inset-block-start: 0;
    /* "top" */
}
</style>
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom"><?=$title?></h2>
    </div>
</header>
<div class="breadcrumb-holder container-fluid">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url('Teacher/Register/SaveScoreMain');?>">หน้าแรก</a></li>
        <li class="breadcrumb-item active"><?=$title?></li>
    </ul>
</div>
<!-- Dashboard Counts Section-->
<section class="no-padding-bottom">
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-close">
                    <a href="#" id="chcek_score" subject-id="<?=$check_student[0]->SubjectID?>"
                        class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">ตั้งค่าคะแนน</a>
                </div>
                <div class="card-header d-flex align-items-center">
                    <h3 class="h4">รายวิชาที่สอน <?=$check_student[0]->SubjectCode?> <?=$check_student[0]->SubjectName?>
                        ครูประจำวิชา <?=$this->session->userdata('fullname');?></h3>
                </div>
                <div class="card-body">

                    <?php if(!empty($set_score)):?>
                    <div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3 form-control-label align-self-center text-right">เลือกห้อง</label>
                            <div class="col-sm-4">
                                <select name="check_room" id="check_room" class="form-control mb-3 w-auto">
                                    <option value="all">ทั้งหมด</option>
                                    <?php 
                                    foreach ($check_room as $key => $v_check_room) : 
                                        $sub_doc = explode('.',$v_check_room->StudentClass);
                                        $sub_room = explode('/',$sub_doc[1]);
                                        $all_room = $sub_room[0].'-'.$sub_room[1];
                                        ?>
                                        <option <?=$this->uri->segment(7) == $all_room ?"selected":"" ?> value="<?=$all_room;?>"><?=$v_check_room->StudentClass;?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <form class="form_score">
                            <table id="tb_score" class="table table-striped table-hover table-bordered">
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
                                        <th width="">เวลาเรียน<br>(40)</th>
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
                                    <?php foreach ($check_student as $key => $v_check_student) : ?>
                                    <tr>
                                        <th class="align-middle text-center"><?=$v_check_student->StudentClass?></th>
                                        <td class="align-middle text-center"><?=$v_check_student->StudentNumber?></td>
                                        <td class="align-middle text-center"><?=$v_check_student->StudentCode?></td>
                                        <td class="align-middle">
                                            <?=$v_check_student->StudentPrefix?><?=$v_check_student->StudentFirstName?>
                                            <?=$v_check_student->StudentLastName?>
                                            <input type="text" class="form-control sr-only" id="StudentID"
                                                name="StudentID[]" value="<?=$v_check_student->StudentID?>">
                                            <input type="text" class="form-control sr-only" id="SubjectCode"
                                                name="SubjectCode" value="<?=$check_student[0]->SubjectCode?>">
                                            <input type="text" class="form-control sr-only" id="RegisterYear"
                                                name="RegisterYear" value="<?=$check_student[0]->RegisterYear?>">
                                        </td>
                                        <td>
                                        <input type="text" class="form-control" id=""
                                                name="" value="">
                                        </td>
                                        <?php 
                                        foreach ($set_score as $key => $v_set_score): 
                                        $s = explode("|",$v_check_student->Score100);
                                        ?>
                                        <td>
                                            <input type="text" class="form-control check_score"
                                                check-score-key="<?=$v_set_score->regscore_score?>"
                                                id="<?=$v_check_student->StudentID?>"
                                                name="<?=$v_check_student->StudentID?>[]"
                                                value="<?=$v_check_student->Score100 == "" ?"0":$s[$key]?>">
                                        </td>
                                        <?php endforeach; ?>
                                        <td class="align-middle">
                                            <div class="subtot text-center font-weight-bold"></div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="grade text-center font-weight-bold"></div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <?php $Status =  explode("/",$v_check_student->StudentStatus); echo $Status[1]?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">บันทึกคะแนน</button>
                            </div>

                        </form>
                    </div>
                    <?php else: ?>

                    <div class="text-center">
                        <h1>กรุณาตั้งค่าคะแนนเก็บก่อน</h1>
                    </div>

                    <?php endif; ?>


                </div>
            </div>
        </div>

    </div>
</section>

<div id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" class="modal fade text-left" style="display: none;"
    aria-hidden="true">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <form class="form_set_score">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">ตั้งค่าคะแนน</h4>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="card-body form-inline">

                    <div class="form-group mt-2">
                        <label for="before_middle" class="sr-only">ก่อนกลางภาค</label>
                        <input id="before_middle" name="before_middle" type="text" value="ก่อนกลางภาค"
                            class="mr-3 form-control" readonly>
                    </div>
                    <div class="form-group mt-2">
                        <label for="before_middle_score" class="sr-only">คะแนนที่เก็บ</label>
                        <input id="before_middle_score" name="before_middle_score" type="text"
                            placeholder="คะแนนที่เก็บ" class="mr-3 form-control score">
                    </div>
                    <div class="form-group mt-2">
                        <label for="test_midterm" class="sr-only">สอบกลางภาค</label>
                        <input id="test_midterm" type="text" name="test_midterm" value="สอบกลางภาค"
                            class="mr-3 form-control" readonly>
                    </div>
                    <div class="form-group mt-2">
                        <label for="test_midterm_score" class="sr-only">คะแนนที่เก็บ</label>
                        <input id="test_midterm_score" type="text" name="test_midterm_score" placeholder="คะแนนที่เก็บ"
                            class="mr-3 form-control score">
                    </div>
                    <div class="form-group mt-2">
                        <label for="after_midterm" class="sr-only">หลังกลางภาค</label>
                        <input id="after_midterm" type="text" name="after_midterm" value="หลังกลางภาค"
                            class="mr-3 form-control" readonly>
                    </div>
                    <div class="form-group mt-2">
                        <label for="after_midterm_score" class="sr-only">คะแนนที่เก็บ</label>
                        <input id="after_midterm_score" name="after_midterm_score" type="text"
                            placeholder="คะแนนที่เก็บ" class="mr-3 form-control score">
                    </div>
                    <div class="form-group mt-2">
                        <label for="final_exam" class="sr-only">สอบปลายภาค</label>
                        <input id="final_exam" type="text" name="final_exam" value="สอบปลายภาค"
                            class="mr-3 form-control" readonly>
                    </div>
                    <div class="form-group mt-2">
                        <label for="final_exam_score" class="sr-only">คะแนนที่เก็บ</label>
                        <input id="final_exam_score" name="final_exam_score" type="text" placeholder="คะแนนที่เก็บ"
                            class="mr-3 form-control score">
                    </div>
                    <div class="form-group mt-2">
                        <label for="inlineFormInput" class="sr-only">รวมคะแนน</label>
                        <input id="inlineFormInput" type="text" value="รวมคะแนน" class="mr-3 form-control" readonly>
                    </div>
                    <div class="form-group mt-2">
                        <label for="sum" class="sr-only">คะแนนรวม</label>
                        <input id="sum" type="text" name="sum" placeholder="คะแนนรวม" class="mr-3 form-control"
                            style="padding-right: 0;" readonly>
                    </div>

                    <div class="mt-2">
                        **หมายเหตุ คะแนนรวมต้องเท่ากับ 100 คะแนน
                    </div>

                    <input id="regscore_subjectID" type="text" name="regscore_subjectID" placeholder="คะแนนรวม"
                        class="mr-3 form-control sr-only" value="<?=$check_student[0]->SubjectID;?>" readonly>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">บันทึกคะแนนเก็บ</button>
                </div>
            </form>
        </div>
    </div>
</div>