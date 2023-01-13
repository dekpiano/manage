<style>
.border-left-primary {
    border-left: .25rem solid #5BC3D5 !important;
}

.textAlignVer1 {
    display: block;
    filter: flipv fliph;
    -webkit-transform: rotate(-90deg);
    -moz-transform: rotate(-90deg);
    transform: rotate(-90deg);
    position: relative;
    width: 20px;
    white-space: nowrap;
}
</style>
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-fluid d-flex justify-content-between">
            <div class="col-auto justify-content-start">
                <h1 class="app-page-title"><?=$title;?></h1>
            </div>
            <div class="col-auto justify-content-md-end">
                <div class="page-utilities">
                    <div class="row g-2  ">
                        <div class="col-auto">
                            <form action="#" method="post" class="d-flex align-items-center">
                                <select class="form-select w-auto ms-2" name="CheckYearSaveScore"
                                    id="CheckYearSaveScore">
                                    <option value="">เลือกห้องเรียน</option>
                                    <?php foreach ($Room as $key => $v_Room) : ?>
                                    <option value="<?=$v_Room?>"><?=$v_Room?></option>
                                    <?php endforeach; ?>
                                </select>
                                <button class="btn app-btn-primary clickLoder ms-3" type="submit">ค้นหา</button>
                            </form>
                        </div>
                    </div>
                    <!--//row-->
                </div>
                <!--//table-utilities-->
            </div>
        </div>
        <!--//container-->
        </section>
        <section class="we-offer-area">
            <div class="container-fluid">

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered mb-0 text-left" id="">
                                <thead>
                                    <tr class="text-center">
                                        <th class="cell">เลขที่</th>
                                        <th class="cell">เลขประจำตัว</th>
                                        <th class="cell">ชื่อ - นามสกุล</th>
                                        <?php foreach ($RegisSubject as $key => $v_RegisSubject): ?>
                                        <th class="cell" colspan="4">
                                            <div class="textAlignVer">
                                                <?=$v_RegisSubject->SubjectCode?><br>
                                                <?=$v_RegisSubject->SubjectName?>
                                            </div>
                                        </th>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <th class="" colspan="3"></th>
                                        <?php foreach ($RegisSubject as $key => $v_RegisSubject): ?>
                                        <th class="">ก่อน</th>
                                        <th class="">สอบ</th>
                                        <th class="">หลัง</th>
                                        <th class="">สอบ</th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php                                    
                                    foreach ($CheckSub as $key => $v_stu) :
                                        //echo '<pre>'; print_r($v_stu);
                                    ?>
                                    
                                    <tr>
                                        <td><?=$v_stu[1]?></td>
                                        <td><?=$v_stu[3]?></td>
                                        <td><?=$v_stu[2]?></td>
                                        <?php $i = 4;
                                        
                                        foreach ($RegisSubject as $key1 => $v_RegisSubject): 
                                            $sub = explode("/",@$v_stu[$i]);
                                            echo $sub[0];
                                            if($v_RegisSubject->SubjectCode == $sub[0]):
                                        ?>
                                        <td><?=$v_RegisSubject->SubjectCode;?></td>
                                        <td><?=$i;?></td>
                                        <td></td>
                                        <td></td>
                                        <?php else : ?>
                                        <td><?=$i;?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td> 
                                        <?php endif; ?>
                                        <?php $i++; endforeach; ?>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

    </div>
    </section>

</div>
<!--//main-wrapper-->