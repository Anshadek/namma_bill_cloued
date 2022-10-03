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
         <?= form_open('#', array('class' => 'form-horizontal', 'id' => 'store-form', 'enctype'=>'multipart/form-data', 'method'=>'POST'));?>
         <!-- <form method="post" class = 'form-horizontal' action="<?=  base_url().'super_admin/create_store'?>" id="store-form" > -->
         
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
                                              <?=  $warehouse_name  ?>
                                              
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
                                               <?=  $phone ?>
                                            
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
                                                  <?=  $vat_no ?>
                                                  
                                                </div>
                                             </div>
                                          

                                          <div class="form-group">
                                             <label for="pan_no" class="col-sm-4 control-label"><?= $this->lang->line('pan_number'); ?></label>
                                             <div class="col-sm-8" style="
    margin-top: 8px;
">
                                               <?=  $pan_no ?>
                                             
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
      </section>
      <!-- /.content -->
      <?php echo form_close();?>
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
