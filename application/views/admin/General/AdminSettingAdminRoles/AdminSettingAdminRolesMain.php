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

.ss-main .ss-single-selected{
  height:50px;
  padding-left: 12px;
    font-size: 1.2rem;
}

</style>
<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <section class="cta-section theme-bg-light py-5">
                <div class="container text-center">

                    <h2 class="heading">จัดการข้อมูลบทบาทใน<?=$title;?></h2>
                </div>
                <!--//container-->
            </section>
            <div class="container-xl">
                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-4">
                        <h3 class="section-title">ผู้อำนวยการ</h3>
                    </div>
                    <div class="col-12 col-md-8">
                        <select class="mb-3" aria-label=".form-select-lg example"
                            id="set_General_executive" name="set_General_executive">
                            <option value="">กรุณาเลือกหัวหน้างาน</option>
                            <?php  foreach ($NameTeacher as $key => $v_NameTeacher) : ?>
                            <option
                                <?=$Manager[0]->admin_rloes_userid == $v_NameTeacher->pers_id ? 'selected' : '';?>
                                value="<?=$v_NameTeacher->pers_id?>">
                                <?=$v_NameTeacher->pers_prefix.$v_NameTeacher->pers_firstname." ".$v_NameTeacher->pers_lastname?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <hr>

                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-4">
                        <h3 class="section-title">รองผู้อำนวยการ<?=$title;?></h3>                      
                    </div>
                    <div class="col-12 col-md-8">
                        <select class="mb-3" aria-label=".form-select-lg example"
                            id="set_General_deputy" name="set_General_deputy">
                            <option value="">กรุณาเลือกหัวหน้างาน</option>
                            <?php  foreach ($NameTeacher as $key => $v_NameTeacher) : ?>
                            <option
                                <?=$Manager[1]->admin_rloes_userid == $v_NameTeacher->pers_id ? 'selected' : '';?>
                                value="<?=$v_NameTeacher->pers_id?>">
                                <?=$v_NameTeacher->pers_prefix.$v_NameTeacher->pers_firstname." ".$v_NameTeacher->pers_lastname?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <hr>

                
                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-4">
                        <h3 class="section-title">หัวหน้างาน<?=$title;?></h3>                      
                    </div>
                    <div class="col-12 col-md-8">
                        <select class="mb-3" aria-label=".form-select-lg example"
                            id="set_General_leader" name="set_General_leader">
                            <option value="">กรุณาเลือกหัวหน้างาน</option>
                            <?php  foreach ($NameTeacher as $key => $v_NameTeacher) : ?>
                            <option
                                <?=$Manager[2]->admin_rloes_userid == $v_NameTeacher->pers_id ? 'selected' : '';?>
                                value="<?=$v_NameTeacher->pers_id?>">
                                <?=$v_NameTeacher->pers_prefix.$v_NameTeacher->pers_firstname." ".$v_NameTeacher->pers_lastname?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <hr>

                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-4">
                        <h3 class="section-title">เจ้าหน้าที่<?=$title;?></h3>                      
                    </div>
                    <div class="col-12 col-md-8">
                        <select class="mb-3 set_General_admin" aria-label=".form-select-lg example"
                            id="set_General_adminone" name="set_General_admin" admin-id="<?=$Manager[3]->admin_rloes_id;?>">
                            <option value="">กรุณาเลือกหัวหน้างาน</option>
                            <?php  foreach ($NameTeacher as $key => $v_NameTeacher) : ?>
                            <option
                                <?=$Manager[3]->admin_rloes_userid == $v_NameTeacher->pers_id ? 'selected' : '';?>
                                value="<?=$v_NameTeacher->pers_id?>">
                                <?=$v_NameTeacher->pers_prefix.$v_NameTeacher->pers_firstname." ".$v_NameTeacher->pers_lastname?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-4">
                        <h3 class="section-title">เจ้าหน้าที่<?=$title;?></h3>                      
                    </div>
                    <div class="col-12 col-md-8">
                        <select class="mb-3 set_General_admin" aria-label=".form-select-lg example"
                            id="set_General_admintwo" name="set_General_admin" admin-id="<?=$Manager[4]->admin_rloes_id;?>">
                            <option value="">กรุณาเลือกหัวหน้างาน</option>
                            <?php  foreach ($NameTeacher as $key => $v_NameTeacher) : ?>
                            <option
                                <?=$Manager[4]->admin_rloes_userid == $v_NameTeacher->pers_id ? 'selected' : '';?>
                                value="<?=$v_NameTeacher->pers_id?>">
                                <?=$v_NameTeacher->pers_prefix.$v_NameTeacher->pers_firstname." ".$v_NameTeacher->pers_lastname?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-4">
                        <h3 class="section-title">เจ้าหน้าที่<?=$title;?></h3>                      
                    </div>
                    <div class="col-12 col-md-8">
                        <select class="mb-3 set_General_admin" aria-label=".form-select-lg example"
                            id="set_General_admintheer" name="set_General_admin" admin-id="<?=$Manager[5]->admin_rloes_id;?>">
                            <option value="">กรุณาเลือกหัวหน้างาน</option>
                            <?php  foreach ($NameTeacher as $key => $v_NameTeacher) : ?>
                            <option
                                <?=$Manager[5]->admin_rloes_userid == $v_NameTeacher->pers_id ? 'selected' : '';?>
                                value="<?=$v_NameTeacher->pers_id?>">
                                <?=$v_NameTeacher->pers_prefix.$v_NameTeacher->pers_firstname." ".$v_NameTeacher->pers_lastname?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-4">
                        <h3 class="section-title">เจ้าหน้าที่<?=$title;?></h3>                      
                    </div>
                    <div class="col-12 col-md-8">
                        <select class="mb-3 set_General_admin" aria-label=".form-select-lg example"
                            id="set_General_adminfour" name="set_General_admin" admin-id="<?=$Manager[6]->admin_rloes_id;?>">
                            <option value="">กรุณาเลือกหัวหน้างาน</option>
                            <?php  foreach ($NameTeacher as $key => $v_NameTeacher) : ?>
                            <option
                                <?=$Manager[6]->admin_rloes_userid == $v_NameTeacher->pers_id ? 'selected' : '';?>
                                value="<?=$v_NameTeacher->pers_id?>">
                                <?=$v_NameTeacher->pers_prefix.$v_NameTeacher->pers_firstname." ".$v_NameTeacher->pers_lastname?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-4">
                        <h3 class="section-title">เจ้าหน้าที่<?=$title;?></h3>                      
                    </div>
                    <div class="col-12 col-md-8">
                        <select class="mb-3 set_General_admin" aria-label=".form-select-lg example"
                            id="set_General_adminfive" name="set_General_admin" admin-id="<?=$Manager[7]->admin_rloes_id;?>">
                            <option value="">กรุณาเลือกหัวหน้างาน</option>
                            <?php  foreach ($NameTeacher as $key => $v_NameTeacher) : ?>
                            <option
                                <?=$Manager[7]->admin_rloes_userid == $v_NameTeacher->pers_id ? 'selected' : '';?>
                                value="<?=$v_NameTeacher->pers_id?>">
                                <?=$v_NameTeacher->pers_prefix.$v_NameTeacher->pers_firstname." ".$v_NameTeacher->pers_lastname?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-4">
                        <h3 class="section-title">เจ้าหน้าที่<?=$title;?></h3>                      
                    </div>
                    <div class="col-12 col-md-8">
                        <select class="mb-3 set_General_admin" aria-label=".form-select-lg example"
                            id="set_General_adminsix" name="set_General_admin" admin-id="<?=$Manager[8]->admin_rloes_id;?>">
                            <option value="">กรุณาเลือกหัวหน้างาน</option>
                            <?php  foreach ($NameTeacher as $key => $v_NameTeacher) : ?>
                            <option
                                <?=$Manager[8]->admin_rloes_userid == $v_NameTeacher->pers_id ? 'selected' : '';?>
                                value="<?=$v_NameTeacher->pers_id?>">
                                <?=$v_NameTeacher->pers_prefix.$v_NameTeacher->pers_firstname." ".$v_NameTeacher->pers_lastname?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <hr>

            </div>
        </div>




    </div>

</div>