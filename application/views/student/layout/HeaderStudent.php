<!DOCTYPE html>
<html lang="en">

<head>
    <title><?=$title?> | ระบบงานวิชาการสำหรับนักเรียน</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="ระบบงานวิชาการสำหรับนักเรียน">
    <meta name="author" content="Dekpiano">
    <link rel="shortcut icon" href="https://skj.ac.th/uploads/logo/LogoSKJ_4.png">

    <!-- FontAwesome JS-->
    <script defer src="<?=base_url();?>assets/plugins/fontawesome/js/all.min.js"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="<?=base_url();?>assets/css/portal.css">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400&display=swap" rel="stylesheet">

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
                            ระบบงานวิชาการสำหรับนักเรียน
                        </div>


                        <div class="app-utilities col-auto">
                            <div class="app-utility-item app-user-dropdown dropdown">
                                <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#"
                                    role="button" aria-expanded="false">
                                    <?=$this->session->userdata('fullname');?> <img
                                        src="<?=base_url();?>uploads/usericon.png" alt="user profile"></a>
                                <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
                                    <!-- <li><a class="dropdown-item" href="account.html">Account</a></li>
                                    <li><a class="dropdown-item" href="settings.html">Settings</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li> -->
                                    <li><a class="dropdown-item" href="<?=base_url('Logout');?>">Log Out</a></li>
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
                            <a class="Loader nav-link  <?=$this->uri->segment('2')=="Home" ? "active" :""?>"
                                href="<?=base_url('Student/Home');?>">
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
                        <li class="nav-item">
                           
                            <a class="Loader nav-link <?=$this->uri->segment('2')=="AcademicResult" ? "active" :""?>"
                                href="<?=base_url('Student/AcademicResult');?>">
                                <span class="nav-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-file-earmark-text" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z" />
                                        <path
                                            d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                                    </svg>
                                </span>
                                <span class="nav-link-text">ผลการเรียน</span>
                            </a>                         
                        </li>

                        <!-- <li class="nav-item has-submenu">
                            <a class="nav-link submenu-toggle <?=$this->uri->segment('2')=="Extra" ? "active" :""?>"
                                href="#" data-bs-toggle="collapse" data-bs-target="#submenu-1" aria-expanded="false"
                                aria-controls="submenu-1">
                                <span class="nav-icon">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-files"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4 2h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4z" />
                                        <path
                                            d="M6 0h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1H4a2 2 0 0 1 2-2z" />
                                    </svg>
                                </span>
                                <span class="nav-link-text">ลงทะเบียนวิชาเพิ่มเติม</span>
                                <span class="submenu-arrow">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </span>
                            </a>
                            <div id="submenu-1"
                                class="collapse submenu submenu-1 <?=$this->uri->segment('2')=="Extra" ? "show" :""?>"
                                data-bs-parent="#menu-accordion">
                                <ul class="submenu-list list-unstyled">
                                    <li class="submenu-item ">
                                        <a class="submenu-link <?=$this->uri->segment('3')=="ReadMe" ? "active" :""?>"
                                            href="<?=base_url('Student/Extra/ReadMe')?>">อ่านก่อนแนะนำ</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <?php if($ExtraSetting[0]->extra_setting_onoff === 'true'):?>
                                        <a class="submenu-link <?=$this->uri->segment('3')=="Subject" ? "active" :""?>"
                                            href="<?=base_url('Student/Extra/Subject')?>">รายชื่อวิชาเลือกเพิ่มเติม</a>
                                        <?php else: ?>
                                        <a class="submenu-link <?=$this->uri->segment('3')=="Subject" ? "active" :""?>"
                                            href="#" onclick="AlertOnoff()">รายชื่อวิชาเลือกเพิ่มเติม</a>
                                        <?php endif; ?>
                                    </li>
                                    <li class="submenu-item ">
                                        <a class="submenu-link <?=$this->uri->segment('3')=="CheckRegister" ? "active" :""?>"
                                            href="<?=base_url('Student/Extra/CheckRegister')?>">ตรวจสอบการลงทะเบียน</a>
                                    </li>

                                </ul>
                            </div>
                        </li> -->
                        <!--//nav-item-->

                    </ul>
                    <!--//app-menu-->
                </nav>

            </div>
            <!--//sidepanel-inner-->
        </div>
        <!--//app-sidepanel-->
    </header>
    <!--//app-header-->