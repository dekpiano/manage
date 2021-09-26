<style>
.switchToggle input[type=checkbox] {
    height: 0;
    width: 0;
    visibility: hidden;
    position: absolute;
}

.switchToggle label {
    cursor: pointer;
    text-indent: -9999px;
    width: 70px;
    max-width: 70px;
    height: 30px;
    background: #d1d1d1;
    display: block;
    border-radius: 100px;
    position: relative;
}

.switchToggle label:after {
    content: '';
    position: absolute;
    top: 2px;
    left: 2px;
    width: 26px;
    height: 26px;
    background: #fff;
    border-radius: 90px;
    transition: 0.3s;
}

.switchToggle input:checked+label,
.switchToggle input:checked+input+label {
    background: #3e98d3;
}

.switchToggle input+label:before,
.switchToggle input+input+label:before {
    content: 'ปิด';
    position: absolute;
    top: 5px;
    left: 35px;
    width: 26px;
    height: 26px;
    border-radius: 90px;
    transition: 0.3s;
    text-indent: 0;
    color: #fff;
}

.switchToggle input:checked+label:before,
.switchToggle input:checked+input+label:before {
    content: 'เปิด';
    position: absolute;
    top: 5px;
    left: 10px;
    width: 26px;
    height: 26px;
    border-radius: 90px;
    transition: 0.3s;
    text-indent: 0;
    color: #fff;
}

.switchToggle input:checked+label:after,
.switchToggle input:checked+input+label:after {
    left: calc(100% - 2px);
    transform: translateX(-100%);
}

.switchToggle label:active:after {
    width: 60px;
}

.toggle-switchArea {
    margin: 10px 0 10px 0;
}
</style>
<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <section class="cta-section theme-bg-light py-5">
                <div class="container text-center">

                    <h2 class="heading">จัดการข้อมูล<?=$title;?></h2>
                </div>
                <!--//container-->
            </section>
            <div class="container-xl">
                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-4">
                        <h3 class="section-title">แต่งตั้งหัวหน้างาน</h3>
                        <div class="section-intro">ให้เลือกหัวหน้างานหรือผู้ดูแลโครงการ</div>
                    </div>
                    <div class="col-12 col-md-8"> 
                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example"
                            id="homevisit_set_manager" name="homevisit_set_manager">
                            <option value="">กรุณาเลือกหัวหน้างาน</option>
                            <?php  foreach ($NameTeacher as $key => $v_NameTeacher) : ?>
                            <option <?=$Manager[0]->homevisit_set_manager == $v_NameTeacher->pers_id ? 'selected' : '';?>  value="<?=$v_NameTeacher->pers_id?>"><?=$v_NameTeacher->pers_prefix.$v_NameTeacher->pers_firstname." ".$v_NameTeacher->pers_lastname?></option>
                                <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <hr>
            
                <!-- <div class="row g-4 settings-section">
                    <div class="col-12 col-md-4">
                        <h3 class="section-title">จัดการ เปิด - ปิดระบบ</h3>
                        <div class="section-intro">ตั้งค่าการเปิดปิดระบบลงทะเบียนวิชาเพิ่มเติม</div>
                    </div>
                    <div class="col-12 col-md-8">
                        <form class="settings-form">
                            <div class=" mb-3">
                                <div class="switchToggle">
                                    <input type="checkbox" <?=$OnoffSystem[0]->extra_setting_onoff == 'false' ? '' : 'checked';?> id="extra_setting_onoff" name="extra_setting_onoff" value="เปิด">
                                    <label for="extra_setting_onoff">Toggle</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <hr> -->
                <!-- <div class="row g-4 settings-section">
                    <div class="col-12 col-md-4">
                        <h3 class="section-title">จัดการภาคเรียนและปีการศึกษา</h3>
                        <div class="section-intro">ตั้งค่าภาคเรียนและปีการศึกษาในแต่ละปี </div>
                        <div class="section-intro text-danger">(ไม่ควรเปลี่ยนแปลงข้อมูลในระหว่างที่เปิดระบบให้ลงทะเบียน อาจทำข้อมูลคาดเคลื่อน โปรดระวัง!) </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <form class="settings-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <select class="form-select form-select-lg mb-3"
                                        aria-label=".form-select-lg example" id="extra_setting_term" name="extra_setting_term">
                                        <?php for ($i=1; $i <=3 ; $i++) : ?>
                                        <option <?=$OnoffSystem[0]->extra_setting_term == $i ? 'selected' : '';?> value="<?=$i?>">ภาคเรียนที่ <?=$i?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select form-select-lg mb-3"
                                        aria-label=".form-select-lg example" id="extra_setting_year" name="extra_setting_year">
                                        <?php $d = date('Y')+543; ?>
                                        <?php for ($i=$d-1; $i < $d+2; $i++): ?>
                                        <option <?=$OnoffSystem[0]->extra_setting_year == $i ? 'selected' : '';?> value="<?=$i;?>"><?=$i;?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> -->
                <!-- <hr> -->
                <!-- <div class="row g-4 settings-section">
                    <div class="col-12 col-md-4">
                        <h3 class="section-title">จัดการวันและเวลา</h3>
                        <div class="section-intro">ตั้งค่าวันและเวลาที่จะเปิดปิดการลงทะเบียน</div>
                    </div>
                    <div class="col-12 col-md-8">
                        <form class="settings-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <input class="form-control form-control-lg" type="datetime-local"
                                        placeholder=".form-control-lg" aria-label=".form-control-lg example" id="extra_setting_datestart" name="extra_setting_datestart" value="<?=date('Y-m-d\TH:i', strtotime($OnoffSystem[0]->extra_setting_datestart));?>">
                                        
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control form-control-lg" type="datetime-local"
                                        placeholder=".form-control-lg" aria-label=".form-control-lg example" id="extra_setting_dateend" name="extra_setting_dateend" value="<?=date('Y-m-d\TH:i', strtotime($OnoffSystem[0]->extra_setting_dateend));?>">
                                </div>
                            </div>
                        </form>
                    </div>
                </div> -->

            </div>
        </div>




    </div>

</div>