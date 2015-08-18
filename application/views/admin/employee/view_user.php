<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url();?>admin/employees" class="btn btn-default"><i class="fa fa-user"></i> Employees</a></li>
        <li class="active">User Accounts</li>
    </ol>
    <div class="container-fluid">
    	<div class="panel panel-info">
    		<div class="panel-heading">
    			<h3 class="panel-title big">User Account</h3>
    		</div>
    		<div class="panel-body">
    			<table class="table table-striped table-hover table-bordered">				
					<thead >
						<!-- <th><input type="checkbox" class="checkbox"></th> -->
						<th class="table-head col-sm-1">Emp. ID</th>
						<th class="table-head col-sm-1">Username</th>
						<th class="table-head col-sm-1">User Level</th>
						<th class="table-head col-sm-4">Secret Question</th>
						<!-- <th class="table-head col-sm-1">Secret Answer</th> -->
						<th class="table-head">Manage</th>
					</thead>
					<?php foreach ($record as $row) { ?>
					<tr>
						<!-- <td><input type="checkbox" class="checkbox" name="checkbox[]"></td> -->
						<td align="center"><?php echo $row->employee_id; ?></td>
						<td><?php echo $row->username; ?></td>
						<td><?php echo $row->user_level; ?></td>
						<td><?php echo $row->secret_question; ?></td>
						<td align="center">
						<a href="<?php echo base_url();?>admin/view_details?emp_id=<?php echo $row->employee_id; ?>">
							<button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="View Employee">
								<i class="fa fa-user"></i>
							</button>
						</a>
						<a href="<?php echo base_url();?>admin/edit_employee?emp_id=<?php echo $row->employee_id; ?>">
						<button class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Edit Employee">
							<i class="fa fa-pencil"></i>
						</button>
						</a>
						<a href="<?php echo base_url();?>admin/edit_employee?emp_id=<?php echo $row->employee_id; ?>">
						<button class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Edit Employee">
							<i class="fa fa-danger"></i>
						</button>
						</a>
						</td>
					</tr>
					<?php } ?>
				</table>	
    		</div>
    	</div>
    </div>
</div>
