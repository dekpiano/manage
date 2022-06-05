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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.27.0/slimselect.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<!-- Page Specific JS -->
<script src="<?=base_url();?>assets/js/app.js?v=1"></script>

<?php if($this->session->flashdata('msg') == 'YES'):?>
<script>
Swal.fire("แจ้งเตือน", "<?=$this->session->flashdata('messge');?>", "<?=$this->session->flashdata('status');?>");
</script>
<?php endif; $this->session->mark_as_temp('msg',20); ?>

<script>
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

<script src="<?=base_url();?>assets/js/admin/Academic.js?v=37"></script>
<script src="<?=base_url();?>assets/js/admin/Affairs.js?v=2"></script>

</body>

</html>