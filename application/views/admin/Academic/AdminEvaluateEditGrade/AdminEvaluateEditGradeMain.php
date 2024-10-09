<style>
.border-left-primary {
    border-left: .25rem solid #5BC3D5 !important;
}
</style>
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl d-flex align-items-center justify-content-between">
            <h1 class="app-page-title">จัดการข้อมูล<?=$title;?></h1>
            <div class="d-flex  align-items-center mt-2">
                    <div>
                        ปีการศึกษา
                    </div>
                    <div class="ms-3">
                        <select name="onoff_year" id="onoff_year" class="form-select form-select-sm">
                            <?php foreach ($CheckYearRegis as $key => $value) : ?>
                            <option <?=$this->uri->segment(5).'/'.$this->uri->segment(6) ==$value->RegisterYear ?"selected":"" ?>
                                value="<?=$value->RegisterYear?>"><?=$value->RegisterYear?></option>  
                                <?php endforeach; ?>                          
                        </select>
                    </div>
                </div>
        </div>
        <hr class="mb-4">

        <div class="app-card  mt-5">
            <div class="app-card-body p-3">
                <div class="table-responsive">
                    <table class="table mb-0 text-left" id="Tb_Repeat">
                        <thead>
                            <tr>
                                <th class="cell">ปีการศึกษา</th>
                                <th class="cell">รายวิชา</th>
                                <th class="cell">ครูผู้สอน</th>
                                <th class="cell">แก้ไขคะแนน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result as $key => $v_result) : ?>
                            <tr>
                                <td class="cell"><?=$v_result->RegisterYear?></td>
                                <td class="cell"><span
                                        class="truncate"><?=$v_result->SubjectCode.' '.$v_result->SubjectName?></span>
                                </td>
                                <td class="cell">
                                    <?=$v_result->pers_prefix.$v_result->pers_firstname.' '.$v_result->pers_lastname?>
                                </td>
                                <td class="cell">
                                    <a href="<?=base_url('Admin/Acade/Evaluate/EditGrade/'.$v_result->RegisterYear.'/'.$v_result->SubjectID)?>"
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
    <!--//main-wrapper-->