
	    
    </div><!--//app-wrapper-->    					

    <!-- <script src="<?=base_url();?>assets/plugins/jquery-3.4.1.min.js"></script> -->
    <!-- Javascript -->          
    <script src="<?=base_url();?>assets/plugins/popper.min.js"></script>
    <script src="<?=base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>  
    
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Page Specific JS -->
    <script src="<?=base_url();?>assets/js/app.js"></script> 
    <?php if($this->session->flashdata('msg') == 'OK'):?>
          <script>
            Swal.fire({
                icon: '<?=$this->session->flashdata('alert');?>',
                title: "แจ้งเตือน",
                html: '<?=$this->session->flashdata('messge');?>',
                confirmButtonText: "ตกลง",
            });
          </script>
          <?php endif; $this->session->mark_as_temp('msg',20); ?>
</body>
</html> 


