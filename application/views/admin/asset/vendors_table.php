<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ams/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li><a href="<?php echo base_url();?>ams/employees" class="btn btn-default"><i class="fa fa-user"></i> Employee</a></li>
          <li class="active"><i class="fa fa-calendar"></i> Leave </li>
    </ol>
    <div class="container-fluid">
		<div class="box box-warning box-solid">
			<div class="box-header withborder">
			    <h1 class="box-title big">Vendors Table</h1>
			</div>
			<div class="box-body">
				<table class="table table-striped table-hover table-bordered centered">
					<thead >
						<th class="text-center">ID</th>
						<th class="text-center">Vendor Name</th>
						<th class="text-center">Address</th>
						<th class="text-center">Contact Number</th>
						<th class="text-center">Email</th>
						<th class="text-center">Manage</th>
					</thead>
					<?php foreach ($record as $row) { ?>
					<tr>
						<td><?php echo $row->vendor_id; ?></td>
						<td><?php echo $row->vendor_name; ?></td>
						<td><?php echo $row->address; ?></td>
						<td><?php echo $row->contact_number; ?></td>
						<td><?php echo $row->email; ?></td>
						<td></td>
					</tr>
					<?php } ?>
				</table>	
			</div>	
		</div>
	</div>
</div>