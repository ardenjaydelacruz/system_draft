<script>
$(function() {
	$(".datepicker").datepicker();
	$("#btnGenerate").on('click',function(){
		$("#frmGenerate").attr("action", "<?php echo base_url();?>attendance/add_payslip?generate=true");
		$("#frmGenerate").submit();
	});
});
</script>
<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url();?>attendance/payroll" class="btn btn-default"><i class="fa fa-user"></i> Payroll</a></li>
        <li class="active"><i class="fa fa-search"></i> Generate Employee Payslip </li>
    </ol>
	<div class="container-fluid">
		<div class="panel panel-info">
			<div class="panel-heading">
			    <div class="row">
			    	<form action="<?php echo base_url();?>attendance/add_payslip" id="frmGenerate" method="post">
					<div class="col-sm-3">
			    		<div class="row">
							<label for="cboEmployee" class="control-label col-sm-3">Employee: </label>
							<div class="col-sm-3 error"><?php echo form_error('cboEmployee') ?></div>
							<?php if(isset($post)){ ?>
								<input type="hidden" name="hidID" value="<?php echo $post['cboEmployee']; ?>" />
								<input type="hidden" name="hidPayDate" value="<?php echo $post['txtPayrollDate']; ?>" />
								<input type="hidden" name="hidPayStart" value="<?php echo $post['txtStartDate']; ?>" />
								<input type="hidden" name="hidPayEnd" value="<?php echo $post['txtEndDate']; ?>" />
							<?php } ?>
						</div>
						<div class="input-group">
							<select name="cboEmployee" class="form-control">
								<?php foreach($employees as $row){ ?>
									<option value="<?php echo $row->emp_id ?>"<?php if(set_value('cboEmployee')==$row->emp_id) echo " selected='selected'"; ?>><?php echo $row->first_name . " " . $row->last_name ?></option>
								<?php } ?>
							</select>
						</div>	
			    	</div>
					<div class="col-sm-2">
			    		<div class="row">
							<label for="txtPayrollDate" class="control-label">Payroll Date: </label>
							<div class="col-sm-2 error"><?php echo form_error('txtPayrollDate') ?></div>
						</div>
						<div class="input-group">
							<input type="date" class="form-control" name="txtPayrollDate" <?php if(isset($date)) echo 'value="' . $date . '"';?>/>
						</div>
			    	</div>
			    	<div class="col-sm-2">
			    		<div class="row">
							<label for="txtStartDate" class="control-label">Start Date: </label>
							<div class="col-sm-2 error"><?php echo form_error('txtStartDate') ?></div>
						</div>
						<div class="input-group">
							<input type="date" class="form-control" name="txtStartDate" <?php if(isset($date)) echo 'value="' . $date . '"';?>/>
						</div>
			    	</div>
					<div class="col-sm-2">
			    		<div class="row">
							<label for="txtEndDate" class="control-label">End Date: </label>
							<div class="col-sm-2 error"><?php echo form_error('txtEndDate') ?></div>
						</div>
						<div class="input-group">
							<input type="date" class="form-control" name="txtEndDate" <?php if(isset($date)) echo 'value="' . $date . '"';?>/>
						</div>
			    	</div>
					<div class="col-sm-3">
						<div class="signupButtons text-right">
							<input type="submit" class="btn btn-success btn-lg" name="btnSubmit" value="View">
						</div>
					</div>
			    	</form>
			    </div>		    
			</div>
			<div class="panel-body">
				<div class="col-md-12">					              
					<div class="panel panel-default">		
						<div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab_1" data-toggle="tab">Payslip Advice</a></li>
								<li><a href="#tab_2" data-toggle="tab">Attendance</a></li>
								<li><a href="#tab_3" data-toggle="tab">Allowances</a></li>  
								<li><a href="#tab_4" data-toggle="tab">Taxes</a></li>                                  
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="tab_1">
									<div class="form-horizontal">
										<table class="table table-bordered table-hover">
											<tr class="success">
												<th class="col-md-2">Employee No.:</th>
												<th class="col-md-3"><?php if(isset($record["employee"]->emp_id)) echo $record["employee"]->emp_id; ?></th>
												<th class="col-md-1">&nbsp;</th>
												<th class="col-md-2">Name:</th>
												<th class="col-md-3"><?php if(isset($record["employee"]->last_name)) echo $record["employee"]->last_name . ", " . $record["employee"]->first_name . " " . $record["employee"]->middle_name; ?></th>
											</tr>
											<tr class="success">
												<th class="col-md-2">Pay Date:</th>
												<th class="col-md-3"><?php if(isset($post)) echo $post['txtPayrollDate']; ?>&nbsp;</th>
												<th class="col-md-1">&nbsp;</th>
												<th class="col-md-2">Pay Coverage:</th>
												<th class="col-md-3"><?php if(isset($post)) echo $post['txtStartDate'] . " - " . $post['txtEndDate']; ?>&nbsp;</th>
											</tr>
											<tr class="success">
												<th class="col-md-2">Monthly Rate:</th>
												<th class="col-md-3">PHP <?php echo number_format((isset($record["employee"]->salary))?$record["employee"]->salary:0, 2, ".", ","); ?></th>
												<th class="col-md-1">&nbsp;</th>
												<td class="col-md-2">&nbsp;</td>
												<td class="col-md-3">&nbsp;</td>
											</tr>
											<tr>
												<td class="col-md-2">Basic Pay:</td>
												<td class="col-md-3 text-right"><?php echo number_format((isset($record["employee"]->salary))?$record["employee"]->salary/2:0, 2, ".", ","); ?></td>
												<td class="col-md-1">&nbsp;</td>
												<td class="col-md-2">Less Taxes:</td>
												<td class="col-md-3 text-right"><?php echo number_format($record["total_tax"], 2, ".", ","); ?></td>
												
											</tr>
											<tr>
												<td class="col-md-2"><strong>Add</strong> Allowances:</td>
												<td class="col-md-3 text-right"><?php echo number_format($record["total_allowance"], 2, ".", ","); ?></td>
												<td class="col-md-1">&nbsp;</td>
												<td class="col-md-2">&nbsp;</td>
												<td class="col-md-3 text-right">&nbsp;</td>
											</tr>
											<tr>
												<td class="col-md-2">Adjustments:</td>
												<td class="col-md-3 text-right"><?php echo number_format($record["total_overtime"], 2, ".", ","); ?></td>
												<td class="col-md-1">&nbsp;</td>
												<td class="col-md-2">&nbsp;</td>
												<td class="col-md-3 text-right">&nbsp;</td>
											</tr>
											<tr>
												<td class="col-md-2">Night Diff'l:</td>
												<td class="col-md-3 text-right">0.00</td>
												<td class="col-md-1">&nbsp;</td>
												<td class="col-md-2">&nbsp;</td>
												<td class="col-md-3 text-right">&nbsp;</td>
											</tr>
											<tr>
												<td class="col-md-2"><strong>Less</strong> Tardiness:</td>
												<td class="col-md-3 text-right"><?php echo number_format($record["total_tardiness"], 2, ".", ","); ?></td>
												<td class="col-md-1">&nbsp;</td>
												<td class="col-md-2">&nbsp;</td>
												<td class="col-md-3 text-right">&nbsp;</td>
											</tr>
											<tr>
												<td class="col-md-2">Absent (<?php echo $record["total_absent"]; ?> Days):</td>
												<td class="col-md-3 text-right"><?php echo number_format($record["total_absent_amount"], 2, ".", ","); ?></td>
												<td class="col-md-1">&nbsp;</td>
												<td class="col-md-2">&nbsp;</td>
												<td class="col-md-3 text-right">&nbsp;</td>
											</tr>
											<tr>
												<td class="col-md-2">Undertime:</td>
												<td class="col-md-3 text-right">0.00</td>
												<td class="col-md-1">&nbsp;</td>
												<td class="col-md-2">&nbsp;</td>
												<td class="col-md-3 text-right">&nbsp;</td>
											</tr>
											<tr class="active">
												<th class="col-md-2">Gross Income:</th>
												<th class="col-md-3 text-right"><?php echo number_format($record["gross_income"], 2, ".", ","); ?></th>
												<th class="col-md-1">&nbsp;</th>
												<th class="col-md-2">Net Income:</th>
												<th class="col-md-3 text-right"><?php echo number_format($record["net_income"], 2, ".", ","); ?></th>
											</tr>
										</table>
									</div>			                                       			                                   
								</div><!-- /.tab-pane1 -->

								<div class="tab-pane" id="tab_2">
									<div class="form-horizontal">
										<table class="table table-striped table-hover table-bordered table-condensed ">				
											<thead >
												<th class="col-md-1 text-center">Date</th>
												<th class="col-md-1 text-center">Day</th>
												<th class="col-md-1 text-center">Time In</th>
												<th class="col-md-1 text-center">Time Out</th>
												<th class="col-md-1 text-center">Man Hours</th>
												<th class="col-md-1 text-center">Late (Mins)</th>
												<th class="col-md-1 text-center">Overtime</th>
												<th class="col-md-1 text-center">Remarks</th>
											</thead>
											<?php foreach($record["attendance"] as $row){ ?>
											<tr>
												<td class="col-md-1 text-center"><?php echo $row["datelog"]?></td>
												<td class="col-md-1 text-center"><?php echo $row["weekday"]?></td>
												<td class="col-md-1 text-center"><?php echo $row["time_in"]?></td>
												<td class="col-md-1 text-center"><?php echo $row["time_out"]?></td>
												<td class="col-md-1 text-center"><?php echo $row["man_hours"]?></td>
												<td class="col-md-1 text-center"><?php echo $row["tardiness"]?></td>
												<td class="col-md-1 text-center"><?php echo $row["overtime"]?></td>
												<td class="col-md-1 text-center">&nbsp;</td>
											</tr>
											<?php } ?>
										</table>	
									</div>
								</div><!-- /.tab-pane2 -->
								
								<div class="tab-pane" id="tab_3">
									<div class="form-horizontal">
										<table class="table table-striped table-hover table-bordered table-condensed ">				
											<thead >
												<th class="col-md-2">Type</th>
												<th class="col-md-2">Percentage</th>
												<th class="col-md-2">Computation</th>
												<th class="col-md-2">Amount</th>
												<th class="col-md-2">Total</th>
											</thead>
											<?php foreach($record["allowances"] as $row){ ?>
											<tr>
												<td class="col-md-2"><?php echo $row->allowance_name?></td>
												<td class="col-md-2 text-right"><?php echo $row->percentage*100?>%</td>
												<td class="col-md-2 text-right"><?php echo number_format($row->computation, 2, ".", ",")?></td>
												<td class="col-md-2 text-right"><?php echo $row->amount?></td>
												<td class="col-md-2 text-right"><?php echo number_format($row->total, 2, ".", ",")?></td>
											</tr>
											<?php } ?>
										</table>	
									</div>	
								  </div><!-- /.tab-pane3 -->

								<div class="tab-pane" id="tab_4">
									<div class="form-horizontal">
										<table class="table table-striped table-hover table-bordered table-condensed ">				
											<thead >
												<th class="col-md-2">Type</th>
												<th class="col-md-2">Percentage</th>
												<th class="col-md-2">Computation</th>
												<th class="col-md-2">Amount</th>
												<th class="col-md-2">Total</th>
											</thead>
											<?php foreach($record["taxes"] as $row){ ?>
											<tr>
												<td class="col-md-2"><?php echo $row->tax_name?></td>
												<td class="col-md-2 text-right"><?php echo $row->percentage*100?>%</td>
												<td class="col-md-2 text-right"><?php echo number_format($row->computation, 2, ".", ",")?></td>
												<td class="col-md-2 text-right"><?php echo $row->amount?></td>
												<td class="col-md-2 text-right"><?php echo number_format($row->total, 2, ".", ",")?></td>
											</tr>
											<?php } ?>
										</table>		
									</div>	
								</div><!-- /.tab-content4 -->
							</div><!-- nav-tabs-custom -->    
						</div>
						<div class="col-md-12 text-center">
							<button id="btnGenerate" class="btn btn-success btn-lg" data-toggle="tooltip" data-placement="top" title="Generate Payslip">
							<i class="fa fa-check fa-lg">Generate Payslip</i></button>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>