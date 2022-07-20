<!DOCTYPE html>
<html>

<head>
<!-- TABLES CSS CODE -->
<?php include"comman/code_css.php"; ?>
<link rel="stylesheet" href="<?php echo $theme_link; ?>css/subscription.css">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Left side column. contains the logo and sidebar -->
  
  <?php include"sidebar.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$page_title;?>
        <small>View/Search Subscription</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $base_url; ?>store/view"><?= $this->lang->line('store_list'); ?></a></li>
        <li class="active"><?=$page_title;?></li>
      </ol>
    </section>
    <div class="pay_now_modal">
    </div>
    <div class="pay_return_due_modal">
    </div>
    <!-- Main content -->
    <?= form_open('#', array('class' => '', 'id' => 'table_form')); ?>
    <input type="hidden" id='base_url' value="<?=$base_url;?>">
    <section class="content">
      <!-- /.row -->
      <div class="row">
        <!-- ********** ALERT MESSAGE START******* -->
        <?php include"comman/code_flashdata.php"; ?>
        <!-- ********** ALERT MESSAGE END******* -->
        
        <div class="col-md-12">
                     <!-- Horizontal Form -->
                     <div class="box box-info ">
                        <div class="box-header with-border">
                           <h3 class="box-title">Store Information</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        
                           <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                           <div class="box-body">
                              <div class="form-group">
                                 <div class="col-sm-6">
                                   <table class="table table-striped table-bordered">
                                      <tr>
                                        <td colspan="2" class="bg-gray text-center text-bold"><?=$this->lang->line('store_details');?></td>
                                      </tr>
                                     <tr>
                                        <td><?=$this->lang->line('store_name');?></td>
                                        <td><b><?=$store_details->store_name;?></b></td>
                                      </tr>
                                      <tr>
                                        <td><?=$this->lang->line('address');?></td>
                                        <td><b><?=$store_details->address;?></b></td>
                                      </tr>
                                      <tr>
                                        <td><?=$this->lang->line('mobile');?></td>
                                        <td><b><?=$store_details->mobile;?></b></td>
                                      </tr>
                                      <tr>
                                        <td><?=$this->lang->line('package_name');?></td>
                                        <td><b><?=(isset($subscription_details->package_name)) ? $subscription_details->package_name : '';?></b></td>
                                      </tr>
                                      <tr>
                                        <td><?=$this->lang->line('package_amt');?></td>
                                        <td><b><?=(isset($subscription_details->payment_gross)) ? $subscription_details->payment_gross : '';?></b></td>
                                      </tr>
                                      <tr>
                                        <td><?=$this->lang->line('expire_date');?></td>
                                        <td><b><?=(isset($subscription_details->expire_date) && $subscription_details->expire_date!='1970-01-01') ? show_date($subscription_details->expire_date) : '';?></b></td>
                                      </tr>
                                      <tr>
                                        <td><?=$this->lang->line('remaining_days');?></td>
                                        <td>
                                          <?php 
                                          if(isset($subscription_details->expire_date) && $subscription_details->expire_date!='1970-01-01'){
                                          $day_difference = date_difference($subscription_details->expire_date,date("Y-m-d"));
                                          $day_difference = abs($day_difference);
                                          echo ($day_difference>0) ? "<b>". $day_difference."</b> (Day's Left)" : '<span class="text-danger">No Package Active</span>';
                                        }
                                          ?>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><?=$this->lang->line('created_by');?></td>
                                        <td><b><?=$store_details->created_by;?></b></td>
                                      </tr>
                                   </table>
                                 </div>
                                 <div class="col-sm-6">
                                   <table class="table table-striped table-bordered">
                                    <tr>
                                        <td colspan="2" class="bg-gray text-center text-bold"><?=$this->lang->line('store_admin_details');?></td>
                                      </tr>
                                     <tr>
                                        <td><?=$this->lang->line('name');?></td>
                                        <td><b><?=$user_details->username;?></b></td>
                                      </tr>
                                      <tr>
                                        <td><?=$this->lang->line('email');?></td>
                                        <td><b><?=$user_details->email;?></b></td>
                                      </tr>
                                      <tr>
                                        <td><?=$this->lang->line('mobile');?></td>
                                        <td><b><?=$user_details->mobile;?></b></td>
                                      </tr>
                                      
                                   </table>
                                 </div>
                              </div>
                           </div>
                           <!-- /.box-body -->
                           <div class="box-footer">
                             
                           </div>
                           <!-- /.box-footer -->
                        
                     </div>
                     <!-- /.box -->
                  </div>


        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <div class="col-lg-3 col-xs-6">
                <?= $this->lang->line('subscription_list'); ?>
                </div>
              <?php if(is_admin()) { ?>
              <div class="box-tools">
                <a class="btn btn-block btn-info" href="<?= base_url('subscribers/add/'.$store_id) ?>">
                <i class="fa fa-plus"></i> <?= $this->lang->line('manual_subscription'); ?></a>
              </div>
              <?php } ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered custom_hover" width="100%">
                <thead class="bg-gray ">
                <tr>
                  <th class="text-center">
                    <input type="checkbox" class="group_check checkbox" >
                  </th>
                  <th><?= $this->lang->line('package_name'); ?></th>
                  <th><?= $this->lang->line('subscription_date'); ?></th>
                  <th><?= $this->lang->line('trial_days'); ?></th>
                  <th><?= $this->lang->line('expire_date'); ?></th>
                  <th><?= $this->lang->line('max_warehouses'); ?></th>
                  <th><?= $this->lang->line('max_users'); ?></th>
                  <th><?= $this->lang->line('max_items'); ?></th>
                  <th><?= $this->lang->line('max_invoices'); ?></th>
                  <th><?= $this->lang->line('payment_details'); ?></th>
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
function load_datatable(){
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
            { extend: 'copy', className: 'btn bg-teal color-palette btn-flat',footer: true, exportOptions: { columns: [1,2,3,4,5,6,7,8]} },
            { extend: 'excel', className: 'btn bg-teal color-palette btn-flat',footer: true, exportOptions: { columns: [1,2,3,4,5,6,7,8]} },
            { extend: 'pdf', className: 'btn bg-teal color-palette btn-flat',footer: true, exportOptions: { columns: [1,2,3,4,5,6,7,8]} },
            { extend: 'print', className: 'btn bg-teal color-palette btn-flat',footer: true, exportOptions: { columns: [1,2,3,4,5,6,7,8]} },
            { extend: 'csv', className: 'btn bg-teal color-palette btn-flat',footer: true, exportOptions: { columns: [1,2,3,4,5,6,7,8]} },
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
            "url": "<?php echo site_url('subscribers/ajax_list')?>",
            "type": "POST",
            "data": {
                      store_id:<?=$store_id?>,
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
            "targets": [ 0,10 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        {
            "targets" :[0],
            "className": "text-center",
        },
        
        ],
    });
    new $.fn.dataTable.FixedHeader( table );
}

$(document).ready(function() {
    //datatables
   load_datatable();
});



</script>

<script src="<?php echo $theme_link; ?>js/subscription.js"></script>

<!-- Make sidebar menu hughlighter/selector -->
<script>$(".store_list-active-li").addClass("active");</script>
    
</body>
</html>
