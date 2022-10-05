<!DOCTYPE html>
<html>

<head>
	<!-- TABLES CSS CODE -->
	<?php include "comman/code_css.php"; ?>
	<!-- </copy> -->
</head>
<style>
	a,
	a:hover,
	a:focus,
	a:active {
		text-decoration: none;
		outline: none;
	}

	a,
	a:active,
	a:focus {
		color: #333;
		text-decoration: none;
		transition-timing-function: ease-in-out;
		-ms-transition-timing-function: ease-in-out;
		-moz-transition-timing-function: ease-in-out;
		-webkit-transition-timing-function: ease-in-out;
		-o-transition-timing-function: ease-in-out;
		transition-duration: .2s;
		-ms-transition-duration: .2s;
		-moz-transition-duration: .2s;
		-webkit-transition-duration: .2s;
		-o-transition-duration: .2s;
	}

	ul {
		margin: 0;
		padding: 0;
		list-style: none;
	}

	img {
		max-width: 100%;
		height: auto;
	}

	/*--blog----*/

	.sec-title {
		position: relative;
		margin-bottom: 70px;
	}

	.sec-title .title {
		position: relative;
		display: block;
		font-size: 16px;
		line-height: 1em;
		color: #ff8a01;
		font-weight: 500;
		background: rgb(247, 0, 104);
		background: -moz-linear-gradient(to left, rgba(247, 0, 104, 1) 0%, rgba(68, 16, 102, 1) 25%, rgba(247, 0, 104, 1) 75%, rgba(68, 16, 102, 1) 100%);
		background: -webkit-linear-gradient(to left, rgba(247, 0, 104, 1) 0%, rgba(68, 16, 102, 1) 25%, rgba(247, 0, 104, 1) 75%, rgba(68, 16, 102, 1) 100%);
		background: linear-gradient(to left, rgba(247, 0, 104) 0%, rgba(68, 16, 102, 1) 25%, rgba(247, 0, 104, 1) 75%, rgba(68, 16, 102, 1) 100%);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#F70068', endColorstr='#441066', GradientType=1);
		color: transparent;
		-webkit-background-clip: text;
		-webkit-text-fill-color: transparent;
		text-transform: uppercase;
		letter-spacing: 5px;
		margin-bottom: 15px;
	}

	.sec-title h2 {
		position: relative;
		display: inline-block;
		font-size: 48px;
		line-height: 1.2em;
		color: #1e1f36;
		font-weight: 700;
	}

	.sec-title .text {
		position: relative;
		font-size: 16px;
		line-height: 28px;
		color: #888888;
		margin-top: 30px;
	}

	.sec-title.light h2,
	.sec-title.light .title {
		color: #ffffff;
		-webkit-text-fill-color: inherit;
	}

	.pricing-section {
		position: relative;
		padding: 100px 0 80px;
		overflow: hidden;
	}

	.pricing-section .outer-box {
		max-width: 1100px;
		margin: 0 auto;
	}


	.pricing-section .row {
		margin: 0 -30px;
	}

	.pricing-block {
		position: relative;
		padding: 0 30px;
		margin-bottom: 40px;
	}

	.pricing-block .inner-box {
		position: relative;
		background-color: #ffffff;
		box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
		padding: 0 0 30px;
		max-width: 370px;
		margin: 0 auto;
		border-bottom: 20px solid #40cbb4;
	}

	.pricing-block .icon-box {
		position: relative;
		padding: 50px 30px 0;
		background-color: #40cbb4;
		text-align: center;
	}

	.pricing-block .icon-box:before {
		position: absolute;
		left: 0;
		bottom: 0;
		height: 75px;
		width: 100%;
		border-radius: 50% 50% 0 0;
		background-color: #ffffff;
		content: "";
	}


	.pricing-block .icon-box .icon-outer {
		position: relative;
		height: 150px;
		width: 150px;
		background-color: #ffffff;
		border-radius: 50%;
		margin: 0 auto;
		padding: 10px;
	}

	.pricing-block .icon-box i {
		position: relative;
		display: block;
		height: 130px;
		width: 130px;
		line-height: 120px;
		border: 5px solid #40cbb4;
		border-radius: 50%;
		font-size: 50px;
		color: #40cbb4;
		-webkit-transition: all 600ms ease;
		-ms-transition: all 600ms ease;
		-o-transition: all 600ms ease;
		-moz-transition: all 600ms ease;
		transition: all 600ms ease;
	}

	.pricing-block .inner-box:hover .icon-box i {
		transform: rotate(360deg);
	}

	.pricing-block .price-box {
		position: relative;
		text-align: center;
		padding: 10px 20px;
	}

	.pricing-block .title {
		position: relative;
		display: block;
		font-size: 24px;
		line-height: 1.2em;
		color: #222222;
		font-weight: 600;
	}

	.pricing-block .price {
		display: block;
		font-size: 30px;
		color: #222222;
		font-weight: 700;
		color: #40cbb4;
	}


	.pricing-block .features {
		position: relative;
		max-width: 200px;
		margin: 0 auto 20px;
	}

	.pricing-block .features li {
		position: relative;
		display: block;
		font-size: 14px;
		line-height: 30px;
		color: #848484;
		font-weight: 500;
		padding: 5px 0;
		padding-left: 18px;
		border-bottom: 1px dashed #dddddd;
	}

	.pricing-block .features li:before {
		position: absolute;
		left: 0;
		top: 50%;
		font-size: 16px;
		color: #2bd40f;
		-moz-osx-font-smoothing: grayscale;
		-webkit-font-smoothing: antialiased;
		display: inline-block;
		font-style: normal;
		font-variant: normal;
		text-rendering: auto;
		line-height: 1;
		content: "\f058";
		font-family: "Font Awesome 5 Free";
		margin-top: -8px;
	}

	.pricing-block .features li.false:before {
		color: #e1137b;
		content: "\f057";
	}

	.pricing-block .features li a {
		color: #848484;
	}

	.pricing-block .features li:last-child {
		border-bottom: 0;
	}

	.pricing-block .btn-box {
		position: relative;
		text-align: center;
	}

	.pricing-block .btn-box a {
		position: relative;
		display: inline-block;
		font-size: 14px;
		line-height: 25px;
		color: #ffffff;
		font-weight: 500;
		padding: 8px 30px;
		background-color: #40cbb4;
		border-radius: 10px;
		border-top: 2px solid transparent;
		border-bottom: 2px solid transparent;
		-webkit-transition: all 400ms ease;
		-moz-transition: all 400ms ease;
		-ms-transition: all 400ms ease;
		-o-transition: all 400ms ease;
		transition: all 300ms ease;
	}

	.pricing-block .btn-box a:hover {
		color: #ffffff;
	}

	.pricing-block .inner-box:hover .btn-box a {
		color: #40cbb4;
		background: none;
		border-radius: 0px;
		border-color: #40cbb4;
	}

	.pricing-block:nth-child(2) .icon-box i,
	.pricing-block:nth-child(2) .inner-box {
		border-color: #1d95d2;
	}

	.pricing-block:nth-child(2) .btn-box a,
	.pricing-block:nth-child(2) .icon-box {
		background-color: #1d95d2;
	}

	.pricing-block:nth-child(2) .inner-box:hover .btn-box a {
		color: #1d95d2;
		background: none;
		border-radius: 0px;
		border-color: #1d95d2;
	}

	.pricing-block:nth-child(2) .icon-box i,
	.pricing-block:nth-child(2) .price {
		color: #1d95d2;
	}

	.pricing-block:nth-child(3) .icon-box i,
	.pricing-block:nth-child(3) .inner-box {
		border-color: #ffc20b;
	}

	.pricing-block:nth-child(3) .btn-box a,
	.pricing-block:nth-child(3) .icon-box {
		background-color: #ffc20b;
	}

	.pricing-block:nth-child(3) .icon-box i,
	.pricing-block:nth-child(3) .price {
		color: #ffc20b;
	}

	.pricing-block:nth-child(3) .inner-box:hover .btn-box a {
		color: #ffc20b;
		background: none;
		border-radius: 0px;
		border-color: #ffc20b;
	}
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php include "sidebar.php"; ?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					<?= $this->lang->line('site_settings'); ?>
					<small><?= $this->lang->line('add_or_update'); ?> <?= $this->lang->line('site_settings'); ?></small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Site Settings</li>
				</ol>
			</section>

			<!-- Main content -->
			<?= form_open('#', array('class' => 'form-horizontal', 'id' => 'site-form', 'enctype' => 'multipart/form-data', 'method' => 'POST')); ?>
			<section class="content">
				<div class="row">
					<!-- ********** ALERT MESSAGE START******* -->
					<?php include "comman/code_flashdata.php"; ?>
					<!-- ********** ALERT MESSAGE END******* -->

					<div class="col-md-12">
						<!-- Custom Tabs -->
						<div class="nav-tabs-custom">

							<div class="tab-content">
								<div class="tab-pane active" id="tab_1">
									<div class="row">
										<!-- right column -->
										<div class="col-md-12">
											<!-- form start -->
											<input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">
											<div class="box-body">
												<div class="row">
													<h1 style="text-align:center;">Current Package </h1>
													<?php
													$package = array();
													$warehouse_id = get_store_warehouse_id();
													
													$q1 = $this->db->select("type")
														->where('warehouse_id',$warehouse_id )->limit(1)
														->get("db_store_purchased_packages")->row();
														
													if (!empty($q1)) {

														if ($q1->type == 'trial') {

															$q2 = $this->db->select("db_trialpackage.name,
																	db_trialpackage.day_or_month
																	,db_trialpackage.days")
																->where('warehouse_id', $warehouse_id)
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
																	db_package_subscription.is_unlimited,
																	db_package_subscription.amount")
																->where('warehouse_id',$warehouse_id)
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
													?>
														<?php if (!empty($package) == true) { ?>
															<div class="col-md-3"></div>
														<div class="pricing-block col-lg-6 col-md-6 col-sm-12 wow fadeInUp text-center">
														<div class="inner-box">
															<div class="icon-box">
																<div class="icon-outer"><i class="fas fa-paper-plane"></i></div>
															</div>
															<div class="price-box">
																<div class="title"><?= $package->name ?></div>
																<?php if($package->type == "subscription") { ?>
																<h4 class="price">₹ <?= $package->amount ?></h4>
																<?php }else { ?>
																<h4 class="price">₹ 0 </h4>
																<?php } ?>
															</div>
															<ul class="features">
															<?php if($package->type == "subscription") { ?>
																<li class="true">Type : <b>Subscription</b></li>
																<li class="true">Validity : <b><?= $package->validity ?> -  Days</b></li>
																<li class="true">User Count : <b><?= ($package->is_unlimited == 0) ?  $package->user_count :  'Unlimited' ?></b></li>
																<li class="true">Warehouse Count : <b><?= ($package->is_unlimited == 0) ?  $package->warehouse_count :  'Unlimited' ?></b></li>
															<?php } else { ?>
																<li class="true">Type : <b>Trial</b></li>
																<li class="true">Validity : <b><?= $package->validity ?> - <?= $package->day_or_month ?></b></li>
																<li class="true">User Count : <b>Un Limited</b></li>
																<li class="true">Warehouse Count : <b>Un limited</b></li>
																<?php } ?>
															</ul>
															
														</div>
													</div>
													<div class="col-md-3"></div>
													<?php } ?>


												</div><hr>
												<div class="row">
													<h1 style="text-align:center;color: red;">Expired  Package </h1>
													<?php
													$package = array();
													$warehouse_id = get_store_warehouse_id();
														if ($q1->type == 'trial') {

															$q2 = $this->db->select("db_trialpackage.name,
																	db_trialpackage.day_or_month
																	,db_trialpackage.days")
																->where('warehouse_id', $warehouse_id)
																->join(
																	'db_trialpackage',
																	'db_trialpackage.id = db_store_purchased_packages.package_id',
																	'left'
																)
																->limit(1)
																->get("db_store_purchased_packages");

															$package  = $q2;
															$package->type = 'trial';

														
														
														?>
														<div class="pricing-block col-lg-6 col-md-6 col-sm-12 wow fadeInUp text-center">
														<div class="inner-box">
															<div class="icon-box">
																<div class="icon-outer"><i class="fas fa-paper-plane"></i></div>
															</div>
															<div class="price-box">
																<div class="title"><?= $package->name ?></div>
																<h4 class="price">₹ 0 </h4>
															</div>
															<ul class="features">
															
																<li class="true">Type : <b>Trial</b></li>
																<li class="true">Validity : <b><?= $package->validity ?> - <?= $package->day_or_month ?></b></li>
																<li class="true">User Count : <b>Un Limited</b></li>
																<li class="true">Warehouse Count : <b>Un limited</b></li>
																
															</ul>
															
														</div>
													</div>
													
													<?php } 
													
															$q2 = $this->db->select("db_package_subscription.name,
																	db_package_subscription.validity,
																	db_package_subscription.user_count,
																	db_package_subscription.warehouse_count,
																	db_package_subscription.is_unlimited,
																	db_package_subscription.amount")
																->where('warehouse_id',$warehouse_id)
																->join(
																	'db_package_subscription',
																	'db_package_subscription.id = db_store_purchased_packages.package_id',
																	'left'
																)
																->limit(1)
																->get("db_store_purchased_packages");
															
														
													
													?>
														<?php if ($q2->num_rows()>0) { 
															  foreach ($q2->result() as $res1){
															?>
															
														<div class="pricing-block col-lg-6 col-md-6 col-sm-12 wow fadeInUp text-center">
														<div class="inner-box">
															<div class="icon-box">
																<div class="icon-outer"><i class="fas fa-paper-plane"></i></div>
															</div>
															<div class="price-box">
																<div class="title"><?= $res1->name ?></div>
																<h4 class="price">₹ <?= $res1->amount ?></h4>
															</div>
															<ul class="features">
																<li class="true">Type : <b>Subscription</b></li>
																<li class="true">Validity : <b><?= $res1->validity ?> -  Days</b></li>
																<li class="true">User Count : <b><?= ($res1->is_unlimited == 0) ?  $res1->user_count :  'Unlimited' ?></b></li>
																<li class="true">Warehouse Count : <b><?= ($res1->is_unlimited == 0) ?  $res1->warehouse_count :  'Unlimited' ?></b></li>
															
															</ul>
															
														</div>
													</div>
													
													<?php } } ?>


												</div>
											</div>
											<!-- /.box-body -->
											<!-- /.box-footer -->

										</div>
										<!--/.col (right) -->
									</div>
									<!-- /.row -->
								</div>
								<!-- /.tab-pane -->
							</div>
							<!-- /.tab-content -->
						</div>
						<!-- nav-tabs-custom -->
						<div>

						</div>
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
			</section>
			<!-- /.content -->
			<?= form_close(); ?>
		</div>
		<!-- /.content-wrapper -->
		<?php include "footer.php"; ?>
		<!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>
	</div>
	<!-- ./wrapper -->

	<?php include 'comman/code_js_language.php'; ?>

	<!-- SOUND CODE -->
	<?php include "comman/code_js_sound.php"; ?>
	<!-- TABLES CODE -->
	<?php include "comman/code_js.php"; ?>

	<script type="text/javascript">
		$(document).submit(function(event) {
			event.preventDefault();
			if ($("#update").length) {
				$("#update").trigger('click');
			}
		});
	</script>
	<script src="<?php echo $theme_link; ?>js/site-settings.js"></script>


	<!-- Make sidebar menu hughlighter/selector -->
	<script>
		$(".<?php echo basename(__FILE__, '.php'); ?>-active-li").addClass("active");
	</script>
</body>

</html>
