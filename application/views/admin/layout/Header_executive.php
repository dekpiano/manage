<div class="mx-3">ผู้บริหารโรงเรียน</div>

<li class="nav-item">
    <a class="nav-link <?=$this->uri->segment('3')=="Executive" && $this->uri->segment('4')=="ReportTeacherSaveScore" || $this->uri->segment('4')=="ReportTeacherSaveScoreCheck" ? "active" :""?>"
        href="<?=base_url('Admin/Acade/Executive/ReportTeacherSaveScore/').$SchoolYear->schyear_year;?>">
        <span class="nav-icon">
            <i class="bi bi-stack" style="font-size: 1.2rem;"></i>
        </span>
        <span class="nav-link-text">รายงานผลการบันทึกคนแนนครูผู้สอน</span>
    </a>
</li>


<li class="nav-item">
    <a class="nav-link <?=$this->uri->segment('3')=="Executive" && $this->uri->segment('4')=="ReportPerson" ? "active" :""?>"
        href="<?=base_url('Admin/Acade/Executive/ReportPerson');?>">
        <span class="nav-icon">
            <i class="bi bi-stack" style="font-size: 1.2rem;"></i>
        </span>
        <span class="nav-link-text">รายงานผลการเรียนรายบุคคล</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link <?=$this->uri->segment('3')=="Executive" && $this->uri->segment('4')=="ReportRoom" ? "active" :""?>"
        href="<?=base_url('Admin/Acade/Executive/ReportRoom');?>">
        <span class="nav-icon">
            <i class="bi bi-stack" style="font-size: 1.2rem;"></i>
        </span>
        <span class="nav-link-text">รายงานผลการเรียนรายห้องเรียน</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link <?=$this->uri->segment('3')=="Executive" && $this->uri->segment('4')=="ReportSummaryTeacher" ? "active" :""?>"
        href="<?=base_url('Admin/Acade/Executive/ReportSummaryTeacher?SelLern=0');?>">
        <span class="nav-icon">
            <i class="bi bi-stack" style="font-size: 1.2rem;"></i>
        </span>
        <span class="nav-link-text">รายงานสรุปผลสัมฤทธิ์ทางการเรียน</span>
    </a>
</li>