<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Start Bootstrap - SB Admin Version 2.0 Demo</title>

	<link href="<?=base_url() ?>recursos/sb-admin-v2/css/sb-admin.css" rel="stylesheet">
	<link href="<?=base_url() ?>recursos/sb-admin-v2/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?=base_url() ?>recursos/sb-admin-v2/font-awesome/css/font-awesome.css" rel="stylesheet">


</head>

<body style="padding-top: 0px;"> 
	<?php
	$perfil = $this->session->userdata('perfil');
	$nombre = $this->session->userdata('nombre');
	?>
	
<div id="wrapper">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0;position: static;">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="homeUsuario.html">SGG Logistics</a>
	</div>


	<ul class="nav navbar-top-links navbar-right">
		<!-- /.dropdown -->
		<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="float: right; padding:10px 6px; ">
				<i class="fa fa-user fa-fw"></i>
				<i class="fa fa-caret-down"></i>
			</a>
				<ul class="dropdown-menu dropdown-user" style="margin-top:45px">
				<li>
					<a href="#">
						<i class="fa fa-user fa-fw"></i> <?php echo($nombre) ?>
					</a>
				</li>
				<li class="divider"></li>
				<li>
					<a href="<?=base_url()?>index.php/inicio">
						<i class="fa fa-sign-out fa-fw"></i> Cerrar Sesión</a>
				</li>
			</ul>
		</li>
	</ul>