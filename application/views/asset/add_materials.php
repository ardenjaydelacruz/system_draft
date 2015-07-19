<div class="content-wrapper">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url();?>ems/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url();?>ams/view_projects" class="btn btn-default"><i class="fa fa-user"></i> Projects</a></li>
		<li class="active">Add Materials</li>
	</ol>
	<div class="container-fluid">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title big">Add Materials</h3>
			</div>
			<div class="panel-body">
				<label>
					<small>Fields with * asterisk are required.</small>
				</label>
				<?php echo form_open('ams/add_materials'); ?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Material Information</h3>
					</div>
					<div class="panel-body">
						<div class="form-horizontal">
							<div class="form-group">
								<label class=" col-sm-3 control-label">Item ID: * </label>
								<div class="col-sm-3">
									<select name="txtItemID" class="form-control">
										<option value="" selected>---</option>
										<?php
										foreach($record as $row){
											echo "<option value='$row->item_id'>$row->item_id - $row->item_name</option>";
										}
										?>
									</select>
								</div>
								<div class="col-sm-5 error">
									<?php echo form_error('txtItemID'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class=" col-sm-3 control-label">Quantity: * </label>
								<div class="col-sm-3">
									<input type="text" class="form-control input-sm" name="txtQuantity">
								</div>
								<div class="col-sm-5 error">
									<?php echo form_error('txtQuantity'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class=" col-sm-3 control-label">Project ID: * </label>
								<div class="col-sm-3">
									<select name="txtProjectID" class="form-control">
										<option value="" selected>---</option>
										<?php
										foreach($project as $row){
											echo "<option value='$row->project_id'>$row->project_id - $row->project_name</option>";
										}
										?>
									</select>
								</div>
								<div class="col-sm-5 error">
									<?php echo form_error('txtProjectID'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class=" col-sm-3 control-label">Date Issued: * </label>
								<div class="col-sm-3">
									<input type="date" class="form-control input-sm" name="txtDateIssued">
								</div>
								<div class="col-sm-5 error">
									<?php echo form_error('txtDateIssued'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="signupButtons">
					<center>
						<input type="submit" class="btn btn-success" name="btnSubmit" value="Submit">
						<input type="reset" class="btn btn-danger" value="Clear">
					</center>
				</div>
				<?php echo form_close(); ?>
			</div>
			<!-- Main Panel Body-->
		</div>
		<!-- End of Main Panel -->
	</div>
</div>
<!-- End of Wrapper -->
