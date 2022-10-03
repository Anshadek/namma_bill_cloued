<!DOCTYPE html>
<html>

<head>
	<!-- TABLES CSS CODE -->
	<?php $this->load->view('admin_common/code_css.php'); ?>
	<!-- </copy> -->
</head>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<!-- Left side column. contains the logo and sidebar -->
		<?php $this->load->view('admin_common/sidebar'); ?>
		<?php $CI = &get_instance(); ?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					<?= $this->lang->line('store_list'); ?>
					<small>Manage Store</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active"><?= $this->lang->line('store_list'); ?></li>
				</ol>
			</section>
			<!-- Main content -->
			<section class="content">
				<div class="row">
					<!-- ********** ALERT MESSAGE START******* -->
					<?php $this->load->view('admin_common/code_flashdata'); ?>
					<!-- ********** ALERT MESSAGE END******* -->
					<div class="col-xs-12">
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title"><?= $CI->lang->line('store_list'); ?></h3>
								<a href="<?php echo $base_url; ?>super_admin/add_store"><button class="btn btn-primary pull-right"> Add Store </button></a> <?php if ($CI->permissions('warehouse_add')) { ?>
									<div class="box-tools">
										<a class="btn btn-block btn-info" href="<?php echo $base_url; ?>warehouse/add">
											<i class="fa fa-plus"></i> <?= $this->lang->line('add_store'); ?></a>
									</div>
								<?php } ?>
								<div class="row">
									<form action="<?= base_url('super_admin/stores') ?>" method="post">
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
										<div class="col-md-12">
											<div class="col-md-4">
												<div class="box-body">
													<div class="form-group">

														<label for="filter_pay_status">Pay Status</label>
														<select class="form-control" id="filter_pay_status" name="filter_pay_status" style="width: 100%;">
															<option value="">-Select-</option>
															<option <?= (($filter_pay_status == 1) ? 'selected' : "") ?> value="1">Paid</option>
															<option <?= (($filter_pay_status == 0) ? 'selected' : "") ?> value="0">Un-paid </option>
														</select>
													</div>
												</div>
											</div>

											<div class="col-md-4">
												<div class="box-body">
													<div class="form-group">

														<label for="filter_status">Status</label>
														<select class="form-control" id="filter_status" name="filter_status" style="width: 100%;">
															<option value="">-Select-</option>
															<option <?= (($filter_status == 1) ? 'selected' : "") ?> value="1">Active</option>
															<option <?= (($filter_status == 0) ? 'selected' : "") ?> value="0">Inactive </option>
														</select>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="box-body">
													<div class="form-group">
														<label id="filter_date" class="text-danger text-right pull-right"></label>
														<label for="day_or_month">Date</label>
														<input class="form-control" name="filter_date" type="date" value="<?= $filter_date ?>">
													</div>
												</div>
											</div>
											<button type="submit" style="margin-left: 5px;" class="btn btn-primary pull-right"> Search</button>
											<a class="btn btn-danger pull-right" href="<?= base_url('super_admin/stores') ?>">
												Close
											</a>
										</div>
									</form>
								</div>
							</div>

							<!-- /.box-header -->
							<div class="box-body">
								<input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">
								<table id="example2" class="table table-bordered custom_hover" width="100%">
									<thead class="bg-gray ">
										<tr>
											<th>#</th>
											<th><?= $CI->lang->line('store_name'); ?></th>
											<th><?= $CI->lang->line('mobile'); ?></th>
											<th><?= $CI->lang->line('email'); ?></th>
											<th><?= $CI->lang->line('address'); ?></th>
											<th>Pay status</th>
											<th><?= $CI->lang->line('status'); ?></th>
											<th>Package</th>
											<th><?= $CI->lang->line('action'); ?></th>
										</tr>
									</thead>
									<tbody>
										<?php

										$i = 1;

										if (count($warehouses) > 0) {
											foreach ($warehouses as $res1) {
												//================get package name============================
												$package = array();
												$q1 = $this->db->select("type")
													->where('warehouse_id', $res1->id)->limit(1)
													->get("db_store_purchased_packages")->row();
												if (!empty($q1)) {
													if ($q1->type == 'trial') {
														$q2 = $this->db->select("db_trialpackage.name,
																	db_trialpackage.day_or_month
																	,db_trialpackage.days")
															->where('warehouse_id', $res1->id)
															->join(
																'db_trialpackage',
																'db_trialpackage.id = db_store_purchased_packages.package_id',
																'left'
															)
															->limit(1)
															->get("db_store_purchased_packages")->row();

														$package  = $q2;
														$package->type = 'trial';
													} else {
														$q2 = $this->db->select("db_package_subscription.name,
																	db_package_subscription.validity,
																	db_package_subscription.user_count,
																	db_package_subscription.warehouse_count,
																	db_package_subscription.amount")
															->where('warehouse_id', $res1->id)
															->join(
																'db_package_subscription',
																'db_package_subscription.id = db_store_purchased_packages.package_id',
																'left'
															)
															->limit(1)
															->get("db_store_purchased_packages")->row();
														$package  = $q2;
														$package->type = 'subscription';
													}
												}
												//==================
										?>
												<tr>
													<td><?php echo $i++; ?> </td>
													<?php if (is_admin() && warehouse_module()) { ?>
														<td><?= get_store_name($res1->store_id); ?> </td>
													<?php } ?>
													<td><?php echo $res1->warehouse_name; ?> </td>
													<td><?php echo $res1->mobile; ?> </td>
													<td><?php echo $res1->email; ?> </td>
													<td>

														<?= $res1->address ?>,
														<br><?= $res1->city ?>



													</td>
													<td>
														<?php if ($res1->pay_status == 1)                   //1=Active, 0=Inactive
														{
															echo '<span id="pay_status66" onclick="pay_status(' . $res1->id . ',0)" data-company_id="66" data-pay_status="1" class="label label-success change_pay_status" style="cursor:pointer"><i class="fa fa-money" aria-hidden="true"></i> </span>';
														} else {
															echo '<span id="pay_status66" onclick="pay_status(' . $res1->id . ',1)" data-company_id="66" data-pay_status="0" class="label label-danger change_pay_status" style="cursor:pointer"><i class="fa fa-money" aria-hidden="true"></i> </span>';
														}
														?>

													</td>
													<td>
														<?php
														if ($res1->status == 1)                   //1=Active, 0=Inactive
														{
															echo "  <span onclick='update_status(" . $res1->id . ",0)' id='span_" . $res1->id . "'  class='label label-success' style='cursor:pointer'>Active </span>";
														} else {
															echo "<span onclick='update_status(" . $res1->id . ",1)' id='span_" . $res1->id . "'  class='label label-danger' style='cursor:pointer'> Inactive </span>";
														}
														?>
													</td>
													<td>
														<?php if (!empty($package) == true) { ?>
																
																<?=  $package->name  ?>
																<?php } else { ?>

																	-- 
																	<?php } ?>

													</td>
													<td>



														<div class="btn-group" title="View Account">
															<a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
																Action <span class="caret"></span>
															</a>
															<ul role="menu" class="dropdown-menu dropdown-light pull-right">

																<li>
																	<a title="Update Record ?" href="<?= base_url() ?>super_admin/edit_store/<?= $res1->id; ?>">
																		Edit
																	</a>
																</li>


																<li>
																	<a style="cursor:pointer" title="Delete Record ?" onclick="delete_warehouse('<?= $res1->id; ?>')">
																		Delete
																	</a>
																</li>
																<li>
																	<a title="Update Record ?" href="<?= base_url() ?><?= $res1->document; ?>">
																		Download
																	</a>
																</li>

															</ul>
														</div>



													</td>
												</tr>
										<?php
											}
										}
										?>
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
		</div>
		<!-- /.content-wrapper -->
		<?php $this->load->view('footer.php'); ?>
		<!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>
	</div>
	<!-- ./wrapper -->
	<!-- SOUND CODE -->
	<?php $this->load->view('admin_common/code_js_sound.php'); ?>
	<!-- TABLES CODE -->
	<?php $this->load->view('admin_common/code_js.php'); ?>
	<script src="<?php echo $theme_link; ?>js/warehouse/super_admin_warehouse.js"></script>
	<script type="text/javascript">
		function delete_warehouse(id) {
			var base_url = $("#base_url").val();
			if (confirm("Do You Wants to Delete Record ?")) {
				$(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
				$.post(base_url + "super_admin/delete_store", {
					id: id
				}, function(result) {
					//alert(result);return;
					if (result == "success") {
						toastr["success"]("Record Deleted Successfully!");
						// $('#example2').DataTable().ajax.reload();
						location.reload();

					} else if (result == "failed") {
						toastr["error"]("Failed to Delete .Try again!");

					} else {
						toastr["error"](result);

					}


					$(".overlay").remove();
				});
			} //end confirmation
		}
		//Delete Record end    
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			//datatables
			var table = $('#example2').DataTable({

				/* FOR EXPORT BUTTONS START*/
				dom: '<"row margin-bottom-12"<"col-sm-12"<"pull-left"l><"pull-right"fr><"pull-right margin-left-10 "B>>>tip',
				/* dom:'<"row"<"col-sm-12"<"pull-left"B><"pull-right">>> <"row margin-bottom-12"<"col-sm-12"<"pull-left"l><"pull-right"fr>>>tip',*/
				buttons: {
					buttons: [{
							className: 'btn bg-red color-palette btn-flat hidden delete_btn pull-left',
							text: 'Delete',
							action: function(e, dt, node, config) {
								multi_delete();
							}
						},
						{
							extend: 'copy',
							className: 'btn bg-teal color-palette btn-flat',
							exportOptions: {
								columns: [0, 1, 2, 3, 4]
							}
						},
						{
							extend: 'excel',
							className: 'btn bg-teal color-palette btn-flat',
							exportOptions: {
								columns: [0, 1, 2, 3, 4]
							}
						},
						{
							extend: 'pdf',
							className: 'btn bg-teal color-palette btn-flat',
							exportOptions: {
								columns: [0, 1, 2, 3, 4]
							}
						},
						{
							extend: 'print',
							className: 'btn bg-teal color-palette btn-flat',
							exportOptions: {
								columns: [1, 2, 3, 4, 5, 6, 7]
							}
						},
						{
							extend: 'csv',
							className: 'btn bg-teal color-palette btn-flat',
							exportOptions: {
								columns: [0, 1, 2, 3, 4]
							}
						},
						{
							extend: 'colvis',
							className: 'btn bg-teal color-palette btn-flat',
							text: 'Columns'
						},

					]
				},
				/* FOR EXPORT BUTTONS END */

				"processing": true, //Feature control the processing indicator.
				"serverSide": false, //Feature control DataTables' server-side processing mode.
				"order": [], //Initial no order.
				"responsive": true,
				language: {
					processing: '<div class="text-primary bg-primary" style="position: relative;z-index:100;overflow: visible;">Processing...</div>'
				},
				// Load data for the table's content from an Ajax source

				//Set column definition initialisation properties.
				"columnDefs": [{
						"targets": [4, 5, 6], //first column / numbering column
						"orderable": false, //set not orderable
					},
					{
						"targets": [],
						"className": "text-center",
					},

				],
			});
			new $.fn.dataTable.FixedHeader(table);
		});
	</script>
	<script>
		$(".<?php echo basename(__FILE__, '.php'); ?>-active-li").addClass("active");
	</script>
</body>

</html>
