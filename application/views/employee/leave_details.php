<div class="content-wrapper">
	<ol class="breadcrumb">
	    <li><a href="<?php echo base_url();?>employee/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url();?>employee/leaves_table" class="btn btn-default"><i class="fa fa-calendar"></i> Leaves</a></li>
        <li class="active">View Leave Details</li>
    </ol>
    <div class="container-fluid">
    	<div class="panel panel-info">
		<div class="panel-heading">
		    <h6 class="panel-title big">Leave Details</h6>
		</div>
		<div class="panel-body">
			<div class="panel panel-default">
				<div class="panel-body">
					<h1 class="page-header"><b><?php echo $row->name; ?></b></h1>
					<div class="row">
						<div class="col-sm-12">
						
							<div class="col-sm-5">
								<div class="form-horizontal">
									<div class="form-group">
									    <label class=" col-sm-6 control-label">Leave ID:</label>
									    <div class="col-sm-6">						    		
									    	<input type="text" class="form-control input-sm" name="leaveID" disabled required value="<?php echo $row->leave_request_id; ?>">
									    </div>
									</div>
									<div class="form-group">
									    <label class=" col-sm-6 control-label">Leave Starts</label>
									    <div class="col-sm-6">
									    	<input type="text" class="form-control input-sm" name="leaveStarts" disabled required value="<?php echo date_format($row->leave_start,'m-d-y'); ?>">
									    </div>
									</div>
									<div class="form-group">
									    <label class=" col-sm-6 control-label">Leave Ends</label>
									    <div class="col-sm-6">
									    	<input type="text" class="form-control input-sm" name="leaveEnds"  disabled required value="<?php echo date_format($row->leave_end,'m-d-y'); ?>">
									    </div>
									</div>
									<div class="form-group">
									    <label class=" col-sm-6 control-label">Number of Days</label>
									    <div class="col-sm-6">
									    	<input type="text" class="form-control input-sm" name="leaveEnds" disabled required value="<?php echo $row->num_days; ?>">
									    </div>
									</div>
									<div class="form-group">
									    <label class=" col-sm-6 control-label">Leaves Left (Before Requesting)</label>
									    <div class="col-sm-6">						    		
									    	<input type="text" class="form-control input-sm" name="leaveStarts" disabled required value="<?php echo $row->leave_left; ?>">
									    </div>
									</div>
									<div class="form-group">
									    <label class=" col-sm-6 control-label">Type of leave</label>
									     <div class="col-sm-6">						    		
									    	<input type="text" class="form-control input-sm" name="leaveStarts" disabled required value="<?php echo $row->leave_type; ?>">
									    </div>
									</div>
								</div>
							</div> <!-- 6 -->

							<div class="col-sm-7">
								<div class="form-horizontal">
									<div class="form-group">
									    <label class=" col-sm-6 control-label">Reason</label>
									    <div class="col-sm-6">						    		
											<textarea name="txtReason" class="form-control" cols="30" rows="3" disabled><?php echo $row->leave_reason; ?></textarea>
									    </div>
									</div>
									<div class="form-group">
									    <label class=" col-sm-6 control-label">Status</label>
									    <div class="col-sm-6">						    		
									    	<input type="text" class="form-control input-sm" name="leaveStarts" disabled required value="<?php echo $row->leave_status; ?>">
									    </div>
									</div>
									<div class="form-group">
									    <label class=" col-sm-6 control-label">Checked By</label>
									    <div class="col-sm-6">						    		
									    	<input type="text" class="form-control input-sm" name="leaveStarts" disabled required value="<?php echo $row->approved_by; ?>">
									    </div>
									</div>
									<div class="form-group">
									    <label class=" col-sm-6 control-label">Date Approved</label>
									    <div class="col-sm-6">						    		
									    	<input type="text" class="form-control input-sm" name="leaveStarts" disabled required value="<?php echo date_format($row->date_approved,'m-d-y'); ?>">
									    </div>
									</div>
									<div class="form-group">
									    <label class=" col-sm-6 control-label">Date Requested</label>
									    <div class="col-sm-6">						    		
									    	<input type="text" class="form-control input-sm" name="leaveStarts" disabled required value="<?php echo date_format($row->date_requested,'m-d-y'); ?>">
									    </div>
									</div>
								</div>
							</div> <!-- 6 -->
						</div> <!-- 12 -->
					</div> <!-- row -->
				</div>
			</div>

			<div class="signupButtons">
				<center>
					<a href="<?php echo base_url();?>ems/leaves_table">
						<button class="btn btn-info">
							<i class="fa fa-arrow-left"> </i> Back to Leave Table
						</button>
					</a>
				</center>
			</div>
		<?php echo form_close(); ?>
		</div>	<!-- Main Panel Body-->
	</div> <!-- End of Main Panel -->	
    </div>
	
</div> <!-- End of Wrapper -->