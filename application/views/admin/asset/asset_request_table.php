<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ams/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class='active'>Asset Request</li>
    </ol>
    <div class="container-fluid">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
			    <div class="row">
			    	<div class="col-sm-8">
			    		<h1 class="box-title big">Asset Request</h1>
			    	</div>
			    </div>		    
			</div>
			<div class="box-body">
				<table id="dynamicTable" class="table table-striped table-hover table-bordered">				
					<thead >
						<th class="table-head">ID</th>
						<th class="table-head">Asset Name</th>
						<th class="table-head">Quantity</th>
						<th class="table-head">Requested by</th>
						<th class="table-head">Status</th>
						<th class="table-head">Checked by</th>
						<th class="table-head">Date Requested</th>
					</thead>
					<?php 
					foreach ($record as $row) {	?>
					<tr>
						<td align="center"><?php echo $row->asset_request_id; ?></td>
						<td><?php echo $row->asset_name; ?></td>
						<td align="center"><?php echo $row->quantity; ?></td>
						<td><?php echo $row->name; ?></td>
						<td align="center">
							<?php if ($row->request_status=='Pending'){ ?>
							<a href="<?php echo base_url(); ?>ams/asset_request_table?asset_request=Approved&asset_request_id=<?php echo $row->asset_request_id;?>&pressed=true">
								<button class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Approve Leave"><i class="fa fa-thumbs-up fa-lg"></i></button>
							</a>
							<a href="<?php echo base_url(); ?>ams/asset_request_table?asset_request=Denied&asset_request_id=<?php echo $row->asset_request_id;?>&pressed=true">
								<button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Decline Leave"><i class="fa fa-thumbs-down fa-lg"></i></button>
							</a>
							<?php } else {
								if ($row->request_status=='Approved'){
									echo "<label class='label label-success'>";
									echo $row->request_status;
									echo "</label>";
								} else if ($row->request_status=='Denied') {
									echo "<label class='label label-danger'>";
									echo $row->request_status;
									echo "</label>";
								} else {
									echo "<label class='label label-warning'>";
									echo $row->request_status;
									echo "</label>";
								}
							} ?>
						</td>
						<td><?php echo $row->approved_by; ?></td>
						<td align="center"><?php echo date_format($row->date_requested,'M d, Y'); ?></td>
					</tr>
					<?php  } ?>
				</table>	
			</div>	
		</div>
	</div>
</div>
