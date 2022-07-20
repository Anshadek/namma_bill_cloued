<!DOCTYPE html>
<html>
   <head>
      <!-- TABLES CSS CODE -->
      <?php $this->load->view('comman/code_css.php');?>
      <!-- </copy> -->  
   </head>
   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">
         <?php $this->load->view('sidebar.php');?>
         <?php
            if(!isset($brand_name)){
                 $coupon_id=$code=$description="";
            }
            ?>
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <h1>
                  <?=$page_title;?>
                  <small>Add/Update Brand</small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li><a href="<?php echo $base_url; ?>brand/view"><?= $this->lang->line('brands_list'); ?></a></li>
                  <li class="active"><?=$page_title;?></li>
               </ol>
            </section>
            <!-- Main content -->
            <section class="content">
               <div class="row">
                  <!-- right column -->
                  <div class="col-md-12">
                     <!-- Horizontal Form -->
                     <div class="box box-primary ">
                        <div class="box-header with-border">
                           <h3 class="box-title">Please Enter Valid Data</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="coupon-form">
                           <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                           <input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">
                           <div class="box-body">
                              <!-- Store Code -->
                               <?php /*if(store_module() && is_admin()) {$this->load->view('store/store_code',array('show_store_select_box'=>true,'store_id'=>$store_id)); }else{*/
                                echo "<input type='hidden' name='store_id' id='store_id' value='".get_current_store_id()."'>";
                              /*}*/ ?>
                              <!-- Store Code end -->
                              <div class="form-group">
                                 <label for="customer_id" class="col-sm-2 control-label"><?= $this->lang->line('customer_name'); ?><label class="text-danger">*</label></label>
                                 <div class="col-sm-4">
                                    <select class="form-control select2" id="customer_id" name="customer_id"  style="width: 100%;" >
                                  <?= get_customers_select_list($customer_id,get_current_store_id());  ?>
                                 </select>
                                    <span id="customer_id_msg" style="display:none" class="text-danger"></span>
                                    <?php 
                                    if(!empty($customer_id)){ ?>
                                        <a class='pull-right' href="<?= base_url('customer_coupon/generate') ?>">Change</a>
                                    <?php }
                                     ?>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="coupon_id" class="col-sm-2 control-label"><?= $this->lang->line('couponName'); ?><label class="text-danger">*</label></label>
                                 <div class="col-sm-4">
                                    <select class="form-control select2" id="coupon_id" name="coupon_id"  style="width: 100%;" >
                                  <?= get_discount_coupon_select_list($coupon_id);  ?>
                                 </select>
                                    <span id="coupon_id_msg" style="display:none" class="text-danger"></span>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="code" class="col-sm-2 control-label"><?= $this->lang->line('couponCode'); ?><label class="text-danger">*</label></label>
                                 <div class="col-sm-4">
                                     <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" id="code" name="code" placeholder="" value="<?php print $code; ?>">
                                    <span class="input-group-btn">
                                    <button data-toggle="tooltip" title="Generate Code" type="button" class="btn btn-info btn-flat generate"><i class="fa fa-fw fa-refresh"></i></button>
                                    </span>

                                 </div>
                                 <span id="code_msg" style="display:none" class="text-danger"></span>
                                    </div>
                              </div>

                              <div class="form-group">
                                 <label for="expire_date" class="col-sm-2 control-label"><?= $this->lang->line('expire_date'); ?></label>
                                 <div class="col-sm-4">
                                    <input type="text" class="form-control input-sm " id="expire_date" name="expire_date" value="" readonly>
                                    <span id="expire_date_msg" style="display:none" class="text-danger"></span>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="coupon_value" class="col-sm-2 control-label"><?= $this->lang->line('couponValue'); ?></label>
                                 <div class="col-sm-4">
                                    <input type="text" class="form-control input-sm only_currency " id="coupon_value" name="coupon_value" value="" readonly>
                                    <span id="coupon_value_msg" style="display:none" class="text-danger"></span>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="coupon_type" class="col-sm-2 control-label"><?= $this->lang->line('couponType'); ?></label>
                                 <div class="col-sm-4">
                                    <input type="text" class="form-control input-sm " id="coupon_type" name="coupon_type" value="" readonly>

                                    <span id="coupon_type_msg" style="display:none" class="text-danger"></span>
                                 </div>
                              </div>

                              <div class="form-group">
                                 <label for="description" class="col-sm-2 control-label"><?= $this->lang->line('description'); ?></label>
                                 <div class="col-sm-4">
                                    <textarea type="text" class="form-control" id="description" name="description" placeholder=""><?php print $description; ?></textarea>
                                    <span id="description_msg" style="display:none" class="text-danger"></span>
                                 </div>
                              </div>
                           </div>
                           <!-- /.box-footer -->
                           <div class="box-footer">
                              <div class="col-sm-8 col-sm-offset-2 text-center">
                                 <!-- <div class="col-sm-4"></div> -->
                                 <?php
                                    if(isset($q_id)){
                                         $btn_name="Update";
                                         $btn_id="update";
                                        ?>
                                 <input type="hidden" name="q_id" id="q_id" value="<?php echo $q_id;?>"/>
                                 <?php
                                    }
                                              else{
                                                  $btn_name="Save";
                                                  $btn_id="save";
                                              }
                                    
                                              ?>
                                 <div class="col-md-3 col-md-offset-3">
                                    <button type="button" id="<?php echo $btn_id;?>" class=" btn btn-block btn-success" title="Save Data"><?php echo $btn_name;?></button>
                                 </div>
                                 <div class="col-sm-3">
                                    <a href="<?=base_url('dashboard');?>">
                                    <button type="button" class="col-sm-3 btn btn-block btn-warning close_btn" title="Go Dashboard">Close</button>
                                    </a>
                                 </div>
                              </div>
                           </div>
                           <!-- /.box-footer -->
                        </form>
                     </div>
                     <!-- /.box -->
                  </div>
                  <!--/.col (right) -->
               </div>
               <!-- /.row -->
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
         <?php $this->load->view('footer.php');?>
         <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
         <div class="control-sidebar-bg"></div>
      </div>
      <!-- ./wrapper -->
      <!-- SOUND CODE -->
      <?php $this->load->view('comman/code_js_sound.php');?>
      <!-- TABLES CODE -->
      <?php $this->load->view('comman/code_js.php');?>
      <script src="<?php echo $theme_link; ?>js/coupons/generate.js"></script>
      <script type="text/javascript">
        <?php if(isset($q_id)){ ?>
          $("#store_id").attr('readonly',true);
        <?php }?>
        <?php if(!empty($customer_id)){ ?>
          $("#customer_id").attr('readonly',true);
        <?php }?>
      </script>
      <!-- Make sidebar menu hughlighter/selector -->
      <script>$(".createCoupon-active-li, .coupon-active-li").addClass("active");</script>
   </body>
</html>
