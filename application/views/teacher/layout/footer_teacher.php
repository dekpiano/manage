          <!-- Page Footer-->
          <footer class="main-footer">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-sm-6">
                          <p>ระบบงานวิชาการ โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์ &copy; 2021</p>
                      </div>
                      <div class="col-sm-6 text-right">
                          <p>Design by <a href="https://www.facebook.com/dekpiano/"
                                  class="external">Dekpiano</a></p>
                          <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                      </div>
                  </div>
              </div>
          </footer>
          </div>
          </div>
          </div>
          <!-- JavaScript files-->
          <script src="<?=base_url()?>assets/vendor/jquery/jquery.min.js"></script>
          <script src="<?=base_url()?>assets/vendor/popper.js/umd/popper.min.js"> </script>
          <script src="<?=base_url()?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
          <script src="<?=base_url()?>assets/vendor/jquery.cookie/jquery.cookie.js"> </script>
          <script src="<?=base_url()?>assets/vendor/chart.js/Chart.min.js"></script>
          <script src="<?=base_url()?>assets/vendor/jquery-validation/jquery.validate.min.js"></script>
          <script src="<?=base_url()?>assets/js/charts-home.js"></script>
          <!-- Main File -->
          <script src="<?=base_url()?>assets/js/front.js"></script>
          <script src="<?=base_url()?>assets/js/jquery.datetimepicker.js"></script>
          <!-- DataTable -->
          <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
          <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
          <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
          <script src="<?=base_url()?>assets/js/admin/Academic.js?v=6"></script>

          </body>

          <?php if($this->session->flashdata('msg') == 'YES'):?>
          <script>
Swal.fire("แจ้งเตือน", "<?=$this->session->flashdata('messge');?>", "<?=$this->session->flashdata('status');?>");
          </script>
          <?php endif; $this->session->mark_as_temp('msg',20); ?>


          <script>
$(document).ready(function() {
    $('#example').DataTable({
        "order": [
            [5, "desc"]
        ]
    });
    $('#tb_checkplan').DataTable({
        "order": [
            [6, "desc"]
        ]
    });

    jQuery('#seplanset_startdate').datetimepicker({
        lang: 'th',
        format:'d-m-Y H:i:s'
    });
    jQuery('#seplanset_enddate').datetimepicker({
        lang: 'th',
        format:'d-m-Y H:i:s'
    });

});


// Disable form submissions if there are invalid fields
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Get the forms we want to add validation styles to
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
          </script>

          </html>