<style>
.border-left-primary {
    border-left: .25rem solid #5BC3D5 !important;
}

.toolbar {
    float: left;
}

.dataTables_length {
    float: left;
}
</style>
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">จัดการข้อมูล<?=$title;?>
                        <?=@$DataRepeat[0]->SubjectCode.' '.@$DataRepeat[0]->SubjectName?></h1>
                </div>
            </div>
            <hr>
            <?php if($DataRepeat) :?>
            <section class="we-offer-area">
                <div class="app-card app-card-orders-table pt-2">
                    <div class="app-card-body">
                        <div class="table-responsive  p-3">
                            <form id="FormRegisRepeatUpdate" method="post">
                                <div class="row justify-content-center mb-4">
                                    <div class="col-md-6 d-flex align-items-center">
                                        <div class="w-25">ครูสอน</div>
                                        <div>
                                        <select name="RepeatTeacher" id="RepeatTeacher" class="form-select">
                                            <option value="">เลือกครูสอน...</option>
                                            <?php foreach ($Teacher as $key => $v_Teache):?>
                                                <option <?=$DataRepeat[0]->TeacherID==$v_Teache->pers_id?"selected":""?> value="<?=$v_Teache->pers_id?>"><?=$v_Teache->pers_prefix.$v_Teache->pers_firstname.' '.$v_Teache->pers_lastname?></option>
                                                <?php endforeach;?>
                                        </select>
                                        <br>                                       
                                        <small>เลือกครูผู้สอนใหม่กรณีที่ไม่ใช่ครูคนเก่า</small>
                                        </div>
                                        
                                    </div>                                    
                                </div>
                                <hr>

                                <input type="text" name="YearRepeat" value="<?=$DataRepeat[0]->RegisterYear?>"
                                    style="display:none;">
                                <input type="text" name="SubjectRepeat" value="<?=$DataRepeat[0]->SubjectCode?>"
                                    style="display:none;">
                                <table class="table app-table-hover mb-0 text-left" id="">
                                    <thead>
                                        <tr class="text-center">
                                            <th>เลือกที่เรียนซ้ำ</th>
                                            <th>เรียนปี</th>
                                            <th>ห้อง</th>
                                            <th>เลขที่</th>
                                            <th>รหัสประจำตัว</th>
                                            <th>ชื่อนักเรียน</th>
                                            <th>คะแนน</th>
                                            <th>ผลการเรียน</th>
                                            <th>สถานะเรียนซ้ำ</th>
                                            <th>สถานะ นร</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($DataRepeat as $key => $v_DataRepeat) : ?>
                                        <tr
                                            class="<?=$v_DataRepeat->Grade == "มส" ||  $v_DataRepeat->Grade <= 0?"table-danger":""?>">
                                            <td class="text-center">
                                                <input type="checkbox" name="SelRepeat[]" id="SelRepeat"
                                                    value="<?=$v_DataRepeat->StudentID?>" class="form-check-input"
                                                    <?=($v_DataRepeat->Grade_Type != "" && $v_DataRepeat->RepeatStatus == "ไม่ผ่าน"?"checked":"")?>>
                                            </td>
                                            <td class="text-center"><?=$v_DataRepeat->RegisterYear?></td>
                                            <td class="text-center"><?=$v_DataRepeat->StudentClass?></td>
                                            <td class="text-center"><?=$v_DataRepeat->StudentNumber?></td>
                                            <td class="text-center"><?=$v_DataRepeat->StudentCode?></td>
                                            <td class="text-left">
                                                <?=$v_DataRepeat->StudentPrefix.$v_DataRepeat->StudentFirstName.' '.$v_DataRepeat->StudentLastName?>
                                            </td>
                                            <td class="text-center">
                                                <?=$v_DataRepeat->Grade?></td>
                                            <td class="text-center">
                                                <?=$v_DataRepeat->Grade_Type == "" ?"เรียนปกติ":$v_DataRepeat->Grade_Type.' ('.$v_DataRepeat->RepeatYear.')'?>
                                            </td>
                                            <td class="text-center"><?=$v_DataRepeat->RepeatStatus;?>  <?=$v_DataRepeat->RepeatStatus == "ผ่าน" ? '('.$v_DataRepeat->RepeatYear.')':""?></td>
                                            <td class="text-center"><?=$v_DataRepeat->StudentBehavior;?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>

                                </table>
                                <div class="mt-3 text-center">
                                    <button class="btn app-btn-primary">บันทึก</button>
                                </div>
                            </form>

                        </div>
                        <!--//table-responsive-->
                    </div>
                    <!--//app-card-body-->
                </div>


            </section>
            <?php else :  ?>
            <div class="app-card shadow-sm mb-4 border-left-decoration">
                <div class="inner">
                    <div class="app-card-body p-4">
                        <div class="row gx-5 gy-3">
                            <div class="col-12 col-lg-9">

                                <div>
                                    <h3>ยังไม่มีข้อมูลการลงทะเบียนเรียน</h3>
                                </div>
                            </div>
                            <!--//col-->
                            <div class="col-12 col-lg-3">
                                <a class="btn app-btn-primary"
                                    href="<?=base_url('Admin/Acade/Registration/Repeat')?>">ย้อนกลับ</a>
                            </div>
                            <!--//col-->
                        </div>
                        <!--//row-->

                    </div>
                    <!--//app-card-body-->

                </div>
                <!--//inner-->
            </div>

            <?php endif; ?>

            <!--//row-->
        </div>



    </div>
    <!--//main-wrapper-->


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ShowSubjectName" id="staticBackdropLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover" id="tb_ShowRegisRepeat">
                        <thead>
                            <tr>
                                <th scope="col">ห้อง</th>
                                <th scope="col">เลขที่</th>
                                <th scope="col">เลขประจำตัว</th>
                                <th scope="col">ชื่อ - นามสกุล</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>

                </div>
            </div>
        </div>
    </div>