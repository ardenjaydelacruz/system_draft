<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ems/hr_dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class='active'>Attendance - Employee</li>           
    </ol>
    <div class="container-fluid">
		<div class="panel panel-info">
			<div class="panel-heading">
                <div class="row">
                    <div class="col-sm-8">
                        <h1 class="panel-title big">Employee Attendance</h1>
                    </div>
                </div>
            </div>
            <div class="panel-body">
			<form action="<?php echo base_url();?>reports/attendance_employee" role="form" method="post">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-header pull-left">
                            <h4>Filter By:</h4>
                        </div>
                        <div class="pull-right">
                            <input type="submit" name="btnFilter" value="Filter" class="btn btn-success btn-lg">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
					<div class="form-group">
						<label for="status">Employee: </label>
						<select name="cboEmployee" class="form-control">
							<?php print_r($employees);
							foreach($employees as $employee){ ?>
								<option value="<?php echo $employee->emp_id ?>"<?php if(set_value('cboEmployee')==$employee->emp_id) echo " selected='selected'"; ?>><?php echo $employee->first_name . " " . $employee->last_name ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						<label for="cboMonth">Month: </label>
						<select name="cboMonth" class="form-control">
							<?php foreach($months as $month){ ?>
								<option value="<?php echo $month['id'] ?>"<?php if(set_value('cboMonth')==$month['id']) echo " selected='selected'"; ?>><?php echo $month['value']?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						<label for="cboYear">Year: </label>
						<select name="cboYear" class="form-control">
							<?php foreach($years as $year){ ?>
								<option value="<?php echo $year ?>"<?php if(set_value('cboYear')==$year) echo " selected='selected'"; ?>><?php echo $year?></option>
							<?php } ?>
						</select>
					</div>
				</div><br>
					<?php if ($this->input->post('btnFilter')) { ?>
					<div class="row">
						<div class="col-sm-12">
							<input type="submit" name="btnPrint" value="Print" class="btn btn-info">
						</div>
					</div><br>
					<?php } ?>
                </form>
				<?php if ($this->input->post('btnFilter')) { ?>
				<table class="table table-striped table-hover table-bordered table-condensed ">				
					<thead >
						<th class="col-md-1 text-center">Date</th>
						<th class="col-md-1 text-center">Day</th>
						<th class="col-md-1 text-center">Time In</th>
						<th class="col-md-1 text-center">Time Out</th>
						<th class="col-md-2 text-center">Remarks</th>
						<th class="col-md-1 text-center">Man Hours</th>
						<th class="col-md-1 text-center">Tardiness</th>
						<th class="col-md-1 text-center">Overtime</th>
					</thead>
					<?php foreach($attendance as $row){	?>
					<tr>
						<td class="col-md-1 text-center"><?php echo $row->datelog?></td>
						<td class="col-md-1 text-center"><?php echo $row->weekday?></td>
						<td class="col-md-1 text-center"><?php echo $row->time_in?></td>
						<td class="col-md-1 text-center"><?php echo $row->time_out?></td>
						<td class="col-md-2 text-center">&nbsp;</td>
						<td class="col-md-1 text-center"><?php if($row->man_hours!=0) echo number_format($row->man_hours, 2, ".", ","); ?>&nbsp;</td>
						<td class="col-md-1 text-center"><?php if($row->tardiness!=0) echo number_format($row->tardiness, 2, ".", ","); ?>&nbsp;</td>
						<td class="col-md-1 text-center"><?php if($row->overtime!=0) echo number_format($row->overtime, 2, ".", ","); ?>&nbsp;</td>
					</tr>
					<?php } ?>
				</table>	
				<?php } ?>
			</div>	
		</div>
	</div>
</div>
