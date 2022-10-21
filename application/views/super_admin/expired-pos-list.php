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
				Expired Pos List
					<small>Manage Expired Pos</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Expired Pos</li>
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
								<h3 class="box-title">Expired Pos</h3>

								<div class="box-tools">


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
												<th><?= $CI->lang->line('created_date'); ?></th>
												<th>Expired Date</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$CI = &get_instance();
											$i = 1;
											$q1 = $this->db->select("*")->where('warehouse_type', 'System')->join('db_store','db_store.id = db_warehouse.store_id','left')->get("db_warehouse");
											if ($q1->num_rows() > 0) {
												foreach ($q1->result() as $res1) {
											?>
													<tr>
														<td><?php echo $i++; ?> </td>
														<?php if (is_admin() && warehouse_module()) { ?>
															<td><?= get_store_name($res1->store_id); ?> </td>
														<?php } ?>
														<td><?php echo $res1->store_code; ?> </td>
														<td><?php echo $res1->warehouse_name; ?> </td>
														<td><?php echo $res1->mobile; ?> </td>
														<td><?php echo $res1->email; ?> </td>
														<td><?php echo $res1->created_date; ?> </td>
														<td><?php echo date('Y-m-d', strtotime("+1 year", strtotime($res1->created_date))); ?> </td>
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
								columns: [0, 1, 2]
							}
						},
						{
							extend: 'excel',
							className: 'btn bg-teal color-palette btn-flat',
							exportOptions: {
								columns: [0, 1, 2]
							}
						},
						{
							extend: 'pdf',
							className: 'btn bg-teal color-palette btn-flat',
							exportOptions: {
								columns: [0, 1, 2]
							}
						},
						{
							extend: 'print',
							className: 'btn bg-teal color-palette btn-flat',
							exportOptions: {
								columns: [1, 2, 3, 4, 5]
							}
						},
						{
							extend: 'csv',
							className: 'btn bg-teal color-palette btn-flat',
							exportOptions: {
								columns: [0, 1, 2]
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
						"targets": [3, 4, 5], //first column / numbering column
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
