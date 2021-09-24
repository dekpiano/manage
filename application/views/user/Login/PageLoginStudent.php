<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="row g-0 app-auth-wrapper" style="background: rgb(13 110 253 / 0%);">
                <div class="col-12  auth-main-col text-center p-5">
                    <div class="d-flex flex-column align-content-end">
                        <div class="app-auth-body mx-auto">
                            <div class="app-auth-branding mb-4">
                                <a class="app-logo" href="index.html">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor"
                                        class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
                                        <path fill-rule="evenodd"
                                            d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                    </svg>
                                </a>
                            </div>
                            <h2 class="auth-heading text-center mb-5">ล็อคอินสำหรับนักเรียน</h2>
                            <div class="auth-form-container text-left">
                                <form class="auth-form login-form form-validate" method="post"
                                    action="<?=base_url('control_login/check_student');?>">
                                    <div class="email mb-3">
                                        <label class="sr-only" for="signin-email">เลขประจำตัวนักเรียน 5 หลัก</label>
                                        <input id="username" name="username" type="text"
                                            class="form-control signin-email" placeholder="เลขประจำตัวนักเรียน 5 หลัก"
                                            required="required">

                                    </div>
                                    <!--//form-group-->
                                    <div class="password mb-3">
                                        <label class="sr-only" for="signin-password">เลขประจำตัวประชาชน 13 หลัก</label>
                                        <input id="password" name="password" type="text"
                                            class="form-control signin-password"
                                            placeholder="เลขประจำตัวประชาชน 13 หลัก" required="required">

                                    </div>
                                    <!--//form-group-->
                                    <div class="text-center">
                                        <button type="submit" class="btn app-btn-primary btn-block theme-btn mx-auto">
                                            <i class="bi bi-box-arrow-in-right"></i>Log
                                            In
                                        </button>
                                    </div>
                                </form>


                            </div>
                            <!--//auth-form-container-->

                        </div>
                        <!--//auth-body-->

                    </div>
                    <!--//flex-column-->
                </div>

            </div>
        </div>
    </div>
</div>