<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>Lupa Password - Sistem Manjemen Peserta PKL</title>

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

				<?php if ($this->session->flashdata('message')) { ?>
			      <div class="alert alert-danger"><i class="glyphicon glyphicon-exclamation-sign"></i>
			        <?php echo $this->session->flashdata('message');?>                  
			      </div>
			    <?php }?>
			    <?php if ($this->session->flashdata('notif')) { ?>
			      <div class="alert alert-info"><i class="glyphicon glyphicon-exclamation-sign"></i>
			        <?php echo $this->session->flashdata('notif');?>                  
			      </div>
			    <?php }?>
	
				<div class="content clearfix">
					
					<form action="<?php echo site_url('login/reset_proses');?>" method="post">	

					<h2>Lupa Password</h2>
						
						<div class="login-fields">


							<div class="field">
								<label for="email">Email</label>
								<input type="text" id="email" name="email" value="" placeholder="Email" class="login username-field" />
							</div> <!-- /field -->

							<div class="field">
								<?php echo $captcha_img;?>								
							</div>

							<div class="field">
								<label for="captcha">Captcha</label>
								<input type="text" id="captcha" name="captcha" value="" placeholder="Captcha" class="login password-field" />
								<p class="help-block"><i class="icon-info-sign"></i> Masukan kumpulan karakter yang anda lihat pada gambar.</p>
							</div> <!-- /field -->
													
						</div> <!-- /login-fields -->
						
						<div class="login-actions">
							
							<span class="login-checkbox">
								<a href="<?php echo site_url('login');?>"><< Kembali</a>
							</span>
												
							<button class="button btn btn-danger btn-large">Ok</button>
							
						</div> <!-- .actions -->		
						
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
