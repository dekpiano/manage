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
            <?php foreach ($lean as $key => $v_lean): ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body statistic">
                        <div class="media align-items-center">
                            <div class="icon bg-red"><i class="fa fa-tasks"></i></div>
                            <div class="media-body overflow-hidden">
                                <h5 class="card-text mb-0"> <?=$v_lean->lear_namethai?></h5>
                                <small><?=$v_lean->lear_nameeng?></small>

                            </div>
                        </div><a href="<?=base_url('Teacher/Course/CheckPlan/');?><?=$v_lean->lear_id?>"
                            class="tile-link"></a>
                    </div>
                </div>

            </div>
            <?php endforeach; ?>

        </div>

        <?php if(isset($ID)) : ?>
        <div class="card">
            <div class="card-body">
                <table id="tb_checkplan" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>ภาคเรียน</th>
                            <th>ปีการศึกษา</th>
                            <th>ประเภท</th>
                            <th>รหัสวิชา</th>
                            <th>ชื่อวิชา</th>
                            <th>ผู้ส่ง</th>
                            <th>วันที่ส่ง</th>
                            <th>ไฟล์</th>
                            <th style="width:100px;">หน.กลุ่มสาระ</th>
                            <th style="width:100px;">หน.งานพัฒนาหลักสูตร</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($checkplan as $key => $v_checkplan): ?>
                        <tr>
                            <td><?=$v_checkplan->seplan_term;?></td>
                            <td><?=$v_checkplan->seplan_year;?></td>
                            <td><?=$v_checkplan->seplan_typeplan;?></td>
                            <td><?=$v_checkplan->seplan_coursecode;?></td>
                            <td><?=$v_checkplan->seplan_namesubject;?></td>
                            <td><?=$v_checkplan->pers_prefix.$v_checkplan->pers_firstname.' '.$v_checkplan->pers_lastname;?>
                            </td>
                            <td><?=$v_checkplan->seplan_createdate;?></td>
                            <td><a target="_blank"
                                    href="<?=base_url('uploads/academic/course/plan/').$v_checkplan->seplan_file;?>">เปิดดู</a>
                            </td>
                            <td>
                                <select name="account" class="form-control mb-3">
                                    <option value="รอตรวจ">รอตรวจ</option>
                                    <option value="ผ่าน">ผ่าน</option>
                                    <option value="ไม่ผ่าน">ไม่ผ่าน</option>
                                </select>
                                <?=$v_checkplan->seplan_status1;?>
                            </td>
                            <td>
                                <select name="account" class="form-control mb-3">
                                    <option value="รอตรวจ">รอตรวจ</option>
                                    <option value="ผ่าน">ผ่าน</option>
                                    <option value="ไม่ผ่าน">ไม่ผ่าน</option>
                                </select>
                                <?=$v_checkplan->seplan_status2;?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>

            </div>
        </div>
        <?php endif; ?>

    </div>
</section>