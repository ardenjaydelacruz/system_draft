<div class="content-wrapper">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ems/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class='active'>Reports</li>
    </ol>
    <div class="container-fluid">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-sm-8">
                        <h1 class="panel-title big">Asset List</h1>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <form action="<?php echo base_url();?>reports/asset_list" role="form" method="post">
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
		                    <label for="stocks">Category Name:</label>
		                    <select name="txtCategory" id="stocks" class="form-control">
		                        <option value="">All Assets</option>
		                        <?php foreach ($category as $row){ 
		                            echo "<option value='$row->category_name'>$row->category_name</option>";
		                        } ?>
		                    </select>
		                </div>
		            </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="txtStatus" id="status" class="form-control">
                            <option value="">All Asset Conditions</option>
                                <option value="Brand New" <?php if($this->input->post('txtStatus')=='Brand New') { echo "selected";}?> >Brand New</option>
                                <option value="Damaged" <?php if($this->input->post('txtStatus')=='Damaged') { echo "selected";}?> >Damaged</option>
                                <option value="2nd Hand" <?php if($this->input->post('txtStatus')=='2nd Hand') { echo "selected";}?> >2nd Hand</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                          <label for="emp_name">Assigned Employee:</label>
                          <select name="txtEmployee" id="emp_name" class="form-control">
                              <option value="">All Employees</option>
                              <?php foreach ($employees as $row){ 
                                  echo "<option value='$row->emp_id'>$row->first_name $row->middle_name $row->last_name</option>";
                              } ?>
                          </select>
                      </div>
                    </div>
                </div><br>
                </form>
                <?php if ($this->input->post('btnFilter')) { ?>
                    <table class="table table-striped table-hover table-bordered">				
											<thead >
												<th class="table-head">Asset ID</th>
												<th class="table-head">Asset Name</th>
												<th class="table-head">Category</th>
												<th class="table-head">Status</th>
												<th class="table-head">Assigned Employee</th>
												<th class="table-head">Manage</th>
											</thead>
											<?php 
											foreach ($asset as $row) {	?>
											<tr>
												<td align="center"><?php echo $row->asset_id; ?></td>
												<td><?php echo $row->asset_name; ?></td>
												<td><?php echo $row->category_name; ?></td>
												<td><?php echo $row->asset_status; ?></td>
												<td><?php echo $row->name; ?></td>
												<td align="center">
												<a href="<?php echo base_url();?>ams/view_asset_details?asset_id=<?php echo $row->asset_id; ?>">
													<button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="View Asset">
														<i class="fa fa-user"></i>
													</button>
												</a>
												<a href="<?php echo base_url();?>ams/assign_asset?asset_id=<?php echo $row->asset_id; ?>">
												<button class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Assign Asset">
													<i class="fa fa-pencil"></i>
												</button>
												</a>
												<button class="btn btn-danger btn-xs" onclick=deleteAsset(<?php echo $row->asset_id; ?>,'<?php echo base_url();?>ams/') data-toggle="tooltip" data-placement="top" title="Delete Asset">
													<i class="fa fa-trash-o"></i>
												</button>
												</td>
											</tr>
											<?php } ?>
										</table>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
