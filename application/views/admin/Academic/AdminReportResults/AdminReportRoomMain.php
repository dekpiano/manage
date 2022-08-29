<style>
.border-left-primary {
    border-left: .25rem solid #5BC3D5 !important;
}

th.rotated-text {
    position: relative;
    height: 200px;
    white-space: nowrap;
    padding: 0 !important;
    overflow: auto;
}

th.rotated-text>div {
    position: absolute;
    top: 100%;
    left: 50%;
    transform: rotate(-90deg) translateY(-50%);
    transform-origin: 0 0;
}

th.rotated-text>div>span {
    display: inline-block;
    padding: 0px 15px;
    padding-left: 5px;
}
</style>
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title">จัดการข้อมูล<?=$title;?></h1>
            <hr class="mb-4">
        </div>
        <!--//container-->
        </section>
        <section class="we-offer-area">
            <div class="container-fluid">

                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="cell">ลำดับที่</th>
                                    <th class="cell">ชื่อ - นามสกุล</th>
                                    <?php foreach ($subject as $key => $v_subject): ?>
                                    <th class="rotated-text">
                                        <div>
                                            <span>
                                                <?=$v_subject->SubjectUnit.' '.$v_subject->SubjectCode.' '.$v_subject->SubjectName ?>
                                            </span>
                                        </div>
                                    </th>
                                    <?php endforeach; ?>
                                    <th class="cell">GPA เกรดเฉลี่ย</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($stu as $key => $v_stu) : ?>
                                <tr>
                                    <td class="cell"><?=$v_stu->StudentNumber?></td>
                                    <td class="cell">
                                        <?=$v_stu->StudentPrefix.$v_stu->StudentFirstName?> <?=$v_stu->StudentLastName?>
                                    </td>
                                    <?php foreach ($subject as $key => $v_subject): ?>
                                    <td class="text-center">
                                        <div>
                                            <span>
                                                <?php foreach ($check as $key => $v_check):?>
                                                <?php if($v_subject->SubjectCode == $v_check->SubjectCode && $v_stu->StudentID == $v_check->StudentID): ?>

                                                <?php 
                                                if($v_check->StudyTime == ""){
                                                    
                                                }else{
                                                    if($v_check->StudyTime < 16){
                                                       echo "มส";
                                                    }else{
                                                        if($v_check->Score100 == null){

                                                        }else{
                                                            $sub = explode('|',$v_check->Score100); 
                                                           
                                                            $sum = array_sum($sub);
                                                            if(in_array("ร",$sub)){
                                                                echo "ร";
                                                            }else{                                                        
                                                                if($sub[0] == "" && $sub[1] == "" && $sub[2] == "" && $sub[3] == ""){
                                                                   
                                                                   }else{
                                                                    echo $this->grade->check_grade($sum);
                                                                   }
                                                            }
                                                        }

                                                    }
                                                    
                                                }
                                                
                                                ?>

                                                <?php endif; ?>
                                                <?php endforeach;?>
                                            </span>
                                        </div>


                                    </td>
                                    <?php endforeach; ?>
                                    <td class="cell">

                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

    </div>
    </section>

</div>
<!--//main-wrapper-->