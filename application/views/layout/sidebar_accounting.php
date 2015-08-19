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
					<li><a href="<?php echo base_url();?>payroll/requestentry_table"><i class="fa fa-circle-o"></i> Request Entry</a></li>
					<li><a href="<?php echo base_url();?>payroll/payroll_index"><i class="fa fa-circle-o"></i> Payroll</a></li>
					<li><a href="<?php echo base_url();?>payroll/allowances"><i class="fa fa-circle-o"></i> Allowances</a></li>
					<li><a href="<?php echo base_url();?>payroll/taxes"><i class="fa fa-circle-o"></i> Taxes</a></li>
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
				</ul>
			</li>
		</ul>
	</section>
</aside>
