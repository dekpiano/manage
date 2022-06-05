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
<section class="">
    <div class="container">

        
            <div class="card">
                <div class="card-close">
                    <div class="dropdown">
                        <button type="button" id="closeCard2" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard2" class="dropdown-menu dropdown-menu-right has-shadow"><a
                                href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#"
                                class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                    </div>
                </div>
                <div class="card-header d-flex align-items-center">
                    <h3 class="h4">แบบฟอร์มเช็คชื่อโฮมรูมนักเรียนกิจกรรมหน้าเสาธง ชั้น ม.<?=$teacher[0]->Reg_Class;?></h3>
                </div>
                <div class="card-body">
                   
                    <form class="form-horizontal" action="<?=$Action;?>" method="post">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">รหัสนักเรียน</th>
                                        <th scope="col">ชื่อ-นามสกุล</th>
                                        <th scope="col">สถานะ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $CountStu = 0;
                                    foreach ($student as $key => $v_stu) : 
                                        $CountStu += 1;
                                    ?>

                                    <tr>
                                        <th scope="row"><?=$v_stu->StudentNumber?></th>
                                        <td>
                                            <?=$v_stu->StudentCode?>
                                            
                                            <input type="hidden" name="chk_home_teacher" id="chk_home_teacher" value="<?=$this->session->userdata('login_id')?>">
                                            <input type="hidden" name="chk_home_room" id="chk_home_room" value="<?=$teacher[0]->Reg_Class;?>">
                                            <input type="hidden" name="chk_home_term" id="chk_home_term" value="1">
                                            <input type="hidden" name="chk_home_yaer" id="chk_home_yaer" value="2565">
                                        </td>                                       
                                        <td><?=$v_stu->StudentPrefix?><?=$v_stu->StudentFirstName?>
                                            <?=$v_stu->StudentLastName?></td>
                                        <td>
                                            <?php                                             
                                            $chkMa = explode("|",@$ChkHomeRoom[0]->chk_home_ma);
                                            $chkLa = explode("|",@$ChkHomeRoom[0]->chk_home_la);
                                            $chkSahy = explode("|",@$ChkHomeRoom[0]->chk_home_sahy);
                                            $chkKid = explode("|",@$ChkHomeRoom[0]->chk_home_kid);
                                            $chkHnee = explode("|",@$ChkHomeRoom[0]->chk_home_hnee);
                                            $chkKhad = explode("|",@$ChkHomeRoom[0]->chk_home_khad);
                                            ?>
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-outline-primary active">
                                                    <input type="radio" name="status[<?=$v_stu->StudentCode?>]" id="status[<?=$key?>]" value="มา" autocomplete="off"
                                                    <?php 
                                                    if($chkMa[0] == ""){
                                                        echo "checked";
                                                    }else{
                                                        if(in_array($v_stu->StudentCode, $chkMa)){echo "checked";}  
                                                    }
                                                    ?> > มา
                                                </label>
                                                <label class="btn btn-outline-primary">
                                                    <input type="radio" name="status[<?=$v_stu->StudentCode?>]" id="status[<?=$key?>]" value="ขาด" autocomplete="off" <?php if(in_array($v_stu->StudentCode, $chkKhad)){echo "checked";}?>>
                                                    ขาด
                                                </label>
                                                <label class="btn btn-outline-primary">
                                                    <input type="radio" name="status[<?=$v_stu->StudentCode?>]" id="status[<?=$key?>]" value="สาย" autocomplete="off" <?php if(in_array($v_stu->StudentCode, $chkSahy)){echo "checked";}?>>
                                                    สาย
                                                </label>
                                                <label class="btn btn-outline-primary">
                                                    <input type="radio" name="status[<?=$v_stu->StudentCode?>]" id="status[<?=$key?>]" value="ลา" autocomplete="off" <?php if(in_array($v_stu->StudentCode, $chkLa)){echo "checked";}?>>
                                                    ลา
                                                </label>
                                                <label class="btn btn-outline-primary">
                                                    <input type="radio" name="status[<?=$v_stu->StudentCode?>]" id="status[<?=$key?>]" value="กิจกรรม" autocomplete="off" <?php if(in_array($v_stu->StudentCode, $chkKid)){echo "checked";}?>>
                                                    กิจกรรม
                                                </label>
                                                <label class="btn btn-outline-primary">
                                                    <input type="radio" name="status[<?=$v_stu->StudentCode?>]" id="status[<?=$key?>]" value="หนี" autocomplete="off" <?php if(in_array($v_stu->StudentCode, $chkHnee)){echo "checked";}?>>
                                                    หนี
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                       
                                        <input type="hidden" name="CountStu" id="CountStu" value="<?=$CountStu;?>">
                                        <input type="hidden" name="chk_home_id" id="chk_home_id" value="<?=@$ChkHomeRoom[0]->chk_home_id?>">
                                </tbody>    
                            </table>
                        </div>
                        <center>
                        <button type="submit" class="btn btn-<?=$ButtonClass;?>"><?=$ButtonName;?></button>
                        </center>
                        
                    </form>
                </div>
           
        </div>
    </div>
</section>