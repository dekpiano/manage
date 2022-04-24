<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <section class="cta-section theme-bg-light py-5">
                <div class="container text-center">

                    <h2 class="heading">จัดการข้อมูล<?=$title;?></h2>
                </div>
                <!--//container-->
            </section>
            <div class="container-xl">
                <div class="card">
                    <div class="card-body">
                        <button class="btn app-btn-primary btn-sm text-right mb-3" id="ModalAddExtraSubject"> <i
                                class="far fa-plus-square"></i> เพิ่ม<?=$title;?></button>
                                <a href="<?=base_url('Admin/Acade/SettingSystem')?>" class="btn btn-secondary btn-sm text-right mb-3" id="ModalAddExtraSubject"> <i class="fa fa-cog" aria-hidden="true"></i> ตั้งค่าระบบ</a>
                                <a href="<?=base_url('Admin/Acade/Report')?>" class="btn btn-info btn-sm text-right mb-3" id="ModalAddExtraSubject"> <i class="fa fa-print" aria-hidden="true"></i> รายงาน</a>
                        <div class="table-responsive">
                            <table class="table mb-0" id="example">
                                <thead>
                                    <tr class="text-center">
                                        <th rowspan=2>ภาคเรียน</th>
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
                                        <td><?=$v_ExtraSubject->extra_year?>/<?=$v_ExtraSubject->extra_term?></td>
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
                                        <td>
                                        <?php foreach ($CountStudentRegister as $key => $v_conutstu) {
                                           if($v_conutstu->fk_extra_id == $v_ExtraSubject->extra_id){
                                                echo $v_conutstu->CountAll;
                                           }
                                        }?>
                                        </td>
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



        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">เพิ่มวิชาเพิ่มเติม</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="AddExtraSubject" class="needs-validation" novalidate>
                            <input type="hidden" name="extra_id" id="extra_id" value="">
                            <div class="mb-2">
                                <label for="email">ปีการศึกษา <?php $d= (date('Y')+543)-1;?></label>
                                <select name="extra_year" id="extra_year" class="form-select" required>
                                    <?php for($i=$d; $i<=$d+2; $i++) : ?>
                                    <option <?=$i==date('Y')+543 ? 'selected' : ''?> value="<?=$i?>"><?=$i;?></option>
                                    <?php endfor; ?>
                                </select>
                       
                                <div class="invalid-feedback">กรุณากรอกชื่อวิชา</div>
                            </div>
                            <div class="mb-2">
                                <label for="email">ภาคเรียน </label>
                                <select name="extra_term" id="extra_term" class="form-select" required>
                                    <option value="">เลือกภาคเรียน</option>
                                    <?php for($i=1; $i<=3; $i++) : ?>
                                    <option value="<?=$i?>"><?=$i;?></option>
                                    <?php endfor; ?>
                                </select>
                                <div class="invalid-feedback">กรุณาเลือกภาคเรียน</div>
                            </div>
                            <div class="mb-2">
                                <label for="classroom">รหัสวิชา <small>(Ex. ว20125)</small></label>
                                <input type="text" class="form-control" placeholder=""
                                    name="extra_course_code" id="extra_course_code" required>
                                    <div class="invalid-feedback">กรุณากรอกรหัสวิชา</div>
                            </div>
                            <div class="mb-2">
                                <label for="classroom">ชื่อวิชา</label>
                                <input type="text" class="form-control" placeholder=""
                                    name="extra_course_name" id="extra_course_name" required>
                                    <div class="invalid-feedback">กรุณากรอกชื่อวิชา</div>
                            </div>
                            <div class="mb-2">
                                <label for="classroom">คีย์ระดับชั้น <small>(ใส่ข้อมูลในกรณี ให้นักเรียนต้องเลือก มากกว่า 1 วิชา Ex. 6-1, 3-2)</small></label>
                                <input type="text" class="form-control" placeholder=""
                                    name="extra_key_room" id="extra_key_room">
                                    <div class="invalid-feedback">กรุณาคีย์ระดับชั้น</div>
                            </div>
                            <div class="mb-2">
                                <label for="email">ระดับชั้นที่สอน <small>(เลือกได้มากกว่า 1 ห้องเรียน)</small> </label><br>
                                <select class="multiple extra_grade_level " id="extra_grade_level" multiple name="extra_grade_level[]" required>
                                <?php 
                                $room = array('1/1','1/2','1/3','1/4','2/1','2/2','2/3','2/4','3/1','3/2','3/3','3/4','4/1','4/2','4/3','4/4','5/1','5/2','5/3','5/4','6/1','6/2','6/3','6/4');
                                   foreach ($room as $key => $v_room) : ?>
                                    <option value="<?=$v_room?>">ม.<?=$v_room?></option>
                                    <?php endforeach;   ?>
                                </select>
                                <div class="invalid-feedback">กรุณาเลือกระดับชั้นที่สอน</div>
                            </div>
                            <div class="mb-2">
                                <label for="classroom">จำนวนที่รับ</label>
                                <input type="text" class="form-control" placeholder=""
                                    name="extra_number_students" id="extra_number_students" required>
                                    <div class="invalid-feedback">กรุณากรอกจำนวนที่รับนักเรียน</div>
                            </div>
                            <div class="mb-2">
                                <label for="teacher">ครูผู้สอน:</label>
                                <select name="extra_course_teacher" id="extra_course_teacher" class="single"  required>
                                    <option value=''>เลือกครูผู้สอน</option>
                                    <?php foreach ($NameTeacher as $key => $v_NameTeacher) : ?>
                                    <option
                                        value="<?=$v_NameTeacher->pers_prefix.$v_NameTeacher->pers_firstname.' '.$v_NameTeacher->pers_lastname?>">
                                        <?=$v_NameTeacher->pers_prefix.$v_NameTeacher->pers_firstname.' '.$v_NameTeacher->pers_lastname?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">กรุณาเลือกครูผู้สอน</div>
                            </div>
                            <div class="mb-2">
                                <label for="classroom">หมายเหตุ</label>
                                <input type="text" class="form-control" placeholder="Ex. รับเฉพาะ ม.2"
                                    name="extra_comment" id="extra_comment">
                            </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" id="sub_ExtraSubject" class="btn app-btn-primary">บันทึก</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

</div>