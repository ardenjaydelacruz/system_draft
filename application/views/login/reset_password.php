<div class="fix-body">
	<div class="loginPanel center-block">
		<div class="panel panel-default">
			<div class="panel-heading">
			    <h3 class="panel-title">MSInc. Reset Password</h3>
			</div>
			<div class="panel-body">
		    	<?php echo form_open('msi/reset_password'); ?>
				<div class="form-group <?php if(form_error('txtUserChange')) echo 'has-error';?>">
					<div class="row">
						<label for="txtUserChange" class="control-label col-sm-4">Username: </label>
						<div class="col-sm-8 error"><?php echo form_error('txtUserChange') ?></div>
					</div>
					<input type="text" class="form-control" name="txtUserChange" value="<?php echo set_value('txtUserChange') ?>" placeholder="Username">
				</div>
				<input type="submit" class="pull-right btn btn-success" name="btnResetPass" value="Reset Password">
				<?php echo form_close(); ?>
			</div>	
		</div>
	</div>
</div>