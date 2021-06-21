<div class="main-wrapper theme-bg-light ">
    <section class="cta-section theme-bg-light py-5">
        <div class="container text-center">

            <h2 class="heading">จัดการข้อมูล<?=$title;?></h2>
        </div>
        <!--//container-->
    </section>
    <div class="container-xl">
        <div class="card">
            <div class="card-body">
                <button class="btn btn-primary btn-sm float-right mb-3" id="ModalAddExtraSubject"> <i
                        class="far fa-plus-square"></i> เพิ่ม<?=$title;?></button>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tb-classroom">
                        <thead>
                            <tr class="text-center">
                                <th rowspan=2>ลำดับ</th>
                                <th rowspan=2>ชื่อวิชา</th>
                                <th rowspan=2>ครูที่ปรึกษา</th>
                                <th rowspan=2>ระดับชั้นที่ลงทะเบียนได้</th>
                                <th colspan="2">สมาชิก</th>
                                <th rowspan=2>คำสั่ง</th>
                            </tr>
                            <tr class="text-center">
                                <th colspan="1">รับทั้งหมด</th>
                                <th colspan="1">ปัจจุบัน</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php foreach ($ExtraSubject as $key => $v_ExtraSubject) : ?>
                            <tr>
                                <td><?=$key+1?></td>
                                <td><?=$v_ExtraSubject->extra_course_name?></td>
                                <td><?=$v_ExtraSubject->extra_course_teacher?></td>
                                <td>
                                    <?php 
                            $level =  explode("|",$v_ExtraSubject->extra_grade_level);
                            foreach ($level as $key => $v_level) {
                               echo "ม.".$v_level." ";
                            }
                            ?>
                                </td>
                                <td><?=$v_ExtraSubject->extra_number_students?></td>
                                <td></td>
                                <td><a class="ModalExtraSubject" Extraid="<?=$v_ExtraSubject->extra_id?>"
                                        href="#">แก้ไข</a>|<a href="http://">ลบ</a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">เพิ่ม<?=$title;?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form id="AddExtraSubject" class="needs-validation" novalidate>
                <input type="hidden" name="extra_id" id="extra_id" value="">
                    <div class="form-group">
                        <label for="email">ปีการศึกษา <?php $d= (date('Y')+543)-1;?></label>
                        <select name="extra_year" id="extra_year" class="custom-select" required>
                            <?php for($i=$d; $i<=$d+2; $i++) : ?>
                            <option <?=$i==date('Y')+543 ? 'selected' : ''?> value="<?=$i?>"><?=$i;?></option>
                            <?php endfor; ?>
                        </select>
                        <div class="invalid-feedback">กรุณากรอกชื่อวิชา</div>
                    </div>
                    <div class="form-group">
                        <label for="email">ภาคเรียน </label>
                        <select name="extra_term" id="extra_term" class="custom-select" required>
                            <option value="">เลือกภาคเรียน</option>
                            <?php for($i=1; $i<=3; $i++) : ?>
                            <option value="<?=$i?>"><?=$i;?></option>
                            <?php endfor; ?>
                        </select>
                        <div class="invalid-feedback">กรุณาเลือกภาคเรียน</div>
                    </div>
                    <div class="form-group">
                        <label for="classroom">รหัสวิชา</label>
                        <input type="text" class="form-control" placeholder="Ex. ว20125" name="extra_course_code"
                            id="extra_course_code" required>
                    </div>
                    <div class="form-group">
                        <label for="classroom">ชื่อวิชา</label>
                        <input type="text" class="form-control" placeholder="วิทย์เพิ่่มเติม" name="extra_course_name"
                            id="extra_course_name" required>
                    </div>
                    <div class="form-group">                 
                        <label for="email">ระดับชั้นที่สอน </label><br>
                        <?php for ($i=1; $i <= 6; $i++) : ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input extra_grade_level" type="checkbox" name="extra_grade_level[]"
                                id="extra_grade_level<?=$i?>" value="<?=$i?>">
                            <label class="form-check-label" for="extra_grade_level<?=$i?>">ม.<?=$i?></label>
                        </div>
                        <?php endfor; ?>
                    </div>
                    <div class="form-group">
                        <label for="classroom">จำนวนที่รับ</label>
                        <input type="text" class="form-control" placeholder="จำนวนที่รับของนักเรียน"
                            name="extra_number_students" id="extra_number_students" required>
                    </div>
                    <div class="form-group">
                        <label for="teacher">ครูผู้สอน:</label>
                        <select name="extra_course_teacher" id="extra_course_teacher" class="custom-select" required>
                            <option value=''>เลือกครูผู้สอน</option>
                            <?php foreach ($NameTeacher as $key => $v_NameTeacher) : ?>

                            <option
                                value="<?=$v_NameTeacher->pers_prefix.$v_NameTeacher->pers_firstname.' '.$v_NameTeacher->pers_lastname?>">
                                <?=$v_NameTeacher->pers_prefix.$v_NameTeacher->pers_firstname.' '.$v_NameTeacher->pers_lastname?>
                            </option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="classroom">หมายเหตุ</label>
                        <input type="text" class="form-control" placeholder="Ex. รับเฉพาะ ม.2" name="extra_comment"
                            id="extra_comment">
                    </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" id="sub_ExtraSubject" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>
    </div>
</div>