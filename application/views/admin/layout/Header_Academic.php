<li class="nav-item">
    <div class="nav-link">
        <div class="d-flex align-items-center">
            <div style="width: -webkit-fill-available;">
                ระบบกำลังเปิดในปีการศึกษา
            </div>
            <select name="schyear_year" id="schyear_year" class="form-select form-select-sm">
                <?php $Y = date('Y')+543;
                                        for ($i=2565; $i <= $Y+2; $i++):
                                        for ($j=1; $j <= 2; $j++) : ?>
                <option <?=$SchoolYear->schyear_year == $j.'/'.$i ?"selected":""?> value="<?=$j.'/'.$i;?>">
                    <?=$j.'/'.$i;?></option>
                <?php endfor; ?>
                <?php endfor; ?>

            </select>
        </div>

    </div>

</li>
<div class="mx-3">บริหารงานวิชาการ</div>
<li class="nav-item has-submenu">
    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
    <a class="nav-link submenu-toggle <?=$this->uri->segment('3')=="Registration" ? "active" :""?>" href="#"
        data-bs-toggle="collapse" data-bs-target="#submenu-2" aria-expanded="false" aria-controls="submenu-2">
        <span class="nav-icon">
            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-columns-gap" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M6 1H1v3h5V1zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H1zm14 12h-5v3h5v-3zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5zM6 8H1v7h5V8zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H1zm14-6h-5v7h5V1zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1h-5z" />
            </svg>
        </span>
        <span class="nav-link-text">งานทะเบียน</span>
        <span class="submenu-arrow">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
            </svg>
        </span>
        <!--//submenu-arrow-->
    </a>
    <!--//nav-link-->
    <div id="submenu-2" class="collapse submenu submenu-2 <?=$this->uri->segment('3')=="Registration" ? "show" :""?>"
        data-bs-parent="#menu-accordion">
        <ul class="submenu-list list-unstyled">
            <li class="submenu-item"><a class="submenu-link <?=$this->uri->segment('4')=="Enroll" ? "active" :""?>"
                    href="<?=base_url('Admin/Acade/Registration/Enroll');?>">ลงทะเบียนเรียน (ปกติ)</a>
            </li>
            <li class="submenu-item"><a class="submenu-link <?=$this->uri->segment('4')=="Repeat" ? "active" :""?>"
                    href="<?=base_url('Admin/Acade/Registration/Repeat');?>">ลงทะเบียนเรียน (ซ้ำ)</a>
            </li>
            <li class="submenu-item"><a
                    class="submenu-link <?=$this->uri->segment('4')=="RegisterSubject" ? "active" :""?>"
                    href="<?=base_url('Admin/Acade/Registration/RegisterSubject');?>">จัดการวิชาเรียน</a>
            </li>
            <li class="submenu-item"><a class="submenu-link <?=$this->uri->segment('4')=="ClassRoom" ? "active" :""?>"
                    href="<?=base_url('Admin/Acade/Registration/ClassRoom');?>">จัดการห้องเรียน /
                    ที่ปรึกษา</a>
            </li>
            <li class="submenu-item"><a class="submenu-link <?=$this->uri->segment('4')=="Students" ? "active" :""?>"
                    href="<?=base_url('Admin/Acade/Registration/Students/All');?>">จัดการนักเรียน</a></li>
            <!-- <li class="submenu-item"><a
                                            class="submenu-link <?=$this->uri->segment('4')=="ExtraSubject" ? "active" :""?>"
                                            href="<?=base_url('Admin/Acade/Registration/ExtraSubject');?>">ลงทะเบียนวิชาเพิ่มเติม</a>
                                    </li> -->

            <li class="submenu-item"><a
                    class="submenu-link <?=$this->uri->segment('4')=="ExamSchedule" ? "active" :""?>"
                    href="<?=base_url('Admin/Acade/Registration/ExamSchedule');?>">จัดการตารางสอบ</a>
            </li>
            <li class="submenu-item"><a
                    class="submenu-link <?=$this->uri->segment('4')=="ClassSchedule" ? "active" :""?>"
                    href="<?=base_url('Admin/Acade/Registration/ClassSchedule');?>">จัดการตารางเรียน</a>
            </li>
            <li class="submenu-item"><a
                    class="submenu-link <?=$this->uri->segment('4')=="ExtraSubject" ? "active" :""?>"
                    href="<?=base_url('Admin/Acade/Registration/RoomOnline');?>">จัดการห้องเรียนออนไลน์</a>
            </li>

        </ul>
    </div>
</li>
<!--//nav-item-->

