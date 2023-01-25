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
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">

                            </div>
                            <div class="col-auto">
                                <a class="btn app-btn-primary"
                                    href="<?=base_url('Admin/Acade/Registration/Enroll/Add/').$SchoolYear->schyear_year?>">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download mr-1"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z">
                                        </path>
                                        <path fill-rule="evenodd"
                                            d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z">
                                        </path>
                                    </svg>
                                    ลงทะเบียนเรียน
                                </a>
                            </div>
                        </div>
                        <!--//row-->
                    </div>
                    <!--//table-utilities-->
                </div>
                <!--//col-auto-->
            </div>
            <hr>

            <section class="we-offer-area">
                <div class="app-card app-card-orders-table pt-2">
                    <div class="app-card-body">
                        <input type="text" name="schyear_year" id="schyear_year" value="<?=$SchoolYear->schyear_year?>" style="display:none;">
                        <div class="mt-2 d-flex align-items-center justify-content-center">
                            <label for="">เลือกดูปี</label>
                            <select class="form-select w-auto ms-2" id="CheckYearEnroll" name="CheckYearEnroll">
                                <?php foreach ($GroupYear as $key => $v_GroupYear) : ?>
                                <option <?=$SchoolYear->schyear_year == $v_GroupYear->SubjectYear ?"selected":""?> value="<?=$v_GroupYear->SubjectYear?>"><?=$v_GroupYear->SubjectYear?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="table-responsive  p-3">
                            <table class="table app-table-hover mb-0 text-left" id="tbErollSubject">
                                <thead>
                                    <tr>
                                        <th class="cell">ปีการศึกษา</th>
                                        <th class="cell">รหัสวิชา</th>
                                        <th class="cell">ชื่อวิชา</th>
                                        <th class="cell">กลุ่มสาระ</th>
                                        <th class="cell">ชั้น</th>
                                        <th class="cell">ครูผู้สอน</th>
                                        <th class="cell">นักเรียน</th>
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
                    <table class="table table-hover" id="tb_ShowEnroll">
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