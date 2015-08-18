<?php
	$date1 = new DateTime(date('Y-m-d'));
	$date2 = new DateTime($row->date_acquired);
	$interval = $date1->diff($date2);
	$years = $interval->y;
?>

<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ams/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li><a href="<?php echo base_url();?>ams/view_assets" class="btn btn-default"><i class="fa fa-user"></i> Assets</a></li>
          <li class="active"><i class="fa fa-search"></i> View Assets </li>
    </ol>
    <div class="container-fluid">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
			    <h3 class="box-title big">Asset Details</h3>
			</div>
			<div class="box-body">
			
				<div class="row">
					<form action="<?php echo base_url();?>ams/update_asset?asset_id=<?php echo $row->asset_id; ?>" method="post">
						<div class="col-md-4">
		                   <div class="box box-default box-solid">
								<div class="box-header with-border">
								    <h3 class="box-title text-center"></h3>
								</div>
								<div class="box-body">
                  <div class="form-group">
                      <div class="text-center"><img src="<?php echo base_url();?>assets/images/default.jpg" alt="" class="img-responsive emp_image" /></div>
                  </div>
                  <table class="table table-striped table-hover">
                      <tbody>
                      <tr>
                          <th>Asset ID:</th>
                          <td><input type="text" disabled placeholder="id" class="form-control" value="<?php echo $row->asset_id;?>" name="txtAssetID"/></td>
                      </tr>
                      <tr>
                          <th>Asset Name:</th>
                          <td><input type="text" disabled placeholder="id" class="form-control" value="<?php echo $row->asset_name;?>" name="txtAssetName"/></td>
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
					    <div class="box box-default box-solid">								
								<div class="box-body">
									<div class="form-horizontal">
                    <div class="form-group">
                        <label class=" col-sm-3 control-label">Description: * </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control input-sm" name="txtDescription" value="<?php echo $row->asset_description; ?> " disabled>
                        </div>
                        <div class="col-sm-5 error">
                            <?php echo form_error('txtDescription'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" col-sm-3 control-label">Category: * </label>
                        <div class="col-sm-4">
                            <select name="txtCategory" class="form-control" disabled>
                                <option value="<?php echo $row->category_id; ?>" selected><?php echo $row->category_id; ?></option>
                                <?php
                                foreach($category as $record){
                                    echo "<option value='$record->category_id'>$record->category_id - $record->category_name</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-5 error">
                            <?php echo form_error('txtCategory'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" col-sm-3 control-label">Vendor: * </label>
                        <div class="col-sm-4">
                            <select name="txtVendor" class="form-control" disabled>
                                <option value="<?php echo $row->vendor_id; ?>" selected><?php echo $row->vendor_id; ?></option>
                                <?php
                                foreach($vendor as $data){
                                    echo "<option value='$data->vendor_id'>$data->vendor_id - $data->vendor_name</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-5 error">
                            <?php echo form_error('txtVendor'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" col-sm-3 control-label">Date Acquired: </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control input-sm" name="txtDateAcquired" value="<?php echo $row->date_acquired; ?>" disabled>
                        </div>
                        <div class="col-sm-5 error">
                            <?php echo form_error('txtDateAcquired'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" col-sm-3 control-label">Purchased Price: </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control input-sm" name="txtPrice" value="<?php echo $row->asset_price; ?>" disabled>
                        </div>
                        <div class="col-sm-5 error">
                            <?php echo form_error('txtPrice'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" col-sm-3 control-label">Depreciation Expense per Annum: </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control input-sm" name="txtDateAcquired" value="<?php echo $depreciation = $row->asset_price/5; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" col-sm-3 control-label">Current Value: </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control input-sm" name="txtDateAcquired" value="<?php echo $row->asset_price - ($years*$depreciation); ?>" disabled>
                        </div>
                    </div>
                    <br><br>
                    <h2 class="page-header">If Applicable:</h2>
                    <div class="form-group">
                        <label class=" col-sm-3 control-label">Serial Number:  </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control input-sm" name="txtSerial" value="<?php echo $row->serial_number; ?>" disabled>
                        </div>
                        <div class="col-sm-5 error">
                            <?php echo form_error('txtSerial'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" col-sm-3 control-label">Brand:  </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control input-sm"  name="txtBrand" value="<?php echo $row->brand; ?>" disabled>
                        </div>
                        <div class="col-sm-5 error">
                            <?php echo form_error('txtBrand'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" col-sm-3 control-label">Model:  </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control input-sm"  name="txtModel" value="<?php echo $row->model; ?>" disabled>
                        </div>
                        <div class="col-sm-5 error">
                            <?php echo form_error('txtModel'); ?>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class=" col-sm-3 control-label">Warranty End Date:  </label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control input-sm" name="txtWarrantyEnd" value="<?php echo $row->warranty_end_date; ?>" disabled>
                        </div>
                        <div class="col-sm-5 error">
                            <?php echo form_error('txtWarrantyEnd'); ?>
                        </div>
                    </div>
                  </div>
                </div><!-- Main Details --> 
            	</div>   <!--Main Panel -->
        		</div> <!-- col-8-->
        	</form>
				</div>
			</div>
		</div>
	</div>
</div>
