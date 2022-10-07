<style>
.border-left-primary {
    border-left: .25rem solid #5BC3D5 !important;
}
</style>
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">


        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0"><?=$title;?></h1>
            </div>
            <div class="col-auto">
                <a class="btn app-btn-primary" id="BtnAddPersonnel" href="#">
                    + เพิ่มบุคลากร
                </a>
            </div>
        </div>

        <section class="we-offer-area">

            <div class="app-card app-card-orders-table shadow-sm mb-5">
                <div class="app-card-body p-2">
                    <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left" id="TbPersonnelMain">
                            <thead>
                                <tr>
                                    <th class="cell">ชื่อ - นามสกุล</th>
                                    <th class="cell">กลุ่มสาระ</th>
                                    <th class="cell">ตำแหน่ง</th>
                                    <th class="cell">สถานะ</th>
                                    <th class="cell">คำสั่ง</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
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


<style>
.ss-main .ss-single-selected {
    height: 40px;
}
</style>
<!-- Modal -->
<div class="modal fade" id="ModalEditTech" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">ข้อมูลบุคลากร</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate="" id="form-personnal">
                    <div class="row g-3">
                        <div class="col-md-9">
                            <label for="pers_status" class="form-label">สถานะผู้ใช้งาน</label>
                            <select class="select2_pres" id="pers_status" name="pers_status" required="">
                                <option value="กำลังใช้งาน">กำลังใช้งาน</option>
                                <option value="ย้ายสถานศึกษา">ย้ายสถานศึกษา</option>
                                <option value="ลาออก">ลาออก</option>
                                <option value="เกษียรอายุ">เกษียรอายุ</option>
                            </select>
                            <div class="invalid-feedback">
                                กรุณากรอกเลือกสถานะผู้ใช้งาน
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="pers_id" class="form-label">รหัสประจำตัว</label>
                            <input type="text" class="form-control" id="pers_id" name="pers_id" placeholder="" value="<?=$pers_id;?>"
                                required="" readonly>
                            <div class="invalid-feedback">
                                กรุณากรอกชื่อจริง...
                            </div>
                        </div>
                        <hr>
                    </div>


                    <div class="row g-3 mb-3 justify-content-center">
                        <div class="col-md-4">
                            <label for="pers_img" class="form-label">รูปภาพ</label>
                            <img src="<?=base_url('uploads/usericon.png');?>" alt="" class="img-fluid" id="ShowImgPresol">
                            <input type="file" class="form-control" id="pers_img" name="pers_img" placeholder="" onchange="document.getElementById('ShowImgPresol').src = window.URL.createObjectURL(this.files[0])">

                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="pers_prefix" class="form-label">คำนำหน้า</label>
                            <select class="select2_pres" id="pers_prefix" name="pers_prefix" required="">
                                <option value="">เลือก...</option>
                                <option value="นาย">นาย</option>
                                <option value="นาง">นาง</option>
                                <option value="นางสาว">นางสาว</option>
                                <option value="ว่าที่ร้อยตรี">ว่าที่ร้อยตรี</option>
                                <option value="ว่าที่ร้อยตรีหญิง">ว่าที่ร้อยตรีหญิง</option>
                            </select>
                            <div class="invalid-feedback">
                                กรุณากรอกเลือกคำนำหน้า
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="pers_firstname" class="form-label">ชื่อจริง</label>
                            <input type="text" class="form-control" id="pers_firstname" name="pers_firstname"
                                placeholder="" value="" required="">
                            <div class="invalid-feedback">
                                กรุณากรอกชื่อจริง...
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="pers_lastname" class="form-label">นามสกุล</label>
                            <input type="text" class="form-control" id="pers_lastname" name="pers_lastname"
                                placeholder="" value="" required="">
                            <div class="invalid-feedback">
                                กรุณากรอกนามสกุล...
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="pers_britday" class="form-label">วันเกิด</label>
                            <input type="text" class="form-control" id="pers_britday" name="pers_britday" placeholder=""
                                value="" autocomplete="off">
                            <div class="invalid-feedback">
                                กรุณาเลือกวันเกิด
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="pers_phone" class="form-label">เบอร์โทรศัพท์</label>
                            <input type="tel" class="form-control" id="pers_phone" name="pers_phone" placeholder=""
                                value="">
                            <div class="invalid-feedback">
                                กรุณากรอกเบอร์โทรศัพท์...
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="pers_address" class="form-label">ที่อยู่ติดต่อได้</label>
                            <textarea class="form-control" id="pers_address" name="pers_address" rows="5"></textarea>
                            <div class="invalid-feedback">
                                กรุณากรอกที่อยู่
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="pers_username" class="form-label">Email <span
                                    class="text-muted">(Optional)</span></label>
                            <input type="email" class="form-control" id="pers_username" placeholder="you@example.com"
                                name="pers_username">
                            <div class="invalid-feedback">
                                กรุณากรอกอีเมล
                            </div>
                        </div>

                        <hr>

                        <div class="col-md-4">
                            <label for="pers_position" class="form-label">ตำแหน่งทางการศึกษา</label>
                            <select class="select2_pres" id="pers_position" name="pers_position" required="">
                                <option value="">เลือก...</option>
                                <?php foreach ($this->settingpresonnal->GroupPosition() as $key => $value) : ?>
                                <option value="<?=$value;?>"><?=$value;?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                กรุณาเลือกตำแหน่งทางการศึกษา
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="pers_learning" class="form-label">กลุ่มสาระการเรียนรู้</label>
                            <select class="select2_pres" id="pers_learning" name="pers_learning">
                                <option value="">ไม่มีไม่ต้องเลือก...</option>
                                <?php foreach ($this->settingpresonnal->GroupSaraMain() as $key => $value) : ?>
                                <option value="<?=$value;?>"><?=$value;?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                กรุณาเลือกกลุ่มสาระการเรียนรู้
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="pers_academic" class="form-label">วิทยฐานะ</label>
                            <select class="select2_pres" id="pers_academic" name="pers_academic">
                                <option value="">ไม่มีไม่ต้องเลือก...</option>
                                <?php foreach ($this->settingpresonnal->GroupAcademic() as $key => $value) : ?>
                                <option value="<?=$value;?>"><?=$value;?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="pers_groupleade" class="form-label">หัวหน้าและรองหัวหน้ากลุ่มสาระ</label>
                            <select class="select2_pres" id="pers_groupleade" name="pers_groupleade">
                                <option value="">ไม่มีไม่ต้องเลือก...</option>
                                <option value="หัวหน้ากลุ่มสาระ">หัวหน้ากลุ่มสาระ</option>
                                <option value="รองหัวหน้ากลุ่มสาระ">รองหัวหน้ากลุ่มสาระ</option>
                            </select>
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <button class="w-100 btn btn-primary btn-lg" type="submit">บันทึก</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>