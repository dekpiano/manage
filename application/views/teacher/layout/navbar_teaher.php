<div class="page-content d-flex align-items-stretch">
    <!-- Side Navbar -->
    <nav class="side-navbar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
            <div class="avatar"><img src="https://skj.ac.th/uploads/personnel/<?=$this->session->userdata('img');?>"
                    alt="..." class="img-fluid rounded-circle"></div>
            <div class="title">
                <h1 class="h4"><?=$this->session->userdata('fullname');?> </h1>
                <p><?=$this->session->userdata('class');?></p>
                
            </div>
        </div>       
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
            <li class=" <?=$this->uri->segment(2) == 'Home' ? 'active' : '' ?>">
                <a href="<?=base_url('Teacher/Home');?>"> <i class="icon-home"></i>หน้าแรก </a>
            </li>
            <li class=" <?=$this->uri->segment(2) == 'Course' ? 'active' : '' ?>">
                <a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i
                        class="icon-interface-windows"></i>งานหลักสูตร </a>
                <ul id="exampledropdownDropdown"
                    class="collapse list-unstyled  <?=$this->uri->segment(2) == 'Course' ? 'show' : '' ?>">
                    <li><a href="<?=base_url('Teacher/Course');?>"><i class="fa fa-file" aria-hidden="true"></i>
                            แผนการสอน</a>
                    </li>
                    <?php if($this->session->userdata('groupleade') == 1 || $this->session->userdata('login_id') == 'pers_003' || $this->session->userdata('login_id') == 'pers_002') : ?>
                    <span class="heading">สำหรับหัวหน้า</span>
                    <li>
                        <a href="<?=base_url('Teacher/Course/CheckPlan');?>"> <i class="icon-flask"></i>ตรวจงาน </a>
                        <a href="<?=base_url('Teacher/Course/ReportPlan');?>"> <i class="fa fa-print"
                                aria-hidden="true"></i>รายงาน </a>
                        <?php if($this->session->userdata('login_id') == 'pers_014'): ?>
                        <a href="<?=base_url('Teacher/Course/Setting');?>"> <i class="fa fa-cogs"></i>ตั้งค่า </a>
                        <?php endif; ?>
                    </li>
                    <?php endif; ?>

                </ul>
            </li>
        </ul>



    </nav>

    <div class="content-inner">