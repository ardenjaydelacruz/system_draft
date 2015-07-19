<div class="content-wrapper">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>ems/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i>
                Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>ams/view_assets" class="btn btn-default"><i class="fa fa-user"></i> Assets</a>
        </li>
        <li class="active"><i class="fa fa-search"></i> View Inventory Details</li>
    </ol>
    <div class="container-fluid">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title big">Product Details</h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo base_url(); ?>ems/update_employee?emp_id=<?php echo $row->id; ?>" method="post">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label">Item ID: * </label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control input-sm" name="txtItemID" value="<?php echo $row->item_id; ?>" disabled>
                                    </div>
                                    <div class="col-sm-5 error">
                                        <?php echo form_error('txtItemID'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label">Item Name: * </label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control input-sm" name="txtItemName" value="<?php echo $row->item_name; ?>" disabled>
                                    </div>
                                    <div class="col-sm-5 error">
                                        <?php echo form_error('txtItemName'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label">Category ID: * </label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control input-sm" name="txtCategoryID" value="<?php echo $row->category_id; ?>" disabled>
                                    </div>
                                    <div class="col-sm-5 error">
                                        <?php echo form_error('txtCategoryID'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label">Price: * </label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control input-sm" name="txtPrice" value="<?php echo $row->price; ?>" disabled>
                                    </div>
                                    <div class="col-sm-5 error">
                                        <?php echo form_error('txtPrice'); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!--Main Panel -->
                    </div> <!-- col-8-->
                </div> <!-- col-12-->
                </form>
                <div class="signupButtons">
                    <center>
                        <a href="<?php echo base_url(); ?>ams/view_inventory">
                            <button class="btn btn-info">
                                <i class="fa fa-arrow-left"> </i> Back to Inventory Table
                            </button>
                        </a>
                    </center>
                </div>
            </div> <!--Main Content Panel-body -->
        </div><!--Main Content Panel -->
    </div> <!-- container fluid -->
</div>
