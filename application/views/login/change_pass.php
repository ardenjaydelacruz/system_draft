<div class="fix-body">
	<div class="loginPanel center-block">
		<div class="panel panel-default">
			<div class="panel-heading">
			    <h3 class="panel-title">MSInc. Change Password</h3>
			</div>
			<div class="panel-body">
		    	<?php echo form_open('msi/save_new_pass'); ?>
				<div class="form-group <?php if(form_error('txtNewPass')) echo 'has-error';?>">
					<div class="row">
						<label for="txtNewPass" class="control-label col-sm-4">New Password: </label>
						<div class="col-sm-8 error"><?php echo form_error('txtNewPass') ?></div>
					</div>
					<input type="password" class="form-control" name="txtNewPass" value="<?php echo set_value('txtNewPass') ?>">
				</div>
				<div class="form-group <?php if(form_error('txtCNewPass')) echo 'has-error';?>">
					<div class="row">
						<label for="txtCNewPass" class="control-label col-sm-4">Confirm New Password: </label>
						<div class="col-sm-8 error"><?php echo form_error('txtCNewPass') ?></div>
					</div>
					<input type="password" class="form-control" name="txtCNewPass" value="<?php echo set_value('txtCNewPass') ?>" >
				</div>
				<input type="submit" class="pull-right btn btn-success" name="btnSaveNewPass" value="Change Password">
				<?php echo form_close(); ?>
			</div>	
		</div>
	</div>
</div>