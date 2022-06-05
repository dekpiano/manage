<style>
.border-left-primary {
    border-left: .25rem solid #5BC3D5 !important;
}
</style>
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <h2 class="heading">จัดการข้อมูล<?=$title;?></h2>

        </div>
        <!--//container-->
        </section>
        <section class="we-offer-area text-center ">
            <div class="container-fluid">

                <div class="row theme-bg-light">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            เปิด - ปิดใช้งาน </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            ผลการเรียน
                                        </div>
                                    </div>
                                    <div class="col-auto">

                                        <!-- <input type="checkbox" id='checkOnOff'
                                            <?=$checkOnOff[0]->onoff_status == 'false' ? '' : 'checked';?>
                                            data-toggle="toggle" data-size="xs" data-style="ios">
                                        <div id="console-event"></div> -->

                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="checkOnOffRegister"
                                                name="checkOnOffRegister" value="<?=$checkOnOff[0]->onoff_status;?>"  <?=$checkOnOff[0]->onoff_status == 'false' ? '' : 'checked';?>>
                                            <label class="form-check-label" for="checkOnOffRegister"><?=$checkOnOff[0]->onoff_status;?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </section>

    </div>
    <!--//main-wrapper-->