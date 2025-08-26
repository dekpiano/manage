<input type="text" id="KeyStatus" value="<?=$this->uri->segment(5)?>">
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
        <h2 class="heading"><?=$title;?></h2>
            <div class="card">
                <div class="card-body">
                    <div id="classFilterWrapper" style="display: none;">
                        <label for="classFilter" class="form-label">เลือกระดับชั้น</label>
                        <select class="form-select" id="classFilter" name="classFilter" style="width: 200px;">
                            <option value="">ทั้งหมด</option>
                            <?php foreach ($class_list as $v_class) : ?>
                            <option value="ม.<?=$v_class;?>">ม.<?=$v_class;?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <table class="table table-bordered" id="tbStudent">
                        <thead>
                            <tr>
                                <th>เลขประจำตัว</th>
                                <th>ชื่อ - นามสกุล</th>
                                <th>ชั้น</th>
                                <th>เลขที่</th>
                                <th>สายการเรียน</th>
                                <th>สถานะนักเรียน</th>
                                <th>สถานะพฤติกรรม</th>
                                <th class="manage-column">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    #studentDetailModal .form-floating label {
        color: black !important;
    }
    #studentDetailModal .form-control,
    #studentDetailModal .form-select {
        color: black !important;
    }
    div.toolbar {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    div.toolbar label {
        margin-right: 10px;
    }
    .manage-column {
        min-width: 100px;
        text-align: center;
    }
</style>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เปลี่ยนสถานะ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="keystu" name="" value="">
                <?php $Status = array('เลือกสถานะ','1/ปกติ','2/ย้ายสถานศึกษา','3/ขาดประจำ','4/พักการเรียน','5/จบการศึกษา' ); ?>
                <select class="form-select StudentStatus" id="StudentStatus" name="StudentStatus">
                    <?php foreach ($Status as $key => $v_Status) : ?>
                    <option value="<?=$v_Status;?>"><?=$v_Status;?></option>
                    <?php endforeach; ?>
                </select>
            </div>
          
        </div>
    </div>
</div>

<!-- Student Detail Modal -->
<div class="modal fade" id="studentDetailModal" tabindex="-1" aria-labelledby="studentDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="editStudentForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="studentDetailModalLabel">แก้ไขข้อมูลนักเรียน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="studentDetailContent">
                        <!-- Student details form will be loaded here dynamically -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>