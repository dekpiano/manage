<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <section class="cta-section theme-bg-light py-5">
                <div class="container text-center">

                    <h2 class="heading">จัดการข้อมูล<?=$title;?></h2>

                </div>
            </section>

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- DataTales Example -->
                <div class="row justify-content-lg">
                    <div class="col-12">
                        <div class="card shadow mb-4 ">

                            <div class="card-body">
                                <form action="<?=base_url('Admin/Acade/ConAdminExamSchedule/').$action;?>" method="post"
                                    enctype="multipart/form-data" class="needs-validation" novalidate>
                                    <div class="form-group row mb-3">
                                        <label for="exam_id" class="col-sm-2 col-form-label">รหัส<?=$title;?></label>
                                        <div class="col-md-2">
                                            <input type="text" readonly class="form-control" id="exam_id" name="exam_id"
                                                value="<?=$action == 'insert_exam_schedule' ? $exam_schedule : $exam_schedule[0]->exam_id;?>"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="exam_term" class="col-sm-2 col-form-label">ประเภทสอบ</label>
                                        <div class="col-md-4">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="exam_type1" name="exam_type"
                                                    class="custom-control-input" required value="กลางภาค">
                                                <label class="custom-control-label" for="exam_type1">กลางภาค</label>

                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="exam_type2" name="exam_type"
                                                    class="custom-control-input" required value="ปลายภาค">
                                                <label class="custom-control-label" for="exam_type2">ปลายภาค</label>
                                            </div>
                                            <div class="invalid-feedback">เลือกสอบกลางภาคหรือปลายภาค</div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="exam_term" class="col-sm-2 col-form-label">ภาคเรียน</label>
                                        <div class="col-md-4">
                                            <select name="exam_term" id="exam_term" class="form-control" required>
                                                <option value="">เลือกภาคเรียน</option>
                                                <?php  $Eterm = array(1,2,3);
                                        foreach ($Eterm as $key => $term): ?>
                                                <option
                                                    value="<?=@$exam_schedule[0]->exam_term == $term ? 'selected' : $term;?>">
                                                    <?=$term;?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">เลือกภาคเรียน</div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="exam_year" class="col-sm-2 col-form-label">ปีการศึกษา</label>
                                        <div class="col-md-4">
                                            <select name="exam_year" id="exam_year" class="form-control" required>
                                                <option value="">เลือกปีการศึกษา</option>
                                                <?php 
                                        $datethai = date ("Y")+543; 
                                        for($d = $datethai-2; $d <= $datethai+2; $d++):
                                    ?>
                                                <option value="<?=$d;?>"><?=$d;?></option>
                                                <?php endfor; ?>
                                            </select>
                                            <div class="invalid-feedback">เลือกปีการศึกษา</div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="exam_filename"
                                            class="col-sm-2 col-form-label">ไฟล์<?=$title;?></label>
                                        <div class="col-sm-4">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="exam_filename"
                                                    id="exam_filename" required>                                              
                                                <div class="invalid-feedback">เลือกไฟล์ PDF</div>
                                            </div>

                                            <small id="emailHelp" class="form-text text-muted">เพิ่มได้เฉพราะ PDF
                                            </small>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="exam_filename" class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <button type="submit"
                                                class="btn btn-lg btn-<?=$color?>  btn-block"><?=$icon?>บันทึก</button>

                                        </div>

                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>




            </div>
            <!-- /.container-fluid -->

        </div>
    </div>
</div>