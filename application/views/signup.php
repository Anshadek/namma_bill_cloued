

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>
<?php
   $theme_link =  base_url().'theme/';
 ?>
    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo $theme_link; ?>sign_up/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo $theme_link; ?>sign_up/css/style.css">
</head>
<body>

    <div class="main">
	<input type="hidden" id="base_url" value="<?= base_url() ?>"
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" action="<?=base_url('sign_up/add_customer');?>" class="register-form" id="register-form">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                            <div class="form-group">
                                <label for="store_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="store_name" id="store_name" placeholder="Store Name *" required/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email *" required/>
                            </div>
                            <div class="form-group">
                                <label for="mobile"><i class="zmdi zmdi-phone"></i></label>
                                <input type="number" name="mobile" id="mobile" placeholder="Mobile *" required/>
                            </div>
							<div class="form-group">
                                <label for="phone"><i class="zmdi zmdi-account-box-phone zmd-fw"></i></label>
                                <input type="number" name="phone" id="phone" placeholder="phone *" />
                            </div>
                            <div class="form-group">
                                <label for="vat_no"><i class="zmdi zmdi-badge-check"></i></label>
                                <input type="text" name="vat_no" id="vat_no" placeholder="Vat No *" />
                            </div>
							<div class="form-group">
                                <label for="pan_no"><i class="zmdi zmdi-card"></i></label>
                                <input type="text" name="pan_no" id="pan_no" placeholder="Pan No *" required/>
                            </div>
							<div class="form-group">
                                <label for="store_website"><i class="zmdi zmdi-view-web"></i></label>
                                <input type="text" name="store_website" id="store_website" placeholder="Store Website *" />
                            </div>
							<div class="form-group">
                                <label for="bank_details"><i class="zmdi zmdi-view-week"></i></label>
                                <textarea style="width: 100%;display: block; border: none;  border-bottom: 1px solid #999; padding: 6px 30px; font-family: Poppins;box-sizing: border-box;"
								name="bank_details" placeholder="Bank Details *" > </textarea>
                            </div>
							<div class="form-group">
                                <label for="country"><i class="zmdi zmdi-flag"></i></label>
                                <select  style="width: 100%;display: block; border: none;  border-bottom: 1px solid #999; padding: 6px 30px; font-family: Poppins;box-sizing: border-box;"
								 name="country" class="form-control"> 
								 <!-- onchange="get_states_signup(this)" -->
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
                                                                 echo "<option $selected value='".$res1->country."'>".$res1->country."</option>";
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
                            </div>
							<div class="form-group">
							<label for="state"><i class="zmdi zmdi-flag"></i></label>
							<select style="width: 100%;display: block; border: none;  border-bottom: 1px solid #999; padding: 6px 30px; font-family: Poppins;box-sizing: border-box;"
							 name="state" class="form-control">
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
                            </div>
							<div class="form-group">
                                <label for="city"><i class="zmdi zmdi-flag"></i></label>
                                <input type="text" name="city" id="city" placeholder="City *" required/>
                            </div>
							<div class="form-group">
                                <label for="postcode"><i class="zmdi zmdi-gesture"></i></label>
                                <input type="text" name="postcode" id="postcode" placeholder="Postcode *" required/>
                            </div>
							<div class="form-group">
                                <label for="address"><i class="zmdi zmdi-my-location"></i></label>
                                <textarea style="width: 100%;display: block; border: none;  border-bottom: 1px solid #999; padding: 6px 30px; font-family: Poppins;box-sizing: border-box;"
								name="address" placeholder="Address *"> </textarea>
                            </div>
                            <!-- <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div> -->
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="<?php echo $theme_link; ?>sign_up/images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="<?= base_url() ?>" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>
	<?php /*
        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                        <a href="#" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="your_name" id="your_name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="your_pass" id="your_pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
		*/?>

    </div>

    <!-- JS -->
    <script src="<?php echo $theme_link; ?>sign_up/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo $theme_link; ?>sign_up/js/main.js"></script>
	<script src="<?php echo $theme_link; ?>js/state_filter.js?v=4"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
