<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class='active'>Attendance - Daily</li>           
    </ol>
    <div class="container-fluid">
		<div class="panel panel-info">
			<div class="panel-heading">
                <div class="row">
                    <div class="col-sm-8">
                        <h1 class="panel-title big">Daily Attendance</h1>
                    </div>
                </div>
            </div>
            <div class="panel-body">
				<form action="<?php echo base_url();?>reports/attendance_daily" role="form" method="post">
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
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="status">Date:</label>
                            <input type="date" class="form-control input-sm" name="txtDate" value="<?php echo set_value('txtDate'); ?>">
                        </div>
                    </div>
                </div><br>
					<?php if ($this->input->post('btnFilter')) { ?>
					<div class="form-group">
						<input type="submit" name="btnPrint" value="Print" class="btn btn-info"><br>
					</div><br>
					<?php } ?>
                </form>
				<?php if ($this->input->post('btnFilter')) { $ctr=1; ?>
				<table class="table table-striped table-hover table-bordered table-condensed ">
					<thead >
						<th class="text-center">#</th>
						<th class="col-md-1 text-center">EmpID</th>
						<th class="col-md-3 text-center">Employee</th>
						<th class="col-md-3 text-center">Position</th>
						<th class="col-md-1 text-center">Time In</th>
						<th class="col-md-1 text-center">Time Out</th>
						<th class="col-md-1 text-center">Man Hours</th>
						<th class="col-md-1 text-center">Tardiness</th>
						<th class="col-md-1 text-center">Overtime</th>
					</thead>
					<?php foreach($attendance as $row){	?>
					<tr>
						<td class="text-center"><?php echo $ctr;?></td>
						<td class="col-md-1 text-center"><?php echo $row->emp_id;?></td>
						<td class="col-md-3 text-left"><?php echo $row->last_name . ", " . $row->first_name . " " . $row->middle_name; ?></td>
						<td class="col-md-3 text-left"><?php echo $row->job_title_name; ?></td>
						<td class="col-md-1 text-center"><?php echo $row->time_in; ?></td>
						<td class="col-md-1 text-center"><?php echo $row->time_out; ?></td>
						<td class="col-md-1 text-center"><?php echo number_format($row->man_hours, 2, ".", ","); ?></td>
						<td class="col-md-1 text-center"><?php echo number_format($row->tardiness, 2, ".", ","); ?></td>
						<td class="col-md-1 text-center"><?php echo number_format($row->overtime, 2, ".", ","); ?></td>
					</tr>
					<?php $ctr++; } ?>
				</table>	
				<?php } ?>
			</div>	
		</div>
	</div>
</div>
