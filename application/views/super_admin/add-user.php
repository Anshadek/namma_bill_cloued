<!DOCTYPE html>
<html>
   
   <head>
  <!-- TABLES CSS CODE -->
  <?php $this->load->view('admin_common/code_css.php');?>
  <!-- </copy> -->  
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo $theme_link; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  </head>

   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">
         <?php $this->load->view('admin_common/sidebar');?>
          <?php
              if(!isset($q_id)){
                
                $warehouse_name=$logo=$currency_id=$currency_placement=$timezone=
                $date_format=$time_format=
                $round_off='';
                $mobile=$phone=$email=$country=$state=$city=
                $postcode=$address=$gst_no=$vat_no=
                $warehouse_website=$pan_no=$bank_details=$store_logo='';

                $decimals=2;
                $invoice_terms = '';
                
               
                
              }
          ?>

         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <h1>
                  <?= $page_title; ?>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active"><?= $page_title; ?></li>
               </ol>
            </section>
            
            <!-- Main content -->
  <?= form_open('#', array('class' => 'form-horizontal', 'id' => 'store-form', 'enctype'=>'multipart/form-data', 'method'=>'POST'));?>
            <section class="content">
               <div class="row">
                  <!-- ********** ALERT MESSAGE START******* -->
                <?php $this->load->view('admin_common/code_flashdata');?>
                  <!-- ********** ALERT MESSAGE END******* -->
                  <div class="col-md-12">
                     <!-- Custom Tabs -->
                     <div class="nav-tabs-custom">
                       
                        <div class="tab-content">
                          <div class="tab-pane active" id="tab_4">
                              <div class="row">
                                 <!-- right column -->
                                 <div class="col-md-12">
                                    <!-- form start -->
                                       <input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">
                                       <div class="box-body">
                                          <div class="row">
                                             <div class="col-md-5">
                                                <!-- <div class="form-group">
                                                   <label for="store_code" class="col-sm-4 control-label"><?= $this->lang->line('store_code'); ?><label class="text-danger">*</label></label>
                                                   <div class="col-sm-8">
                                                      <input type="text" class="form-control" id="store_code" name="store_code" readonly=""  placeholder="" onkeyup="shift_cursor(event,'mobile')" value="<?php print $store_code; ?>" >
                                                      <span id="store_code_msg" style="display:none" class="text-danger"></span>
                                                   </div>
                                                </div> -->
                                                <div class="form-group">
                                                   <label for="warehouse_name" class="col-sm-4 control-label"><?= $this->lang->line('warehouse_name'); ?><label class="text-danger">*</label></label>
                                                   <div class="col-sm-8">
                                                      <input type="text" class="form-control" id="warehouse_name" name="warehouse_name" placeholder="" onkeyup="shift_cursor(event,'mobile')" value="<?php print $warehouse_name; ?>" >
                                                      <span id="warehouse_name_msg" style="display:none" class="text-danger"></span>
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label for="mobile" class="col-sm-4 control-label"><?= $this->lang->line('mobile'); ?><label class="text-danger">*</label></label>
                                                   <div class="col-sm-8">
                                                      <input type="text" class="form-control no_special_char_no_space" id="mobile" name="mobile" placeholder="" value="<?php print $mobile; ?>" onkeyup="shift_cursor(event,'email')" >
                                                      <span id="mobile_msg" style="display:none" class="text-danger"></span>
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label for="email" class="col-sm-4 control-label"><?= $this->lang->line('email'); ?><label class="text-danger">*</label></label>
                                                   <div class="col-sm-8">
                                                      <input type="text" class="form-control" id="email" name="email" placeholder="" value="<?php print $email; ?>" onkeyup="shift_cursor(event,'phone')">
                                                      <span id="email_msg" style="display:none" class="text-danger"></span>
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label for="phone" class="col-sm-4 control-label"><?= $this->lang->line('phone'); ?></label>
                                                   <div class="col-sm-8">
                                                      <input type="text" class="form-control no_special_char_no_space" id="phone" name="phone" placeholder="" value="<?php print $phone; ?>" onkeyup="shift_cursor(event,'gst_no')" >
                                                      <span id="phone_msg" style="display:none" class="text-danger"></span>
                                                   </div>
                                                </div>

                                                <?php if(gst_number()){ ?>
                                                <div class="form-group">
                                                   <label for="gst_no" class="col-sm-4 control-label"><?= $this->lang->line('gst_number'); ?></label>
                                                   <div class="col-sm-8">
                                                      <input type="text" class="form-control" id="gst_no" name="gst_no" placeholder="" value="<?php print $gst_no; ?>" onkeyup="shift_cursor(event,'vat_no')">
                                                      <span id="gstin_msg" style="display:none" class="text-danger"></span>
                                                   </div>
                                                </div>
                                                <?php } ?>

                                                <?php if(vat_number()){ ?>
                                                <div class="form-group">
                                                   <label for="vat_no" class="col-sm-4 control-label">Vat Number</label>
                                                   <div class="col-sm-8">
                                                      <input type="text" class="form-control" id="vat_no" name="vat_no" placeholder="" value="<?php print $vat_no; ?>" onkeyup="shift_cursor(event,'warehouse_website')">
                                                      <span id="vat_msg" style="display:none" class="text-danger"></span>
                                                   </div>
                                                </div>
                                                <?php } ?>
                                               
                                                <div class="form-group">
                                                   <label for="pan_no" class="col-sm-4 control-label"><?= $this->lang->line('pan_number'); ?></label>
                                                   <div class="col-sm-8">
                                                      <input type="text" class="form-control" id="pan_no" name="pan_no" placeholder="" value="<?php print $pan_no; ?>" onkeyup="shift_cursor(event,'warehouse_website')">
                                                      <span id="pan_msg" style="display:none" class="text-danger"></span>
                                                   </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                   <label for="warehouse_website" class="col-sm-4 control-label">Warehouse Website</label>
                                                   <div class="col-sm-8">
                                                      <input type="text" class="form-control" id="warehouse_website" name="warehouse_website" placeholder="" value="<?php print $warehouse_website; ?>" onkeyup="shift_cursor(event,'country')">
                                                      <span id="website_msg" style="display:none" class="text-danger"></span>
                                                   </div>
                                                </div>
                                                <!-- <div class="form-group">
                                                   <label for="pass" class="col-sm-4 control-label">Password</label>
                                                   <div class="col-sm-8">
                                                      <input type="text" class="form-control" id="pass" name="pass" placeholder="" value="" onkeyup="shift_cursor(event,'country')">
                                                      <span id="website_msg" style="display:none" class="text-danger"></span>
                                                   </div>
                                                </div> -->
                                                
                                                <!-- ########### -->
                                             </div>
                                             <div class="col-md-5">
                                                <div class="form-group">
                                                   <label for="bank_details" class="col-sm-4 control-label"><?= $this->lang->line('bank_details'); ?></label>
                                                   <div class="col-sm-8">
                                                      <textarea type="text" class="form-control" id="bank_details" name="bank_details" placeholder="" ><?php print $bank_details; ?></textarea>
                                                      <span id="bank_details_msg" style="display:none" class="text-danger"></span>
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label for="country" class="col-sm-4 control-label"><?= $this->lang->line('country'); ?></label>
                                                   <div class="col-sm-8">
                                                      <select class="form-control select2" id="country" name="country" onchange="get_states(this)" style="width: 100%;" onkeyup="shift_cursor(event,'state')" value="<?php print $country; ?>">
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
                                                      <span id="country_msg" style="display:none" class="text-danger"></span>
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label for="state" class="col-sm-4 control-label"><?= $this->lang->line('state'); ?></label>
                                                   <div class="col-sm-8">
                                                      <select class="form-control select2" id="state" name="state"  style="width: 100%;" onkeyup="shift_cursor(event,'city')">
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
                                                      <span id="state_msg" style="display:none" class="text-danger"></span>
                                                   </div>
                                                </div>

                                                <div class="form-group">
                                                   <label for="city" class="col-sm-4 control-label"><?= $this->lang->line('city'); ?><label class="text-danger">*</label></label>
                                                   <div class="col-sm-8">
                                                      <input type="text" class="form-control" id="city" name="city" placeholder="" value="<?php print $city; ?>" onkeyup="shift_cursor(event,'postcode')" >
                                                      <span id="city_msg" style="display:none" class="text-danger"></span>
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label for="postcode" class="col-sm-4 control-label"><?= $this->lang->line('postcode'); ?></label>
                                                   <div class="col-sm-8">
                                                      <input type="text" class="form-control no_special_char_no_space" id="postcode" name="postcode" placeholder="" value="<?php print $postcode; ?>" onkeyup="shift_cursor(event,'address')">
                                                      <span id="postcode_msg" style="display:none" class="text-danger"></span>
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label for="address" class="col-sm-4 control-label"><?= $this->lang->line('address'); ?><label class="text-danger">*</label></label>
                                                   <div class="col-sm-8">
                                                      <textarea type="text" class="form-control" id="address" name="address" placeholder="" ><?php print $address; ?></textarea>
                                                      <span id="address_msg" style="display:none" class="text-danger"></span>
                                                   </div>
                                                </div>
                                                <!-- <div class="form-group">
                                                   <label for="conf_pass" class="col-sm-4 control-label">Confirm Passowrd</label>
                                                   <div class="col-sm-8">
                                                      <input type="text" class="form-control" id="conf_pass" name="conf_pass" placeholder="" value="<?php print $warehouse_website; ?>" onkeyup="shift_cursor(event,'country')">
                                                      <span id="website_msg" style="display:none" class="text-danger"></span>
                                                   </div> -->
                                                </div>
                                             </div>
                                             <center>
                                                <div class="col-md-2 col-md-offset-3">
                                 <button type="button"  class=" btn btn-block btn-success" title="Save Data">Submit</button>
                              </div>
                              <div class="col-sm-2">
                                <a href="<?=base_url('dashboard');?>">
                                 <button type="button" class="col-sm-3 btn btn-block btn-warning close_btn" title="Go Dashboard">Close</button>
                               </a>
                              </div>
                                                </center>
                                             <!-- ########### -->
                                          </div>
                                       </div>
                                       <!-- /.box-body -->
                                       <!-- /.box-footer -->
                                    
                                 </div>
                                 <!--/.col (right) -->
                              </div>
                              <!-- /.row -->
                           </div>
                           
                           <!-- /.tab-pane -->
                          
                           
                           <!-- /.tab-pane -->
                           
                           <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                     </div>
                     <!-- nav-tabs-custom -->
                    
                  </div>
                  <!-- /.col -->
               </div>
               <!-- /.row -->
            </section>
            <!-- /.content -->
            <?= form_close(); ?>
         </div>
         <!-- /.content-wrapper -->
         <?php $this->load->view('footer.php');?>
         <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
         <div class="control-sidebar-bg"></div>
      </div>
      <!-- ./wrapper -->
      <?php $this->load->view('admin_common/code_js_language.php');?>
      <!-- SOUND CODE -->
      <?php $this->load->view('admin_common/code_js_sound.php');?>
      <!-- TABLES CODE -->
      <?php $this->load->view('admin_common/code_js.php');?>

      <script type="text/javascript">
         $(document).submit(function(event) {
           event.preventDefault();
           if($("#update").length){
             $("#update").trigger('click');
           }
         });
      </script>
      <script src="<?php echo $theme_link; ?>js/store_profile.js?v=1"></script>
      <script src="<?php echo $theme_link; ?>js/store/store.js?v=1"></script>
      <script src="<?php echo $theme_link; ?>js/state_filter.js?v=3"></script>
     


