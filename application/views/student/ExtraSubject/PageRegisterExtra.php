 <div class="app-wrapper">

     <div class="app-content pt-3 p-md-3 p-lg-4">
         <div class="container-xl">

             <h1 class="app-page-title">รายชื่อวิชาเลือกเพิ่มเติมที่เปิดให้ลงทะเบียน</h1>
             <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                 <div class="inner">
                     <div class="app-card-body p-3 p-lg-4">
                         <h5>ให้นักเรียนสามารถลงทะเบียนวิชาเพิ่มเติม
                             <u>เมื่อเลือกแล้วจะไม่สามารถแก้ไขได้อีกตัดสินใจให้ดีก่อนยืนยัน</u>
                         </h5>
                     </div>
                 </div>
             </div>
             <?php     
             $CutRoom = explode("ม.",$student[0]->StudentClass); 
                  
                     foreach ($ExtraGroupBy as $key => $v_ExtraGroupBy) : 
                     
                    $grade_level = explode("|",$v_ExtraGroupBy->extra_grade_level);
                    if(in_array($CutRoom[1],$grade_level)){
                        echo "<div class='mt-5'><h6 >รหัสเพิ่มเติมที่ ".$v_ExtraGroupBy->extra_key_room." <small>(เลือกได้ 1 วิชา)</small></h6></div><hr>";
                    }else{
                        // if($key == 0){
                        //     echo 'สำหรับรหัสนักเรียนนี้ <u>ยังไม่เปิดให้ลงทะเบียน</u> '; 
                        // }
                      
                    }
                      
                    
                  ?>
             <div class="row g-4 mb-4">
                 <?php 
                foreach ($Extra as $key => $v_Extra) : 
                  
                    $level = explode("|",$v_Extra->extra_grade_level);
                    if(in_array($CutRoom[1],$level)):
                        if($v_Extra->extra_key_room == $v_ExtraGroupBy->extra_key_room) :
                ?>

                 <div class="col-12 col-lg-4">
                     <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
                         <div class="app-card-header p-3 border-bottom-0">
                             <div class="row align-items-center gx-3">
                                 <h4 class="app-card-title px-3 text-success ">
                                     <?=$v_Extra->extra_course_code?> <?=$v_Extra->extra_course_name?>
                                 </h4>

                                 <!--//col-->
                             </div>
                             <!--//row-->
                         </div>
                         <!--//app-card-header-->
                         <div class="app-card-body px-4">
                             <div class="intro"><strong>รับสูงสุด :</strong> <?=$v_Extra->extra_number_students?> คน
                                 <span class="px-2">
                                     <?php $CountAllResigter = 0;
                                      if(empty($CountRegister) == ""){
                                        foreach ($CountRegister as $key => $v_CountRegister){
                                            if($v_Extra->extra_id == $v_CountRegister->fk_extra_id){
                                                $CountAllResigter += 1;
                                            }
                                        }
                                        echo '<strong>ปัจจุบัน '.$CountAllResigter.' คน</strong>';
                                    }
                                    ?>
                                 </span>
                             </div>
                             <div class="intro"><strong>ครูผู้สอน :</strong> <?=$v_Extra->extra_course_teacher?></div>
                             <div class="intro"><strong>รับสมัคร :</strong>
                                 <?php 
                                   
                                    foreach ($level as $key => $v_level) {
                                        echo " ม.".$v_level;
                                    }
                                 ?>
                                 <div class="intro"><strong>หมายเหตุ :</strong> 
                                 <span class="text-danger"><strong><?=$v_Extra->extra_comment?> </strong> </span> 
                                 </div>
                             </div>
                         </div>
                         <!--//app-card-body-->
                         <div class="p-4 ">
                             <div class="row justify-content-between">
                                 <div class="col-auto">
                                     <?php $residue = ($v_Extra->extra_number_students-$CountAllResigter);
                                   
                                     if($residue == 0){
                                        $disabled="disabled"; 
                                        $BtnColor = "warning";  
                                        $alertText ="ห้องเต็ม โปรดเลือกห้องอื่น"; 
                                     }else{
                                        $disabled=""; 
                                        $BtnColor = "primary";  
                                        $alertText ="ลงทะเบียน"; 
                                     }
                                       
                                     if(empty($register) == ""){
                                        foreach ($register as $key => $v_register){ 
                                            
                                            if($v_Extra->extra_key_room == $v_register->extra_key_room){
                                                if($v_Extra->extra_id == $v_register->fk_extra_id){
                                                    $disabled="disabled"; 
                                                    $BtnColor = "danger";  
                                                    $alertText ="ลงทะเบียนแล้ว"; 
                                                   
                                                    
                                                }else if($residue == 0){
                                                    $disabled="disabled"; 
                                                    $BtnColor = "warning";  
                                                    $alertText ="ห้องเต็ม โปรดเลือกห้องอื่น"; 
                                                }
                                                else{
                                                    $disabled="disabled"; 
                                                    $BtnColor = "primary";  
                                                    $alertText ="ลงทะเบียน"; 
                                                  
                                                }
                                                
                                            }else{  
                                               
                                               
                                            }
                                            //print_r($v_register);
                                        }
                                        
                                     }
                                    
                                      echo '<button type="button" class="btn btn-'.$BtnColor.' text-white SubRegister"
                                      na="'.$v_Extra->extra_course_name.'" id="SubRegister"
                                      extra_id="'.$v_Extra->extra_id.'" '.@$disabled.'>'.$alertText.'</button>';

                                   
                                    
                                    ?>


                                 </div>
                                 <div class="col-auto">
                                     <a class="btn app-btn-secondary CheckStudentRegisterSubject" href="#" data-bs-toggle="modal"
                                         data-bs-target="#ShowStudent" ExtraIdSubject="<?=$v_Extra->extra_id?>">รายชื่อสมาชิก</a>
                                 </div>
                             </div>
                         </div>
                         <!--//app-card-footer-->
                     </div>
                     <!--//app-card-->
                 </div>
                 <!--//col-->
                 <?php  endif; 
                     endif;
                endforeach; 
              ?>

             </div>
             <?php
            
                endforeach; 
            ?>


         </div>
         <!--//container-fluid-->
     </div>
     <!--//app-content-->



 </div>
 <!--//app-wrapper-->


 <!-- Modal -->
 <div class="modal fade" id="ShowStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">ชื่อสมาชิก</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <table class="table table-striped ShowStudentRegister">
                     <thead>
                         <tr>
                             <th scope="col">#</th>
                             <th scope="col">เลขประจำตัว</th>
                             <th scope="col">ชื่อ - นามสกุล</th>
                             <th scope="col">ชั้น</th>
                         </tr>
                     </thead>
                     <tbody>
                                               
                     </tbody>
                 </table>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
             </div>
         </div>
     </div>
 </div>