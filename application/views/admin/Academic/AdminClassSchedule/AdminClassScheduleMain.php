<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <section class="cta-section theme-bg-light py-5">
                <div class="container text-center">
                    <h2 class="heading">จัดการข้อมูล<?=$title;?></h2>
                </div>
                <!--//container-->
            </section>
            <section class="we-offer-area text-center ">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between mb-3">
                        <select name="SelYearClassSchedule" id="SelYearClassSchedule" class="form-select w-auto">
                            <?php foreach ($YearAll as $key => $v_YearAll) : ?>
                            <option <?=$this->session->userdata('SchoolYear') == $v_YearAll->Year ? "selected":"";?>
                                value="<?=$v_YearAll->Year?>"><?=$v_YearAll->Year?></option>
                            <?php endforeach; ?>
                        </select>
                        <a href="<?=base_url('Admin/Acade/Course/ClassSchedule/add');?>" class="btn app-btn-primary"> <i
                                class="far fa-plus-square"></i>
                            เพิ่ม<?=$title;?></a>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="TbClassSchedule" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ชื่อห้องเรียน</th>
                                            <th>ชั้น/ห้อง</th>
                                            <th>ปีการศึกษา</th>
                                            <th>ไฟล์ตัวอย่าง</th>
                                            <th>วันที่ลง</th>
                                            <th>คำสั่ง</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <style>
                                        .loading {
                                            display: none;
                                            /* ซ่อน loading ไว้ก่อน */
                                            text-align: center;
                                            font-weight: bold;
                                            color: blue;
                                        }
                                        </style>
                                        <tr class="loading">
                                            <td colspan="3">Loading data, please wait...</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </section>

        </div>
        <!--//main-wrapper-->


    </div>
</div>