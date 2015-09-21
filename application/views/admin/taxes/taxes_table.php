<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ems/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class='active'>Deductions</li>           
    </ol>
    <div class="container-fluid">
		<div class="panel panel-info">
			<div class="panel-heading">
			    <div class="row">
			    	<form action="<?php echo base_url();?>payroll/taxes" method="post">
					<div class="col-sm-9">
			    		<div class="row">
							<label for="cboEmployee" class="control-label col-sm-9">Deductions </label>
						</div>
			    	</div>
			    	</form>
			    </div>		    
			</div>
			<div class="panel-body">
				<div class="pull-left addButton">
					<a href="<?php echo base_url();?>payroll/taxes_add">
						<div class="btn btn-success"><i class="fa fa-plus"></i> Add Deduction </div>
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
					<?php foreach($taxes as $row){	?>
					<tr>
						<td class="col-md-2 text-center"><?php echo $row->tax_name; ?></td>
						<?php if($row->ranges_active==0){ ?>
						<td class="col-md-2 text-center"><?php echo $row->percentage; ?></td>
						<td class="col-md-2 text-center"><?php echo $row->amount; ?></td>
						<?php }else{ ?>
						<td class="col-md-4 text-center" colspan="2"><i>Varies on salary</i></td>
						<?php } ?>
						<td class="col-md-2 text-center"><?php echo ($row->active==1)?'<i class="fa fa-check"></i>':'<i class="fa fa-times"></i>'; ?></td>
						<td class="col-md-2 text-center">
							<a href="<?php echo base_url();?>payroll/tax_range?id=<?php echo $row->tax_id; ?>">
							<button class="btn btn-<?php echo ($row->ranges_active==0)?"default disabled":"info"; ?> btn-xs" data-toggle="tooltip" data-placement="top" title="Edit Tax Range">
								<i class="fa fa-list"></i>
							</button>
							</a>
							<a href="<?php echo base_url();?>payroll/taxes_edit?id=<?php echo $row->tax_id; ?>">
							<button class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Edit Tax">
								<i class="fa fa-pencil"></i>
							</button>
							</a>
							<button class="btn btn-danger btn-xs" onclick=deleteTax(<?php echo $row->tax_id; ?>,'<?php echo base_url();?>payroll/'); data-toggle="tooltip" data-placement="top" title="Delete Tax">
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
