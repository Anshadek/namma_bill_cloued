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
		padding-left: 24px;
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
					Package Lists

				</h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Package Lists</li>
				</ol>
			</section>
	
			<!-- Main content -->
		
   
			<section class="content">
				<div class="row">
					

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
													<h1 style="text-align:center;">Package Lists</h1>
										<?php if($this->session->flashdata('failed') != "") { ?>			
                <div class="alert alert-danger alert-dismissable text-center">
                 <a href="javascript:void()" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong><?php echo $this->session->flashdata('failed'); ?></strong>
              </div> 
			  <?php } ?>
              
													
													
													<?php
													$i = 0;
													$warehouse_id = get_store_warehouse_id();
													$q1 = $this->db->select("*")
														->get("db_package_subscription");
													if ($q1->num_rows() > 0) {
														foreach ($q1->result() as $res1) {
													?>
															<div class="pricing-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
																<div class="inner-box">
																	<div class="icon-box">
																		<div class="icon-outer"><i class="fas fa-paper-plane"></i></div>
																	</div>
																	<div class="price-box">
																		<div class="title"><?= $res1->name ?></div>
																		<h4 class="price">₹ <span id="pack_amount_<?= $i ?>"><?= $res1->amount ?></span></h4>
																	</div>
																	<ul class="features">
																		<li class="true">Validity : <b><?= $res1->validity ?></b></li>
																		<li class="true">User Count : <b><?= ($res1->is_unlimited == 0) ?  $res1->user_count :  'Unlimited' ?></b></li>
																<li class="true">Warehouse Count : <b><?= ($res1->is_unlimited == 0) ?  $res1->warehouse_count :  'Unlimited' ?></b></li>
																	</ul>
																	<div class="btn-box">
																	<form id="" method="post" action='<?=base_url('subscription/pay')?>'>
    																	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
																		<input type="hidden" name="id" value="<?= $res1->id ?>">
																		<input type="hidden" id="amount_<?= $i ?>" name="amount" value="<?= $res1->amount ?>">
																		<input type="hidden" name="warehouse_id" value="<?= $warehouse_id?>">
																		<input type="hidden" id="coupon_id_<?= $i ?>" name="coupon_id" value="0">
																		 
																		<button class="btn btn-success mb-5" type="submit">Buy Now</button><br><br>
																		<button onclick="addRow(<?= $res1->amount ?>,<?= $i ?>)" class="btn btn-primary" type="button">Apply Coupon Code</button><br>
																		
																		<!-- <a onclick="purchasePacakage('<?= $res1->id ?>','<?= $res1->amount ?>','<?= $warehouse_id ?>')" class="theme-btn">BUY plan</a> -->
																	</form>
																	</div>
																</div>
															</div>
													<?php $i++; }
													} ?>
													<input id="i_val" type="hidden" value="0">
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
			
		</div>
		<div class="modal fade  in" id="coupen-modal" style="padding-left: 5px;">
			
					 
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
                    <div class="modal-header header-custom">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <label aria-hidden="true">×</label></button>
                      <h4 class="modal-title text-center">Enter Your Coupon Code</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                         
								  <div class="col-md-12">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="coupon_code">Coupon Code</label>
                                <label id="coupon_code_msg" class="text-danger text-right pull-right"></label>
                                <input type="text" class="form-control" id="coupon_code" name="coupon_code" placeholder="Coupon Code">
								<input type="hidden" id="package_amount">
                              </div>
                            </div>
                          </div>
                          <input type="hidden" name="id" value="0">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                      <button onclick="applyCoupon()" type="button" id="save" class="btn btn-primary add_customer">Save</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
					           
               </div>
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
		

		function purchasePacakage(id, amount, warehouse_id) {
			if (confirm('Are you sure you want to purchase this package?')) {
				$.post(base_url + "subscription/purchase_pacakage", {
					id: id,
					amount: amount,
					warehouse_id: warehouse_id
				}, function(result) {
					if (result == "success") {
						toastr["success"]("Package Purchased Successfully!");

						success.currentTime = 0;
						success.play();

					} else if (result == "failed") {
						toastr["error"]("Failed to Package Purchase.Try again!");
						failed.currentTime = 0;
						failed.play();

						return false;
					} else {
						toastr["error"](result);
						return false;
					}
				});

			} else {
				return 0;
			}

		}
		function addRow(amt,i_val) {
				$('#i_val').val(i_val);
				$('#package_amount').val(amt);
				$('#coupen-modal').modal('show'); 
			}
	</script>
	


	<!-- Make sidebar menu hughlighter/selector -->
	<script>
		$(".<?php echo basename(__FILE__, '.php'); ?>-active-li").addClass("active");
function applyCoupon()
{
	var base_url=$("#base_url").val();
	var coupon_code = $('#coupon_code').val(); 
	var package_amount = $('#package_amount').val(); 
	$.post(base_url+"subscription/get_coupon_details",{coupon_code:coupon_code,package_amount:package_amount},function(data){
		var result = $.parseJSON(data);
		if(result.expire_status=="Valid")
				{
					toastr["success"](result.message);
				  success.currentTime = 0; 
				  success.play();
				  var i_val = $('#i_val').val();
				  $('#pack_amount_'+i_val).text(result.new_package_amount);
				  $('#amount_'+i_val).val(result.new_package_amount);
				  $('#coupon_id_'+i_val).val(result.coupon_id);
				  $('#coupen-modal').modal('hide'); 
				  return false;
				}else{
					toastr["error"](result.message);
				  failed.currentTime = 0; 
				  failed.play();
				  return false;
				}
	});
}
	</script>
</body>

</html>
