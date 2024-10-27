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
                        <div class="card app-card-settings shadow mb-4 ">

                            <div class="card-body">
                                <form action="<?=base_url('admin/academic/ConAdminClassSchedule/').$action;?>"
                                    class="FormAddClassSchedule">
                                    <div class="form-group row mb-3">
                                        <label for="schestu_id" class="col-sm-2 col-form-label">รหัส<?=$title;?></label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control" id="schestu_id"
                                                name="schestu_id"
                                                value="<?=$action == 'insert_class_schedule' ? $class_schedule : $class_schedule[0]->schestu_id;?>"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="schestu_id" class="col-sm-2 col-form-label">ภาคเรียน</label>
                                        <div class="col-sm-10">
                                            <select name="schestu_term" id="schestu_term" class="form-control">
                                                <option value="1"> 1</option>
                                                <option value="2"> 2</option>
                                                <option value="3"> 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="schestu_classname"
                                            class="col-sm-2 col-form-label">ปีการศึกษา</label>
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
                                    <div class="form-group row mb-3">
                                        <label for="schestu_classname" class="col-sm-2 col-form-label">ชั้น ม.</label>
                                        <div class="col-sm-10">
                                            <select name="schestu_classname" id="schestu_classname"
                                                class="form-control">
                                                <?php $room = array('1/1'=>'1.1','1/2'=>'1.2', '1/3'=>'1.3', '1/4'=>'1.4','1/5'=>'1.5','1/6'=>'1.6', '2/1'=>'2.1', '2/2'=>'2.2', '2/3'=>'2.3', '2/4'=>'2.4', '3/1'=>'3.1', '3/2'=>'3.2', '3/3'=>'3.3', '3/4'=>'3.4', '4/1'=>'4.1', '4/2'=>'4.2', '4/3'=>'4.3', '4/4'=>'4.4','4/5'=>'4.5','4/6'=>'4.6', '5/1'=>'5.1', '5/2'=>'5.2', '5/3'=>'5.3', '5/4'=>'5.4', '6/1'=>'6.1', '6/2'=>'6.2','6/3'=>'6.3','6/4'=>'6.4');
                                        foreach ($room as $key => $v_ClassRoom): ?>
                                                <option value="<?=$key;?>"><?=$key;?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="schestu_id" class="col-sm-2 col-form-label">ชื่อห้องเรียน</label>
                                        <div class="col-sm-10">
                                            <?php $NameRoom = array('วิทย์-คณิต','วิทย์-เทคโน','ภาษา','การงานอาชีพ','ดนตรี','นาฏศิลป์','ศิลปะ','ฟุตบอล','ฟุตซอล','บาสเกตบอล','วอลเลย์บอล'); ?>
                                            <select id="schestu_name" class="form-control" name="schestu_name">
                                                <?php foreach ($NameRoom as $key => $v_NameRoom) :?>
                                                <option value="<?=$v_NameRoom?>"><?=$v_NameRoom?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="schestu_filename"
                                            class="col-sm-2 col-form-label">รูป<?=$title;?></label>
                                        <div class="col-sm-10">
                                            <input type="file" name="schestu_filename" id="schestu_filename" />
                                            <small id="emailHelp" class="form-text text-muted">PNG / JPG ขนาดไฟล์ไม่เกิน
                                                2
                                                mb</small>
                                            <br>
                                            <img id="previewImage" src="#" alt="Image Preview"
                                                style="display:none; width:200px; height:auto;" />
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="schestu_filename" class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <button type="submit"
                                                class="btn btn-lg app-btn-<?=$color?>  btn-block"><?=$icon?> บันทึก</button>

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