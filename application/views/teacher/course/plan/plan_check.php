<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center ">
            <h2 class="no-margin-bottom">ตรวจสอบงาน</h2>

        </div>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="">
    <div class="container-fluid">

        <div class="row">
            <?php foreach ($lean as $key => $v_lean): ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body statistic">
                        <div class="media align-items-center">
                            <div class="icon bg-red"><i class="fa fa-tasks"></i></div>
                            <div class="media-body overflow-hidden">
                                <h5 class="card-text mb-0"> <?=$v_lean->lear_namethai?></h5>
                                <small><?=$v_lean->lear_nameeng?></small>

                            </div>
                        </div><a href="<?=base_url('Teacher/Course/CheckPlan/');?><?=$v_lean->lear_id?>" class="tile-link"></a>
                    </div>
                </div>

            </div>
            <?php endforeach; ?>

        </div>

        <?php if(isset($ID)) : ?>
        <div class="card">
            <div class="card-body">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>ภาคเรียน</th>
                            <th>ปีการศึกษา</th>
                            <th>รหัสวิชา</th>
                            <th>ชื่อวิชา</th>
                            <th>วันที่ส่ง</th>
                            <th>หน.กลุ่มสาระ</th>
                            <th>หน.วิชาการ</th>
                            <th>คำสั่ง</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                            <td>61</td>
                        </tr>
                        <tr>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>2011/07/25</td>
                            <td>$170,750</td>
                            <td>$320,800</td>
                            <td>61</td>
                        </tr>
                        <tr>
                            <td>Ashton Cox</td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>2009/01/12</td>
                            <td>$86,000</td>
                            <td>$320,800</td>
                            <td>61</td>
                        </tr>

                    </tbody>

                </table>

            </div>
        </div>
        <?php endif; ?>

    </div>
</section>