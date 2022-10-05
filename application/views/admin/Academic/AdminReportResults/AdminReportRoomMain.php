<style>
.border-left-primary {
    border-left: .25rem solid #5BC3D5 !important;
}

th.rotated-text {
    position: relative;
    height: 200px;
    white-space: nowrap;
    padding: 0 !important;
    overflow: auto;
}

th.rotated-text>div {
    position: absolute;
    top: 100%;
    left: 50%;
    transform: rotate(-90deg) translateY(-50%);
    transform-origin: 0 0;
}

th.rotated-text>div>span {
    display: inline-block;
    padding: 0px 15px;
    padding-left: 5px;
}
</style>
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0"><?=$title?> <?=$totip;?></h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">


                        <div class="col-auto">
                            <form action="<?=base_url('Admin/Acade/Evaluate/ReportRoom');?>" method="post">
                                <select class="form-select w-auto" name="keyroom">
                                    <option selected="" value="1">เลือกห้อง...</option>
                                    <?php foreach ($this->classroom->ListRoom() as $key => $v_ListRoom) : ?>
                                    <option <?=$keyroom == "ม.".$v_ListRoom ?"selected":""?>
                                        value="ม.<?=$v_ListRoom;?>"><?=$v_ListRoom;?></option>
                                    <?php endforeach; ?>
                                </select>
                        </div>
                        <div class="col-auto">
                            <button class="btn app-btn-primary clickLoder" type="submit">ค้นหา</button>
                        </div>
                        </form>
                    </div>
                    <!--//row-->
                </div>
                <!--//table-utilities-->
            </div>
            <!--//col-auto-->
        </div>
        <!--//container-->
        </section>
        <section class="we-offer-area">
            <div class="container-fluid">

                <?php if($Nodata == 0): ?>
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">กรุณาเลือกห้องเรียนก่อน...</h2>
                    </div>
                </div>
                <?php else: ?>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tblGrade">
                                <thead>
                                    <tr class="text-center">
                                        <th class="cell align-middle" style="width:20px">ลำดับที่</th>
                                        <th class="cell align-middle" style="width:500px">ชื่อ - นามสกุล</th>
                                        <?php foreach ($subject as $key => $v_subject):?>
                                        <th class="rotated-text">
                                            <div>
                                                <span>
                                                    <?=$v_subject->SubjectUnit.' '.$v_subject->SubjectCode.' '.$v_subject->SubjectName ?>
                                                </span>
                                            </div>
                                        </th>
                                        <?php endforeach; ?>
                                        <th class="cell align-middle">GPA เกรดเฉลี่ย</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
                                
                                foreach ($stu as $key => $v_stu) : 
                                ?>
                                    <tr>
                                        <td class="cell align-middle text-center"><?=$v_stu->StudentNumber?></td>
                                        <td class="cell">
                                            <?=$v_stu->StudentPrefix.$v_stu->StudentFirstName?>
                                            <?=$v_stu->StudentLastName?>
                                        </td>
                                        <?php   
                                         $SumAll=0;  $SumUnit=0;     
                                    foreach ($subject as $key => $v_subject): 
                                     
                                    ?>
                                        <td class="text-center check_score" width="45">
                                            <?php foreach ($check as $key => $v_check):?>
                                            <?php if($v_subject->SubjectCode == $v_check->SubjectCode && $v_stu->StudentID == $v_check->StudentID): ?>
                                            <div class="showGrade" data_unit="<?=$v_subject->SubjectUnit?>">
                                                <?php echo $v_check->Grade; ?>
                                            </div>

                                            <?php endif; ?>
                                            <?php endforeach; ?>

                                        </td>
                                        <?php endforeach; ?>

                                        <td class="cell totalGrade text-center">

                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

            </div>

    </div>
    </section>

</div>
<!--//main-wrapper-->