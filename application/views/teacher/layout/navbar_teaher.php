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
        <ul class="list-unstyled">
            <li class=" <?=$this->uri->segment(2) == 'Home' ? 'active' : '' ?>">
                <a href="<?=base_url('Teacher/Home');?>"> <i class="icon-home"></i>หน้าแรก </a>
            </li>
        </ul>
        <span class="heading">งานวิชาการ</span>
        <ul class="list-unstyled">
            <!-- <li><a href="#TeacherLarn" aria-expanded="false" data-toggle="collapse"> <i
                        class="icon-interface-windows"></i>งานครูผู้สอน </a>
                <ul id="TeacherLarn" class="collapse list-unstyled ">
                    <li><a href="<?=base_url('Teacher/CheckHomeRoom');?>">เช็ตชื่อโฮมรูม</a></li>
                    <li><a href="<?=base_url('Teacher/CheckTeaching');?>">เช็ดชื่อการสอน</a></li>
                </ul>
            </li> -->
            <li class=" <?=$this->uri->segment(2) == 'Course' ? 'active' : '' ?>">
                <a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i
                        class="icon-interface-windows"></i>งานหลักสูตร </a>
                <ul id="exampledropdownDropdown"
                    class="collapse list-unstyled  <?=$this->uri->segment(2) == 'Course' ? 'show' : '' ?>">
                    <?php if($this->session->userdata('login_id') == 'pers_003' || $this->session->userdata('login_id') == 'pers_002') : ?>
                    <?php else : ?>
                    <li><a href="<?=base_url('Teacher/Course');?>"><i class="fa fa-file" aria-hidden="true"></i>
                            แผนการสอน</a>
                    </li>
                    <?php endif; ?>

                    <?php if($this->session->userdata('groupleade') == 1 || $this->session->userdata('login_id') == 'pers_003' || $this->session->userdata('login_id') == 'pers_002' || $this->session->userdata('login_id') == 'pers_021') : ?>
                    <span class="heading">สำหรับหัวหน้า</span>
                    <li>
                        <a href="<?=base_url('Teacher/Course/CheckPlan');?>"> <i class="icon-flask"></i>ตรวจงาน /
                            ดาวน์โหลด </a>
                        <a href="<?=base_url('Teacher/Course/ReportPlan');?>"> <i class="fa fa-print"
                                aria-hidden="true"></i>รายงาน </a>
                        <!-- <a href="<?=base_url('Teacher/Course/DownloadPlan');?>"> <i class="fa fa-print" aria-hidden="true"></i>ดาวน์โหลดแผน </a> -->
                        <?php if($this->session->userdata('login_id') == 'pers_014'): ?>
                        <a href="<?=base_url('Teacher/Course/Setting');?>"> <i class="fa fa-cogs"></i>ตั้งค่า </a>
                        <?php endif; ?>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <li class=" <?=$this->uri->segment(2) == 'p' ? 'active' : '' ?>">
                <a href="#"> <i class="icon-interface-windows"></i>งานประกันภายใน </a>
            </li>
        </ul>
        <span class="heading">งานกิจการนักเรียน</span>
        <ul class="list-unstyled">
            <li>
                <a href="#HelpStudent" aria-expanded="false" data-toggle="collapse"> <i
                        class="icon-interface-windows"></i>ระบบดูแลช่วยเหลือนักเรียน </a>
                <ul id="HelpStudent"
                    class="collapse list-unstyled <?=$this->uri->segment(2) == 'SupStd' ? 'show' : '' ?>">
                    <li class="<?=$this->uri->segment(3) == 'Main' ? 'active' : '' ?>">
                        <a href="<?=base_url('Teacher/SupStd/Main');?>">เยี่ยมบ้าน / SDQ</a>
                    </li>
                    <?php if($CheckHomeVisitManager->homevisit_set_manager == $this->session->userdata('login_id')): ?>
                    <span class="heading">ตรวจงาน</span>
                    <li class="<?=$this->uri->segment(3) == 'CheckWorkManager' ? 'active' : '' ?>">
                        <a href="<?=base_url('Teacher/SupStd/CheckWorkManager');?>">หัวหน้างาน</a>
                    </li>
                    <!-- <li class="<?=$this->uri->segment(3) == 'CheckWorkExecutive' ? 'active' : '' ?>">
                        <a href="<?=base_url('Teacher/SupStd/CheckWorkExecutive');?>">ผู้บริหาร</a>
                    </li> -->
                    <?php endif; ?>
                </ul>
            </li>
        </ul>

    </nav>

    <div class="content-inner">