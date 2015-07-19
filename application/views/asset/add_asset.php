<div class="content-wrapper">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ams/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url();?>ams/view_inventory" class="btn btn-default"><i class="fa fa-user"></i> Inventory</a></li>
        <li class="active">Add Asset</li>
    </ol>
    <div class="container-fluid">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title big">Add Asset</h3>
            </div>
            <div class="panel-body">
                <label>
                    <p>Fields with * asterisk are required.</p>
                </label>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Asset Information</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open('ams/add_asset'); ?>
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label">Item ID: * </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control input-sm" placeholder="Asset ID" name="txtAssetID" value="<?php echo set_value('txtAssetID'); ?>">
                                    </div>
                                    <div class="col-sm-5 error">
                                        <?php echo form_error('txtAssetID'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label">Serial Number: * </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control input-sm" placeholder="Position" name="txtSerial" value="<?php echo set_value('txtSerial'); ?>">
                                    </div>
                                    <div class="col-sm-5 error">
                                        <?php echo form_error('txtSerial'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label">Brand: * </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control input-sm" placeholder="Status" name="txtBrand" value="<?php echo set_value('txtBrand'); ?>">
                                    </div>
                                    <div class="col-sm-5 error">
                                        <?php echo form_error('txtBrand'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-3 control-label">Model: * </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control input-sm" placeholder="Model" name="txtModel" value="<?php echo set_value('txtModel'); ?>">
                                    </div>
                                    <div class="col-sm-5 error">
                                        <?php echo form_error('txtModel'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label">Vendor: * </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control input-sm" placeholder="Vendor" name="txtVendor" value="<?php echo set_value('txtVendor'); ?>">
                                    </div>
                                    <div class="col-sm-5 error">
                                        <?php echo form_error('txtVendor'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label">Category: * </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control input-sm" placeholder="Category" name="txtCategory" value="<?php echo set_value('txtCategory'); ?>">
                                    </div>
                                    <div class="col-sm-5 error">
                                        <?php echo form_error('txtCategory'); ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label">Date Acquired: * </label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control input-sm" placeholder="Date Acquired" name="txtDateAcquired" value="<?php echo set_value('txtDateAcquired'); ?>">
                                    </div>
                                    <div class="col-sm-5 error">
                                        <?php echo form_error('txtDateAcquired'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label">Warranty Starts: * </label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control input-sm" placeholder="Warranty Starts" name="txtWarrantyStart" value="<?php echo set_value('txtWarrantyStart'); ?>">
                                    </div>
                                    <div class="col-sm-5 error">
                                        <?php echo form_error('txtWarrantyStart'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label">Warranty Ends: * </label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control input-sm" placeholder="Warranty Ends" name="txtWarrantyEnd" value="<?php echo set_value('txtWarrantyEnd'); ?>">
                                    </div>
                                    <div class="col-sm-5 error">
                                        <?php echo form_error('txtWarrantyEnd'); ?>
                                    </div>
                                </div>

                            </div>
                    </div>
                </div>

                <div class="signupButtons">
                    <center>
                        <input type="submit" class="btn btn-success" name="btnSubmit" value="Submit">
                        <input type="reset" class="btn btn-danger" value="Clear">
                    </center>
                </div>
                <?php echo form_close(); ?>
            </div>
            <!-- Main Panel Body-->
        </div>
        <!-- End of Main Panel -->
    </div>
</div>
<!-- End of Wrapper -->
