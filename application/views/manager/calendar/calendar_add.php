<div class="content-wrapper">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ems/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url();?>calendar/calendar_index" class="btn btn-default"><i class="fa fa-user"></i> Calendar</a></li>
        <li class="active">Add Day Event</li>
    </ol>
    <div class="container-fluid">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title big">Add new Day Event</h3>
            </div>
            <div class="panel-body">
                <label>
                    <small>Fields with * asterisk are required.</small>
                </label>
                <?php echo form_open('calendar/event_add'); ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Event Information</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Day Name: * </label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control input-sm" name="txtDayName" value="<?php echo set_value('txtDayName'); ?>">
                                </div>
                                <div class="col-sm-5 error">
                                    <?php echo form_error('txtDayName'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Description: * </label>
                                <div class="col-sm-3">
                                    <textarea class="form-control input-sm" name="txtDescription"><?php echo set_value('txtDescription'); ?></textarea>
                                </div>
                                <div class="col-sm-5 error">
                                    <?php echo form_error('txtDescription'); ?>
                                </div>
                            </div>
							<div class="form-group">
								<label class=" col-sm-3 control-label">Date: * </label>
								<div class="col-sm-3">
									<input type="date" class="form-control input-sm" name="txtDate" value="<?php echo set_value('txtDate'); ?>">
								</div>
								<div class="col-sm-5 error">
                                    <?php echo form_error('txtDate'); ?>
                                </div>
							</div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Event Type: * </label>
                                <div class="col-sm-3">
                                    <select name="cboEventType" class="form-control">
										<?php foreach($day_type as $row){ ?>
										<option value="<?php echo $row->day_type_id;?>"><?php echo $row->day_type_name;?></option>
										<?php } ?>
									</select>
                                </div>
                                <div class="col-sm-5 error">
                                    <?php echo form_error('cboEventType'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Allow Absence: </label>
                                <div class="col-sm-3">
                                    <input type="checkbox" name="chkAllowAbsence" checked>
                                </div>
                                <div class="col-sm-5 error">
                                    &nbsp;
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
