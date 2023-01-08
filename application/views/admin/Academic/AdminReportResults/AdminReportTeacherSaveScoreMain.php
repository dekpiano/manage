<style>
.border-left-primary {
    border-left: .25rem solid #5BC3D5 !important;
}
</style>
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl d-flex justify-content-between">
            <div class="col-auto justify-content-start">
                <h1 class="app-page-title"><?=$title;?></h1>
            </div>
            <div class="col-auto justify-content-md-end">
                <div class="page-utilities">
                    <div class="row g-2  ">
                        <div class="col-auto">
                            <form action="#" method="post" class="d-flex align-items-center">
                                <label for="">เลือกปีการศึกษา</label>
                                <select class="form-select w-auto ms-2" name="CheckYearSaveScore" id="CheckYearSaveScore">
                                    <?php foreach ($CheckYearSaveScore as $key => $value) : ?>
                                    <option <?=$Term.'/'.$Year == $value->RegisterYear ?"selected":""?> value="<?=$value->RegisterYear?>"><?=$value->RegisterYear?></option>
                                    <?php endforeach; ?>
                                </select>
                            </form>
                        </div>                  
                    </div>
                    <!--//row-->
                </div>
                <!--//table-utilities-->
            </div>
        </div>
        <!--//container-->
        </section>
        <section class="we-offer-area">
            <div class="container-fluid">

                <div class="card">
                    <div class="card-body">
                        <table class="table app-table-hover mb-0 text-left ShowStudent" id="">
                            <thead>
                                <tr>
                                    <th class="cell">ภาคเรียน</th>
                                    <th class="cell">กลุ่มสาระ</th>
                                    <th class="cell">ชื่อ - นามสกุล</th>
                                    <th class="cell">ตำแหน่ง</th>
                                    <th class="cell">คำสั่ง</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($Teacher as $key => $v_Teacher) : ?>
                                <tr>
                                    <td class="cell"><?=$Term.'/'.$Year?></td>
                                    <td class="cell"><?=$v_Teacher->lear_namethai?></td>
                                    <td class="cell">
                                        <?=$v_Teacher->pers_prefix.$v_Teacher->pers_firstname.' '.$v_Teacher->pers_lastname?>
                                    </td>
                                    <td class="cell"><?=$v_Teacher->posi_name?></td>

                                    <td class="cell">
                                        <a class="btn-sm btn-primary clickLoad-spin"
                                            href="<?=base_url('Admin/Acade/Evaluate/ReportTeacherSaveScoreCheck/'.$Term.'/'.$Year.'/'.$v_Teacher->pers_id);?>">
                                            <i class="bi bi-eye-fill"></i> ดูผลการบันทึกคนแนน
                                        </a>

                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

    </div>
    </section>

</div>
<!--//main-wrapper-->