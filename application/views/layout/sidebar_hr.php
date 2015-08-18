<aside class="main-sidebar  height">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar collapsed-sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="text-center image">
				<img src="<?php echo base_url().'assets/images/profile/'.$this->session->userdata('profile_image'); ?>" class="img-circle" alt="User Image" />
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
			<li class="header text-center">HR Manager Menu</li>
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
					<li><a href="<?php echo base_url();?>payroll/attendance"><i class="fa fa-circle-o"></i> Attendance</a></li>
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
							<li><a href="<?php echo base_url();?>reports/project_workers"><i class="fa fa-user"></i> Project Workers</a></li>
							<li><a href="<?php echo base_url();?>reports/projects_list"><i class="fa fa-cogs"></i> Projects</a></li>
							<li><a href="<?php echo base_url();?>reports/leave_list"><i class="fa fa-calendar"></i> Leave List</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<span>Payroll Management</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url();?>reports/attendance_daily"><i class="fa fa-calendar"></i> Attendance - Daily</a></li>
							<li><a href="<?php echo base_url();?>reports/attendance_employee"><i class="fa fa-calendar-o"></i> Attendance - Employee</a></li>
							<li><a href="<?php echo base_url();?>reports/payslip_list"><i class="fa fa-rub"></i> Payslip</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<span>Asset Management</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url();?>reports/inventory_list"><i class="fa fa-cube"></i> Inventory List</a></li>
							<li><a href="<?php echo base_url();?>reports/asset_list"><i class="fa fa-desktop"></i> Other Assets</a></li>
							<li><a href="<?php echo base_url();?>reports/material_list"><i class="fa fa-credit-card"></i> Bill of Materials</a></li>
						</ul>
					</li>
				</ul>
			</li>
		</ul>
	</section>
</aside>
