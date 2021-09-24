<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">หน้าแรก</h2>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">

        <div class="statistic d-flex align-items-center bg-white has-shadow">
            <div class="icon bg-red"><i class="fa fa-tasks"></i></div>
            <?php $IfLen = strlen($CClass[0]->Reg_Class); ?>
            <div class="text"><strong>คุณใช้งานในสถานะ :
                    <?=$IfLen != 1 ? 'ครูที่ปรึกษา '.$CClass[0]->Reg_Class : 'หัวหน้าระดับ ม.'.$CClass[0]->Reg_Class ?>
                </strong></div>
        </div>

        <div class="card">
            <div class="card-close">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalAddHelp">+
                    ส่งงาน</button>
            </div>
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">งานเยี่ยมบ้าน / SDQ</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ปีการศึกษา</th>
                                <th>ระดับชั้น</th>
                                <th>ใบปะหน้า</th>
                                <th>SDQ</th>
                                <th>แบบบันทึก</th>
                                <th>สรุปข้อมูล</th>
                                <th>สถานะ</th>
                            </tr>
                        </thead>
                        <!-- สำหรับหัวหน้าระดับ -->
                        <?php if($IfLen == 1):?>
                            <tbody>
                            <?php 
                                foreach ($AllAffairs as $key => $v_Aff) : 
                                    $c = explode('/',$v_Aff->s_homevisit_class);
                                    //echo $c[0];
                                    if($c[0] == $CClass[0]->Reg_Class):
                            ?>
                            <tr>
                                <th scope="row"><?=$v_Aff->s_homevisit_year?></th>
                                <td>ม.<?=$v_Aff->s_homevisit_class?></td>
                                <td>
                                    <form class="add_filecoversheet"
                                        id="add_filecoversheet<?=$v_Aff->s_homevisit_id;?>">
                                        <div class="CheckTruefilecoversheet<?=$v_Aff->s_homevisit_id;?>">
                                            <?php if($v_Aff->s_homevisit_filecoversheet != NULL): ?>
                                            <span class="badge badge-success h6 text-white">ส่งแล้ว</span>
                                            <a href="<?=base_url('uploads/affairs/helpstd/filecoversheet/'.$v_Aff->s_homevisit_filecoversheet)?>"
                                                target="_blank" rel="noopener noreferrer">
                                                <span class="badge badge-primary h6 text-white"><i class="fa fa-eye"
                                                        aria-hidden="true" data-toggle="popover" data-trigger="hover"
                                                        data-content="เปิดดู" data-placement="top"></i></span>
                                            </a>
                                            <?php else : ?>
                                            <span class="badge badge-danger h6 text-white">ยังไม่ส่ง</span>
                                            <?php endif; ?>
                                            <?php if($IfLen == 3):?>
                                            <input type="hidden" id="AffID" name="AffID"
                                                value="<?=$v_Aff->s_homevisit_id?>">
                                            <label class="badge badge-warning h6" style="cursor: pointer;"
                                                data-toggle="popover" data-trigger="hover"
                                                data-content="เพิ่มหรือแก้ไขไฟล์" data-placement="top">
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                                <input id="s_homevisit_filecoversheet" name="s_homevisit_filecoversheet"
                                                    type="file" class="d-none">
                                            </label>
                                                <?php endif; ?>
                                        </div>
                                    </form>

                                </td>
                                <td>
                                    <form class="add_homevisit_fileSDQ"
                                        id="add_homevisit_fileSDQ<?=$v_Aff->s_homevisit_id;?>">
                                        <div class="CheckTruehomevisit_fileSDQ<?=$v_Aff->s_homevisit_id;?>">
                                            <?php if($v_Aff->s_homevisit_fileSDQ != NULL): ?>
                                            <span class="badge badge-success h6 text-white">ส่งแล้ว</span>
                                            <a href="<?=base_url('uploads/affairs/helpstd/fileSDQ/'.$v_Aff->s_homevisit_fileSDQ)?>"
                                                target="_blank" rel="noopener noreferrer">
                                                <span class="badge badge-primary h6 text-white"><i class="fa fa-eye"
                                                        aria-hidden="true" data-toggle="popover" data-trigger="hover"
                                                        data-content="เปิดดู" data-placement="top"></i></span>
                                            </a>
                                            <?php else : ?>
                                            <span class="badge badge-danger h6 text-white">ยังไม่ส่ง</span>
                                            <?php endif; ?>
                                            <?php if($IfLen == 3):?>
                                            <input type="hidden" id="AffID" name="AffID"
                                                value="<?=$v_Aff->s_homevisit_id?>">
                                            <label class="badge badge-warning h6" style="cursor: pointer;"
                                                data-toggle="popover" data-trigger="hover"
                                                data-content="เพิ่มหรือแก้ไขไฟล์" data-placement="top">
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                                <input id="s_homevisit_fileSDQ" name="s_homevisit_fileSDQ" type="file"
                                                    class="d-none">
                                            </label>
                                            <?php endif; ?>
                                        </div>
                                    </form>
                                </td>
                                <td>

                                    <form class="add_homevisit_filerecordform"
                                        id="add_homevisit_filerecordform<?=$v_Aff->s_homevisit_id;?>">
                                        <div class="CheckTruehomevisit_filerecordform<?=$v_Aff->s_homevisit_id;?>">
                                            <?php if($v_Aff->s_homevisit_filerecordform != NULL): ?>
                                            <span class="badge badge-success h6 text-white">ส่งแล้ว</span>
                                            <a href="<?=base_url('uploads/affairs/helpstd/filerecordform/'.$v_Aff->s_homevisit_filerecordform)?>"
                                                target="_blank" rel="noopener noreferrer">
                                                <span class="badge badge-primary h6 text-white"><i class="fa fa-eye"
                                                        aria-hidden="true" data-toggle="popover" data-trigger="hover"
                                                        data-content="เปิดดู" data-placement="top"></i></span>
                                            </a>
                                            <?php else : ?>
                                            <span class="badge badge-danger h6 text-white">ยังไม่ส่ง</span>
                                            <?php endif; ?>
                                            <?php if($IfLen == 3):?>
                                            <input type="hidden" id="AffID" name="AffID"
                                                value="<?=$v_Aff->s_homevisit_id?>">
                                            <label class="badge badge-warning h6" style="cursor: pointer;"
                                                data-toggle="popover" data-trigger="hover"
                                                data-content="เพิ่มหรือแก้ไขไฟล์" data-placement="top">
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                                <input id="s_homevisit_filerecordform" name="s_homevisit_filerecordform"
                                                    type="file" class="d-none">
                                            </label>
                                            <?php endif; ?>
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    <form class="add_homevisit_filesummary"
                                        id="add_homevisit_filesummary<?=$v_Aff->s_homevisit_id;?>">
                                        <div class="CheckTruehomevisit_filesummary<?=$v_Aff->s_homevisit_id;?>">
                                            <?php if($v_Aff->s_homevisit_filesummary != NULL): ?>
                                            <span class="badge badge-success h6 text-white">ส่งแล้ว</span>
                                            <a href="<?=base_url('uploads/affairs/helpstd/filesummary/'.$v_Aff->s_homevisit_filesummary)?>"
                                                target="_blank" rel="noopener noreferrer">
                                                <span class="badge badge-primary h6 text-white"><i class="fa fa-eye"
                                                        aria-hidden="true" data-toggle="popover" data-trigger="hover"
                                                        data-content="เปิดดู" data-placement="top"></i></span>
                                            </a>
                                            <?php else : ?>
                                            <span class="badge badge-danger h6 text-white">ยังไม่ส่ง</span>
                                            <?php endif; ?>
                                            <?php if($IfLen == 3):?>
                                            <input type="hidden" id="AffID" name="AffID"
                                                value="<?=$v_Aff->s_homevisit_id?>">
                                            <label class="badge badge-warning h6" style="cursor: pointer;"
                                                data-toggle="popover" data-trigger="hover"
                                                data-content="เพิ่มหรือแก้ไขไฟล์" data-placement="top">
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                                <input id="s_homevisit_filesummary" name="s_homevisit_filesummary"
                                                    type="file" class="d-none">
                                            </label>
                                            <?php endif; ?>
                                        </div>
                                    </form>
                                </td>
                                <td>
                                <?php if($IfLen == 1):?>
                                    <form class="ConfrimStatus" method="post">
                                    <input type="hidden" id="AffID" name="AffID"
                                                value="<?=$v_Aff->s_homevisit_id?>">
                                    <select name="s_homevisit_status" id="s_homevisit_status" class="form-control mb-3">
                                        <option value="รอตรวจ">รอตรวจ</option>
                                        <option <?=$v_Aff->s_homevisit_status == "ผ่าน" ? "selected" : "" ?> value="ผ่าน">ผ่าน</option>
                                        <option <?=$v_Aff->s_homevisit_status == "ไม่ผ่าน" ? "selected" : "" ?> value="ไม่ผ่าน">ไม่ผ่าน</option>
                                    </select>
                                    </form>
                                    <?php else : echo $v_Aff->s_homevisit_status; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                        <?php endif; ?>
                        <?php if($IfLen == 3):?>
                        <tbody>
                            <?php 
                                foreach ($AllAffairs as $key => $v_Aff) : 
                                    $c = explode('/',$v_Aff->s_homevisit_class);
                                    //echo $c[0];
                                   // if($c[0] == $CClass[0]->Reg_Class):
                            ?>
                            <tr>
                                <th scope="row"><?=$v_Aff->s_homevisit_year?></th>
                                <td>ม.<?=$v_Aff->s_homevisit_class?></td>
                                <td>
                                    <form class="add_filecoversheet"
                                        id="add_filecoversheet<?=$v_Aff->s_homevisit_id;?>">
                                        <div class="CheckTruefilecoversheet<?=$v_Aff->s_homevisit_id;?>">
                                            <?php if($v_Aff->s_homevisit_filecoversheet != NULL): ?>
                                            <span class="badge badge-success h6 text-white">ส่งแล้ว</span>
                                            <a href="<?=base_url('uploads/affairs/helpstd/filecoversheet/'.$v_Aff->s_homevisit_filecoversheet)?>"
                                                target="_blank" rel="noopener noreferrer">
                                                <span class="badge badge-primary h6 text-white"><i class="fa fa-eye"
                                                        aria-hidden="true" data-toggle="popover" data-trigger="hover"
                                                        data-content="เปิดดู" data-placement="top"></i></span>
                                            </a>
                                            <?php else : ?>
                                            <span class="badge badge-danger h6 text-white">ยังไม่ส่ง</span>
                                            <?php endif; ?>
                                            <?php if($IfLen == 3):?>
                                            <input type="hidden" id="AffID" name="AffID"
                                                value="<?=$v_Aff->s_homevisit_id?>">
                                            <label class="badge badge-warning h6" style="cursor: pointer;"
                                                data-toggle="popover" data-trigger="hover"
                                                data-content="เพิ่มหรือแก้ไขไฟล์" data-placement="top">
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                                <input id="s_homevisit_filecoversheet" name="s_homevisit_filecoversheet"
                                                    type="file" class="d-none">
                                            </label>
                                                <?php endif; ?>
                                        </div>
                                    </form>

                                </td>
                                <td>
                                    <form class="add_homevisit_fileSDQ"
                                        id="add_homevisit_fileSDQ<?=$v_Aff->s_homevisit_id;?>">
                                        <div class="CheckTruehomevisit_fileSDQ<?=$v_Aff->s_homevisit_id;?>">
                                            <?php if($v_Aff->s_homevisit_fileSDQ != NULL): ?>
                                            <span class="badge badge-success h6 text-white">ส่งแล้ว</span>
                                            <a href="<?=base_url('uploads/affairs/helpstd/fileSDQ/'.$v_Aff->s_homevisit_fileSDQ)?>"
                                                target="_blank" rel="noopener noreferrer">
                                                <span class="badge badge-primary h6 text-white"><i class="fa fa-eye"
                                                        aria-hidden="true" data-toggle="popover" data-trigger="hover"
                                                        data-content="เปิดดู" data-placement="top"></i></span>
                                            </a>
                                            <?php else : ?>
                                            <span class="badge badge-danger h6 text-white">ยังไม่ส่ง</span>
                                            <?php endif; ?>
                                            <?php if($IfLen == 3):?>
                                            <input type="hidden" id="AffID" name="AffID"
                                                value="<?=$v_Aff->s_homevisit_id?>">
                                            <label class="badge badge-warning h6" style="cursor: pointer;"
                                                data-toggle="popover" data-trigger="hover"
                                                data-content="เพิ่มหรือแก้ไขไฟล์" data-placement="top">
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                                <input id="s_homevisit_fileSDQ" name="s_homevisit_fileSDQ" type="file"
                                                    class="d-none">
                                            </label>
                                            <?php endif; ?>
                                        </div>
                                    </form>
                                </td>
                                <td>

                                    <form class="add_homevisit_filerecordform"
                                        id="add_homevisit_filerecordform<?=$v_Aff->s_homevisit_id;?>">
                                        <div class="CheckTruehomevisit_filerecordform<?=$v_Aff->s_homevisit_id;?>">
                                            <?php if($v_Aff->s_homevisit_filerecordform != NULL): ?>
                                            <span class="badge badge-success h6 text-white">ส่งแล้ว</span>
                                            <a href="<?=base_url('uploads/affairs/helpstd/filerecordform/'.$v_Aff->s_homevisit_filerecordform)?>"
                                                target="_blank" rel="noopener noreferrer">
                                                <span class="badge badge-primary h6 text-white"><i class="fa fa-eye"
                                                        aria-hidden="true" data-toggle="popover" data-trigger="hover"
                                                        data-content="เปิดดู" data-placement="top"></i></span>
                                            </a>
                                            <?php else : ?>
                                            <span class="badge badge-danger h6 text-white">ยังไม่ส่ง</span>
                                            <?php endif; ?>
                                            <?php if($IfLen == 3):?>
                                            <input type="hidden" id="AffID" name="AffID"
                                                value="<?=$v_Aff->s_homevisit_id?>">
                                            <label class="badge badge-warning h6" style="cursor: pointer;"
                                                data-toggle="popover" data-trigger="hover"
                                                data-content="เพิ่มหรือแก้ไขไฟล์" data-placement="top">
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                                <input id="s_homevisit_filerecordform" name="s_homevisit_filerecordform"
                                                    type="file" class="d-none">
                                            </label>
                                            <?php endif; ?>
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    <form class="add_homevisit_filesummary"
                                        id="add_homevisit_filesummary<?=$v_Aff->s_homevisit_id;?>">
                                        <div class="CheckTruehomevisit_filesummary<?=$v_Aff->s_homevisit_id;?>">
                                            <?php if($v_Aff->s_homevisit_filesummary != NULL): ?>
                                            <span class="badge badge-success h6 text-white">ส่งแล้ว</span>
                                            <a href="<?=base_url('uploads/affairs/helpstd/filesummary/'.$v_Aff->s_homevisit_filesummary)?>"
                                                target="_blank" rel="noopener noreferrer">
                                                <span class="badge badge-primary h6 text-white"><i class="fa fa-eye"
                                                        aria-hidden="true" data-toggle="popover" data-trigger="hover"
                                                        data-content="เปิดดู" data-placement="top"></i></span>
                                            </a>
                                            <?php else : ?>
                                            <span class="badge badge-danger h6 text-white">ยังไม่ส่ง</span>
                                            <?php endif; ?>
                                            <?php if($IfLen == 3):?>
                                            <input type="hidden" id="AffID" name="AffID"
                                                value="<?=$v_Aff->s_homevisit_id?>">
                                            <label class="badge badge-warning h6" style="cursor: pointer;"
                                                data-toggle="popover" data-trigger="hover"
                                                data-content="เพิ่มหรือแก้ไขไฟล์" data-placement="top">
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                                <input id="s_homevisit_filesummary" name="s_homevisit_filesummary"
                                                    type="file" class="d-none">
                                            </label>
                                            <?php endif; ?>
                                        </div>
                                    </form>
                                </td>
                                <td>
                                <?php if($IfLen == 1):?>
                                    <form class="ConfrimStatus" method="post">
                                    <input type="hidden" id="AffID" name="AffID"
                                                value="<?=$v_Aff->s_homevisit_id?>">
                                    <select name="s_homevisit_status" id="s_homevisit_status" class="form-control mb-3">
                                        <option value="">รอตรวจ</option>
                                        <option <?=$v_Aff->s_homevisit_status == "ผ่าน" ? "selected" : "" ?> value="ผ่าน">ผ่าน</option>
                                        <option <?=$v_Aff->s_homevisit_status == "ไม่ผ่าน" ? "selected" : "" ?> value="ไม่ผ่าน">ไม่ผ่าน</option>
                                    </select>
                                    </form>
                                    <?php else : echo $v_Aff->s_homevisit_status; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="ModalAddHelp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เลือกปีการศึกษา</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?=base_url('Teacher/SupStdMain/Add')?>" method="post">
                <div class="modal-body">
                    <select class="form-control mb-3" id="s_homevisit_year" name="s_homevisit_year">
                        <?php $d = date('Y')+543; 
                    for ($i=$d; $i <= $d+1; $i++):
                    ?>
                        <option value="<?=$i;?>"><?=$i;?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="ModalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="update_filecoversheet" id="update_filecoversheet<?=$v_Aff->s_homevisit_id;?>">

                    <input id="s_homevisit_filecoversheet_up" name="s_homevisit_filecoversheet_up" type="file"
                        class="form-control-file">
                </form>
            </div>

        </div>
    </div>
</div>