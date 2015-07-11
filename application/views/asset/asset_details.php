<?php 
	foreach ($record as $row) {
		$id = $row->asset_id;
		$serial_number = $row->serial_number;
		$brand = $row->brand;
		$model = $row->model;
		$vendor = $row->vendor;
		$status = $row->status;
		$category = $row->category;
		$date_acquired = $row->date_acquired;
		$warranty_start = $row->warranty_start;
		$warranty_end = $row->warranty_end;
	}
?>
<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ams/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li><a href="<?php echo base_url();?>ams/view_assets" class="btn btn-default"><i class="fa fa-user"></i> Assets</a></li>
          <li class="active"><i class="fa fa-search"></i> View Assets </li>
    </ol>
    <div class="container-fluid">
		<div class="panel panel-warning">
			<div class="panel-heading">
			    <h3 class="panel-title big">Asset Details</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<form action="<?php echo base_url();?>ams/update_asset?asset_id=<?php echo $id; ?>" method="post">
						<div class="col-md-4">
		                	<div class="panel panel-default">
								<div class="panel-heading">
								    <h3 class="panel-title text-center"></h3>
								</div>
								<div class="panel-body">
		                            <div class="form-group">
		                                <div class="text-center"><img src="<?php echo base_url();?>assets/images/default.jpg" alt="" class="img-responsive emp_image" /></div>
		                            </div>
			                            <table class="table table-striped table-hover">
			                                <tbody>
			                                <tr>
			                                    <th>Asset ID:</th>
			                                    <td><?php echo $id;?></td>
			                                </tr>
			                                <tr>
			                                    <th>Serial Number:</th>
			                                    <td><input type="text" disabled placeholder="id" class="form-control" value="<?php echo $serial_number;?>" name="txtSerial"/></td>
			                                </tr>		                                		                                
			                                <tr>
			                                    <th>Status:</th>
			                                    <td><input type="text" disabled placeholder="id" class="form-control" value="<?php echo $status;?>" name="txtStatus"/></td>
			                                </tr>
			                                <tr>
			                                	<td>
			                                		<a id="btnEnable" class="btn btn-primary btn-block"><i class="fa fa-edit"></i>Edit</a>
			                                	</td>
			                                	<td>
			                                		<input type="submit" id="btnSaveEdit" class="btn btn-success btn-block disabled" value="Save">                             	
			                                	</td>
			                                </tr>
			                                </tbody>
			                            </table>
		                        </div> <!-- Main Panel Body -->
							</div> <!-- Side Panel -->
						</div> <!-- col-4-->

						<div class="col-md-8">					              
					        <div class="panel panel-default">								
								<div class="panel-body">
					              	<div class="nav-tabs-custom">
						                <ul class="nav nav-tabs">
						                	<li class="active"><a href="#tab_1" data-toggle="tab">Asset Details</a></li>
						                	<!-- <li><a href="#tab_2" data-toggle="tab">Contact Detail</a></li>
						                	<li><a href="#tab_3" data-toggle="tab">Contact Person</a></li> -->                                  
						                </ul>
						                <div class="tab-content">
						                  <div class="tab-pane active" id="tab_1">
						                 		<div class="form-horizontal">						                    
			                                        <h3>Asset Details</h3><hr>
			                                        <!-- <div class="form-group"><label class="col-sm-3 control-label">Description:</label>
			                                            <div class="col-sm-9 controls">
			                                                <div class="row">
			                                                    <div class="col-xs-9"><input type="text" disabled class="form-control" value="<?php echo $description; ?>" name="txtDescription"/></div>
			                                                </div>
			                                            </div>
			                                        </div> -->
			                                        <div class="form-group"><label class="col-sm-3 control-label">Brand:</label>
			                                            <div class="col-sm-9 controls">
			                                                <div class="row">
			                                                    <div class="col-xs-9"><input type="text" disabled placeholder="middle name" class="form-control" value="<?php echo $brand; ?>" name="txtBrand"/></div>
			                                                </div>
			                                            </div>
			                                        </div>
			                                        <div class="form-group"><label class="col-sm-3 control-label">Model:</label>
			                                            <div class="col-sm-9 controls">
			                                                <div class="row">
			                                                    <div class="col-xs-9"><input type="text" disabled placeholder="last name" class="form-control" value="<?php echo $model; ?>" name="txtModel"/></div>
			                                                </div>
			                                            </div>
			                                        </div>
			                                        <div class="form-group"><label class="col-sm-3 control-label">Vendor:</label>
			                                            <div class="col-sm-9 controls">
			                                                <div class="row">
			                                                    <div class="col-xs-9"><input type="text" disabled placeholder="last name" class="form-control" value="<?php echo $vendor; ?>" name="txtVendor"/></div>
			                                                </div>
			                                            </div>
			                                        </div>
			                                        <div class="form-group"><label class="col-sm-3 control-label">Category:</label>
			                                            <div class="col-sm-9 controls">
			                                                <div class="row">
			                                                    <div class="col-xs-9"><input type="text" type="text" disabled class="form-control" value="<?php echo $category; ?>" name="txtCategory" disabled/></div>
			                                                </div>
			                                            </div>
			                                        </div>
			                                    	<hr>
													<div class="form-group"><label class="col-sm-3 control-label">Date Acquired:</label>
			                                            <div class="col-sm-9 controls">
			                                                <div class="row">
			                                                    <div class="col-xs-9"><input type="date" disabled placeholder="last name" class="form-control" value="<?php echo $date_acquired; ?>" name="txtDateAcquired"/></div>
			                                                </div>
			                                            </div>
			                                        </div>
			                                        <div class="form-group"><label class="col-sm-3 control-label">Warranty Start:</label>
			                                            <div class="col-sm-9 controls">
			                                                <div class="row">
			                                                    <div class="col-xs-9"><input type="date" disabled placeholder="last name" class="form-control" value="<?php echo $warranty_start; ?>" name="txtWarrantyStart"/></div>
			                                                </div>
			                                            </div>
			                                        </div>
			                                        <div class="form-group"><label class="col-sm-3 control-label">Warranty End:</label>
			                                            <div class="col-sm-9 controls">
			                                                <div class="row">
			                                                    <div class="col-xs-9"><input type="date" type="text" disabled class="form-control" value="<?php echo $warranty_end; ?>" name="txtWarrantyEnd" disabled/></div>
			                                                </div>
			                                            </div>
			                                        </div>
			                                      
			                                    </div>	
						                  	</div><!-- /.tab-pane1 -->
						                </div><!-- /.tab-content -->
					              	</div><!-- nav-tabs-custom -->                          
		                        </div><!-- Main Details --> 
		                    </div>   <!--Main Panel -->
		                </div> <!-- col-8-->
		            </form>
				</div>
			</div>
		</div>
	</div>
</div>
