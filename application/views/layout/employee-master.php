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
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/sweetalert.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/toastr.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/animations.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/morris.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/datepicker/datepicker3.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:500,700,500italic,400' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/mystyle.css">
		
	</head>
	<body class="skin-black sidebar-mini">
		<div class="wrapper">
			<!-- Page Layout -->
			<?php 
			$this->load->view('layout/navbar-logged');
			$this->load->view('layout/sidebar-employee');
			$this->load->view('employee/'.$content);
			 ?>
			<!-- Page Layout -->
			<footer class="main-footer">
				<strong>Copyright &copy; 2015 Multistyle Specialists Inc.</strong> All rights reserved.
			</footer>

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
			<script src="<?php echo base_url();?>assets/js/jquery-ui.min.js"></script>
			<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
			<script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
			<script src="<?php echo base_url();?>assets/js/toastr.min.js"></script>
			<script src="<?php echo base_url();?>assets/js/app.min.js" type="text/javascript"></script>
			<!-- Admin LTE -->
			<script src="<?php echo base_url();?>assets/plugins/morris.js"></script>
			<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
			<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
			<script src="<?php echo base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
			<script src="<?php echo base_url();?>assets/js/animations.js"></script>
			<script src="<?php echo base_url();?>assets/js/jquery.slimscroll.min.js"></script>
			<script src="<?php echo base_url();?>assets/js/custom.js"></script>
		</div>
	</body>
</html>





