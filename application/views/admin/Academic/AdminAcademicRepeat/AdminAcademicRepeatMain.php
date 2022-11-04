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
                                    <?php foreach ($result as $key => $v_result) : ?>
                                    <tr>
                                        <td class="cell"><?=$v_result->RegisterYear?></td>
                                        <td class="cell"><span class="truncate"><?=$v_result->SubjectCode.' '.$v_result->SubjectName?></span></td>
                                        <td class="cell"><?=$v_result->pers_prefix.$v_result->pers_firstname.' '.$v_result->pers_lastname?></td>
                                        <td class="cell">
                                            <a href="http://" class="badge bg-warning"></a>แก้ไข</a>
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