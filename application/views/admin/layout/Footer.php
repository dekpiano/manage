</div>
<!--//app-wrapper-->
 <!-- Modal -->
 <div class="modal fade" id="ShowStudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">รายชื่อนักเรียน</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <table class="table table-hover" id="TB_showstudent">
                              <thead>
                                  <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">เลขประจำตัว</th>
                                      <th scope="col">ชื่อ - นามสกุล</th>
                                  </tr>
                              </thead>
                              <tbody>

                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>


<script src="<?=base_url();?>assets/plugins/jquery-3.4.1.min.js"></script>
<!-- Javascript -->
<script src="<?=base_url();?>assets/plugins/popper.min.js"></script>
<script src="<?=base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js
"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.27.1/slimselect.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script src="https://cdn.rawgit.com/crlcu/multiselect/v2.5.1/dist/js/multiselect.min.js"></script>
<!-- Page Specific JS -->
<script src="<?=base_url();?>assets/js/app.js?v=1"></script>

<script src="<?=base_url();?>assets/plugins/bootstrap-datepicker.js?v=2"></script>

<?php if($this->session->flashdata('msg') == 'YES'):?>
<script>
Swal.fire("แจ้งเตือน", "<?=$this->session->flashdata('messge');?>", "<?=$this->session->flashdata('status');?>");
</script>
<?php endif; $this->session->mark_as_temp('msg',20); ?>

<script>
    $('#example').DataTable({
    "responsive": true,
    "ordering": false,
});

</script>

<script> 
 $.datetimepicker.setLocale('th');
    $("#pers_britday").datetimepicker({
        timepicker:false,
        format:'d-m-Y',  // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000            
        lang:'th',  // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
        onSelectDate:function(dp,$input){
            var yearT=new Date(dp).getFullYear()-0;  
            var yearTH=yearT+543;
            var fulldate=$input.val();
            var fulldateTH=fulldate.replace(yearT,yearTH);
            $input.val(fulldateTH);
        },
    });
     // กรณีใช้กับ input ต้องกำหนดส่วนนี้ด้วยเสมอ เพื่อปรับปีให้เป็น ค.ศ. ก่อนแสดงปฏิทิน
     $("#pers_britday").on("mouseenter mouseleave",function(e){
        var dateValue=$(this).val();
        if(dateValue!=""){
                var arr_date=dateValue.split("-"); // ถ้าใช้ตัวแบ่งรูปแบบอื่น ให้เปลี่ยนเป็นตามรูปแบบนั้น
                // ในที่นี้อยู่ในรูปแบบ 00-00-0000 เป็น d-m-Y  แบ่งด่วย - ดังนั้น ตัวแปรที่เป็นปี จะอยู่ใน array
                //  ตัวที่สอง arr_date[2] โดยเริ่มนับจาก 0 
                if(e.type=="mouseenter"){
                    var yearT=arr_date[2]-543;
                }       
                if(e.type=="mouseleave"){
                    var yearT=parseInt(arr_date[2])+543;
                }   
                dateValue=dateValue.replace(arr_date[2],yearT);
                $(this).val(dateValue);                                                 
        }       
    });


    $(function() {
        $("#show_date").datepicker({
            dateFormat: "dd-mm-yy", //กำหนดรูปแบบวันที่ ปี - เดือน - วัน
            yearOffset:543,
            changeMonth: true, // กำหนดให้เปลี่ยนเดือนได้
            changeYear: true, //กำหนดให้เปลี่ยนปีได้
            dayNamesMin: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"], //กำหนดชื่อย่อของวัน เป็น ภาษาไทย
            monthNamesShort: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม",
                "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
            ],
        });
    });

 
$('#multiselect').multiselect();


new SlimSelect({
    select: '#teacher'
})
new SlimSelect({
    select: '#classroom'
})



</script>

<script src="<?=base_url();?>assets/js/student/ExtraSubject_js.js?v=1"></script>

<script src="<?=base_url();?>assets/js/admin/Academic/Academic.js?v=54"></script>

<?php if($this->uri->segment(3) ==="Registration"): ?>   
    <script src="<?=base_url();?>assets/js/admin/Academic/AcadeEnroll.js?v=28"></script>  
    <script src="<?=base_url();?>assets/js/admin/Academic/AcadeRegisRepeat.js?v=10"></script>  
    <?php if($this->uri->segment(4) ==="Students"): ?> 
        <script src="<?=base_url();?>assets/js/admin/Academic/AcadeStudent.js?v=17"></script>
    <?php endif; ?>
<?php endif; ?>
<?php if($this->uri->segment(3) ==="Course"): ?>
    <script src="<?=base_url();?>assets/js/admin/Academic/AcadeRegisterSubject.js?v=15"></script> 
    <script src="<?=base_url();?>assets/js/admin/Academic/AcadeSendPlan.js?v=10"></script>
<?php endif; ?>  
<?php if($this->uri->segment(3) ==="Evaluate" || $this->uri->segment(3) ==="Executive"): ?>
<script src="<?=base_url();?>assets/js/admin/Academic/AcadeSaveScore.js?v=17"></script>
<script src="<?=base_url();?>assets/js/admin/Academic/AcadeReport.js?v=20"></script>
<script src="<?=base_url();?>assets/js/admin/Academic/AcadeStudent.js?v=13"></script>
<?php endif; ?>
<?php if($this->uri->segment(3) ==="Executive"): ?>
    <script src="<?=base_url();?>assets/js/admin/Academic/AcadeAdmission.js?v=1"></script>
<?php endif; ?>   
<?php if($this->uri->segment(3) ==="Personnel"): ?>
<script src="<?=base_url();?>assets/js/admin/General/GeneralPersonnel.js?v=13"></script>
<?php endif; ?>

<?php if($this->uri->segment(2) ==="Affairs"): ?>
<script src="<?=base_url();?>assets/js/admin/AffairsHomeRoom.js?v=8"></script>
<?php endif; ?>

<?php if($this->uri->segment(2) ==="General"): ?>
<script src="<?=base_url();?>assets/js/admin/General/GeneralAdminRoles.js?v=4"></script>
<?php endif; ?>

<script>
// ตั้งค่าปีการศึกษาที่ใช้ปัจจุบัน
$(document).on("change", "#schyear_year", function() {
    let y = $(this).val();
    $.post("<?=base_url();?>/admin/academic/ConAdminSchoolYear/SchoolYear", {
            schyear_year: $(this).val()
        },
        function(data, status) {
            //console.log(data);
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'เปลี่ยนแปลงปีการศึกษาเป็น ' + y + ' สำเร็จ',
                showConfirmButton: false,
                timer: 1500
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    window.location.reload();
                }
            })
        });
})

$(".clickLoder").click(function(){
  $('.loader').show();
});

$(document).on('click', '.clickLoad-spin', function() {
    // disable button
    $(this).prop("disabled", true);
    // add spinner to button
    $(this).html(
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> loading...'
    );
});


</script>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
})()
</script>

</body>

</html>