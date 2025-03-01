<?php include("includes/surya.dream.php");  ?>

<!doctype html>

<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-layout-mode="dark" data-body-image="img-1" data-preloader="disable">

<? include("includes/extra_file.inc.php") ?>

<body>

    <div class="auth-page-wrapper pt-5">

        <!-- auth page content -->

        <div class="auth-page-content">

            <div class="container">

                <div class="row">

                    <div class="col-lg-12">

                        <div class="text-center mt-sm-0 mb-0 text-white-50">

                            <div> <a href="index" class="d-inline-block auth-logo"> <img src="assets/images/priya.png"
                                        alt="" width="200" height="130"> </a> </div>

                            <?php /*?><p class="mt-3 fs-15 fw-medium">Fast And Easy Way To Access NFT Market</p>
                            <?php */ ?>

                        </div>

                    </div>

                </div>

                <!-- end row -->

                <div class="row justify-content-center">

                    <div class="col-md-8 col-lg-6 col-xl-5">

                        <div class="card mt-4 card-bg-fill">

                            <div class="card-body p-4">

                                <div class="text-center mt-0">

                                    <h3 class="text-primary">Login To Your Account</h3>

                                    <!-- <p class="text-muted">Sign in to continue with <?= SITE_NAME ?>.</p>-->

                                </div>

                                <div class="p-2 mt-4">

                                    <? include("error_msg.inc.php"); ?>

                                    <form name="form1" id="contactForm" method="post" action="login_func.php"
                                        enctype="multipart/form-data" <?= validate_form() ?>>

                                        <div class="mb-3">

                                            <label for="username" class="form-label">Email</label>

                                            <input name="username" type="text" id="email" class="form-control"
                                                tabindex="1" placeholder="Enter Your Email" value="<?php if (isset($_COOKIE["username"])) {
                                                                              echo encryptor('decrypt', $_COOKIE["username"]);
                                                                            } ?>" alt="email"
                                                emsg="Please enter your Email">

                                        </div>

                                        <div class="mb-3">

                                            <label class="form-label" for="password-input">Password</label>

                                            <div class="position-relative auth-pass-inputgroup mb-3">

                                                <input type="password" class="form-control pe-5 password-input"
                                                    tabindex="2" placeholder="Enter Your Password" value="<?php if (isset($_COOKIE["password"])) {
                                                                                  echo encryptor('decrypt', $_COOKIE["password"]);
                                                                                } ?>" id="password" name="password"
                                                    alt="blank" emsg="Please enter password">

                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                    type="button" id="password-addon"><i
                                                        class="ri-eye-fill align-middle"></i></button>

                                            </div>

                                        </div>



                                        <div class="mb-3">



                                            <label class="form-label" for="password-input">Captcha</label>

                                            <div class="position-relative auth-pass-inputgroup mb-3">

                                                <input name="captcha" id="captcha" type="text" class="form-control "
                                                    tabindex="3" maxlength="6" style="width:45%; float:left;"
                                                    placeholder="Captcha" alt="blank" emsg="Please enter captcha">



                                                <button id="MyButton" type="button"
                                                    style="float:right; background:#fff; border:solid 1px #ccc; padding:2px 5px 2px 5px;">
                                                    <i class="ri-refresh-fill" aria-hidden="true"
                                                        style="color:#063d77; font-size:20px;"></i></button>

                                                <div class="sig n-fo rget" id="myDiv"
                                                    style="float:right; background:#f7ae47;"> <img
                                                        src="captcha_libs.php"> </div>

                                            </div>



                                            <br>





                                        </div>



                                        <div class="form-check">

                                            <input class="form-check-input" type="checkbox" tabindex="4" value="1"
                                                <?php if (isset($_COOKIE["remember"])) {
                                                                                                $check_value = encryptor('decrypt', $_COOKIE["remember"]);

                                                                                                if ($check_value == 1) { ?> checked="checked" <? } } ?> name="remember"
                                            id="auth-remember-check">

                                            <label class="form-check-label" for="auth-remember-check">Remember
                                                me</label>

                                            <div class="float-end"> <a href="forgot-password" class="text-muted">Forgot
                                                    password?</a> </div>

                                        </div>





                                        <div class="mt-4">

                                            <button class="btn btn-primary w-100 " tabindex="5" type="submit">Sign In
                                                <span class="circle"></span></button>

                                        </div>



                                        <div class="mt-4 text-center">

                                            <p class="mb-0">Don't have an account ? <a href="register.php"
                                                    class="fw-semibold text-primary text-decoration-underline"> Join
                                                    Us</a> </p>

                                            <?php /*?><p class="mb-0"> <a href="user-forgot-password?a=recover"
                                                    class="fw-semibold text-primary text-decoration-underline">Forgot
                                                    Password</a> </p><?php */ ?>

                                        </div>

                                        <!--<div class="mt-4 text-center">

                    <div class="signin-other-title">

                      <h5 class="fs-13 mb-4 title">Sign In with</h5>

                    </div>

                    <div>

                      <button type="button" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-facebook-fill fs-16"></i></button>

                      <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-google-fill fs-16"></i></button>

                      <button type="button" class="btn btn-dark btn-icon waves-effect waves-light"><i class="ri-github-fill fs-16"></i></button>

                      <button type="button" class="btn btn-info btn-icon waves-effect waves-light"><i class="ri-twitter-fill fs-16"></i></button>

                    </div>

                  </div>-->

                                    </form>

                                </div>

                            </div>

                            <!-- end card body -->

                        </div>

                        <!-- end card -->



                    </div>

                </div>

                <!-- end row -->

            </div>

            <!-- end container -->

        </div>

        <!-- end auth page content -->

        <!-- footer -->

        <? include("includes/footer_login.inc.php") ?>

        <!-- end Footer -->

    </div>

    <? include("includes/footer_extra.inc.php") ?>



</body>

</html>