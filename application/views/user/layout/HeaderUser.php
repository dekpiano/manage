<!DOCTYPE html>
<html lang="en">

<head>
    <title><?=$title?> | ระบบงานวิชาการสำหรับนักเรียน</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="<?=$description?>">
    <meta name="author" content="Dekpiano">

    <meta property="og:url" content="<?=$full_url?>" />
    <meta property="og:type" content="Education" />
    <meta property="og:title" content="<?=$title?> | ระบบงานวิชาการสำหรับนักเรียน" />
    <meta property="og:description" content="<?=$description?>" />
    <meta property="og:image" content="<?=$banner?>" />

    <link rel="shortcut icon" href="https://skj.ac.th/uploads/logo/LogoSKJ_4.png">

    <!-- FontAwesome JS-->
    <script defer src="<?=base_url();?>assets/plugins/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="<?=base_url();?>assets/css/portal.css">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.27.0/slimselect.min.css" rel="stylesheet">



    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-FQZZ1NJJMV"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-FQZZ1NJJMV');
    </script>

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
                            ระบบงานวิชาการ
                        </div>
                        <div class="app-utilities col-auto">
                            <div class="app-utility-item app-user-dropdown dropdown">
                                <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#"
                                    role="button" aria-expanded="false">
                                    <img src="<?=base_url();?>uploads/usericon.png" alt="user profile">
                                    เข้าสู่ระบบ
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">

                                    <li><a class="dropdown-item" href="<?=base_url('LoginStudent');?>">นักเรียน</a></li>
                                    <li><a class="dropdown-item" href="http://teacher.skj.ac.th/">ครูผู้สอน</a>
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">ผู้บริหาร</a>
                                    </li>
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
                    <a class="app-logo" href="index.html"><img class="logo-icon me-2"
                            src="https://skj.ac.th/uploads/logo/LogoSKJ_4.png" alt="logo"><span
                            class="logo-text">ACDM
                            SKJ</span></a>

                </div>
                <!--//app-branding-->

                <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
                    <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                        <li class="nav-item">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <a class="nav-link  <?=$this->uri->segment('2')=="Home" ? "active" :""?>"
                                href="<?=base_url();?>">
                                <span class="nav-icon">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z" />
                                        <path fill-rule="evenodd"
                                            d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                                    </svg>
                                </span>
                                <span class="nav-link-text">หน้าแรก</span>
                            </a>
                            <!--//nav-link-->
                        </li>

                        <li class="nav-item has-submenu">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse"
                                data-bs-target="#submenu-2" aria-expanded="false" aria-controls="submenu-2">
                                <span class="nav-icon">
                                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-columns-gap"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M6 1H1v3h5V1zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H1zm14 12h-5v3h5v-3zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5zM6 8H1v7h5V8zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H1zm14-6h-5v7h5V1zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1h-5z" />
                                    </svg>
                                </span>
                                <span class="nav-link-text">ทั่วไป</span>
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
                            <div id="submenu-2" class="collapse submenu submenu-2 show"
                                data-bs-parent="#menu-accordion">
                                <ul class="submenu-list list-unstyled">
                                    <li class="submenu-item "><a
                                            class="submenu-link <?=$this->uri->segment(1) == 'ClassSchedule'?'active':''?> "
                                            href="https://timetable.skj.ac.th/">ตารางเรียน</a></li>
                                    <!-- <li class="submenu-item">ClassSchedule');?>
                                            class="submenu-link <?=$this->uri->segment(1) == 'ExamSchedule'?'active':''?>"
                                            href="<?=base_url('ExamSchedule');?>">ตารางสอบ</ahttp:></li> -->
                                    <li class="submenu-item"><a
                                            class="submenu-link <?=$this->uri->segment(1) == 'ExamSchedule'?'active':''?>"
                                            href="<?=base_url('ExamSchedule');?>">ตารางสอบ</a></li>
                                    <li class="submenu-item"><a
                                            class="submenu-link <?=$this->uri->segment(1) == 'StudentsList'?'active':''?>"
                                            href="<?=base_url('StudentsList');?>">รายชื่อนักเรียน/ครูที่ปรึกษา</a></li>

                                </ul>
                            </div>
                        </li>
                        <!--//nav-item-->

                        <li class="nav-item has-submenu">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <a class="nav-link submenu-toggle <?=$this->uri->segment('2')=="Extra" ? "active" :""?>"
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
                                <span class="nav-link-text">การเรียนการสอน</span>
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
                            <div id="submenu-1" class="collapse submenu submenu-1 show"
                                data-bs-parent="#menu-accordion">
                                <ul class="submenu-list list-unstyled">
                                    <li class="submenu-item ">
                                        <a class="submenu-link <?=$this->uri->segment('1')=="LearningOnline" ? "active" :""?>"
                                            href="<?=base_url('LearningOnline')?>">ห้องเรียนออนไลน์</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a class="submenu-link <?=$this->uri->segment('1')=="ReportLearnOnline" ? "active" :""?>"
                                            href="<?=base_url('ReportLearnOnline')?>">แบบรายงานการสอนออนไลน์</a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <!--//nav-item-->

                    </ul>
                    <!--//app-menu-->
                </nav>

                <div class="app-sidepanel-footer">
                    <nav class="app-nav app-nav-footer">
                        <ul class="app-menu footer-menu list-unstyled">

                            <!--//nav-item-->
                            <li class="nav-item">
                                <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    <span class="nav-icon">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-person"
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M12 1H4a1 1 0 0 0-1 1v10.755S4 11 8 11s5 1.755 5 1.755V2a1 1 0 0 0-1-1zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z">
                                            </path>
                                            <path fill-rule="evenodd" d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
                                        </svg>
                                    </span>
                                    <span class="nav-link-text">เจ้าหน้าที่</span>
                                </a>
                                <!--//nav-link-->
                            </li>
                            <!--//nav-item-->
                        </ul>
                        <!--//footer-menu-->
                    </nav>
                </div>

            </div>
            <!--//sidepanel-inner-->
        </div>
        <!--//app-sidepanel-->
    </header>
    <!--//app-header-->


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="auth-form login-form" method="post" action="<?=base_url('Control_login/LoginAdmin')?>">
                        <div class="email mb-3">
                            <label class="sr-only" for="username">Email</label>
                            <input id="username" name="username" type="email" class="form-control signin-email"
                                placeholder="Email address" required="required">
                        </div>
                        <!--//form-group-->
                        <div class="password mb-3">
                            <label class="sr-only" for="password">Password</label>
                            <input id="password" name="password" type="password" class="form-control signin-password"
                                placeholder="Password" required="required">

                        </div>
                        <!--//form-group-->
                        <div class="text-center">
                            <button type="submit" class="btn app-btn-primary btn-block theme-btn mx-auto">Log
                                In</button>
                        </div>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a href="<?=base_url('LoginMenager')?>">
                            <img src="<?=base_url('assets/images/btn_google_signin.png')?>" alt="" srcset="">
                        </a>
                    </div>


                </div>

            </div>
        </div>
    </div>