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
                <?=$title?>
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
                                            <table class="table table-hover table-bordered ShowGrade">
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
                                                    <?php  $SumUnit = 0; $SumGrade = 0; $scoreLevel=0;
                                        foreach ($scoreStudent as $key => $score ):                                         
                                            if($v_scoreYear->RegisterYear == $score->RegisterYear && $v_scoreYear->RegisterYear == $score->SubjectYear):
                                            $c = floatval($score->Score100);
                                            $type = explode("/",$score->SubjectType);
                                           //echo '<pre>';print_r($score);
                                                // if(($c>100)||($c<0)||($c== ''))
                                                // { $cc= "(W)" ; }
                                                // else if (($c>=80)&&($c<=100)) { $cc= "A" ; }
                                                // else if (($c>=75)&&($c<=79)) { $cc= "B+" ; }
                                                // else if (($c>=70)&&($c<=74)) { $cc= "B" ; }
                                                // else if (($c>=65)&&($c<=69)) { $cc= "C+" ; }
                                                // else if (($c>=60)&&($c<=64)) { $cc= "C" ; }
                                                // else if (($c>=55)&&($c<=59)) { $cc= "D+" ; }
                                                // else if (($c>=50)&&($c<=54)) { $cc= "D" ; }
                                                // else if ($c<=49) { $cc= "F" ; }
                                         ?>
                                                    <tr>
                                                        <th scope="row"><?=$score->SubjectCode;?></th>
                                                        <td><?=$score->SubjectName;?></td>
                                                        <td class="text-center"><?=$type[1]?></td>
                                                        <td class="text-center">
                                                            <?=number_format(floatval($score->SubjectUnit),1);?></td>

                                                        <?php if($score->Grade == 'ร' || $score->Grade == 'มส' || $score->Grade == ''){ ?>
                                                        <td class="text-center"><?=$score->Grade?></td>
                                                        <?php }else{ ?>
                                                        <td class="text-center"><?=$score->Grade?></td>
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
                                                        <th colspan=3>รวม</th>
                                                        <th></th>
                                                        <th>
                                                            <?php 
                                                    // if($SumGrade && $SumUnit){
                                                    //     $a = ($SumGrade/$SumUnit);
                                                    //     echo substr($a,0,strpos($a,'.')+3);
                                                    // }
                                                   
                                                        ?>

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
                                                        <th scope="col">เวลา (ชม.)</th>
                                                        <th scope="col">ผลการประเมิน</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                
                                                    <tr>
                                                        <th scope="row">กิจรรมชุมชน</th>
                                                        <td class="text-center">40</td>
                                                        <td class="text-center">
                                                        <?php 
                                                                if(in_array($stu->StudentCode,$checkRuksun)){
                                                                    echo '<p class="text-danger">ไม่ผ่าน</p>';
                                                                }else{
                                                                    echo '<p class="text-success">ผ่าน</p>';
                                                                }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php if($stu->StudentClass <= 'ม.4/1') : ?>
                                                    <tr>
                                                        <th scope="row">ลูกเสือและเนตรนารี</th>
                                                        <td class="text-center">40</td>
                                                        <td class="text-center">
                                                        <?php 
                                                                if(in_array($stu->StudentCode,$checkChunum)){
                                                                    echo '<p class="text-danger">ไม่ผ่าน</p>';
                                                                }else{
                                                                    echo '<p class="text-success">ผ่าน</p>';
                                                                }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <?php  endforeach;?>
                </div>
                <?php else: ?>
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