<div class="content-wrapper">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url();?>ams/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url();?>ems/view_projects" class="btn btn-default"><i class="fa fa-cogs"></i> Projects </a></li>
		<li class="active"><i class="fa fa-group"></i> Project Personnel </li>
	</ol>
	<div class="container-fluid">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title big">Add Project Personnel</h3>
			</div>
			<div class="panel-body">
				<label>
					<small>Fields with * asterisk are required.</small>
				</label>
				<?php echo form_open('ems/add_personnel'); ?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Material Information</h3>
					</div>
					<div class="panel-body">
						<div class="form-horizontal">
							<div class="form-group">
								<label class=" col-sm-3 control-label">Project: * </label>
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
                                <label class=" col-sm-3 control-label">Employee Name: * </label>
                                <div class="col-sm-4">
                                    <select name="txtEmployee" class="form-control">
                                        <option value="" selected>---</option>
                                        <?php
                                        foreach($employee as $row){
                                            echo "<option value='$row->emp_id'>$row->emp_id - $row->first_name $row->last_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-5 error">
                                    <?php echo form_error('txtEmployee'); ?>
                                </div>
                            </div>
							<div class="form-group">
								<label class=" col-sm-3 control-label">Assign Date: * </label>
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
