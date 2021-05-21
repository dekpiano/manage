<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center ">
            <h2 class="no-margin-bottom">ตรวจสอบงาน</h2>

        </div>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body statistic">
                        <div class="media align-items-center">
                            <div class="icon bg-red"><i class="fa fa-file-text" aria-hidden="true"></i></div>
                            <div class="media-body overflow-hidden">
                                <h5 class="card-text mb-0"> รายงานโครงการสอน</h5>
                            </div>
                        </div><a href="<?=base_url('Teacher/Course/ReportPlan/โครงการสอน');?>" class="tile-link"></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body statistic">
                        <div class="media align-items-center">
                            <div class="icon bg-red"><i class="fa fa-file-text" aria-hidden="true"></i></div>
                            <div class="media-body overflow-hidden">
                                <h5 class="card-text mb-0"> รายงานแผนการสอนหน้าเดียว</h5>
                            </div>
                        </div><a href="<?=base_url('Teacher/Course/ReportPlan/แผนการสอนหน้าเดียว');?>"
                            class="tile-link"></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body statistic">
                        <div class="media align-items-center">
                            <div class="icon bg-red"><i class="fa fa-file-text" aria-hidden="true"></i></div>
                            <div class="media-body overflow-hidden">
                                <h5 class="card-text mb-0"> รายงานบันทึกหลังสอน</h5>
                            </div>
                        </div><a href="<?=base_url('Teacher/Course/ReportPlan/บันทึกหลังสอน');?>" class="tile-link"></a>
                    </div>
                </div>
            </div>
        </div>


        <?php if(isset($ID)): ?>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="" class="table table-hover table-bordered" style="width:100%">
                        <thead>
                            <tr class="text-center">
                                <td colspan="9">ทะเบียนส่ง<?=$thai;?></td>
                            </tr>
                            <tr class="text-center">
                                <td colspan="9">กลุ่มสาระการเรียนรู้<?=$lean[0]->lear_namethai?></td>
                            </tr>
                            <tr class="text-center">
                                <td colspan="9">ภาคเรียนที่ <?=$setupplan[0]->seplanset_term?> ปีการศึกษา
                                    <?=$setupplan[0]->seplanset_year?></td>
                            </tr>
                            <tr class="text-center">
                                <th rowspan="2">ที่</th>
                                <th rowspan="2">ชื่อ-นามสกุล</th>
                                <th colspan="2">รายวิชา</th>
                                <th rowspan="2">ชื่อวิชา</th>
                                <th rowspan="2">รหัสวิชา</th>
                                <th rowspan="2">ระดับชั้น</th>
                                <th rowspan="2">วัน/เดือน/ปี</th>
                                <th rowspan="2">หมายเหตุ</th>
                            </tr>
                            <tr class="text-center">
                                <th>เพิ่มเติม</th>
                                <th>พื้นฐาน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($checkplan as $key => $v_checkplan):
                                $bg_alert = '';
                                if($v_checkplan->seplan_status1 == "ผ่าน" && $v_checkplan->seplan_status2 == "ผ่าน"){
                                    $bg_alert = "table-success";
                                }
                            ?>

                            <tr id="bgC<?=$v_checkplan->seplan_ID;?>">
                                <!-- class="<?=$bg_alert;?>" -->
                                <td><?=$key+1;?></td>
                                <td><?=$v_checkplan->pers_prefix.$v_checkplan->pers_firstname.' '.$v_checkplan->pers_lastname;?>
                                </td>
                                <td><?=$v_checkplan->seplan_typesubject=="พื้นฐาน" ? '&#10004;' : ''?></td>
                                <td><?=$v_checkplan->seplan_typesubject=="เพิ่มเติม" ? '&#10004;' : ''?></td>
                                <td><?=$v_checkplan->seplan_namesubject;?></td>
                                <td><?=$v_checkplan->seplan_coursecode;?></td>
                                <td>ม.<?=$v_checkplan->seplan_gradelevel;?></td>

                                <td><?=$this->datethai->thai_date_fullmonth(strtotime($v_checkplan->seplan_createdate));?>
                                </td>

                                <td></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                    <div class="text-center">
                        <a class="btn btn-primary" href="<?=base_url('teacher/ConTeacherCourse/report_plan_print/'.$thai)?>"><i
                                class="fa fa-print" aria-hidden="true"></i> ดาวโหลดรายงาน .xlsx</a>                        
                    </div>
                    <!-- <div class="text-red text-center mt-3">
                                หมายเหตุ**  ข้อมูลจะปรากฏในตารางก็ต่อเมื่อ หัวหน้ากลุ่มสาระและหัวหน้ากลุ่มงานหลักสูตร ตรวจว่าผ่าน ทั้งคู่
                    </div> -->


                </div>
            </div>
        </div>
        <?php endif; ?>

    </div>
</section>