<!DOCTYPE html>
<html>
   <head>
      <!-- TABLES CSS CODE -->
      <?php include"comman/code_css.php"; ?>
      <!-- </copy> -->  
   </head>
   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">
         <?php include"sidebar.php"; ?>
         <?php
            if(!isset($package_name)){
               $package_name=
               $description='';
               $total='';
               $payment_type='';
               $status='Active';
               
            }
            ?>
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <h1>
                  <?=$page_title;?>
                  <small>Add/Update Package</small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li><a href="<?php echo $base_url; ?>store/view"><?= $this->lang->line('store_list'); ?></a></li>
                  <li><a href="<?php echo $base_url; ?>subscribers/list/<?=$store_id?>"><?= $this->lang->line('my_subscription_list'); ?></a></li>
                  <li class="active"><?=$page_title;?></li>
               </ol>
            </section>
            <!-- Main content -->
            <section class="content">
               <div class="row">
                  <!-- ********** ALERT MESSAGE START******* -->
                  <?php include"comman/code_flashdata.php"; ?>
                  <!-- ********** ALERT MESSAGE END******* -->
                  <!-- right column -->
                  <div class="col-md-12">
                     <!-- Horizontal Form -->
                     <div class="box box-primary ">
                        <!-- form start -->
                        <?= form_open('#', array('class' => 'form-horizontal', 'id' => 'package-form', 'enctype'=>'multipart/form-data', 'method'=>'POST', 'accept-charset'=>'UTF-8', 'novalidate'=>'novalidate' ));?>
                        <input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">
                        <div class="box-body">
                            <div class="row">
                              <div class="col-md-5">
                              
                                <input type="hidden" id="store_id" name="store_id" value="<?=$store_id?>">
                              </div>
                            </div>
                           <div class="row">
                              <div class="col-md-5">
                                 <div class="form-group">
                                    <label for="package_id" class="col-sm-4 control-label"><?= $this->lang->line('package'); ?><label class="text-danger">*</label></label>
                                    <div class="col-sm-8">
                                       <select class="form-control select2" id="package_id" name="package_id"  style="width: 100%;"  >
                                             <?= get_packages_select_list() ?>
                                          </select>
                                          <span id="package_id_msg" style="display:none" class="text-danger"></span>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="category" class="col-sm-4 control-label"><?= $this->lang->line('category'); ?><label class="text-danger">*</label></label>
                                    <div class="col-sm-8">
                                       <select class="form-control select2" id="category" name="category"  style="width: 100%;"  >
                                             <option value="">Select</option>
                                          </select>
                                          <span id="category_msg" style="display:none" class="text-danger"></span>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="package_count" class="col-sm-4 control-label"><?= $this->lang->line('package_count'); ?><label class="text-danger">*</label></label>
                                    <div class="col-sm-8">
                                       <select class="form-control select2" id="package_count" name="package_count"  style="width: 100%;"  >
                                             <?php
                                             for($i = 1; $i <=11; $i++ ){
                                                echo "<option value='".$i."'>".$i."</option>";
                                             }
                                             ?>
                                          </select>
                                          <span id="package_count_msg" style="display:none" class="text-danger"></span>
                                    </div>
                                 </div>
                                 
                                 <div class="form-group">
                                    <label for="description" class="col-sm-4 control-label"><?= $this->lang->line('description'); ?></label>
                                    <div class="col-sm-8">
                                       <textarea type="text" class="form-control" id="description" name="description" placeholder="" ><?php print $description; ?></textarea>
                                       <span id="description_msg" style="display:none" class="text-danger"></span>
                                    </div>
                                 </div>

                                 <div class="form-group">
                                    <label for="total" class="col-sm-4 control-label"><?= $this->lang->line('total'); ?><label class="text-danger">*</label></label>
                                    <div class="col-sm-8">
                                       <input type="text" class="form-control" id="total" name="total" placeholder="" value="<?php print $total; ?>" >
                                       <span id="total_msg" style="display:none" class="text-danger"></span>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="payment_type" class="col-sm-4 control-label"><?= $this->lang->line('payment_type'); ?></label>
                                    <div class="col-sm-8">
                                       <input type="text" class="form-control" id="payment_type" name="payment_type" placeholder="" value="<?php print $payment_type; ?>" >
                                       <span id="payment_type_msg" style="display:none" class="text-danger"></span>
                                    </div>
                                 </div>


                                 <!-- <div class="form-group">
                                    <label for="status" class="col-sm-4 control-label"><?= $this->lang->line('status'); ?><label class="text-danger">*</label></label>
                                    <div class="col-sm-8">
                                       <select class="form-control select2" id="status" name="status"  style="width: 100%;"  >
                                             <option value="Active">Active</option>
                                             <option value="Inactive">Inactive</option>
                                          </select>
                                    </div>
                                 </div> -->
                                 
                                
                                 <!-- ########### -->
                              </div>
                           
                             
                           </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                           <div class="col-sm-8 col-sm-offset-2 text-center">
                              <!-- <div class="col-sm-4"></div> -->
                              <?php
                                 if($package_name!=""){
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
                        <?= form_close(); ?>
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
         <?php include"footer.php"; ?>
         <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
         <div class="control-sidebar-bg"></div>
      </div>
      <!-- ./wrapper -->
      <!-- SOUND CODE -->
      <?php include"comman/code_js_sound.php"; ?>
      <!-- TABLES CODE -->
      <?php include"comman/code_js.php"; ?>
      <script src="<?php echo $theme_link; ?>js/manual-subscription.js"></script>
      <script type="text/javascript">
        <?php if(isset($q_id)){ ?>
          $("#store_id").attr('readonly',true);
        <?php }?>
         // $("#status").val("<?=$status?>").select2();
      </script>
      <script type="text/javascript">
        var base_url=$("#base_url").val();
        var store_id=$("#store_id").val();

        $("#package_id").on("change",function(){
          load_category();
        });
        $(document).ready(function(){
          load_category();
        });
        $("#category,#package_count").on("change",function(){
          calculate_total();
        });

        function load_category(){
         $.post(base_url+"subscribers/get_category",{package_id:$("#package_id").val()},function(json){

             options='<option value="">Select</option>';

              json=$.parseJSON(json);
              $.each(json, function (key, data) {
                  var category = (key=='monthly_price') ? "Monthly Price" : "Annual Price";

                  options+="<option data-amount='"+data+"' value='"+key+"'>"+data+" "+category+"</option>";
               });
              $("#category").html('').append(options).select2();

              calculate_total();
          });
        }

        function calculate_total(){
            var package_amount = parseFloat($('option:selected', "#category").attr('data-amount'));
            package_amount = (isNaN(package_amount)) ? 0 :package_amount;
            
            var package_count = parseFloat($("#package_count").val());

            var total = package_amount * package_count;

            $("#total").val(to_Fixed(total));
        }

      </script>
      <!-- Make sidebar menu hughlighter/selector -->
      <script>$(".store_list-active-li").addClass("active");</script>
 </body>
</html>
