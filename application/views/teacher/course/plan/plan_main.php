<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center ">
            <h2 class="no-margin-bottom">แผนการสอน</h2>
            <p class="mb-0">

                <a href="<?=base_url('Teacher/Course/SendPlan');?>" class="btn btn-primary mb-2 mb-sm-0 text-white">+
                    ส่งงาน</a>
            </p>
        </div>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="">
    <div class="container-fluid">
        <?php if($OnOff[0]->seplanset_status == "on"):?>
            <div class="alert alert-success">
            <strong>แจ้งเตือน!</strong> ขณะนี้ระบบยังเปิดให้ส่งงานอยู่ <a
                href="<?=base_url('Teacher/Course/SendPlan');?>" class="alert-link">ส่งงาน</a>
        </div>
        <?php else: ?>
            <div class="alert alert-danger">
            <strong>แจ้งเตือน!</strong> ขณะนี้ระบบยังปิดไม่ให้ส่งงานแล้ว 
        </div>
        <?php endif; ?>
        
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ภาคเรียน</th>
                                <th>ปีการศึกษา</th>
                                <th>ประเภท</th>
                                <th>รหัสวิชา</th>
                                <th>ชื่อวิชา</th>
                                <th>วันที่ส่ง</th>
                                <th>ไฟล์</th>
                                <th>หน.กลุ่มสาระ</th>
                                <th>หน.งานพัฒนาหลักสูตร</th>
                                <th>คำสั่ง</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($plan as $key => $v_plan) : ?>
                            <tr id="<?=$v_plan->seplan_ID;?>">
                                <td><?=$v_plan->seplan_term;?></td>
                                <td><?=$v_plan->seplan_year;?></td>
                                <td><?=$v_plan->seplan_typeplan;?></td>
                                <td><?=$v_plan->seplan_coursecode;?></td>
                                <td><?=$v_plan->seplan_namesubject;?></td>
                                <td><?=$v_plan->seplan_createdate;?></td>
                                <td><a target="_blank"
                                        href="<?=base_url('uploads/academic/course/plan/').$v_plan->seplan_file;?>">เปิดดู</a>
                                </td>
                                <td class="text-center">
                                    <?php if($v_plan->seplan_status1 == "ผ่าน") : ?>
                                    <span class="badge badge-success h5 text-white"><?=$v_plan->seplan_status1;?>
                                    </span>
                                    <?php elseif($v_plan->seplan_status1 == "รอตรวจ") :?>
                                    <span class="badge badge-warning h5 text-white"><?=$v_plan->seplan_status1;?>
                                    </span>
                                    <?php else: ?>
                                    <span class="badge badge-danger h5 text-white"><?=$v_plan->seplan_status1;?>
                                    </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if($v_plan->seplan_status2 == "ผ่าน") : ?>
                                    <span class="badge badge-success h5 text-white"><?=$v_plan->seplan_status2;?>
                                    </span>
                                    <?php elseif($v_plan->seplan_status2 == "รอตรวจ") :?>
                                    <span class="badge badge-warning h5 text-white"><?=$v_plan->seplan_status2;?>
                                    </span>
                                    <?php else: ?>
                                    <span class="badge badge-danger h5 text-white"><?=$v_plan->seplan_status2;?>
                                    </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?=base_url('Teacher/Course/EditPlan/'.$v_plan->seplan_ID)?>"
                                        class="btn btn-warning btn-sm text-white">แก้ไข</a>
                                    <a href="#" class="btn btn-danger btn-sm text-white delete_plan">ลบ</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</section>