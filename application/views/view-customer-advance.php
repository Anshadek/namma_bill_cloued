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
                  <!-- right column -->
                  <div class="col-md-12">
                     <div class="box">
                        <div class="box-header">
                           <?php $this->load->view('components/export_btn',array('tableId' => 'report-data'));?>
                        </div>

                        <!-- /.box-header -->
                        <?php
                        $name = "";
                        $code = "";
                         if($advances->num_rows()>0){
                           $data = $advances->result();
                           $code = $data[0]->customer_code; 
                           $name = $data[0]->customer_name; 
                         }
                        ?>
                        <h4 class="text-center"><?= ucfirst($name) ?>--<?= $code ?></h4>
                        <div class="box-body table-responsive no-padding">
                           <table class="table table-bordered table-hover " id="report-data" >
                              <thead>
                                 <tr class="bg-blue">
                                    <th style="">#</th>
                                    <th style=""><?= $this->lang->line('amount'); ?></th>
                                    <th style=""><?= $this->lang->line('date'); ?></th>
                                    <th style=""><?= $this->lang->line('note'); ?></th>
                                    <th style=""><?= $this->lang->line('created_by'); ?></th>
                                    <th style=""><?= $this->lang->line('payment_type'); ?></th>
                                 </tr>
                              </thead>
                              <tbody>
                              <?php
										$i=1;
                                    if($advances->num_rows()>0){
                                           foreach ($advances->result() as $res1){
                                        ?>
                                        <tr>
											<td><?php echo $i++;?> </td>
                                 <td><?php echo $res1->amount;?> </td>
                                 <td><?php echo $res1->payment_date;?> </td>
                                 <td><?php echo ($res1->note != "")  ? $res1->note : '--' ;?> </td>
                                 <td><?php echo $res1->created_by;?> </td>
                                 <td><?php echo $res1->payment_type;?> </td>
                               
                                           </tr>
                                 <?php } } ?>
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
      <script src="<?php echo $theme_link; ?>js/warehouse_filter.js"></script>
      <script type="text/javascript">
          $('.datepicker').datepicker({
			autoclose: true,
			format: 'dd-mm-yyyy',
			todayHighlight: true
		});
        var base_url=$("#base_url").val();
        $("#store_id").on("change",function(){
          var store_id=$(this).val();
          $.post(base_url+"sales/get_customers_select_list",{store_id:store_id},function(result){
              result='<option value="">All</option>'+result;
              $("#customer_id").html('').append(result).select2();
          });
          /*$.post(base_url+"sales/get_warehouse_select_list",{store_id:store_id},function(result){
              result='<option value="">All</option>'+result;
              $("#warehouse_id").html('').append(result).select2();
          });*/
        });
      </script>
      <script type="text/javascript">
         
         $("#view,#view_all").on("click",function(){
         var within_date=document.getElementById("within_date").value;
         var customer_id=document.getElementById("customer_id").value;
			var warehouse_id = document.getElementById("warehouse_id").value;
         if(this.id=="view_all"){
             var view_all='yes';
           }
        else{
          var view_all='no';
        }
     
        $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
        $.post($("#base_url").val()+"reports/show_customer_advance",{warehouse_id:warehouse_id,customer_id:customer_id,view_all:view_all,within_date:within_date,store_id:$("#store_id").val()},function(result){
          //alert(result);
            setTimeout(function() {
             $("#tbodyid").empty().append(result);     
             $(".overlay").remove();
            }, 0);
           });
     });
      </script>
		<script>
	$( document ).ready(function() {
	warehouse_id = $('#warehouse_id').val();
	var selected = $('#selected_warehouse').val();
	if (selected > 0){
		warehouse_id = selected;
	}
    get_warehouse_customers(warehouse_id)
});
</script>
      
      <!-- Make sidebar menu hughlighter/selector -->
      
      <script>
      
      $(".<?php echo basename(__FILE__,'.php');?>-active-li , .reports-menu").addClass("active");</script>
   </body>
</html>
