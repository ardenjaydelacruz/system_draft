<link rel="icon" href="<?php echo base_url();?>assets/images/favicon.ico" type="image/x-icon">
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/sidebar.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/sweetalert.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/toastr.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/loader.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/dropzone.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/morris.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/rate.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery-ui.structure.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery-ui.theme.min.css">
<script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-ui.min.js"></script>
<script src="<?php echo base_url();?>assets/js/loader.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
<script src="<?php echo base_url();?>assets/js/toastr.min.js"></script>
<script src="<?php echo base_url();?>assets/js/app.min.js" type="text/javascript"></script> <!-- Admin LTE -->
<script src="<?php echo base_url();?>assets/js/dropzone.js"></script>
<script src="<?php echo base_url();?>assets/plugins/morris.js"></script>
<script src="<?php echo base_url();?>assets/plugins/rate.js"></script>
<script src="<?php echo base_url();?>assets/js/custom.js"></script>
<style>
.panel-body{
    -moz-box-shadow: 0 0 2px black;
    -webkit-box-shadow: 0 0 2px black;
    box-shadow: 0 0 2px black;
}
</style>
<title>Payslip Details - MSInc.</title>
<br>
<div class="container-fluid">
	<div class="panel panel-info">
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-12">	
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
							<th class="col-md-3"><?php echo $record["payslip"]->payslip_date_format; ?></th>
							<th class="col-md-1">&nbsp;</th>
							<th class="col-md-2">Pay Coverage:</th>
							<th class="col-md-3"><?php echo $record["payslip"]->start_date_format . " - " . $record["payslip"]->end_date_format; ?></th>
						</tr>
						<tr class="success">
							<th class="col-md-2">Monthly Rate:</th>
							<th class="col-md-3">PHP <?php echo number_format($record["employee"]->salary, 2, ".", ","); ?></th>
							<th class="col-md-1">&nbsp;</th>
							<td class="col-md-2">&nbsp;</td>
							<td class="col-md-3">&nbsp;</td>
						</tr>
						<tr>
							<td class="col-md-2">Basic Pay:</td>
							<td class="col-md-3 text-right"><?php echo number_format($record["payslip"]->basic_salary, 2, ".", ","); ?></td>
							<td class="col-md-1">&nbsp;</td>
							<td class="col-md-2">Tardiness:</td>
							<td class="col-md-3 text-right"><?php echo number_format($record["payslip"]->total_tardiness, 2, ".", ","); ?></td>
						</tr>
						<tr>
							<td class="col-md-2">Adjustments:</td>
							<td class="col-md-3 text-right"><?php echo number_format($record["payslip"]->total_overtime, 2, ".", ","); ?></td>
							<td class="col-md-1">&nbsp;</td>
							<td class="col-md-2">Absences:</td>
							<td class="col-md-3 text-right"><?php echo number_format($record["payslip"]->total_absent_amount, 2, ".", ","); ?></td>
						</tr>
						<tr>
							<td class="col-md-2">Night Diff'l:</td>
							<td class="col-md-3 text-right">0.00</td>
							<td class="col-md-1">&nbsp;</td>
							<td class="col-md-2">Undertime:</td>
							<td class="col-md-3 text-right">0.00</td>
						</tr>
						<tr>
							<td class="col-md-2"><strong>Allowances:</strong></td>
							<td class="col-md-3 text-right"><?php echo number_format($record["payslip"]->total_allowances, 2, ".", ","); ?></td>
							<td class="col-md-1">&nbsp;</td>
							<td class="col-md-2"><strong>Taxes:</strong>:</td>
							<td class="col-md-3 text-right"><?php echo number_format($record["payslip"]->total_taxes, 2, ".", ","); ?></td>
						</tr>
						<?php for($ctr=0; $ctr<count($record["payslip_allowances"]) or $ctr<count($record["payslip_taxes"]); $ctr++){ ?>
						<tr>
							<td class="col-md-2"><?php if($ctr<count($record["payslip_allowances"])) echo $record["payslip_allowances"][$ctr]->allowance_id; ?></td>
							<td class="col-md-3 text-right"><?php if($ctr<count($record["payslip_allowances"])) echo number_format($record["payslip_allowances"][$ctr]->total, 2, ".", ","); ?></td>
							<td class="col-md-1">&nbsp;</td>
							<td class="col-md-2"><?php if($ctr<count($record["payslip_taxes"])) echo $record["payslip_taxes"][$ctr]->tax_id; ?></td>
							<td class="col-md-3 text-right"><?php if($ctr<count($record["payslip_taxes"])) echo number_format($record["payslip_taxes"][$ctr]->total, 2, ".", ","); ?></td>
						</tr>
						<?php } ?>
						<tr class="active">
							<th class="col-md-2">Gross Income:</th>
							<th class="col-md-3 text-right"><?php echo number_format($record["payslip"]->gross_pay, 2, ".", ","); ?></th>
							<th class="col-md-1">&nbsp;</th>
							<th class="col-md-2">Net Income:</th>
							<th class="col-md-3 text-right"><?php echo number_format($record["payslip"]->net_pay, 2, ".", ","); ?></th>
						</tr>
					</table>
				</div>
			</div>	
		</div>		
	</div>
</div>
