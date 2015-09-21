<div class="content-wrapper">
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class='active'>Approve Request Entry</li>           
    </ol>
    <div class="container-fluid">
		<div class="panel panel-info">
			<div class="panel-heading">
			    <div class="row">
			    	<form action="<?php echo base_url();?>payroll/requestentry_table" method="post">
					<!--div class="col-sm-6">
			    		<div class="row">
							<label for="cboEmployee" class="control-label col-sm-6">Employee: </label>
							<div class="col-sm-6 error"><?php echo form_error('cboEmployee') ?></div>
						</div>
						<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
							&nbsp;
						</div>	
			    	</div-->
					<div class="col-sm-3">
			    		<div class="row">
							<label for="cboMonth" class="control-label col-sm-2">Month: </label>
							<div class="col-sm-2 error"><?php echo form_error('cboMonth') ?></div>
						</div>
						<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
							<select name="cboMonth" class="form-control">
								<?php foreach($months as $month){ ?>
									<option value="<?php echo $month['id'] ?>"<?php if(isset($post['cboMonth']) and $post['cboMonth']==$month['id']) echo " selected='selected'"; ?>><?php echo $month['value']?></option>
								<?php } ?>
							</select>
						</div>
			    	</div>
			    	<div class="col-sm-3">
			    		<div class="row">
							<label for="cboYear" class="control-label col-sm-2">Year: </label>
							<div class="col-sm-2 error"><?php echo form_error('cboYear') ?></div>
						</div>
						<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
							<select name="cboYear" class="form-control">
								<?php foreach($years as $year){ ?>
									<option value="<?php echo $year ?>"<?php if(isset($post['cboYear']) and $post['cboYear']==$year) echo " selected='selected'"; ?>><?php echo $year?></option>
								<?php } ?>
							</select>
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
				<div class="col-md-12">					              
					<div class="panel panel-default">	
						<div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
							<?php if($mode=='approved'){ ?>
								<li><a href="<?php echo base_url();?>payroll/requestentry_table">Pending</a></li>
								<li class="active"><a href="#">Approved</a></li>
								<li><a href="<?php echo base_url();?>payroll/requestentry_table?mode=declined">Declined</a></li>
							<?php } else if($mode=='declined'){ ?>
								<li><a href="<?php echo base_url();?>payroll/requestentry_table">Pending</a></li>
								<li><a href="<?php echo base_url();?>payroll/requestentry_table?mode=approved">Approved</a></li>
								<li class="active"><a href="#">Declined</a></li>
							<?php } else { ?>
								<li class="active"><a href="#">Pending</a></li>
								<li><a href="<?php echo base_url();?>payroll/requestentry_table?mode=approved">Approved</a></li>
								<li><a href="<?php echo base_url();?>payroll/requestentry_table?mode=declined">Declined</a></li>
							<?php } ?>
							</ul>
							<div class="tab-content">
								<table id="dynamicTable" class="table table-striped table-hover table-bordered table-condensed">				
									<thead >
										<?php if ($this->session->userdata('user_level') == 'Administrator' or $this->session->userdata('user_level') == 'Accounting Manager') { ?>
										<th class="col-md-3 text-center">Requested by</th>
										<?php } ?>
										<th class="col-md-1 text-center">Date</th>
										<th class="col-md-1 text-center">Time In</th>
										<th class="col-md-1 text-center">Time Out</th>
										<th class="col-md-2 text-center">Date Requested</th>
										<?php if($mode==''){ ?>
											<th class="col-md-2 text-center">Action</th>
										<?php } else { ?>
											<th class="col-md-2 text-center">Modified by</th>
										<?php } ?>
									</thead>
									<?php foreach($requestentry as $row){ ?>
									<tr>
										<?php if ($this->session->userdata('user_level') == 'Administrator' or $this->session->userdata('user_level') == 'Accounting Manager') { ?>
										<td class="col-md-3 text-left"><?php echo $row->requestee?></td>
										<?php } ?>
										<td class="col-md-1 text-center"><?php echo $row->date_value?></td>
										<td class="col-md-1 text-center"><?php echo $row->time_in?></td>
										<td class="col-md-1 text-center"><?php echo $row->time_out?></td>
										<td class="col-md-2 text-center"><?php echo $row->date_requested?></td>
										<td class="col-md-2 text-center">
										<?php if($mode==''){ ?>
											<a href="<?php echo base_url();?>payroll/approverequestentry?action=approve&req_id=<?php echo $row->req_id; ?>">
												<button class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Approve">
												<i class="fa fa-check fa-lg"></i></button>
											</a>
											<a href="<?php echo base_url();?>payroll/approverequestentry?action=decline&req_id=<?php echo $row->req_id; ?>">
												<button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Decline">
												<i class="fa fa-times fa-lg"></i></button>
											</a>
										<?php } else { ?>
											<?php echo $row->approver?>
										<?php } ?>
										</td>
									</tr>
									<?php } ?>
								</table>
							</div>
						</div><!-- nav-tabs-custom --> 
					</div>   <!--Main Panel -->
				</div> <!-- col-9-->
			</div>
		</div>
	</div>
</div>
