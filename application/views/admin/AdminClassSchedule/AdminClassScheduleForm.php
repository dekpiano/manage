<div class="main-wrapper">
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
                        <form action="<?=base_url('admin/ConAdminClassSchedule/').$action;?>" method="post"
                            enctype="multipart/form-data">
                            <div class="form-group row">
                                <label for="schestu_id" class="col-sm-2 col-form-label">รหัส<?=$title;?></label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control" id="schestu_id" name="schestu_id"
                                        value="<?=$action == 'insert_class_schedule' ? $class_schedule : $class_schedule[0]->schestu_id;?>"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="schestu_id" class="col-sm-2 col-form-label">ภาคเรียน</label>
                                <div class="col-sm-10">
                                <select name="schestu_term" id="schestu_term" class="form-control">                                       
                                        <option value="1"> 1</option>
                                        <option value="2"> 2</option>
                                        <option value="3"> 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="schestu_classname" class="col-sm-2 col-form-label">ปีการศึกษา</label>
                                <?php $toYear = date("Y",strtotime(date('Y')))+543;?>
                                <div class="col-sm-10">
                                    <select name="schestu_year" id="schestu_year" class="form-control">
                                        <?php for ($i = $toYear-2; $i <= $toYear+2; $i++): ?>
                                        <option <?=$toYear==$i?'selected':''?> value="<?=$i;?>"><?=$i;?>
                                        </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="schestu_classname" class="col-sm-2 col-form-label">ชั้น ม.</label>
                                <div class="col-sm-10">
                                    <select name="schestu_classname" id="schestu_classname" class="form-control">
                                        <?php $room = array('1/1'=>'1.1','1/2'=>'1.2', '1/3'=>'1.3', '1/4'=>'1.4', '2/1'=>'2.1', '2/2'=>'2.2', '2/3'=>'2.3', '2/4'=>'2.4', '3/1'=>'3.1', '3/2'=>'3.2', '3/3'=>'3.3', '3/4'=>'3.4', '4/1'=>'4.1', '4/2'=>'4.2', '4/3'=>'4.3', '4/4'=>'4.4', '5/1'=>'5.1', '5/2'=>'5.2', '5/3'=>'5.3', '5/4'=>'5.4', '6/1'=>'6.1', '6/2'=>'6.2','6/3'=>'6.3','6/4'=>'6.4');
                                        foreach ($room as $key => $v_ClassRoom): ?>
                                        <option value="<?=$key;?>"><?=$key;?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small id="emailHelp" class="form-text text-muted">กรณีที่ไม่มีห้องเรียน
                                        ให้เพิ่มห้องเรียนและครูที่ปรึกษาก่อน</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="schestu_id" class="col-sm-2 col-form-label">ชื่อห้องเรียน</label>
                                <div class="col-sm-10">
                                    <input type="text"  class="form-control" id="schestu_name" name="schestu_name" value=""  required>
                                    <small id="emailHelp" class="form-text text-muted">Ex. ดนตรี, ภาษา</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="schestu_filename" class="col-sm-2 col-form-label">รูป<?=$title;?></label>
                                <div class="col-sm-10">
                                    <input type="file" name="schestu_filename" id="schestu_filename" />
                                    <small id="emailHelp" class="form-text text-muted">PDF ขนาดไฟล์ไม่เกิน 2 mb</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="schestu_filename" class="col-sm-2 col-form-label"></label>
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