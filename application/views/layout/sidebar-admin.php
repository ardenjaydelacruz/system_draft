<aside class="main-sidebar  height">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar collapsed-sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="text-center image">
				<img src="<?php echo base_url().'assets/images/profile/'.$this->session->userdata('image'); ?>" class="img-circle" alt="User Image" />
			</div>
			<div class="pull-right info">
				<p class="text-center">
					<?php echo $this->session->userdata('user_level'); ?>
				</p>
				<p class="text-center">
					<?php echo $this->session->userdata('first_name'); ?>
				</p>
			</div>
		</div>

		<ul class="sidebar-menu">
			<br>
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
					<li><a href="<?php echo base_url();?>ems/view_projects"><i class="fa fa-cogs"></i> Projects</a></li>
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
					<li><a href="<?php echo base_url();?>attendance/index"><i class="fa fa-circle-o"></i> Attendance</a></li>
					<li><a href="<?php echo base_url();?>attendance/requestentry_table"><i class="fa fa-circle-o"></i> Request Entry</a></li>
					<li><a href="<?php echo base_url();?>attendance/payroll"><i class="fa fa-circle-o"></i> Payroll</a></li>
					<li><a href="<?php echo base_url();?>attendance/allowances"><i class="fa fa-circle-o"></i> Allowances</a></li>
					<li><a href="<?php echo base_url();?>attendance/taxes"><i class="fa fa-circle-o"></i> Taxes</a></li>
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
					<li class="treeview">
						<a href="#">
							<span>Employee Management</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url();?>reports/employees_list"><i class="fa fa-group"></i> Employees Lists</a></li>
							<li><a href="<?php echo base_url();?>reports/projects_list"><i class="fa fa-cogs"></i> Projects</a></li>
							<li><a href="<?php echo base_url();?>ams/view_all_materials"><i class="fa fa-credit-card"></i> Bill of Materials</a></li>
							<li><a href="<?php echo base_url();?>ams/view_projects"><i class="fa fa-cogs"></i> Projects</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<span>Payroll Management</span>
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
				</ul>
			</li>
		</ul>
	</section>
</aside>
