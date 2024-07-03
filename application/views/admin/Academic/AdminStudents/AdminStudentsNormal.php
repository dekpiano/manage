<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
        <h2 class="heading"><?=$title;?></h2>
            <div class="card">
                <div class="card-body">
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
                            </tr>
                        </thead>
                        <tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


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