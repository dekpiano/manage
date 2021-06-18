<!doctype html>
<html lang="en" class="h-100">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <title>Welcome to Academic | SKJ</title>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@700&display=swap" rel="stylesheet">
    <style type="text/css">
    body {
        background-color: #e6edf7;
        font-family: 'Sarabun';
    }

    .service-24 {
        font-family: "Sarabun", sans-serif;
        color: #28a745;
        font-weight: 300;
    }

    .service-24 h1,
    .service-24 h2,
    .service-24 h3,
    .service-24 h4,
    .service-24 h5,
    .service-24 h6 {
        color: #3e4555;
    }

    .service-24 .card.card-shadow {
        -webkit-box-shadow: 0px 0px 30px rgba(115, 128, 157, 0.1);
        box-shadow: 0px 0px 30px rgba(115, 128, 157, 0.1);
    }

    .service-24 a {
        text-decoration: none;
    }

    .service-24 .card-hover:hover {
        background: #28a745;
        background: -webkit-linear-gradient(legacy-direction(to right), #28a745 0%, #227335 100%);
        background: -webkit-gradient(linear, left top, right top, from(#28a745), to(#227335));
        background: -webkit-linear-gradient(left, #28a745 0%, #227335 100%);
        background: -o-linear-gradient(left, #28a745 0%, #227335 100%);
        background: linear-gradient(to right, #28a745 0%, #227335 100%);
    }

    .service-24 .card-hover:hover .bg-success-grediant {
        color: #ffffff;
        text-fill-color: #ffffff;
        -webkit-text-fill-color: #ffffff;
    }

    .service-24 .card-hover:hover .ser-title {
        color: #ffffff;
    }

    .service-24 .bg-success-grediant {
        background: #28a745;
        background: -webkit-linear-gradient(legacy-direction(to right), #28a745 0%, #227335 100%);
        background: -webkit-gradient(linear, left top, right top, from(#28a745), to(#227335));
        background: -webkit-linear-gradient(left, #28a745 0%, #227335 100%);
        background: -o-linear-gradient(left, #28a745 0%, #227335 100%);
        background: linear-gradient(to right, #28a745 0%, #227335 100%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        text-fill-color: transparent;
        font-size: 50px;
    }

    .service-24 .wrap-service-24 .card {
        -o-transition: 0.3s ease-out;
        transition: 0.3s ease-out;
        -webkit-transition: 0.3s ease-out;
    }

    .service-24 .wrap-service-24 .card:hover {
        -ms-transform: translateY(-10px);
        transform: translateY(-10px);
        -webkit-transform: translateY(-10px);
    }

    .service-24 .btn-outline-success {
        color: #28a745 !important;
        background-color: transparent;
        border-color: #28a745;
    }

    .service-24 .btn-outline-success:hover {
        background: #28a745;
        border-color: #28a745;
        color: #ffffff !important;
    }

    .service-24 .btn-md {
        padding: 15px 45px;
        font-size: 16px;
    }

    .site-heading h2 {
        display: block;
        font-weight: 700;
        margin-bottom: 10px;
        text-transform: uppercase;
    }

    .site-heading h2 span {
        color: #00a01d;
    }

    .site-heading h4 {
        display: inline-block;
        padding-bottom: 20px;
        position: relative;
        text-transform: capitalize;
        z-index: 1;
    }

    .site-heading h4::before {
        background: #00a01d none repeat scroll 0 0;
        bottom: 0;
        content: "";
        height: 2px;
        left: 50%;
        margin-left: -25px;
        position: absolute;
        width: 50px;
    }

    .site-heading {
        margin-bottom: 60px;
        overflow: hidden;
        margin-top: -5px;
    }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <div class="service-24">
        <div class="container mt-5">

            <div class="row">
                <div class="col-md-6 align-self-center">
                    <img src="<?=base_url('assets/images/img-home.png');?>" alt="" srcset="" class="img-fluid">
                </div>
                <div class="col-md-6 align-self-center">
                    <div class="site-heading text-center">
                        <h2>ระบบงาน <span>วิชาการ</span></h2>
                        <h4>โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์</h4>
                    </div>
                </div>
            </div>

            <div class="row wrap-service-24">


                <!-- Column -->
                <!-- Column -->
                <div class="col-md-4  ">
                    <div class="card card-shadow border-0 mb-4">
                        <a href="<?=base_url('ClassSchedule');?>" class="card-hover py-4 text-center d-block rounded">
                            <span class="bg-success-grediant"><i class="fas fa-calendar-alt"></i></span>
                            <h6 class="ser-title">ตารางเรียน</h6>
                        </a>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-md-4  ">
                    <div class="card card-shadow border-0 mb-4">
                        <a href="<?=base_url('ExamSchedule');?>" class="card-hover py-4 text-center d-block rounded">
                            <span class="bg-success-grediant"><i class="far fa-calendar-alt"></i></span>
                            <h6 class="ser-title">ตารางสอบ</h6>
                        </a>
                    </div>
                </div>
                <div class="col-md-4  ">
                    <div class="card card-shadow border-0 mb-4">
                        <a href="<?=base_url('StudentsList');?>" class="card-hover py-4 text-center d-block rounded">
                            <span class="bg-success-grediant"><i class="fas fa-clipboard-list"></i></i></span>
                            <h6 class="ser-title">รายชื่อนักเรียน</h6>
                        </a>
                    </div>
                </div>

                <!-- Column -->
                <div class="col-md-4 ">
                    <div class="card rounded card-shadow border-0 mb-4">
                        <a href="<?=base_url('LoginStudent');?>" class="card-hover py-4 text-center d-block rounded">
                            <span class="bg-success-grediant"><i class="fas fa-user-graduate"></i></span>
                            <h6 class="ser-title">สำหรับนักเรียน</h6>
                            <!-- <small class="ser-title">อัพเดพข้อมูล 12/01/2564</small> -->
                        </a>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-md-4  ">
                    <div class="card card-shadow border-0 mb-4">
                        <a href="<?=base_url('LoginTeacher');?>" class="card-hover py-4 text-center d-block rounded">
                            <span class="bg-success-grediant"><i class="fas fa-chalkboard-teacher"></i></span>
                            <h6 class="ser-title">สำหรับครู</h6>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer mt-auto py-3">
        <div class="container">
            <span class="text-muted">Powered by Dekpiano © โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์ 2020 | <a
                    href="#" data-toggle="modal" data-target="#exampleModal">สำหรับเจ้าหน้าที่</a> </span>
        </div>
    </footer>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

</body>

</html>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <form class="form-signin" method="post" action="<?=base_url('Control_login/LoginAdmin');?>">
                    <div class="form-label-group">
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username"
                            required="" autofocus="">
                        <label for="username"></label>
                    </div>

                    <div class="form-label-group">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password"
                            required="">
                        <label for="password"></label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

                </form>
            </div>

        </div>
    </div>
</div>