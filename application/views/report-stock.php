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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$page_title;?>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?=$page_title;?></li>
      </ol>
    </section>

    <!-- /.content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
                     <!-- Horizontal Form -->
                     <div class="box box-info ">
                        <div class="box-header with-border">
                           <h3 class="box-title">Please Enter Valid Information</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="report-form" onkeypress="return event.keyCode != 13;">
                           <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                           <div class="box-body">
                            <div class="form-group">
                                 <!-- Store Code -->
                                  <?php if(store_module() && is_admin()) {$this->load->view('store/store_code',array('show_store_select_box'=>true,'store_id'=>get_current_store_id(),'div_length'=>'col-sm-3','show_all'=>'true','form_group_remove' => 'true')); }else{
                                     echo "<input type='hidden' name='store_id' id='store_id' value='".get_current_store_id()."'>";
                                     }?>
                                  <!-- Store Code end -->

                                  <!-- Warehouse Code -->
                                  <?php if(true) {$this->load->view('warehouse/warehouse_code',array('show_warehouse_select_box'=>true,'div_length'=>'col-sm-3','show_all'=>'true','form_group_remove' => 'true','show_all_option'=>true)); }else{
                                     echo "<input type='hidden' name='warehouse_id' id='warehouse_id' value='".get_store_warehouse_id()."'>";
                                     }?>
                                  <!-- Warehouse Code end -->
											 <label for="brand_id" class="col-sm-2 control-label"><?= $this->lang->line('item_name'); ?></label>
                                 <div class="col-sm-3">
                                    <input class="form-control" id="item_name"  name="item_name">
                                    <span id="item_name_msg" style="display:none" class="text-danger"></span>
                                 </div>
                                </div>

                              <div class="form-group">
                                 <label for="brand_id" class="col-sm-2 control-label"><?= $this->lang->line('brand'); ?></label>
                                 <div class="col-sm-3">
                                    <select class="form-control select2 " id="brand_id" name="brand_id"  style="width: 100%;">
                                       <option value="">-Select-</option>
                                       <?= get_brands_select_list();  ?>
                                    </select>
                                    <span id="brand_id_msg" style="display:none" class="text-danger"></span>
                                 </div>

                                 <label for="category_id" class="col-sm-2 control-label"><?= $this->lang->line('category'); ?></label>
                                 <div class="col-sm-3">
                                    <select class="form-control select2 " id="category_id" name="category_id"  style="width: 100%;">
                                       <option value="">-Select-</option>
                                      <?= get_categories_select_list();  ?>
                                    </select>
                                    <span id="category_id_msg" style="display:none" class="text-danger"></span>
                                 </div>
                                 
                              </div>
                           </div>
                           <!-- /.box-body -->
                           <div class="box-footer">
                              <div class="col-sm-8 col-sm-offset-2 text-center">
                                 <div class="col-md-3 col-md-offset-3">
                                    <button type="button" id="view" class=" btn btn-block btn-success" title="Save Data">Show</button>
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

                  <div class="col-md-12">
                     <!-- Custom Tabs -->
                     <div class="nav-tabs-custom">
                       
                        <ul class="nav nav-tabs">
                           <li class="active"><a href="#tab_1" data-toggle="tab"><?= $this->lang->line('item_wise'); ?></a></li>
                           <li><a href="#tab_2" data-toggle="tab"><?= $this->lang->line('brand_wise'); ?></a></li>
                        </ul>
                        <div class="tab-content">
                           <div class="tab-pane active" id="tab_1">
                            
                              <div class="row">
                                 <!-- right column -->
                                 <div class="col-md-12">
                                    <!-- form start -->
                                       <input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">
                                          <?php $this->load->view('components/export_btn',array('tableId' => 'report-data'));?>
                                          <br><br>
                                          <div class="table-responsive">
                                          <table class="table table-bordered table-hover " id="report-data" >
                                            <thead>
                                            <tr class="bg-blue">
                                              <th style="">#</th>
                                              <?php if(store_module() && is_admin()){ ?>
                                              <th style=""><?= $this->lang->line('store_name'); ?></th>
                                              <?php } ?>
                                              <th style=""><?= $this->lang->line('item_code'); ?></th>
                                              <th style=""><?= $this->lang->line('item_name'); ?></th>
                                              <th style=""><?= $this->lang->line('brand'); ?></th>
                                              <th style=""><?= $this->lang->line('category'); ?></th>
                                              <th style=""><?= $this->lang->line('unit_price'); ?>(<?= $CI->currency(); ?>)</th>
                                              <th style=""><?= $this->lang->line('tax'); ?></th>
                                              <th style=""><?= $this->lang->line('sales_price'); ?>(<?= $CI->currency(); ?>)</th>
                                              <th style=""><?= $this->lang->line('current_stock'); ?></th>
                                              <th style=""><?= $this->lang->line('value'); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbodyid">
                                            
                                          </tbody>
                                          </table>
                                          </div>
                                       <!-- /.box-body -->
                                 </div>
                                 <!--/.col (right) -->
                              </div>
                              <!-- /.row -->
                           </div>
                           <!-- /.tab-pane -->
                          
                           <div class="tab-pane" id="tab_2">
                              <div class="row">
                                 <!-- right column -->
                                 <div class="col-md-12">
                                    <!-- form start -->
                                       <input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">
                                          <?php $this->load->view('components/export_btn',array('tableId' => 'brand_wise_stock'));?>
                                          <br><br>
                                          <div class="table-responsive">
                                          <table class="table table-bordered table-hover " id="brand_wise_stock" >
                                              <thead>
                                              <tr class="bg-blue">
                                                <th style="">#</th>
                                                <?php if(store_module() && is_admin()){ ?>
                                                  <th style=""><?= $this->lang->line('store_name'); ?></th>
                                                  <?php } ?>
                                                <th style=""><?= $this->lang->line('brand_name'); ?></th>
                                                
                                                <th style=""><?= $this->lang->line('current_stock'); ?></th>
                                              </tr>
                                              </thead>
                                              <tbody id="">
                                              
                                              </tbody>
                                            </table>
                                          </div>
                                       <!-- /.box-body -->
                                 </div>
                                 <!--/.col (right) -->
                              </div>
                              <!-- /.row -->
                           </div>
                           <!-- /.tab-pane -->
                      
                        </div>
                        <!-- /.tab-content -->
                     </div>
                     <!-- nav-tabs-custom -->
                  </div>
                  <!-- /.col -->
     
      
      </div>
    </section>
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
      <!-- TABLE EXPORT CODE -->
      <?php include"comman/code_js_export.php"; ?>

