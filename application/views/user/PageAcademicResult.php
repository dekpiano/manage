<style>
.form-control {
    padding-top: 0rem;
    padding-bottom: 0rem;
}

.order-card {
    color: #fff;
}

.bg-c-blue {
    background: linear-gradient(45deg, #4099ff, #73b4ff);
}

.bg-c-green {
    background: linear-gradient(45deg, #5fcb71bd, #5FCB71);
}

.bg-c-yellow {
    background: linear-gradient(45deg, #FFB64D, #ffcb80);
}

.bg-c-pink {
    background: linear-gradient(45deg, #FF5370, #ff869a);
}


.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.card .card-block {
    padding: 25px;
}

.order-card i {
    font-size: 26px;
}

.f-left {
    float: left;
}

.f-right {
    float: right;
}
</style>

<div class="main-wrapper">
    <section class="cta-section theme-bg-light  py-5">
        <div class="container text-center">
            <h2 class="heading"><?=$title?></h2>
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        </div>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

        <!--//container-->
    </section>
    <div class="container-fluid theme-bg-light">
        <?php 
            $AllUnit = 0; $AllGrade = 0; 
            foreach ($scoreYear as $key_year => $v_scoreYear) {
                $SubGrade = 0;
                foreach ($scoreStudent as $key => $score ){
                    if($v_scoreYear->RegisterYear == $score->RegisterYear && $v_scoreYear->RegisterYear == $score->SubjectYear){
                        $AllUnit += $score->SubjectUnit;

                        if($score->Grade == 'ร' || $score->Grade == 'มส' || $score->Grade == ''){                           
                            $SubGrade += ($score->SubjectUnit*0);
                        }else{
                            if($score->Score100 == ''){
                                $SubGrade += (($score->SubjectUnit)*($score->Grade));
                            }else{
                                $SubGrade += (($score->SubjectUnit)*($score->Grade));
                            }
                        }
                    }
                   
                }$AllGrade += $SubGrade; //echo $SubGrade.'<br>'; 
                
            }//echo $AllGrade;

            
            ?>
        <div class="row">

            <div class="col-md-4 col-xl-3">
                <div class="card bg-c-green order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">จำนวนเทอม</h6>
                        <h2 class="text-right"><i class="fas fa-list-ol f-left"></i><span><?php  print_r(count($scoreYear)); ?></span></h2>
                        <p class="m-b-0">คือ จำนวนที่ภาคเรียน<span class="f-right"></span></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xl-3">
                <div class="card bg-c-blue order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">หน่วยกิตทั้งหมด</h6>
                        <h2 class="text-right"><i class="fa fa-refresh f-left"></i><span> <?php  echo $AllUnit;?>
                            </span></h2>
                        <p class="m-b-0">หน่วยกิตรวมทุกภาค <span class="f-right"></span></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xl-3">
                <div class="card bg-c-green order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">ค่าเฉลี่ย CGPA</h6>
                        <h2 class="text-right"><i class="fas fa-calculator f-left"></i><span> 
                            <?php $All = $AllGrade/$AllUnit; 
                            echo substr($All,0,strpos($All,'.')+3);?>
                            </span></h2>
                        <p class="m-b-0">เกรดเฉลี่ยรวมทุกภาค <span class="f-right"></span></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <section class=" theme-bg-light ">
        <div class="container-fluid ">
            <?php if($CheckOnOff[0]->onoff_status == "true") : ?>

            <div class="row">
                <?php asort($scoreYear);
                
                foreach ($scoreYear as $key_year => $v_scoreYear) : 
                
                ?>
                <div class="col-md-6">

                    <div class="card mb-5">
                        <div class="card-header text-center text-white" style="background-color: #5FCB71;">ภาคเรียนที่
                            <?=$v_scoreYear->RegisterYear?> </div>
                        <div class="card-body">
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
                                        <?php    $SumUnit = 0; $SumGrade = 0;$scoreLevel=0;
                                        foreach ($scoreStudent as $key => $score ):                                         
                                            if($v_scoreYear->RegisterYear == $score->RegisterYear && $v_scoreYear->RegisterYear == $score->SubjectYear):
                                            $c = $score->Score100;
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
                                            <td class="text-center"><?=$score->SubjectUnit;?></td>

                                            <?php if($score->Grade == 'ร' || $score->Grade == 'มส' || $score->Grade == ''){ ?>
                                            <td class="text-center"><?=$score->Grade?></td>
                                            <?php }else{ ?>
                                            <td class="text-center"><?=$score->Grade?></td>
                                            <?php } ?>


                                        </tr>
                                        <?php $SumUnit += $score->SubjectUnit;
                                        if($score->Grade == 'ร' || $score->Grade == 'มส' || $score->Grade == ''){
                                            $scoreLevel += ($score->SubjectUnit*0);
                                            $SumGrade += ($score->SubjectUnit*0);
                                        }else{
                                            if($score->Score100 == ''){
                                                $SumGrade += (($score->SubjectUnit)*($score->Grade));
                                            }else{
                                                $scoreLevel += $score->Score100;
                                                $SumGrade += (($score->SubjectUnit)*($score->Grade));
                                            }
                                        }
                                         endif; 
                                         endforeach;?>
                                        <tr class="text-center">
                                            <th colspan=3>รวม</th>
                                            <th><?php echo  $SumUnit; ?></th>
                                            <th>
                                                <?php $a = @($SumGrade/$SumUnit);
                                            echo substr($a,0,strpos($a,'.')+3);
                                            ?>

                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
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



    </section>

</div>
<!--//main-wrapper-->