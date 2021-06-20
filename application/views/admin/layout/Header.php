<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบงานวิชาการ | SKJ</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Blog Template">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- FontAwesome JS-->

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="https://demo.voidcoders.com/htmldemo/fitgear/main-files/assets/css/animate.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="<?=base_url();?>assets/css/theme-2.css">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
        rel="stylesheet">
    <style>
    .btn {
        height: 2.2rem;
    }

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

    /* width */
    ::-webkit-scrollbar {
        width: 5px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    header {
        overflow: auto;
    }

    .form-control {
        padding-top: 0rem;
        padding-bottom: 0rem;
    }
    </style>
</head>

<body style="font-family: 'Sarabun', sans-serif;" class="theme-bg-light ">

    <header class="header text-center">
        <h1 class="blog-name pt-lg-4 mb-0"><a href="<?=base_url('Home');?>">ระบบงานวิชาการ (Admin)</a></h1>

        <nav class="navbar navbar-expand-lg navbar-dark">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="navigation" class="collapse navbar-collapse flex-column">
                <div class="profile-section pt-3 pt-lg-0">
                    <img class="profile-image mb-3 rounded-circle mx-auto w-50"
                        src="https://skj.ac.th/uploads/personnel/<?=$admin[0]->pers_img;?>" alt="image">

                    <div class="bio mb-3"><?=$this->session->userdata('fullname');?><br>
                        <?=$this->session->userdata('class');?>



                        <hr>
                    </div>
                    <!--//profile-section-->

                    <ul class="navbar-nav flex-column text-left">
                        <li class="nav-item ">
                            <a class="nav-link" href="<?=base_url('AdminHome');?>"><i
                                    class="fas fa-home fa-fw mr-2"></i>หน้าแรก </a>
                        </li>                       
                       
                        <hr>
                        <li class="nav-item ">
                            <a class="nav-link" href="<?=base_url('Admin/AcademicResult');?>"><i
                                    class="fas fa-table fa-fw mr-2"></i>ผลการเรียน </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="<?=base_url('Admin/ClassSchedule');?>"><i
                                    class="fas fa-table fa-fw mr-2"></i>ตารางเรียน </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="<?=base_url('Admin/ExamSchedule');?>"><i
                                    class="fas fa-table fa-fw mr-2"></i>ตารางสอบ </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="<?=base_url('Admin/ClassRoom');?>"><i
                                    class="fas fa-table fa-fw mr-2"></i>ห้องเรียน / ที่ปรึกษา </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="<?=base_url('Admin/ExtraSubject');?>"><i
                                    class="fas fa-table fa-fw mr-2"></i>ลงทะเบียนวิชาเพิ่มเติม </a>
                        </li>
                        <hr>
                        <li class="nav-item ">
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModalCenter"><i
                                    class="fas fa-qrcode fa-fw mr-2"></i>QR Code </a>
                        </li>


                    </ul>

                    <div class="my-2 my-md-3">
                        <a class="btn btn-primary" href="<?=base_url('Logout');?>">ออกจากระบบ</a>
                    </div>
                </div>

        </nav>
    </header>


    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <img src="https://chart.googleapis.com/chart?chs=500x300&cht=qr&chl=<?=$this->session->userdata('StudentCode');?>&choe=UTF-8"
                    title="Link to my Website" />


            </div>
        </div>
    </div>