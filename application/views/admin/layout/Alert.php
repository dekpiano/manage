<?php if($this->session->flashdata('alert') == "success"): ?>
<script>
swal("แจ้งเตือน", "<?=$this->session->flashdata('messge');?>", "success");
</script>
<?php elseif($this->session->flashdata('alert') == "error"): ?>
<script>
swal("แจ้งเตือน", "<?=$this->session->flashdata('messge');?>", "error");
</script>
<?php endif; $this->session->mark_as_temp('alert',20);?>