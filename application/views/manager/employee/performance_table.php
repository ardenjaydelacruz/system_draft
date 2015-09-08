<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ems/hr_dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class='active'>Performance Evaluation</li>         
    </ol>
    <div class="container-fluid">
		<div class="box box-info box-solid">
			<div class="box-header with-border">
			    <div class="row">
			    	<div class="col-sm-8">
			    		<h1 class="box-title big">Performance Evaluation
						</h1>
			    	</div>
			    </div>		    
			</div>
			<div class="box-body">
				<table id="dynamicTable" class="table table-striped table-hover table-bordered">				
					<thead >
						<th class="table-head">Evaluation ID</th>
						<th class="table-head">Employee Name</th>
						<th class="table-head">Evaluator</th>
						<th class="table-head">Description</th>
						<th class="table-head">Date Evaluated</th>
						<th class="table-head">Final Rating</th>
						<th class="table-head">Manage</th>
					</thead>
					<?php 
					foreach ($record as $row) {	?>
					<tr>
						<td align="center"><?php echo $row->evaluation_id; ?></td>
						<td><?php echo $row->assessee; ?></td>
						<td><?php echo $row->assessor; ?></td>
						<td><?php echo $row->evaluation_desc; ?></td>
						<td align="center"> <?php echo date_format($row->evaluation_date,'M d, Y'); ?></td>
						<td align="center"><?php echo number_format($row->final_rating,2); ?></td>
						<td align="center">
						<a href="<?php echo base_url();?>ems/view_performance_details?evaluation_id=<?php echo $row->evaluation_id; ?>">
							<button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="View Evaluation">
								<i class="fa fa-star"></i>
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