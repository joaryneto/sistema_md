<!doctype html>
<html lang="en">

<head>
    <? include 'css.php';?>
</head>

<body class="ui-rounded">
    <!-- Page laoder -->
    <div class="container-fluid pageloader">
        <div class="row h-100">
            <div class="col-12 align-self-start text-center">
            </div>
            <div class="col-12 align-self-center text-center">
                <div class="loader-logo">
                    <div class="logo">1<span>UX</span><span>UI</span>
                        <div class="loader-roller">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                    <h4 class="logo-text"><span>OneUIUX</span><small>Mobile HTML</small></h4>
                </div>
            </div>
            <div class="col-12 align-self-end text-center">
                <p class="my-5">Please wait<br><small class="text-mute">A world of great designs is loading...</small></p>
            </div>
        </div>
    </div>
    <!-- Page laoder ends -->



    <!-- Begin page content -->
    <main class="flex-shrink-0 main-container">
        <!-- page content goes here -->
        <div class="banner-hero vh-100 scroll-y bg-dark">
            <div class="background opac">
                <img src="template/images/login.jpg" alt="">
            </div>
            <div class="container h-100 text-white">
                <div class="row h-100 h-sm-auto">
                    <div class="col-12 col-md-8 col-lg-5 col-xl-4 mx-auto align-self-center text-center">
                        <div class="loader-logo">
                            <div class="logo">1<span>UX</span><span>UI</span>                                
                            </div>
                            <h4 class="logo-text"><span>OneUIUX</span><small>Mobile HTML</small></h4>
                        </div>
                        <br>
                        <br>
                        <h5 class="font-weight-light mb-1 text-mute">Welcome back,</h5>
                        <h3 class="font-weight-normal mb-4">Please Sign In</h3>

                        <div class="form-group">
                            <label for="inputEmail" class="sr-only">Email address</label>
                            <input type="email" id="inputEmail" class="form-control form-control-lg border-0" placeholder="Email address" required="" autofocus="">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="sr-only">Password</label>
                            <input type="password" id="inputPassword" class="form-control form-control-lg border-0" placeholder="Password" required="">
                        </div>

                        <div class="my-3 row">
                            <div class="col-6 col-md py-1 text-left">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" checked="">
                                    <label class="custom-control-label" for="customCheck1">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6 col-md py-1 text-right text-md-right">
                                <a href="forgotpassword.html" class="text-white">Forgot Password?</a>
                            </div>
                        </div>
                        <div class="mb-4">
                            <a href="#" class=" btn btn-lg btn-default default-shadow btn-block" Onclick="logar();">Sign In <span class="ml-2 icon arrow_right"></span></a>
                        </div>
                        <div class="mb-4">
                            <p>Do not have account yet?<br>Please <a href="#" class="text-white" Onclick="recovery();">Sign up</a> here.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
	<div id="modalform" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog modal-lg">
<div class="modal-content" id="modals">
</div>
</div>
</div>
    <!-- End of page content -->
    <!-- Required jquery and libraries -->
    <? include 'scripts.php'?>

    <script>
        "use strict"
        $(document).ready(function() {
            var swiper = new Swiper('.swiper-stories3', {
                slidesPerView: 'auto',
                spaceBetween: 0,
                pagination: false,
            });
        });

    </script>
</body>

</html>