<li class="nav-item has-submenu">
    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
    <a class="nav-link submenu-toggle <?=$this->uri->segment('3')=="Evaluate" ? "active" :""?>" href="#"
        data-bs-toggle="collapse" data-bs-target="#submenu-1" aria-expanded="false" aria-controls="submenu-1">
        <span class="nav-icon">
            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-files" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4 2h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4z" />
                <path
                    d="M6 0h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1H4a2 2 0 0 1 2-2z" />
            </svg>
        </span>
        <span class="nav-link-text">งานวัดและประเมินผล</span>
        <span class="submenu-arrow">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
            </svg>
        </span>
        <!--//submenu-arrow-->
    </a>
    <!--//nav-link-->
    <div id="submenu-1" class="collapse submenu submenu-1 <?=$this->uri->segment('3')=="Evaluate" ? "show" :""?>"
        data-bs-parent="#menu-accordion">
        <ul class="submenu-list list-unstyled">

            <li class="submenu-item"><a class="submenu-link <?=$this->uri->segment('4')=="EditGrade" ? "active" :""?>"
                    href="<?=base_url('Admin/Acade/Evaluate/EditGrade/').$SchoolYear->schyear_year?>">จัดการผลการเรียน (0 ร)</a>
            </li>
            <li class="submenu-item"><a
                    class="submenu-link <?=$this->uri->segment('4')=="AcademicRepeat" ? "active" :""?>"
                    href="<?=base_url('Admin/Acade/Evaluate/AcademicRepeat/').$checkOnOff[6]->onoff_year;?>">จัดการผลการเรียนซ้ำ
                    (มส)</a>
            </li>
            <li class="submenu-item">
                <a class="submenu-link <?=$this->uri->segment('4')=="ReportScoreRoomMain" && $this->uri->segment('3')=="Evaluate"  ? "active" :""?>"
                    href="<?=base_url('Admin/Acade/Evaluate/ReportScoreRoomMain/').$SchoolYear->schyear_year.'/All/All';?>">
                    รายงานผลการบันทึกคะแนน (รายห้องเรียน)
                </a>
            </li>

            <li class="submenu-item">
                <a class="submenu-link <?=$this->uri->segment('4')=="ReportTeacherSaveScore" && $this->uri->segment('3')=="Evaluate" || $this->uri->segment('4')=="ReportTeacherSaveScoreCheck" ? "active" :""?>"
                    href="<?=base_url('Admin/Acade/Evaluate/ReportTeacherSaveScore/').$SchoolYear->schyear_year;?>">
                    รายงานผลการบันทึกคะแนน (ครูผู้สอน)
                </a>
            </li>

            <li class="submenu-item">
                <a class="submenu-link <?=$this->uri->segment('4')=="ReportPerson" && $this->uri->segment('3')=="Evaluate" ? "active" :""?>"
                    href="<?=base_url('Admin/Acade/Evaluate/ReportPerson');?>">
                    รายงานผลการเรียนรายบุคคล
                </a>
            </li>

            <li class="submenu-item"><a class="submenu-link <?=$this->uri->segment('4')=="ReportRoom" ? "active" :""?>"
                    href="<?=base_url('Admin/Acade/Evaluate/ReportRoom');?>">
                    รายงานผลการเรียนรายห้องเรียน</a>
            </li>

            <li class="submenu-item"><a
                    class="submenu-link <?=$this->uri->segment('4')=="ReportSummaryTeacher" && $this->uri->segment('3')=="Evaluate" ? "active" :""?>"
                    href="<?=base_url('Admin/Acade/Evaluate/ReportSummaryTeacher?SelLern=0');?>">
                    รายงานสรุปผลสัมฤทธิ์ทางการเรียน</a>
            </li>
            <li class="submenu-item"><a
                    class="submenu-link <?=$this->uri->segment('4')=="AcademicResult" ? "active" :""?>"
                    href="<?=base_url('Admin/Acade/Evaluate/AcademicResult');?>">ตั้งค่าแสดงผลการเรียนนักเรียน</a>
            </li>
            <li class="submenu-item"><a class="submenu-link <?=$this->uri->segment('4')=="SaveScore" ? "active" :""?>"
                    href="<?=base_url('Admin/Acade/Evaluate/SaveScore');?>">ตั้งค่าบันทึกผลการเรียน</a>
            </li>

        </ul>
    </div>
</li>
<!--//nav-item-->

<li class="nav-item has-submenu">
    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
    <a class="nav-link submenu-toggle <?=$this->uri->segment('2')=="Extra" ? "active" :""?>" href="#"
        data-bs-toggle="collapse" data-bs-target="#submenu-3" aria-expanded="false" aria-controls="submenu-3">
        <span class="nav-icon">
            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-files" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4 2h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4z" />
                <path
                    d="M6 0h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1H4a2 2 0 0 1 2-2z" />
            </svg>
        </span>
        <span class="nav-link-text">งานหลักสูตร</span>
        <span class="submenu-arrow">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
            </svg>
        </span>
        <!--//submenu-arrow-->
    </a>
    <!--//nav-link-->
    <div id="submenu-3" class="collapse submenu submenu-3 <?=$this->uri->segment('3')=="Course" ? "show" :""?>"
        data-bs-parent="#menu-accordion">
        <ul class="submenu-list list-unstyled">
            <li class="submenu-item ">
                <a class="submenu-link <?=$this->uri->segment('3')=="Course" ? "active" :""?>"
                    href="<?=base_url('Admin/Acade/Course/SendPlan');?>">จัดการส่งแผน</a>

            </li>

        </ul>
    </div>
</li>
<!--//nav-item-->
<li class="nav-item ">
    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
    <a class="nav-link <?=$this->uri->segment('4')=="AdminRoles" ? "active" :""?>"
        href="<?=base_url('Admin/Acade/Setting/AdminRoles');?>">
        <span class="nav-icon">
            <i class="bi bi-gear-fill" style="font-size: 1.2rem;"></i>
        </span>
        <span class="nav-link-text">จัดการบทบาทในวิชาการ</span>
    </a>
    <!--//nav-link-->
</li>