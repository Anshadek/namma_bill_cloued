<!DOCTYPE html>
<html>

<head>
   <!-- TABLES CSS CODE -->
   <?php include "comman/code_css.php"; ?>
   <!-- </copy> -->
</head>

<body class="hold-transition skin-blue sidebar-mini">
   <div class="wrapper">
      <?php include "sidebar.php"; ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
            <h1>
               <?= $page_title; ?>
               <small></small>
            </h1>
            <ol class="breadcrumb">
               <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
               <li class="active">Top Trending Items</li>
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
                           <h3 class="box-title">Please Enter Valid Information</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form target='_blank' class="form-horizontal" id="report-form" onkeypress="return event.keyCode != 13;" action='<?=base_url('reports/top_trending_items')?>'>
                           <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                           <input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">
                           <div class="box-body">
                              <div class="form-group">
                                  <!-- Store Code -->
                                  
                                  <input type='hidden' name='store_id' id='store_id' value='<?= get_current_store_id() ?>'>
                                    
                                    <!-- Store Code end -->
                                </div>
                                <div class="form-group ">
										  <?php 
										  if(warehouse_module() && warehouse_count()>1) { ?>
                                <label for="expire_date" class="col-sm-2 control-label"><?= $this->lang->line('warehouse'); ?></label>
										  <?php } ?>
                                 <div class="col-sm-3">
											<?php 
                               if(warehouse_module() && warehouse_count()>1) { ?>
										 <select class="form-control select2 " id="warehouse_id" name="warehouse_id">
											<?= get_warehouse_select_list($warehouse_id, get_current_store_id()); ?>
										</select>
										<?php }else{
                                echo "<input type='hidden' name='warehouse_id' id='warehouse_id' value='".get_store_warehouse_id()."'>";
                               }
                              ?>
                              
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
                  <!--/.col (right) -->
               </div>
               <!-- /.row -->
            </section>
            <!-- /.content -->
         <!-- /.content -->
         <section class="content">
            <div class="row">
               <!-- right column -->
               <div class="col-md-12">
                  <div class="box">
                     <div class="box-header">
                        <?php $this->load->view('components/export_btn', array('tableId' => 'report-data')); ?>
                     </div>

                     <!-- /.box-header -->
                     <div class="box-body table-responsive no-padding">
                        <table class="table table-bordered table-hover " id="report-data">
                           <thead>
                              <tr class="bg-blue">
                                 <th style="">#</th>
                                 <th style=""><?= $this->lang->line('name'); ?></th>
                                 <th style=""><?= $this->lang->line('sales_qty'); ?></th>
                              </tr>
                           </thead>
                           <tbody id="tbodyid">
                           </tbody>
                        </table>
                     </div>
                     <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
               </div>
            </div>
         </section>
      </div>
      <!-- /.content-wrapper -->
      <?php include "footer.php"; ?>
      <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
   </div>
   <!-- ./wrapper -->
   <!-- SOUND CODE -->
   <?php include "comman/code_js_sound.php"; ?>
   <!-- TABLES CODE -->
   <?php include "comman/code_js.php"; ?>
   <!-- TABLE EXPORT CODE -->
   <?php include "comman/code_js_export.php"; ?>

   <script src="<?php echo $theme_link; ?>js/sheetjs.js" type="text/javascript"></script>

   <script type="text/javascript">
      var base_url = $("#base_url").val();
      $("#store_id").on("change", function() {
         var store_id = $(this).val();
         $.post(base_url + "sales/get_customers_select_list", {
            store_id: store_id
         }, function(result) {
            result = '<option value="">All</option>' + result;
            $("#customer_id").html('').append(result).select2();
         });
         /*$.post(base_url+"sales/get_warehouse_select_list",{store_id:store_id},function(result){
             result='<option value="">All</option>'+result;
             $("#warehouse_id").html('').append(result).select2();
         });*/
      });
   </script>
   <script type="text/javascript">
      $(document).ready(function() {
        
      });

      $("#view").click(function(){
      var base_url = '<?= base_url() ?>';
         $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
         $.post($("#base_url").val()+"reports/show_top_trending_report",{warehouse_id:$("#warehouse_id").val()},function(result){
                //alert(result);
                setTimeout(function() {
                $("#tbodyid").empty().append(result);     
                $(".overlay").remove();
             }, 0);
            });
      });
   </script>
   <!-- Make sidebar menu hughlighter/selector -->
   <script>
      $(".<?php echo basename(__FILE__, '.php'); ?>-active-li , .reports-menu").addClass("active");
   </script>
</body>

</html>
