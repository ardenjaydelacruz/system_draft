<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url();?>payroll/payroll_index" class="btn btn-default"><i class="fa fa-user"></i> Payroll</a></li>
        <li class="active"><i class="fa fa-search"></i> Upload Attendance </li>
    </ol>
	<div class="container-fluid">
		<div class="panel panel-info">
			<div class="panel-heading">
			    <div class="row">
					<?php echo form_open_multipart('payroll/attendance_upload'); ?>
					<div class="col-sm-6">
			    		<div class="row">
							<label for="cboEmployee" class="control-label col-sm-6">Select CSV file: </label>
							<div class="col-sm-6 error"><?php echo form_error('cboEmployee') ?></div>
						</div>
						<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
							<?php echo form_upload('userfile'); ?>
						</div>	
			    	</div>
					<div class="col-sm-6">
						<div class="signupButtons text-center">
							<?php echo form_submit('btnUpload','Upload'); ?>
						</div>
					</div>
			    	<?php echo form_close(); ?>
			    </div>		    
			</div>
			<div class="panel-body">
				<?php if ($this->input->post('btnUpload')) { if(isset($error)) echo $error; ?>
				<?php echo form_open('payroll/attendance_upload'); ?>
				<input type="hidden" name="hidPath" value="<?php echo $csv['full_path']?>"/>
				<table id="dynamicTable" class="table table-striped table-hover table-bordered table-condensed ">				
					<thead >
						<th class="text-center">#</th>
						<th class="col-md-3 text-center">Name</th>
						<th class="col-md-3 text-center">Emp No.</th>
						<th class="col-md-3 text-center">Date Time</th>
						<th class="col-md-3 text-center">Event</th>
					</thead>
					<?php $ctr=1; foreach($csvData as $day){ ?>
					<tr>
						<td class="text-center"><?php echo $ctr?></td>
						<td class="col-md-3 text-center"><?php echo $day['Name']?></td>
						<td class="col-md-3 text-center"><?php echo $day['No.']?></td>
						<td class="col-md-3 text-center"><?php echo $day['Date/Time']?></td>
						<td class="col-md-3 text-center"><?php echo $day['Status']?></td>
					</tr>
					<?php $ctr++; } ?>
				</table>
				<div class="signupButtons text-center">
					<?php echo form_submit('btnSave','Save records'); ?>
				</div>
			    <?php echo form_close(); ?>
				<?php } ?>
			</form>
			</div>
		</div>
	</div>
</div>