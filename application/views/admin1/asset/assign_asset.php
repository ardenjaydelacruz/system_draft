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
            <?php echo form_open('ams/view_assets'); ?>
                <label>
                    <p>Fields with * asterisk are required.</p>
                </label>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Asset Information</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Asset ID: * </label>
                                <div class="col-sm-4">
                                <?php echo $asset->asset_id.' - '.$asset->asset_name; ?>
                                <input type="hidden" name="txtAssetID" value="<?php echo $asset->asset_id; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Employee Name: * </label>
                                <div class="col-sm-4">
                                    <select name="txtEmployee" class="form-control">
                                        <option value="" selected>---</option>
                                        <?php
                                        foreach($employee as $row){
                                            echo "<option value='$row->emp_id'>$row->emp_id - $row->first_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-5 error">
                                    <?php echo form_error('txtAssetName'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Asset Status: * </label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control input-sm" placeholder="Asset Description" name="txtStatus" value="<?php echo set_value('txtAssetID'); ?>">
                                </div>
                                <div class="col-sm-5 error">
                                    <?php echo form_error('txtStatus'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Date Assigned: </label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control input-sm" placeholder="Date Acquired" name="txtAssignedDate" value="<?php echo set_value('txtDateAcquired'); ?>">
                                </div>
                                <div class="col-sm-5 error">
                                    <?php echo form_error('txtAssignedDate'); ?>
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
