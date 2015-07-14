<script>
$(function() {
   $("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
   $('.timepicker').timepicker();
});
</script>

<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url();?>attendance/index" class="btn btn-default"><i class="fa fa-dashboard"></i> Attendance</a></li>
		<li class='active'>Request Entry</li>           
    </ol>
    <div class="container-fluid">
		<div class="panel panel-info">
			<div class="panel-heading">
			    <div class="row">
			    	<form action="<?php echo base_url();?>attendance/requestentry" method="post">
					<div class="form-group"><label class="col-sm-6 control-label">Date</label>
							<div class="col-sm-6 controls">
								<div class="row">
									<div class="col-xs-6">
										<input type="hidden" name="txtEmpID" value="<?php echo $empID;?>"/>
										<input type="text" id="datepicker" name="txtDate"<?php if(isset($date)) echo ' value="' . $date . '"';?>/>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group"><label class="col-sm-6 control-label">Time In</label>
							<div class="col-sm-6 controls">
								<div class="row">
									<div class="col-xs-6">
										<input type="text" class="timepicker" name="txtTimeIn"/>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group"><label class="col-sm-6 control-label">Time Out</label>
							<div class="col-sm-6 controls">
								<div class="row">
									<div class="col-xs-6">
										<input type="text" class="timepicker" name="txtTimeOut"/>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="signupButtons">
								<center>
									<input type="submit" class="btn btn-success btn-sm" name="btnSubmit" value="Submit">
								</center>
							</div>
						</div>
			    	</form>
			    </div>		    
			</div>
		</div>
	</div>
</div>