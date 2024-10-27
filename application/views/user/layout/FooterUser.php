</div>
<!--//app-wrapper-->

<script src="<?=base_url();?>assets/plugins/jquery-3.4.1.min.js"></script>
<!-- Javascript -->
<script src="<?=base_url();?>assets/plugins/popper.min.js"></script>
<script src="<?=base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.27.0/slimselect.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    -->

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Page Specific JS -->
<script src="<?=base_url();?>assets/js/app.js"></script>

<script src="<?=base_url();?>assets/js/User/StudentsList.js?v=2"></script>

<script src="<?=base_url();?>assets/js/CountdownTimer.js?v=16"></script>

<?php if($this->uri->segment(1) == "ClassSchedule"):?>
<script src="<?=base_url();?>assets/js/User/UserClassSchedule.js?v=2"></script>
<?php  endif; ?>

<script>
    $('.TB-roomonline').DataTable({
        "responsive": true,
        "order": [[ 2, "asc" ]]
    });
</script>
<?php if($this->session->flashdata('status') == 'OK'):?>
<script>
Swal.fire({
    icon: '<?=$this->session->flashdata('alert');?>',
    title: "แจ้งเตือน",
    html: '<?=$this->session->flashdata('messge');?><br/>ติดต่องานวิชาการ',
    confirmButtonText: "ตกลง",
});
</script>
<?php endif; $this->session->mark_as_temp('status',20); ?>
</body>

</html>