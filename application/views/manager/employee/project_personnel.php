<div class="content-wrapper">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url();?>ams/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url();?>ems/view_projects" class="btn btn-default"><i class="fa fa-cogs"></i> Projects </a></li>
		<li class="active"><i class="fa fa-group"></i> Project Personnel </li>
	</ol>
	<div class="container-fluid">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h1 class="box-title big">Project Personnel</h1>
			</div>
			<div class="box-body">
				<table class="table table-hovered table-striped table-bordered">
	                <thead>
	                   <th class="text-center">Project ID</th>
	                   <th class="text-center">Project Name</th>
	                   <th class="text-center">Employee Name</th>
	                   <th class="text-center">Assigned Date</th>
	                </thead>
	                <?php foreach ($project as $proj) { ?>
	                <tr>
	                   <th class="text-center"><?php echo $proj->project_id; ?></th>
	                   <td><?php echo $proj->project_name; ?></td>
	                   <td><?php echo $proj->name; ?></td>
	                   <td class="text-center"><?php echo date_format($proj->assigned_date,'M d, Y'); ?></td>
	                </tr>
	                <?php } ?>
	             </table>
			</div>
		</div>
	</div>
</div>
