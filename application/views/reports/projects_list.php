<div class="content-wrapper">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url();?>ams/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><i class="fa fa-cogs"></i> Projects </li>
	</ol>
	<div class="container-fluid">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<h1 class="panel-title big">Projects Table</h1>
			</div>
			<div class="panel-body">
				<form action="<?php echo base_url();?>reports/projects_list" role="form" method="post">
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
               		<div class="col-sm-2">
                        <div class="form-group">
                            <label for="status">Project Status:</label>
                            <select name="txtStatus" id="status" class="form-control">
                            <option value="">All Projects</option>
                                <option value="Active" <?php if($this->input->post('txtStatus')=='Active') { echo "selected";}?> >Active</option>
                                <option value="Finished" <?php if($this->input->post('txtStatus')=='Finished') { echo "selected";}?> >Finished</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="emp_name">Client Name:</label>
                            <select name="txtClient" id="emp_name" class="form-control">
                                <option value="">All Job Titles</option>
                                <?php foreach ($client as $row){ 
                                    echo "<option value='$row->client_name'>$row->client_name</option>";
                                } ?>
                            </select>
                        </div>
                    </div>
                </div><br>
                </form>
                <?php if ($this->input->post('btnFilter')) { ?>
				<table class="table table-striped table-hover table-bordered centered">
					<thead>
						<th class="text-center">ID</th>
						<th class="text-center">Project Name</th>
						<th class="text-center">Client Name</th>
						<th class="text-center">Project Cost</th>
						<th class="text-center">Starting Date</th>
						<th class="text-center">Ending Date</th>
						<th class="text-center">Status</th>

					</thead>
					<?php foreach ($project as $row) { ?>
					<tr>
						<td class="text-center">
							<?php echo $row->project_id; ?>
						</td>
						<td>
							<?php echo $row->project_name; ?>
						</td>
						<td>
							<?php echo $row->client_name; ?>
						</td>
						<td class="text-center">
							<?php echo number_format($row->total_expense,2); ?>
						</td>
						<td class="text-center">
							<?php echo $row->starting_date; ?>
						</td>
						<td class="text-center">
							<?php echo $row->ending_date; ?>
						</td>
						<td class="text-center">
							<?php
							if (strtotime(date('M d, Y')) <= strtotime($row->ending_date)){
								echo "<label class='label label-success'>Active</label>";
							} else {
								echo "<label class='label label-danger'>Finished</label>";
							}
							?>
						</td>
					</tr>
					<?php } ?>
				</table>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
