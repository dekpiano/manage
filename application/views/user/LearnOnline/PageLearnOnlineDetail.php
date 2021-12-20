<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <h3>ห้องเรียนออนไลน์</h3>

            <form class="row g-3" action="<?=base_url('LearningOnline')?>" method="get">
                <div class="col-4">
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="s">
                        <option value="">เลือกห้องเรียน</option>
                        <?php $ListRoom = $this->classroom->ListRoom();
                foreach ($ListRoom as $key => $v_ListRoom):
            ?>
                        <option value="<?=$v_ListRoom;?>">ม.<?=$v_ListRoom;?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn-primary mb-3 btn-lg text-white">ค้นหาห้อง</button>
                </div>
            </form>

            <?php if(!empty($room)):?>

            <div class="main-section categories-view1-full">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">รหัสวิชา</th>
                            <th scope="col">ชื่อวิชา</th>
                            <th scope="col">ครูผู้สอน</th>
                            <th scope="col">ระดับชั้น</th>
                            <th scope="col">ห้องส่ง Classroom</th>
                            <th scope="col">ห้องเรียนออนไลน์ เช่น Meet ,Line, Zoom และอื่นๆ </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($room as $key => $v_room) : ?>
                        <tr>
                            <th><?=$v_room->roomon_coursecode?></th>
                            <th ><?=$v_room->roomon_coursename?></th>
                            <td><?=$v_room->pers_prefix.$v_room->pers_firstname.' '.$v_room->pers_lastname?></td>
                            <td><?=$v_room->roomon_classlevel?></td>
                            <td>
                                <?php $sub = explode("//",$v_room->roomon_linkroom);
                            $subb = explode('.',$sub[1]);
                            ?>
                            <a href="<?=$v_room->roomon_linkroom;?>"><?=$subb[0]?></a>
                            </td>
                            <td><?=$v_room->roomon_liveroom?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php endif; ?>

        </div>
    </div>
</div>