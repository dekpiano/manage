
<!-- Javascript -->
<script src="<?=base_url();?>assets/plugins/jquery-3.4.1.min.js"></script>
<script src="<?=base_url();?>assets/plugins/popper.min.js"></script>
<script src="<?=base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<!-- Style Switcher (REMOVE ON YOUR PRODUCTION SITE) -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?=base_url();?>assets/js/demo/style-switcher.js"></script>
<script src="<?=base_url();?>assets/js/admin/Academic.js?v=11"></script>
<?php $this->load->view('admin/layout/Alert.php'); ?>
<script>
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