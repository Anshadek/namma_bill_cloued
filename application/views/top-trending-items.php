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
         var base_url = '<?= base_url() ?>';
         $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
         $.ajax({
            url: base_url + 'reports/show_top_trending_report',
            type: 'GET',
            // dataType: 'json', // added data type
            success: function(result) {
               setTimeout(function() {
                  $("#tbodyid").empty().append(result);
                  $(".overlay").remove();
               }, 0);
            }
         });
      });
   </script>
   <!-- Make sidebar menu hughlighter/selector -->
   <script>
      $(".<?php echo basename(__FILE__, '.php'); ?>-active-li , .reports-menu").addClass("active");
   </script>
</body>

</html>