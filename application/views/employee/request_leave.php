<?php 
	$id = $row->emp_id;
	$name = $row->first_name.' '.$row->last_name;
	$leaves = $row->leaves;
 ?>
<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>employee/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Request Leave</li>
    </ol>
    <div class="container-fluid">
    	<div class="panel panel-info">
		<div class="panel-heading">
		    <h3 class="panel-title big">Request Leave</h3>
		</div>
		<div class="panel-body">
			<div class="panel panel-default">
				<div class="panel-body">
					<?php echo form_open('ems/process_leave?emp_id='.$id.'&emp_name='.$name.'&leaves='.$leaves); ?>
					<div class="form-horizontal">
						<div class="form-group">
						    <label class=" col-sm-3 control-label">Employee Name</label>
						    <div class="col-sm-3">						    		
						    	<input type="text" class="form-control input-sm" name="leaveStarts" disabled value="<?php echo $name; ?>">	
						    </div>
						</div>
						<div class="form-group">
						    <label class=" col-sm-3 control-label">Leave Starts</label>
						    <div class="col-sm-3">
						    	<input type="date" class="form-control input-sm" placeholder="Employee ID" required name="leaveStarts">
						    </div>
						</div>
						<div class="form-group">
						    <label class=" col-sm-3 control-label">Leave Ends</label>
						    <div class="col-sm-3">
						    	<input type="date" class="form-control input-sm" placeholder="Position" required name="leaveEnds">
						    </div>
						</div>
						<div class="form-group">
						    <label class=" col-sm-3 control-label">Type of leave</label>
						    <div class="col-sm-3">
						    	<select class="form-control" name="type" required	>
						    		<option value="Sick Leave">Sick Leave</option>
						    		<option value="Maternity Leave">Maternity Leave Leave</option>
						    		<option value="Vacation Leave">Vacation Leave</option>
						    		<option value="Leave Without Pay">Leave Without Pay</option>
						    		<option value="Family Responsibility Leave ">Family Responsibility Leave </option>
						    	</select>
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
		</div>	<!-- Main Panel Body-->
	</div> <!-- End of Main Panel -->	
    </div>
	
</div> <!-- End of Wrapper -->

