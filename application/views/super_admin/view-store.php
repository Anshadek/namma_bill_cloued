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
               <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
               <li class="active"><?= $page_title; ?></li>
            </ol>
         </section>

         <!-- Main content -->
         <?= form_open('#', array('class' => 'form-horizontal', 'id' => 'store-form', 'enctype' => 'multipart/form-data', 'method' => 'POST')); ?>
         <!-- <form method="post" class = 'form-horizontal' action="<?= base_url() . 'super_admin/create_store' ?>" id="store-form" > -->

         <section class="content">
            <div class="row">
               <!-- ********** ALERT MESSAGE START******* -->
               <?php $this->load->view('admin_common/code_flashdata'); ?>
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
                                       <h3 class="text-center">Store Details</h3>
                                       <hr>
                                       <div class="col-md-5">
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
                                             <label for="store_name" class="col-sm-4 control-label"><?= $this->lang->line('store_name'); ?></label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?= $warehouse_name  ?>

                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label for="store_code" class="col-sm-4 control-label">Store Code</label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?= $store_code  ?>

                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label for="mobile" class="col-sm-4 control-label"><?= $this->lang->line('mobile'); ?>
                                             </label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?= $mobile ?>

                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label for="email" class="col-sm-4 control-label"><?= $this->lang->line('email'); ?></label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?= $email ?>

                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label for="phone" class="col-sm-4 control-label"><?= $this->lang->line('phone'); ?></label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?= $phone ?>

                                             </div>
                                          </div>


                                          <div class="form-group">
                                             <label for="gst_no" class="col-sm-4 control-label"><?= $this->lang->line('gst_number'); ?></label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?= $gst_no ?>

                                             </div>
                                          </div>



                                          <div class="form-group">
                                             <label for="vat_no" class="col-sm-4 control-label">Vat Number</label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?= $vat_no ?>

                                             </div>
                                          </div>


                                          <div class="form-group">
                                             <label for="pan_no" class="col-sm-4 control-label"><?= $this->lang->line('pan_number'); ?></label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?= $pan_no ?>

                                             </div>
                                          </div>

                                          <div class="form-group">
                                             <label for="warehouse_website" class="col-sm-4 control-label">Store Website</label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?= $warehouse_website ?>

                                             </div>
                                          </div>

                                          <div class="form-group">
                                             <label for="note" class="col-sm-4 control-label">Package Type</label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?php print $package_type; ?>

                                             </div>
                                          </div>
                                          <!-- ########### -->
                                       </div>
                                       <div class="col-md-5">
                                          <div class="form-group">
                                             <label for="bank_details" class="col-sm-4 control-label"><?= $this->lang->line('bank_details'); ?></label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?php print $bank_details; ?>

                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label for="country" class="col-sm-4 control-label"><?= $this->lang->line('country'); ?></label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?= $country ?>
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label for="state" class="col-sm-4 control-label"><?= $this->lang->line('state'); ?> </label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?= $state ?>

                                             </div>
                                          </div>

                                          <div class="form-group">
                                             <label for="city" class="col-sm-4 control-label"><?= $this->lang->line('city'); ?> </label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?php print $city; ?>

                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label for="postcode" class="col-sm-4 control-label"><?= $this->lang->line('postcode'); ?> </label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?= $postcode ?>
                                                <span id="postcode_msg" style="display:none" class="text-danger"></span>
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label for="address" class="col-sm-4 control-label"><?= $this->lang->line('address'); ?> </label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?php print $address; ?>

                                             </div>
                                          </div>

                                          <div class="form-group">
                                             <label for="note" class="col-sm-4 control-label"><?= $this->lang->line('note'); ?></label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?php print $note; ?>

                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label for="note" class="col-sm-4 control-label">Created From</label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?php print $created_from; ?>

                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label for="note" class="col-sm-4 control-label">Active Package</label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?php print $package; ?>

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
            </div>
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
                                       <h3 class="text-center">Active Packages</h3>
                                       <hr>
                                       <?php if ($active_package->type == "subscription") {
                                          $amount = $active_package->amount;
                                          $validity =  $active_package->validity . ' Days';
                                          $validity_in_days = $active_package->validity;
                                          $user_count = ($active_package->is_unlimited == 0) ?  $active_package->user_count :  'Unlimited';
                                          $warehouse_count = ($active_package->is_unlimited == 0) ?  $active_package->warehouse_count :  'Unlimited';
                                       } else {
                                          $amount = 0;
                                          if ($active_package->day_or_month == 'month') {
                                             $validity_in_days =  $active_package->days * 30;
                                          } else {
                                             $validity_in_days = $active_package->days;
                                          }
                                          $validity = $active_package->days . ' ' . $active_package->day_or_month;
                                          $user_count = 'Unlimited';
                                          $warehouse_count = 'Unlimited';
                                       }
                                       ?>
                                       <div class="col-md-5">
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
                                                <?= $active_package->name ?>

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
                                                <?= $active_package->created_date ?>

                                             </div>
                                          </div>

                                          <div class="form-group">
                                             <label for="vat_no" class="col-sm-4 control-label">Razorpay Payment Id</label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?= $active_package->razorpay_payment_id ?>

                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label for="gst_no" class="col-sm-4 control-label">Status</label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?php
                                                if ($active_package->status == 'active')                   //1=Active, 0=Inactive
                                                {
                                                   echo "  <span   class='label label-success' style='cursor:pointer'>" . ucfirst($active_package->status) . " </span>";
                                                } else {
                                                   echo "<span class='label label-danger' style='cursor:pointer'> " . ucfirst($active_package->status) . " </span>";
                                                }
                                                ?>
                                             </div>
                                          </div>






                                          <!-- ########### -->
                                       </div>
                                       <div class="col-md-5">
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
                                                <?= ucfirst($active_package->type) ?>

                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label for="gst_no" class="col-sm-4 control-label">End Date</label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <span style="color:red;"><?php echo  date('Y-m-d', strtotime($active_package->created_date . ' + ' . $validity_in_days . ' days')); ?></span>


                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label for="gst_no" class="col-sm-4 control-label">Razorpay Signature</label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                                <?= $active_package->razorpay_signature ?>

                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label for="gst_no" class="col-sm-4 control-label">Created By</label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
