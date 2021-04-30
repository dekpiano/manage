<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">แผนการสอน ปีการศึกษ 2564</h2>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">


        <div class="col-lg-6">
            <div class="card">
                <div class="card-close">
                    <div class="dropdown">
                        <button type="button" id="closeCard1" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard1" class="dropdown-menu dropdown-menu-right has-shadow"><a
                                href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#"
                                class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                    </div>
                </div>
                <div class="card-header d-flex align-items-center">
                    <h3 class="h4">ฟอร์มแก้ไขการส่งงาน</h3>
                </div>
                <div class="card-body">
                   
                    <form class="needs-validation" novalidate id="form_update_plan">
                    <input type="text" id="seplan_ID" name="seplan_ID" placeholder="" class="d-none form-control" required value="<?=$plan[0]->seplan_ID?>">
                        <div class="form-group">
                            <label class="form-control-label">ชื่อวิชา</label>
                            <input type="text" id="seplan_namesubject" name="seplan_namesubject" placeholder="" class="form-control" required value="<?=$plan[0]->seplan_namesubject?>">
                            <div class="invalid-feedback">กรุณากรอกชื่อวิชา</div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">รหัสวิชา</label>
                            <input type="text" id="seplan_coursecode" name="seplan_coursecode" placeholder="" class="form-control" required value="<?=$plan[0]->seplan_coursecode?>">
                            <div class="invalid-feedback">กรุณากรอกรหัสวิชา</div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">ประเภทการส่ง</label>
                            <select id="seplan_typeplan" name="seplan_typeplan" class="form-control mb-3" required>
                              <option value="">เลือก...</option>
                              <?php $type = array('โครงการสอน','แผนการสอนหน้าเดียว','แผนการสอนเต็ม','บันทึกหลังสอน' );
                              foreach ($type as $key => $v_type) :
                              ?>                            
                              <option <?=$v_type==$plan[0]->seplan_typeplan ? 'selected' : ''?> value="<?=$v_type?>"><?=$v_type?></option>
                              <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">กรุณาเลือกประเภทการส่ง</div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">ไฟล์งาน</label>
                            <input type="file" id="seplan_file" name="seplan_file" placeholder="Password" class="form-control" >
                            <div class="invalid-feedback">กรุณาเลือกไฟล์</div>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="ส่งงาน" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>