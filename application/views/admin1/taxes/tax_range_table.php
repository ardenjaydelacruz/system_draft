<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ems/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url();?>payroll/taxes" class="btn btn-default"><i class="fa fa-dashboard"></i> Taxes</a></li>
		<li class='active'>Tax Range</li>           
    </ol>
    <div class="container-fluid">
		<div class="panel panel-info">
			<div class="panel-heading">
			    <div class="row">
			    	<form action="<?php echo base_url();?>payroll/tax_range" method="post">
					<div class="col-sm-9">
			    		<div class="row">
						<?php if(isset($tax)){ ?>
							<input type="hidden" name="txtTaxID" value="<?php echo $tax->tax_id; ?>">
							<label for="cboEmployee" class="control-label col-sm-9">Monthly tax range for <?php echo $tax->tax_name; ?></label>
						<?php } ?>
						</div>
			    	</div>
			    	</form>
			    </div>		    
			</div>
			<div class="panel-body">
				<?php if(isset($tax)){ ?>
				<div class="pull-left addButton">
					<a href="<?php echo base_url();?>payroll/tax_range_add?id=<?php echo $tax->tax_id; ?>">
						<div class="btn btn-success"><i class="fa fa-plus"></i> Add Tax Range </div>
					</a>
				</div>
				<table class="table table-striped table-hover table-bordered table-condensed ">				
					<thead >
						<th class="text-center">#</th>
						<th class="col-md-3 text-center">Amount From</th>
						<th class="col-md-3 text-center">Amount To</th>
						<th class="col-md-3 text-center">Amount Deduction</th>
						<th class="col-md-3 text-center">Action</th>
					</thead>
					<?php $ctr=1; foreach($tax_ranges as $row){ ?>
					<tr>
						<td class="text-center"><?php echo $ctr; ?></td>
						<td class="col-md-2 text-center"><?php echo $row->amount_from; ?></td>
						<td class="col-md-2 text-center"><?php echo $row->amount_to; ?></td>
						<td class="col-md-2 text-center"><?php echo $row->amount_deducted; ?></td>
						<td class="col-md-2 text-center">
							<a href="<?php echo base_url();?>payroll/tax_range_edit?id=<?php echo $row->tax_range_id; ?>">
							<button class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Edit Tax">
								<i class="fa fa-pencil"></i>
							</button>
							</a>
							<button class="btn btn-danger btn-xs" onclick=deleteTaxRange(<?php echo $row->tax_range_id; ?>,'<?php echo base_url();?>payroll/'); data-toggle="tooltip" data-placement="top" title="Delete Tax">
								<i class="fa fa-trash-o"></i>
							</button>
						</td>
					</tr>
					<?php $ctr++; } ?>
				</table>	
				<?php } ?>
			</div>	
		</div>
	</div>
</div>
