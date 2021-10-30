 <!DOCTYPE html>
<html lang="en">
<head>
	<title>HRD PT.Indoneptune Net Mfg</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="icon" type="image/png" href="images/icons/favicone.ico"/>
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/vendor/animate/animate.css">	
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/vendor/select2/select2.min.css">	
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?= LOK_PAGE ?>vendor/toast/jquery.toast.min.css">

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="<?= LOK_PAGE ?>images/favicon.png">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="<?= $formaction ?>" method="post">
					<span class="login100-form-title p-b-15">
						<!--<p><img src="assets/images/LogoIFNAbu.png" style="width: 150px; height: auto;"></p>-->
						<p>APLIKASI HRD</p>
						Login Disini !
					</span>
					
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 text-center" data-validate="Type user name">
						<input id="idkey" class="input100" type="text" name="idkey" placeholder="ID Key" autocomplete="off">
						<span class="focus-input100"></span>
					</div>
					<!-- <div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
						<input class="input100" type="password" name="password" placeholder="ID Key">
						<span class="focus-input100"></span>
					</div> -->
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Sign in
						</button>
					</div>
					<div class="ket-login">Silahkan masukan id Key yang terdiri dari noinduk+tgllahir. <br>ex : BXXXX11011990</div>
				</form>
				<div class="login100-more" style="background-image: url('<?= base_url() ?>assets/images/bg1.jpg');"></div>
			</div>
		</div>
	</div>
	
	

	<div></div>
	
	<script src="<?= base_url() ?>assets/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="<?= base_url() ?>assets/vendor/animsition/js/animsition.min.js"></script>
	<script src="<?= base_url() ?>assets/vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?= base_url() ?>assets/vendor/select2/select2.min.js"></script>
	<script src="<?= base_url() ?>assets/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?= base_url() ?>assets/vendor/daterangepicker/daterangepicker.js"></script>
	<script src="<?= base_url() ?>assets/vendor/countdowntime/countdowntime.js"></script>
	<script src="<?= base_url() ?>assets/js/main.js"></script>
	<script src="<?= LOK_PAGE ?>vendor/toast/jquery.toast.min.js"></script>
	<script type="text/javascript">
	<?php if($this->session->flashdata('info') == 'logingagal'): ?>
		$.toast({
	        heading: 'Error',
	        text: "Username dan Password tidak sesuai, Hubungi Administrator.",
	        showHideTransition: 'slide',
	        icon: 'error',
	        hideAfter: 5000,
	        position: 'bottom-right',
	        bgColor: ' 	#ff6f69'
	    });
	<?php $this->session->set_flashdata('info',''); endif; ?>
	</script>
</body>
</html>