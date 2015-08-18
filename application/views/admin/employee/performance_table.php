<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ems/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <?php if($this->input->post('txtSearch')) {
        	echo "<li><a href='employees' class='btn btn-default'>Employees</a></li>";
        	echo "<li class='active'>Search Employees</li>";
        } else {
        	echo "<li class='active'>Performance Evaluation</li>";
        }
        $counter = 0;
        ?>            
    </ol>
    <div class="container-fluid">
		<div class="box box-info box-solid">
			<div class="box-header with-border">
			    <div class="row">
			    	<div class="col-sm-8">
			    		<h1 class="box-title big">Performance Evaluation
						</h1>
			    	</div>
			    </div>		    
			</div>
			<div class="box-body">
					<div class="pull-left add-employee">
						<!-- <a href="<?php echo base_url();?>ems/add_employee">
							<buttom  class="btn btn-success"><i class="fa fa-plus"></i> Add New Evaluation </buttom>
						</a> -->
						<buttom class="btn btn-info btn-sm" ><?php echo "Total Record: ". $total_performance; ?> </buttom>
					</div>
					<div class="pull-right">
					
						<?php
						if(isset($links)) echo $links; 
						?>
					</div> 
				<table class="table table-striped table-hover table-bordered">				
					<thead >
						<!-- <th><input type="checkbox" class="checkbox"></th> -->
						<th class="table-head">Evaluation ID</th>
						<th class="table-head">Employee Name</th>
						<th class="table-head">Evaluators</th>
						<th class="table-head">Description</th>
						<th class="table-head">Date Evaluated</th>
						<th class="table-head">Final Rating</th>
						<th class="table-head">Manage</th>
					</thead>
					<?php 
					foreach ($record as $row) {	?>
					<tr>
						<!-- <td><input type="checkbox" class="checkbox" name="checkbox[]"></td> -->
						<td align="center"><?php echo $row->performance_id; ?></td>
						<td><?php echo $row->employee_name; ?></td>
						<td><?php echo $row->evaluators; ?></td>
						<td><?php echo $row->description; ?></td>
						<td align="center"> <?php echo $row->date_evaluated; ?></td>
						<td align="center"><?php echo $row->final_rating; ?></td>
						<td align="center">
						<a href="<?php echo base_url();?>ems/view_performance_details?performance_id=<?php echo $row->performance_id; ?>">
							<button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="View Evaluation">
								<i class="fa fa-star"></i>
							</button>
						</a>
						</td>
					</tr>
					<?php $counter++; } ?>
				</table>	
			</div>	
		</div>
	</div>
</div>