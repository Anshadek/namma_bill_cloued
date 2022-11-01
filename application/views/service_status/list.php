<!DOCTYPE html>
<html>

<head>
<!-- TABLES CSS CODE -->
<?php $this->load->view('comman/code_css.php');?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Left side column. contains the logo and sidebar -->
  
  <?php $this->load->view('sidebar');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$page_title;?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a data-toggle='tooltip' title='Do you want Import Customers ?' href="<?php echo $base_url; ?>customers"> <?= $this->lang->line('customers_list'); ?></a></li>
        <li><a data-toggle='tooltip' title='Do you want Import Customers ?' href="<?php echo $base_url; ?>import/customers"><i class="fa fa-arrow-circle-o-down "></i> <?= $this->lang->line('import_customers'); ?></a></li>
        <li class="active"><?=$page_title;?></li>
        
      </ol>
    </section>

  
    <!-- Main content -->
    <?= form_open('#', array('class' => '', 'id' => 'table_form')); ?>
    <input type="hidden" id='base_url' value="<?=$base_url;?>">
    <section class="content">
      
      <!-- /.row -->
      <div class="row">
         <!-- ********** ALERT MESSAGE START******* -->
        <?php $this->load->view('comman/code_flashdata.php');?>
        <!-- ********** ALERT MESSAGE END******* -->
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?=$page_title;?></h3>
              <?php if(permissions('cust_adv_payments_add')) { ?>
              <div class="box-tools">
                <a class="btn btn-block btn-info" href="<?php echo $base_url; ?>customers_advance/add">
                <i class="fa fa-plus"></i> <?= $this->lang->line('add_advance'); ?></a>
              </div>
              <?php } ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
						<div class="box-header with-border">
								<!-- Warehouse Code -->
								<?php if (warehouse_module() && warehouse_count() > 1) {
									echo '<div class="col-md-4">';
									$this->load->view('warehouse/warehouse_code', array(
										'show_warehouse_select_box' => true, 'div_length' => '',
										'label_length' => '', 'show_all' => 'true', 'show_all_option' => true, 'remove_star' => true
									));
									echo '</div>';
								} else {
									echo "<input type='hidden' name='warehouse_id' id='warehouse_id' value='" . get_store_warehouse_id() . "'>";
								} ?>
								<!-- Warehouse Code end -->
							</div>
              <table id="example2" class="table table-bordered custom_hover" width="100%">
                <thead class="bg-gray ">
                <tr>
                  <th class="text-center">
                    <input type="checkbox" class="group_check checkbox" >
                  </th>
                  <th><?= $this->lang->line('sales_code'); ?></th>
                  <th><?= $this->lang->line('service'); ?></th>
                  <th><?= $this->lang->line('status'); ?></th>
                  <th><?= $this->lang->line('note'); ?></th>
									<th><?= $this->lang->line('date'); ?></th>
                  <th><?= $this->lang->line('created_by'); ?></th>
                  <th><?= $this->lang->line('action'); ?></th> 
                </tr>
                </thead>
                <tbody>
        
                </tbody>
							
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
     <?= form_close();?>
  </div>
  <div class="modal fade  in" id="service-status-modal" style="padding-left: 5px;">
			<?= form_open('#', array('class' => 'form-horizontal', 'id' => 'service-status-form', 'enctype'=>'multipart/form-data', 'method'=>'POST'));?>


			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header header-custom">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<label aria-hidden="true">×</label></button>
						<h4 class="modal-title text-center">Add Subscription</h4>
					</div>
					<div class="modal-body">
						<div class="row">
						<input type="hidden" name="id" id="id" value="">
							<div class="col-md-6">
								<div class="box-body">
									<div class="form-group">
									<label id="status_msg" class="text-danger text-right pull-right"></label>
										<label for="status">Status</label>
										<select class="form-control" id="status" name="status" style="width: 100%;">
											<option value="">-Select-</option>
											<option value="inspecting">Inspecting</option>
                      <option value="proceed_to_solution">Proceed To Solution</option>
                      <option value="cancelled">Cancelled</option>
                      <option value="part_replacement">Part Replacement</option>
											<option value="issue_fixed">Issue Fixed </option>
										</select>
									</div>
								</div>
							</div>
              <div class="col-md-6">
								<div class="box-body">
									<div class="form-group">
										
										<label for="note">Note</label>
										<label id="note_msg" class="text-danger text-right pull-right"></label>
										<textarea  class="form-control" id="note" name="note" placeholder="note"> </textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
							<button type="button" id="save" class="btn btn-primary add_customer">Save</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
				<?php echo form_close();?>
			</div>
		</div>
  <!-- /.content-wrapper -->
  <?php $this->load->view('footer');?>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- SOUND CODE -->
<?php $this->load->view('comman/code_js_sound.php');?>
<!-- TABLES CODE -->
<?php $this->load->view('comman/code_js.php');?>
<!-- bootstrap datepicker -->
<script src="<?php echo $theme_link; ?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
  //Date picker
    $('.datepicker').datepicker({
      autoclose: true,
    format: 'dd-mm-yyyy',
     todayHighlight: true
    });
</script>

<script type="text/javascript">
 function changeStatus(id,status,note){
  $('#id').val(id);
  $('#status').val(status);
  $('#note').val(note);
  $('#service-status-modal').modal('show');
  
 }
  

