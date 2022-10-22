<!DOCTYPE html>
<html>

<head>
	<!-- TABLES CSS CODE -->
	<?php $this->load->view('admin_common/code_css.php');?>
	<!-- </copy> -->
</head>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<!-- Left side column. contains the logo and sidebar -->
		<?php $this->load->view('admin_common/sidebar');?>
		<?php $CI =& get_instance(); ?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					Store Subscription
					<small>Manage Store Subscription</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Store Subscription List</li>
				</ol>
			</section>
			<!-- Main content -->
			<section class="content">
				<div class="row">
					<!-- ********** ALERT MESSAGE START******* -->
					<?php $this->load->view('admin_common/code_flashdata');?>
					<!-- ********** ALERT MESSAGE END******* -->
					<div class="col-xs-12">
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Store Subscription List</h3>


								<button onclick="addRow()" title="New Store Subscription?" class="btn btn-primary pull-right"> Add
									Store Subscription </button> <?php if($CI->permissions('warehouse_add')) { ?>
								<div class="box-tools">
									<a class="btn btn-block btn-info" href="<?php echo $base_url; ?>warehouse/add">
										<i class="fa fa-plus"></i> <?= $this->lang->line('add_store'); ?></a>
								</div>
								<?php } ?>
							</div>

							<!-- /.box-header -->
							<div class="box-body">
								<input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">
								<table id="example2" class="table table-bordered custom_hover" width="100%">
									<thead class="bg-gray ">
										<tr>
											<th>#</th>
											<th>Store Code</th>
											<th>Store</th>
											<th>Package</th>
											<th>Start date</th>
											<th>End Date</th>
											<th>Created By</th>
											<th><?= $CI->lang->line('status'); ?></th>
											<th><?= $CI->lang->line('action'); ?></th>
										</tr>
									</thead>
									<tbody>
										<?php
                                 $CI =& get_instance();
                                    $i=1;
                                         $q1= $this->db->select("db_store_purchased_packages.id,
										 db_warehouse.warehouse_name as store_name,
										 db_warehouse.store_id,
										 db_store.store_code,
										 db_store_purchased_packages.created_date,
										 db_store_purchased_packages.status,
										 db_store_purchased_packages.created_by,
										 db_store_purchased_packages.warehouse_id,
										 db_store_purchased_packages.package_id,
										 db_store_purchased_packages.type,
										 db_package_subscription.name as package_name,
										 db_package_subscription.validity,
										 ")
										 ->where('db_warehouse.warehouse_type','System')
										 ->where('db_store_purchased_packages.type','subscription')
										 ->join('db_package_subscription','db_package_subscription.id=db_store_purchased_packages.package_id','left')
										 ->join('db_warehouse','db_warehouse.id=db_store_purchased_packages.warehouse_id','left')
										 ->join('db_store','db_store.id = db_warehouse.store_id','left')
										 ->get("db_store_purchased_packages");
                                    if($q1->num_rows()>0){
                                           foreach ($q1->result() as $res1){
                                        ?>
										<tr>
											<td><?php echo $i++;?> </td>
											<td><?php echo $res1->store_code;?> </td>
											<td><?php echo $res1->store_name;?> </td>
											<td><?php echo $res1->package_name;?> </td>
											<td><?php echo $res1->created_date;?> </td>
											
											<td><span style="color:red;"><?php echo  date('Y-m-d', strtotime($res1->created_date. ' + '.$res1->validity.' days')); ?></span> </td>
											<td><?php echo str_replace("_"," ",$res1->created_by);?> </td>
											
											<td>
												<?php
                                        if($res1->status=='active')                   //1=Active, 0=Inactive
                                          { 
											echo "  <span   class='label label-success' style='cursor:pointer'>".$res1->status." </span>"; }
                                          else
                                          {
                                          echo "<span class='label label-danger' style='cursor:pointer'> ".$res1->status." </span>";
                                          }
                                          ?>
											</td>
											<td>
												<div class="btn-group" title="View Account">
													<a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
														Action <span class="caret"></span>
													</a>
													<ul role="menu" class="dropdown-menu dropdown-light pull-right">

														<li>
															<a title="Edit Record ?"
																onclick="editRow('<?= $res1->id ?>',
																'<?= $res1->warehouse_id ?>',
																'<?= $res1->package_id ?>',
																'<?= $res1->created_date ?>',
																'<?= $res1->status ?>',
																)">
																Edit
															</a>
														</li>


														<li>
															<a style="cursor:pointer" title="Delete Record ?"
																onclick="deleteRow('<?=$res1->id;?>')">
																Delete
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
		<?php $this->load->view('footer.php');?>
		<!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>
		<div class="modal fade  in" id="trial-pack-modal" style="padding-left: 5px;">
			<?= form_open('#', array('class' => 'form-horizontal', 'id' => 'subscription-form', 'enctype'=>'multipart/form-data', 'method'=>'POST'));?>


			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header header-custom">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<label aria-hidden="true">×</label></button>
						<h4 class="modal-title text-center">Add Subscription</h4>
					</div>
					<div class="modal-body">
						<div class="row">
						
						<div class="col-md-6">
						<input type="hidden" name="id" id="id" value="">
								<div class="box-body">
									<div class="form-group">
										<label for="warehouse_id">Store *</label>
										<label id="warehouse_id_msg" class="text-danger text-right pull-right"></label>
										<select class="form-control select2" id="warehouse_id" name="warehouse_id"
											 style="width: 100%;">
											<option value="">-Select-</option>
											<?php 
											$q1= $this->db->select("warehouse_name,db_warehouse.id,db_store.store_code")
											->join('db_store','db_store.id=db_warehouse.store_id','left')
											->where('db_warehouse.status',1)
											->where('db_warehouse.warehouse_type','System')
											->get("db_warehouse");
											if($q1->num_rows()>0){
												foreach ($q1->result() as $res1){
											?>
											
											<option value="<?= $res1->id ?>"><?= $res1->store_code.'--'.$res1->warehouse_name ?></option>
										<?php } 
										}?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6">
						
								<div class="box-body">
									<div class="form-group">
										<label for="package_id">Packages *</label>
										<label id="package_id_msg" class="text-danger text-right pull-right"></label>
										<select class="form-control" id="package_id" name="package_id"
											 style="width: 100%;">
											<option value="">-Select-</option>
											<?php 
											$q1= $this->db->select("name,id")->where('status',1)->where('status',1)->get("db_package_subscription");
											if($q1->num_rows()>0){
												foreach ($q1->result() as $res1){
											?>
											
											<option value="<?= $res1->id ?>"><?= $res1->name ?></option>
										<?php } 
										}?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="box-body">
									<div class="form-group">
										<label for="date">Date *</label>
										<label id="date_msg" class="text-danger text-right pull-right"></label>
										<input type="date" class="form-control" id="date" name="date" placeholder="date">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="box-body">
									<div class="form-group">
									<label id="status_msg" class="text-danger text-right pull-right"></label>
										<label for="status">Status *</label>
										<select class="form-control" id="status" onchange="isUnlimited(this.value)" name="status" style="width: 100%;">
											<option value="">-Select-</option>
											<option value="active">Active</option>
											<option value="cancel">Cancel</option>
											<option value="inactive">Inactive</option>
											<option value="suspended">Suspended </option>
										</select>
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
		<!-- ./wrapper -->
		<!-- SOUND CODE -->
		<?php $this->load->view('admin_common/code_js_sound.php');?>
		<!-- TABLES CODE -->
		<?php $this->load->view('admin_common/code_js.php');?>
		<script src="<?php echo $theme_link; ?>js/super_admin_store_pacakge_assign.js?v=9"></script>
		<script type="text/javascript">
			function deleteRow(id) {
				var base_url = $("#base_url").val();
				if (confirm("Do You Wants to Delete Record ?")) {
					$(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
					$.post(base_url + "super_admin/delete_assign_store_subscription", {
						id: id
					}, function (result) {
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
			$(document).ready(function () {
				//datatables
				var table = $('#example2').DataTable({

					/* FOR EXPORT BUTTONS START*/
					dom: '<"row margin-bottom-12"<"col-sm-12"<"pull-left"l><"pull-right"fr><"pull-right margin-left-10 "B>>>tip',
					/* dom:'<"row"<"col-sm-12"<"pull-left"B><"pull-right">>> <"row margin-bottom-12"<"col-sm-12"<"pull-left"l><"pull-right"fr>>>tip',*/
					buttons: {
						buttons: [{
								className: 'btn bg-red color-palette btn-flat hidden delete_btn pull-left',
								text: 'Delete',
								action: function (e, dt, node, config) {
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

			function editRow(id,warehouse_id,package_id,created_date,status) {
				
				$('#id').val(id);
				$('#warehouse_id').val(warehouse_id);
				$('#package_id').val(package_id);
				$('#date').val(created_date);
				$('#status').val(status);
				$('#trial-pack-modal').modal('show');
			}

			function addRow(params) {
				$('#subscription-form')[0].reset();
				$('#id').val(0);
				$('#trial-pack-modal').modal('show');
			}
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
		</script>
		<script>
			$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");

		</script>
</body>

</html>
