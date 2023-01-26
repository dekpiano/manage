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
                    <h1 class="app-page-title mb-0">จัดการข้อมูล<?=$title;?></h1>
                </div>      
            </div>
            <hr>

            <section class="we-offer-area">
                <div class="app-card app-card-orders-table pt-2">
                    <div class="app-card-body">
                        <input type="text" name="schyear_year" id="schyear_year" value="<?=$SchoolYear->schyear_year?>" style="display:none;">
                        <div class="mt-2 d-flex align-items-center justify-content-center">
                            <label for="">เลือกดูปี</label>
                            <select class="form-select w-auto ms-2" id="CheckYearRegisRepeat" name="CheckYearRegisRepeat">
                                <?php foreach ($GroupYear as $key => $v_GroupYear) : ?>
                                <option <?=$SchoolYear->schyear_year == $v_GroupYear->SubjectYear ?"selected":""?> value="<?=$v_GroupYear->SubjectYear?>"><?=$v_GroupYear->SubjectYear?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="table-responsive  p-3">
                            <table class="table app-table-hover mb-0 text-left" id="tbRegisRepeatSubject">
                                <thead>
                                    <tr>
                                        <th class="cell">ปีการศึกษา</th>
                                        <th class="cell">รหัสวิชา</th>
                                        <th class="cell">ชื่อวิชา</th>
                                        <th class="cell">กลุ่มสาระ</th>
                                        <th class="cell">ชั้น</th>
                                        <th class="cell">ครูผู้สอน</th>
                                        <th class="cell">คำสั่ง</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                        <!--//table-responsive-->
                    </div>
                    <!--//app-card-body-->
                </div>


            </section>


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