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
                    <div class="d-flex justify-content-between mb-3">
                    <select name="" id="" class="form-select w-auto">
                        <option value="">เลือกปี</option>
                    </select>
                    <a href="<?=base_url('Admin/Acade/Course/ClassSchedule/add');?>"
                        class="btn app-btn-primary"> <i class="far fa-plus-square"></i>
                        เพิ่ม<?=$title;?></a>
                    </div>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ชื่อห้องเรียน</th>
                                            <th>ชั้น/ห้อง</th>
                                            <th>ปีการศึกษา</th>
                                            <th>ไฟล์ตัวอย่าง</th>
                                            <th>วันที่ลง</th>
                                            <th>คำสั่ง</th>
                                        </tr>
                                    </thead>
                                    <?php foreach ($class_schedule as $key => $v_class_schedule) : ?>
                                    <tr>
                                        <td><?=$v_class_schedule->schestu_name;?></td>
                                        <td><?=$v_class_schedule->schestu_classname;?></td>
                                        <td><?=$v_class_schedule->schestu_term.'/'.$v_class_schedule->schestu_year;?>
                                        </td>
                                        <td><a href="<?=base_url('uploads/academic/class_schedule/'.$v_class_schedule->schestu_filename);?>"
                                                target="_blank" rel="noopener noreferrer">ดูไฟล์
                                                <?=$v_class_schedule->schestu_classname;?></a></td>
                                        <td><?=$v_class_schedule->schestu_datetime;?></td>
                                        <td>
                                            <a href="<?=base_url('admin/academic/ConAdminClassSchedule/delete_class_schedule/').$v_class_schedule->schestu_id.'/'.$v_class_schedule->schestu_filename;?>"
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