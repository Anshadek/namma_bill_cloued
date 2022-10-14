<!DOCTYPE html>
<html>

<head>
	<!-- FORM CSS CODE -->
	<?php include "admin_common/code_css.php"; ?>
	<!-- </copy> -->

</head>

<body class="hold-transition skin-blue sidebar-mini  ">

	<div class="wrapper">


		<?php include "admin_common/sidebar.php"; ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					<?= $page_title; ?>
				</h1>
			</section>
			<div class="row">
				<div class="col-md-12">
					<!-- ********** ALERT MESSAGE START******* -->
					<?php include "admin_common/code_flashdata.php"; ?>
					<!-- ********** ALERT MESSAGE END******* -->
				</div>
			</div>

			<!-- Main content -->

			<section class="content">
				<section class="content">
					<div class="row">
						<?php
						$qs1 = "SELECT * FROM db_warehouse where warehouse_type = 'System'";
						$q1 = $this->db->query($qs1);
						?>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="info-box" data-pos_value="">
								<span class="info-box-icon bg-aqua"><i class="fa fa-credit-card"></i></span>
								<div class="info-box-content">
									<span class="text-bold text-uppercase  ">Total POS</span><br>
									<h3 class="info-box-number-admin-panel"><?= $q1->num_rows() ?></h3>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>

						<?php
						$qs2 = "SELECT * FROM db_warehouse where pay_status = 0 and warehouse_type = 'System'";
						$q2 = $this->db->query($qs2);
						?>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="info-box" data-pos_value="">
								<span class="info-box-icon bg-aqua"><i class="fa fa-credit-card"></i></span>
								<div class="info-box-content">
									<span class="text-bold text-uppercase  ">Total Unpaid</span><br>
									<h3 class="info-box-number-admin-panel"><?= $q2->num_rows() ?></h3>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>

						<?php
						$qs3 = "SELECT * FROM db_warehouse where pay_status = 1 and warehouse_type = 'System'";
						$q3 = $this->db->query($qs3);
						?>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="info-box" data-pos_value="">
								<span class="info-box-icon bg-aqua"><i class="fa fa-credit-card"></i></span>
								<div class="info-box-content">
									<span class="text-bold text-uppercase  ">Total Paid</span><br>
									<h3 class="info-box-number-admin-panel"><?= $q3->num_rows() ?></h3>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>

						<?php
						$qs4 = "SELECT * FROM db_warehouse where status = 1 and warehouse_type = 'System'";
						$q4 = $this->db->query($qs4);
						?>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="info-box" data-pos_value="">
								<span class="info-box-icon bg-aqua"><i class="fa fa-credit-card"></i></span>
								<div class="info-box-content">
									<span class="text-bold text-uppercase  ">Total Active</span><br>
									<h3 class="info-box-number-admin-panel"><?= $q4->num_rows() ?></h3>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<?php
						$qs5 = "SELECT * FROM db_warehouse where status = 0 and warehouse_type = 'System'";
						$q5 = $this->db->query($qs5);
						?>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="info-box" data-pos_value="">
								<span class="info-box-icon bg-aqua"><i class="fa fa-credit-card"></i></span>
								<div class="info-box-content">
									<span class="text-bold text-uppercase  ">Total InActive</span><br>
									<h3 class="info-box-number-admin-panel"><?= $q5->num_rows() ?></h3>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<?php
						$qs5 = "SELECT * FROM db_warehouse where status = 0 and warehouse_type = 'System'";
						$q5 = $this->db->query($qs5);
						?>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="info-box" data-pos_value="">
								<span class="info-box-icon bg-aqua"><i class="fa fa-credit-card"></i></span>
								<div class="info-box-content">
									<span class="text-bold text-uppercase  ">Expired Item</span><br>
									<h3 class="info-box-number-admin-panel"><?= $q5->num_rows() ?></h3>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->

						<!-- /.col -->

						<!-- /.col -->

						<!-- /.col -->
					</div>

					<!-- /.row -->

					<div class="row">
						<!-- /.row -->

						<div class="col-md-12">
							<div class="box box-primary">
								<div class="box-header">
									<h3 class="box-title text-uppercase">Expired Pos</h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body table-responsive">
									<div id="example3_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
										<div class="row">
											<div class="col-sm-6"></div>
											<div class="col-sm-6"></div>
										</div>
										<div class="row">
											<div class="col-sm-12">
											<table  class="table table-bordered custom_hover" width="100%">
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
                                 $CI =& get_instance();
                                    $i=1;
                                         $q1= $this->db->select("*")
										 ->where('warehouse_type','System')
										 ->get("db_warehouse");
                                    if($q1->num_rows()>0){
                                           foreach ($q1->result() as $res1){
                                        ?>
                                 <tr>
                                    <td><?php echo $i++;?> </td>
                                    <?php if(is_admin() && warehouse_module()){?>
                                    <td><?= get_store_name($res1->store_id);?> </td>
                                    <?php } ?>
                                    <td><?php echo $res1->warehouse_name;?> </td>
                                    <td><?php echo $res1->mobile;?> </td>
                                    <td><?php echo $res1->email;?> </td>
									<td><?php echo $res1->created_date;?> </td>
									<td><?php echo date('Y-m-d', strtotime("+1 year", strtotime($res1->created_date)));?> </td>
                                 </tr>
                                 <?php
                                    }
                                    }
                                    ?>
                              </tbody>
                           </table>
											</div>
										</div>

										
									
									</div>
								</div>
								<!-- /.box-body -->
							</div>
							<!-- /.box -->
						</div>
						<!-- /.col -->
					</div>

					<div class="row">
						<!-- /.row -->

						<div class="col-md-12">
							<div class="box box-primary">
								<div class="box-header">
									<h3 class="box-title text-uppercase">Newly  Created</h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body table-responsive">
									<div id="example3_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
										<div class="row">
											<div class="col-sm-6"></div>
											<div class="col-sm-6"></div>
										</div>
										<div class="row">
											<div class="col-sm-12">
											<table  class="table table-bordered custom_hover" width="100%">
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
								 	$to_date = date('Y-m-d');
									 $from_date = date('Y-m-d', strtotime("-30 days"));
                                 $CI =& get_instance();
                                    $i=1;
                                         $q1= $this->db->select("*")
										 ->where('warehouse_type','System')
										 ->where('created_date >=',$from_date)
										 ->where('created_date <=',$to_date)
										 ->get("db_warehouse");
                                    if($q1->num_rows()>0){
                                           foreach ($q1->result() as $res1){
                                        ?>
                                 <tr>
                                    <td><?php echo $i++;?> </td>
                                    <?php if(is_admin() && warehouse_module()){?>
                                    <td><?= get_store_name($res1->store_id);?> </td>
                                    <?php } ?>
                                    <td><?php echo $res1->warehouse_name;?> </td>
                                    <td><?php echo $res1->mobile;?> </td>
                                    <td><?php echo $res1->email;?> </td>
																		<td><?php echo $res1->created_date;?> </td>
																		<td><?php echo date('Y-m-d', strtotime("+1 year", strtotime($res1->created_date)));?> </td>
                                 </tr>
                                 <?php
                                    }
                                    }
                                    ?>
                              </tbody>
                           </table>
											</div>
										</div>

										
									
									</div>
								</div>
								<!-- /.box-body -->
							</div>
							<!-- /.box -->
						</div>
						<!-- /.col -->
					</div>


					<!-- ############################# GRAPHS END############################## -->


				</section>

			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<?php $this->load->view('admin_common/footer'); ?>
		<!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>

	</div>
	<!-- ./wrapper -->

	<!-- SOUND CODE -->
	<?php include "admin_common/code_js_sound.php"; ?>
	<!-- TABLES CODE -->
	<?php include "admin_common/code_js.php"; ?>
	<!-- bootstrap datepicker -->

	<!-- ChartJS 1.0.1 -->
	<script src="<?php echo $theme_link; ?>plugins/chartjs/Chart.min.js"></script>
	<script src="<?php echo $theme_link; ?>plugins/chartjs/chartjs-plugin-colorschemes.min.js"></script>
	<script>
		'use strict';

		window.chartColors = {
			red: 'rgb(255, 50, 10)',
			orange: 'rgb(255, 102, 64)',
			yellow: 'rgb(230, 184, 0)',
			green: 'rgb(0, 179, 0)',
			blue: 'rgb(0, 0, 230)',
			purple: 'rgb(134, 0, 179)',
			grey: 'rgb(117, 117, 163)'
		};

		(function(global) {
			var MONTHS = [
				'January',
				'February',
				'March',
				'April',
				'May',
				'June',
				'July',
				'August',
				'September',
				'October',
				'November',
				'December'
			];

			var COLORS = [
				'#4dc9f6',
				'#f67019',
				'#f53794',
				'#537bc4',
				'#acc236',
				'#166a8f',
				'#00a950',
				'#58595b',
				'#8549ba'
			];

			var Samples = global.Samples || (global.Samples = {});
			var Color = global.Color;

			Samples.utils = {
				// Adapted from http://indiegamr.com/generate-repeatable-random-numbers-in-js/
				srand: function(seed) {
					this._seed = seed;
				},

				rand: function(min, max) {
					var seed = this._seed;
					min = min === undefined ? 0 : min;
					max = max === undefined ? 1 : max;
					this._seed = (seed * 9301 + 49297) % 233280;
					return min + (this._seed / 233280) * (max - min);
				},

				numbers: function(config) {
					var cfg = config || {};
					var min = cfg.min || 0;
					var max = cfg.max || 1;
					var from = cfg.from || [];
					var count = cfg.count || 8;
					var decimals = cfg.decimals || 8;
					var continuity = cfg.continuity || 1;
					var dfactor = Math.pow(10, decimals) || 0;
					var data = [];
					var i, value;

					for (i = 0; i < count; ++i) {
						value = (from[i] || 0) + this.rand(min, max);
						if (this.rand() <= continuity) {
							data.push(Math.round(dfactor * value) / dfactor);
						} else {
							data.push(null);
						}
					}

					return data;
				},

				labels: function(config) {
					var cfg = config || {};
					var min = cfg.min || 0;
					var max = cfg.max || 100;
					var count = cfg.count || 8;
					var step = (max - min) / count;
					var decimals = cfg.decimals || 8;
					var dfactor = Math.pow(10, decimals) || 0;
					var prefix = cfg.prefix || '';
					var values = [];
					var i;

					for (i = min; i < max; i += step) {
						values.push(prefix + Math.round(dfactor * i) / dfactor);
					}

					return values;
				},

				months: function(config) {
					var cfg = config || {};
					var count = cfg.count || 12;
					var section = cfg.section;
					var values = [];
					var i, value;

					for (i = 0; i < count; ++i) {
						value = MONTHS[Math.ceil(i) % 12];
						values.push(value.substring(0, section));
					}

					return values;
				},

				color: function(index) {
					return COLORS[index % COLORS.length];
				},

				transparentize: function(color, opacity) {
					var alpha = opacity === undefined ? 0.5 : 1 - opacity;
					return Color(color).alpha(alpha).rgbString();
				}
			};

			// DEPRECATED
			window.randomScalingFactor = function() {
				return Math.round(Samples.utils.rand(-100, 100));
			};

			// INITIALIZATION

			Samples.utils.srand(Date.now());



		}(this));



		<?php if (is_user()) { ?>

			function createConfig(position) {
				return {
					type: 'line',
					data: {
						labels: [
							"<?= $sub_month[6] . '-' . $sub_year[6] ?>",
							"<?= $sub_month[5] . '-' . $sub_year[5] ?>",
							"<?= $sub_month[4] . '-' . $sub_year[4] ?>",
							"<?= $sub_month[3] . '-' . $sub_year[3] ?>",
							"<?= $sub_month[2] . '-' . $sub_year[2] ?>",
							"<?= $sub_month[1] . '-' . $sub_year[1] ?>",
							"<?= $sub_month[0] . '-' . $sub_year[0] ?>",
						],
						datasets: [{
								label: 'Total Subscriptions',
								borderColor: window.chartColors.red,
								backgroundColor: window.chartColors.red,
								data: [
									"<?= $tot_subscribes[6] ?>",
									"<?= $tot_subscribes[5] ?>",
									"<?= $tot_subscribes[4] ?>",
									"<?= $tot_subscribes[3] ?>",
									"<?= $tot_subscribes[2] ?>",
									"<?= $tot_subscribes[1] ?>",
									"<?= $tot_subscribes[0] ?>",
								],
								fill: false,
							},
							/*{
							           label: 'My Second dataset',
							           borderColor: window.chartColors.blue,
							           backgroundColor: window.chartColors.blue,
							           data: [7, 49, 46, 13, 25, 30, 22],
							           fill: false,
							         },*/
						]
					},
					options: {
						responsive: true,
						title: {
							display: true,
							text: 'Tooltip Position: ' + position
						},
						tooltips: {
							position: position,
							mode: 'index',
							intersect: false,
						},
					}
				};
			}

			window.onload = function() {
				var container = document.querySelector('.subscription_chart');

				['average'].forEach(function(position) {
					var div = document.createElement('div');
					div.classList.add('chart-container');

					var canvas = document.createElement('canvas');
					div.appendChild(canvas);
					container.appendChild(div);

					var ctx = canvas.getContext('2d');
					var config = createConfig(position);
					new Chart(ctx, config);
				});
			};
		<?php } ?>

		//BAR CHART
		<?php if (!is_user()) { ?>
			$(function() {

				//get the bar chart canvas
				var ctx = $(".bar-chartcanvas");

				//bar chart data
				var data = {
					labels: [
						"<?= $month[6] ?>",
						"<?= $month[5] ?>",
						"<?= $month[4] ?>",
						"<?= $month[3] ?>",
						"<?= $month[2] ?>",
						"<?= $month[1] ?>",
						"<?= $month[0] ?>",
					],
					datasets: [{
							label: "<?= $this->lang->line('purchase'); ?>",
							data: [
								"<?= $purchase[6] ?>",
								"<?= $purchase[5] ?>",
								"<?= $purchase[4] ?>",
								"<?= $purchase[3] ?>",
								"<?= $purchase[2] ?>",
								"<?= $purchase[1] ?>",
								"<?= $purchase[0] ?>",
							],
							borderColor: window.chartColors.red,
							backgroundColor: window.chartColors.red,
							borderWidth: 1
						},
						{
							label: "<?= $this->lang->line('sales'); ?>",
							data: [
								"<?= $sales[6] ?>",
								"<?= $sales[5] ?>",
								"<?= $sales[4] ?>",
								"<?= $sales[3] ?>",
								"<?= $sales[2] ?>",
								"<?= $sales[1] ?>",
								"<?= $sales[0] ?>",
							],
							borderColor: window.chartColors.blue,
							backgroundColor: window.chartColors.blue,
							borderWidth: 1
						},
						{
							label: "<?= $this->lang->line('expense'); ?>",
							data: [
								"<?= $expense[6] ?>",
								"<?= $expense[5] ?>",
								"<?= $expense[4] ?>",
								"<?= $expense[3] ?>",
								"<?= $expense[2] ?>",
								"<?= $expense[1] ?>",
								"<?= $expense[0] ?>",
							],
							borderColor: window.chartColors.green,
							backgroundColor: window.chartColors.green,
							borderWidth: 1
						}
					]
				};

				//options
				var options = {
					responsive: true,
					title: {
						display: true,
						position: "top",
						fontSize: 18,
						fontColor: "#111"
					},
					legend: {
						display: true,
						position: "top",
						labels: {
							fontColor: "#333",
							fontSize: 16
						}
					},
					scales: {
						yAxes: [{
							ticks: {
								min: 0
							}
						}]
					}
				};
				//create Chart class object
				var chart = new Chart(ctx, {
					type: "bar",
					data: data,
					options: options
				});
			});


			//PIE CHART

			new Chart(document.getElementById("doughnut-chart"), {
				type: 'doughnut',
				data: {
					labels: [
						<?php if ($tranding_item['tot_rec'] > 0) { ?>
							<?php for ($i = $tranding_item['tot_rec']; $i > 0; $i--) { ?> '<?= $tranding_item[$i]['name'] ?>',
							<?php } ?>
						<?php } ?>
					],
					datasets: [{
						label: "Top Items",
						backgroundColor: ["#6666ff", "#ff3399", "#00cc99", "#cccc00", "#ff6600", ""],
						data: [
							<?php if ($tranding_item['tot_rec'] > 0) { ?>
								<?php for ($i = $tranding_item['tot_rec']; $i > 0; $i--) { ?> '<?= $tranding_item[$i]['sales_qty'] ?>',
								<?php } ?>
							<?php } ?>
						],
					}]
				},
				options: {
					title: {
						display: true,
						text: '<?= $this->lang->line('top_10_trending_items'); ?>'
					}
				}
			});
		<?php } ?>
	</script>




	<!-- Make sidebar menu hughlighter/selector -->
	<script>
		$(".<?php echo basename(__FILE__, '.php'); ?>-active-li").addClass("active");
	</script>
	<script type="text/javascript">
		var base_url = '<?= base_url(); ?>';

		function get_dashboard_values(dates = '') {
			var store_id = <?= (isset($store_id)) ? $store_id : get_current_store_id(); ?>;
			$.post(base_url + "dashboard/dashboard_values", {
				store_id: store_id,
				dates: dates
			}, function(result) {
				var data = jQuery.parseJSON(result);
				$.each(data, function(index, element) {
					$("." + index).html(element);
				});
			});
		}

		$("#store_id").on("change", function() {
			//get_dashboard_values();
			$("#dashboard_form").submit();
		});
		jQuery(document).ready(function($) {
			get_dashboard_values('All');
		});

		$(".get_tab_records").on("click", function(event) {
			$(".get_tab_records").removeClass('active');
			$(this).addClass('active');
			get_dashboard_values($(this).html());
		});


		<?php if (is_admin() && store_module()) { ?>
			$("#stores_details").DataTable();
		<?php } ?>
	</script>
	<script>
		/* $(function () {
    $('#example3').DataTable({
      "pageLength" : 5,
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });*/


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
								columns: [1, 2, 3, 4, 5]
							}
						},
						{
							extend: 'excel',
							className: 'btn bg-teal color-palette btn-flat',
							exportOptions: {
								columns: [1, 2, 3, 4, 5]
							}
						},
						{
							extend: 'pdf',
							className: 'btn bg-teal color-palette btn-flat',
							exportOptions: {
								columns: [1, 2, 3, 4, 5]
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
								columns: [1, 2, 3, 4, 5]
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
				"serverSide": true, //Feature control DataTables' server-side processing mode.
				"order": [], //Initial no order.
				"responsive": true,
				language: {
					processing: '<div class="text-primary bg-primary" style="position: relative;z-index:100;overflow: visible;">Processing...</div>'
				},
				// Load data for the table's content from an Ajax source
				"ajax": {
					"url": "<?php echo site_url('dashboard/ajax_list') ?>",
					"type": "POST",

					complete: function(data) {},

				},

				//Set column definition initialisation properties.
				"columnDefs": [{
						//"targets": [ 0,4 ], //first column / numbering column
						"orderable": false, //set not orderable
					},
					{
						//"targets" :[0],
						//"className": "text-center",
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
