<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <section class="cta-section theme-bg-light py-5">
                <div class="container text-center">

                    <h2 class="heading">จัดการข้อมูล<?=$title;?></h2>
                    
                    <div class="row justify-content-center">
                        <div class="col-lg-4">
                        <p>ประจำวันที่</p>
                        <input type="text" class="form-control show_date" id="show_date" value="<?=date("d-m-Y")?>" style="text-align: center">
                        </div>

                    </div>

                </div>
                <!--//container-->
            </section>
            <div class="container-xl">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body p-3">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left" id="ShowDashborad">
                                <thead>
                                    <tr>
                                        <th class="cell">ระดับชั้น</th>
                                        <th class="cell">มา</th>
                                        <th class="cell">ขาด</th>
                                        <th class="cell">สาย</th>
                                        <th class="cell">ลา</th>
                                        <th class="cell">กิจกรรม</th>
                                        <th class="cell">ไม่เข้าเรียน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($showHR as $key => $v_showHR) : 
                                      $v_showHR->chk_home_ma !== "" ? $data_ma =  count(explode('|', $v_showHR->chk_home_ma)) : $data_ma = 0;
                                      $v_showHR->chk_home_khad !== "" ? $data_khad =  count(explode('|', $v_showHR->chk_home_khad)) : $data_khad = 0;
                                      $v_showHR->chk_home_sahy !== "" ? $data_sahy =  count(explode('|', $v_showHR->chk_home_sahy)) : $data_sahy = 0;
                                      $v_showHR->chk_home_la !== "" ? $data_la =  count(explode('|', $v_showHR->chk_home_la)) : $data_la = 0;            
                                      $v_showHR->chk_home_kid !== "" ? $data_kid =  count(explode('|', $v_showHR->chk_home_kid)) : $data_kid = 0;
                                      $v_showHR->chk_home_hnee !== "" ? $data_hnee =  count(explode('|', $v_showHR->chk_home_hnee)) : $data_hnee = 0;    
                                    ?>
                                    <tr>
                                        <td class="cell">มัธยมศึกษาปีที่ <?=$v_showHR->chk_home_room?></td>
                                        <td class="cell"><?=$data_ma;?></span></td>
                                        <td class="cell"><?=$data_khad;?></td>
                                        <td class="cell"><?=$data_sahy;?></td>
                                        <td class="cell"><?=$data_la;?></td>
                                        <td class="cell"><?=$data_kid;?></td>
                                        <td class="cell"><?=$data_hnee;?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-center">รวม</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!--//table-responsive-->

                    </div>
                    <!--//app-card-body-->
                </div>





            </div>

        </div>
    </div>