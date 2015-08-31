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
								<h3 class="box-title text-center"><?php echo $row->assessee; ?></h3>
							</div>
							<div class="box-body text-center">
								<div class="row">
									<div class="col-sm-4">
										<img src="<?php echo base_url();?>assets/images/default.jpg" class="img-responsive evaluator">
										<label class="label label-info ">Evaluated Employee</label>
									</div>
									<div class="col-sm-8"><br><br>
										<table class="table table-bordered">
											<tr>
												<th>Evaluation Title:</th>
												<td><?php echo $row->evaluation_desc; ?></td>
											</tr>
											<tr>
												<th>Date Evaluated:</th>
												<td><?php echo date_format($row->evaluation_date,'M d, Y'); ?></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</section>
					</div>
					<div class="col-sm-3">
						<section class="box box-default box-solid">
							<div class="box-header with-border">
								<h3 class="box-title text-center"><?php echo $row->assessor; ?></h3>
							</div>
							<div class="box-body text-center">
								<img src="<?php echo base_url();?>assets/images/default.jpg" class="img-responsive evaluator">
								<label class="label label-info ">Evaluator</label>
							</div>
						</section>
					</div>
				</div> <!-- Evaluators row -->
				<?php 
					foreach ($criteria as $wew) {		
						$field[] = $wew->criteria_desc;
					}
				?>
				<table class="table table-bordered table-hover table-striped text-center">
					<thead>
						<th class="col-sm-6"></th>
						<th class="col-sm-6">Evaluator Rate</th>
					</thead>
					<tr>
						<td><?php echo $field[0]; ?></td>
						<td>
							<?php 
								for ($i=1; $i <= $row->rate1; $i++) { 
									echo "<i class='fa fa-star star'></i>";
								}
							 ?>
							<label> - <?php echo $row->rate1; ?></label>
						</td>
					</tr>
					<tr>
						<td><?php echo $field[1]; ?></td>
						<td>
							<?php 
								for ($i=1; $i <= $row->rate2; $i++) { 
									echo "<i class='fa fa-star star'></i>";
								}
							 ?>
							<label> - <?php echo $row->rate2; ?></label>
						</td>
					</tr>
					<tr>
						<td><?php echo $field[2]; ?></td>
						<td>
							<?php 
								for ($i=1; $i <= $row->rate3; $i++) { 
									echo "<i class='fa fa-star star'></i>";
								}
							 ?>
							<label> - <?php echo $row->rate3; ?></label>
						</td>
					</tr>
					<tr>
						<td><?php echo $field[3]; ?></td>
						<td>
							<?php 
								for ($i=1; $i <= $row->rate4; $i++) { 
									echo "<i class='fa fa-star star'></i>";
								}
							 ?>
							<label> - <?php echo $row->rate4; ?></label>
						</td>
					</tr>
					<tr>
						<td><?php echo $field[4]; ?></td>
						<td>
							<?php 
								for ($i=1; $i <= $row->rate5; $i++) { 
									echo "<i class='fa fa-star star'></i>";
								}
							 ?>
							<label> - <?php echo $row->rate5; ?></label>
						</td>
					</tr>
					<tr>
						<td><?php echo $field[5]; ?></td>
						<td>
							<?php 
								for ($i=1; $i <= $row->rate5; $i++) { 
									echo "<i class='fa fa-star star'></i>";
								}
							 ?>
							<label> - <?php echo $row->rate5; ?></label>
						</td>
					</tr>
					<tr>
						<td><?php echo $field[6]; ?></td>
						<td>
							<?php 
								for ($i=1; $i <= $row->rate5; $i++) { 
									echo "<i class='fa fa-star star'></i>";
								}
							 ?>
							<label> - <?php echo $row->rate5; ?></label>
						</td>
					</tr>
					<tr>
						<td><?php echo $field[7]; ?></td>
						<td>
							<?php 
								for ($i=1; $i <= $row->rate5; $i++) { 
									echo "<i class='fa fa-star star'></i>";
								}
							 ?>
							<label> - <?php echo $row->rate5; ?></label>
						</td>
					</tr>
					<tr>
						<td><?php echo $field[8]; ?></td>
						<td>
							<?php 
								for ($i=1; $i <= $row->rate5; $i++) { 
									echo "<i class='fa fa-star star'></i>";
								}
							 ?>
							<label> - <?php echo $row->rate5; ?></label>
						</td>
					</tr>
					<tr>
						<td><?php echo $field[9]; ?></td>
						<td>
							<?php 
								for ($i=1; $i <= $row->rate5; $i++) { 
									echo "<i class='fa fa-star star'></i>";
								}
							 ?>
							<label> - <?php echo $row->rate5; ?></label>
						</td>
					</tr>
					<tr class="success">
						<th>RATE:</th>
						<th><?php echo number_format($row->final_rating,2); ?></th>
						<!-- <th>5.0</th>
						<th>5.0</th> -->
					</tr>
				</table> 
			</div>
		</div>
	</div>
</div>