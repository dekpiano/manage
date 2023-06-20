<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <section class="cta-section theme-bg-light py-5">
                <div class="container text-center">
                    <h2 class="heading">จัดการข้อมูล<?=$title;?></h2>
                    <div class="mt-4">
                        <a href="https://docs.google.com/spreadsheets/d/1Je4jmVm3l84xDMAJDqQtdrRB13wWwFl2Fy2b7FvX1Ec/edit#gid=0"
                            target="_blank" class="btn btn-primary btn-sm float-right mb-3">
                            <i class="far fa-plus-square"></i> เพิ่มข้อมูลนักเรียน
                        </a>
                        <a href="<?=base_url('Admin/Acade/Registration/StudentsUpdate');?>"
                            class="btn btn-primary btn-sm float-right mb-3 clickLoad-spin">
                            <i class="far fa-plus-square"></i> อัพเดพข้อมูลนักเรียน
                        </a>
                    </div>

                </div>
                <!--//container-->
            </section>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-4 mb-4">
                        <div class="app-card app-card-chart h-100 shadow-sm">
                            <div class="app-card-header p-3 border-0">
                                <h4 class="app-card-title">นักเรียนทั้งหมด</h4>
                            </div>
                            <!--//app-card-header-->
                            <div class="app-card-body p-4">
                                <div class="chart-container">
                                    <canvas id="chart-doughnut" style="width: 100px;"></canvas>
                                </div>
                            </div>
                            <!--//app-card-body-->
                        </div>
                        <!--//app-card-->
                    </div>

                    <div class="col-12 col-lg-8">
                        <div class="app-card d-flex flex-column align-items-start shadow-sm">
                            <div class="app-card-header p-3 w-100">
                                <div class="align-items-center gx-3 d-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="col-auto">
                                            <div class="app-icon-holder">
                                                <i class="bi bi-people-fill"></i>
                                            </div>
                                            <!--//icon-holder-->

                                        </div>
                                        <!--//col-->
                                        <div class="col-auto">
                                            <h4 class="app-card-title">นักเรียนทั้งหมด</h4>
                                            <p style="margin-bottom: auto">ปีการศึกษา <?=$SchoolYear->schyear_year?></p>
                                        </div>
                                        <!--//col-->
                                    </div>
                                    <div>
                                        <div class="col-auto">
                                            <h2 class="app-card-title"><?=$CountAllStu[0]->stuall?></h2>
                                        </div>
                                    </div>

                                </div>
                                <!--//row-->
                            </div>
                            <!--//app-card-header-->

                        </div>
                        <!--//app-card-->


                        <div class="app-card d-flex flex-column align-items-start shadow-sm">
                            <div class="app-card-header p-3 w-100">
                                <div class="align-items-center gx-3 d-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="col-auto">
                                            <div class="app-icon-holder">
                                                <i class="bi bi-people-fill"></i>
                                            </div>
                                            <!--//icon-holder-->

                                        </div>
                                        <!--//col-->
                                        <div class="col-auto">
                                            <h4 class="app-card-title">นักเรียน ปกติ</h4>
                                            <p style="margin-bottom: auto">ปีการศึกษา <?=$SchoolYear->schyear_year?>
                                            </p>
                                        </div>
                                        <!--//col-->
                                    </div>
                                    <div>
                                        <div class="col-auto">
                                            <h2 class="app-card-title"><?=$CountNormalStu[0]->stunormal?></h2>
                                        </div>
                                    </div>

                                </div>
                                <!--//row-->
                            </div>
                            <!--//app-card-header-->

                        </div>
                        <!--//app-card-->

                        <div class="app-card d-flex flex-column align-items-start shadow-sm">
                            <div class="app-card-header p-3  w-100">
                                <div class="align-items-center gx-3 d-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="col-auto">
                                            <div class="app-icon-holder">
                                                <i class="bi bi-people-fill"></i>
                                            </div>
                                            <!--//icon-holder-->

                                        </div>
                                        <!--//col-->
                                        <div class="col-auto">
                                            <h4 class="app-card-title">นักเรียน ขาดเรียนนาน</h4>
                                            <p style="margin-bottom: auto">ปีการศึกษา <?=$SchoolYear->schyear_year?>
                                            </p>
                                        </div>
                                        <!--//col-->
                                    </div>
                                    <div>
                                        <div class="col-auto">
                                            <h2 class="app-card-title"><?=$CountAbsentStu[0]->stuabsent?></h2>
                                        </div>
                                    </div>

                                </div>
                                <!--//row-->
                            </div>
                            <!--//app-card-header-->

                        </div>
                        <hr>
                        <div class="row g-4 mb-4">
                            <div class="col-6 col-lg-6">
                                <div class="app-card app-card-stat shadow-sm h-100">
                                    <div class="app-card-body p-3 p-lg-4">
                                        <h4 class="stats-type mb-1">จัดการข้อมูล</h4>
                                        <div class="stats-figure">นักเรียน ปกติ</div>

                                    </div>
                                    <!--//app-card-body-->
                                    <a class="app-card-link-mask"
                                        href="<?=base_url('Admin/Acade/Registration/Students/Normal')?>"></a>
                                </div>
                                <!--//app-card-->
                            </div>

                            <!-- <div class="col-6 col-lg-4">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">จัดการข้อมูล</h4>
                                <div class="stats-figure">นักเรียน ขาดเรียนนาน</div>
                              
                            </div>
                            <a class="app-card-link-mask" href="<?=base_url('Admin/Acade/Registration/Students/ขาดเรียนนาน')?>"></a>
                        </div>
                        
                    </div> -->

                            <div class="col-6 col-lg-6">
                                <div class="app-card app-card-stat shadow-sm h-100">
                                    <div class="app-card-body p-3 p-lg-4">
                                        <h4 class="stats-type mb-1">จัดการข้อมูล</h4>
                                        <div class="stats-figure">นักเรียน จำหน่าย</div>

                                    </div>
                                    <!--//app-card-body-->
                                    <a class="app-card-link-mask clickLoder"
                                        href="<?=base_url('Admin/Acade/Registration/Students/จำหน่าย')?>"></a>
                                </div>
                                <!--//app-card-->
                            </div>
                            <!--//col-->
                        </div>

                    </div>

                </div>

                <hr>
                <h1 class="app-page-title mb-3">รายละเอียดข้อมูลนักเรียน</h1>
                <div class="col-6 col-lg-6">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">จัดการข้อมูล</h4>
                            <div class="stats-figure">นักเรียน LEC</div>

                        </div>
                        <!--//app-card-body-->
                        <a class="app-card-link-mask clickLoder" href="#"></a>
                    </div>
                    <!--//app-card-->
                </div>
                <!--//col-->

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