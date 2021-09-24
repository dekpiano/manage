<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <!-- <h1 class="app-page-title">Overview</h1> -->

            <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                <div class="inner">
                    <div class="app-card-body p-3 p-lg-4">
                        <h3 class="mb-3">รายงานการลงทะเบียน</h3>
                       
                        <div class="app-card-body">
                        <div class="table-responsive">
							        <table class="table app-table-hover mb-0 text-left " id="example">
										<thead>
											<tr>
												<th class="cell">ปีการศึกษา</th>
												<th class="cell">วิชาที่เลือก</th>
												<th class="cell">ครูผู้สอน</th>
												<th class="cell">ระดับชั้น</th>
												<th class="cell">เลขที่</th>
												<th class="cell">ชื่อ - นามสกุล</th>
												<th class="cell"></th>
											</tr>
										</thead>
										<tbody>
                                        <?php foreach ($Report as $key => $check): ?>
											<tr>
												<td class="cell"><?=$check->extra_term?>/<?=$check->extra_year?></td>
												<td class="cell"><strong><?=$check->extra_course_code?> <?=$check->extra_course_name?></strong></td>
												<td class="cell"><?=$check->extra_course_teacher?></td>
												<td class="cell"><?=$check->StudentClass?></td>
												<td class="cell"><?=$check->StudentNumber?></td>
												<td class="cell"><?=$check->StudentPrefix.$check->StudentFirstName.' '.$check->StudentLastName?></td>
												<td class="cell"><span class="badge bg-success">ลงทะเบียนแล้ว</span></td>
											</tr>
										<?php endforeach; ?>
		
										</tbody>
									</table>
						        </div>
								    
						    </div>
                       
                        
                    </div>
                    <!--//app-card-body-->
                </div>
                <!--//inner-->
            </div>

        </div>
        <!--//container-fluid-->
    </div>
    <!--//app-content-->



</div>
<!--//app-wrapper-->