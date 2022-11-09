<style>
.border-left-primary {
    border-left: .25rem solid #5BC3D5 !important;
}
</style>
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title">จัดการข้อมูล<?=$title;?></h1>
            <hr class="mb-4">
        </div>
        <!--//container-->
        </section>
        <section class="we-offer-area">
            <div class="container-fluid">

                <div class="row g-4 settings-section mb-3">
                    <div class="col-12 col-md-4">
                        <h3 class="section-title">เปิด - ปิด ระบบการบันทึกคะแนน</h3>
                        <div class="section-intro">สำหรับเปิด หรือ ปิด ช่วงเวลาการกรอกคะแนนในแต่ละช่วง</div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="app-card app-card-settings shadow-sm p-4">
                            <div class="app-card-body">
                                <form class="settings-form">
                                    <?php foreach ($OnOffSaveScoreSystem as $key => $v_OnOffSaveScore) : ?>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input onoff_savescore" type="checkbox"
                                            id="settings-switch-1" onoff-id="<?=$v_OnOffSaveScore->onoff_id?>"
                                            name="onoff_name" value="<?=$v_OnOffSaveScore->onoff_status?>"
                                            <?=$v_OnOffSaveScore->onoff_status == "on"?"checked":""?>>
                                        <label class="form-check-label" for="settings-switch-1">
                                            <?=$v_OnOffSaveScore->onoff_status == "off" ?"ระบบปิดอยู่":"ระบบเปิดอยู่"?>
                                        </label>
                                    </div>
                                    <?php endforeach; ?>

                                </form>
                            </div>
                            <!--//app-card-body-->
                        </div>
                        <!--//app-card-->
                    </div>
                </div>


                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-4">
                        <h3 class="section-title">เปิด - ปิด การลงคะแนน</h3>
                        <div class="section-intro">สำหรับเปิด หรือ ปิด ช่วงเวลาการกรอกคะแนนในแต่ละช่วง</div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="app-card app-card-settings shadow-sm p-4">
                            <div class="app-card-body">
                                <form class="settings-form">
                                    <?php foreach ($OnOffSaveScore as $key => $v_OnOffSaveScore) : ?>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input onoff_savescore" type="checkbox"
                                            id="settings-switch-1" onoff-id="<?=$v_OnOffSaveScore->onoff_id?>"
                                            name="onoff_name" value="<?=$v_OnOffSaveScore->onoff_status?>"
                                            <?=$v_OnOffSaveScore->onoff_status == "on"?"checked":""?>>
                                        <label class="form-check-label"
                                            for="settings-switch-1"><?=$v_OnOffSaveScore->onoff_name?></label>
                                    </div>
                                    <?php endforeach; ?>

                                </form>
                            </div>
                            <!--//app-card-body-->
                        </div>
                        <!--//app-card-->
                    </div>
                </div>

            </div>
        </section>


        <!--//app-card-body-->
    </div>

</div>
<!--//main-wrapper-->