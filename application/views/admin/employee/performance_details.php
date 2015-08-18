<div class="content-wrapper">
	<ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>ems/dashboard"  class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url();?>ems/view_performance"  class="btn btn-default"><i class="fa fa-star"></i> Performance Evaluation</a></li>
            <?php if($this->input->post('txtSearch')) {
            	echo "<li><a href='view_performance'>Performance Evaluation</a></li>";
            	echo "<li class='active'>Search Evaluation</li>";
            } else {
            	echo "<li class='active'>View Evaluation</li>";
            }
            ?>            
    </ol>
    <div class="container-fluid">
		<div class="box box-info box-solid">
			<div class="box-header with-border">
			    <div class="row">
			    	<div class="col-sm-8">
			    		<h1 class="box-title big">View Evaluation
						</h1>
			    	</div>
			    </div>		    
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-sm-3">
						<br><br>
						<div class="text-center bg-success">
						<br>
							<h1>Final Rate</h1>
							<h2 class=""><?php echo $row->final_rating; ?></h2>
						<br>
						</div>
					</div>
					<div class="col-sm-6">
						<section class="box box-default box-solid">
							<div class="box-header with-border">
								<h3 class="box-title text-center"><?php echo $row->employee_name; ?></h3>
							</div>
							<div class="box-body text-center">
								<div class="row">
									<div class="col-sm-4">
										<img src="<?php echo base_url();?>assets/images/default.jpg" class="img-responsive evaluator">
										<label class="label label-info ">Employee to be evaluated.</label>
									</div>
									<div class="col-sm-8"><br><br>
										<table class="table table-bordered">
											<tr>
												<th>Evaluation Title:</th>
												<td><?php echo $row->description; ?></td>
											</tr>
											<tr>
												<th>Date Evaluated:</th>
												<td><?php echo $row->date_evaluated; ?></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</section>
					</div>
					<!-- <div class="col-sm-3">
						<section class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title text-center">Arden Jay Dela Cruz</h3>
							</div>
							<div class="panel-body text-center">
								<img src="<?php echo base_url();?>assets/images/default.jpg" class="img-responsive evaluator">
								
								<label class="label label-info ">Self</label>
							</div>
						</section>
					</div>
					<div class="col-sm-3">
						<section class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title text-center">Jose Rizal</h3>
							</div>
							<div class="panel-body text-center">
								<img src="<?php echo base_url();?>assets/images/default.jpg" class="img-responsive evaluator">
								
								<label class="label label-info ">Peer</label>
							</div>
						</section>
					</div> -->
					<div class="col-sm-3">
						<section class="box box-default box-solid">
							<div class="box-header with-border">
								<h3 class="box-title text-center"><?php echo $row->evaluators; ?></h3>
							</div>
							<div class="box-body text-center">
								<img src="<?php echo base_url();?>assets/images/default.jpg" class="img-responsive evaluator">
								
								<label class="label label-info ">Evaluator</label>
							</div>
						</section>
					</div>
				</div> <!-- Evaluators row -->
				
				<table class="table table-bordered table-hover table-striped text-center">
					<thead>
						<th class="col-sm-6"></th>
						<th class="col-sm-6">Evaluator Rate</th>
						<!-- <th class="col-sm-3">Evaluator 2 Rate</th>
						<th class="col-sm-3">Evaluator 3 Rate</th> -->
					</thead>
					<tr>
						<td><?php echo $row->criteria1; ?></td>
						<td>
							<?php 
								for ($i=1; $i <= $row->rate1; $i++) { 
									echo "<i class='fa fa-star star'></i>";
								}
							 ?>
							<label> - <?php echo $row->rate1; ?></label>
						</td>
						<!-- <td>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<label> - 5.0</label>
						</td>
						<td>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<label> - 5.0</label>
						</td> -->
					</tr>
					<tr>
						<td><?php echo $row->criteria2; ?></td>
						<td>
							<?php 
								for ($i=1; $i <= $row->rate2; $i++) { 
									echo "<i class='fa fa-star star'></i>";
								}
							 ?>
							<label> - <?php echo $row->rate2; ?></label>
						</td>
						<!-- <td>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<label> - 5.0</label>
						</td>
						<td>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<label> - 5.0</label>
						</td> -->
					</tr>
					<tr>
						<td><?php echo $row->criteria3; ?></td>
						<td>
							<?php 
								for ($i=1; $i <= $row->rate3; $i++) { 
									echo "<i class='fa fa-star star'></i>";
								}
							 ?>
							<label> - <?php echo $row->rate3; ?></label>
						</td>
						<!-- <td>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<label> - 5.0</label>
						</td>
						<td>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<label> - 5.0</label>
						</td> -->
					</tr>
					<tr>
						<td><?php echo $row->criteria4; ?></td>
						<td>
							<?php 
								for ($i=1; $i <= $row->rate4; $i++) { 
									echo "<i class='fa fa-star star'></i>";
								}
							 ?>
							<label> - <?php echo $row->rate4; ?></label>
						</td>
						<!-- <td>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<label> - 5.0</label>
						</td>
						<td>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<label> - 5.0</label>
						</td> -->
					</tr>
					<tr>
						<td><?php echo $row->criteria5; ?></td>
						<td>
							<?php 
								for ($i=1; $i <= $row->rate5; $i++) { 
									echo "<i class='fa fa-star star'></i>";
								}
							 ?>
							<label> - <?php echo $row->rate5; ?></label>
						</td>
						<!-- <td>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<label> - 5.0</label>
						</td>
						<td>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<i class="fa fa-star star"></i>
							<label> - 5.0</label>
						</td> -->
					</tr>
					<tr>
						<th>RATE:</th>
						<th><?php echo $row->final_rating; ?></th>
						<!-- <th>5.0</th>
						<th>5.0</th> -->
					</tr>
				</table> 
			</div>
		</div>
	</div>
</div>