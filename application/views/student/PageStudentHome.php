 <div class="app-wrapper">

     <div class="app-content pt-3 p-md-3 p-lg-4">
         <div class="container-xl">

             <!-- <h1 class="app-page-title">Overview</h1> -->

             <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                 <div class="inner">
                     <div class="app-card-body p-3 p-lg-4">
                         <h3 class="mb-3">Welcome, <?=$this->session->userdata('fullname');?></h3>
                         <div class="row gx-5 gy-3">
                             <div class="col-12 col-lg-9">

                                 <div>ระบบงานวิชาการสำหรับนักเรียน</div>
                             </div>
                             <!--//col-->

                             <!--//col-->
                         </div>
                         <!--//row-->
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>
                     <!--//app-card-body-->

                 </div>
                 <!--//inner-->
             </div>

             <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
                 <div class="app-card app-card-doc shadow-sm h-100">
                     <div class="app-card-thumb-holder p-3">
                         <span class="icon-holder">
                             <svg class="svg-inline--fa fa-file-lines text-file" aria-hidden="true" focusable="false"
                                 data-prefix="fas" data-icon="file-lines" role="img" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 384 512" data-fa-i2svg="">
                                 <path fill="currentColor"
                                     d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM112 256H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16z">
                                 </path>
                             </svg><!-- <i class="fas fa-file-alt text-file"></i> Font Awesome fontawesome.com -->
                         </span>
                         <span class="badge bg-success">NEW</span>
                         <a class="Loader app-card-link-mask" href="<?=base_url('Student/AcademicResult');?>"></a>
                     </div>
                     <div class="app-card-body p-3 has-card-actions">

                         <h4 class="app-doc-title truncate mb-0"><a href="#file-link">ผลการเรียน</a>
                         </h4>
                         <div class="app-doc-meta">
                             <ul class="list-unstyled mb-0">
                                 <li><span class="text-muted">Update:</span> 2/2566, 25/3/2567</li>
                             </ul>
                         </div>
                         <!--//app-doc-meta-->

                     </div>
                     <!--//app-card-body-->

                 </div>
                 <!--//app-card-->
             </div>


         </div>
         <!--//container-fluid-->
     </div>
     <!--//app-content-->



 </div>
 <!--//app-wrapper-->