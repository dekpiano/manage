<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">

        <div class="container-xl d-flex align-items-center justify-content-between">
            <h1 class="app-page-title">จัดการ<?=$title?></h1>
            <div class="d-flex align-items-center mt-2">

                <form action="#" method="post" id="FormSettingSendPlan">
                    <div class="ms-3 row">
                        <div class="col-auto">
                            เริ่มต้น <input type="datetime-local" name="seplanset_startdate" id="seplanset_startdate" value="<?=$CheckYear[0]->seplanset_startdate?>">
                        </div>
                        <div class="col-auto">
                            สิ้นสุด <input type="datetime-local" name="seplanset_enddate" id="seplanset_enddate" value="<?=$CheckYear[0]->seplanset_enddate?>">
                        </div>
                        <div class="col-auto d-flex align-items-center">
                            <div class="me-2">ปีการศึกษา</div>
                            <select name="seplanset_term" id="seplanset_term" class="form-select form-select-sm me-2 w-auto">
                                <?php for ($i=1; $i <=3 ; $i++):?>
                                <option <?=$CheckYear[0]->seplanset_term == $i?'selected':''?> value="<?=$i?>"><?=$i?></option>
                                <?php endfor; ?>
                            </select>
                            <select name="seplanset_year" id="seplanset_year" class="form-select form-select-sm me-2 w-auto">
                                <?php $d = date("Y")+543; for ($i=$d; $i <= $d+1 ; $i++):?>
                                <option <?=$CheckYear[0]->seplanset_year == $i?'selected':''?> value="<?=$i?>"><?=$i?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary w-100 BtnUpdateSendPlan">บันทึก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <hr>
        <!--//container-->
        </section>
        <section class="we-offer-area">
            <div class="container-fluid">

                <div class="card  mb-3">
                    <div class="card-body">
                        <form class="row" id="FormUpdateSendPlan">
                            <div class="col-md-4">
                                <select class="form-select SelectSubject" id="SelectSubject" name="SelectSubject"
                                    data-placeholder="เลือกวิชาที่สอน" required>
                                    <option value=""></option>
                                    <?php foreach ($Subject as $key => $v_Subject) :?>
                                    <option value="<?=$v_Subject->SubjectID?>">
                                        <?=$v_Subject->SubjectCode.' '.$v_Subject->SubjectName?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select SelectTeacher" id="SelectTeacher" name="SelectTeacher"
                                    data-placeholder="เลือกครูผู้สอน" required>
                                    <option value=""></option>
                                    <?php foreach ($Teacher as $key => $v_Teacher) :?>
                                    <option value="<?=$v_Teacher->pers_id?>">
                                        <?=$v_Teacher->pers_prefix.$v_Teacher->pers_firstname.' '.$v_Teacher->pers_lastname?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary w-100">เพิ่มครูกับวิชา</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="d-flex justify-content-center">
                        <select name="onoff_year" id="onoff_year" class="form-select form-select-sm w-auto">
                            <?php foreach ($CheckYearSendPlan as $key => $value):?>
                            <option value="<?=$value->seplan_term?>/<?=$value->seplan_year?>">
                                <?=$value->seplan_term?>/<?=$value->seplan_year?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>

                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover" id="TbSendPlan">
                            <thead>
                                <tr>
                                    <th>ปีการศึกษา</th>
                                    <th>รหัสวิชา</th>
                                    <th>ชื่อวิชา</th>
                                    <th>ระดับชั้น</th>
                                    <th>ประเภท</th>
                                    <th>ครูผู้สอน</th>
                                    <th>คำสั่ง</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($Plan as $key => $v_Plan): ?>
                                <tr id="<?=$v_Plan->seplan_coursecode?>">
                                    <td><?=$v_Plan->seplan_year?>/<?=$v_Plan->seplan_term?></td>
                                    <td><?=$v_Plan->seplan_coursecode?></td>
                                    <td><?=$v_Plan->seplan_namesubject?></td>
                                    <td>ม.<?=$v_Plan->seplan_gradelevel?></td>
                                    <td><?=$v_Plan->seplan_typesubject?></td>
                                    <td>
                                        <?=$v_Plan->pers_prefix.$v_Plan->pers_firstname.' '.$v_Plan->pers_lastname?>
                                    </td>
                                    <td width="10%"><a class="EditTeach" PlanCode="<?=$v_Plan->seplan_coursecode?>"
                                            PlanYear="<?=$v_Plan->seplan_year?>" PlanTerm="<?=$v_Plan->seplan_term?>"
                                            href="#">แก้ไข</a> |
                                        <a href="javascript:void(0)" class="DeleteTeach"
                                            delplancode="<?=$v_Plan->seplan_coursecode?>"
                                            delplanyear="<?=$v_Plan->seplan_year?>"
                                            delplanterm="<?=$v_Plan->seplan_term?>"
                                            delplanname="<?=$v_Plan->seplan_namesubject?>">ลบ</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>


            </div>
        </section>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="editteacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">แก้ไขข้อมูล</h5>              
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate id="FromUpdateTeacher">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mb-2">
                                <label for="up_seplan_year">ปีการศึกษา</label>
                                <input readonly type="text" class="form-control" placeholder="รหัสวิชา"
                                    id="up_seplan_year" name="up_seplan_year" required>
                                <div class="invalid-feedback">กรุณากรอปีการศึกษา</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-2">
                                <label for="up_seplan_term">ภาคเรียน</label>
                                <input readonly type="text" class="form-control" placeholder="รหัสวิชา"
                                    id="up_seplan_term" name="up_seplan_term" required>
                                <div class="invalid-feedback">กรุณากรอภาคเรียน</div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group mb-2">
                                <label for="up_seplan_coursecode">รหัสวิชา</label>
                                <input readonly type="text" class="form-control" placeholder="รหัสวิชา"
                                    id="up_seplan_coursecode" name="up_seplan_coursecode" required>
                                <div class="invalid-feedback">กรุณากรอกรหัสวิชา</div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group mb-2">
                                <label for="up_seplan_namesubject">ชื่อวิชา</label>
                                <input type="text" class="form-control" placeholder="ชื่อวิชา"
                                    id="up_seplan_namesubject" name="up_seplan_namesubject" required disabled>
                                <div class="invalid-feedback">กรุณากรอกชื่อวิชา</div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group mb-2">
                                <label for="up_seplan_gradelevel">ระดับชั้น</label>
                                <select class="form-select" id="up_seplan_gradelevel" name="up_seplan_gradelevel"
                                    required disabled>
                                    <option value="">เลือกระดับชั้น</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                                <div class="invalid-feedback">กรุณาเลือกระดับชั้น</div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group mb-2">
                                <label for="seplan_typesubject">ประเภท</label>
                                <select class="form-select" id="up_seplan_typesubject" name="up_seplan_typesubject"
                                    required disabled>
                                    <option value="">เลือกประเภท</option>
                                    <option value="พื้นฐาน">พื้นฐาน</option>
                                    <option value="เพิ่มเติม">เพิ่มเติม</option>
                                </select>
                                <div class="invalid-feedback">กรุณาเลือประเภท</div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group mb-2">
                                <label for="up_seplan_usersend">ครูผู้สอน</label>
                                <select class="form-select" id="up_seplan_usersend" name="up_seplan_usersend" required>
                                    <option value="">เลือกครูผู้สอน</option>
                                    <?php foreach ($Teacher as $key => $v_Teacher): ?>
                                    <option value="<?=$v_Teacher->pers_id;?>">
                                        <?=$v_Teacher->pers_prefix.$v_Teacher->pers_firstname.' '.$v_Teacher->pers_lastname;?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">กรุณาครูผู้สอน</div>
                            </div>
                        </div>

                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">แก้ไข</button>
            </div>
            </form>
        </div>
    </div>
</div>