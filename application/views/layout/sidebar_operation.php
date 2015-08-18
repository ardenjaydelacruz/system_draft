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
