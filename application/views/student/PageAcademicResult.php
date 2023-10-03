<div class="app-wrapper">


    <?php 
            $AllUnit = 0; $AllGrade = 0; 
            foreach ($scoreYear as $key_year => $v_scoreYear) {
                $SubGrade = 0;
                foreach ($scoreStudent as $key => $score ){
                    if($v_scoreYear->RegisterYear == $score->RegisterYear && $v_scoreYear->RegisterYear == $score->SubjectYear){
                        $AllUnit += floatval(floatval($score->SubjectUnit));

                        if($score->Grade == 'ร' || $score->Grade == 'มส' || $score->Grade == ''){                           
                            $SubGrade += (floatval($score->SubjectUnit)*0);
                        }else{
                            if(floatval($score->Score100) == ''){
                                $SubGrade += ((floatval($score->SubjectUnit))*($score->Grade));
                            }else{
                                $SubGrade += ((floatval($score->SubjectUnit))*($score->Grade));
                            }
                        }
                    }
                   
                }$AllGrade += $SubGrade; 
                //echo $AllUnit.'<br>'; 
                
            }            
            ?>

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <h1 class="app-page-title text-center ">
                <!-- <?=$title?> -->
            </h1>

            <div class="mb-5">
                <?php if($CheckOnOff[0]->onoff_status == "true") : ?>


                <div class="row">
                    <?php asort($scoreYear);
                
                foreach ($scoreYear as $key_year => $v_scoreYear) : 
                
                ?>
                    <div class="col-md-12">

                        <div class="card mb-5">
                            <div class="card-header text-center text-white" style="background-color: #5FCB71;">
                                ภาคเรียนที่
                                <?=$v_scoreYear->RegisterYear?> </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered">
                                                <thead class="bg-light">
                                                    <tr class="text-center">
                                                        <th scope="col">รหัสวิชา</th>
                                                        <th scope="col">ชื่อวิชา</th>
                                                        <th scope="col">ประเภท</th>
                                                        <th scope="col">หน่วยกิต</th>
                                                        <th scope="col">เกรด</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php  $SumUnit = 0; $SumGrade = 0; $scoreLevel=0; $CountSubjectAll = 0;
                                            $Name = array();
                                            
                                        foreach ($scoreStudent as $key => $score):          
                                            //    $v_scoreYear->RegisterYear == $score->RegisterYear && $v_scoreYear->RegisterYear == $score->SubjectYear
                                          
                                            if($v_scoreYear->RegisterYear == $score->SubjectYear):
                                                $Name[] = $score->SubjectCode;
                                            $c = floatval($score->Score100);
                                            $type = explode("/",$score->SubjectType);
                                            $CountSubjectAll += 1;
                                         ?>
                                                    <tr>
                                                        <th scope="row" class="text-center"><?=$score->SubjectCode;?>
                                                        </th>
                                                        <td>
                                                            <div>
                                                            <strong><?=$score->SubjectName;?></strong>
                                                            </div>                                                            
                                                            <small>ครูผู้สอน : <?=$score->pers_prefix.$score->pers_firstname.' '.$score->pers_lastname;?></small>
                                                        </td>
                                                        <td class="text-center"><?=$type[1]?></td>
                                                        <td class="text-center">
                                                            <?=number_format(floatval($score->SubjectUnit),1);?>
                                                        </td>
                                                        
                                                        <?php if($score->Grade == 'ร' || $score->Grade == 'มส' || $score->Grade == ''){ ?>
                                                        <td class="text-center"><strong><?=$score->Grade?></strong></td>
                                                        <?php }else{ ?>
                                                        <td class="text-center"><strong><?=$score->Grade?></strong></td>
                                                        <?php } ?>
                                                        

                                                    </tr>
                                                    <?php $SumUnit += floatval($score->SubjectUnit);
                                        if($score->Grade == 'ร' || $score->Grade == 'มส' || $score->Grade == ''){
                                            $scoreLevel += (floatval($score->SubjectUnit)*0);
                                            $SumGrade += (floatval($score->SubjectUnit)*0);
                                        }else{
                                            if(floatval($score->Score100) == ''){
                                                $SumGrade += ((floatval($score->SubjectUnit))*($score->Grade));
                                            }else{
                                                $scoreLevel += floatval($score->Score100);
                                                $SumGrade += ((floatval($score->SubjectUnit))*($score->Grade));
                                            }
                                        }
                                         endif; 
                                         endforeach;?>
                                                    <tr class="text-center tfoot">
                                                        <th ></th>
                                                        <th >วิชาทั้งหมด <?=$CountSubjectAll;?> วิชา</th>
                                                        <th colspan=2>หน่วยกิตทั้งหมด <?=$SumUnit;?></th>
                                                        <th>
                                                            <?=substr($SumGrade/$SumUnit,0,4);?>
                                                        </th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                           
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <table class="table">
                                            <thead class="text-center table-success">
                                                <tr>
                                                    <th colspan="3">กิจกรรมพัฒนาผู้เรียน</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col">กิจกรรม</th>
                                                    <th scope="col">ผลการประเมิน</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>กิจกรรมแนะแนว</th>
                                                    <td class="text-center">
                                                        <span class="text-success">
                                                        
                                                        
                                                    </span>
                                                    <?=$v_scoreYear->RegisterYear == '1/2565' ?"ผ่าน":"รอประมวลผล..."?>
                                                    </td>
                                                </tr>
                                                <?php if($stu->StudentClass <= 'ม.4/1') : ?>
                                                <tr>
                                                    <th scope="row">ลูกเสือ/เนตรนารี/ยุวฯ/บพ.</th>
                                                    <td class="text-center">
                                                    <?php 
                                                    if($v_scoreYear->RegisterYear == '1/2565' ) : ?>
                                                        <?php 
                                                                if(in_array($stu->StudentCode,$checkChunum)){
                                                                    echo '<span class="text-danger">ไม่ผ่าน</span>';
                                                                }else{
                                                                    echo '<span class="text-success">ผ่าน</span>';
                                                                }
                                                            ?>
                                                            <?php else : ?>
                                                            รอประมวลผล...
                                                            <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <?php endif; ?>
                                                <tr>
                                                    <th scope="row">กิจรรมชุมชน</th>
                                                    <td class="text-center">
                                                    <?php 
                                                    if($v_scoreYear->RegisterYear == '1/2565' ) : ?>
                                                        <?php 
                                                                if(in_array($stu->StudentCode,$checkRuksun)){
                                                                    echo '<span class="text-danger">ไม่ผ่าน</span>';
                                                                }else{
                                                                    echo '<span class="text-success">ผ่าน</span>';
                                                                }
                                                            ?>
                                                            <?php else : ?>
                                                            รอประมวลผล...
                                                            <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>กิจกรรมเพื่อสังคม</th>
                                                    <td class="text-center"><span class="text-success"></span>
                                                    <?=$v_scoreYear->RegisterYear == '1/2565' ?"ผ่าน":"รอประมวลผล..."?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <table class="table">
                                            <thead class="text-center table-success">
                                                <tr>
                                                    <th colspan="3">ผลการประเมิน</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col">คุณลักษณะอันพึงประสงค์</th>
                                                    <th scope="col">อ่าน คิดวิเคราะห์ เขียน</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>


                                        <!-- <div class="app-card alert shadow-sm mb-4 border-left-decoration"
                                            role="alert">
                                            <div class="inner">
                                                <div class="app-card-body p-3 p-lg-4">
                                                    <h3 class="mb-3">แจ้งเตือน!</h3>
                                                    <div class="row gx-5 gy-3">
                                                        <div class="col-12 col-lg-12">

                                                            <div>
                                                                ในวันที่ 15 - 17 ตุลาคม 2565 หากนักเรียนคนใดมีผลการเรียน
                                                                0 ร มส มผ ให้นักเรียนลงทะเบียนเพื่อขอแก้ผลการเรียน 0 ร
                                                                มส. และ มผ.


                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-12">
                                                            <style>
                                                            .app-card.border-left-decoration {
                                                                border-left: 3px solid #dc3545;
                                                            }
                                                            </style>

                                                            <a class="btn btn-danger" target="_blank"
                                                                href="https://forms.gle/mwKALnD9WhAf61Mx8"><svg
                                                                    width="1em" height="1em" viewBox="0 0 16 16"
                                                                    class="bi bi-file-earmark-arrow-down me-2"
                                                                    fill="currentColor"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z">
                                                                    </path>
                                                                    <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z">
                                                                    </path>
                                                                    <path fill-rule="evenodd"
                                                                        d="M8 6a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 10.293V6.5A.5.5 0 0 1 8 6z">
                                                                    </path>
                                                                </svg>ลิงก์สำหรับลงทะเบียนขอแก้ผลการเรียน 0 ร มส มผ</a>
                                                        </div>
                                                      
                                                    </div>
                                                </div>
                                              

                                            </div>
                                          
                                        </div> -->

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <?php  endforeach;?>
                </div>
                <?php else: ?>
                <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                    <div class="inner">
                        <div class="app-card-body p-3 p-lg-4">
                            <h3 class="mb-3">ระบบแสดงผลการเรียน</h3>
                            <div class="row gx-5 gy-3">
                                <div class="col-12 col-lg-9">

                                    <div>
                                        ผลการเรียน ระบบจะเปิดให้ดูในวันที่ 15 ตุลาคม 2565 เป็นต้นไป
                                    </div>
                                </div>
                                <!--//col-->

                            </div>
                            <!--//row-->
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <!--//app-card-body-->

                    </div>
                    <!--//inner-->
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="text-center">
                            <img src="<?=base_url('assets/images/academicResult/img-update.svg')?>" alt="" srcset=""
                                class="img-fluid">
                            <h1>อยู่ระหว่างการอัพเดต...</h1>
                        </div>
                    </div>
                </div>

                <?php endif; ?>
            </div>



        </div>
        <!--//container-fluid-->
    </div>
    <!--//app-content-->