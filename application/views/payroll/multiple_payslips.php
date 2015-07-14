<script>
$(function() {
	$(".datepicker").datepicker();
	$("#btnGenerate").on('click',function(){
		$("#frmGenerate").attr("action", "<?php echo base_url();?>attendance/multiple_payslips?generate=true");
		$("#frmGenerate").submit();
	});
});
</script>
<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url();?>attendance/payroll" class="btn btn-default"><i class="fa fa-user"></i> Payroll</a></li>
        <li class="active"><i class="fa fa-search"></i> Generate Multiple Payslips </li>
    </ol>
	<div class="container-fluid">
		<div class="panel panel-info">
			<div class="panel-heading">
			    <div class="row">
			    	<form action="<?php echo base_url();?>attendance/multiple_payslips" id="frmGenerate" method="post">
					<div class="col-sm-2">
			    		<div class="row">
							<label for="txtPayrollDate" class="control-label">Payroll Date: </label>
							<div class="col-sm-2 error"><?php echo form_error('txtPayrollDate') ?></div>
							<?php if(isset($post)){ ?>
								<input type="hidden" name="hidPayDate" value="<?php echo $post['txtPayrollDate']; ?>" />
								<input type="hidden" name="hidPayStart" value="<?php echo $post['txtStartDate']; ?>" />
								<input type="hidden" name="hidPayEnd" value="<?php echo $post['txtEndDate']; ?>" />
							<?php } ?>
						</div>
						<div class="input-group">
							<input type="text" class="datepicker" name="txtPayrollDate" <?php if(isset($date)) echo 'value="' . $date . '"';?>/>
						</div>
			    	</div>
			    	<div class="col-sm-2">
			    		<div class="row">
							<label for="txtStartDate" class="control-label">Start Date: </label>
							<div class="col-sm-2 error"><?php echo form_error('txtStartDate') ?></div>
						</div>
						<div class="input-group">
							<input type="text" class="datepicker" name="txtStartDate" <?php if(isset($date)) echo 'value="' . $date . '"';?>/>
						</div>
			    	</div>
					<div class="col-sm-2">
			    		<div class="row">
							<label for="txtEndDate" class="control-label">End Date: </label>
							<div class="col-sm-2 error"><?php echo form_error('txtEndDate') ?></div>
						</div>
						<div class="input-group">
							<input type="text" class="datepicker" name="txtEndDate" <?php if(isset($date)) echo 'value="' . $date . '"';?>/>
						</div>
			    	</div>
					<div class="col-sm-6">
						<div class="signupButtons text-right">
							<input type="submit" class="btn btn-success btn-lg" name="btnSubmit" value="View">
						</div>
					</div>
			    	</form>
			    </div>		    
			</div>
			<div class="panel-body">
				<div class="col-md-12 text-center">
					<table class="table table-striped table-hover table-bordered table-condensed ">				
						<thead >
							<th class="col-md-1 text-center">Emp ID</th>
							<th class="col-md-3 text-center">Employee Name</th>
							<th class="col-md-2 text-center">Basic Salary</th>
							<th class="col-md-2 text-center">Gross Pay</th>
							<th class="col-md-2 text-center">Net Pay</th>
						</thead>
						<?php foreach($payslips as $row){ ?>
						<tr>
							<td class="col-md-1 text-center"><?php echo $row["employee"]->emp_id; ?></td>
							<td class="col-md-3"><?php echo $row["employee"]->last_name . ", " . $row["employee"]->first_name . " " . $row["employee"]->middle_name; ?></td>
							<td class="col-md-2 text-right"><?php echo number_format($row["cutoffsalary"], 2, ".", ","); ?></td>
							<td class="col-md-2 text-right"><?php echo number_format($row["gross_income"], 2, ".", ","); ?></td>
							<td class="col-md-2 text-right"><?php echo number_format($row["net_income"], 2, ".", ","); ?></td>
						</tr>
						<?php } ?>
					</table>	
					<button id="btnGenerate" class="btn btn-success btn-lg" data-toggle="tooltip" data-placement="top" title="Generate Payslip">
					<i class="fa fa-check fa-lg">Generate Payslip</i></button>
				</div>
			</div>	
		</div>
	</div>
</div>