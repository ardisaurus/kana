<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>Login - Sistem Manjemen Peserta PKL</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"> 

<link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon.ico'); ?>">    
<link href="<?php echo site_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/css/bootstrap-responsive.min.css'); ?>" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url('assets/css/font-awesome.css'); ?>" rel="stylesheet">
    
<link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/pages/signin.css'); ?>" rel="stylesheet" type="text/css">

</head>

<body>
	
	<div class="navbar navbar-fixed-top">
	
	<div class="navbar-inner">
		
		<div class="container">
					
			<a class="brand" href="#">
				Sistem Manjemen Peserta PKL				
			</a>	
	
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->

<div class="container">
	
	<div class="row">
		
		<div class="span12">
			
			<div class="error-container">

				<div class="account-container">

				<img src="<?php echo base_url('assets/img/maker.jpg'); ?>">

				<h3>Sistem Manajemen Peserta PKL</h3>
	
				<div class="content clearfix">
					
					<form action="<?php echo site_url('login/proses');?>" method="post">	
						
						<div class="login-fields">

							<div class="field">
								<p>Build by</p>
								<p><strong>Nugroho Ardi Sutrisno</strong></p>
								<p><i>ardinisme@gmail.com</i></p>
							</div> <!-- /field -->
							
							<div class="field">
								<p>Documented by</p>
								<p><strong>Prayogi</strong></p>
								<p><i>fransiskusprayogi@gmail.com</i></p>								
							</div> <!-- /field-->
							
						</div> <!-- /login-fields -->		
						
					</form>
					
				</div> <!-- /content -->
				
			</div> <!-- /account-container -->
							
			</div> <!-- /error-container -->			
			
		</div> <!-- /span12 -->
		
	</div> <!-- /row -->
	
</div> <!-- /container -->

<script src="<?php echo base_url('assets/js/jquery-1.7.2.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/signin.js'); ?>"></script>

</body>

</html>
