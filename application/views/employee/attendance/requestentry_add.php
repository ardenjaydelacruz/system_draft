<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ems/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url();?>payroll/attendance" class="btn btn-default"><i class="fa fa-dashboard"></i> Attendance</a></li>
		<li class='active'>Request Entry</li>           
    </ol>
    <div class="container-fluid">
		<div class="panel panel-info">
			<div class="panel-heading">
                <h3 class="panel-title big">Request Entry</h3>
            </div>
            <div class="panel-body">
                <label>
                    <small>Fields with * asterisk are required.</small>
                </label>
                <form action="<?php echo base_url();?>payroll/requestentry" method="post">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Request Entry Details</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-horizontal">
                            <div class="form-group">
								<input type="hidden" name="txtEmpID" value="<?php echo $empID;?>"/>
                                <label class=" col-sm-3 control-label">Date: * </label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control input-sm" name="txtDate"<?php if(isset($date)) echo ' value="' . $date . '"';?>>
                                </div>
                                <div class="col-sm-5 error">
                                    <?php echo form_error('txtTaxType'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Time In: * </label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control input-sm" name="txtTimeIn" value="08:00:00"/>
                                </div>
                                <div class="col-sm-5 error">
                                    <?php echo form_error('txtAmount'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Time Out: * </label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control input-sm" name="txtTimeOut" value="17:00:00"/>
                                </div>
                                <div class="col-sm-5 error">
                                    <?php echo form_error('txtPercentage'); ?>
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
		</div>
	</div>
</div>