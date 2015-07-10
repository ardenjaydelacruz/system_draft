<div class="content-wrapper">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url();?>ams/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url();?>ams/view_projects" class="btn btn-default"><i class="fa fa-cogs"></i> Projects </a></li>
		<li class="active"><i class="fa fa-money"></i> Bill of Materials </li>
	</ol>
	<div class="container-fluid">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<h1 class="panel-title big">Bill of Materials Table</h1>
			</div>
			<div class="panel-body">
				<div class="pull-left addButton">
					<a href="<?php echo base_url();?>ams/add_materials">
						<buttom class="btn btn-success"><i class="fa fa-plus"></i> Add New Materials </buttom>
					</a>
				</div>

				<table class="table table-striped table-hover table-bordered centered">
					<thead>
						<th class="text-center">Materials ID</th>
						<th class="text-center">Project ID</th>
						<th class="text-center">Item Number</th>
						<th class="text-center">Quantity</th>
						<th class="text-center">Price/pc.</th>
						<th class="text-center">Total Price</th>
						<th class="text-center">Date Issued</th>
						 <th class="text-center">Manage</th>
					</thead>
						<tr>
						<?php $expense=0; foreach ($record as $row) { ?>
							<td class="text-center">
								<?php echo $row->materials_id; ?>
							</td>
							<td class="text-center">
								<?php echo $row->project_id; ?>
							</td>
							<td class="text-center">
								<?php echo $row->item_number; ?>
							</td>
							<td class="text-center">
								<?php echo $row->quantity; ?>
							</td>
							<td class="text-center">
								<?php echo number_format($row->price,2); ?>
							</td>
							<td class="text-center">
								<?php
								$price = ($row->price)*($row->quantity);
								$expense= $expense + $price;
								echo number_format($price,2);
								?>
							</td>
							<td class="text-center">
								<?php echo $row->date_issued; ?>
							</td>
							<td class="text-center">
								<a href="<?php echo base_url(); ?>ams/delete_materials?id=<?php echo $row->materials_id; ?>">
									<button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete Materials">
										<i class="fa fa-trash-o"></i>
									</button>
								</a>
							</td>
						</tr>
						<?php } ?>
				</table>
				<div class="pull-right addButton">
					<h3>Total Project Expenses: <?php  echo number_format($expense); ?></h3>
				</div>
			</div>
		</div>
	</div>
</div>
