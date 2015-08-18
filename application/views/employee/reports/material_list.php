<div class="content-wrapper">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url();?>ams/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><i class="fa fa-cogs"></i> Projects </li>
	</ol>
	<div class="container-fluid">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<h1 class="panel-title big">Projects Table</h1>
			</div>
			<div class="panel-body">
				<form action="<?php echo base_url();?>reports/material_list" role="form" method="post">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-header pull-left">
                            <h4>Filter By:</h4>
                        </div>
                        <div class="pull-right">
                            <input type="submit" name="btnFilter" value="Filter" class="btn btn-success btn-lg">
                        </div>
                    </div>
                </div>
                <div class="row">
               		<div class="col-sm-3">
                        <div class="form-group">
                            <label for="emp_name">Project Name:</label>
                            <select name="txtProject" id="emp_name" class="form-control">
                                <option value="">All Projects</option>
                                <?php foreach ($project as $row){ 
                                    echo "<option value='$row->project_id'>$row->project_name</option>";
                                } ?>
                            </select>
                        </div>
                    </div>
                </div><br>
                </form>
                <?php if ($this->input->post('btnFilter')) { ?>
                <form action="<?php echo base_url();?>reports/material_list" role="form" method="post">
                    <input type="hidden" name="txtProject" value="<?php echo $this->input->post('txtProject') ?>">
                    <input type="submit" name="btnPrint" value="Print" class="btn btn-info">
                </form>
				<table class="table table-striped table-hover table-bordered centered">
					<thead>
						<th class="text-center">Item Name</th>
						<th class="text-center">Quantity</th>
						<th class="text-center">Price/pc.</th>
						<th class="text-center">Total Price</th>
						<th class="text-center">Project Name:</th>
						<th class="text-center">Date Issued</th>
					</thead>
					<?php $expense=0; foreach ($materials as $row) { ?>
					<tr>
						<td class="text-center">
							<?php echo $row->item_name; ?>
						</td>
						<td class="text-center">
							<?php echo $row->quantity; ?>
						</td>
						<td class="text-center">
							<?php echo number_format($row->price,2); ?>
						</td>
						<td class="text-center">
							<?php
							$price = ($row->price)*($row->quantity);
							$expense= $expense + $price;
							echo number_format($price,2);
							?>
						</td>
						<td class="text-center">
							<?php echo $row->project_name; ?>
						</td>
						<td class="text-center">
							<?php echo $row->date_issued; ?>
						</td>
					</tr>
					<?php } ?>
				</table>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
