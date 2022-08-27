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
  <?php $CI =& get_instance(); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $this->lang->line('accounts_list'); ?>
        <small>View/Search Accounts</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?= $this->lang->line('accounts_list'); ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <?= form_open('#', array('class' => '', 'id' => 'table_form')); ?>
    <input type="hidden" id='base_url' value="<?=$base_url;?>">
    <section class="content">
      <div class="row">
        <!-- ********** ALERT MESSAGE START******* -->
          <?php $this->load->view('comman/code_flashdata');?>
            <!-- ********** ALERT MESSAGE END******* -->
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header ">
              <h3 class="box-title">&nbsp;</h3>
              <?php if($CI->permissions('accounts_add')) { ?>
              <div class="box-tools">
                <a class="btn btn-block btn-info" href="<?php echo $base_url; ?>accounts/add">
                <i class="fa fa-plus"></i> <?= $this->lang->line('add_account'); ?></a>
              </div>
              <?php } ?>
              <div class="col-md-3">
                    <div class="form-group">
                       <label for="debit_account_id"><?= $this->lang->line('warehouse'); ?> </label></label>
											 <select class="form-control" id="warehouse_id" name="warehouse_id" onchange="get_warehouse_accounts(this)" style="width: 100%;">
                       <option value="">-- select  --</option>         
											 <?= get_warehouse_select_list($warehouse_id); ?>
                              </select>
                       <span id="debit_account_id_msg" style="display:none" class="text-danger"></span>
                    </div>
                  </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered custom_hover" width="100%">
                <thead class="bg-gray ">
                <tr>
                  <th class="text-center">
                    <input type="checkbox" class="group_check checkbox" >
                  </th>
                  <th><?= $this->lang->line('warehouse_name'); ?></th> 
                  <th><?= $this->lang->line('account_code'); ?></th>
                  <th><?= $this->lang->line('account_name'); ?></th>
                  <th><?= $this->lang->line('parent_account_name'); ?></th>
                  <th><?= $this->lang->line('balance'); ?></th>
                  <th><?= $this->lang->line('created_by'); ?></th>
                  <th><?= $this->lang->line('action'); ?></th>
                </tr>
                </thead>
                <tbody>
				
                </tbody>
                <tfoot>
                                <tr class="bg-gray">
                                    <th></th>
                                    <th></th>
                                    <th></th>
																		<th></th>
																		<th style="text-align:right">Total</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
               
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

<script type="text/javascript">
$(document).ready(function() {

  load_datatable();
});
$("#warehouse_id").on("change",function(){
      $('#example2').DataTable().destroy();
      load_datatable();
  });
    //datatables
    function load_datatable(){
   var table = $('#example2').DataTable({ 

      /* FOR EXPORT BUTTONS START*/
  dom:'<"row margin-bottom-12"<"col-sm-12"<"pull-left"l><"pull-right"fr><"pull-right margin-left-10 "B>>>tip',
      buttons: {
        buttons: [
            {
                className: 'btn bg-red color-palette btn-flat hidden delete_btn pull-left',
                text: 'Delete',
                action: function ( e, dt, node, config ) {
                    multi_delete();
                }
            },
            { extend: 'copy', className: 'btn bg-teal color-palette btn-flat',exportOptions: { columns: [1,2,3,4,5]} },
            { extend: 'excel', className: 'btn bg-teal color-palette btn-flat',exportOptions: { columns: [1,2,3,4,5]} },
            { extend: 'pdf', className: 'btn bg-teal color-palette btn-flat',exportOptions: { columns: [1,2,3,4,5]} },
            { extend: 'print', className: 'btn bg-teal color-palette btn-flat',exportOptions: { columns: [1,2,3,4,5]} },
            { extend: 'csv', className: 'btn bg-teal color-palette btn-flat',exportOptions: { columns: [1,2,3,4,5]} },
            { extend: 'colvis', className: 'btn bg-teal color-palette btn-flat',text:'Columns' },  

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
            "url": "<?php echo site_url('accounts/ajax_list')?>",
            "type": "POST",
            "data": {
                      
                      warehouse_id: $("#warehouse_id").val(),
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
            "targets": [ 0,7 ], //first column / numbering column
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
                      $( api.column( 5 ).footer() ).html(to_Fixed(total));
                      
                     // $( api.column( 8 ).footer() ).html((due));
                     
                  },
    });
    new $.fn.dataTable.FixedHeader( table );
  }

</script>

<script src="<?php echo $theme_link; ?>js/accounts/accounts.js"></script>
<!-- Make sidebar menu hughlighter/selector -->
<script>$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");</script>
		
</body>
</html>
