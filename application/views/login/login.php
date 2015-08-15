<div class="container">
	<div class="panel panel-default loginPanel">
		<div class="panel-heading">
			<h3 class="panel-title">MSInc. Employee Login</h3>
		</div>
		<div class="panel-body">

			<?php echo form_open('auth/login'); ?>
				<div class="form-group <?php if(form_error('txtUsername')) echo 'has-error';?>">
					<div class="row">
						<label for="txtUsername" class="control-label col-sm-4">Username: </label>
						<div class="col-sm-8 error">
							<?php echo form_error('txtUsername') ?>
						</div>
					</div>
					<div class="input-group"> <span class="input-group-addon"><span class="fa fa-user"></span></span>
						<input type="text" class="form-control input-lg" name="txtUsername" value="<?php echo set_value('txtUsername') ?>">
					</div>
				</div>
				<div class="form-group <?php if(form_error('txtPassword')) echo 'has-error';?>">
					<div class="row">
						<label for="txtPassword" class="control-label col-sm-4">Password: </label>
						<div class="col-sm-8 error">
							<?php echo form_error('txtPassword') ?>
						</div>
					</div>
					<div class="input-group"> <span class="input-group-addon"><span class="fa fa-lock"></span></span>
						<input type="password" class="form-control input-lg" name="txtPassword" value="<?php echo set_value('txtPassword') ?>">
					</div>
				</div>

				<input type="submit" class="pull-right btn btn-success btn-block btn-lg" name="btnSubmit" value="Submit">
				<div class="clearfix"></div>
				<br>
				<hr class="colorgraph">
				<?php echo form_close(); ?>
		</div>
	</div>
</div>
