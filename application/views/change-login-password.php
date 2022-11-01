<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Namma Billing | New Password</title>
    <link rel="apple-touch-icon" href="<?php echo $theme_link; ?>sign_up/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $theme_link; ?>sign_up/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_link; ?>sign_up/app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_link; ?>sign_up/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_link; ?>sign_up/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_link; ?>sign_up/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_link; ?>sign_up/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_link; ?>sign_up/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_link; ?>sign_up/app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_link; ?>sign_up/app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_link; ?>sign_up/app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_link; ?>sign_up/app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_link; ?>sign_up/app-assets/css/pages/authentication.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_link; ?>sign_up/assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu blank-page navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-cover">
                    <div class="auth-inner row m-0">
                        <!-- Brand logo-->
                        <a class="brand-logo" href="https://nammabilling.com/" target="_blank">                           
                            <img src="https://nammabilling.com/anshad/uploads/site/download.png">
                            <!-- <h2 class="brand-text text-primary ms-1">Namma Billing</h2> -->
                        </a>
                        <!-- /Brand logo-->
                        <!-- Left Text-->
                        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="<?php echo $theme_link; ?>sign_up/app-assets/images/pages/login-v2.svg" alt="Login V2" /></div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Login-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <h2 class="card-title fw-bold mb-1">Welcome to NammaBilling! 👋</h2>
                                <p class="card-text mb-2">Please Enter Your Password</p>
                                

                            <div class="text-danger tex-center"><?php echo $this->session->flashdata('failed'); ?></div>
                            <div class="text-success tex-center"><?php echo $this->session->flashdata('success'); ?></div>
														<form action="<?php echo $base_url; ?>login/change_password" method="post" id="password-form" autocomplete="off">
															<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
															<input type="hidden" name="email" id="email" value="<?= $email;?>">
															<input type="hidden" name="otp" id="otp" value="<?= $otp;?>">
                                    <div class="mb-1">
                                        <label class="form-label" for="login-email">Password</label>
                                        <input class="form-control"  type="text"   placeholder="password" id="password" name="password" aria-describedby="otp" autofocus="" tabindex="1" />
                                    </div>
																		<div class="mb-1">
                                        <label class="form-label" for="login-email">Confirm Password</label>
                                        <input class="form-control"  type="text"  placeholder="Confirm Password" id="cpassword" name="cpassword" aria-describedby="otp" autofocus="" tabindex="1" />
                                    </div>
                                    
                                    <button class="btn btn-primary w-100" tabindex="4"><?= $this->lang->line('submit'); ?></button>
                                </form>
                                <p class="text-center mt-2">
                                  <span>New on our platform?</span><a href="<?= base_url('/sign_up') ?>"><span>&nbsp;Create an account</span></a>
                                </p>
                            </div>
                        </div>
                        <!-- /Login-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="<?php echo $theme_link; ?>sign_up/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="<?php echo $theme_link; ?>sign_up/app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="<?php echo $theme_link; ?>sign_up/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?php echo $theme_link; ?>sign_up/app-assets/js/core/app-menu.js"></script>
    <script src="<?php echo $theme_link; ?>sign_up/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="<?php echo $theme_link; ?>sign_up/app-assets/js/scripts/pages/auth-login.js"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>
