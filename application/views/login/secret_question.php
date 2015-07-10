<div class="fix-body">
	<div class="loginPanel center-block">
		<div class="panel panel-default">
			<div class="panel-heading">
			    <h3 class="panel-title">MSInc. Reset Password</h3>
			</div>
			<div class="panel-body">
		    	<?php echo form_open('msi/secret_question'); ?>
				<div class="form-group <?php if(form_error('txtQuestion')) echo 'has-error';?>">
					<div class="row">
						<label for="txtQuestion" class="control-label col-sm-4">Secret Question: </label>
						<div class="col-sm-8 error"><?php echo form_error('txtQuestion') ?></div>
					</div>
					<select name="txtQuestion" class="form-control">
						<option value="" selected="selected"> ---</option>
						<option value="What was your childhood nickname?" <?php if(set_value('txtQuestion')=="What was your childhood nickname?") echo "selected='selected'";?> >What was your childhood nickname?</option>
						<option value="What was the name of your elementary/primary school?" <?php if(set_value('txtQuestion')=="What was the name of your elementary/primary school?") echo "selected='selected'";?> >What was the name of your elementary/primary school?</option>
						<option value="What is your mothers maiden name?" <?php if(set_value('txtQuestion')=="What is your mothers maiden name?") echo "selected='selected'";?> >What is your mothers maiden name?</option>
						<option value="In what city were you born?" <?php if(set_value('txtQuestion')=="In what city were you born?") echo "selected='selected'";?> >In what city were you born?</option>
						<option value="What street did you grow up on?" <?php if(set_value('txtQuestion')=="What street did you grow up on?") echo "selected='selected'";?> >What street did you grow up on?</option>
						<option value="What is your favorite movie?" <?php if(set_value('txtQuestion')=="What is your favorite movie?") echo "selected='selected'";?> >What is your favorite movie?</option>
					</select>
				</div>
				<div class="form-group <?php if(form_error('txtQuestion')) echo 'has-error';?>">
					<div class="row">
						<label for="txtAnswer" class="control-label col-sm-4">Secret Answer: </label>
						<div class="col-sm-8 error"><?php echo form_error('txtAnswer') ?></div>
					</div>
					<input type="password" class="form-control" name="txtAnswer" value="<?php echo set_value('txtAnswer') ?>" >
				</div>
				<input type="submit" class="pull-right btn btn-success" name="btnQuestion" value="Reset Password">
				<?php echo form_close(); ?>
			</div>	
		</div>
	</div>
</div>