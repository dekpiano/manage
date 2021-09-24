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
            <?php if($this->session->userdata('pers_learning') == $v_lean->lear_id || $this->session->userdata('login_id') == 'pers_014' || $this->session->userdata('login_id') == 'pers_002' || $this->session->userdata('login_id') == 'pers_003'): ?>
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
            <?php endif; endforeach; ?>

        </div>

        <?php if(isset($ID)) : ?>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tb_checkplan" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>ภาคเรียน</th>
                                <th>ปีการศึกษา</th>
                                <th style="width:100px;">ประเภท</th>
                                <th>รหัสวิชา</th>
                                <th style="width:100px;">ชื่อวิชา</th>
                                <th>ระดับชั้น</th>
                                <th style="width:100px;">ผู้ส่ง</th>
                                <th>วันที่ส่ง</th>
                                <th>ไฟล์</th>
                                <th>หมายเหตุ</th>
                                <th style="width:100px;">หน.กลุ่มสาระ</th>
                                <th style="width:100px;">หน.งานพัฒนาหลักสูตร</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($checkplan as $key => $v_checkplan):
                                $bg_alert = '';
                                if($v_checkplan->seplan_status1 == "ผ่าน" && $v_checkplan->seplan_status2 == "ผ่าน"){
                                    $bg_alert = "table-success";
                                }
                            ?>

                            <tr id="bgC<?=$v_checkplan->seplan_ID;?>" class="<?=$bg_alert;?>">
                                <td><?=$v_checkplan->seplan_term;?></td>
                                <td><?=$v_checkplan->seplan_year;?></td>
                                <td><?=$v_checkplan->seplan_typeplan;?></td>
                                <td><?=$v_checkplan->seplan_coursecode;?></td>
                                <td><?=$v_checkplan->seplan_namesubject;?></td>
                                <td>ม.<?=$v_checkplan->seplan_gradelevel;?></td>
                                <td><?=$v_checkplan->pers_prefix.$v_checkplan->pers_firstname.' '.$v_checkplan->pers_lastname;?>
                                </td>
                                <td><?=$this->datethai->thai_date_fullmonth(strtotime($v_checkplan->seplan_createdate));?>
                               </td>
                                <td><a target="_blank"
                                        href="<?=base_url('uploads/academic/course/plan/').$v_checkplan->seplan_file;?>">เปิดดู / ดาวน์โหลด</a>
                                </td>
                                <td><?=$v_checkplan->seplan_sendcomment;?></td>
                                <td>
                                    <select id="seplan_status1" name="seplan_status1"
                                        data-planId="<?=$v_checkplan->seplan_ID;?>"
                                        class="form-control mb-3 seplan_status1">
                                        <option <?=$v_checkplan->seplan_status1 == "รอตรวจ" ? 'selected' : ''?>
                                            value="รอตรวจ">รอตรวจ</option>
                                        <option <?=$v_checkplan->seplan_status1 == "ผ่าน" ? 'selected' : ''?>
                                            value="ผ่าน">ผ่าน</option>
                                        <option <?=$v_checkplan->seplan_status1 == "ไม่ผ่าน" ? 'selected' : ''?>
                                            value="ไม่ผ่าน">ไม่ผ่าน</option>
                                    </select>
                                    <div class="text-center TbShowComment1">
                                        <?=$v_checkplan->seplan_status1 == "ไม่ผ่าน" ? '<a href="#" class="show_comment1" data-toggle="modal" data-planId="'.$v_checkplan->seplan_ID.'" data-target="#addcomment1">หมายเหตุ</a>' : ''?>
                                    </div>

                                </td>

                                <td>
                                    <?php if($this->session->userdata('login_id') == 'pers_014'):?>
                                    <select id="seplan_status2" name="seplan_status2"
                                        planId="<?=$v_checkplan->seplan_ID;?>"
                                        class="form-control mb-3 seplan_status2">
                                        <option <?=$v_checkplan->seplan_status2 == "รอตรวจ" ? 'selected' : ''?>
                                            value="รอตรวจ">รอตรวจ</option>
                                        <option <?=$v_checkplan->seplan_status2 == "ผ่าน" ? 'selected' : ''?>
                                            value="ผ่าน">ผ่าน</option>
                                        <option <?=$v_checkplan->seplan_status2 == "ไม่ผ่าน" ? 'selected' : ''?>
                                            value="ไม่ผ่าน">ไม่ผ่าน</option>
                                    </select>
                                    <div class="text-center TbShowComment2">
                                        <?=$v_checkplan->seplan_status2 == "ไม่ผ่าน" ? '<a href="#" class="show_comment2" data-toggle="modal" data-planId="'.$v_checkplan->seplan_ID.'" data-target="#addcomment2">หมายเหตุ</a>' : ''?>
                                    </div>
                                    <?php else: echo $v_checkplan->seplan_status2; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>

    </div>
</section>

<div id="addcomment1" tabindex="-1" aria-labelledby="exampleModalLabel" class="modal fade text-left" aria-hidden="true"
    style="display: none;">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">

            <form id="form-comment1" class="form-comment1">
                    <div class="form-group">
                        <label for="seplan_comment1">หมายเหตุ:</label>
                        <textarea wrap="hard" class="form-control seplan_comment1" rows="5" name="seplan_comment1"
                            id="seplan_comment1"
                            placeholder="ไม่ผ่านเพราะ เช่น ปรับชื่อรายชื่อ หน้า 5 หรือ ลืมใส่ข้อมูลต้องกรอก"></textarea>
                    </div>
                    <div class="form-group">
                    <button type="button" id="sub_comment1" data-planId class="btn btn-primary">บันทึก</button>
                       
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div id="addcomment2" tabindex="-1" aria-labelledby="exampleModalLabel" class="modal fade text-left" aria-hidden="true"
    style="display: none;">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">

                <form id="form-comment2" class="form-comment2">
                    <div class="form-group">
                        <label for="seplan_comment2">หมายเหตุ:</label>
                        <textarea wrap="hard" class="form-control seplan_comment2" rows="5" name="seplan_comment2"
                            id="seplan_comment2"
                            placeholder="ไม่ผ่านเพราะ เช่น ปรับชื่อรายชื่อ หน้า 5 หรือ ลืมใส่ข้อมูลต้องกรอก"></textarea>
                    </div>
                    <div class="form-group">
                    <button type="button" id="sub_comment2" data-planId class="btn btn-primary">บันทึก</button>
                       
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>