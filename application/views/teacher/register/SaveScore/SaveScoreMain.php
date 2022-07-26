<!-- Page Header-->
<style>
.services .card1 {
    padding: 10px;
    border: none;
    cursor: pointer;
    border: groove;
}

.services .card1:hover {
    background-color: #fff;
}

.services .card1 span {
    font-size: 14px;
}

.g-1 {
    padding: 10px 15px;
    margin: 0;
}
</style>
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom"><?=$title?></h2>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-close">
                    <div class="dropdown">
                        <button type="button" id="closeCard3" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard3" class="dropdown-menu dropdown-menu-right has-shadow"><a
                                href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#"
                                class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                    </div>
                </div>
                <div class="card-header d-flex align-items-center">
                    <h3 class="h4">รายวิชาที่สอน</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ปีการศึกษา</th>
                                    <th>ชั้นที่สอน</th>
                                    <th>วิชา</th>
                                    <th>หน่วยกิจ</th>
                                    <th>ชั่วโมง</th>
                                    <th>บันทึกผลการเรียน</th>
                                    <th>รายงาน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($check_subject as $key => $v_check_subject) : ?>
                                <tr>
                                    <th><?=$v_check_subject->RegisterYear?></th>
                                    <td><?=$v_check_subject->RegisterClass?></td>
                                    <td><?=$v_check_subject->SubjectCode?> <?=$v_check_subject->SubjectName?></td>
                                    <td><?=$v_check_subject->SubjectUnit?></td>
                                    <td><?=$v_check_subject->SubjectHour?></td>
                                    <td>
                                        <a href="<?=base_url('Teacher/Register/SaveScoreAdd/'.$v_check_subject->RegisterYear.'/'.$v_check_subject->SubjectCode.'/all')?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> บันทึกผลการเรียน</a>
                                    </td>
                                    <td>
                                    <a href="<?=base_url('Teacher/Register/RopoetPT');?>" class="btn btn-primary btn-sm"><i class="fa fa-print" aria-hidden="true"></i> พิมพ์รายงาน</a>
                                    </td>
                                </tr>
                              <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>