<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <section class="cta-section theme-bg-light py-5">
                <div class="container text-center">

                    <h2 class="heading">จัดการข้อมูล<?=$title;?></h2>
                </div>
                <!--//container-->
            </section>
            <div class="container">

                <div class="row g-4 mb-4">
                    <div class="col-6 col-lg-4">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">จัดการข้อมูล</h4>
                                <div class="stats-figure">นักเรียน ปกติ</div>
                              
                            </div>
                            <!--//app-card-body-->
                            <a class="app-card-link-mask" href="<?=base_url('Admin/Acade/Registration/Students/ปกติ')?>"></a>
                        </div>
                        <!--//app-card-->
                    </div>
                    <!--//col-->
                    <div class="col-6 col-lg-4">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">จัดการข้อมูล</h4>
                                <div class="stats-figure">นักเรียน ขาดเรียนนาน</div>
                              
                            </div>
                            <!--//app-card-body-->
                            <a class="app-card-link-mask" href="<?=base_url('Admin/Acade/Registration/Students/ขาดเรียนนาน')?>"></a>
                        </div>
                        <!--//app-card-->
                    </div>
                    <!--//col-->
                    <div class="col-6 col-lg-4">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">จัดการข้อมูล</h4>
                                <div class="stats-figure">นักเรียน จำหน่าย</div>
                              
                            </div>
                            <!--//app-card-body-->
                            <a class="app-card-link-mask" href="<?=base_url('Admin/Acade/Registration/Students/จำหน่าย')?>"></a>
                        </div>
                        <!--//app-card-->
                    </div>
                    <!--//col-->

                   
                 
                </div>

                <?php if($stu) :?>
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        สถานะนักเรียน<?=$stu[0]->StudentBehavior?>
                    </div>
                    <div class="card-body">
                        <a href="https://docs.google.com/spreadsheets/d/1Je4jmVm3l84xDMAJDqQtdrRB13wWwFl2Fy2b7FvX1Ec/edit#gid=0"
                            target="_blank" class="btn btn-primary btn-sm float-right mb-3">
                            <i class="far fa-plus-square"></i> เพิ่มข้อมูลนักเรียน
                        </a>
                        <a href="<?=base_url('Admin/Acade/Registration/StudentsUpdate');?>"
                            class="btn btn-primary btn-sm float-right mb-3 clickLoad-spin">
                            <i class="far fa-plus-square"></i> อัพเดพข้อมูลนักเรียน
                        </a>

                        <table class="table table-bordered" id="tbStudent">
                            <thead>
                                <tr>
                                    <th>เลขประจำตัว</th>
                                    <th>ชื่อ - นามสกุล</th>
                                    <th>ชั้น</th>
                                    <th>เลขที่</th>
                                    <th>สถานะพฤติกรรม</th>
                                    <th>รายละเอียด</th>
                                    <th>คำสั่ง</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($stu as $key => $v_stu): ?>
                                <tr class="<?=$v_stu->StudentCode?> <?=$v_stu->StudentID?>">
                                    <td><?=$v_stu->StudentCode?></td>
                                    <td><?=$v_stu->StudentPrefix?><?=$v_stu->StudentFirstName?>
                                        <?=$v_stu->StudentLastName?></td>
                                    <td><?=$v_stu->StudentClass?></td>
                                    <td><?=$v_stu->StudentNumber?></td>
                                    <td>
                                        <div>
                                            <?php $StatusBehavior = array('ปกติ','ขาดเรียนนาน','จำหน่าย') ?>
                                            <select name="StudentBehavior" id="StudentBehavior"
                                                class="form-select form-select-sm StudentBehavior"
                                                data-stuid="<?=$v_stu->StudentID?>">
                                                <?php foreach ($StatusBehavior as $key => $v_Status) : ?>
                                                <option <?=$v_stu->StudentBehavior == $v_Status ?"selected":""?>
                                                    value="<?=$v_Status?>"><?=$v_Status;?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td><a href="#">เปิดดู</a></td>
                                    <td><a class="delete_student btn btn-danger" href="#"
                                            idStu="<?=$v_stu->StudentCode?>">ลบ</a></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
                <?php endif; ?>


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
                        <form id="AddClassRoom" action="#">
                            <div class="form-group">
                                <label for="email">ปีการศึกษา <?php $d= (date('Y')+543)-1;?></label>
                                <select name="year" id="year" class="custom-select">
                                    <?php for($i=$d; $i<=$d+2; $i++) : ?>
                                    <option <?=$i==date('Y')+543 ? 'selected' : ''?>><?=$i;?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="classroom">ห้องเรียน</label>
                                <input type="text" class="form-control" placeholder="ตัวอย่าง เช่น 2/5, 4/1"
                                    name="classroom" id="classroom" required>
                            </div>
                            <div class="form-group">
                                <label for="teacher">ครูที่ปรึกษา:</label>
                                <select name="teacher" id="teacher" class="custom-select" required>

                                    <option value=''>เลือกครูที่ปรึกษา</option>
                                    <?php foreach ($NameTeacher as $key => $v_NameTeacher) : ?>
                                    <?php if(in_array($v_NameTeacher->pers_id,$tea)): ?>

                                    <?php else: ?>
                                    <option value="<?=$v_NameTeacher->pers_id;?>">
                                        <?=$v_NameTeacher->pers_prefix.$v_NameTeacher->pers_firstname.' '.$v_NameTeacher->pers_lastname?>
                                    </option>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>