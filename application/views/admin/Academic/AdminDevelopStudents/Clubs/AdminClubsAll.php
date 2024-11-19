<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <!-- Activities Table -->
            <div class="card">
                <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                    <div>รายชื่อชุมนุม</div>
                    <div><a class="btn btn-secondary BtnAddClub" href="#">+
                            เพิ่มชุมนุม</a></div>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="TbClubs">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ปีการศึกษา</th>
                                <th>ชื่อชุมนุม</th>
                                <th>ราละเอียดชุมนุม</th>
                                <th>ครูที่ปรึกษาชุมนุม</th>
                                <th>จำนวนที่รับ</th>
                                <th>คำสั่ง</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<style>       
        .ss-main .ss-single-selected{
            height: 40px;
        }
    </style>
<!-- Modal -->
<div class="modal fade" id="ModalAddClubs" tabindex="-1" aria-labelledby="clubModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clubModalLabel">เพิ่มชุมนุม</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Club Form -->
                <form  method="POST" id="FormAddClubs">
                <input type="hidden" name="club_id" id="club_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="club_year" class="form-label">ปีการศึกษา</label>
                                <select class="form-select" id="club_year" name="club_year" required1>
                                    <option value="" disabled selected>เลือกปีการศึกษา</option>
                                    <option value="2567">2567</option>
                                    <option value="2568">2568</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="club_trem" class="form-label">เทอม</label>
                                <select class="form-select" id="club_trem" name="club_trem" required1>
                                    <option value="" disabled selected>เลือกเทอม</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- ชื่อชุมนุม -->
                    <div class="mb-3">
                        <label for="club_name" class="form-label">ชื่อชุมนุม</label>
                        <input type="text" class="form-control" id="club_name" name="club_name"
                            placeholder="ระบุชื่อชุมนุม" required1>
                    </div>

                    <!-- Club Description -->
                    <div class="mb-3">
                        <label for="club_description" class="form-label">รายละเอียดชุมนุม หรือเกี่ยวกับ</label>
                        <textarea class="form-control" id="club_description" name="club_description" rows="5"
                            placeholder="ระบุรายละเอียดชุมนุม หรือเกี่ยวกับ"></textarea>
                    </div>


                    <!-- Club Room -->
                    <div class="mb-3">
                        <label for="club_max_participants" class="form-label">รับจำนวน</label>
                        <input type="number" class="form-control" id="club_max_participants"
                            name="club_max_participants" placeholder="ใส่จำนวนสูงสุดของชุมนุม">
                    </div>

                    <!-- Club Advisor -->
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="club_faculty_advisor" class="form-label">ครูที่ปรึกษาชุมนุม</label>
                            <select class="club_faculty_advisor" id="club_faculty_advisor"  name="club_faculty_advisor" required1 style="width: 100%;">
                                <option value="" disabled selected>เลือกครูที่ปรึกษาชุมนุม</option>
                                <?php foreach ($Teacher as $key => $v_Teacher) : ?>
                                <option value="<?=$v_Teacher->pers_id?>"><?=$v_Teacher->pers_prefix.$v_Teacher->pers_firstname.' '.$v_Teacher->pers_lastname?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">บันทึกชุมนุม</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>