<script src="<?php echo $theme_link; ?>js/sheetjs.js" type="text/javascript"></script>

<script type="text/javascript">
  var base_url=$("#base_url").val();


</script>
<script type="text/javascript">
  function load_reports(){
	
   var store_id=$("#store_id").val();
   var brand_id=$("#brand_id").val();
   var category_id=$("#category_id").val();
   var warehouse_id=$("#warehouse_id").val();
	var item_name=$("#item_name").val();
   $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
        $.post(base_url+"reports/get_stock_report",{item_name:item_name,warehouse_id:warehouse_id,store_id:store_id,brand_id:brand_id,category_id:category_id},function(result){
            result = $.parseJSON(result);

              $.each( result, function( key, val ) {
                if(key=='item_wise_report'){
                    $("#tbodyid").empty().append(val);
                }
                if(key=='brand_wise_stock'){
                    $("#brand_wise_stock tbody").empty().append(val);     
                }
                /*if(key=='category_wise_stock'){
                    $("#category_wise_stock tbody").empty().append(val);     
                }*/

              });
              $(".overlay").remove();
           });

    }//function end
</script>
<script>
    $("#view").on("click",function(){
      load_reports();
    });
    $("#store_id,#warehouse_id").on("change",function(){
      load_reports();
    });
</script>
<script type="text/javascript">
        var base_url=$("#base_url").val();
        $("#store_id").on("change",function(){
          var store_id=$(this).val();
          $.post(base_url+"sales/get_customers_select_list",{store_id:store_id},function(result){
              result='<option value="">All</option>'+result;
              $("#customer_id").html('').append(result).select2();

          });
          $.post(base_url+"sales/get_warehouse_select_list",{store_id:store_id},function(result){
              result='<option value="">All</option>'+result;
              $("#warehouse_id").html('').append(result).select2();

              load_brands_list();
              load_category_list();
          });
        });


    function load_brands_list(){
     var store_id=$("#store_id").val();
     $.post(base_url+"sales/get_brands_select_list",{store_id:store_id},function(result){
          result='<option value="">All</option>'+result;
          $("#brand_id").html('').append(result).select2();
      });
    }

    function load_category_list(){
     var store_id=$("#store_id").val();
     $.post(base_url+"sales/get_categories_select_list",{store_id:store_id},function(result){
          result='<option value="">All</option>'+result;
          $("#category_id").html('').append(result).select2();
      });
    }

      </script>

<!-- Make sidebar menu hughlighter/selector -->
<script>$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");</script>
    
    
</body>
</html>
