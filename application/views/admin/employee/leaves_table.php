<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ems/admin_dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li><a href="<?php echo base_url();?>ems/employees" class="btn btn-default"><i class="fa fa-user"></i> Employee</a></li>
          <li class="active"><i class="fa fa-calendar"></i> Leave Request </li>
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
						<th class="text-center">Employee Name</th>
						<th class="text-center">Leave Date</th>
						<th class="text-center">Type of leave</th>
						<th class="text-center">No. of Days</th>
						<th class="text-center">Leaves Left</th>
						<th class="text-center">Status</th>
						<th class="text-center">Manage</th>
					</thead>
					<?php
					foreach ($record as $row) {	
						$id = $row->emp_id;
						?>
					<tr>
						<td class="text-center"><?php echo $row->leave_request_id; ?></td>
						<td><?php echo $row->name;  ?></td>
						<td class="text-center"><?php echo date_format($row->leave_start,'M d, Y').' - '.date_format($row->leave_end,'M d, Y'); ?></td>
						<td><?php echo $row->leave_type_name; ?></td>
						<td class="text-center"><?php echo $row->days; ?></td>
						<td class="text-center"><?php echo $row->leave_left; ?></td>
						<td align="center">
							<?php if ($row->leave_status=='Pending'){ ?>
							<a href="<?php echo base_url(); ?>ems/leaves_table?leave_status=Approved&leave_request_id=<?php echo substr($row->leave_request_id,3,5);?>&leave_id=<?php echo $row->leave_type_id; ?>&days=<?php echo $row->days; ?>&leave_left=<?php echo $row->leave_left; ?>&emp_id=<?php echo $row->emp_id; ?>">
								<button class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Approve Leave"><i class="fa fa-thumbs-up fa-lg"></i></button>
							</a>
							<a href="<?php echo base_url(); ?>ems/leaves_table?leave_status=Denied&leave_request_id=<?php echo substr($row->leave_request_id,3,5);?>">
								<button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Decline Leave"><i class="fa fa-thumbs-down fa-lg"></i></button>
							</a>
							<?php } else {
								if ($row->leave_status=='Approved'){
									echo "<label class='label label-success'>";
									echo $row->leave_status;
									echo "</label>";
								} else if ($row->leave_status=='Denied') {
									echo "<label class='label label-danger'>";
									echo $row->leave_status;
									echo "</label>";
								} else {
									echo "<label class='label label-warning'>";
									echo $row->leave_status;
									echo "</label>";
								}
							} ?>
						</td>
						<td align="center">
							<a href="<?php echo base_url();?>ems/view_leave_details?leave_request_id=<?php echo $row->leave_request_id; ?>">
								<button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="View Leave"><i class="fa fa-search"></i></button>
							</a>
							<a href="<?php echo base_url();?>ems/dept_status?dept=<?php echo $row->department_name; ?>">
								<button class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="View Department Status"><i class="fa fa-institution"></i></button>
							</a>
						</td>
					</tr>
					
					<?php } ?>
				</table>	
			</div>	
		</div>
	</div>
</div>
<div class="modal fade" id="showDept" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Employment Type</h4>
      </div>
      <div class="modal-body">
        <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Job Titles</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
              <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div><!-- /.box-tools -->
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-hovered table-striped table-bordered">
                 <thead>
                    <th class="text-center">ID </th>
                    <th class="text-center">Name </th>
                    <th class="text-center">Status </th>
                 </thead>
                 <?php 
                 $emp = View_employees_list::find($id);
                 foreach ($emp as $row) { ?>
                 <tr>
                    <th class="text-center"><?php echo $row->emp_id; ?></th>
                    <td class="text-center"><?php echo "$row->first_name $row->middle_name $row->last_name"; ?></td>
                    <th class="text-center"><?php echo $row->status; ?></th>
                 </tr>
                 <?php } ?>
             </table>
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-success" value="Add" name="btnAddDepartment">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->