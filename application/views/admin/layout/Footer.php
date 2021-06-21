
<!-- Javascript -->
<script src="<?=base_url();?>assets/plugins/jquery-3.4.1.min.js"></script>
<script src="<?=base_url();?>assets/plugins/popper.min.js"></script>
<script src="<?=base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<!-- Style Switcher (REMOVE ON YOUR PRODUCTION SITE) -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?=base_url();?>assets/js/demo/style-switcher.js"></script>
<script src="<?=base_url();?>assets/js/admin/Academic.js?v=14"></script>
<?php $this->load->view('admin/layout/Alert.php'); ?>
<script>
 // Example starter JavaScript for disabling form submissions if there are invalid fields
 (function() {
        'use strict';

        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');

            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

$(function() {
    $('#checkOnOff').change(function() {
        $.post("<?=base_url('admin/ConAdminAcademinResult/CheckOnOff');?>", {
                check: $(this).prop('checked')
            },
            function(data, status) {

                //alert("Data: " + data + "\nStatus: " + status);
            });
    })

    
})


</script>

</body>

</html>