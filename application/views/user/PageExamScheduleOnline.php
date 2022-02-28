<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="main-wrapper">
                <section class="cta-section theme-bg-light py-5">
                    <div class="container text-center">
                        <h2 class="heading">ตารางสอบออนไลน์</h2>
                        <div class="intro">(ให้นักเรียนตรวจสอบลิ้งก์ และวิชาที่สอบก่อนทำข้อสอบ ว่าตรงกับข้อสอบหรือไม่  ถ้ามีปัญหาในการสอบ ให้นักเรียนติดต่อโดยตรงกับครูประจำวิชา !)</div>
                    </div>
                    <!--//container-->

                </section>
                <div class="container text-center">
                    <?php if (date("Y-m-d") == "2022-02-28"): ?>
                    <div id="28">
                        <?php $this->load->view('user/ExamSchedule/28.php'); ?>
                    </div>
                    <?php elseif(date("Y-m-d") == "2022-03-01" || date("Y-m-d") == "2022-02-29"):?>
                        <h2><div class="badge bg-danger">ตารางสอบปลายภาคเรียน วันที่ 1 มีนาคม 2564 จะเปิดสอบในวันพรุ่งนี้ กรุณารอ...</div></h2>
                    <div id="1">
                        <?php $this->load->view('user/ExamSchedule/1.php'); ?>
                    </div>
                    <?php elseif(date("Y-m-d") == "2022-03-02"):?>
                    <div id="2">
                        <?php $this->load->view('user/ExamSchedule/2.php'); ?>
                    </div>
                    <?php elseif(date("Y-m-d") == "2022-03-03"):?>
                    <div id="3">
                        <?php $this->load->view('user/ExamSchedule/3.php'); ?>
                    </div>
                    <?php else: ?>
                    <div class="text-center">
                        <h2><span class="badge bg-danger">ตารางสอบปลายภาคเรียน จะแสดงตามวันที่สอบ กรุณารอในวันพรุ่งนี้...</span></h2>
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>