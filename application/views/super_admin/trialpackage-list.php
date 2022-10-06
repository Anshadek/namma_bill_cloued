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
					Trial Package
					<small>Manage Trial Package</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Trial Package List</li>
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
								<h3 class="box-title">Trial package List</h3>
	
								<button onclick="addRow()" title="New Trial Package?" class="btn btn-primary pull-right"> Add
									Trial Package </button> <?php if($CI->permissions('warehouse_add')) { ?>
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
											<th>Category</th>
											<th>Name</th>
											<th>Month/Days</th>
											<th>Duration</th>
											<th>Active User</th>
											<th>Is Primary</th>
											<th><?= $CI->lang->line('status'); ?></th>
											<th><?= $CI->lang->line('action'); ?></th>
										</tr>
									</thead>
									<tbody>
										<?php
                                 $CI =& get_instance();
                                    $i=1;
                                         $q1= $this->db->select("a.*,a.id as id,b.id as cat_id,b.code,b.name as cat_name")
										 ->join('db_trialpack_category as b'
										 ,'b.id = a.trial_pack_catid'
										 ,'left')
										 ->get("db_trialpackage as a");
                                    if($q1->num_rows()>0){
                                           foreach ($q1->result() as $res1){
                                        ?>
										<tr>
											<td><?php echo $i++;?> </td>
											<td><?php echo $res1->cat_name;?> </td>
											<td><?php echo $res1->name;?> </td>
											<td><?php echo $res1->day_or_month;?> </td>
											<td><?php echo $res1->days;?> </td>

											<td>
											<?php 
											$validity = $this->input->post('validity');
											$end_date  =  date('Y-m-d');
											$start_date = date('Y-m-d', strtotime('-' . $validity . ' day'));

											$this->db->select();
											$this->db->from('db_store_purchased_packages');
											$this->db->where('package_id', $res1->id);
											$this->db->where('type','trial');
											$this->db->where('created_date >= date("' . $start_date . '")');
											$this->db->where('created_date <= date("' . $end_date . '")');
											?>
											<?=  $this->db->get()->num_rows() ?>
											</td>


											<td>
												<?php
                                        if($res1->is_primary==1)                   //1=primary, 0=notprimary
                                          { echo "<span onclick='update_primary_status(".$res1->id.",".$res1->cat_id.",0)' id='primary_span_".$res1->id."'  class='label label-success' style='cursor:pointer'>Primary </span>"; }
                                          else
                                          {
                                          echo "<span onclick='update_primary_status(".$res1->id.",".$res1->cat_id.",1)' id='primary_span_".$res1->id."'  class='label label-danger' style='cursor:pointer'> not-primary </span>";
                                          }
                                          ?>
											</td>
											<td>
												<?php
                                        if($res1->status==1)                   //1=Active, 0=Inactive
                                          { echo "  <span onclick='update_status(".$res1->id.",0)' id='span_".$res1->id."'  class='label label-success' style='cursor:pointer'>Active </span>"; }
                                          else
                                          {
                                          echo "<span onclick='update_status(".$res1->id.",1)' id='span_".$res1->id."'  class='label label-danger' style='cursor:pointer'> Inactive </span>";
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
																'<?= $res1->trial_pack_catid ?>',
																'<?= $res1->name ?>',
																'<?= $res1->day_or_month ?>',
																'<?= $res1->days ?>'
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
			<?= form_open('#', array('class' => 'form-horizontal', 'id' => 'trial-package-form', 'enctype'=>'multipart/form-data', 'method'=>'POST'));?>


			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header header-custom">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<label aria-hidden="true">×</label></button>
						<h4 class="modal-title text-center">Add Trial Package</h4>
					</div>
					<div class="modal-body">
						<div class="row">
						<div class="col-md-6">
						<input type="hidden" name="id" id="id" value="">
								<div class="box-body">
									<div class="form-group">
										<label for="trial_pack_catid">Trial Pack Catgory *</label>
										<label id="trial_pack_catid_msg" class="text-danger text-right pull-right"></label>
										<select class="form-control" id="trial_pack_catid" name="trial_pack_catid"
											 style="width: 100%;">
											<option value="">-Select-</option>
											<?php 
											$q1= $this->db->select("name,code,id")->where('status',1)->get("db_trialpack_category");
											if($q1->num_rows()>0){
												foreach ($q1->result() as $res1){
											?>
											
											<option value="<?= $res1->id ?>"><?= $res1->code.'--'.$res1->name ?></option>
										<?php } 
										}?>
										</select>
									</div>
								</div>
							</div>
						<div class="col-md-6">
								<div class="box-body">
									<div class="form-group">
									<label id="day_or_month_msg" class="text-danger text-right pull-right"></label>
										<label for="day_or_month">Months/Days *</label>
										<select class="form-control" id="day_or_month" name="day_or_month"
											 style="width: 100%;">
											<option value="">-Select-</option>
											<option value="day">Day</option>
											<option value="month">Month </option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="box-body">
									<div class="form-group">
										
										<label for="name">Name *</label>
										<label id="name_msg" class="text-danger text-right pull-right"></label>
										<input type="text" class="form-control" id="name" name="name" placeholder="">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="box-body">
									<div class="form-group">
										<label for="days">Duration *</label>
										<label id="days_msg" class="text-danger text-right pull-right"></label>
										<input type="text" class="form-control" id="days" name="days" placeholder="">
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
		<script src="<?php echo $theme_link; ?>js/super_admin_trialpackage.js?v=6"></script>
		<script type="text/javascript">
			function deleteRow(id) {
				var base_url = $("#base_url").val();
				if (confirm("Do You Wants to Delete Record ?")) {
					$(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
					$.post(base_url + "super_admin/delete_trial_package", {
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

			function editRow(id,trial_pack_catid,name,day_or_month,days) {
				
				$('#trial-pack-modal').modal('show');
				$('#id').val(id);
				$('#name').val(name);
				$('#trial_pack_catid').val(trial_pack_catid);
				$('#day_or_month').val(day_or_month);
				$('#days').val(days);
			}

			function addRow(params) {
				$('#trial-package-form')[0].reset();
				$('#id').val(0);
				$('#trial-pack-modal').modal('show');
			}

		</script>
		<script>
			$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");

		</script>
</body>

</html>
