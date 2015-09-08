<?php 
	$id = $row->emp_id;
	$name = $row->first_name.' '.$row->last_name;
 ?>
<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ems/admin_dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Request Leave</li>
    </ol>
    <div class="container-fluid">
    	<div class="box box-info box-solid">
		<div class="box-header with-border">
		    <h3 class="box-title big">Request Leave</h3>
		</div>
		<div class="box-body">
			<div class="box box-default box-solid">
				<div class="box-body">
					<?php echo form_open('ems/request_leave?emp_id='.$id); ?>
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
						    	<input type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd" required class="form-control input-sm leaveDate"  required name="leaveStarts">
						    </div>
						</div>
						<div class="form-group">
						    <label class=" col-sm-3 control-label">Leave Ends</label>
						    <div class="col-sm-3">
						    	<input type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd" required class="form-control input-sm leaveDate" required name="leaveEnds">
						    </div>
						</div>
						<div class="form-group">
						    <label class=" col-sm-3 control-label">Type of leave</label>
						    <div class="col-sm-3">
						    	<select name="txtLeaveType" id="stocks" class="form-control" required>
		                        <option value="">Leave Type</option>
		                        <?php foreach ($leave_type as $row){ 
		                            echo "<option value='$row->leave_type_id'>$row->leave_type_name</option>";
		                        } ?>
		                    </select>
						    </div>
						</div>
						<div class="form-group">
						    <label class=" col-sm-3 control-label">Reason</label>
						    <div class="col-sm-3">
						    	<textarea name="txtReason" cols="30" rows="5" class="form-control" required></textarea>
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

