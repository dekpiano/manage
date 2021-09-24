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
                                    $G = array_unique(array($GG));
                                    echo '<pre>';print_r($G);
                                ?>	
                                <?php endforeach; ?>		  
								
							    </div>                
                                    <div class="col-auto">
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
                                    </div>
                                </div>
                                <!--//row-->
                            </div>
                            <!--//table-utilities-->
                        </div>
                        <!--//col-auto-->
                    </div>
                    <!--//row-->

                    <div class="row">
                        <div class="col-md-5">
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
                                    <form class="settings-form row">
                                        <div class="mb-3 col-6">
                                            <label for="setting-input-1" class="form-label">ปีการศึกษา</label>
                                            <select class="form-select w-auto" required="">
                                                <option value="">เลือกปีการศึกษา</option>
                                                <?php $d = date('Y')+543; for ($i=$d; $i <= $d+1 ; $i++) :?>
                                                <option value="1/<?=$i;?>">1/<?=$i;?></option>
                                                <option value="2/<?=$i;?>">2/<?=$i;?></option>
                                                <option value="3/<?=$i;?>">3/<?=$i;?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="setting-input-1" class="form-label">ระดับชั้นที่เปิดสอน
                                            </label>
                                            <select class="form-select w-auto" required="">
                                                <option value="">เลือกระดับชั้น</option>
                                                <?php $sara = $this->classroom->LevelClass();
                                                foreach ($sara as $key => $v_sara):?>
                                                <option value="<?=$v_sara?>"><?=$v_sara?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="setting-input-1" class="form-label">รหัสวิชา
                                            </label>
                                            <input type="text" class="form-control" id="setting-input-1" value=""
                                                required="">
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="setting-input-1" class="form-label">ชื่อวิชา
                                            </label>
                                            <input type="text" class="form-control" id="setting-input-1" value=""
                                                required="">
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="setting-input-1" class="form-label">หน่วยกิต
                                            </label>
                                            <input type="text" class="form-control" id="setting-input-1" value=""
                                                required="">
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="setting-input-1" class="form-label">จำนวนชั่วโมง
                                            </label>
                                            <input type="text" class="form-control" id="setting-input-1" value=""
                                                required="">
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="setting-input-1" class="form-label">ประเภทวิชา</label>
                                            <select class="form-select w-auto" required="">
                                                <option value="">เลือกประเภทวิชา</option>
                                                <option value="1/พื้นฐาน">1/พื้นฐาน</option>
                                                <option value="2/เพิ่มเติม">2/เพิ่มเติม</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="setting-input-1" class="form-label">สาระหลัก</label>
                                            <select class="form-select " required="">
                                                <option value="">เลือกสาระหลัก</option>
                                                <?php $sara = $this->classroom->GroupSaraMain();
                                                foreach ($sara as $key => $v_sara):?>
                                                <option value="<?=$v_sara?>"><?=$v_sara?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="setting-input-1" class="form-label">สาระย่อย</label>
                                            <select class="form-select w-auto" required="">
                                                <option value="">เลือกสาระหลัก</option>
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
                        <div class="col-md-7">
                            <div class="app-card app-card-orders-table shadow-sm mb-5">
                                <div class="app-card-body">
                                    <div class="table-responsive p-3">
                                        <table class="table app-table-hover mb-0 text-left" id="example">
                                            <thead>
                                                <tr>
                                                    <th class="cell">ปีการศึกษา</th>
                                                    <th class="cell">รหัสวิชา</th>
                                                    <th class="cell">ชื่อวิชา</th>
                                                    <th class="cell">สาระ</th>
                                                    <th class="cell">ชั้น</th>
                                                    <th class="cell"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($subject as $key => $v_subject):?>
                                                <tr>
                                                    <td class="cell"><?=$v_subject->SubjectYear?></td>
                                                    <td class="cell"><span class="truncate"><?=$v_subject->SubjectCode?></span></td>
                                                    <td class="cell"><?=$v_subject->SubjectName?></td>
                                                    <td class="cell"><?=$v_subject->FirstGroup?></td>
                                                    <td class="cell"><?=$v_subject->SubjectClass?></td>

                                                    <td class="cell"><a class="btn-sm app-btn-secondary"
                                                            href="#">View</a></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--//table-responsive-->

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