<style>
    .ss-main .ss-single-selected {
        height: 40px;
    }
</style>
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <section class="cta-section theme-bg-light py-5">
                <div class="container text-center">

                    <h2 class="heading">จัดการข้อมูล<?=$title;?></h2>
                </div>
                <!--//container-->
            </section>
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-primary btn-sm float-right mb-3" id="ModalAddClassRoom" data-bs-toggle="modal" data-bs-target="#myModal"> 
                            <i class="far fa-plus-square"></i> เพิ่ม<?=$title;?>
                        </button>

                        <table class="table table-bordered" id="tb-classroom">
                            <thead>
                                <tr>
                                    <th>ปีการศึกษา</th>
                                    <th>ห้องเรียน</th>
                                    <th>ครูที่ปรึกษา / ครูหัวหน้าระดับ</th>
                                    <th>คำสั่ง</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $tea = []; foreach ($classRoom as $key => $v_classRoom) : 
                    $tea[] = $v_classRoom->class_teacher;
                        ?>
                                <tr>
                                    <td><?=$v_classRoom->Reg_Year?></td>
                                    <td>
                                       
                                        <?php if(strlen($v_classRoom->Reg_Class) == 1) : ?>
                                            หัวหน้าระดับ ม. <?=$v_classRoom->Reg_Class?>
                                        <?php else : ?>
                                            ห้อง ม.<?=$v_classRoom->Reg_Class?>
                                        <?php endif; ?>
                                    </td>
                                    <td><?=$v_classRoom->pers_prefix.$v_classRoom->pers_firstname.' '.$v_classRoom->pers_lastname?>
                                    </td>
                                    <td><a href="<?=base_url('admin/academic/ConAdminClassRoom/DeleteClassRoom/').$v_classRoom->pers_id;?>">ลบ</a></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        <!-- The Modal -->
        <div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">เพิ่ม<?=$title;?></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form id="AddClassRoom" action="#" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">ปีการศึกษา <?php $d= (date('Y')+543)-1;?></label>
                                <select name="year" id="year" class="form-control">
                                    <?php for($i=$d; $i<=$d+2; $i++) : ?>
                                    <option <?=$i==date('Y')+543 ? 'selected' : ''?>><?=$i;?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="classroom">ห้องเรียน / ระดับชั้น</label>
                               
                                <select name="classroom" id="classroom" class="" required>
                                    <option value="1">หัวหน้าระดับชั้น ม.1</option>
                                    <option value="2">หัวหน้าระดับชั้น ม.2</option>
                                    <option value="3">หัวหน้าระดับชั้น ม.3</option>
                                    <option value="4">หัวหน้าระดับชั้น ม.4</option>
                                    <option value="5">หัวหน้าระดับชั้น ม.5</option>
                                    <option value="6">หัวหน้าระดับชั้น ม.6</option>
                                <?php foreach ($this->classroom->ListRoom() as $key => $ListRoom) : ?>                                    
                                <option value="<?=$ListRoom;?>">ที่ปรึกษาห้อง <?=$ListRoom;?></option>
                                <?php endforeach; ?>
                                </select>
                              
                            </div>
                            <div class="mb-3">
                                <label for="teacher">ครูที่ปรึกษา / ครูหัวหน้าระดับ</label>
                                <select name="teacher" id="teacher" class="" required >

                                    <option value=''>เลือกครูที่ปรึกษา</option>
                                    <?php foreach ($NameTeacher as $key => $v_NameTeacher) : ?>
                               
                                    <option value="<?=$v_NameTeacher->pers_id;?>">
                                        <?=$v_NameTeacher->pers_prefix.$v_NameTeacher->pers_firstname.' '.$v_NameTeacher->pers_lastname?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">                       
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>