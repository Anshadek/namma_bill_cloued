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
    $theme_link =  base_url() . 'theme/';
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
<style>
     .error:not(input) {
    color: #ea5455;
    
}
 span.error {
    width: 100%;
    font-size: 0.857rem;
}
</style>
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
                                            <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
                                            <form id="sign-up-form">
                                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                            <input type="hidden" name="mail_verified" value="0">
                                            <input type="hidden" name="phone" value="">
                                            <input type="hidden" name="bank_details" value="">
                                                <div class="row">
                                                    <div class="col-md-6 mb-1">
                                                        <label class="form-label" for="email">Email<span class="req_star">*</span></label>
                                                        <input type="email" name="email" id="email" class="form-control" placeholder="john.doe@email.com" aria-label="john.doe" />
                                                        <span id="email_msg" class="error"></span>
                                                    </div>

                                                    <div class="col-md-6 mb-1">
                                                        <label class="form-label" for="mobile">Mobile number<span class="req_star">*</span></label>
                                                        <input onkeyup="mobno_length()" type="text" name="mobile" id="mobile" class="form-control mobile-mask" placeholder="(987) 654-3210" />
                                                        <span id="mobile_msg" class="error"></span>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-1">
                                                        <label class="form-label" for="pass">Password<span class="req_star">*</span></label>
                                                        <div class="input-group input-group-merge form-password-toggle">
                                                            <input type="password" name="pass" id="pass" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                                            <span id="pass_msg" class="error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <label class="form-label" for="conf_pass">Confirm Password<span class="req_star">*</span></label>
                                                        <div class="input-group input-group-merge form-password-toggle">
                                                            <input type="password" onkeyup="checkPassword()" name="conf_pass" id="conf_pass" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                                            <span id="conf_pass_msg" class="error"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 mb-1">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="multiStepsRememberMe" />
                                                            <label class="form-check-label" for="multiStepsRememberMe">Remember me</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                            
                                            <div class="d-flex justify-content-between mt-2">
                                                <button class="btn btn-outline-secondary btn-prev" disabled>
                                                    <i data-feather="chevron-left" class="align-middle me-sm-25 me-0"></i>
                                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                </button>
                                                <label style="cursor: pointer;" id="next_btn" onclick="next_form('#account-details','#personal-info')" class="btn btn-primary">
                                                    <span class="align-middle d-sm-inline-block d-none">Next</span>
                                                    <i data-feather="chevron-right" class="align-middle ms-sm-25 ms-0"></i>
                                                </label>
                                            </div>
                                            <p class="text-center mt-2"><span>Already have an account?</span><a href="<?= base_url() ?>"><span>&nbsp;Sign in instead</span></a></p>
                                        </div>
                                        <div  id="personal-info" class="content" role="tabpanel" aria-labelledby="personal-info-trigger">
                                            <div class="content-header mb-2">
                                                <h2 class="fw-bolder mb-75">Store Information</h2>
                                                <span>Enter your Store Information</span>
                                            </div>

                                                <div class="row">
                                                    <div class="mb-1 col-md-6">
                                                        <label class="form-label" for="store_name">Store Name<span class="req_star">*</span></label>
                                                        <input type="text" name="store_name" id="store_name" class="form-control" placeholder="Store Name" />
                                                        <span id="store_name_msg" class="error"></span>
                                                    </div>
                                                    <div class="mb-1 col-md-6">
                                                        <label class="form-label" for="store_website">Store Website</label>
                                                        <input type="text" name="store_website" id="store_website" class="form-control" placeholder="Website" />
                                                        <span id="store_website_msg" class="error"></span>
                                                    </div>
                                                    <div class="col-12 mb-1">
                                                        <label class="form-label" for="vat_no">VAT Number</label>
                                                        <input type="text" name="vat_no" id="vat_no" class="form-control" placeholder="VAT Number" />
                                                        <span id="vat_no_msg" class="error"></span>
                                                    </div>
                                                    <div class="col-12 mb-1">
                                                        <label class="form-label" for="pan_no">PAN Number<span class="req_star">*</span></label>
                                                        <input type="text" name="pan_no" id="pan_no" class="form-control" placeholder="PAN Number" />
                                                        <span id="pan_no_msg" class="error"></span>
                                                    </div>
                                                    <div class="col-12 mb-1">
                                                        <label class="form-label" for="address">Address</label>
                                                        <input type="text" name="address" id="address" class="form-control" placeholder="Area, Street, Sector, Village" />
                                                        <span id="address_msg" class="error"></span>
                                                    </div>
                                                   
                                                    <div class="mb-1 col-md-6">
                                                        <label class="form-label" for="country">Country<span class="req_star">*</span></label>
                                                        <select class="select2 w-100 form-control" name="country" id="country">
                                                        <option class="hidden" selected=""  disabled="">Please select your Country</option>
											<?php
                                                            $query1="select * from db_country where status=1";
                                                            $q1=$this->db->query($query1);
                                                            if($q1->num_rows($q1)>0)
                                                             {
                                                              //echo '<option value="">-Select-</option>'; 
                                                                 foreach($q1->result() as $res1)
                                                               {
                                                                 $selected = ($res1->country ==$country) ? 'selected' : '';
                                                                 echo "<option $selected   value='".$res1->country."'>".$res1->country."</option>";
                                                               }
                                                             }
                                                             else
                                                             {
                                                                ?>
                                                         <option value="">No Records Found</option>
                                                         <?php
                                                            }
                                                            ?>

                                                        </select>
                                                        <span id="country_msg" class="error"></span>
                                                    </div>

                                                    <div class="mb-1 col-md-6">
                                                        <label class="form-label" for="state">State<span class="req_star">*</span></label>
                                                        <select class="select2 w-100 form-control" name="state" id="state">
                                                        <option class="hidden" selected="" disabled="">Please select your State</option>
                                                <?php
                                                            $query2="select * from db_states where status=1";
                                                            $q2=$this->db->query($query2);
                                                            if($q2->num_rows()>0)
                                                             {
                                                              echo '<option value="">-Select-</option>'; 
                                                              foreach($q2->result() as $res1)
                                                               {
                                                                 $selected = ($res1->state ==$state) ? 'selected' : '';
                                                                 echo "<option $selected value='".$res1->state."'>".$res1->state."</option>";
                                                               }
                                                             }
                                                             else
                                                             {
                                                                ?>
                                                         <option value="">No Records Found</option>
                                                         <?php
                                                            }
                                                            ?>

                                                        </select>
                                                        <span id="state_msg" class="error"></span>
                                                    </div>
                                                    <div class="mb-1 col-md-6">
                                                        <label class="form-label" for="city">Town/City<span class="req_star">*</span></label>
                                                        <input type="text" name="city" id="city" class="form-control" placeholder="Town/City" />
                                                        <span id="city_msg" class="error"></span>
                                                    </div>
                                                    <div class="col-md-6 mb-1">
                                                        <label class="form-label" for="postcode">PIN code<span class="req_star">*</span></label>
                                                        <input type="text" name="postcode" id="postcode" class="form-control postcode-mask" placeholder="Code" maxlength="6" />
                                                        <span id="postcode_msg" class="error"></span>
                                                    </div>
                                                </div>
                                            </form>

                                            <div class="d-flex justify-content-between mt-2">
                                                <label style="cursor: pointer;" onclick="next_form('#personal-info','#account-details')" class="btn btn-primary btn-prev">
                                                    <i data-feather="chevron-left" class="align-middle me-sm-25 me-0"></i>
                                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                        </label>
                                                <!-- <button class="btn btn-primary btn-next">
                                                    <span class="align-middle d-sm-inline-block d-none">Submit</span>
                                                    <i data-feather="chevron-right" class="align-middle ms-sm-25 ms-0"></i>
                                                </button> -->
                                                <label style="cursor: pointer;" onclick="register()" class="btn btn-success btn-submit">
                                                    <i data-feather="check" class="align-middle me-sm-25 me-0"></i>
                                                    <span class="align-middle d-sm-inline-block d-none">Register</span>
                                                        </label>
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
    <!-- <script src="<?php echo $theme_link; ?>sign_up/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script> -->
    <script src="<?php echo $theme_link; ?>sign_up/app-assets/vendors/js/forms/cleave/cleave.min.js"></script>
    <script src="<?php echo $theme_link; ?>sign_up/app-assets/vendors/js/forms/cleave/addons/cleave-phone.us.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?php echo $theme_link; ?>sign_up/app-assets/js/core/app-menu.js"></script>
    <script src="<?php echo $theme_link; ?>sign_up/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="<?php echo $theme_link; ?>sign_up/app-assets/js/scripts/pages/auth-register.js"></script>
    <!--Toastr notification -->
    <script src="<?php echo $theme_link; ?>toastr/toastr.js"></script>
    <!--Toastr notification -->
    <link rel="stylesheet" href="<?php echo $theme_link; ?>toastr/toastr.css">
    <!-- END: Page JS-->

    <script>
        var flag = true;
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })

        function next_form(hide_form, show_form) {
          
            flag = true;
            check_field("email");
            check_field("mobile");
            check_field("pass");
            check_field("conf_pass");

            if (flag == false) {
                toastr["warning"]("You have Missed Something to Fillup!")
               return;
            } else {
                $(hide_form).hide();
                $(show_form).show();
            }
        }

        function register(){
            flag = true;
            check_field("store_name");
            check_field("pan_no");
            check_field("country");
            check_field("state");
            check_field("city");
            check_field("postcode");
            if (flag == false) {
                toastr["warning"]("You have Missed Something to Fillup!")
               return;
            }

    if (confirm("Do You Wants To Create New Store ?")) {
   var base_url = $('#base_url').val();
    data = new FormData($('#sign-up-form')[0]);//form name
    /*Check XSS Code*/
   

    $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
   
    $.ajax({
      type: 'POST',
      url: base_url + 'sign_up/add_customer',
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      success: function (result) {
        //alert(result);return;
        if (result == "success") {
          toastr["success"]("Record Updated Successfully!");
          window.location.replace(base_url+'login');
        }
        else if (result == "failed") {
          toastr["error"]("Sorry! Failed to save Record.Try again!");
          //	return;
        }
        else {

          toastr["error"](result);
         
          $('#account-details').show();
        $('#personal-info').hide();
					
        }


        $("#" + this_id).attr('disabled', false);  //Enable Save or Update button
        $(".overlay").remove();
      }
    });
  }
        }

        function check_field(id) {

            if (!$("#" + id).val()) //Also check Others????
            {
               
                $('#' + id + '_msg').fadeIn(200).show().html('Required Field').addClass('required');
                // $('#'+id).css({'background-color' : '#E8E2E9'});
                flag = false;
            } else {
                $('#' + id + '_msg').fadeOut(200).hide();
                //$('#'+id).css({'background-color' : '#FFFFFF'});    //White color
            }
        }
        //check moblength
        function mobno_length() {
            number = $('#mobile').val();
            if (number.length != 10) {
                $('#mobile_msg').text('mobile number should  10 dgits');
                $('#next_btn').hide();
            } else {

                $('#mobile_msg').text('');
                $('#next_btn').show();
            }
        }
        //check pass and confir is match or not
        function checkPassword() {
            var conf_pass = $('#conf_pass').val();

            var pass = $('#pass').val();

            if (conf_pass == pass) {
                $('#next_btn').show();
                $('#conf_pass_msg').text("")
            } else {
                $('#next_btn').hide();
                $('#conf_pass_msg').text("New password and confirm password doesn't match..");
            }

        }
        //======email validation ========
        const validateEmail = (email) => {
            return email.match(
                /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            );
        };

        const validate = () => {
            const $result = $('#email_msg');
            const email = $('#email').val();
            $result.text('');

            if (validateEmail(email)) {
                $result.text(email + ' is valid');
                $result.css('color', 'green');
                $('#next_btn').show();
            } else {
                $result.text(email + ' is not valid');
                $result.css('color', 'red');
                $('#next_btn').hide();
            }
            return false;
        }
        $('#email').on('input', validate);
    </script>
</body>
<!-- END: Body-->

</html>