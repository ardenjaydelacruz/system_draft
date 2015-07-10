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
		<?php foreach ($record as $row) {  ?>
		<div class="panel-body">
			<div class="panel panel-default">
				<div class="panel-body">
					<h1 class="page-header"><b><?php echo $row->employee_name; ?></b></h1>
					<div class="row">
						<div class="col-sm-12">
						
							<div class="col-sm-6">
								<div class="form-horizontal">
									<div class="form-group">
									    <label class=" col-sm-6 control-label">Leave ID:</label>
									    <div class="col-sm-6">						    		
									    	<input type="text" class="form-control input-sm" name="leaveID" disabled value="<?php echo $row->leave_id; ?>">	
									    </div>
									</div>
									<div class="form-group">
									    <label class=" col-sm-6 control-label">Leave Starts</label>
									    <div class="col-sm-6">
									    	<input type="date" class="form-control input-sm" placeholder="Employee ID" name="leaveStarts" disabled value="<?php echo $row->start_date; ?>">						
									    </div>
									</div>
									<div class="form-group">
									    <label class=" col-sm-6 control-label">Leave Ends</label>
									    <div class="col-sm-6">
									    	<input type="date" class="form-control input-sm" placeholder="Position" name="leaveEnds"  disabled value="<?php echo $row->end_date; ?>">
									    </div>
									</div>
									<div class="form-group">
									    <label class=" col-sm-6 control-label">Number of Days</label>
									    <div class="col-sm-6">
									    	<input type="text" class="form-control input-sm" placeholder="Position" name="leaveEnds" disabled value="<?php echo $row->days; ?>">
									    </div>
									</div>
									<div class="form-group">
									    <label class=" col-sm-6 control-label">Leaves Left (Before Requesting)</label>
									    <div class="col-sm-6">						    		
									    	<input type="text" class="form-control input-sm" name="leaveStarts" disabled value="<?php echo $row->leaves_left; ?>">	
									    </div>
									</div>
								</div>
							</div> <!-- 6 -->

							<div class="col-sm-6">
								<div class="form-horizontal">
									<div class="form-group">
									    <label class=" col-sm-6 control-label">Type of leave</label>
									     <div class="col-sm-6">						    		
									    	<input type="text" class="form-control input-sm" name="leaveStarts" disabled value="<?php echo $row->type; ?>">	
									    </div>
									</div>
									<div class="form-group">
									    <label class=" col-sm-6 control-label">Status</label>
									    <div class="col-sm-6">						    		
									    	<input type="text" class="form-control input-sm" name="leaveStarts" disabled value="<?php echo $row->status; ?>">	
									    </div>
									</div>
									<div class="form-group">
									    <label class=" col-sm-6 control-label">Approved By</label>
									    <div class="col-sm-6">						    		
									    	<input type="text" class="form-control input-sm" name="leaveStarts" disabled value="<?php echo $row->approved_by; ?>">	
									    </div>
									</div>
									<div class="form-group">
									    <label class=" col-sm-6 control-label">Date Approved</label>
									    <div class="col-sm-6">						    		
									    	<input type="text" class="form-control input-sm" name="leaveStarts" disabled value="<?php echo $row->date_approved; ?>">	
									    </div>
									</div>
									<div class="form-group">
									    <label class=" col-sm-6 control-label">Date Requested</label>
									    <div class="col-sm-6">						    		
									    	<input type="text" class="form-control input-sm" name="leaveStarts" disabled value="<?php echo $row->date_requested; ?>">	
									    </div>
									</div>
								</div>
							</div> <!-- 6 -->
							<?php } ?>
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