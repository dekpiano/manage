<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <!-- <h1 class="app-page-title">Overview</h1> -->

            <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                <div class="inner">
                    <div class="app-card-body p-3 p-lg-4">
                        <h3 class="mb-3">คำแนะนำและข้อตกลงในการลงทะเบียนวิชาเลือกเพิ่มเติม</h3>
                        <div class="row gx-5 gy-3">
                            <div class="col-12 col-lg-9">
                                <div>ในการเลือกรายวิชาเพิ่มเติม ขอให้นักเรียนเลือกเรียนตามที่นักเรียนถนัด หรือ
                                    ตามความสนใจของนักเรียนจริงๆ<br>ไม่แนะนำให้นักเรียนเลือกเรียนตามเพื่อน
                                    เนื่องจากอาจจะมีผลต่อผลการเรียนของนักเรียน</div>
                            </div>
                            <div class="app-card-body">
                                <div class="mb-2">
                                    1.ตรวจสอบรายวิชาเพิ่มเติมที่เปิดลงทะเบียนได้ที่เมนู
                                    <strong>"รายชื่อวิชาเลือกเพิ่มเติม"
                                    </strong>เพื่อพิจารณาเลือกวิชาเพิ่มเติมที่สนใจ

                                </div>
                                <div class="mb-2">
                                    2.เมื่อนักเรียนเลือกได้แล้ว ให้คลิกปุ่ม <strong>"ลงทะเบียน"</strong>
                                    เมื่ออ่านละเอียดครบถ้วนแล้ว ให้คลิกปุ่ม <strong>"ยืนยันการลงทะเบียน"</strong>
                                </div>
                                <div class="mb-2">
                                    3.เมื่อนักเรียนสามารถดูสมาชิกในรายวิชาแต่ละวิชาได้ ให้คลิกปุ่ม
                                    <strong>"รายชื่อสมาชิก"</strong>
                                </div>
                                <div class="mb-2">
                                    4. นักเรียนสามารถลงทะเบียนวิชาเพิ่มเติมทางอินเตอร์เน็ตได้เพียง <strong> 1
                                        ครั้งเท่านั้น </strong>เมื่อยืนยันข้อมูลแล้วจะ
                                    <strong><u>ไม่สามารถแก้ไขข้อมูลการลงทะเบียนได้</u></strong> ดังนั้น
                                    ขอให้นักเรียนพิจารณาเลือกวิชาเพิ่มเติมที่ต้องการเรียนจริง ๆ ก่อนการลงทะเบียน
                                </div>
                                <div class="mb-2">
                                    5. เมื่อนักเรียนมีปัญหาในการใช้งาน ติดต่องานฝ่าย  <strong>วิชาการ </strong> อาคาร 4 ชั้น 1
                                </div>
                            </div>
                            <!--//col-->
                        </div>
                        <!--//row-->
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <!--//app-card-body-->
                </div>
                <!--//inner-->
            </div>

            <div class="row g-4 mb-4">
                <div class="col-6 col-lg-3">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">สถานะระบบ</h4>
                            <div class="stats-figure">
                            <?php if($ExtraSetting[0]->extra_setting_onoff === 'true'){
                                $status = '';
                                $color = 'primary';
                                echo $onoff = "เปิดลงทะเบียน";
                            }else{
                                $status = 'style="pointer-events: none;"';
                                $color = 'danger';
                                echo $onoff = "ปิดลงทะเบียน";
                            } ?>
                            </div>
                        </div>
                        <!--//app-card-body-->
                        <a class="app-card-link-mask" href="#"></a>
                    </div>
                    <!--//app-card-->
                </div>

                <div class="col-6 col-lg-3">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">ภาคเรียนที่</h4>
                            <div class="stats-figure"><?=$ExtraSetting[0]->extra_setting_term?>/<?=$ExtraSetting[0]->extra_setting_year?></div>
                        </div>
                        <!--//app-card-body-->
                        <a class="app-card-link-mask" href="#"></a>
                    </div>
                    <!--//app-card-->
                </div>

                <div class="col-6 col-lg-3">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">เริ่มลงทะเบียน</h4>
                            <div class="stats-figure"><?=$this->datethai->thai_date_and_time(strtotime($ExtraSetting[0]->extra_setting_datestart))?></div>
                        </div>
                        <!--//app-card-body-->
                        <a class="app-card-link-mask" href="#"></a>
                    </div>
                    <!--//app-card-->
                </div>

                <div class="col-6 col-lg-3">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">สิ้นสุดลงทะเบียน</h4>
                            <div class="stats-figure "><?=$this->datethai->thai_date_and_time(strtotime($ExtraSetting[0]->extra_setting_dateend))?></div>
                        </div>
                        <!--//app-card-body-->
                        <a class="app-card-link-mask" href="#"></a>
                    </div>
                    <!--//app-card-->
                </div>
            </div>
            <div class="d-flex justify-content-center pb-3">
                <a <?=$status?> class="btn btn-<?=$color;?>" href="<?=base_url('Student/Extra/Subject');?>">
                    <span class="h2 text-white"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                        </svg> <?=$onoff;?></span>
                </a>
            </div>

        </div><!--//container-fluid-->
    </div>
</div>
<!--//app-wrapper-->