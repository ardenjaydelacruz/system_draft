<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ams/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <?php if($this->input->post('txtSearch')) {
        	echo "<li><a href='view_assets' class='btn btn-default'>Assets</a></li>";
        	echo "<li class='active'>Search Assets</li>";
        } else {
        	echo "<li class='active'>Other Assets</li>";
        }
        $counter = 0;
        ?>            
    </ol>
    <div class="container-fluid">
		<div class="panel panel-warning">
			<div class="panel-heading">
			    <div class="row">
			    	<div class="col-sm-8">
			    		<h1 class="panel-title big">Other Assets
				    		 
						</h1>
			    	</div>
			    	<form action="<?php echo base_url();?>ams/search_asset" method="post">
			    	<div class="col-sm-4">
			    		<div class="input-group input-group">
			    			<input type="text" class="form-control" placeholder="Search Asset (Id / Serial / Model)" name="txtSearch">
		                    <span class="input-group-btn">
	                    		<button class="btn btn-info btn-flat" name="btnSearch"><i class="fa fa-search fa-lg"></i></button>
	                    	</span>
		                 </div>
			    	</div>
			    	</form>
			    </div>		    
			</div>
			<div class="panel-body">
					<div class="pull-left add-employee">
						<a href="<?php echo base_url();?>ams/add_asset">
							<buttom  class="btn btn-success"><i class="fa fa-plus"></i> Add Asset </buttom>
						</a>
						<buttom class="btn btn-warning btn-sm" ><?php echo "Total Assets: ". $total_asset; ?> </buttom>
					</div>
					<div class="pull-right">
					
						<?php
						if(isset($links)) echo $links; 
						?>
					</div> 
				<table class="table table-striped table-hover table-bordered">				
					<thead >
						<!-- <th><input type="checkbox" class="checkbox"></th> -->
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
						<!-- <td><input type="checkbox" class="checkbox" name="checkbox[]"></td> -->
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
						<button class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Edit Asset">
							<i class="fa fa-pencil"></i>
						</button>
						</a>
						<button class="btn btn-danger btn-xs" onclick=deleteAsset(<?php echo $row->asset_id; ?>,'<?php echo base_url();?>ams/') data-toggle="tooltip" data-placement="top" title="Delete Asset">
							<i class="fa fa-trash-o"></i>
						</button>
						</td>
					</tr>
					<?php $counter++; } ?>
				</table>	
			</div>	
		</div>
	</div>
</div>
