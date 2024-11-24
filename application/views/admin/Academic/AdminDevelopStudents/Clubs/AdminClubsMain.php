<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <div class="container mt-4">
                <!-- Dashboard Header -->
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mb-4">
                        <h1 class="h3">แดชบอร์ดระบบชุมนุม</h1>
                        <p class="text-muted">ภาพรวมข้อมูลเกี่ยวกับชุมนุม</p>

                    </div>

                    <div class="d-flex">
                    <div class="app-utility-item app-user-dropdown dropdown">
                            <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#"
                                role="button" aria-expanded="false"><i class="bi bi-gear-fill icon"></i> ตั้งค่าพื้นฐาน</a>
                            <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle" style="">
                                <li><a class="dropdown-item" href="#" id="MenuSetDateAttendancer">ตั้งค่าเวลาเรียน</a></li>
                            </ul>
                        </div>

                        <div class="app-utility-item app-user-dropdown dropdown">
                            <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#"
                                role="button" aria-expanded="false"><i class="bi bi-gear-fill icon"></i> ตั้งค่าระบบ</a>
                            <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle" style="">
                                <li><a class="dropdown-item" href="#" id="MenuSetYear">ตั้งค่าปีการศึกษา</a></li>
                                <li><a class="dropdown-item" href="#" id="MenuSetDateRegister">ตั้งค่าเปิด-ปิดระบบ</a>
                                </li>

                            </ul>
                        </div>

                        <a class="btn app-btn-primary"
                            href="<?=base_url('Admin/Acade/DevelopStudents/Clubs/All')?>"><i class="bi bi-menu-button-wide"></i> จัดการชุมนุม</a>
                    </div>
                </div>

                <?php $Status = $StatusOnoffClub == "เปิด"?"success":"danger";
                $Icon = $StatusOnoffClub == "เปิด"?'<i class="bi bi-check-circle"></i>':'<i class="bi bi-x-circle"></i>';
                ?>
                <div class="">
                    <div class="app-card app-card-chart h-100 shadow-sm mb-3 ">
                        <div class="app-card-header p-3 bg-<?=$Status?> text-white">
                            <?php $ExYearClub = explode('/',$CheckOnoffClub->c_onoff_year); ?>
                            กำหนดการลงทะเบียนกิจกรรมชุมนุม ภาคเรียนที่ <?=$ExYearClub[1]?> ปีการศึกษา
                            <?=$ExYearClub[0]?>
                        </div>
                        <div class="app-card-body p-3 p-lg-4 d-flex justify-content-between align-items-center">
                            <div>
                                <div>เปิดวันที่
                                    <span class="fw-bold">
                                        <?php echo $this->datethai->thai_date_and_time(strtotime($CheckOnoffClub->c_onoff_regisstart)) ?>
                                    </span>

                                </div>
                                <div>ถึงวันที่
                                    <span class="fw-bold">
                                        <?php echo $this->datethai->thai_date_and_time(strtotime($CheckOnoffClub->c_onoff_regisend)) ?>
                                    </span>
                                </div>
                            </div>
                            <div>
                                
                                <a class=" text-white btn btn-<?=$Status;?>"
                                    href="https://themes.3rdwavemedia.com/bootstrap-templates/admin-dashboard/portal-free-bootstrap-admin-dashboard-template-for-developers/">สถานะ
                                    : <?=$Icon?> <?=$StatusOnoffClub;?>ลงทะเบียน</a>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- Cards Section -->
                <div class="row">
                    <!-- Card 1: ชุมนุมทั้งหมด -->
                    <div class="col-md-3 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <div class="card-icon bg-primary mb-3">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h5 class="card-title">ชุมนุมทั้งหมด</h5>
                                <h2><?=count($TotalClubs);?></h2>
                                <p class="text-muted">ปีการศึกษา 2567</p>
                                <p>
                                    <a class="btn btn-primary"
                                        href="<?=base_url('Admin/Acade/DevelopStudents/Clubs/All')?>">ดูทั้งหมด</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: นักเรียนทั้งหมด -->
                    <div class="col-md-3 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <div class="card-icon bg-success mb-3">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                                <h5 class="card-title">นักเรียนลงทะเบียน</h5>
                                <h2><?=($TotalStudent[0]->StudentAll);?></h2>
                                <p class="text-muted">ทั้งหมด</p>
                                <p><button class="btn btn-success BtnShowStudent" id="BtnShowStudent">ดูทั้งหมด</button>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: ครูที่ปรึกษา -->
                    <div class="col-md-3 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <div class="card-icon bg-warning mb-3">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <h5 class="card-title">ครูที่ปรึกษาชุมนุม</h5>
                                <h2><?=($TotalTeacher[0]->total_advisors);?></h2>
                                <p class="text-muted">ในระบบ</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: ชุมนุมยอดนิยม -->
                    <div class="col-md-3 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <div class="card-icon bg-danger mb-3">
                                    <i class="fas fa-star"></i>
                                </div>
                                <h5 class="card-title">ชุมนุมยอดนิยม</h5>
                                <h2><?=$ClubPopula->club_name?></h2>
                                <p class="text-muted"><?=$ClubPopula->total_members?> คน</p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


        </div>
    </div>


    <!-- Modal ดูนักเรียนที่ลงทะเบียน -->
    <div class="modal fade" id="ModalShowStudentRegisterToClub" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">รายชื่อนักเรียนที่ลงทะเบียนชุมนุม</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="classFilter" class="form-label">เลือกห้องเรียน</label>
                        <select id="classFilter" class="">
                            <option value="">ทั้งหมด</option>
                            <!-- Options จะถูกสร้างด้วยข้อมูลห้องเรียนจากฐานข้อมูล -->
                        </select>
                    </div>
                    <table id="TbStudentRegisterClub" class="table table-bordered table-hover w-100">
                        <thead>
                            <tr>
                                <th>รหัสนักเรียน</th>
                                <th>ชื่อนักเรียน</th>
                                <th>เลขที่</th>
                                <th>ห้องเรียน</th>
                                <th>ชุมนุม</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <?php  $this->load->view('admin/Academic/AdminDevelopStudents/Clubs/AdminClubSetYear.php'); ?>
    <?php  $this->load->view('admin/Academic/AdminDevelopStudents/Clubs/AdminClubSetDateRegister.php'); ?>
    <?php  $this->load->view('admin/Academic/AdminDevelopStudents/Clubs/AdminClubSetDateAttendance.php'); ?>