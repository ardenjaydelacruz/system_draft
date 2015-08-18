<aside class="main-sidebar  height">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar collapsed-sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="text-center image">
				<img src="<?php echo base_url().'assets/images/profile/'.$this->session->userdata('profile_image'); ?>" class="img-circle" alt="User Image" />
			</div>
			<div class="info text-center">
				<p class="">
					<?php echo $this->session->userdata('user_level'); ?>
				</p>
				<p class="">
					<?php echo $this->session->userdata('first_name'); ?>
				</p>
			</div>
		</div>

		<ul class="sidebar-menu">
			<br>
			<li class="header text-center">Administrator Menu</li>

			<li>
				<a href="<?php echo base_url();?>ems/emp_dashboard">
					<i class="fa fa-user"></i> <span>Dashboard</span>
				</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>ems/view_details?emp_id=<?php echo $this->session->userdata('employee_id'); ?>">
					<i class="fa fa-user"></i> <span>Profile</span>
				</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>ems/request_leave?emp_id=<?php echo $this->session->userdata('employee_id'); ?>">
					<i class="fa fa-calendar"></i> <span>Add Leave Request</span>
				</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>ems/dashboard">
					<i class="fa fa-money"></i> <span>View Payslip</span>
				</a>
			</li>
		</ul>
	</section>
</aside>
