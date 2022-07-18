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
                    <h3 class="h4">รายวิชาที่สอน <?=$check_student[0]->SubjectCode?> <?=$check_student[0]->SubjectName?>
                        ครูประจำวิชา <?=$this->session->userdata('fullname');?></h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th colspan="4">ข้อมูลนักเรียน</th>
                                    <th colspan="6">การประเมินผลการเรียน</th>
                                </tr>
                                <tr>
                                    <th>ชั้น</th>
                                    <th>เลขที่</th>
                                    <th>เลขประจำตัว</th>
                                    <th width="200">ชื่อ - นามสกุล</th>
                                    <th class="h6">สอบกลางภาค</th>
                                    <th class="h6">สอบปลายภาค</th>
                                    <th class="h6">คะแนนรวม</th>
                                    <th class="h6">ร้อยละคะแนนรวม</th>
                                    <th class="h6">เกรด</th>
                                    <th class="h6">สถานะนักเรียน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($check_student as $key => $v_check_student) : ?>
                                <tr>
                                    <th><?=$v_check_student->StudentClass?></th>
                                    <td><?=$v_check_student->StudentNumber?></td>
                                    <td><?=$v_check_student->StudentCode?></td>
                                    <td><?=$v_check_student->StudentPrefix?><?=$v_check_student->StudentFirstName?>
                                        <?=$v_check_student->StudentLastName?></td>
                                        <td>
                                            <input type="text" class="form-control" id="exampleInputEmail1" >
                                        </td>
                                        <td>
                                        <input type="text" class="form-control" id="exampleInputEmail1" >
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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