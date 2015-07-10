<div class="fix-body">
	<div class="signUpPanel center-block">
		<div class="panel panel-default">
			<div class="panel-heading">
			    <h3 class="panel-title">MSInc. Employee Registration</h3>
			</div>
			<div class="panel-body">
				<hr class="colorgraph">
		    	<?php echo form_open('msi/signup/'); ?>
		    	<div class="row">
		    		<div class="col-sm-12">
		    			<div class="col-sm-6">	
							<div class="form-group <?php if(form_error('txtUsername')) echo 'has-error';?>">
								<div class="row">
									<label for="txtUsername" class="control-label col-sm-4">Username: </label>
									<div class="col-sm-8 error"><?php echo form_error('txtUsername') ?></div>
								</div>
								<div class="input-group"> <span class="input-group-addon"><span class="fa fa-user fa-lg"></span></span>
									<input type="text" class="form-control" name="txtUsername" value="<?php echo set_value('txtUsername') ?>">
								</div>
							</div>
							<div class="form-group <?php if(form_error('txtPassword')) echo 'has-error';?>">
								<div class="row">
									<label for="txtPassword" class="control-label col-sm-4">Password: </label>
									<div class="col-sm-8 error"><?php echo form_error('txtPassword') ?></div>
								</div>
								<div class="input-group"> <span class="input-group-addon"><span class="fa fa-lock fa-lg"></span></span>
									<input type="password" class="form-control" name="txtPassword" value="<?php echo set_value('txtPassword') ?>">
								</div>
							</div>
							<div class="form-group <?php if(form_error('txtCPassword')) echo 'has-error';?>">
								<div class="row">
									<label for="txtCPassword" class="control-label col-sm-5">Confirm Password: </label>
									<div class="col-sm-7 error"><?php echo form_error('txtCPassword') ?></div>
								</div>
								<div class="input-group"> <span class="input-group-addon"><span class="fa fa-lock fa-lg"></span></span>
									<input type="password" class="form-control" name="txtCPassword" value="<?php echo set_value('txtCPassword') ?>" >
								</div>
							</div>
							<div class="form-group <?php if(form_error('txtEmail')) echo 'has-error';?>">
								<div class="row">
									<label for="txtEmail" class="control-label col-sm-4">Email: </label>
									<div class="col-sm-8 error"><?php echo form_error('txtEmail') ?></div>
								</div>
								<div class="input-group"> <span class="input-group-addon"><span class="fa fa-envelope fa-lg"></span></span>
									<input type="email" class="form-control" name="txtEmail" value="<?php echo set_value('txtEmail') ?>">
								</div>
							</div>
						</div> <!-- User Account -->

						<div class="col-sm-6">
							<div class="form-group <?php if(form_error('txtUserLevel')) echo 'has-error';?>">
								<div class="row">
									<label for="txtUserLevel" class="control-label col-sm-4">User Level: </label>
									<div class="col-sm-8 error"><?php echo form_error('txtUserLevel') ?></div>
								</div>
								<div class="input-group"> <span class="input-group-addon"><span class="fa fa-th fa-lg"></span></span>
									<select name="txtUserLevel" class="form-control">
										<option value="" selected="selected"> --- </option>
										<option value="Employee" <?php if(set_value('txtUserLevel')=="Employee") echo "selected='selected'";?> >Employee</option>
										<option value="Manager" <?php if(set_value('txtUserLevel')=="Manager") echo "selected='selected'";?> >Manager</option>
										<option value="Administrator" <?php if(set_value('txtUserLevel')=="Administrator") echo "selected='selected'"; ?>>Administrator</option>
									</select>
								</div>
							</div>
							<div class="form-group <?php if(form_error('txtQuestionList')) echo 'has-error';?>">
								<div class="row">
									<label for="txtQuestionList" class="control-label col-sm-5">Secret Question: </label>
									<div class="col-sm-7 error"><?php echo form_error('txtQuestionList') ?></div>
								</div>
								<div class="input-group"> <span class="input-group-addon"><span class="fa fa-question fa-lg"></span></span>
									<select name="txtQuestionList" class="form-control">
										<option value="" selected="selected"> --- </option>
										<option value="1" <?php if(set_value('txtQuestionList')=="1") echo "selected='selected'";?> >What was your childhood nickname?</option>
										<option value="2" <?php if(set_value('txtQuestionList')=="2") echo "selected='selected'";?> >What was the name of your elementary / primary school?</option>
										<option value="3" <?php if(set_value('txtQuestionList')=="3") echo "selected='selected'"; ?>>What is your mothers maiden name?</option>
										<option value="4" <?php if(set_value('txtQuestionList')=="4") echo "selected='selected'"; ?>>In what city were you born?</option>
										<option value="5" <?php if(set_value('txtQuestionList')=="5") echo "selected='selected'"; ?>>What street did you grow up on?</option>
										<option value="6" <?php if(set_value('txtQuestionList')=="6") echo "selected='selected'"; ?>>What is your favorite movie?</option>
									</select>
								</div>
							</div>
							<div class="form-group <?php if(form_error('txtAnswer')) echo 'has-error';?>">
								<div class="row">
									<label for="txtAnswer" class="control-label col-sm-4">Secret Answer: </label>
									<div class="col-sm-8 error"><?php echo form_error('txtAnswer') ?></div>
								</div>
								<div class="input-group"> <span class="input-group-addon"><span class="fa fa-info fa-lg"></span></span>
									<input type="password" class="form-control" name="txtAnswer" value="<?php echo set_value('txtAnswer') ?>">
								</div>
							</div>
						</div> <!-- user profile -->
					</div>	<!-- col-sm-12 -->
				</div> <!-- Row close -->
				<div class="signupButtons">
					<center>
						<input type="submit" class="btn btn-success" name="btnSubmit" value="Submit">
						<input type="reset" class="btn btn-danger" value="Clear">
					</center>
				</div>
				<?php echo form_close(); ?>
			</div>	
		</div>
	</div>
</div>
