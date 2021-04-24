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
                    <h3 class="h4">ฟอร์มส่งงาน</h3>
                </div>
                <div class="card-body">
                   
                    <form>
                        <div class="form-group">
                            <label class="form-control-label">ชื่อวิชา</label>
                            <input type="text" placeholder="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">รหัสวิชา</label>
                            <input type="text" placeholder="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">ประเภทการส่ง</label>
                            <select name="account" class="form-control mb-3">
                              <option>เลือก...</option>
                              <option>โครงการสอน</option>
                              <option>แผนการสอนหน้าเดียว</option>
                              <option>แผนการสอนเต็ม</option>
                              <option>บันทึกหลังสอน</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">ไฟล์งาน</label>
                            <input type="file" placeholder="Password" class="form-control">
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