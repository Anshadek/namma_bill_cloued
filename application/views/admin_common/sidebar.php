<!-- Change the theme color if it is set -->
<script type="text/javascript">
	if (theme_skin != 'skin-blue') {
		$("body").addClass(theme_skin);
		$("body").removeClass('skin-blue');
	}
	if (sidebar_collapse == 'true') {
		$("body").addClass('sidebar-collapse');
	}
</script>
<!-- end -->



<?php
$CI = &get_instance();
?>
<header class="main-header">

	<!-- Logo -->
	<a href="<?php echo $base_url; ?>dashboard" class="logo">
		<span class="logo-mini"><b>POS</b></span>
		<span class="logo-lg"><b><?php echo $SITE_TITLE; ?></b></span>

		<!-- <span class="logo-lg"><b><?= $this->session->userdata('store_name'); ?></b></span> -->
	</a>

	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>
		<?php if (!is_user()) { ?>
			<div class="btn-group hidden-xs">
				<a href="#" class="btn navbar-btn bg-green dropdown-toggle " data-toggle="dropdown" aria-expanded="false" style="">
					<i class="fa fa-plus"></i>
				</a>
				<ul class="dropdown-menu">
					<?php if ($CI->permissions('sales_add')) { ?>
						<li class="border_bottom">
							<a href="<?php echo $base_url; ?>sales/add">
								<h4> <?= $this->lang->line('sales'); ?></h4>
							</a>
						</li>
					<?php } ?>
					<?php if ($CI->permissions('quotation_add')) { ?>
						<li class="border_bottom">
							<a href="<?php echo $base_url; ?>quotation/add">
								<h4><?= $this->lang->line('quotation'); ?></h4>
							</a>
						</li>
					<?php } ?>
					<?php if ($CI->permissions('purchase_add')) { ?>
						<li class="border_bottom">
							<a href="<?php echo $base_url; ?>purchase/add">
								<h4><?= $this->lang->line('purchase'); ?></h4>
							</a>
						</li>
					<?php } ?>
					<?php if ($CI->permissions('customers_add')) { ?>
						<li class="border_bottom">
							<a href="<?php echo $base_url; ?>customers/add">
								<h4> <?= $this->lang->line('customer'); ?></h4>
							</a>
						</li>
					<?php } ?>
					<?php if ($CI->permissions('suppliers_add')) { ?>
						<li class="border_bottom">
							<a href="<?php echo $base_url; ?>suppliers/add">
								<h4> <?= $this->lang->line('supplier'); ?></h4>
							</a>
						</li>
					<?php } ?>
					<?php if ($CI->permissions('items_add')) { ?>
						<li class="border_bottom">
							<a href="<?php echo $base_url; ?>items/add">
								<h4> <?= $this->lang->line('item'); ?></h4>
							</a>
						</li>
					<?php } ?>
					<?php if ($CI->permissions('expense_add')) { ?>
						<li class="border_bottom">
							<a href="<?php echo $base_url; ?>expense/add">
								<h4> <?= $this->lang->line('expense'); ?></h4>
							</a>
						</li>
					<?php } ?>
				</ul>

				<!-- <div class="searchbox">
                 <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                  <input type="text" name="q" class="form-control" placeholder="Search...">
                      <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                        </button>
                      </span>
                </div>
              </form>
            </div> -->


			</div>
		<?php } ?>
		<!-- Navbar Right Menu -->
		<div class="navbar-custom-menu">

			<ul class="nav navbar-nav">

				<!-- User Account Menu -->

				<li class="dropdown tasks-menu">
					<a href="#" class="dropdown-toggle text-right" data-toggle="dropdown" title="App Language" data-toggle='tooltip'>
						<i class="fa fa-language "></i>
						<?= $this->session->userdata('language'); ?>
					</a>
					<ul class="dropdown-menu " style="width: auto;height: auto;">
						<li>
							<ul class="menu">
								<?php
								$lang_query = $this->db->query('select * from db_languages where status=1  order by language asc');
								foreach ($lang_query->result() as $res) {
									$selected = '';
									if ($this->session->userdata('language') == $res->language) {
										$selected = 'text-blue';
									}
								?>
									<li>
										<a href="<?= $base_url; ?>site/langauge/<?= $res->id; ?>">
											<h3 class='<?= $selected; ?>'><?= $res->language; ?></h3>
										</a>
									</li>
								<?php } ?>
							</ul>
						</li>
					</ul>
				</li>

				<?php if (!is_user() && $CI->permissions('sales_add')) { ?>
					<li class="text-center" id="">
						<a title="POS [Shift+P]" href="<?php echo $base_url; ?>pos"><i class="fa fa-plus-square "></i> POS </a>
					</li>
				<?php } ?>


				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo get_profile_picture(); ?>" class="user-image" alt="User Image">
						<span class="hidden-xs"><?php print ucfirst($this->session->userdata('inv_username')); ?></span>
					</a>

					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header">
							<img src="<?php echo get_profile_picture(); ?>" class="img-circle" alt="User Image">

							<p>
								<?php print ucfirst($this->session->userdata('inv_username')); ?>
								<small>Year <?= date("Y"); ?></small>
								<small class='text-uppercase text-bold'>Role: <?= $this->session->userdata('role_name'); ?></small>
							</p>
						</li>
						<!-- Menu Body -->
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-left">
								<a href="<?php echo $base_url; ?>users/edit/<?= $this->session->userdata('inv_userid'); ?>" class="btn btn-default btn-flat">Profile</a>
							</div>
							<div class="pull-right">
								<a href="<?php echo $base_url; ?>logout" class="btn btn-default btn-flat">Sign out</a>
							</div>
						</li>
					</ul>
				</li>

				<!-- <li class="hidden-xs">
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
			</ul>
		</div>

	</nav>
