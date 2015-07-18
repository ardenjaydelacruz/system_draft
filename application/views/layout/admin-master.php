<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.ico" type="image/x-icon">
		<link rel="icon" href="<?php echo base_url();?>assets/images/favicon.ico" type="image/x-icon">
		<title>
			<?php if (isset($pageTitle)){ echo $pageTitle; } else { echo "Home - MSInc.";}?>
		</title>
		<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/sidebar.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/sweetalert.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/toastr.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/animations.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/morris.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:500,700,500italic,400' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/mystyle.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

	</head>
	<body class="skin-black sidebar-mini sidebar-collapse fixed">
		<div class="wrapper">
			<!-- Page Layout -->
			<?php 
			$this->load->view('layout/navbar-logged');
			$this->load->view('layout/sidebar-admin');
			$this->load->view($content);
			 ?>
			<!-- Page Layout -->
			<footer class="main-footer">
				<strong>Copyright &copy; 2015 Multistyle Specialists Inc.</strong> All rights reserved.
			</footer>

			<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
			<script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
			<script src="<?php echo base_url();?>assets/js/toastr.min.js"></script>
			<script src="<?php echo base_url();?>assets/js/app.min.js" type="text/javascript"></script>
			<script src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>
			<!-- Admin LTE -->
			<script src="<?php echo base_url();?>assets/plugins/morris.js"></script>
			<script src="<?php echo base_url();?>assets/js/animations.js"></script>
			<script src="<?php echo base_url();?>assets/js/custom.js"></script>
		</div>
	</body>
</html>





