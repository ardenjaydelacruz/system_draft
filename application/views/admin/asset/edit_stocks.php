<div class="content-wrapper">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>ems/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i>
                Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>ams/view_assets" class="btn btn-default"><i class="fa fa-user"></i> Assets</a>
        </li>
        <li class="active"><i class="fa fa-search"></i> Edit Stocks</li>
    </ol>
    <div class="container-fluid">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title big">Product Details</h3>
            </div>
            <div class="box-body">
                <form action="<?php echo base_url(); ?>ams/edit_stocks?item_id=<?php echo $row->item_id; ?>" method="post">
                <div class="col-md-12">
                    <div class="box box-default box-solid">
                        <div class="box-body">
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label">Item ID: * </label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control input-sm" name="txtItemID" value="<?php echo $row->item_id; ?>" >
                                    </div>
                                    <div class="col-sm-5 error">
                                        <?php echo form_error('txtItemID'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label">Item Name: * </label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control input-sm" name="txtItemName" value="<?php echo $row->item_name; ?>" >
                                    </div>
                                    <div class="col-sm-5 error">
                                        <?php echo form_error('txtItemName'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label">Category ID: * </label>
                                    <div class="col-sm-3">
                                        <select name="txtCategory" class="form-control">
                                            <option value="<?php echo $row->category_id; ?>" selected><?php echo $row->category_id; ?></option>
                                            <?php
                                            foreach($category as $data){
                                                echo "<option value='$data->category_id'>$data->category_id - $data->category_name</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-5 error">
                                        <?php echo form_error('txtCategory'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label">Price: * </label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control input-sm" name="txtPrice" value="<?php echo $row->price; ?>" >
                                    </div>
                                    <div class="col-sm-5 error">
                                        <?php echo form_error('txtPrice'); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!--Main Panel -->
                    </div> <!-- col-8-->
                </div> <!-- col-12-->
                <div class="signupButtons">
                    <center>
                        <input type="submit" class="btn btn-success" name="btnSubmit" value="Submit">
                    </center>
                </div>
                </form>
            </div> <!--Main Content Panel-body -->
        </div>
    </div>
</div>
