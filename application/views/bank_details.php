<!DOCTYPE html>
<html>

<head>
<!-- TABLES CSS CODE -->
<?php include"comman/code_css.php"; ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Left side column. contains the logo and sidebar -->
  
  <?php include"sidebar.php"; ?>
  <?php
  /*Bank Transfer details*/
   $bank                   = get_super_admin_bank_details();
   $bankCountryId          = $bank->country_id;
   $bankAccountHolderName  = $bank->holder_name;
   $bankName               = $bank->bank_name;
   $bankBranch             = $bank->branch_name;
   $bankCode               = $bank->code; //Ifsc or Bank code
   $bankAccountType        = $bank->account_type;
   $bankAccountNumber      = $bank->account_number;
   $bankOtherDetails       = $bank->other_details;//Text
   $description            = $bank->description;//Text
   $bankStatus             = $bank->status;
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$page_title;?>
        <small>View/Search Package</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a data-toggle='tooltip' title='Do you want Import Package ?' href="<?php echo $base_url; ?>import/package"><i class="fa fa-arrow-circle-o-down "></i> <?= $this->lang->line('import_package'); ?></a></li>
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
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <div class="col-lg-3 col-xs-6">
                <?= $this->lang->line('bankDetails'); ?>
                </div>
              
            
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="" class="table table-bordered custom_hover" width="100%">
                <tbody>
                  <tr>
                    <td><?= $this->lang->line('country'); ?></td>
                    <td class='text-bold'><?=(!empty($bankCountryId)) ? get_country_details($bankCountryId)->country : ''?></td>
                  </tr>
                  <tr>
                    <td><?= $this->lang->line('accountHolderName'); ?></td>
                    <td class='text-bold'><?=$bankAccountHolderName?></td>
                  </tr>
                  <tr>
                    <td><?= $this->lang->line('bankName'); ?></td>
                    <td class='text-bold'><?=$bankName?></td>
                  </tr>
                  <tr>
                    <td><?= $this->lang->line('bankBranch'); ?></td>
                    <td class='text-bold'><?=$bankBranch?></td>
                  </tr>
                  <tr>
                    <td><?= $this->lang->line('bankCode'); ?></td>
                    <td class='text-bold'><?=$bankCode?></td>
                  </tr>
                  <tr>
                    <td><?= $this->lang->line('accountType'); ?></td>
                    <td class='text-bold'><?=$bankAccountType?></td>
                  </tr>
                  <tr>
                    <td><?= $this->lang->line('accountNumber'); ?></td>
                    <td class='text-bold'><?=$bankAccountNumber?></td>
                  </tr>
                  <tr>
                    <td><?= $this->lang->line('other_details'); ?></td>
                    <td class='text-bold'><?=$bankOtherDetails?></td>
                  </tr>
                  <tr>
                    <td><?= $this->lang->line('description'); ?></td>
                    <td class='text-bold'><?=$description?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="col-sm-12 text-left">                                 
                      <a href="<?=base_url('dashboard');?>" title="Go Dashboard" class="col-sm-3 btn btn-default close_btn pull-right">Close</a>
                   
                      <a href="<?=$_SERVER['HTTP_REFERER']?>" title="Go Back" class="col-sm-3 btn btn-primary close_btn pull-left">Back</a>

                </div>
             </div>
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

<!-- Make sidebar menu hughlighter/selector -->
<script>$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");</script>
    
</body>
</html>
