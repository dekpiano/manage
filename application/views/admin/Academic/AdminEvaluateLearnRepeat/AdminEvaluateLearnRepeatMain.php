<style>
.border-left-primary {
    border-left: .25rem solid #5BC3D5 !important;
}
</style>
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl d-flex justify-content-between align-items-center">
            <div class="">
                <h2 class="heading">จัดการข้อมูล<?=$title;?></h2>
            </div>

            <div>
                <div class="d-flex  align-items-center">
                    <div>
                        สถานะ
                    </div>
                    <div class="ms-3">
                        <select name="CheckOnoffRepeat" id="CheckOnoffRepeat" class="form-select form-select-sm border <?=$checkOnOff[6]->onoff_status =="on" ?"border-success text-success":"border-danger text-danger" ?>">
                            <option <?=$checkOnOff[6]->onoff_status =="on" ?"selected":""?> value="on"> เปิดบันทึกคะแนนเรียนซ้ำ</option>
                            <option <?=$checkOnOff[6]->onoff_status =="off" ?"selected":""?> value="off">ปิดบันทึกคะแนนเรียนซ้ำ</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex  align-items-center mt-2">
                    <div>
                        ของปีการศึกษา
                    </div>
                    <div class="ms-3">
                        <select name="onoff_year" id="onoff_year" class="form-select form-select-sm">
                            <?php foreach ($CountYear as $key => $value) : ?>
                            <option <?=$this->uri->segment(5).'/'.$this->uri->segment(6) ==$value->RegisterYear ?"selected":"" ?>
                                value="<?=$value->RegisterYear?>"><?=$value->RegisterYear?></option>                               
                                <?php endforeach; ?>      
                                <option value="1/2567">1/2567</option>                    
                        </select>
                    </div>
                </div>

                <div class="d-flex  align-items-center mt-2">
                    <div>
                        เรียนซ้ำ
                    </div>
                    <div class="ms-3">
                        <select name="CheckTimeRepeat" id="CheckTimeRepeat" class="form-select form-select-sm">
                            <option <?=$checkOnOff[6]->onoff_detail =="เรียนซ้ำครั้งที่ 1" ?"selected":"" ?>
                                value="เรียนซ้ำครั้งที่ 1">ครั้งที่ 1</option>
                            <option <?=$checkOnOff[6]->onoff_detail =="เรียนซ้ำครั้งที่ 2" ?"selected":"" ?>
                                value="เรียนซ้ำครั้งที่ 2">ครั้งที่ 2</option>
                            <option <?=$checkOnOff[6]->onoff_detail =="เรียนซ้ำครั้งที่ 3" ?"selected":"" ?>
                                value="เรียนซ้ำครั้งที่ 3">ครั้งที่ 3</option>
                        </select>
                    </div>
                </div>


            </div>
        </div>
        <hr>
        <!--//container-->
        </section>
        <section class="we-offer-area mt-5">
            <div class="container-fluid">

                <div class="app-card  mb-5">
                    <div class="app-card-body p-3">
                        <div class="table-responsive">
                            <table class="table mb-0 text-left" id="Tb_Repeat">
                                <thead>
                                    <tr>
                                        <th class="cell">ปีการศึกษา</th>
                                        <th class="cell">รายวิชา</th>
                                        <th class="cell">ครูผู้สอน</th>
                                        <th class="cell">แก้ไขคะแนน (่เรียนซ้ำ)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($DataRepeat as $key => $v_result) : ?>
                                    <tr>
                                        <td class="cell"><?=$v_result->RegisterYear?></td>
                                        <td class="cell"><span
                                                class="truncate"><?=$v_result->SubjectCode.' '.$v_result->SubjectName?></span>
                                        </td>
                                        <td class="cell">
                                            <?=$v_result->pers_prefix.$v_result->pers_firstname.' '.$v_result->pers_lastname?>
                                        </td>
                                        <td class="cell">
                                            <a href="<?=base_url('Admin/Acade/Evaluate/AcademicRepeat/'.$v_result->RegisterYear.'/'.$v_result->SubjectID)?>"
                                                class="badge bg-warning">แก้ไข</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!--//table-responsive-->
                    </div>
                    <!--//app-card-body-->
                </div>


            </div>
        </section>

    </div>
    <!--//main-wrapper-->