
<style>
    table{
        width: 100%;
    }
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  
}
</style>
                

               
                    
                      
                                    <table class="table table-bordered mb-0 text-left">
                                        <thead>
                                            <tr class="text-center">
                                                <th class="cell" rowspan="2">ที่</th>
                                                <th class="cell" rowspan="2">เลขประจำตัว</th>
                                                <th class="cell" rowspan="2">ชื่อ - นามสกุล</th>
                                                <th class="cell" rowspan="2">หลักสูตร</th>
                                                <th class="cell" rowspan="2">สถานะ</th>
                                                <th colspan="20">งาน</th>
                                            </tr>
                                            <tr class="text-center">
                                                <?php for ($i=1; $i <= 20; $i++) : ?>
                                                <th class="cell"><?=$i;?></th>
                                                <?php endfor; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($selStudent as $key => $v_selStudent) : ?>
                                            <tr>
                                                <td class="cell text-center"><?=$v_selStudent->StudentNumber?></td>
                                                <td class="cell text-center"><span
                                                        class="truncate"><?=$v_selStudent->StudentCode?></span></td>
                                                <td class="cell">
                                                    <?=$v_selStudent->StudentPrefix.$v_selStudent->StudentFirstName.' '.$v_selStudent->StudentLastName?>
                                                </td>
                                                <td class="cell text-center"><?=$v_selStudent->StudentStudyLine?></td>
                                                <td class="cell text-center"><?=$v_selStudent->StudentBehavior?></td>
                                                <?php for ($i=1; $i <= 20; $i++) : ?>
                                                <td class="cell"></td>
                                                <?php endfor; ?>
                                            </tr>
                                           
                                            <?php endforeach; ?>

                                        </tbody>
                                    </table>
                            
              
