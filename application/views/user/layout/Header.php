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
    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="<?=base_url();?>assets/css/theme-1.css">

    

</head>

<body style="font-family: 'Sarabun', sans-serif;" class="theme-bg-light ">

    <header class="header text-center">
        <h1 class="blog-name pt-lg-4 mb-0"><a href="<?=base_url('Student');?>">ระบบงานวิชาการ (นักเรียน)</a></h1>

        <nav class="navbar navbar-expand-lg navbar-dark">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="navigation" class="collapse navbar-collapse flex-column">
                <div class="profile-section pt-3 pt-lg-0">
                    <img class="profile-image mb-3 rounded-circle mx-auto" src="<?=base_url('uploads/usericon.png')?>" alt="image">

                    <div class="bio mb-3"><?=$this->session->userdata('fullname');?><br>
                        <?=$this->session->userdata('class');?>



                        <hr>
                    </div>
                    <!--//profile-section-->

                    <ul class="navbar-nav flex-column text-left">
                    <li class="nav-item ">
                            <a class="nav-link" href="<?=base_url('Student');?>"><i
                                    class="fas fa-home fa-fw mr-2"></i>หน้าแรก </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="<?=base_url('Student/AcademicResult');?>"><i class="fas fa-calculator fa-fw mr-2"></i>ผลการเรียน </a>
                        </li>
                     
                        <hr>
                        <li class="nav-item">
							<a data-toggle="collapse" href="#tables" class="collapsed" aria-expanded="false">
								<i class="fas fa-table"></i>
								<p>Tables</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="tables" style="">
								<ul class="nav nav-collapse">
									<li>
										<a href="tables/tables.html">
											<span class="sub-item">Basic Table</span>
										</a>
									</li>
									<li>
										<a href="tables/datatables.html">
											<span class="sub-item">Datatables</span>
										</a>
									</li>
								</ul>
							</div>
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
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">    
      
      <img src="https://chart.googleapis.com/chart?chs=500x300&cht=qr&chl=<?=$this->session->userdata('StudentCode');?>&choe=UTF-8" title="Link to my Website" />
     
   
    </div>
  </div>
</div>