<div class="content-wrapper">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ems/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url();?>ams/view_inventory" class="btn btn-default"><i class="fa fa-user"></i> Inventory</a></li>
        <li class="active">Restock Inventory</li>
    </ol>
    <div class="container-fluid">
        <div class="box box-info box-solid">
            <div class="box-header with-border">
                <h3 class="box-title big">Restock Inventory</h3>
            </div>
            <div class="box-body">
                <label>
                    <small>Fields with * asterisk are required.</small>
                </label>
                <?php echo form_open('ams/add_stocks_quantity'); ?>
                <div class="box box-default box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Product Information</h3>
                    </div>
                    <div class="box-body">
                        
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Item ID: * </label>
                                <div class="col-sm-3">
                                    <select name="txtItemID" class="form-control">
                                        <option value="" selected>---</option>
                                        <?php
                                        foreach($stocks as $row){
                                            echo "<option value='$row->item_id'>$row->item_id - $row->item_name ($row->quantity)</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-5 error">
                                    <?php echo form_error('txtCategory'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Quantity: * </label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control input-sm" name="txtQuantity">
                                </div>
                                <div class="col-sm-5 error">
                                    <?php echo form_error('txtQuantity'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Vendor: * </label>
                                <div class="col-sm-3">
                                    <select name="txtVendor" class="form-control">
                                        <option value="" selected>---</option>
                                        <?php
                                        foreach($vendor as $row){
                                            echo "<option value='$row->vendor_id'>$row->vendor_id - $row->vendor_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-5 error">
                                    <?php echo form_error('txtVendor'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Restock Date: * </label>
                                <div class="col-sm-3">
                                    <input type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd" class="form-control input-sm" name="txtDateRestock">
                                </div>
                                <div class="col-sm-5 error">
                                    <?php echo form_error('txtDateRestock'); ?>
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
