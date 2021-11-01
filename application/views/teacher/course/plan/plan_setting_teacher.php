<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom"><?=$title;?></h2>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="no-padding-bottom">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form class="needs-validation" novalidate id="form_insert_plan">
                    <div class="row">
                        <div class="col-md-2 col-sm-12">
                            <label for="seplan_coursecode">รหัสวิชา</label>
                            <input type="text" class="form-control" placeholder="รหัสวิชา" id="seplan_coursecode"
                                name="seplan_coursecode" required>
                            <div class="invalid-feedback">กรุณากรอกรหัสวิชา</div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <label for="seplan_namesubject">ชื่อวิชา</label>
                            <input type="text" class="form-control" placeholder="ชื่อวิชา" id="seplan_namesubject"
                                name="seplan_namesubject" required>
                            <div class="invalid-feedback">กรุณากรอกชื่อวิชา</div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <label for="seplan_gradelevel">ระดับชั้น</label>
                            <select class="form-control" id="seplan_gradelevel" name="seplan_gradelevel" required>
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
                        <div class="col-md-2 col-sm-12">
                            <label for="seplan_typesubject">ประเภท</label>
                            <select class="form-control" id="seplan_typesubject" name="seplan_typesubject" required>
                                <option value="">เลือกประเภท</option>
                                <option value="พื้นฐาน">พื้นฐาน</option>
                                <option value="เพิ่มเติม">เพิ่มเติม</option>
                            </select>
                            <div class="invalid-feedback">กรุณาเลือประเภท</div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="seplan_usersend">ครูผู้สอน</label>
                            <select class="form-control" id="seplan_usersend" name="seplan_usersend" required>
                                <option value="">เลือกครูผู้สอน</option>
                                <?php foreach ($pers as $key => $v_pers): ?>
                                <option value="<?=$v_pers->pers_id;?>">
                                    <?=$v_pers->pers_prefix.$v_pers->pers_firstname.' '.$v_pers->pers_lastname;?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">กรุณาครูผู้สอน</div>
                        </div>
                        <button type="submit" class="btn btn-primary">บันทึก</button>

                    </div>
                </form>
            </div>
        </div>

        <div class="card">

            <div class="card-header d-flex align-items-center">
                <h3 class="h4">รายการวิชาที่สอน</h3>
            </div>
            <div class="card-body">
                <table class="table table-hover" id="TableShoowPlan">
                    <thead>
                        <tr>
                            <th>ปีการศึกษา</th>
                            <th>รหัสวิชา</th>
                            <th>ชื่อวิชา</th>
                            <th>ระดับชั้น</th>
                            <th>ประเภท</th>
                            <th>ครูผู้สอน</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Plan as $key => $v_Plan): ?>
                        <tr>
                            <td><?=$v_Plan->seplan_year?>/<?=$v_Plan->seplan_term?></td>
                            <td><?=$v_Plan->seplan_coursecode?></td>
                            <td><?=$v_Plan->seplan_namesubject?></td>
                            <td>ม.<?=$v_Plan->seplan_gradelevel?></td>
                            <td><?=$v_Plan->seplan_typesubject?></td>
                            <td><?=$v_Plan->pers_prefix?><?=$v_Plan->pers_firstname?> <?=$v_Plan->pers_lastname?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>


    </div>
</section>