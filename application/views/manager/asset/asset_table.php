<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ams/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class='active'><i class="fa fa-desktop"></i> Assigned Equipments / Supplies</li>           
    </ol>
    <div class="container-fluid">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
			    <div class="row">
			    	<div class="col-sm-8">
			    		<h1 class="box-title big">Assigned Equipments / Supplies</h1>
			    	</div>
			    </div>		    
			</div>
			<div class="box-body">
				<div class="pull-left add-employee">
					<a href="<?php echo base_url();?>ams/add_asset">
						<buttom  class="btn btn-success"><i class="fa fa-plus"></i> Add Asset </buttom>
					</a>
					<a href="#" data-toggle="modal" data-target="#assetTransfer">
						<buttom  class="btn btn-info"><i class="fa fa-long-arrow-up"></i><i class="fa fa-long-arrow-down"></i> Transfer Asset </buttom>
					</a>
				</div>
				<br><br>
				<table id="dynamicTable" class="table table-striped table-hover table-bordered">				
					<thead >
						<th class="table-head">Asset ID</th>
						<th class="table-head">Asset Name</th>
						<th class="table-head">Category</th>
						<th class="table-head">Status</th>
						<th class="table-head">Assigned Employee</th>
						<th class="table-head">Manage</th>
					</thead>
					<?php 
					foreach ($record as $row) {	?>
					<tr>
						<td align="center"><?php echo $row->asset_id; ?></td>
						<td><?php echo $row->asset_name; ?></td>
						<td><?php echo $row->category_name; ?></td>
						<td><?php echo $row->asset_status; ?></td>
						<td><?php echo $row->name; ?></td>
						<td align="center">
						<a href="<?php echo base_url();?>ams/view_asset_details?asset_id=<?php echo $row->asset_id; ?>">
							<button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="View Asset">
								<i class="fa fa-user"></i>
							</button>
						</a>
						<a href="<?php echo base_url();?>ams/assign_asset?asset_id=<?php echo $row->asset_id; ?>">
						<button class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Assign Asset">
							<i class="fa fa-pencil"></i>
						</button>
						</a>
						<button class="btn btn-danger btn-xs" onclick=deleteAsset(<?php echo $row->asset_id; ?>,'<?php echo base_url();?>ams/') data-toggle="tooltip" data-placement="top" title="Delete Asset">
							<i class="fa fa-trash-o"></i>
						</button>
						</td>
					</tr>
					<?php } ?>
				</table>	
			</div>	
		</div>
	</div>
</div><form action="<?php echo base_url();?>ams/asset_transfer" method="post">
  <div class="modal fade" id="assetTransfer" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Transfer Supplies / Equipments</h4>
        </div>
        <div class="modal-body">
          <label for="">Equipment / Supply Name:</label>
					<select name="txtAssetID" class="form-control">
						<option value="" selected>---</option>
						<?php
						foreach($record as $row){
						    echo "<option value='$row->asset_id'>$row->asset_name - $row->name</option>";
						}
						?>
					</select>
					<br>
          <label for="">Transfer to:</label>
          <select name="txtEmployee" class="form-control">
            <option value="" selected>---</option>
            <?php
            foreach($employee as $row){
                echo "<option value='$row->emp_id'>$row->emp_id - $row->first_name</option>";
            }
            ?>
          </select><br>
          <label for="">Asset Status:</label>
          <input type="text" class="form-control" name="txtStatus" required><br>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="Add" name="btnAddRequest">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</form>
