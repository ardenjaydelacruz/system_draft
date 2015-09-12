<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url();?>payroll/payroll_index" class="btn btn-default"><i class="fa fa-user"></i> Payroll</a></li>
        <li class="active"><i class="fa fa-search"></i> Generate Employee Payslip </li>
    </ol>
	<div class="container-fluid">
		<div class="panel panel-info">
			<form action="<?php echo base_url();?>payroll/add_payslip" method="post">
			<div class="panel-heading">
			    <div class="row">
					<div class="col-sm-3">
			    		<div class="row">
							<label for="cboEmployee" class="control-label col-sm-3">Employee: </label>
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
							<label for="txtPayrollDate" class="control-label">Pay Date: </label>
							<div class="col-sm-2 error"><?php echo form_error('txtPayrollDate') ?></div>
						</div>
						<div class="input-group">
							<input type="date" class="form-control input-sm" name="txtPayrollDate" value="<?php echo set_value('txtPayrollDate'); ?>">
						</div>
			    	</div>
			    	<div class="col-sm-2">
			    		<div class="row">
							<label for="txtStartDate" class="control-label">Start Date: </label>
							<div class="col-sm-2 error"><?php echo form_error('txtStartDate') ?></div>
						</div>
						<div class="input-group">
							<input type="date" class="form-control input-sm" name="txtStartDate" value="<?php echo set_value('txtStartDate'); ?>">
						</div>
			    	</div>
					<div class="col-sm-2">
			    		<div class="row">
							<label for="txtEndDate" class="control-label">End Date: </label>
							<div class="col-sm-2 error"><?php echo form_error('txtEndDate') ?></div>
						</div>
						<div class="input-group">
							<input type="date" class="form-control input-sm" name="txtEndDate" value="<?php echo set_value('txtEndDate'); ?>">
						</div>
			    	</div>
					<div class="col-sm-3">
						<div class="signupButtons text-right">
							<input type="submit" class="btn btn-success btn-lg" name="btnSubmit" value="View">
						</div>
					</div>
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
								<input type="hidden" name="hidTotalEmp" value="1" />
								<input type="hidden" name="chkEmp1" value="<?php echo $this->session->userdata('employee_id'); ?>" />
								<div class="tab-pane active" id="tab_1">
									<div class="form-horizontal">
										<table class="table table-bordered table-hover">
											<tr class="success">
												<th class="col-md-2">
													Name:
												</th>
												<th class="col-md-3">
													<?php if(isset($record["employee"]->last_name)) echo $record["employee"]->last_name . ", " . $record["employee"]->first_name . " " . $record["employee"]->middle_name; ?>
												</th>
												<th class="col-md-1">
													&nbsp;
												</th>
												<th class="col-md-2">
													Employee No.:
												</th>
												<th class="col-md-3">
												<?php if(isset($post)){ ?>
													<input type="hidden" name="hidID1" value="<?php echo set_value('cboEmployee'); ?>" />
													<?php if(isset($record["employee"]->emp_id)) echo $record["employee"]->emp_id; ?>
												<?php } ?>
												</th>
											</tr>
											<tr class="success">
												<th class="col-md-2">
													Job Title:
												</th>
												<th class="col-md-3">
													<?php if(isset($record["employee"]->job_title_name)) echo $record["employee"]->job_title_name; ?></th>
												<th class="col-md-1">
													&nbsp;
												</th>
												<th class="col-md-2">
													Department:
												</th>
												<th class="col-md-3">
													<?php if(isset($record["employee"]->department_name)) echo $record["employee"]->department_name; ?>
												</th>
											</tr>
											<tr class="success">
												<th class="col-md-2">
													Pay Date:
												</th>
												<th class="col-md-3">
													<input type="hidden" name="hidPayDate" value="<?php echo set_value('txtPayrollDate'); ?>" />
													<?php if(isset($post)) echo $post['txtPayrollDate']; ?>&nbsp;
												</th>
												<th class="col-md-1">
													&nbsp;
												</th>
												<th class="col-md-2">
													Pay Coverage:
												</th>
												<th class="col-md-3">
												<?php if(isset($post)){ ?>
													<input type="hidden" name="hidPayStart" value="<?php echo set_value('txtStartDate'); ?>" />
													<input type="hidden" name="hidPayEnd" value="<?php echo set_value('txtEndDate'); ?>" />
													<?php if(isset($post)) echo $post['txtStartDate'] . " - " . $post['txtEndDate']; ?>&nbsp;
												<?php } ?>
												</th>
											</tr>
											<tr class="success">
												<th class="col-md-2">
													Monthly Rate:
												</th>
												<th class="col-md-3">
												<?php if(isset($post)){ ?>
													<input type="hidden" name="hidMonthlyRate1" value="<?php echo $record["employee"]->salary; ?>" />
													PHP <?php echo number_format((isset($record["employee"]->salary))?$record["employee"]->salary:0, 2, ".", ","); ?>
												<?php } ?>
												</th>
												<th class="col-md-1">
													&nbsp;
												</th>
												<td class="col-md-2">
													&nbsp;
												</td>
												<td class="col-md-3">
													&nbsp;
												</td>
											</tr>
											<tr>
												<td class="col-md-2">
													Semi-Monthly Pay:
												</td>
												<td class="col-md-3 text-right">
												<?php if(isset($post)){ ?>
													<input type="hidden" name="hidBasicSalary1" value="<?php echo $record["employee"]->salary/2; ?>" />
													<?php echo number_format((isset($record["employee"]->salary))?$record["employee"]->salary/2:0, 2, ".", ","); ?>
												<?php } ?>
												</td>
												<td class="col-md-1">
													&nbsp;
												</td>
												<td class="col-md-2">
													Less Taxes:
												</td>
												<td class="col-md-3 text-right">
													<input type="hidden" name="hidTotalTax1" value="<?php echo $record["total_tax"]; ?>" />
													<p name="pTax1">
													<?php echo number_format($record["total_tax"], 2, ".", ","); ?>
													</p>
												</td>
												
											</tr>
											<tr>
												<td class="col-md-2">
													<strong>Add</strong> Allowances:
												</td>
												<td class="col-md-3 text-right">
													<input type="hidden" name="hidTotalAllowance1" value="<?php echo $record["total_allowance"]; ?>" />
													<p name="pAllowance1">
													<?php echo number_format($record["total_allowance"], 2, ".", ","); ?>
													</p>
												</td>
												<td class="col-md-1">
													&nbsp;
												</td>
												<td class="col-md-2">
													&nbsp;
												</td>
												<td class="col-md-3 text-right">
													&nbsp;
												</td>
											</tr>
											<tr>
												<td class="col-md-2">
													Adjustments:</td>
												<td class="col-md-3 text-right">
													<input type="hidden" name="hidTotalOvertime1" value="<?php echo $record["total_overtime"]; ?>" />
													<?php echo number_format($record["total_overtime"], 2, ".", ","); ?>
												</td>
												<td class="col-md-1">
													&nbsp;
												</td>
												<td class="col-md-2">
													&nbsp;
												</td>
												<td class="col-md-3 text-right">
													&nbsp;
												</td>
											</tr>
											<tr>
												<td class="col-md-2">
													Night Diff'l:
												</td>
												<td class="col-md-3 text-right">
													0.00
												</td>
												<td class="col-md-1">
													&nbsp;
												</td>
												<td class="col-md-2">
													&nbsp;
												</td>
												<td class="col-md-3 text-right">
													&nbsp;
												</td>
											</tr>
											<tr>
												<td class="col-md-2">
													<strong>Less</strong> Tardiness:
												</td>
												<td class="col-md-3 text-right">
													<input type="hidden" name="hidTotalTardiness1" value="<?php echo $record["total_tardiness"]; ?>" />
													<?php echo number_format($record["total_tardiness"], 2, ".", ","); ?>
												</td>
												<td class="col-md-1">
													&nbsp;
												</td>
												<td class="col-md-2">
													&nbsp;
												</td>
												<td class="col-md-3 text-right">
													&nbsp;
												</td>
											</tr>
											<tr>
												<td class="col-md-2">
													<input type="hidden" name="hidTotalAbsent1" value="<?php echo $record["total_absent"]; ?>" />
													Absent (<?php echo $record["total_absent"]; ?> Days):
												</td>
												<td class="col-md-3 text-right">
													<input type="hidden" name="hidTotalAbsentAmount1" value="<?php echo $record["total_absent_amount"]; ?>" />
													<?php echo number_format($record["total_absent_amount"], 2, ".", ","); ?>
												</td>
												<td class="col-md-1">
													&nbsp;
												</td>
												<td class="col-md-2">
													&nbsp;
												</td>
												<td class="col-md-3 text-right">
													&nbsp;
												</td>
											</tr>
											<tr>
												<td class="col-md-2">
													Undertime:
												</td>
												<td class="col-md-3 text-right">
													0.00
												</td>
												<td class="col-md-1">
													&nbsp;
												</td>
												<td class="col-md-2">
													&nbsp;
												</td>
												<td class="col-md-3 text-right">
													&nbsp;
												</td>
											</tr>
											<tr class="active">
												<th class="col-md-2">
													Gross Income:
												</th>
												<th class="col-md-3 text-right">
													<input type="hidden" name="hidGrossIncome1" value="<?php echo $record["gross_income"]; ?>" />
													<p name="pGrossIncome1">
													<?php echo number_format($record["gross_income"], 2, ".", ","); ?>
													</p>
												</th>
												<th class="col-md-1">
													&nbsp;
												</th>
												<th class="col-md-2">
													Net Income:
												</th>
												<th class="col-md-3 text-right">
													<input type="hidden" name="hidNetIncome1" value="<?php echo $record["net_income"]; ?>" />
													<p name="pNetIncome1">
													<?php echo number_format($record["net_income"], 2, ".", ","); ?>
													</p>
												</th>
											</tr>
										</table>
									</div>			                                       			                                   
								</div><!-- /.tab-pane1 -->

								<div class="tab-pane" id="tab_2">
									<div class="form-horizontal">
										<table id="dynamicTable" class="table table-striped table-hover table-bordered table-condensed">				
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
												<td class="col-md-1 text-center"><?php echo $row->datelog?></td>
												<td class="col-md-1 text-center"><?php echo $row->weekday?></td>
												<td class="col-md-1 text-center"><?php echo $row->time_in?></td>
												<td class="col-md-1 text-center"><?php echo $row->time_out?></td>
												<td class="col-md-1 text-center"><?php echo $row->man_hours?></td>
												<td class="col-md-1 text-center"><?php echo $row->tardiness?></td>
												<td class="col-md-1 text-center"><?php echo $row->overtime?></td>
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
												<th class="col-md-1 text-center">Include</th>
												<th class="col-md-2 text-center">Type</th>
												<th class="col-md-1 text-center">Percentage</th>
												<th class="col-md-1 text-center">Computation</th>
												<th class="col-md-2 text-center">Monthly Amount</th>
												<th class="col-md-1 text-center">Total</th>
											</thead>
											<input type="hidden" name="hidAllowanceCount1" value="<?php echo count($record["allowances"]) ?>" />
											<?php $ctr=1; foreach($record["allowances"] as $row){ ?>
											<tr>
												<td class="col-md-1 text-center">
													<input type="checkbox" onclick="updateAllowance('1', <?php echo $ctr; ?>)" name="chkAllowance1-<?php echo $ctr; ?>" <?php if($row->active==1) echo 'checked'; ?>>
													<input type="hidden" name="hidAllowanceID1-<?php echo $ctr; ?>" value="<?php echo $row->allowance_id; ?>" />
												</td>
												<td class="col-md-2 text-left">
													<?php echo $row->allowance_name?>
												</td>
												<td class="col-md-1 text-right">
													<input type="hidden" name="hidAllowancePercentage1-<?php echo $ctr; ?>" value="<?php echo $row->percentage; ?>" />
													<?php echo $row->percentage*100?>%
												</td>
												<td class="col-md-1 text-right">
													<input type="hidden" name="hidAllowanceComputation1-<?php echo $ctr; ?>" value="<?php echo $row->computation; ?>" />
													<?php echo number_format($row->computation, 2, ".", ",")?>
												</td>
												<td class="col-md-2 text-right">
													<input type="hidden" name="hidAllowanceAmount1-<?php echo $ctr; ?>" value="<?php echo $row->amount; ?>" />
													<?php echo number_format($row->amount, 2, ".", ",")?>
												</td>
												<td class="col-md-1 text-right">
													<input type="text" class="form-control input-sm" onchange="updateAllowanceTotal('1', <?php echo $ctr; ?>)" name="txtAllowanceTotal1-<?php echo $ctr; ?>" value="<?php echo number_format($row->total, 2, ".", ",") ?>" <?php if($row->active==0) echo 'disabled'; ?>>
												</td>
											</tr>
											<?php $ctr++; } ?>
										</table>	
									</div>	
								  </div><!-- /.tab-pane3 -->

								<div class="tab-pane" id="tab_4">
									<div class="form-horizontal">
										<table class="table table-striped table-hover table-bordered table-condensed ">				
											<thead >
												<th class="col-md-1 text-center">Include</th>
												<th class="col-md-2 text-center">Type</th>
												<th class="col-md-1 text-center">Percentage</th>
												<th class="col-md-1 text-center">Computation</th>
												<th class="col-md-2 text-center">Monthly Amount</th>
												<th class="col-md-1 text-center">Total</th>
											</thead>
											<input type="hidden" name="hidTaxCount1" value="<?php echo count($record["taxes"]) ?>" />
											<?php $ctr=1; foreach($record["taxes"] as $row){ ?>
											<tr>
												<td class="col-md-1 text-center">
													<input type="checkbox" onclick="updateTax('1', <?php echo $ctr; ?>)" name="chkTax1-<?php echo $ctr; ?>" <?php if($row->active==1) echo 'checked'; ?>>
													<input type="hidden" name="hidTaxID1-<?php echo $ctr; ?>" value="<?php echo $row->tax_id; ?>" />
												</td>
												<td class="col-md-2"><?php echo $row->tax_name?></td>
												<?php if($row->ranges_active!=1){ ?>
													<td class="col-md-1 text-right">
														<input type="hidden" name="hidTaxPercentage1-<?php echo $ctr; ?>" value="<?php echo $row->percentage; ?>" />
														<?php echo $row->percentage*100?>%
													</td>
													<td class="col-md-1 text-right">
														<input type="hidden" name="hidTaxComputation1-<?php echo $ctr; ?>" value="<?php echo $row->computation; ?>" />
														<?php echo number_format($row->computation, 2, ".", ",")?>
													</td>
													<td class="col-md-2 text-right">
														<input type="hidden" name="hidTaxAmount1-<?php echo $ctr; ?>" value="<?php echo $row->amount; ?>" />
														<?php echo number_format($row->amount, 2, ".", ",")?>
													</td>
												<?php } else { ?>
													<td class="col-md-4 text-center" colspan="3">
														<i>Computed from salary</i>
													</td>
												<?php } ?>
												<td class="col-md-1 text-right">
													<input type="text" class="form-control input-sm" onchange="updateTaxTotal('1', <?php echo $ctr; ?>)" name="txtTaxTotal1-<?php echo $ctr; ?>" value="<?php echo number_format($row->total, 2, ".", ",") ?>" <?php if($row->active==0) echo 'disabled'; ?>>
												</td>
											</tr>
											<?php $ctr++; } ?>
										</table>		
									</div>	
								</div><!-- /.tab-content4 -->
							</div><!-- nav-tabs-custom -->    
						</div>
						<?php if ($this->input->post('btnSubmit')) {  ?>
						<div class="col-md-12 text-center">
							<input type="submit" class="btn btn-success btn-lg" name="btnGenerate" value="Generate">
						</div>
						<?php }  ?>
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>