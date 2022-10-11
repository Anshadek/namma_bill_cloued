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
                        <form target='_blank' class="form-horizontal" id="report-form" onkeypress="return event.keyCode != 13;" action='<?=base_url('reports/sales_and_payments_report')?>'>
                           <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                           <input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">
                           <div class="box-body">
                              <div class="form-group">
                                 <!-- Store Code -->
                                  
                                     <input type='hidden' name='store_id' id='store_id' value='<?= get_current_store_id() ?>'>
                                    
                                  <!-- Store Code end -->
                                </div>
                                <div class="form-group ">
                                <label for="expire_date" class="col-sm-2 control-label"><?= $this->lang->line('warehouse'); ?></label>
                                 <div class="col-sm-3">
											<?php 
                               if(warehouse_module() && warehouse_count()>1) { ?>
										 <select class="form-control select2 " id="warehouse_id" name="warehouse_id"  onchange="get_warehouse_customers(this)">
											<?= get_warehouse_select_list($warehouse_id, get_current_store_id()); ?>
										</select>
												
											
										<?php }else{
                                echo "<input type='hidden' name='warehouse_id' id='warehouse_id' value='".get_store_warehouse_id()."'>";
                               }
                              ?>
                              
                                 </div>
										</div>
                              <div class="form-group">
											
                                 <label for="from_date" class="col-sm-2 control-label"><?= $this->lang->line('from_date'); ?></label>
                                 <div class="col-sm-3">
                                    <div class="input-group date">
                                       <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                       </div>
                                       <input type="text" class="form-control pull-right datepicker" id="from_date" name="from_date" value="">
                                    </div>
                                    <span id="Sales_date_msg" style="display:none" class="text-danger"></span>
                                 </div>
                                 <label for="to_date" class="col-sm-2 control-label"><?= $this->lang->line('to_date'); ?></label>
                                 <div class="col-sm-3">
                                    <div class="input-group date">
                                       <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                       </div>
                                       <input type="text" class="form-control pull-right datepicker" id="to_date" name="to_date" value="">
                                    </div>
                                    <span id="Sales_date_msg" style="display:none" class="text-danger"></span>
                                 </div>
                              </div>

                              <div class="form-group">
                                 <label for="customer_id" class="col-sm-2 control-label"><?= $this->lang->line('customer_name'); ?></label>
                                 <div class="col-sm-3">
                                    <select class="form-control select2 " id="customer_id" name="customer_id">
                                       <option value="">-Select-</option>
                                       <?= get_customers_select_list(null,get_current_store_id());?>
                                    </select>
                                    <span id="customer_id_msg" style="display:none" class="text-danger"></span>
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

            <section class="content">
               <div class="row">
                  <!-- right column -->
                  <div class="col-md-12">
                     <div class="box">
                        <div class="box-header">
                           <h3 class="box-title"><?= $this->lang->line('records_table'); ?></h3>
                           <?php $this->load->view('components/export_btn',array('tableId' => 'report-data'));?>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                           <table class="table table-bordered table-hover " id="report-data" >
                              <thead>
                                 <tr>
                                    <td><?= $this->lang->line('name'); ?></td>
                                    <td colspan="9" id="customer_name">
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><?= $this->lang->line('mobile'); ?></td>
                                    <td colspan="9" id="customer_mobile">
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><?= $this->lang->line('address'); ?></td>
                                    <td colspan="9" id="customer_address">
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><?= $this->lang->line('previous_due'); ?></td>
                                    <td colspan="9" id="previous_due">
                                    </td>
                                 </tr>
                                 <tr class="bg-blue">
                                    <th style="">#</th>
                                    <?php if(store_module() && is_admin()){ ?>
                                    <th style=""><?= $this->lang->line('store_name'); ?></th>
                                    <?php } ?>
                                    
                                    <th style=""><?= $this->lang->line('date'); ?></th>
                                    <th style=""><?= $this->lang->line('invoice_no'); ?></th>
                                    <th style=""><?= $this->lang->line('referenced_bill_no'); ?></th>
                                    <th style=""><?= $this->lang->line('description'); ?></th>
                                    <th style=""><?= $this->lang->line('qty'); ?></th>
                                    <th style=""><?= $this->lang->line('bill_amount'); ?>(<?= $CI->currency(); ?>)</th>
                                    <th style=""><?= $this->lang->line('receive'); ?>(<?= $CI->currency(); ?>)</th>
                                    
                                    <th style=""><?= $this->lang->line('total'); ?>(<?= $CI->currency(); ?>)</th>
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
      <script>
            $(document).ready(function() {
               $('.datepicker').datepicker({
			autoclose: true,
			format: 'dd-mm-yyyy',
			todayHighlight: true
		});
		var warehouse_id = $("#warehouse_id").val();
			$('#old_warehouse_selected_id').val(warehouse_id);
			get_warehouse_customers(warehouse_id)
       
    });
         function convert_excel(type, fn, dl) {
             var elt = document.getElementById('report-data');
             var wb = XLSX.utils.table_to_book(elt, {sheet:"Sheet JS"});
             return dl ?
                 XLSX.write(wb, {bookType:type, bookSST:true, type: 'base64'}) :
                 XLSX.writeFile(wb, fn || ('Sales-Report.' + (type || 'xlsx')));
         }
         $(".btnExport").click(function(event) {
          convert_excel('xlsx');
         });
      </script>
     
      <script type="text/javascript">
        var base_url=$("#base_url").val();
        $("#store_id").change(function(){
          var store_id=$(this).val();
          $.post(base_url+"sales/get_customers_select_list",{store_id:store_id},function(result){
              result='<option value="">All</option>'+result;
              $("#customer_id").html('').append(result).select2();
          });
         
        });
      </script>
      <script type="text/javascript">
        $("#view").click(function(){

        // $("#report-form").submit();
            var from_date=document.getElementById("from_date").value;
            var to_date=document.getElementById("to_date").value;
            var customer_id=document.getElementById("customer_id").value;
				var warehouse_id=document.getElementById("warehouse_id").value;


            if(from_date == "")
            {
              /*toastr["warning"]("Select From Date!");
              document.getElementById("from_date").focus();
              return;a*/
            }

            if(to_date == "")
            {
             /* toastr["warning"]("Select To Date!");
              document.getElementById("to_date").focus();
              return;*/
            }
            if(customer_id == "")
            {
              toastr["warning"]("Select Customer");
              document.getElementById("customer_id").focus();
              return;
            }

            $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
            $.post($("#base_url").val()+"reports/sales_and_payments_report",{warehouse_id:warehouse_id,from_date:from_date,to_date:to_date,store_id:$("#store_id").val(),warehouse_id:$("#warehouse_id").val(),customer_id:$("#customer_id").val()},function(result){
                //alert(result);
                setTimeout(function() {
                $("#tbodyid").empty().append(result);     
                $(".overlay").remove();
             }, 0);
            }); 
     

  
});

            $("#customer_id").on("change",function(){
               var customer_name =$("#customer_id option:selected").text();
               var cn = customer_name.split("-");
               var customer_mobile = $(this).find("option:selected").attr('data-mobile')
              // alert(customer_mobile);
               var customer_address = $('option:selected', "#customer_id").attr('data-address')
               var previous_due = $('option:selected', "#customer_id").attr('data-previous_due')

               $("#customer_name").html(cn[1]);
               $("#customer_mobile").html(customer_mobile);
               $("#customer_address").html(customer_address);
               $("#previous_due").html(previous_due);
            });
      </script>

      <!-- Make sidebar menu hughlighter/selector -->
      <script>$(".report-sales-and-payments-active-li , .reports-menu").addClass("active");</script>
      <script src="<?php echo $theme_link; ?>js/warehouse_filter.js?v=2"></script>
   </body>
</html>
