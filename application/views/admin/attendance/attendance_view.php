<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class='active'>Attendance</li>           
    </ol>
    <div class="container-fluid">
		<div class="panel panel-info">
			<div class="panel-heading">
			    <div class="row">
			    	<form action="<?php echo base_url();?>payroll/attendance" method="post">
					<div class="col-sm-2">
			    		<div class="row">
							<label for="cboMonth" class="control-label col-sm-2">Month: </label>
							<div class="col-sm-2 error"><?php echo form_error('cboMonth') ?></div>
						</div>
						<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
							<select name="cboMonth" class="form-control">
								<?php foreach($months as $month){ ?>
									<option value="<?php echo $month['id'] ?>"<?php if(isset($post['cboMonth']) and $post['cboMonth']==$month['id']) echo " selected='selected'"; ?>><?php echo $month['value']?></option>
								<?php } ?>
							</select>
						</div>
			    	</div>
			    	<div class="col-sm-2">
			    		<div class="row">
							<label for="cboYear" class="control-label col-sm-2">Year: </label>
							<div class="col-sm-2 error"><?php echo form_error('cboYear') ?></div>
						</div>
						<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
							<select name="cboYear" class="form-control">
								<?php foreach($years as $year){ ?>
									<option value="<?php echo $year ?>"<?php if(isset($post['cboYear']) and $post['cboYear']==$year) echo " selected='selected'"; ?>><?php echo $year?></option>
								<?php } ?>
							</select>
						</div>
			    	</div>
					<div class="col-sm-6">
						<?php if ($this->session->userdata('user_level') == 'Administrator' or $this->session->userdata('user_level') == 'Accounting Manager') { ?>
			    		<div class="row">
							<label for="cboEmployee" class="control-label col-sm-6">Employee: </label>
							<div class="col-sm-6 error"><?php echo form_error('cboEmployee') ?></div>
						</div>
						<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
							<select name="cboEmployee" class="form-control">
								<?php print_r($employees);
								foreach($employees as $employee){ ?>
									<option value="<?php echo $employee->emp_id ?>"<?php if(isset($post['cboEmployee']) and $post['cboEmployee']==$employee->emp_id) echo " selected='selected'"; ?>><?php echo $employee->first_name . " " . $employee->last_name ?></option>
								<?php } ?>
							</select>
						</div>
						<?php } else {  ?>
							<input type="hidden" name="cboEmployee" value="<?php echo $this->session->userdata('employee_id'); ?>"/>
						<?php } ?>
			    	</div>
					<div class="col-sm-2">
						<div class="signupButtons text-center">
							<input type="submit" class="btn btn-success btn-lg" name="btnSubmit" value="View">
						</div>
					</div>
			    	</form>
			    </div>		    
			</div>
			<div class="panel-body">
				<table id="dynamicTable" class="table table-striped table-hover table-bordered table-condensed ">				
					<thead >
						<th class="col-md-2 text-center">Date</th>
						<th class="col-md-2 text-center">Day</th>
						<th class="col-md-2 text-center">Time In</th>
						<th class="col-md-2 text-center">Time Out</th>
						<th class="col-md-2 text-center">Remarks</th>
						<th class="col-md-2 text-center">Action</th>
					</thead>
					<?php foreach($attendance as $day){	?>
					<tr>
						<td class="col-md-2 text-center"><?php echo $day->datelog?></td>
						<td class="col-md-2 text-center"><?php echo $day->weekday?></td>
						<td class="col-md-2 text-center"><?php echo $day->time_in?></td>
						<td class="col-md-2 text-center"><?php echo $day->time_out?></td>
						<td class="col-md-2 text-center">&nbsp;</td>
						<td class="col-md-2 text-center">
							<!--input type="button" class="btn btn-sm" name="btnLeave" value="Leave"></td-->
							<a href="<?php echo base_url();?>payroll/requestentry?date=<?php echo $day->datevalue; ?>&empid=<?php echo $post['cboEmployee']; ?>">
							<button class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Request Entry">
								<i class="fa fa-plus"></i>
							</button>
							</a>
							<?php /*if($day["time_in"]!=""){ ?>
								<a href="<?php echo base_url();?>attendance/edit?empid=<?php echo $day['emp_id'] . "&date=" . $day["datevalue"]; ?>">
								<button class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Edit Record">
									<i class="fa fa-pencil"></i>
								</button>
								</a>
								<button class="btn btn-danger btn-xs" onclick=deleteAttendance(<?php echo $day['emp_id']; ?>,'<?php echo $day['datevalue']; ?>','<?php echo base_url();?>'); data-toggle="tooltip" data-placement="top" title="Delete Record">
									<i class="fa fa-trash-o"></i>
								</button>
							<?php }else{ ?>
								<button class="btn btn-default btn-xs disabled" data-toggle="tooltip" data-placement="top" title="Edit Record">
									<i class="fa fa-pencil"></i>
								</button>
								<button class="btn btn-default btn-xs disabled" data-toggle="tooltip" data-placement="top" title="Delete Record">
									<i class="fa fa-trash-o"></i>
								</button>
							<?php }*/ ?>
						</td>
					</tr>
					<?php } ?>
				</table>	
			</div>	
		</div>
	</div>
</div>
