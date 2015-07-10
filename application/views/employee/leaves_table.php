<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ems/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li><a href="<?php echo base_url();?>ems/employees" class="btn btn-default"><i class="fa fa-user"></i> Employee</a></li>
          <li class="active"><i class="fa fa-calendar"></i> Leave </li>
    </ol>
    <div class="container-fluid">
		<div class="panel panel-info">
			<div class="panel-heading">
			    <h1 class="panel-title big">Leaves Table</h1>
			</div>
			<div class="panel-body">
				<table class="table table-striped table-hover table-bordered centered">
					<thead >
						<th class="text-center">ID</th>
						<th class="text-center">Employee Name</th>
						<th class="text-center">Leave Date</th>
						<th class="text-center">Type of leave</th>
						<th class="text-center">Number of Days</th>
						<th class="text-center">Leave Days Remaining</th>
						<th class="text-center">Status</th>
						<th class="text-center">Manage</th>
					</thead>
					<?php
					foreach ($record as $row) {	
						?>
					<tr>
						<td class="text-center"><?php echo $row->leave_id; ?></td>
						<td><?php echo $row->employee_name;  ?></td>
						<td class="text-center"><?php echo $row->start_date.' to '.$row->end_date; ?></td>
						<td><?php echo $row->type; ?></td>
						<td class="text-center"><?php echo $row->days; ?></td>
						<td class="text-center"><?php echo $row->leaves_left; ?></td>
						<td align="center">
							<?php if (empty($row->status)){ ?>
							<a href="<?php echo base_url(); ?>ems/update_leave_status?leave_status=Approved&leave_id=<?php echo $row->leave_id;?>&days=<?php echo  $row->days;?>&emp_id=<?php echo $row->employee_id;?>&leaves=<?php echo $row->leaves_left; ?>">
								<button class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Approve Leave"><i class="fa fa-thumbs-up fa-lg"></i></button>
							</a>
							<a href="<?php echo base_url(); ?>ems/update_leave_status?leave_status=Declined&leave_id=<?php echo $row->leave_id;?>">
								<button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Decline Leave"><i class="fa fa-thumbs-down fa-lg"></i></button>
							</a>
							
							<?php } else {
									if ($row->status=='Approved'){
										echo "<label class='label label-success'>";
										echo $row->status;
										echo "</label>";
									} else {
										echo "<label class='label label-danger'>";
										echo $row->status;
										echo "</label>";
									}
								} ?>
							
						</td>
						<td align="center">
							<a href="<?php echo base_url();?>ems/view_leave_details?leave_id=<?php echo $row->leave_id; ?>">
								<button class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="View Leave"><i class="fa fa-search fa-lg"></i></button>
							</a>
							<!-- <button onclick=deleteLeave(<?php echo $row->leave_id; ?>,'<?php echo base_url();?>ems/'); class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
						 --></td>
					</tr>
					<?php } ?>
				</table>	
			</div>	
		</div>
	</div>
</div>