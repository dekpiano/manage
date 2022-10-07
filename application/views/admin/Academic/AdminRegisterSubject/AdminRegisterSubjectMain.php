<style>
.border-left-primary {
    border-left: .25rem solid #5BC3D5 !important;
}
</style>
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">

        <section class="we-offer-area">
            <div class="container-fluid">

                <div class="container-xl">

                    <div class="row g-3 mb-4 align-items-center justify-content-between">
                        <div class="col-auto">
                            <h1 class="app-page-title mb-0">จัดการข้อมูล<?=$title;?></h1>
                        </div>
                        <div class="col-auto">
                            <div class="page-utilities">
                                <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                    <div class="col-auto">

                                        <?php foreach ($GroupYear as $key => $v_GroupYear): 
                                 $GG = substr($v_GroupYear->SubjectYear, 2, 6);
                                // print_r(array($GG));
                                    //$GG = explode('/',$v_GroupYear->SubjectYear); 
                                    // $G = array_unique(array($GG));
                                    // echo '<pre>';print_r($G);
                                ?>
                                        <?php endforeach; ?>

                                    </div>
                                    <!-- <div class="col-auto">
                                        <a class="btn app-btn-secondary" href="#">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16"
                                                class="bi bi-download mr-1" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z">
                                                </path>
                                                <path fill-rule="evenodd"
                                                    d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z">
                                                </path>
                                            </svg>
                                            Download CSV
                                        </a>
                                    </div> -->
                                </div>
                                <!--//row-->
                            </div>
                            <!--//table-utilities-->
                        </div>
                        <!--//col-auto-->
                    </div>
                    <!--//row-->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="app-card app-card-settings shadow-sm p-3">
                                <div class="app-card-header mb-3">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto">
                                            <h4 class="app-card-title">เพิ่มข้อมูลรายวิชา</h4>
                                        </div>
                                        <!--//col-->
                                        <div class="col-auto">
                                            <div class="card-header-action">
                                                <a href="#">View report</a>
                                            </div>
                                            <!--//card-header-actions-->
                                        </div>
                                        <!--//col-->
                                    </div>
                                    <!--//row-->
                                </div>
                                <div class="app-card-body">
                                    <form class="settings-form row" id="form-subject">
                                        <div class="mb-3 col-6 col-lg-6">
                                            <label for="setting-input-1" class="form-label">ปีการศึกษา</label>
                                            <select class="form-select" required="" name="SubjectYear" id="SubjectYear">
                                                <option value="">เลือกปีการศึกษา</option>
                                                <?php $d = date('Y')+543; for ($i=$d; $i <= $d+1 ; $i++) :?>
                                                <option value="1/<?=$i;?>">1/<?=$i;?></option>
                                                <option value="2/<?=$i;?>">2/<?=$i;?></option>
                                                <option value="3/<?=$i;?>">3/<?=$i;?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-6 col-lg-6">
                                            <label for="setting-input-1" class="form-label">ระดับชั้นที่เปิดสอน
                                            </label>
                                            <select class="form-select" required="" name="SubjectClass"
                                                id="SubjectClass">
                                                <option value="">เลือกระดับชั้น</option>
                                                <?php $sara = $this->classroom->LevelClass();
                                                foreach ($sara as $key => $v_sara):?>
                                                <option value="<?=$v_sara?>"><?=$v_sara?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-6 col-lg-3">
                                            <label for="setting-input-1" class="form-label">รหัสวิชา
                                            </label>
                                            <input type="text" class="form-control" id="setting-input-1" value=""
                                                required="" name="SubjectCode" id="SubjectCode">
                                        </div>
                                        <div class="mb-3 col-6 col-lg-3">
                                            <label for="setting-input-1" class="form-label">ชื่อวิชา
                                            </label>
                                            <input type="text" class="form-control" id="setting-input-1" value=""
                                                required="" name="SubjectName" id="SubjectName">
                                        </div>
                                        <div class="mb-3 col-6 col-lg-3">
                                            <label for="setting-input-1" class="form-label">หน่วยกิต
                                            </label>
                                            <input type="text" class="form-control" id="setting-input-1" value=""
                                                required="" name="SubjectUnit" id="SubjectUnit">
                                        </div>
                                        <div class="mb-3 col-6 col-lg-3">
                                            <label for="setting-input-1" class="form-label">จำนวนชั่วโมง
                                            </label>
                                            <input type="text" class="form-control" id="setting-input-1" value=""
                                                required="" name="SubjectHour" id="SubjectHour">
                                        </div>
                                        <div class="mb-3 col-6 col-lg-4">
                                            <label for="setting-input-1" class="form-label">ประเภทวิชา</label>
                                            <select class="form-select " required="" name="SubjectType"
                                                id="SubjectType">
                                                <option value="">เลือกประเภทวิชา</option>
                                                <option value="1/พื้นฐาน">1/พื้นฐาน</option>
                                                <option value="2/เพิ่มเติม">2/เพิ่มเติม</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-6 col-lg-4">
                                            <label for="setting-input-1" class="form-label">สาระหลัก</label>
                                            <select class="form-select " required="" name="FirstGroup" id="FirstGroup">
                                                <option value="">เลือกสาระหลัก</option>
                                                <?php $sara = $this->classroom->GroupSaraMain();
                                                foreach ($sara as $key => $v_sara):?>
                                                <option value="<?=$v_sara?>"><?=$v_sara?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-6 col-lg-4">
                                            <label for="setting-input-1" class="form-label">สาระย่อย</label>
                                            <select class="form-select" required="" name="SecondGroup" id="SecondGroup">
                                                <option value="">เลือกสาระย่อย</option>
                                                <?php $sara = $this->classroom->GroupSaraSecond();
                                                foreach ($sara as $key => $v_sara):?>
                                                <option value="<?=$v_sara?>"><?=$v_sara?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn app-btn-primary">บันทึก</button>
                                    </form>
                                </div>
                                <!--//app-card-body-->

                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="app-card app-card-orders-table shadow-sm mb-5">
                                <div class="app-card-body">
                                    <div class="table-responsive p-3">
                                        <table class="table app-table-hover mb-0 text-left" id="tbSubject">
                                            <thead>
                                                <tr>
                                                    <th class="cell">ปีการศึกษา</th>
                                                    <th class="cell">รหัสวิชา</th>
                                                    <th class="cell">ชื่อวิชา</th>
                                                    <th class="cell">สาระ</th>
                                                    <th class="cell">ชั้น</th>
                                                    <th class="cell">ปีที่เรียน</th>
                                                    <th class="cell">คำสั่ง</th>
                                                </tr>
                                            </thead>

                                        </table>
                                    </div>

                                </div>
                                <!--//app-card-body-->
                            </div>
                            <!--//app-card-->

                        </div>
                    </div>


                </div>


            </div>
        </section>

    </div>
    <!--//main-wrapper-->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

    <!-- Modal -->
    <div class="modal fade" id="ModalUpdateSubject" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">แก้ไขวิชาเรียน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="settings-form row" id="form-update-subject">
                    <input type="text" class="form-control"  value="" required=""
                                name="Up_SubjectID" id="Up_SubjectID" style="display:none;">

                        <div class="mb-3 col-6 col-lg-6">
                            <label for="setting-input-1" class="form-label">ปีการศึกษา</label>
                            <select class="form-select" required="" name="Up_SubjectYear" id="Up_SubjectYear">
                                <option value="">เลือกปีการศึกษา</option>
                                <?php $d = date('Y')+543; for ($i=$d; $i <= $d+1 ; $i++) :?>
                                <option value="1/<?=$i;?>">1/<?=$i;?></option>
                                <option value="2/<?=$i;?>">2/<?=$i;?></option>
                                <option value="3/<?=$i;?>">3/<?=$i;?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="mb-3 col-6 col-lg-6">
                            <label for="setting-input-1" class="form-label">ระดับชั้นที่เปิดสอน
                            </label>
                            <select class="form-select" required="" name="Up_SubjectClass" id="Up_SubjectClass">
                                <option value="">เลือกระดับชั้น</option>
                                <?php $sara = $this->classroom->LevelClass();
                                                foreach ($sara as $key => $v_sara):?>
                                <option value="<?=$v_sara?>"><?=$v_sara?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3 col-6 col-lg-3">
                            <label for="setting-input-1" class="form-label">รหัสวิชา
                            </label>

                            <input type="text" class="form-control"  value="" required=""
                                name="Up_SubjectCode" id="Up_SubjectCode">
                        </div>
                        <div class="mb-3 col-6 col-lg-5">
                            <label for="setting-input-1" class="form-label">ชื่อวิชา
                            </label>
                            <input type="text" class="form-control"  value="" required=""
                                name="Up_SubjectName" id="Up_SubjectName">
                        </div>
                        <div class="mb-3 col-6 col-lg-2">
                            <label for="setting-input-1" class="form-label">หน่วยกิต
                            </label>
                            <input type="text" class="form-control"  value="" required=""
                                name="Up_SubjectUnit" id="Up_SubjectUnit">
                        </div>
                        <div class="mb-3 col-6 col-lg-2">
                            <label for="setting-input-1" class="form-label">จำนวนชั่วโมง
                            </label>
                            <input type="text" class="form-control" value="" required=""
                                name="Up_SubjectHour" id="Up_SubjectHour">
                        </div>
                        <div class="mb-3 col-6 col-lg-4">
                            <label for="setting-input-1" class="form-label">ประเภทวิชา</label>
                            <select class="form-select " required="" name="Up_SubjectType" id="Up_SubjectType">
                                <option value="">เลือกประเภทวิชา</option>
                                <option value="1/พื้นฐาน">1/พื้นฐาน</option>
                                <option value="2/เพิ่มเติม">2/เพิ่มเติม</option>
                            </select>
                        </div>
                        <div class="mb-3 col-6 col-lg-4">
                            <label for="setting-input-1" class="form-label">สาระหลัก</label>
                            <select class="form-select " required="" name="Up_FirstGroup" id="Up_FirstGroup">
                                <option value="">เลือกสาระหลัก</option>
                                <?php $sara = $this->classroom->GroupSaraMain();
                                                foreach ($sara as $key => $v_sara):?>
                                <option value="<?=$v_sara?>"><?=$v_sara?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3 col-6 col-lg-4">
                            <label for="setting-input-1" class="form-label">สาระย่อย</label>
                            <select class="form-select" required="" name="Up_SecondGroup" id="Up_SecondGroup">
                                <option value="">เลือกสาระย่อย</option>
                                <?php $sara = $this->classroom->GroupSaraSecond();
                                                foreach ($sara as $key => $v_sara):?>
                                <option value="<?=$v_sara?>"><?=$v_sara?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary">แก้ไข</button>
                </div>
                </form>
            </div>
        </div>
    </div>