<div class="main-wrapper theme-bg-light ">
    <section class="cta-section theme-bg-light py-5">
        <div class="container text-center">

            <h2 class="heading">จัดการข้อมูล<?=$title;?></h2>
        </div>
        <!--//container-->
    </section>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <button class="btn btn-primary btn-sm float-right mb-3" id="ModalAddClassRoom"> <i class="far fa-plus-square"></i> เพิ่ม<?=$title;?></button>

                <table class="table table-bordered" id="tb-classroom" >
                    <thead>
                        <tr>
                            <th>ปีการศึกษา</th>
                            <th>ห้องเรียน</th>
                            <th>ครูที่ปรึกษา</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $tea = []; foreach ($classRoom as $key => $v_classRoom) : 
                    $tea[] = $v_classRoom->class_teacher;
                        ?>
                        <tr>
                            <td><?=$v_classRoom->Reg_Year?></td>
                            <td><?=$v_classRoom->Reg_Class?></td>
                            <td><?=$v_classRoom->pers_prefix.$v_classRoom->pers_firstname.' '.$v_classRoom->pers_lastname?></td>
                        </tr>
                    <?php endforeach; ?>  
                    </tbody>
                </table>

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
                        <div class="invalid-feedback">กรุณากรอกชื่อวิชา</div>
                    </div>
                    <div class="form-group">
                        <label for="classroom">รหัสวิชา</label>
                        <input type="text" class="form-control" placeholder="Ex. ว20125" name="extra_course_code" id="extra_course_code" required>
                    </div>
                    <div class="form-group">
                        <label for="classroom">ชื่อวิชา</label>
                        <input type="text" class="form-control" placeholder="วิทย์เพิ่่มเติม" name="extra_course_name" id="extra_course_name" required>
                    </div>
                    <div class="form-group">
                    <label for="email">ระดับชั้นที่สอน </label>
                    <select name="extra_groug" id="extra_groug" class="custom-select" required>
                                <option value="">เลือกระดับชั้น</option>
                                <?php for($i=1; $i<=6; $i++) : ?>
                                <option value="<?=$i?>"><?=$i;?></option>
                                <?php endfor; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="classroom">จำนวนที่รับ</label>
                        <input type="text" class="form-control" placeholder="จำนวนที่รับของนักเรียน" name="extra_number_students" id="extra_number_students" required>
                    </div>
                    <div class="form-group">
                        <label for="teacher">ครูผู้สอน:</label>
                        <select name="teacher" id="teacher" class="custom-select" required>                       
                                <option value=''>เลือกครูผู้สอน</option>
                                <?php foreach ($NameTeacher as $key => $v_NameTeacher) : ?>
                                  
                                <option value="<?=$v_NameTeacher->pers_id;?>">                             
                                    <?=$v_NameTeacher->pers_prefix.$v_NameTeacher->pers_firstname.' '.$v_NameTeacher->pers_lastname?>
                                </option>
                               
                                <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="classroom">หมายเหตุ</label>
                        <input type="text" class="form-control" placeholder="Ex. รับเฉพาะ ม.2" name="extra_comment" id="extra_comment" >
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