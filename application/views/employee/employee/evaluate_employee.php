<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ems/dashboard"  class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url();?>ems/view_performance"  class="btn btn-default"><i class="fa fa-star"></i> Performance Evaluation</a></li>
        <?php if($this->input->post('txtSearch')) {
        	echo "<li><a href='view_performance'>Performance Evaluation</a></li>";
        	echo "<li class='active'>Search Evaluation</li>";
        } else {
        	echo "<li class='active'>Evaluate Employee</li>";
        }
        ?>            
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
			<form action="<?php echo base_url();?>ems/process_evaluation" method="post">
				<div class="row">
					<div class="col-sm-3">
						<section class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title text-center"><?php $this->session->set_userdata('name',$name); echo $name;?></h3>
							</div>
							<div class="panel-body text-center">
								<img src="<?php echo base_url();?>assets/images/default.jpg" class="img-responsive evaluator">
								<br>
								<label  >Employee to be evaluated</label>
								<button class="btn btn-success" name="btnSubmit">
									<i class="fa fa-floppy-o"></i>
									Save
								</button>
							</div>
						</section>
					</div>
					<div class="col-sm-9">
						<label for="txtTitle">Evaluation Title: </label>
						<input type="text" id="txtTitle" name="txtEvalTitle" class="form-control">
						<br>
						<table class="table table-bordered table-striped table-hover text-center">
							<thead>
								<th></th>
								<th>Criteria</th>
								<th>Rate</th>
							</thead>
							<tr>
								<td>1</td>
								<td><input type="text" name="txtCriteria1" class="form-control"></td>
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
								<td><input type="text" name="txtCriteria2" class="form-control"></td>
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
								<td><input type="text" name="txtCriteria3" class="form-control"></td>
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
								<td><input type="text" name="txtCriteria4" class="form-control"></td>
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
								<td><input type="text" name="txtCriteria5" class="form-control"></td>
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
						</table>
					</div> <!--Col 9 -->
				</div>
			</form>
			</div>
		</div>
	</div>
</div>