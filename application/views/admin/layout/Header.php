<!DOCTYPE html>
<html lang="en">

<head>
    <title><?=$title?> | ระบบงานสารสนเทศโรงเรียน</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="ระบบงานวิชาการสำหรับนักเรียน">
    <meta name="author" content="Dekpiano">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- FontAwesome JS-->
    <script defer src="<?=base_url();?>assets/plugins/fontawesome/js/all.min.js"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="<?=base_url();?>assets/css/portal.css">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
        rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.27.0/slimselect.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <style>
    .btn-group-xs>.btn,
    .btn-xs {
        line-height: 1.5;
    }

    .toggle.ios,
    .toggle-on.ios,
    .toggle-off.ios {
        border-radius: 20rem;
    }

    .toggle.ios .toggle-handle {
        border-radius: 20rem;
    }
    </style>
</head>

<body class="app" style="font-family: 'Sarabun', sans-serif;">
    <header class="app-header fixed-top">
        <div class="app-header-inner">
            <div class="container-fluid py-2">
                <div class="app-header-content">
                    <div class="row justify-content-between align-items-center">

                        <div class="col-auto">
                            <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                    role="img">
                                    <title>Menu</title>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                        stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                                </svg>
                            </a>
                        </div>
                        <div class="app-search-box col">
                            ระบบงานวิชาการ สำหรับ Admin และเจ้าหน้าที่
                        </div>


                        <div class="app-utilities col-auto">
                            <div class="app-utility-item app-user-dropdown dropdown">
                                <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#"
                                    role="button" aria-expanded="false">
                                    <?=$this->session->userdata('fullname');?> <img
                                        src="<?=base_url();?>uploads/usericon.png" alt="user profile"></a>
                                <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
                                    <li><a class="dropdown-item" href="account.html">Account</a></li>
                                    <li><a class="dropdown-item" href="settings.html">Settings</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="<?=base_url('LogoutTeacher');?>">Log Out</a></li>
                                </ul>
                            </div>
                            <!--//app-user-dropdown-->
                        </div>
                        <!--//app-utilities-->
                    </div>
                    <!--//row-->
                </div>
                <!--//app-header-content-->
            </div>
            <!--//container-fluid-->
        </div>
        <!--//app-header-inner-->
        <div id="app-sidepanel" class="app-sidepanel">
            <div id="sidepanel-drop" class="sidepanel-drop"></div>
            <div class="sidepanel-inner d-flex flex-column">
                <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
                <div class="app-branding">
                    <a class="app-logo" href="<?=base_url('Admin/Home');?>"><img class="logo-icon me-2"
                            src="<?=base_url();?>assets/images/app-logo.svg" alt="logo"><span class="logo-text">ACDM
                            SKJ</span></a>
                </div>
                <!--//app-branding-->

                <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
                    <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                        <li class="nav-item">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <a class="nav-link  <?=$this->uri->segment('2')=="Home" ? "active" :""?>"
                                href="<?=base_url('Admin/Home');?>">
                                <span class="nav-icon">
                                    <i class="bi bi-house-fill" style="font-size: 1.2rem;"></i>
                                </span>
                                <span class="nav-link-text">หน้าแรก</span>
                            </a>
                            <!--//nav-link-->
                        </li>

                        <li class="nav-item has-submenu">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <a class="nav-link submenu-toggle <?=$this->uri->segment('2')=="Registration" ? "active" :""?>"
                                href="#" data-bs-toggle="collapse" data-bs-target="#submenu-2" aria-expanded="false"
                                aria-controls="submenu-2">
                                <span class="nav-icon">
                                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-columns-gap"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M6 1H1v3h5V1zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H1zm14 12h-5v3h5v-3zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5zM6 8H1v7h5V8zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H1zm14-6h-5v7h5V1zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1h-5z" />
                                    </svg>
                                </span>
                                <span class="nav-link-text">งานทะเบียน</span>
                                <span class="submenu-arrow">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </span>
                                <!--//submenu-arrow-->
                            </a>
                            <!--//nav-link-->
                            <div id="submenu-2"
                                class="collapse submenu submenu-2 <?=$this->uri->segment('2')=="Registration" ? "show" :""?>"
                                data-bs-parent="#menu-accordion">
                                <ul class="submenu-list list-unstyled">
                                    <li class="submenu-item"><a
                                            class="submenu-link <?=$this->uri->segment('3')=="Enroll" ? "active" :""?>"
                                            href="<?=base_url('Admin/Registration/Enroll');?>">ลงทะเบียนเรียน</a>
                                    </li>
                                    <li class="submenu-item"><a
                                            class="submenu-link <?=$this->uri->segment('3')=="RegisterSubject" ? "active" :""?>"
                                            href="<?=base_url('Admin/Registration/RegisterSubject');?>">จัดการวิชาเรียน</a>
                                    </li>
                                    <li class="submenu-item"><a
                                            class="submenu-link <?=$this->uri->segment('3')=="ClassRoom" ? "active" :""?>"
                                            href="<?=base_url('Admin/Registration/ClassRoom');?>">จัดการห้องเรียน /
                                            ที่ปรึกษา</a>
                                    </li>
                                    <li class="submenu-item"><a
                                            class="submenu-link <?=$this->uri->segment('3')=="Students" ? "active" :""?>"
                                            href="<?=base_url('Admin/Registration/Students');?>">จัดการนักเรียน</a></li>
                                    <!-- <li class="submenu-item"><a
                                            class="submenu-link <?=$this->uri->segment('3')=="ExtraSubject" ? "active" :""?>"
                                            href="<?=base_url('Admin/Registration/ExtraSubject');?>">ลงทะเบียนวิชาเพิ่มเติม</a>
                                    </li> -->

                                    <li class="submenu-item"><a
                                            class="submenu-link <?=$this->uri->segment('3')=="ExamSchedule" ? "active" :""?>"
                                            href="<?=base_url('Admin/Registration/ExamSchedule');?>">จัดการตารางสอบ</a></li>
                                    <li class="submenu-item"><a
                                            class="submenu-link <?=$this->uri->segment('3')=="ClassSchedule" ? "active" :""?>"
                                            href="<?=base_url('Admin/Registration/ClassSchedule');?>">จัดการตารางเรียน</a></li>
                                    <li class="submenu-item"><a
                                            class="submenu-link <?=$this->uri->segment('3')=="ExtraSubject" ? "active" :""?>"
                                            href="<?=base_url('Admin/Registration/RoomOnline');?>">จัดการห้องเรียนออนไลน์</a>
                                    </li>
                                  
                                </ul>
                            </div>
                        </li>
                        <!--//nav-item-->

                        <li class="nav-item has-submenu">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <a class="nav-link submenu-toggle <?=$this->uri->segment('2')=="Evaluate" ? "active" :""?>"
                                href="#" data-bs-toggle="collapse" data-bs-target="#submenu-1" aria-expanded="false"
                                aria-controls="submenu-1">
                                <span class="nav-icon">
                                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-files"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4 2h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4z" />
                                        <path
                                            d="M6 0h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1H4a2 2 0 0 1 2-2z" />
                                    </svg>
                                </span>
                                <span class="nav-link-text">งานวัดและประเมินผล</span>
                                <span class="submenu-arrow">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </span>
                                <!--//submenu-arrow-->
                            </a>
                            <!--//nav-link-->
                            <div id="submenu-1"
                                class="collapse submenu submenu-1 <?=$this->uri->segment('2')=="Evaluate" ? "show" :""?>"
                                data-bs-parent="#menu-accordion">
                                <ul class="submenu-list list-unstyled">
                                    <li class="submenu-item"><a
                                            class="submenu-link <?=$this->uri->segment('3')=="AcademicResult" ? "active" :""?>"
                                            href="<?=base_url('Admin/Evaluate/AcademicResult');?>">จัดการผลการเรียน</a>
                                    </li>

                                    <li class="submenu-item"><a
                                            class="submenu-link <?=$this->uri->segment('3')=="SaveScore" ? "active" :""?>"
                                            href="<?=base_url('Admin/Evaluate/SaveScore');?>">จัดการบันทึกผลการเรียน</a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <!--//nav-item-->

                        <li class="nav-item has-submenu">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <a class="nav-link submenu-toggle <?=$this->uri->segment('2')=="Extra" ? "active" :""?>"
                                href="#" data-bs-toggle="collapse" data-bs-target="#submenu-3" aria-expanded="false"
                                aria-controls="submenu-3">
                                <span class="nav-icon">
                                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-files"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4 2h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4z" />
                                        <path
                                            d="M6 0h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1H4a2 2 0 0 1 2-2z" />
                                    </svg>
                                </span>
                                <span class="nav-link-text">งานหลักสูตร</span>
                                <span class="submenu-arrow">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </span>
                                <!--//submenu-arrow-->
                            </a>
                            <!--//nav-link-->
                            <div id="submenu-3"
                                class="collapse submenu submenu-3 <?=$this->uri->segment('2')=="Affairs" ? "show" :""?>"
                                data-bs-parent="#menu-accordion">
                                <ul class="submenu-list list-unstyled">
                                    <li class="submenu-item ">
                                        <a class="submenu-link <?=$this->uri->segment('5')=="Setting" ? "active" :""?>"
                                            href="#">กำลังพัฒนา</a>

                                    </li>

                                </ul>
                            </div>
                        </li>
                        <!--//nav-item-->
                        <li class="nav-item ">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <a class="nav-link <?=$this->uri->segment('3')=="AdminRoles" ? "active" :""?>"
                                href="<?=base_url('Admin/Setting/AdminRoles');?>">
                                <span class="nav-icon">
                                    <i class="bi bi-gear-fill" style="font-size: 1.2rem;"></i>
                                </span>
                                <span class="nav-link-text">จัดการบทบาทในวิชาการ</span>
                            </a>
                            <!--//nav-link-->
                        </li>
                    </ul>
                    <!--//app-menu-->
                </nav>

            </div>
            <!--//sidepanel-inner-->
        </div>
        <!--//app-sidepanel-->
    </header>
    <!--//app-header-->