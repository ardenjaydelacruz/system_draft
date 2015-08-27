<div class="content-wrapper">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url();?>ams/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url();?>ams/view_projects" class="btn btn-default"><i class="fa fa-cogs"></i> Projects </a></li>
		<li class="active"><i class="fa fa-money"></i> Bill of Materials </li>
	</ol>
	<div class="container-fluid">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h1 class="box-title big">Bill of Materials Table</h1>
			</div>
			<div class="box-body">
				<table id="dynamicTable" class="table table-striped table-hover table-bordered centered">
					<thead>
						<th class="text-center">Item Name</th>
						<th class="text-center">Project Name</th>
						<th class="text-center">Quantity</th>
						<th class="text-center">Price/pc.</th>
						<th class="text-center">Total Price</th>
						<th class="text-center">Date Issued</th>
						 <th class="text-center">Manage</th>
					</thead>
					<?php $expense=0; foreach ($record as $row) { ?>
					<tr>
						<td class="text-center">
							<?php echo $row->item_name; ?>
						</td>
						<td class="text-center">
							<?php echo $row->project_name; ?>
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
							<?php echo date_format($row->date_issued,'M d, Y'); ?>
						</td>
						<td class="text-center">
							<a href="<?php echo base_url(); ?>ams/delete_materials?id=<?php echo $row->item_id; ?>">
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