<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo $theme_link; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

     
      <script type="text/javascript">
        <?php if(!empty($currency_placement)) {?>
         $("#currency_placement").val('<?= $currency_placement;?>').select2();
       <?php }else{ ?>
         $("#currency_placement").select2();
       <?php } ?>

       <?php if(!empty($date_format)) {?>
         $("#date_format").val('<?= $date_format;?>').select2();
       <?php }else{ ?>
         $("#date_format").select2();
       <?php } ?>

       <?php if(!empty($decimals)) {?>
         $("#decimals").val('<?= $decimals;?>').select2();
       <?php }else{ ?>
         $("#decimals").select2();
       <?php } ?>
       
       <?php if(!empty($time_format)) {?>
         $("#time_format").val('<?= $time_format;?>').select2();
       <?php }else{ ?>
         $("#time_format").select2();
       <?php } ?>

       <?php if(!empty($sales_invoice_format_id)) {?>
         $("#sales_invoice_format_id").val('<?= $sales_invoice_format_id;?>').select2();
       <?php }else{ ?>
         $("#sales_invoice_format_id").select2();
       <?php } ?>

       <?php if(!empty($pos_invoice_format_id)) {?>
         $("#pos_invoice_format_id").val('<?= $pos_invoice_format_id;?>').select2();
       <?php }else{ ?>
         $("#pos_invoice_format_id").select2();
       <?php } ?>
      </script>
      <!-- Make sidebar menu hughlighter/selector -->
      <?php if( isset($q_id) && !empty($q_id) && get_current_store_id()==$q_id){ ?>
        <script>$(".store_profile-active-li").addClass("active");</script>
      <?php }else{?>
        <script>$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");</script>
      <?php } ?>

      <script>
        $(function () {
          //bootstrap WYSIHTML5 - text editor
          get_states($('#country').val());
          $("#invoice_terms").wysihtml5()
        })
      </script>

   </body>
</html>
