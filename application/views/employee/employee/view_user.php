<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url();?>admin/employees" class="btn btn-default"><i class="fa fa-user"></i> Employees</a></li>
        <li class="active">User Accounts</li>
    </ol>
    <div class="container-fluid">
    	<div class="box box-info box-solid">
    		<div class="box-header with-border">
    			<h3 class="box-title big">User Account</h3>
    		</div>
    		<div class="box-body">
    			<table id="dynamicTable" class="table table-striped table-hover table-bordered">				
					<thead >
						<th class="table-head">Emp. ID</th>
						<th class="table-head">Username</th>
						<th class="table-head">User Level</th>
						<th class="table-head">Manage</th>
					</thead>
					<?php foreach ($record as $row) { ?>
					<tr>
						<td align="center"><?php echo $row->employee_id; ?></td>
						<td><?php echo $row->username; ?></td>
						<td><?php echo $row->user_level; ?></td>
						<td align="center">
						<a href="<?php echo base_url();?>ems/view_details?emp_id=<?php echo $row->employee_id; ?>">
							<button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="View Employee">
								<i class="fa fa-user"></i>
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
