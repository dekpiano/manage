<style>
@keyframes click-wave {
    0% {
        height: 40px;
        width: 40px;
        opacity: 0.15;
        position: relative;
    }

    100% {
        height: 200px;
        width: 200px;
        margin-left: -80px;
        margin-top: -80px;
        opacity: 0;
    }
}

.option-input {
    -webkit-appearance: none;
    -moz-appearance: none;
    -ms-appearance: none;
    -o-appearance: none;
    appearance: none;
    position: relative;
    top: 13.33333px;
    right: 0;
    bottom: 0;
    left: 0;
    height: 40px;
    width: 40px;
    transition: all 0.15s ease-out 0s;
    background: #cbd1d8;
    border: none;
    color: #fff;
    cursor: pointer;
    display: inline-block;
    margin-right: 0.5rem;
    outline: none;
    position: relative;
    z-index: 1000;
}

.option-input:hover {
    background: #9faab7;
}

.option-input:checked {
    background: #E91E63;
}

.option-input:checked::before {
    height: 40px;
    width: 40px;
    position: absolute;
    content: "\f111";
    font-family: "Font Awesome 5 Free";
    display: inline-block;
    font-size: 26.66667px;
    text-align: center;
    line-height: 40px;
}

.option-input:checked::after {
    -webkit-animation: click-wave 0.25s;
    -moz-animation: click-wave 0.25s;
    animation: click-wave 0.25s;
    background: #E91E63;
    content: '';
    display: block;
    position: relative;
    z-index: 100;
}

.option-input.radio {
    border-radius: 50%;
}

.option-input.radio::after {
    border-radius: 50%;
}
</style>
<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center ">
            <h2 class="no-margin-bottom"><?=$title;?></h2>
            <p class="mb-0">

            </p>
        </div>
    </div>
</header>


<!-- Dashboard Counts Section-->
<div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-4">
                <a href="<?=base_url('Teacher/Teaching/CheckHomeRoomAdd');?>">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-red"><i class="fa fa-tasks"></i></div>
                    <div class="text"><strong>บันทึกข้อมูลโฮมรูม</strong></div>
                </div>
                </a>
                
            </div>
        </div>

    </div>


<section class="dashboard-counts no-padding-bottom">   
    <div class="container-fluid">
        <h2>สถิติการมาเข้าแถวตอนเช้า วันที่
            <?=$this->datethai->thai_date_fullmonth(strtotime(date('Y-m-d')))?>
        </h2>
        <?php 
        
            
            foreach ($ChkHomeRoom as $key => $v_ChkHomeRoom) {
                if(date('Y-m-d',strtotime($v_ChkHomeRoom->chk_home_date)) === date('Y-m-d')){
                    $v_ChkHomeRoom->chk_home_ma !== "" ? $stu_ma =  count(explode('|', $v_ChkHomeRoom->chk_home_ma)) : $stu_ma = 0;
                    $v_ChkHomeRoom->chk_home_khad !== "" ? $stu_khad =  count(explode('|', $v_ChkHomeRoom->chk_home_khad)) : $stu_khad = 0;
                    $v_ChkHomeRoom->chk_home_la !== "" ? $stu_la =  count(explode('|', $v_ChkHomeRoom->chk_home_la)) : $stu_la = 0;
                    $v_ChkHomeRoom->chk_home_sahy !== "" ? $stu_sahy =  count(explode('|', $v_ChkHomeRoom->chk_home_sahy)) : $stu_sahy = 0;
                    $v_ChkHomeRoom->chk_home_kid !== "" ? $stu_kid =  count(explode('|', $v_ChkHomeRoom->chk_home_kid)) : $stu_kid = 0;
                    $v_ChkHomeRoom->chk_home_hnee !== "" ? $stu_hnee =  count(explode('|', $v_ChkHomeRoom->chk_home_hnee)) : $stu_hnee = 0;
                        
                }
                else{
                    $stu_ma =  0;
                    $stu_khad =  0;
                    $stu_la =  0;
                    $stu_sahy =  0;
                    $stu_kid =  0;
                    $stu_hnee =  0;
                }
             }
        
        
        // if($ChkHomeRoom){

        // }
        ?>
        <div class="row bg-white has-shadow">
            <!-- Item -->
            <div class="col-xl-2 col-sm-6">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="icon-user"></i></div>
                    <div class="title"><b>มา</b>
                        <div class="progress">
                            <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                        </div>
                    </div>
                    <div class="number"><strong><?=$stu_ma;?></strong></div>
                </div>
            </div>
            <!-- Item -->
            <div class="col-xl-2 col-sm-6">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-red"><i class="icon-user"></i></div>
                    <div class="title"><span>ขาด</span>
                        <div class="progress">
                            <div role="progressbar" style="width: 70%; height: 4px;" aria-valuenow="70"
                                aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                        </div>
                    </div>
                    <div class="number"><strong><?=$stu_khad;?></strong></div>
                </div>
            </div>
            <!-- Item -->
            <div class="col-xl-2 col-sm-6">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-green"><i class="icon-user"></i></div>
                    <div class="title"><span>สาย<br></span>
                        <div class="progress">
                            <div role="progressbar" style="width: 40%; height: 4px;" aria-valuenow="40"
                                aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
                        </div>
                    </div>
                    <div class="number"><strong><?=$stu_sahy;?></strong></div>
                </div>
            </div>
            <!-- Item -->
            <div class="col-xl-2 col-sm-6">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-orange"><i class="icon-user"></i></div>
                    <div class="title"><span>ลา<br></span>
                        <div class="progress">
                            <div role="progressbar" style="width: 50%; height: 4px;" aria-valuenow="50"
                                aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
                        </div>
                    </div>
                    <div class="number"><strong><?=$stu_la;?></strong></div>
                </div>
            </div>
            <!-- Item -->
            <div class="col-xl-2 col-sm-6">
                <div class="item d-flex align-items-center">
                    <div class="icon" style="background: #6df2ff !important;
    color: #fff;"><i class="icon-user"></i></div>
                    <div class="title"><span>กิจกรรม<br></span>
                        <div class="progress">
                            <div role="progressbar" style="width: 50%; height: 4px;background: #6df2ff ;"
                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="progress-bar"></div>
                        </div>
                    </div>
                    <div class="number"><strong><?=$stu_kid;?></strong></div>
                </div>
            </div>
            <!-- Item -->
            <div class="col-xl-2 col-sm-6">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-orange" style="background: #ff6df4 !important;
    color: #fff;"><i class="icon-user"></i></div>
                    <div class="title"><span>ไม่เข้าแถว<br></span>
                        <div class="progress">
                            <div role="progressbar" style="width: 50%; height: 4px;background-color: #ff6df4;"
                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="progress-bar"></div>
                        </div>
                    </div>
                    <div class="number"><strong><?=$stu_hnee;?></strong></div>
                </div>
            </div>
        </div>
    </div>
</section>