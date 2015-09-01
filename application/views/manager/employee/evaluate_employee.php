<div class="content-wrapper">
	<ol class="breadcrumb">
    <li><a href="<?php echo base_url();?>ems/dashboard"  class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="<?php echo base_url();?>ems/view_performance"  class="btn btn-default"><i class="fa fa-star"></i> Performance Evaluation</a></li>
    <li class='active'>Evaluate Employee</li>
  </ol>
  <div class="container-fluid">
		<div class="panel panel-info">
			<div class="panel-heading">
			    <div class="row">
			    	<div class="col-sm-8">
			    		<h1 class="panel-title big">Evaluate Employee
						</h1>
			    	</div>
			    </div>		    
			</div>
			<div class="panel-body">
				<div class="clearfix"></div>
				<?php 
					foreach ($criteria as $row) {
						$field[] = $row->criteria_desc;
					}

				 ?>
				<form action="<?php echo base_url();?>ems/process_evaluation" method="post">
				<div class="row">
					<div class="col-sm-3">
						<section class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title text-center"><?php echo $selected->first_name.' '.$selected->last_name;?></h3>
							</div>
							<div class="panel-body text-center">
								<img src="<?php echo base_url();?>assets/images/default.jpg" class="img-responsive evaluator">
								<br>
								<label>Employee to be evaluated</label>
							</div>
						</section>
						<center><button class="btn btn-success button MainButtons" name="btnSubmit">
							<i class="fa fa-floppy-o"></i><br>
							Save
						</button></center>
					</div>
					<div class="col-sm-9">
						<input type="hidden" id="txtEmpID" name="txtEmpID" value="<?php echo $selected->emp_id; ?>">
						<label for="txtTitle">Evaluation Title: </label>
						<input type="text" id="txtTitle" name="txtEvalTitle" class="form-control" required>
						<br>
						<table class="table table-bordered table-striped table-hover text-center">
							<thead>
								<th></th>
								<th>Criteria</th>
								<th>Rate</th>
							</thead>
							<tr>
								<td>1</td>
								<td><?php echo $field[0]; ?></td>
								<td>
									<select name="txtRate1" id="rate" >
										<option value="1">1.0</option>
										<option value="2">2.0</option>
										<option value="3">3.0</option>
										<option value="4">4.0</option>
										<option value="5">5.0</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>2</td>
								<td><?php echo $field[1]; ?></td>
								<td>
									<select name="txtRate2" id="rate" >
										<option value="1">1.0</option>
										<option value="2">2.0</option>
										<option value="3">3.0</option>
										<option value="4">4.0</option>
										<option value="5">5.0</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>3</td>
								<td><?php echo $field[2]; ?></td>
								<td>
									<select name="txtRate3" id="rate" >
										<option value="1">1.0</option>
										<option value="2">2.0</option>
										<option value="3">3.0</option>
										<option value="4">4.0</option>
										<option value="5">5.0</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>4</td>
								<td><?php echo $field[3]; ?></td>
								<td>
									<select name="txtRate4" id="rate" >
										<option value="1">1.0</option>
										<option value="2">2.0</option>
										<option value="3">3.0</option>
										<option value="4">4.0</option>
										<option value="5">5.0</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>5</td>
								<td><?php echo $field[4]; ?></td>
								<td>
									<select name="txtRate5" id="rate" >
										<option value="1">1.0</option>
										<option value="2">2.0</option>
										<option value="3">3.0</option>
										<option value="4">4.0</option>
										<option value="5">5.0</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>6</td>
								<td><?php echo $field[5]; ?></td>
								<td>
									<select name="txtRate6" id="rate" >
										<option value="1">1.0</option>
										<option value="2">2.0</option>
										<option value="3">3.0</option>
										<option value="4">4.0</option>
										<option value="5">5.0</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>7</td>
								<td><?php echo $field[6]; ?></td>
								<td>
									<select name="txtRate7" id="rate" >
										<option value="1">1.0</option>
										<option value="2">2.0</option>
										<option value="3">3.0</option>
										<option value="4">4.0</option>
										<option value="5">5.0</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>8</td>
								<td><?php echo $field[7]; ?></td>
								<td>
									<select name="txtRate8" id="rate" >
										<option value="1">1.0</option>
										<option value="2">2.0</option>
										<option value="3">3.0</option>
										<option value="4">4.0</option>
										<option value="5">5.0</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>9</td>
								<td><?php echo $field[8]; ?></td>
								<td>
									<select name="txtRate9" id="rate" >
										<option value="1">1.0</option>
										<option value="2">2.0</option>
										<option value="3">3.0</option>
										<option value="4">4.0</option>
										<option value="5">5.0</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>10</td>
								<td><?php echo $field[9]; ?></td>
								<td>
									<select name="txtRate10" id="rate" >
										<option value="1">1.0</option>
										<option value="2">2.0</option>
										<option value="3">3.0</option>
										<option value="4">4.0</option>
										<option value="5">5.0</option>
									</select>
								</td>
							</tr>
						</table>
					</div> <!--Col 9 -->
				</div>
				</form>
				<?php  ?>
			</div>
		</div>
	</div>
</div>