"> <?php
   $created_user =  str_replace("_", " ", $active_package->created_by);
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
               <div class="col-xs-12">
                  <div class="box box-primary">
                     <div class="box-header with-border">
                        <h3 class="box-title">Trial Pack List</h3>
                     </div>
                     <!-- /.box-header -->
                     <div class="box-body">
                        <input type="hidden" id="base_url" value="http://localhost/project/namma_bill_cloued/">
                        <table id="example2" class="table table-bordered custom_hover dataTable no-footer" width="100%">
                           <thead class="bg-gray ">
                              <tr>
                                 <th>#</th>
                                 <th>Name</th>
                                 <th>User Count</th>
                                 <th>Warehouse Count</th>
                                 <th>Start Date</th>
                                 <th>End Date</th>
                                 <th>Razorpay Payment Id</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>1 </td>
                                 <td>tria cat 2 </td>
                                 <td>TR0005 </td>
                                 <td>22 </td>
                                 <td>22 </td>
                                 <td>22 </td>
                                 <td>22 </td>
                              </tr>
                              </ul>
                     </div>



                     </td>
                     </tr>
                     </tbody>
                     </table>
                  </div>
                  <!-- /.box-body -->
               </div>
               <!-- /.box -->
            </div>
      </div>
      <!-- /.row -->

      </section>
      <!-- /.content -->
      <?php echo form_close(); ?>
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
   </script>
   <script type="text/javascript">

   </script>

</body>

</html>