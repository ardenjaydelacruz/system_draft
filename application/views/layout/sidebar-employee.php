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
					<i class="fa fa-dashboard"></i> <span>Emp Dashboard</span>
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
				<a href="<?php echo base_url();?>ems/evaluate_performance">
					<i class="fa fa-star"></i> <span>Evaluate Performance</span>
				</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>payroll/attendance">
					<i class="fa fa-clock-o"></i> <span>Attendance</span>
				</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>payroll/payroll_index">
					<i class="fa fa-money"></i> <span>View Payslip</span>
				</a>
			</li>
			<li>
				<a href="#" data-target="#requestAsset" data-toggle="modal">
					<i class="fa fa-desktop"></i> <span>Request Asset</span>
				</a>
			</li>
		</ul>
	</section>
</aside>
<form action="<?php echo base_url();?>ams/request_asset" method="post">
  <div class="modal fade" id="requestAsset" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Request Supplies / Equipments</h4>
        </div>
        <div class="modal-body">
          <label for="">Equipment / Supply Name:</label>
          <input type="text" class="form-control" name="txtAssetName" required><br>
          <label for="">Quantity:</label>
          <input type="text" class="form-control" name="txtQuantity" required><br>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="Add" name="btnAddRequest">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</form>

