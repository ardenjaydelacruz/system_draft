<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class='active'>Calendar</li>           
    </ol>
    <div class="container-fluid">
		<div class="panel panel-info">
			<div class="panel-heading">
			    <div class="row">
			    	<form action="<?php echo base_url();?>calendar/calendar_index" method="post">
					<div class="col-sm-9">
			    		<div class="row">
							<label for="cboEmployee" class="control-label col-sm-9">Calendar </label>
						</div>
			    	</div>
			    	</form>
			    </div>		    
			</div>
			<div class="panel-body">
				<div class="pull-left addButton">
					<a href="<?php echo base_url();?>calendar/event_add">
						<div class="btn btn-success"><i class="fa fa-plus"></i> Add Day Event </div>
					</a>
				</div>
				<div class="clearfix"></div>
				<table id="dynamicTable" class="table table-striped table-hover table-bordered table-condensed ">				
					<thead >
						<th class="text-center">#</th>
						<th class="col-md-2 text-center">Event</th>
						<th class="col-md-3 text-center">Remarks</th>
						<th class="col-md-2 text-center">Date</th>
						<th class="col-md-2 text-center">Day Type</th>
						<th class="col-md-2 text-center">Allow Absence</th>
						<th class="col-md-1 text-center">Action</th>
					</thead>
					<?php $ctr=1; foreach($dates as $row){ ?>
					<tr>
						<td class="text-center"><?php echo $ctr; ?></td>
						<td class="col-md-2 text-center"><?php echo $row->day_name; ?></td>
						<td class="col-md-3 text-center"><?php echo $row->description; ?></td>
						<td class="col-md-2 text-center"><?php echo $row->date_value; ?></td>
						<td class="col-md-2 text-center"><?php echo $row->day_type_name; ?></td>
						<td class="col-md-2 text-center"><?php echo ($row->allow_absence==1)?'<i class="fa fa-check"></i>':'<i class="fa fa-times"></i>'; ?></td>
						<td class="col-md-1 text-center">
							<a href="<?php echo base_url();?>calendar/event_edit?id=<?php echo $row->calendar_id; ?>">
							<button class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Edit Event">
								<i class="fa fa-pencil"></i>
							</button>
							</a>
							<button class="btn btn-danger btn-xs" onclick=deleteEvent(<?php echo $row->calendar_id; ?>,'<?php echo base_url();?>calendar/'); data-toggle="tooltip" data-placement="top" title="Delete Event">
								<i class="fa fa-trash-o"></i>
							</button>
						</td>
					</tr>
					<?php $ctr++; } ?>
				</table>	
			</div>	
		</div>
	</div>
</div>
