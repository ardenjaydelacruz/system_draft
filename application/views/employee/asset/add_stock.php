<div class="content-wrapper">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ems/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url();?>ems/view_inventory" class="btn btn-default"><i class="fa fa-user"></i> Inventory</a></li>
        <li class="active">Add Stocks</li>
    </ol>
    <div class="container-fluid">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title big">Add new Stock</h3>
            </div>
            <div class="panel-body">
                <label>
                    <small>Fields with * asterisk are required.</small>
                </label>
                <?php echo form_open('ams/add_stocks'); ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Product Information</h3>
                    </div>
                    <div class="panel-body">
                        
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Item ID: * </label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control input-sm" name="txtItemID">
                                </div>
                                <div class="col-sm-5 error">
                                    <?php echo form_error('txtItemID'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Item Name: * </label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control input-sm" name="txtItemName">
                                </div>
                                <div class="col-sm-5 error">
                                    <?php echo form_error('txtItemName'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Category: * </label>
                                <div class="col-sm-3">
                                    <select name="txtCategory" class="form-control">
                                        <option value="" selected>---</option>
                                        <?php
                                        foreach($category as $row){
                                            echo "<option value='$row->category_id'>$row->category_id - $row->category_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-5 error">
                                    <?php echo form_error('txtCategory'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Price per piece.: * </label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control input-sm" name="txtPrice">
                                </div>
                                <div class="col-sm-5 error">
                                    <?php echo form_error('txtPrice'); ?>
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
