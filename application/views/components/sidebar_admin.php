<aside class="main-sidebar height">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="text-center image">
				<img src="<?php echo base_url().'assets/images/profile/'.$profile_image; ?>" class="img-circle" alt="User Image" />
			</div>
			<div class="pull-right info">
				<p class="text-center">
					<?php echo $user_level; ?>
				</p>
				<p class="text-center">
					<?php echo $firstname; ?>
				</p>
			</div>
		</div>

		<ul class="sidebar-menu">
			<li class="header text-center">Administrator Menu</li>
			<li>
				<a href="<?php echo base_url();?>ems/dashboard">
					<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>

			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-group"></i>
					<span>Employee Management</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url();?>ems/employees"><i class="fa fa-user"></i> Employees</a></li>
					<li><a href="<?php echo base_url();?>ems/leaves_table"><i class="fa fa-calendar-o"></i> Leaves</a></li>
					<li><a href="<?php echo base_url();?>ems/view_performance"><i class="fa fa-thumbs-o-up"></i> Performance </a></li>
					<li><a href="<?php echo base_url();?>ems/promotion"><i class="fa fa-star"></i> Promotions </a></li>
					<li><a href="<?php echo base_url();?>ems/view_accounts"><i class="fa fa-list"></i> User Accounts</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="#">
					<i class="fa fa-money"></i>
					<span>Payroll Management</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
					<li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
					<li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
					<li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="#">
					<i class="fa fa-cubes"></i>
					<span>Asset Management</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url();?>ams/view_inventory"><i class="fa fa-cube"></i> Inventory</a></li>
					<li><a href="<?php echo base_url();?>ams/view_assets"><i class="fa fa-desktop"></i> Other Assets</a></li>
					<li><a href="<?php echo base_url();?>ams/view_all_materials"><i class="fa fa-credit-card"></i> Bill of Materials</a></li>
					<li><a href="<?php echo base_url();?>ams/view_projects"><i class="fa fa-cogs"></i> Projects</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="#">
					<i class="fa fa-files-o"></i>
					<span>Reports</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
					<li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
					<li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
					<li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
				</ul>
			</li>
		</ul>
	</section>
</aside>
