<script>
function printPayslip(id){
	window.open('<?php echo base_url();?>reports/print_payslip?id='.concat(id),'mywindow','width=800,height=600,menubar=no,statusbar=no,resizable=no');
}
</script>
<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class='active'>Payroll</li>           
    </ol>
    <div class="container-fluid">
		<div class="panel panel-info">
			<div class="panel-heading">
			    <div class="row">
					<form action="<?php echo base_url();?>payroll/payroll_index" id="frmSearch" method="post">
						<div class="form-horizontal">
							<div class="col-sm-6">
								<h1 class="panel-title big">Payroll </h1>
							</div>
							<div class="col-sm-2 text-right">
								<label class="control-label">Cut-off date:</label>
							</div>
							<div class="col-sm-2">
								<select name="cboDate" class="form-control">
									<option value="0">Select date</option>
									<?php foreach($salary_dates as $row){ ?>
										<option value="<?php echo $row->payslip_date ?>"<?php if($post['cboDate']==$row->payslip_date) echo " selected='selected'"; ?>><?php echo $row->payslip_date_format; ?></option>
									<?php } ?>s
								</select>
							</div>
							<div class="col-sm-2 text-center">
								<input type="submit" class="btn btn-success" name="btnSubmit" value="View">
							</div>
						</div>
			    	</form>
			    </div>		    
			</div>
			<div class="panel-body">
				<div class="pull-left add-employee">
					<a href="<?php echo base_url();?>payroll/add_payslip">
						<div class="btn btn-success"><i class="fa fa-plus"></i> Add New Payslip </div>
					</a>
					&nbsp;
					<a href="<?php echo base_url();?>payroll/multiple_payslips">
						<div class="btn btn-success"><i class="fa fa-plus"></i> Add Multiple Payslips </div>
					</a>
				</div>
				<div class="pull-right">
				
					<?php
					if(isset($links)) echo $links; 
					?>
				</div> 
				<table class="table table-striped table-hover table-bordered table-condensed ">				
					<thead >
						<th class="col-md-1 text-center">Emp ID</th>
						<th class="col-md-3 text-center">Employee Name</th>
						<th class="col-md-2 text-center">Basic Salary</th>
						<th class="col-md-2 text-center">Gross Pay</th>
						<th class="col-md-2 text-center">Net Pay</th>
						<th class="col-md-2 text-center">Print</th>
					</thead>
					<?php foreach($payslip as $row){ ?>
					<tr>
						<td class="col-md-1 text-center"><?php echo $row->emp_id; ?></td>
						<td class="col-md-3"><?php echo $row->last_name . ", " . $row->first_name . " " . $row->middle_name; ?></td>
						<td class="col-md-2 text-right"><?php echo $row->basic_salary; ?></td>
						<td class="col-md-2 text-right"><?php echo $row->gross_pay; ?></td>
						<td class="col-md-2 text-right"><?php echo $row->net_pay; ?></td>
						<td class="col-md-2 text-center">
							<!--a href="<?php echo base_url();?>attendance/print_payslip?id=<?php echo $row->payslip_id; ?>"-->
							<button class="btn btn-info btn-xs" onClick=printPayslip(<?php echo $row->payslip_id; ?>) data-toggle="tooltip" data-placement="top" title="Print">
								<i class="fa fa-calendar"></i>
							</button>
						</td>
					</tr>
					<?php } ?>
				</table>	
			</div>	
		</div>
	</div>
</div>
