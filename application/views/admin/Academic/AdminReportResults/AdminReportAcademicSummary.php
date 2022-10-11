<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0"><?=$title?></h1>
                </div>
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <form class="docs-search-form row gx-1 align-items-center">
                                    <div class="col-auto">
                                        <input type="text" id="search-docs" name="searchdocs"
                                            class="form-control search-docs" placeholder="Search">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn app-btn-secondary">Search</button>
                                    </div>
                                </form>

                            </div>
                            <!--//col-->

                        </div>
                        <!--//row-->
                    </div>
                    <!--//table-utilities-->
                </div>
                <!--//col-auto-->
            </div>
            <!--//row-->

<style>
    .scrollit {
    overflow:scroll;
    
}
</style>
            <div class="app-card  shadow-sm mb-5 p-2 " >
                <div class="app-card-body">
                    <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left table-bordered scrollit" id="ReportSummaryTeacher" style=""> <!-ReportSummaryTeacher-->
                            <thead>
                                <tr class="text-center">
                                    <th class="cell text-center" style="width:230px">ครูผู้สอน</th>
                                    <th class="cell text-center" style="width:280px">วิชา</th>
                                    <th class="cell text-center">ชั้น</th>
                                    <th class="cell text-center" style="width:120px">สาระ</th>
                                    <th class="cell text-center">หน่วย</th>
                                    <th class="cell text-center">นักเรียน</th>
                                    <th class="cell text-center">4</th>
                                    <th class="cell text-center">3.5</th>
                                    <th class="cell text-center">3</th>
                                    <th class="cell text-center">2.5</th>
                                    <th class="cell text-center">2</th>
                                    <th class="cell text-center">1.5</th>
                                    <th class="cell text-center">1</th>
                                    <th class="cell text-center text-danger">0</th>
                                    <th class="cell text-center">รวม</th>
                                    <th class="cell text-center text-danger">ร</th>
                                    <th class="cell text-center text-danger">มส</th>
                                    <th class="cell text-center">รวม</th>
                                    <th class="cell text-center ">ร้อยละผลการเรียนดี</th>
                                    <th class="cell text-center ">ค่าเฉลี่ย</th>
                                    <th class="cell text-center ">SD</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($Showdata as $key => $v_data):?>
                                <tr>
                                    <td class="cell" >
                                        <?=$v_data->pers_prefix.$v_data->pers_firstname.' '.$v_data->pers_lastname?>
                                    </td>
                                    <td class="cell">
                                        <?=$v_data->SubjectCode.' '.$v_data->SubjectName;?>
                                    </td>
                                    <td class="cell text-center text-center"><?=$v_data->StudentClass;?></td>
                                    <td class="cell text-center text-center">
                                        <?=$v_data->SubjectType;?>
                                    </td>
                                    <td class="cell text-center text-center">
                                    <?=$v_data->SubjectUnit;?>
                                    </td>
                                    <td class="cell text-center"><?=$v_data->SumStu?></td>
                                    <td class="cell text-center showGradeGood PC_Good"><?=$v_data->G4_0?></td>
                                    <td class="cell text-center showGradeGood PC_Good"><?=$v_data->G3_5?></td>
                                    <td class="cell text-center showGradeGood PC_Good"><?=$v_data->G3_0?></td>
                                    <td class="cell text-center showGradeGood"><?=$v_data->G2_5?></td>
                                    <td class="cell text-center showGradeGood"><?=$v_data->G2_0?></td>
                                    <td class="cell text-center showGradeGood"><?=$v_data->G1_5?></td>
                                    <td class="cell text-center showGradeGood"><?=$v_data->G1_0?></td>
                                    <td class="cell text-center text-danger showGradeGood"><?=$v_data->G0?></td>
                                    <td class="cell text-center SumGradeGood"></td>
                                    <td class="cell text-center text-danger showGradeNoGood"><?=$v_data->G_W?></td>
                                    <td class="cell text-center text-danger showGradeNoGood"><?=$v_data->G_MS?></td>
                                    <td class="cell text-center SumGradeNoGood"></td>
                                    <td class="cell text-center SumPcGood"></td>
                                    <td class="cell text-center AvgGrade"></td>
                                    <td class="cell text-center text-danger"></td>
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
        <!--//container-fluid-->
    </div>
    <!--//app-content-->



</div>