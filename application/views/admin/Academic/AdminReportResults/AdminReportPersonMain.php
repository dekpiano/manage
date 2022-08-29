<style>
.border-left-primary {
    border-left: .25rem solid #5BC3D5 !important;
}
</style>
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title">จัดการข้อมูล<?=$title;?></h1>
            <hr class="mb-4">
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
                                    <th class="cell">เลขประจำตัว</th>
                                    <th class="cell">เลขที่</th>
                                    <th class="cell">ชื่อ</th>
                                    <th class="cell">นามสกุล</th>
                                    <th class="cell">ระดับชั้น</th>
                                    <th class="cell">ดูผลการเรียน</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($stu as $key => $v_stu) : ?>
                                <tr>
                                    <td class="cell"><?=$v_stu->StudentCode?></td>
                                    <td class="cell"><?=$v_stu->StudentNumber?></td>
                                    <td class="cell"><?=$v_stu->StudentPrefix.$v_stu->StudentFirstName?></td>
                                    <td class="cell"><?=$v_stu->StudentLastName?></td>
                                    <td class="cell"><?=$v_stu->StudentClass?></td>

                                    <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td>
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