</header>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo get_profile_picture(); ?>" class="user-image" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php print ucfirst($this->session->userdata('inv_username')); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div> -->
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<!--<li class="header">MAIN NAVIGATION</li>-->
			<li class="dashboard-active-li "><a href="<?php echo $base_url; ?>super_admin/dashboard"><i class="fa fa-dashboard text-aqua"></i> <span><?= $this->lang->line('dashboard'); ?></span></a></li>

			<li class="dashboard-active-li "><a href="<?php echo $base_url; ?>super_admin/stores"><i class="fa fa-user-plus text-aqua"></i> <span><?= $this->lang->line('store'); ?></span></a></li>
			<li class="users-view-active-li users-active-li roles-list-active-li role-active-li treeview animate__animated animate__slideInUp">
				<a href="#">
					<i class="fa fa-user-plus text-aqua"></i> <span>Trial Pack</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu" style="display: none;">
					<li class="country-list-active-li "><a href="<?php echo $base_url; ?>super_admin/trial_pack_category"><i class="fa fa-list "></i> <span>Trial Pack Category</span></a></li>
					<li class="country-list-active-li "><a href="<?php echo $base_url; ?>super_admin/trial_package"><i class="fa fa-list "></i> <span>Trial Package</span></a></li>
				</ul>
			</li>

			<li class="dashboard-active-li "><a href="<?php echo $base_url; ?>super_admin/subscription"><i class="fa fa-user-plus text-aqua"></i> <span><?= $this->lang->line('subscription'); ?></span></a></li>
			<!-- Users -->
			<li class="coupon-active-li treeview">
				<a href="#">
					<i class=" fa fa-tags text-aqua"></i> <span><?= $this->lang->line('coupons'); ?><span class="">
							<small class="label bg-green">new</small>
						</span></span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">

					<li class="createCoupon-active-li"><a href="<?php echo $base_url; ?>super_admin_coupon/generate"><i class="fa fa-plus-square-o "></i> <span><?= $this->lang->line('createCustomerCoupon'); ?></span></a></li>



					<li class="customerCouponsList-active-li"><a href="<?php echo $base_url; ?>super_admin_coupon"><i class="fa fa-list "></i> <span><?= $this->lang->line('customerCouponsList'); ?></span></a></li>



					<li class="createDiscountCoupon-active-li"><a href="<?php echo $base_url; ?>super_admin_discount_coupon/add"><i class="fa fa-plus-square-o "></i> <span><?= $this->lang->line('createCoupon'); ?></span></a></li>



					<li class="discountCoupon-active-li"><a href="<?php echo $base_url; ?>super_admin_discount_coupon/view"><i class="fa fa-list "></i> <span><?= $this->lang->line('couponsMaster'); ?></span></a></li>


				</ul>
			</li>
			<li class="users-view-active-li users-active-li roles-list-active-li role-active-li treeview animate__animated animate__slideInUp">
				<a href="#">
					<i class="fa fa-user-plus text-aqua"></i> <span>Reports</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu" style="display: none;">
					<li class="country-list-active-li "><a href="<?php echo $base_url; ?>super_admin/newly_created_pos_report"><i class="fa fa-list "></i> <span>New Pos</span></a></li>
					<li class="country-list-active-li "><a href="<?php echo $base_url; ?>super_admin/expiring_pos_report"><i class="fa fa-list "></i> <span>Expiring Pos</span></a></li>
				</ul>
			</li>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>