function load_datatable(show_account_receivable='unchecked'){
   //datatables
   
   var table = $('#example2').DataTable({ 
    

      /* FOR EXPORT BUTTONS START*/
  dom:'<"row margin-bottom-12"<"col-sm-12"<"pull-left"l><"pull-right"fr><"pull-right margin-left-10 "B>>>tip',
 /* dom:'<"row"<"col-sm-12"<"pull-left"B><"pull-right">>> <"row margin-bottom-12"<"col-sm-12"<"pull-left"l><"pull-right"fr>>>tip',*/
      buttons: {
        buttons: [
            {
                className: 'btn bg-red color-palette btn-flat hidden delete_btn pull-left',
                text: 'Delete',
                action: function ( e, dt, node, config ) {
                    multi_delete();
                }
            },
            { extend: 'copy', className: 'btn bg-teal color-palette btn-flat',footer: true, exportOptions: { columns: [1,2,3,4,5]} },
            { extend: 'excel', className: 'btn bg-teal color-palette btn-flat',footer: true, exportOptions: { columns: [1,2,3,4,5]} },
            { extend: 'pdf', className: 'btn bg-teal color-palette btn-flat',footer: true, exportOptions: { columns: [1,2,3,4,5]} },
            { extend: 'print', className: 'btn bg-teal color-palette btn-flat',footer: true, exportOptions: { columns: [1,2,3,4,5]} },
            { extend: 'csv', className: 'btn bg-teal color-palette btn-flat',footer: true, exportOptions: { columns: [1,2,3,4,5]} },
            { extend: 'colvis', className: 'btn bg-teal color-palette btn-flat',footer: true, text:'Columns' },  

            ]
        },
        /* FOR EXPORT BUTTONS END */

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "responsive": true,
        language: {
            processing: '<div class="text-primary bg-primary" style="position: relative;z-index:100;overflow: visible;">Processing...</div>'
        },
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('service_status/ajax_list')?>",
            "type": "POST",
            "data": {
							warehouse_id: $('#warehouse_id').val(),
                    },
            complete: function (data) {
             $('.column_checkbox').iCheck({
                checkboxClass: 'icheckbox_square-orange',
                /*uncheckedClass: 'bg-white',*/
                radioClass: 'iradio_square-orange',
                increaseArea: '10%' // optional
              });
             call_code();
              //$(".delete_btn").hide();
             },

        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0,5 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        {
            "targets" :[0],
            "className": "text-center",
        },
        
        ],
				/*Start Footer Total*/
				"footerCallback": function ( row, data, start, end, display ) {
                      var api = this.api(), data;
                      // Remove the formatting to get integer data for summation
                      var intVal = function ( i ) {
                          return typeof i === 'string' ?
                              i.replace(/[\$,]/g, '')*1 :
                              typeof i === 'number' ?
                                  i : 0;
                      };
                      var total = api
                          .column( 5, { page: 'none'} )
                          .data()
                          .reduce( function (a, b) {
                              return intVal(a) + intVal(b);
                          }, 0 );
                      ;
                      /*var due = api
                          .column( 8, { page: 'none'} )
                          .data()
                          .reduce( function (a, b) {
                              return intVal(a) + intVal(b);
                          }, 0 );*/
                     
                      //$( api.column( 0 ).footer() ).html('Total');
                      $( api.column( 4 ).footer() ).html(to_Fixed(total));
                      
                     // $( api.column( 8 ).footer() ).html((due));
                     
                  },
        
    });
    new $.fn.dataTable.FixedHeader( table );
}
$(document).ready(function() {
    //datatables
   load_datatable();
});
$("#warehouse_id").on("change", function() {
  
			$('#example2').DataTable().destroy();
			load_datatable();
		});

    $('#save,#update').on("click", function (e) {
  var base_url = $("#base_url").val();
  //Initially flag set true
  var flag = true;

  function check_field(id) {
    if (!$("#" + id).val()) //Also check Others????
    {
      $('#' + id + '_msg').fadeIn(200).show().html('Required Field').addClass('required');
      // $('#'+id).css({'background-color' : '#E8E2E9'});
      flag = false;
    }
    else {
      $('#' + id + '_msg').fadeOut(200).hide();
      //$('#'+id).css({'background-color' : '#FFFFFF'});    //White color
    }
  }

 check_field("status");
	
  if (flag == false) {
    toastr["warning"]("You have Missed Something to Fillup!")
    return;
  }
  var this_id = this.id;
  if (confirm("Do You Wants To Save Or Update Record ?")) {
    e.preventDefault();
    data = new FormData($('#service-status-form')[0]);//form name
    /*Check XSS Code*/
    if (!xss_validation(data)) { return false; }

    $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
    $("#" + this_id).attr('disabled', true);  //Enable Save or Update button
    $.ajax({
      type: 'POST',
      url: base_url + 'service_status/update_status',
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      success: function (result) {
        
        //alert(result);return;
        if (result == "success") {
          toastr["success"]("Record Updated Successfully!");
          window.location.replace(base_url+'service_status');
        }
        else if (result == "failed") {
          toastr["error"]("Sorry! Failed to save Record.Try again!");
          //	return;
        }
        else {
         
          toastr["error"](result);
        }
        $("#" + this_id).attr('disabled', false);  //Enable Save or Update button
        $(".overlay").remove();
      }
    });
  }

  //e.preventDefault

});

function delete_row(q_id) {

var base_url = $("#base_url").val();
if (confirm("Do You Wants to Delete Record ?")) {
   $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
   $.post(base_url + "service_status/delete_service_status", {
      q_id: q_id
   }, function(result) {
      //alert(result);return;
      if (result == "success") {
         toastr["success"]("Record Deleted Successfully!");
         $('#example2').DataTable().ajax.reload();
         location.reload();
      } else if (result == "failed") {
         toastr["error"]("Failed to Delete .Try again!");
      } else {
         toastr["error"](result);
      }
      $(".overlay").remove();
      return false;
   });
} //end confirmation
}
</script>

<!-- <script src="<?php echo $theme_link; ?>js/service_status/service.js"></script> -->
<!-- Make sidebar menu hughlighter/selector -->

<script>

$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");</script>

</body>
</html>
