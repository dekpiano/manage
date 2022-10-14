<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="row g-0" style="background: rgb(13 110 253 / 0%);">
                <div class="col-md-6 align-self-center p-3">
                    <div class=" mb-4 border-left-decoration" role="alert">
                        <div class="inner">
                            <div class="app-card-body p-3 p-lg-4">
                                <div class="text-center mb-3">
                                    <img src="https://cdn-icons-png.flaticon.com/512/295/295128.png" alt="login Student"
                                        class="w-25">
                                </div>

                                <div class="text-center text-md-start">
                                    <h3 class="mb-3">ยินดีต้อนรับสู่ <br> ระบบงานวิชาการสำหรับนักเรียน</h3>
                                    <div class="row gx-5 gy-3">
                                        <div class="col-12 col-lg-9">
                                            <div>- ดูผลการเรียน</div>
                                        </div>
                                        <!--//col-->
                                    </div>
                                </div>

                            </div>
                            <!--//app-card-body-->
                        </div>
                        <!--//inner-->
                    </div>
                </div>
                <div class="col-md-6 align-self-center p-3">
                    <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                        <div class="inner">
                            <div class="app-card-body p-3 p-lg-4">
                                <h5 class="mb-3">เข้าสู่ระบบ</h5>
                                <form class="auth-form login-form form-validate" method="post"
                                    action="<?=base_url('control_login/check_student');?>">
                                    <div class="email mb-3">
                                        <label class="sr-only" for="signin-email">เลขประจำตัวนักเรียน 5 หลัก</label>
                                        <input id="username" name="username" type="text"
                                            class="form-control signin-email" placeholder="เลขประจำตัวนักเรียน 5 หลัก"
                                            required="required" autocomplete="on">

                                    </div>
                                    <!--//form-group-->
                                    <div class="password mb-3">
                                        <label class="sr-only" for="signin-password">เลขประจำตัวประชาชน 13 หลัก</label>
                                        <input id="password" name="password" type="text"
                                            class="form-control signin-password"
                                            placeholder="เลขประจำตัวประชาชน 13 หลัก" required="required"
                                            autocomplete="on">

                                    </div>
                                    <!--//form-group-->
                                    <div class="text-center">
                                        <button type="submit" class="btn app-btn-primary btn-block theme-btn mx-auto">
                                            <i class="bi bi-box-arrow-in-right"></i> Log
                                            In
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!--//app-card-body-->

                        </div>
                        <!--//inner-->
                    </div>
                </div>


            </div>
            <hr>
            <div class="auth-option text-center pt-5 h6">มีปัญหา ติอต่อสอบถามได้ที่งานวิชาการ หรือ
                ครูที่ปรึกษาที่นักเรียนประจำชั้นอยู่
                <!-- <a class="text-link" href="login.html">Log in</a></div> -->

                <!-- Histats.com  (div with counter) -->
                <div id="histats_counter"></div>
                <!-- Histats.com  START  (aync)-->
                <script type="text/javascript">
                var _Hasync = _Hasync || [];
                _Hasync.push(['Histats.startgif',
                    '1,4706850,4,10043,"div#histatsC {position: absolute;top:0px;left:0px;}body>div#histatsC {position: fixed;}"'
                ]);
                _Hasync.push(['Histats.fasi', '1']);
                _Hasync.push(['Histats.track_hits', '']);
                (function() {
                    var hs = document.createElement('script');
                    hs.type = 'text/javascript';
                    hs.async = true;
                    hs.src = ('//s10.histats.com/js15_gif_as.js');
                    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0])
                    .appendChild(hs);
                })();
                </script>
                <noscript><a href="/" alt="" target="_blank">
                        <div id="histatsC"><img border="0" src="//s4is.histats.com/stats/i/4706850.gif?4706850&103">
                        </div>
                    </a>
                </noscript>
                <!-- Histats.com  END  -->
            </div>

        </div>
    </div>