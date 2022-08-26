<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
.register{
    background: -webkit-linear-gradient(left, #3931af, #00c6ff);
    margin-top: 3%;
    padding: 3%;
}
.register-left{
    text-align: center;
    color: #fff;
    margin-top: 4%;
}
.register-left input{
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    width: 60%;
    background: #f8f9fa;
    font-weight: bold;
    color: #383d41;
    margin-top: 30%;
    margin-bottom: 3%;
    cursor: pointer;
}
.register-right{
    background: #f8f9fa;
    border-top-left-radius: 10% 50%;
    border-bottom-left-radius: 10% 50%;
}
.register-left img{
    margin-top: 15%;
    margin-bottom: 5%;
    width: 25%;
    -webkit-animation: mover 2s infinite  alternate;
    animation: mover 1s infinite  alternate;
}
@-webkit-keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
@keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
.register-left p{
    font-weight: lighter;
    padding: 12%;
    margin-top: -9%;
}
.register .register-form{
    padding: 10%;
    margin-top: 10%;
}
.btnRegister{
    float: right;
    margin-top: 10%;
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    background: #0062cc;
    color: #fff;
    font-weight: 600;
    width: 50%;
    cursor: pointer;
}
.register .nav-tabs{
    margin-top: 3%;
    border: none;
    background: #0062cc;
    border-radius: 1.5rem;
    width: 28%;
    float: right;
}
.register .nav-tabs .nav-link{
    padding: 2%;
    height: 34px;
    font-weight: 600;
    color: #fff;
    border-top-right-radius: 1.5rem;
    border-bottom-right-radius: 1.5rem;
}
.register .nav-tabs .nav-link:hover{
    border: none;
}
.register .nav-tabs .nav-link.active{
    width: 100px;
    color: #0062cc;
    border: 2px solid #0062cc;
    border-top-left-radius: 1.5rem;
    border-bottom-left-radius: 1.5rem;
}
.register-heading{
    text-align: center;
    margin-top: 8%;
    margin-bottom: -15%;
    color: #495057;
}
</style>
<div class="container register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                        <h3>Welcome</h3>
                        <p>Namma Billing</p>
                        <!-- <input type="submit" name="" value="Login"/><br/> -->
                    </div>
                    <div class="col-md-9 register-right">
                        
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Apply</h3>
                                <div class="register-form ml-5">
									<form action="<?=base_url('sign_up/add_customer');?>" method="POST">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <input type="text" name="store_name" class="form-control" placeholder="Store Name *" value=""  required/>
                                        </div>
										<div class="form-group">
                                            <input type="number" name="mobile" class="form-control" placeholder="Mobile *" value=""  required/>
                                        </div>
										<div class="form-group">
                                            <input type="email" name="email" class="form-control" placeholder="Email*" value=""  required/>
                                        </div>
										<div class="form-group">
                                            <input type="number" name="phone" class="form-control" placeholder="Phone *" value=""  required/>
                                        </div>
                                        
                                        <div class="form-group">
                                            <input type="text" name="vat_no" class="form-control"  placeholder="Vat Number *" value=""  />
                                        </div>
										<div class="form-group">
                                            <input type="text" name="pan_no" class="form-control"  placeholder="PAN Number " value=""  required/>
                                        </div>
										
                                    </div>
                                    <div class="col-md-6">
									
										<div class="form-group">
                                            <input type="text" name="store_website" class="form-control"  placeholder="Store Website " value=""  />
                                        </div>
										<div class="form-group">
                                            <textarea type="text" name="bank_details" class="form-control"  placeholder="Bank Details " value=""  > Bank Details </textarea>
                                        </div>
										<div class="form-group">
                                            <select  name="country" class="form-control">
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
                                            <select name="state" class="form-control">
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
                                            <input type="text" name="city" class="form-control"  placeholder="City*" value=""  required/> 
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="postcode" class="form-control"  placeholder="Post Code*" value=""  required/> 
                                        </div>
										<div class="form-group">
                                            <textarea type="text" name="address" class="form-control"  placeholder="Address*" value=""  required> Address </textarea>
                                        </div>
                                        <input type="submit" class="btnRegister"  value="Register"/>
                                    </div>
									</form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

            </div>
