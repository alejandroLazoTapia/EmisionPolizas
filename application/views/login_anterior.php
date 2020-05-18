<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="<?=base_url() ?>recursos/images/icons/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="<?=base_url() ?>recursos/vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url() ?>recursos/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url() ?>recursos/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url() ?>recursos/vendor/animate/animate.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url() ?>recursos/vendor/css-hamburgers/hamburgers.min.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url() ?>recursos/vendor/animsition/css/animsition.min.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url() ?>recursos/vendor/select2/select2.min.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url() ?>recursos/vendor/daterangepicker/daterangepicker.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url() ?>recursos/css/util.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url() ?>recursos/css/main.css">

	</head>
	<body>
		<div class="limiter">
			<div class="container-login100">
				<div class="wrap-login100">
					<div class="login100-form-title" style="background-image: url(<?=base_url() ?>recursos/images/bg-03.jpg);">
						<span class="login100-form-title-1">
							SGG Logistics
						</span>
					</div>

					<form action="<?=base_url()?>index.php/login" method="post" accept-charset='UTF-8' role="form" class="login100-form validate-form">
						<div class="wrap-input100 validate-input m-b-26" data-validate="Usuario es requerido">
							<span class="label-input100">Usuario</span>
							<input class="input100" type="text" name="username" placeholder="Ingrese usuario">
							<span class="focus-input100"></span>
						</div>

						<div class="wrap-input100 validate-input m-b-18" data-validate = "Contraseña es requerida">
							<span class="label-input100">Contraseña</span>
							<input class="input100" type="password" name="pass" placeholder="Ingrese Contraseña">
							<span class="focus-input100"></span>
						</div>

						<div class="container-login100-form-btn">
							<button class="login100-form-btn">
								Login
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	

		<script src="<?=base_url() ?>recursos/vendor/jquery/jquery-3.2.1.min.js"> </script>
		<script src="<?=base_url() ?>recursos/vendor/animsition/js/animsition.min.js"> </script>
		<script src="<?=base_url() ?>recursos/vendor/bootstrap/js/popper.js"> </script>
		<script src="<?=base_url() ?>recursos/vendor/bootstrap/js/bootstrap.min.js"> </script>
		<script src="<?=base_url() ?>recursos/vendor/select2/select2.min.js"> </script>
		<script src="<?=base_url() ?>recursos/vendor/daterangepicker/moment.min.js"> </script>
		<script src="<?=base_url() ?>recursos/vendor/daterangepicker/daterangepicker.js"> </script>
		<script src="<?=base_url() ?>recursos/vendor/countdowntime/countdowntime.js"> </script>
		<script src="<?=base_url() ?>recursos/js/main.js"> </script>


	</body>
</html>