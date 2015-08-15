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
				<?php 



				 ?>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url();?>ems/view_details?emp_id=<?php echo $this->session->userdata('emp_id'); ?>"><i class="fa fa-user"></i> Employees</a></li>
				</ul>
			</li>
		</ul>
	</section>
</aside>
