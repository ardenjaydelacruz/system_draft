<script>
$(function() {
	$("select").change(function () {
		$("#frmSearch").submit();
	}); 
});
function printPayslip(id){
	window.open('<?php echo base_url();?>attendance/print_payslip?id='.concat(id),'mywindow','width=800,height=600,menubar=no,statusbar=no,resizable=no');
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
			    	<div class="col-sm-7">
			    		<h1 class="panel-title big">Payroll </h1>
			    	</div>
					<form action="<?php echo base_url();?>attendance/payroll" id="frmSearch" method="post">
						<div class="form-horizontal"><label class="col-sm-2 control-label">Cut-off date:</label>
							<div class="col-xs-3 controls">
								<div class="row">
									<select name="cboDate" class="form-control" >
										<option value="0">Select date</option>
										<?php foreach($salary_dates as $row){ ?>
											<option class="form-control" value="<?php echo $row->payslip_date ?>"<?php if($post['cboDate']==$row->payslip_date) echo " selected='selected'"; ?>><?php echo $row->payslip_date_format; ?></option>
										<?php } ?>s
									</select>
								</div>
							</div>
						</div>
			    	</form>
			    </div>		    
			</div>
			<div class="panel-body">
				<div class="pull-left add-employee">
					<a href="<?php echo base_url();?>attendance/add_payslip">
						<buttom  class="btn btn-success"><i class="fa fa-plus"></i> Add New Payslip </buttom>
					</a>
					<a href="<?php echo base_url();?>attendance/multiple_payslips">
						<buttom  class="btn btn-success"><i class="fa fa-plus"></i> Add Multiple Payslips </buttom>
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
						<th class="col-md-2 text-center">Action</th>
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
							<!--/a-->
							<button class="btn btn-danger btn-xs" onclick=deletePayslip(<?php echo $row->payslip_id; ?>,'<?php echo base_url();?>attendance/'); data-toggle="tooltip" data-placement="top" title="Delete Payslip">
							<i class="fa fa-trash-o"></i>
						</button>
						</td>
					</tr>
					<?php } ?>
				</table>	
			</div>	
		</div>
	</div>
</div>
