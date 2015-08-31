<div class="content-wrapper">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ams/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url();?>ams/view_inventory" class="btn btn-default"><i class="fa fa-user"></i> Inventory</a></li>
        <li class="active">Add Asset</li>
    </ol>
    <div class="container-fluid">
        <div class="box box-info box-solid">
            <div class="box-header with-border">
                <h3 class="box-title big">Add Asset</h3>
            </div>
            <div class="box-body">
            <?php echo form_open('ams/add_asset'); ?>
                <label>
                    <p>Fields with * asterisk are required.</p>
                </label>
                <div class="box box-default box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Asset Information</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Asset ID: * </label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control input-sm" required name="txtAssetID" value="<?php echo set_value('txtAssetID'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Asset Name: * </label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control input-sm" required name="txtAssetName" value="<?php echo set_value('txtAssetName'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Description: * </label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control input-sm"  required name="txtDescription" value="<?php echo set_value('txtDescription'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Price: * </label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control input-sm" required name="txtPrice" value="<?php echo set_value('txtPrice'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Category: * </label>
                                <div class="col-sm-4">
                                    <select name="txtCategory" class="form-control" required>
                                        <option value="" selected>---</option>
                                        <?php
                                        foreach($category as $row){
                                            echo "<option value='$row->category_id'>$row->category_id - $row->category_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Vendor: * </label>
                                <div class="col-sm-4">
                                    <select name="txtVendor" class="form-control" required>
                                        <option value="" selected>---</option>
                                        <?php
                                        foreach($vendor as $row){
                                            echo "<option value='$row->vendor_id'>$row->vendor_id - $row->vendor_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Date Acquired: </label>
                                <div class="col-sm-4">
                                    <input type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd" class="form-control input-sm" required name="txtDateAcquired" value="<?php echo set_value('txtDateAcquired'); ?>">
                                </div>
                            </div>
                            <br><br>
                            <h2 class="page-header">If Applicable:</h2>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Serial Number:  </label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control input-sm"  name="txtSerial" value="<?php echo set_value('txtSerial'); ?>">
                                </div>
                                <div class="col-sm-5 error">
                                    <?php echo form_error('txtSerial'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Brand:  </label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control input-sm"  name="txtBrand" value="<?php echo set_value('txtBrand'); ?>">
                                </div>
                                <div class="col-sm-5 error">
                                    <?php echo form_error('txtBrand'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Model:  </label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control input-sm" name="txtModel" value="<?php echo set_value('txtModel'); ?>">
                                </div>
                                <div class="col-sm-5 error">
                                    <?php echo form_error('txtModel'); ?>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Warranty End Date:  </label>
                                <div class="col-sm-4">
                                <input type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd" class="form-control input-sm" name="txtWarrantyEnd" value="<?php echo set_value('txtWarrantyEnd'); ?>">
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
