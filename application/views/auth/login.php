<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicons.ico" type="image/x-icon">
		<link rel="icon" href="<?php echo base_url();?>assets/images/favicons.ico" type="image/x-icon">
		<title>
			<?php if (isset($pageTitle)){ echo $pageTitle; } else { echo "Home - MSInc.";}?>
		</title>
		<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/sweetalert.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/toastr.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/animations.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/morris.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:500,700,500italic,400' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/mystyle.css">
		

	</head>
	<body class="skin-black ">
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
								<input type="text" class="form-control" name="txtUsername" value="<?php echo set_value('txtUsername') ?>">
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
								<input type="password" class="form-control" name="txtPassword" value="<?php echo set_value('txtPassword') ?>">
							</div>
						</div>

						<input type="submit" class="pull-right btn btn-success btn-block" name="btnSubmit" value="Submit">
						<div class="clearfix"></div>
						<br>
						<hr class="colorgraph">
						<a href="<?php echo base_url();?>msi/signup" class="pull-left">Sign Up Here!</a>
						<a href="<?php echo base_url();?>msi/reset_password" class="pull-right">Forgot Password?</a>
						<?php echo form_close(); ?>
				</div>
			</div>
		</div>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
			<script src="<?php echo base_url();?>assets/js/jquery-ui.min.js"></script>
			<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
			<script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
			<script src="<?php echo base_url();?>assets/js/toastr.min.js"></script>
			<script src="<?php echo base_url();?>assets/js/app.min.js" type="text/javascript"></script>
			<!-- Admin LTE -->
			<script src="<?php echo base_url();?>assets/plugins/morris.js"></script>
			<script src="<?php echo base_url();?>assets/js/animations.js"></script>
			<script src="<?php echo base_url();?>assets/js/custom.js"></script>
		
	</body>
</html>

