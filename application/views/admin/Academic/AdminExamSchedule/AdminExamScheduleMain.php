<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <section class="cta-section theme-bg-light py-5">
                <div class="container text-center">
                    <h2 class="heading">จัดการข้อมูล<?=$title;?></h2>
                </div>
                <!--//container-->
            </section>
            <section class="we-offer-area text-center ">
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <div class="table-responsive">
                                <a href="<?=base_url('Admin/ExamSchedule/add');?>"
                                    class="btn btn-primary btn-sm float-right mb-3"> <i class="far fa-plus-square"></i>
                                    เพิ่ม<?=$title;?>
                                </a>

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>การสอบ</th>
                                            <th>ปีการศึกษา</th>
                                            <th>ภาคเรียน</th>
                                            <th>ไฟล์ตัวอย่าง</th>
                                            <th>วันที่ลง</th>
                                            <th>คำสั่ง</th>
                                        </tr>
                                    </thead>
                                    <?php foreach ($exam_schedule as $key => $v_exam_schedule) : ?>
                                    <tr>
                                        <td><?=$v_exam_schedule->exam_type;?></td>
                                        <td><?=$v_exam_schedule->exam_year;?></td>
                                        <td><?=$v_exam_schedule->exam_term;?></td>
                                        <td><a href="<?=base_url('uploads/academic/exam_schedule/'.$v_exam_schedule->exam_filename);?>"
                                                target="_blank" rel="noopener noreferrer">ดูไฟล์
                                                <?=$v_exam_schedule->exam_filename;?></a></td>
                                        <td><?=$v_exam_schedule->exam_create;?></td>
                                        <td>
                                            <a href="<?=base_url('admin/ConAdminExamSchedule/delete_exam_schedule/').$v_exam_schedule->exam_id.'/'.$v_exam_schedule->exam_filename;?>"
                                                class="btn btn-danger btn-sm"
                                                onClick="return confirm('ต้องการลบข้อมูลหรือไม่?')"><i
                                                    class="fas fa-trash-alt"></i> ลบ</a>
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
    </div>
</div>