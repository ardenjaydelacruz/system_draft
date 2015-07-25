<div class="content-wrapper">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url();?>ams/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><i class="fa fa-cogs"></i> Projects </li>
	</ol>
	<div class="container-fluid">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<h1 class="panel-title big">Project Workers Table</h1>
			</div>
			<div class="panel-body">
				<form action="<?php echo base_url();?>reports/project_workers" role="form" method="post">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-header pull-left">
                            <h4>Filter By:</h4>
                        </div>
                        <div class="pull-right">
                            <input type="submit" name="btnFilter" value="Filter" class="btn btn-success btn-lg">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="emp_name">Project Name:</label>
                            <select name="txtProjectName" id="emp_name" class="form-control">
                                <option value="">---</option>
                                <?php foreach ($projectName as $row){ 
                                    echo "<option value='$row->project_name'>$row->project_name</option>";
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="emp_name">Employee Name:</label>
                            <select name="txtEmployee" id="emp_name" class="form-control">
                                <option value="000">---</option>
                                <?php foreach ($employee as $row){ 
                                    echo "<option value='$row->emp_id'>$row->first_name $row->middle_name $row->last_name</option>";
                                } ?>
                            </select>
                        </div>
                    </div>
                </div><br>
                </form>
                <?php if ($this->input->post('btnFilter')) { ?>
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
	                   <td class="text-center"><?php echo $proj->assigned_date; ?></td>
	                </tr>
	                <?php } ?>
	             </table>
				<?php }  ?>
			</div>
		</div>
	</div>
</div>
