<div class="content-wrapper">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>ems/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i>
                Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>ams/view_assets" class="btn btn-default"><i class="fa fa-user"></i> Assets</a>
        </li>
        <li class="active"><i class="fa fa-search"></i> Edit Stocks</li>
    </ol>
    <div class="container-fluid">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title big">Product Details</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="text-center"><img
                                                src="<?php echo base_url() . 'assets/images/profile/default.jpg'; ?>"
                                                alt="" class="img-responsive emp_image"/></div>
                                        <div id="upload">
                                            <?php
                                            echo form_open_multipart('ems/upload_image?emp_id=' . $id);
                                            echo form_upload('userfile');
                                            echo form_submit('btnUpload', 'Upload');
                                            echo form_close();
                                            ?>
                                        </div>
                                    </div>

                                    <form
                                        action="<?php echo base_url(); ?>ams/edit_stocks?item_number=<?php echo $row->item_number; ?>"
                                        method="post">
                                        <table class="table table-striped table-hover">
                                            <tbody>
                                            <tr>
                                                <th>Item Number:</th>
                                                <td>
                                                    <?php echo $row->item_number; ?>
                                                    <input type="hidden" class="form-control"
                                                           value="<?php echo $row->item_number; ?>" name="txtItemNumber"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Item Name:</th>
                                                <td>
                                                    <?php echo $row->item_name; ?>
                                                    <input type="hidden" class="form-control"
                                                           value="<?php echo $row->item_name; ?>" name="txtItemName"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <input type="submit" name="btnSubmit"
                                                           class="btn btn-success btn-block" value="Submit">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                </div>
                            </div>
                            <!-- Side Panel-->
                        </div>
                        <!-- col-4-->

                        <div class="col-md-8">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab_1" data-toggle="tab">Product Details</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1">
                                                <div class="form-horizontal">
                                                    <h3>Product Info</h3>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Category</label>

                                                        <div class="col-sm-9 controls">
                                                            <div class="row">
                                                                <div class="col-xs-9">
                                                                    <input type="text" class="form-control"
                                                                           value="<?php echo $row->category; ?>"
                                                                           name="txtCategory"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Vendor</label>

                                                        <div class="col-sm-9 controls">
                                                            <div class="row">
                                                                <div class="col-xs-9">
                                                                    <input type="text" class="form-control"
                                                                           value="<?php echo $row->vendor; ?>"
                                                                           name="txtVendor"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Location</label>

                                                        <div class="col-sm-9 controls">
                                                            <div class="row">
                                                                <div class="col-xs-9">
                                                                    <input type="text" class="form-control"
                                                                           value="<?php echo $row->location; ?>"
                                                                           name="txtLocation"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Quantity</label>

                                                        <div class="col-sm-9 controls">
                                                            <div class="row">
                                                                <div class="col-xs-9">
                                                                    <input type="text" type="text" class="form-control"
                                                                           value="<?php echo $row->quantity; ?>"
                                                                           name="txtQuantity"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Price</label>

                                                        <div class="col-sm-9 controls">
                                                            <div class="row">
                                                                <div class="col-xs-9">
                                                                    <input type="text" type="text" class="form-control"
                                                                           value="<?php echo $row->price; ?>"
                                                                           name="txtPrice"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Date Acquired</label>

                                                        <div class="col-sm-9 controls">
                                                            <div class="row">
                                                                <div class="col-xs-9">
                                                                    <input type="text" type="text" class="form-control"
                                                                           value="<?php echo date('M d, Y', strtotime($row->date_added)); ?>"
                                                                           name="" disabled/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.tab-pane1 -->
                                        </div>
                                        <!-- nav-tabs-custom -->
                                    </div>
                                    <!-- Main Details -->
                                </div>
                                <!--Main Panel -->
                            </div>
                            <!-- col-9-->
                        </div>
                    </div>
                    <!-- col-12-->

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
                </div>
                <!--Main Content Panel-body -->
            </div>
            <!--Main Content Panel -->
        </div>
    </div>
