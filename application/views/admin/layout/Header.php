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
    <!-- /<link rel="shortcut icon" href="favicon.ico"> -->

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

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="<?=base_url();?>assets/css/datepicker.css?v=1">

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

    .loader {
        position: fixed;
        z-index: 99;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: white;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .loader>img {
        width: 100px;
    }

    .loader.hidden {
        animation: fadeOut 0.1s;
        animation-fill-mode: forwards;
    }

    @keyframes fadeOut {
        100% {
            opacity: 0;
            visibility: hidden;
        }
    }
    </style>
</head>

<div class="loader" style="display:none;">
    <img src="https://boychawin.com/irms/images/VAyR.gif" alt="Loading..." />
    อาจใช้เวลาในการโหลดข้อมูล 1 - 2 นาที กรุณรอ...
</div>

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
                        
                        <?php $this->load->view('admin/layout/Header_Academic.php'); ?>
                        <hr>
                       

                        <?php if($this->session->userdata('CheckrloesAcademic') == 'ผู้บริหาร' && $this->session->userdata('status') === 'manager' || $this->session->userdata('login_id') === 'pers_021' || $this->session->userdata('CheckrloesAcademic') == 'รองวิชาการ'): ?>
                        <?php $this->load->view('admin/layout/Header_executive.php'); ?>
                        <?php endif; ?>

                    </ul>
                    <!--//app-menu-->
                </nav>

            </div>
            <!--//sidepanel-inner-->
        </div>
        <!--//app-sidepanel-->
    </header>
    <!--//app-header-->