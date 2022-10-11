<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title><?php print $SITE_TITLE; ?> | Sign Up</title>
    <?php
       $theme_link =  base_url().'theme/';
     ?>

    <link rel="apple-touch-icon" href="<?php echo $theme_link; ?>sign_up/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $theme_link; ?>sign_up/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_link; ?>sign_up/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_link; ?>sign_up/app-assets/vendors/css/forms/wizard/bs-stepper.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_link; ?>sign_up/app-assets/vendors/css/forms/select/select2.min.css">
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
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_link; ?>sign_up/app-assets/css/plugins/forms/form-wizard.css">
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
                        <div class="col-lg-3 d-none d-lg-flex align-items-center p-0">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center">
                                <img class="img-fluid w-100" src="<?php echo $theme_link; ?>sign_up/app-assets/images/illustration/create-account.svg" alt="multi-steps" />
                            </div>
                        </div>
                        <!-- /Left Text-->

                        <!-- Register-->
                        <div class="col-lg-9 d-flex align-items-center auth-bg px-2 px-sm-3 px-lg-5 pt-3">
                            <div class="width-700 mx-auto">
                                <div class="bs-stepper register-multi-steps-wizard shadow-none">
                                    <div class="bs-stepper-header px-0" role="tablist">
                                        <div class="step" data-target="#account-details" role="tab" id="account-details-trigger">
                                            <button type="button" class="step-trigger">
                                                <span class="bs-stepper-box">
                                                    <i data-feather="home" class="font-medium-3"></i>
                                                </span>
                                                <span class="bs-stepper-label">
                                                    <span class="bs-stepper-title">Personal</span>
                                                    <span class="bs-stepper-subtitle">Enter username</span>
                                                </span>
                                            </button>
                                        </div>
                                        <div class="line">
                                            <i data-feather="chevron-right" class="font-medium-2"></i>
                                        </div>
                                        <div class="step" data-target="#personal-info" role="tab" id="personal-info-trigger">
                                            <button type="button" class="step-trigger">
                                                <span class="bs-stepper-box">
                                                    <i data-feather="user" class="font-medium-3"></i>
                                                </span>
                                                <span class="bs-stepper-label">
                                                    <span class="bs-stepper-title">Store</span>
                                                    <span class="bs-stepper-subtitle">Enter Store Information</span>
                                                </span>
                                            </button>
                                        </div>
                                        <div class="line">
                                            <i data-feather="chevron-right" class="font-medium-2"></i>
                                        </div>
                                    </div>

                                    <div class="bs-stepper-content px-0 mt-4">
                                        <div id="account-details" class="content" role="tabpanel" aria-labelledby="account-details-trigger">
                                            <div class="content-header mb-2">
                                                <h2 class="fw-bolder mb-75">Account Information</h2>
                                                <span>Enter your username password details</span>
                                            </div>
                                            <form>
                                                <div class="row">
                                                    <div class="col-md-12 mb-1">
                                                        <label class="form-label" for="username">Username<span class="req_star">*</span></label>
                                                        <input type="text" name="username" id="username" class="form-control" placeholder="johndoe" />
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-1">
                                                        <label class="form-label" for="email">Email<span class="req_star">*</span></label>
                                                        <input type="email" name="email" id="email" class="form-control" placeholder="john.doe@email.com" aria-label="john.doe" />
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <label class="form-label" for="mobile-number">Mobile number<span class="req_star">*</span></label>
                                                        <input type="text" name="mobile-number" id="mobile-number" class="form-control mobile-number-mask" placeholder="(987) 654-3210" />
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-1">
                                                        <label class="form-label" for="password">Password<span class="req_star">*</span></label>
                                                        <div class="input-group input-group-merge form-password-toggle">
                                                            <input type="password" name="password" id="password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <label class="form-label" for="confirm-password">Confirm Password<span class="req_star">*</span></label>
                                                        <div class="input-group input-group-merge form-password-toggle">
                                                            <input type="password" name="confirm-password" id="confirm-password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                                        </div>
                                                    </div>                                                    

                                                    <div class="col-12 mb-1">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="multiStepsRememberMe" />
                                                            <label class="form-check-label" for="multiStepsRememberMe">Remember me</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                            <div class="d-flex justify-content-between mt-2">
                                                <button class="btn btn-outline-secondary btn-prev" disabled>
                                                    <i data-feather="chevron-left" class="align-middle me-sm-25 me-0"></i>
                                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                </button>
                                                <button class="btn btn-primary btn-next">
                                                    <span class="align-middle d-sm-inline-block d-none">Next</span>
                                                    <i data-feather="chevron-right" class="align-middle ms-sm-25 ms-0"></i>
                                                </button>
                                            </div>
                                            <p class="text-center mt-2"><span>Already have an account?</span><a href="<?= base_url() ?>"><span>&nbsp;Sign in instead</span></a></p>
                                        </div>
                                        <div id="personal-info" class="content" role="tabpanel" aria-labelledby="personal-info-trigger">
                                            <div class="content-header mb-2">
                                                <h2 class="fw-bolder mb-75">Sotore Information</h2>
                                                <span>Enter your Store Information</span>
                                            </div>
                                            <form>
                                                <div class="row">
                                                    <div class="mb-1 col-md-6">
                                                        <label class="form-label" for="first-name">Store Name<span class="req_star">*</span></label>
                                                        <input type="text" name="first-name" id="first-name" class="form-control" placeholder="John" />
                                                    </div>  
                                                    <div class="mb-1 col-md-6">
                                                        <label class="form-label" for="last-name">Store Website</label>
                                                        <input type="text" name="" id="last-name" class="form-control" placeholder="Website" />
                                                    </div>
                                                    <div class="col-12 mb-1">
                                                        <label class="form-label" for="home-address">VAT Number</label>
                                                        <input type="text" name="" id="vat-number" class="form-control" placeholder="VAT Number" />
                                                    </div>
                                                    <div class="col-12 mb-1">
                                                        <label class="form-label" for="home-address">PAN Number<span class="req_star">*</span></label>
                                                        <input type="text" name="" id="pan-number" class="form-control" placeholder="PAN Number" />
                                                    </div>
                                                    <div class="col-12 mb-1">
                                                        <label class="form-label" for="area-address">Address</label>
                                                        <input type="text" name="area-address" id="area-address" class="form-control" placeholder="Area, Street, Sector, Village" />
                                                    </div>
                                                    <div class="mb-1 col-md-6">
                                                        <label class="form-label" for="town-city">Town/City<span class="req_star">*</span></label>
                                                        <input type="text" name="town-city" id="town-city" class="form-control" placeholder="Town/City" />
                                                    </div>
                                                    <div class="mb-1 col-md-6">
                                                        <label class="form-label" for="country">Country<span class="req_star">*</span></label>
                                                        <select class="select2 w-100" name="country" id="country">
                                                            <option value="" label="blank"></option>
                                                            <option value="AK">Alaska</option>
                                                            <option value="HI">Hawaii</option>
                                                            <option value="CA">California</option>
                                                            <option value="NV">Nevada</option>
                                                            <option value="OR">Oregon</option>
                                                            <option value="WA">Washington</option>
                                                            <option value="AZ">Arizona</option>
                                                            <option value="CO">Colorado</option>
                                                            <option value="ID">Idaho</option>
                                                            <option value="MT">Montana</option>
                                                            <option value="NE">Nebraska</option>
                                                            <option value="NM">New Mexico</option>
                                                            <option value="ND">North Dakota</option>
                                                            <option value="UT">Utah</option>
                                                            <option value="WY">Wyoming</option>
                                                            <option value="AL">Alabama</option>
                                                            <option value="AR">Arkansas</option>
                                                            <option value="IL">Illinois</option>
                                                            <option value="IA">Iowa</option>
                                                            <option value="KS">Kansas</option>
                                                            <option value="KY">Kentucky</option>
                                                            <option value="LA">Louisiana</option>
                                                            <option value="MN">Minnesota</option>
                                                            <option value="MS">Mississippi</option>
                                                            <option value="MO">Missouri</option>
                                                            <option value="OK">Oklahoma</option>
                                                            <option value="SD">South Dakota</option>
                                                            <option value="TX">Texas</option>

                                                        </select>
                                                    </div>

                                                    <div class="col-md-6 mb-1">
                                                        <label class="form-label" for="pin-code">PIN code<span class="req_star">*</span></label>
                                                        <input type="text" name="pin-code" id="pin-code" class="form-control pin-code-mask" placeholder="Code" maxlength="6" />
                                                    </div>
                                                </div>
                                            </form>

                                            <div class="d-flex justify-content-between mt-2">
                                                <button class="btn btn-primary btn-prev">
                                                    <i data-feather="chevron-left" class="align-middle me-sm-25 me-0"></i>
                                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                </button>
                                                <!-- <button class="btn btn-primary btn-next">
                                                    <span class="align-middle d-sm-inline-block d-none">Submit</span>
                                                    <i data-feather="chevron-right" class="align-middle ms-sm-25 ms-0"></i>
                                                </button> -->
                                                <button class="btn btn-success btn-submit">
                                                    <i data-feather="check" class="align-middle me-sm-25 me-0"></i>
                                                    <span class="align-middle d-sm-inline-block d-none">Register</span>
                                                </button>
                                            </div>
                                            <p class="text-center mt-2"><span>Already have an account?</span><a href="<?= base_url() ?>"><span>&nbsp;Sign in instead</span></a></p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script src="<?php echo $theme_link; ?>sign_up/app-assets/vendors/js/forms/wizard/bs-stepper.min.js"></script>
    <script src="<?php echo $theme_link; ?>sign_up/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="<?php echo $theme_link; ?>sign_up/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <script src="<?php echo $theme_link; ?>sign_up/app-assets/vendors/js/forms/cleave/cleave.min.js"></script>
    <script src="<?php echo $theme_link; ?>sign_up/app-assets/vendors/js/forms/cleave/addons/cleave-phone.us.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?php echo $theme_link; ?>sign_up/app-assets/js/core/app-menu.js"></script>
    <script src="<?php echo $theme_link; ?>sign_up/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="<?php echo $theme_link; ?>sign_up/app-assets/js/scripts/pages/auth-register.js"></script>
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