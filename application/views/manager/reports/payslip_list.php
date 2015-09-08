<script>
function printPayslip(id){
	window.open('<?php echo base_url();?>reports/print_payslip?id='.concat(id),'mywindow','width=800,height=600,menubar=no,statusbar=no,resizable=no');
}
</script>
<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ems/hr_dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class='active'>Payslip</li>           
    </ol>
    <div class="container-fluid">
		<div class="panel panel-info">
			<div class="panel-heading">
                <div class="row">
                    <div class="col-sm-8">
                        <h1 class="panel-title big">Payslip</h1>
                    </div>
                </div>
            </div>
            <div class="panel-body">
				<form action="<?php echo base_url();?>reports/payslip_list" role="form" method="post">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-header pull-left">
                            <h4>Filter By:</h4>
                        </div>
                        <div class="pull-right">
                            <input type="submit" name="btnFilter" value="Filter" class="btn btn-success btn-lg">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="status">Cutoff Date:</label>
                            <select name="cboDate" class="form-control">
								<option value="0">Select date</option>
								<?php foreach($salary_dates as $row){ ?>
									<option value="<?php echo $row->payslip_date ?>"<?php if($post['cboDate']==$row->payslip_date) echo " selected='selected'"; ?>><?php echo $row->payslip_date_format; ?></option>
								<?php } ?>s
							</select>
                        </div>
                    </div>
                </div><br>
					<?php if ($this->input->post('btnFilter')) { ?>
					<div class="row">
						<div class="col-sm-12">
							<input type="submit" name="btnPrint" value="Print" class="btn btn-info">
						</div>
					</div><br>
					<?php } ?>
                </form>
				<?php if ($this->input->post('btnFilter')) { 
					$ctr=1; 
					$total_net_pay = 0; ?>
				<table class="table table-striped table-hover table-bordered table-condensed">
					<thead >
						<th class="text-center">#</th>
						<th class="col-md-1 text-center">Emp ID</th>
						<th class="col-md-3 text-center">Employee Name</th>
						<th class="col-md-1 text-center">Basic Salary</th>
						<th class="col-md-1 text-center">Overtime</th>
						<th class="col-md-1 text-center">Allowances</th>
						<th class="col-md-1 text-center">Gross Pay</th>
						<th class="col-md-1 text-center">Absences</th>
						<th class="col-md-1 text-center">Tardiness</th>
						<th class="col-md-1 text-center">Taxes</th>
						<th class="col-md-1 text-center">Net Pay</th>
					</thead>
					<?php foreach($payslip as $row){ ?>
					<tr>
						<td class="text-center"><?php echo $ctr;?></td>
						<td class="col-md-1 text-center"><?php echo $row->emp_id; ?></td>
						<td class="col-md-3">
							<a href="#" onClick=printPayslip(<?php echo $row->payslip_id; ?>) data-toggle="tooltip" data-placement="top">
							<?php echo $row->last_name . ", " . $row->first_name . " " . $row->middle_name; ?>
							</a>
						</td>
						<td class="col-md-1 text-right"><?php echo number_format($row->basic_salary, 2, ".", ","); ?></td>
						<td class="col-md-1 text-right"><?php echo number_format($row->total_overtime, 2, ".", ","); ?></td>
						<td class="col-md-1 text-right"><?php echo number_format($row->total_allowances, 2, ".", ","); ?></td>
						<td class="col-md-1 text-right"><?php echo number_format($row->gross_pay, 2, ".", ","); ?></td>
						<td class="col-md-1 text-right"><?php echo $row->days_absent; ?></td>
						<td class="col-md-1 text-right"><?php echo number_format($row->total_tardiness, 2, ".", ","); ?></td>
						<td class="col-md-1 text-right"><?php echo number_format($row->total_taxes, 2, ".", ","); ?></td>
						<td class="col-md-1 text-right"><?php echo number_format($row->net_pay, 2, ".", ","); ?></td>
						</td>
					</tr>
					<?php $total_net_pay+=$row->net_pay; 
						$ctr++;
					} ?>
					<thead>
						<th class="col-md-10 text-right" colspan="10">Total Net Pay</th>
						<th class="col-md-2 text-right" colspan="2"><?php echo number_format($total_net_pay, 2, ".", ","); ?></th>
						</td>
					</thead>
				</table>	
				<?php } ?>
			</div>	
		</div>
	</div>
</div>
