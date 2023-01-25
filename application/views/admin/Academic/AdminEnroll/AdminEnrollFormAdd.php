<style>
.border-left-primary {
    border-left: .25rem solid #5BC3D5 !important;
}

.ss-main .ss-single-selected {
    height: 40px;
}
</style>
<div class="app-wrapper">
    <div class="container-xl">
        <div class="app-content pt-3 p-md-3 p-lg-4">


            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">จัดการข้อมูล<?=$title;?></h1>
                </div>
                <div class="col-auto">
                    <div class="page-utilities">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=base_url('Admin/Acade/Registration/Enroll')?>">หน้าหลัก</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?=$title;?></li>
                            </ol>
                        </nav>
                    </div>
                    <!--//table-utilities-->
                </div>

            </div>
            <!--//row-->

            </section>
            <hr class="mb-4">
            <section class="we-offer-area">
                <form id="FormEnroll" method="post" class="needs-validation" novalidate>

                <div class="row g-4 settings-section">
                        <div class="col-12 col-md-4">
                            <h3 class="section-title">ปีการศึกษา</h3>
                            <div class="section-intro">ให้เลือกปีการศึกษาที่จะลงทะเบียน </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                   
                                    <select  name="SelectYearRegister" id="SelectYearRegister" class="" required autocomplete="off">
                                        <option value="">เลือกปีการศึกษา</option>
                                        <?php $d = date('Y')+543; 
                                        for ($i=$d-2; $i<=$d; $i++): 
                                            for($j=1; $j<=3; $j++):
                                        ?>
                                        <option <?=$this->uri->segment(6).'/'.$this->uri->segment(7) == $j.'/'.$i ?"selected":""?> value="<?=$j.'/'.$i;?>"><?=$j.'/'.$i;?></option>
                                        <?php endfor; endfor; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        กรุณาเลือกปีการศึกษา
                                    </div>
                                </div>
                                <!--//app-card-body-->

                            </div>
                            <!--//app-card-->
                        </div>
                    </div>
                    <hr class="mb-4">


                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-4">
                            <h3 class="section-title">วิชาเรียน</h3>
                            <div class="section-intro">ให้เลือกวิชาเรียนที่ลงทะเบียน </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <select class="" name="subjectregis" id="subjectregis" class="subjectregis" required autocomplete="off">
                                        <option value="">เลือกวิชาเรียน</option>
                                        <?php foreach ($subject as $key => $v_subject): ?>
                                        <option value="<?=$v_subject->SubjectID?>">
                                        <?=$v_subject->SubjectCode?> <?=$v_subject->SubjectName?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        กรุณาเลือกวิชาเรียน
                                    </div>
                                </div>
                                <!--//app-card-body-->

                            </div>
                            <!--//app-card-->
                        </div>
                    </div>
                    <hr class="mb-4">
                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-4">
                            <h3 class="section-title">ครูผู้สอน</h3>
                            <div class="section-intro">ให้เลือกครูผู้สอนในวิชาที่ลงทะเบียน </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <select name="teacherregis" id="teacherregis" calss="teacherregis" required>
                                        <option value="">เลือกครูผู้สอน</option>
                                        <?php foreach ($teacher as $key => $v_teacher): ?>
                                        <option value="<?=$v_teacher->pers_id?>">
                                            <?=$v_teacher->pers_prefix.$v_teacher->pers_firstname.' '.$v_teacher->pers_lastname?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        กรุณาเลือกคุณครู
                                    </div>
                                </div>
                                <!--//app-card-body-->

                            </div>
                            <!--//app-card-->
                        </div>
                    </div>

                    <hr class="mb-4">
                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-4">
                            <h3 class="section-title">นักเรียน</h3>
                            <div class="section-intro">
                                ให้เลือกนักเรียนที่จะเรียนในวิชาที่ลงทะเบียน
                                <p>
                                    - ให้เลือกห้องเรียนก่อน <br>
                                    - เลือกนักเรียนจากด้านซ้าย เลือกไปด้านขวา <br>
                                    - ** สามารถเลือกนักเรียนกี่ห้องก็ได้ ให้เลือกห้องเรียนใหม่เท่านั้นเอง
                                </p>

                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <select name="Room" id="Room" class="mb-3 Room" required>
                                        <option value="">เลือกห้องเรียน</option>
                                        <?php $ListRoom = $this->classroom->ListRoom();
                                    foreach ($ListRoom as $key => $v_ListRoom): ?>
                                        <option value="<?=$v_ListRoom?>">
                                            ม.<?=$v_ListRoom?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        กรุณาเลือห้องเรียน
                                    </div>
                                    <!-- <div class="table-responsive">
                                    <table class="table mb-0 text-left" id="TB_showStudent">
                                        <thead>
                                            <tr>
                                                <th class="cell">เลือก</th>
                                                <th class="cell">เลขนักเรียน</th>
                                                <th class="cell">ชื่อ - สกุล</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                    </table>
                                </div> -->

                                    <div class="row mt-3">
                                        <div class="col-lg-5">
                                            <select name="from[]" id="multiselect" class="form-control" size="20"
                                                multiple="multiple" style="height:20rem">
                                            </select>
                                        </div>

                                        <div class="col-lg-2">
                                            <button type="button" id="multiselect_rightAll"
                                                class="btn btn-primary w-100 mb-1">เลือกทั้งหมด</button>
                                            <button type="button" id="multiselect_rightSelected"
                                                class="btn btn-primary w-100 mb-1">เลือก</i></button>
                                            <button type="button" id="multiselect_leftSelected"
                                                class="btn btn-primary w-100 mb-1">ลบ</button>
                                            <button type="button" id="multiselect_leftAll"
                                                class="btn btn-primary w-100 mb-1">ยกเลิกทั้งหมด</button>
                                        </div>

                                        <div class="col-lg-5">
                                            <select name="to[]" id="multiselect_to" class="form-control" size="8"
                                                required multiple="multiple" style="height:20rem"></select>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <button type="button" id="multiselect_move_up"
                                                        class="btn btn-block"><i
                                                            class="glyphicon glyphicon-arrow-up"></i></button>
                                                </div>
                                                <div class="col-lg-6">
                                                    <button type="button" id="multiselect_move_down"
                                                        class="btn btn-block col-sm-6"><i
                                                            class="glyphicon glyphicon-arrow-down"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--//app-card-body-->
                            </div>
                            <!--//app-card-->
                            <div class="mt-3">
                                <button type="submit" class="btn btn-success w-100">บันทึก</button>
                            </div>

                        </div>
                    </div>

        </div>
        </form>
        <!--//container-->
        </section>


    </div>
</div>
<!--//main-wrapper-->