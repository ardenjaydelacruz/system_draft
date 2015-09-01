<div class="content-wrapper">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ams/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url();?>ams/view_assets" class="btn btn-default"><i class="fa fa-user"></i> Assigned Assets</a></li>
        <li class="active">Assign Asset</li>
    </ol>
    <div class="container-fluid">
        <div class="box box-info box-solid">
            <div class="box-header with-border">
                <h3 class="box-title big">Assign Asset</h3>
            </div>
            <div class="box-body">
            <?php echo form_open('ams/view_assets'); ?>
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
<form action="<?php echo base_url();?>ams/asset_transfer" method="post">
  <div class="modal fade" id="assetTransfer" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Transfer Supplies / Equipments</h4>
        </div>
        <div class="modal-body">
          <label for="">Equipment / Supply Name:</label>
          <input type="text" class="form-control" name="txtAssetName" required><br>
          <label for="">Transfer to:</label>
          <input type="text" class="form-control" name="txtNewEmp" required><br>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="Add" name="btnAddRequest">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</form>
