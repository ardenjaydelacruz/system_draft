<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class='active'>Allowances</li>           
    </ol>
    <div class="container-fluid">
		<div class="panel panel-info">
			<div class="panel-heading">
			    <div class="row">
			    	<form action="<?php echo base_url();?>payroll/allowances" method="post">
					<div class="col-sm-9">
			    		<div class="row">
							<label for="cboEmployee" class="control-label col-sm-9">Allowances </label>
						</div>
			    	</div>
			    	</form>
			    </div>		    
			</div>
			<div class="panel-body">
				<div class="pull-left addButton">
					<a href="<?php echo base_url();?>payroll/allowances_add">
						<div class="btn btn-success"><i class="fa fa-plus"></i> Add Allowance Type </div>
					</a>
				</div>
				<table class="table table-striped table-hover table-bordered table-condensed ">				
					<thead >
						<th class="col-md-2 text-center">Type</th>
						<th class="col-md-2 text-center">Percentage</th>
						<th class="col-md-2 text-center">Amount</th>
						<th class="col-md-2 text-center">Active</th>
						<th class="col-md-2 text-center">Action</th>
					</thead>
					<?php foreach($allowances as $row){	?>
					<tr>
						<td class="col-md-2 text-center"><?php echo $row->allowance_name; ?></td>
						<td class="col-md-2 text-center"><?php echo $row->percentage; ?></td>
						<td class="col-md-2 text-center"><?php echo $row->amount; ?></td>
						<td class="col-md-2 text-center"><?php echo ($row->active==1)?'<i class="fa fa-check"></i>':'<i class="fa fa-times"></i>'; ?></td>
						<td class="col-md-2 text-center">
							<a href="<?php echo base_url();?>payroll/allowances_edit?id=<?php echo $row->allowance_id; ?>">
							<button class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Edit Allowance">
								<i class="fa fa-pencil"></i>
							</button>
							</a>
							<button class="btn btn-danger btn-xs" onclick=deleteAllowance(<?php echo $row->allowance_id; ?>,'<?php echo base_url();?>payroll/'); data-toggle="tooltip" data-placement="top" title="Delete Allowance">
								<i class="fa fa-trash-o"></i>
							</button>
						</td>
					</tr>
					<?php } ?>
				</table>	
			</div>	
		</div>
	</div>
</div>
