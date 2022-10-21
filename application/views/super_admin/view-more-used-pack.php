<!DOCTYPE html>
<html>

<head>
   <!-- TABLES CSS CODE -->
   <?php $this->load->view('admin_common/code_css.php'); ?>
   <!-- </copy> -->
   <!-- bootstrap wysihtml5 - text editor -->
   <link rel="stylesheet" href="<?php echo $theme_link; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

</head>

<body class="hold-transition skin-blue sidebar-mini">
   <div class="wrapper">
      <?php $this->load->view('admin_common/sidebar'); ?>


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
            <h1>
               <?= $page_title; ?>
            </h1>
            <ol class="breadcrumb">
               <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> </a></li>
               <li class="active"><?= $page_title; ?></li>
            </ol>
         </section>
  
         <!-- Main content -->
         
        

         <section class="content">
          
            <!-- /.row -->
            <div class="row">
               <!-- ********** ALERT MESSAGE START******* -->

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


                                 <div class="box-body">
                                    <div class="row">
                                       <h3 class="text-center">View Used Package</h3>
                                       <hr>
                                      
                                       <?php if ($package->type == "subscription") {
                                          $amount = $package->amount;
                                          $validity =  $package->validity . ' Days';
                                          $validity_in_days = $package->validity;
                                          $user_count = ($package->is_unlimited == 0) ?  $package->user_count :  'Unlimited';
                                          $warehouse_count = ($package->is_unlimited == 0) ?  $package->warehouse_count :  'Unlimited';
                                       } else {
                                          $amount = 0;
                                          if ($package->day_or_month == 'month') {
                                             $validity_in_days =  $package->days * 30;
                                          } else {
                                             $validity_in_days = $package->days;
                                          }
                                          $validity = $package->days . ' ' . $package->day_or_month;
                                          $user_count = 'Unlimited';
                                          $warehouse_count = 'Unlimited';
                                       }
                                       $package_warehouse_count = $warehouse_count;
                                       $package_user_count = $warehouse_count;
                                       $expiry_date = date('Y-m-d', strtotime($package->created_date . ' + ' . $validity_in_days . ' days'));
                                       ?>
                                       <div class="col-md-6">
                                          <!-- <div class="form-group">
                                                   <label for="store_code" class="col-sm-4 control-label"><?= $this->lang->line('store_code'); ?> </label>
                                                   <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                      <input type="text" class="form-control" id="store_code" name="store_code" readonly=""  placeholder=""  value="<?php print $store_code; ?>" >
                                                      <span id="store_code_msg" style="display:none" class="text-danger"></span>
                                                   </div>
                                                </div> -->
                                          <div class="form-group">
                                             <label for="store_name" class="col-sm-4 control-label">Name</label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?= $package->name ?>

                                             </div>
                                          </div>



                                          <div class="form-group">
                                             <label for="phone" class="col-sm-4 control-label">Warehouse Count</label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?= $warehouse_count ?>

                                             </div>
                                          </div>

                                          <div class="form-group">
                                             <label for="vat_no" class="col-sm-4 control-label">Amount</label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?= $amount ?>

                                             </div>
                                          </div>


                                          <div class="form-group">
                                             <label for="vat_no" class="col-sm-4 control-label">Start Date</label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?= $package->created_date ?>

                                             </div>
                                          </div>

                                          <div class="form-group">
                                             <label for="vat_no" class="col-sm-4 control-label">Razorpay Payment Id</label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?= $package->razorpay_payment_id ?>

                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label for="gst_no" class="col-sm-4 control-label">Status</label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?php
                                                if ($package->status == 'active' && date('Y-m-d') <= $expiry_date)                   //1=Active, 0=Inactive
                                                {
                                                   echo "  <span   class='label label-success' style='cursor:pointer'>" . ucfirst($package->status) . " </span>";
                                                } elseif( date('Y-m-d') <= $expiry_date){
                                                   echo "  <span   class='label label-success' style='cursor:pointer'> Expired</span>";
                                                }else{
                                                   echo "<span class='label label-danger' style='cursor:pointer'> " . ucfirst($package->status) . " </span>";
                                                }
                                                ?>
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label for="vat_no" class="col-sm-4 control-label">Created Time</label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?= date('h:i A', strtotime($package->created_time)); ?>
  

                                             </div>
                                          </div>






                                          <!-- ########### -->
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                             <label for="mobile" class="col-sm-4 control-label">Validity
                                             </label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?= $validity ?>

                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label for="email" class="col-sm-4 control-label">User Count</label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?= $user_count ?>

                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label for="vat_no" class="col-sm-4 control-label">Type</label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?= ucfirst($package->type) ?>

                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label for="gst_no" class="col-sm-4 control-label">End Date</label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <span style="color:red;"><?php echo  $expiry_date ; ?></span>


                                             </div>
                                          </div>
                                          <!-- <div class="form-group">
                                             <label for="gst_no" class="col-sm-4 control-label">Razorpay Signature</label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?= $package->razorpay_signature ?>

                                             </div>
                                          </div> -->
                                          <div class="form-group">
                                             <label for="gst_no" class="col-sm-4 control-label">Created By</label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
"> <?php
   $created_user =  str_replace("_", " ", $package->created_by);
   echo ucfirst($created_user);
   ?>


                                             </div>
                                          </div>



                                       </div>

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
               
               <!-- /.box -->
            </div>
      </div>
      <!-- /.row -->

      </section>
      
      <!-- /.content -->
      
   </div>
   <!-- /.content-wrapper -->
   <?php $this->load->view('footer.php'); ?>
   <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
   <div class="control-sidebar-bg"></div>
   </div>
   <!-- ./wrapper -->
   <?php $this->load->view('admin_common/code_js_language.php'); ?>
   <!-- SOUND CODE -->
   <?php $this->load->view('admin_common/code_js_sound.php'); ?>
   <!-- TABLES CODE -->
   <?php $this->load->view('admin_common/code_js.php'); ?>
   <!-- Bootstrap WYSIHTML5 -->
   <script src="<?php echo $theme_link; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
   <script src="<?php echo $theme_link; ?>js/super_admin_store_note.js?v=4"></script>
   
   <!-- Make sidebar menu hughlighter/selector -->
   <?php if (isset($q_id) && !empty($q_id) && get_current_store_id() == $q_id) { ?>
      <script>
         $(".store_profile-active-li").addClass("active");
      </script>
   <?php } else { ?>
      <script>
         $(".<?php echo basename(__FILE__, '.php'); ?>-active-li").addClass("active");
      </script>
   <?php } ?>

   <script>
      $(function() {
         //bootstrap WYSIHTML5 - text editor
         get_states($('#country').val());
      })
      function editRow(id,name,note){
				$('#store-note-modal').modal('show'); 
				$('#id').val(id);
				$('#name').val(name);
				$('#note').val(note);
			}
			function addRow(params) {
				
				$('#store-note-modal').modal('show'); 
			}
   </script>
   <script type="text/javascript">

   </script>

</body>

</html>