
<div class="content-wrapper">
	<ol class="breadcrumb">
    <li><a href="<?php echo base_url();?>ems/admin_dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="<?php echo base_url();?>ems/employees" class="btn btn-default"><i class="fa fa-user"></i> Employee</a></li>
    <li class="active"><i class="fa fa-calendar"></i> Leave Credits History </li>
  </ol>
  <div class="container-fluid">
		<div class="box box-info box-solid">
			<div class="box-header with-border">
			    <h1 class="box-title big">Leaves Request Table</h1>
			</div>
			<div class="box-body">
				<table id="dynamicTable" class="table table-striped table-hover table-bordered centered">
					<thead >
						<th class="text-center">ID</th>
						<th class="text-center">Name</th>
						<th class="text-center">Leave Type</th>
						<th class="text-center">Leave Left (Before)</th>
						<th class="text-center">Action</th>
						<th class="text-center">Updated Leave</th>
						<th class="text-center">Details</th>
						<th class="text-center">Date Updated</th>
					</thead>
					<?php
					foreach ($record as $row) {	
						?>
					<tr>
						<td class="text-center"><?php echo $row->leave_history_id; ?></td>
						<td><?php echo $row->name;  ?></td>
						<td class="text-center"><?php echo $row->leave_type_name; ?></td>
						<td class="text-center"><?php echo $row->leave_left; ?></td>
							<?php 
								if (substr($row->action,0,1)=='A'){
									echo "<td class='text-center success'> $row->action</td>"; 
								} else {
									echo "<td class='text-center danger'> $row->action</td>"; 
								}
							?>
						<td class="text-center"><?php echo $row->updated_leave; ?></td>
						<td class="text-center"><?php echo $row->details; ?></td>
						<td class="text-center"><?php echo date_format($row->date_updated,'M d, Y'); ?></td>
					</tr>
					<?php } ?>
				</table>	
			</div>	
		</div>
	</div>
</div>