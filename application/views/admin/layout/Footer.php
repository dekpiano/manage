</div>
<!--//app-wrapper-->

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.27.0/slimselect.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<!-- Page Specific JS -->
<script src="<?=base_url();?>assets/js/app.js?v=1"></script>

<?php if($this->session->flashdata('msg') == 'YES'):?>
<script>
Swal.fire("แจ้งเตือน", "<?=$this->session->flashdata('messge');?>", "<?=$this->session->flashdata('status');?>");
</script>
<?php endif; $this->session->mark_as_temp('msg',20); ?>

<script>
    $(function() {
    $("#show_date").datepicker({
        dateFormat: "dd-mm-yy", //กำหนดรูปแบบวันที่ ปี - เดือน - วัน
        changeMonth: true, // กำหนดให้เปลี่ยนเดือนได้
        changeYear: true, //กำหนดให้เปลี่ยนปีได้
        dayNamesMin: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"], //กำหนดชื่อย่อของวัน เป็น ภาษาไทย
        monthNamesShort: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม",
            "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
        ],
    });
});
new SlimSelect({
    select: '#teacher'
})
new SlimSelect({
    select: '#classroom'
})
$('#example').DataTable({
    "responsive": true,
    "autoWidth": true,
    "ordering": false,
});






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

<script src="<?=base_url();?>assets/js/student/ExtraSubject_js.js?v=1"></script>
<script src="<?=base_url();?>assets/js/admin/AcadeStudent.js?v=4"></script>
<script src="<?=base_url();?>assets/js/admin/Academic.js?v=40"></script>
<script src="<?=base_url();?>assets/js/admin/AffairsHomeRoom.js?v=5.2"></script>

</body>

</html>