
<div class="content-wrapper">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url();?>ams/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url();?>ams/view_inventory" class="btn btn-default"><i class="fa fa-user"></i> Inventory</a></li>
	</ol>
	<div class="container-fluid">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h1 class="box-title big">Inventory Table</h1>
			</div>
			<div class="box-body">
				<div class="pull-left addButton">
					<a href="<?php echo base_url();?>ams/add_stocks">
						<buttom class="btn btn-success"><i class="fa fa-plus"></i> Add New Item </buttom>
					</a>
					<a href="<?php echo base_url();?>ams/add_stocks_quantity">
						<buttom class="btn btn-success"><i class="fa fa-plus"></i> Restock Inventory </buttom>
					</a>
				</div>
				<table class="table table-striped table-hover table-bordered table-condensed centered">
					<thead>
						<th class="text-center">Item ID</th>
						<th class="text-center">Item Name</th>
						<th class="text-center">Category</th>
						<th class="text-center">Quantity</th>
						<th class="text-center">Price/pc.</th>
						<th class="text-center">Manage</th>
					</thead>
					<?php foreach ($record as $row) { ?>
						<tr>
							<td class="text-center">
								<?php echo $row->item_id; ?>
							</td>
							<td>
								<?php echo $row->item_name; ?>
							</td>
							<td>
								<?php echo $row->category_name; ?>
							</td>
							<td class="text-center">
								<?php echo $row->quantity; ?>
							</td>
							<td class="text-center">
								<?php echo $row->price; ?>
							</td>
							<td class="text-center">
								<!-- <a href="<?php echo base_url(); ?>ams/view_inventory_details?item_id=<?php echo $row->item_id; ?>">
									<button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="View Product">
										<i class="fa fa-cube"></i>
									</button>
								</a> -->
								<a href="<?php echo base_url(); ?>ams/edit_stocks?item_id=<?php echo $row->item_id; ?>">
									<button class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Update Stock Info">
										<i class="fa fa-pencil"></i>
									</button>
								</a>
								<a href="<?php echo base_url(); ?>ams/delete_stocks?item_id=<?php echo $row->item_id; ?>">
									<button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Update Stock">
										<i class="fa fa-trash-o"></i>
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
