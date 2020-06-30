<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php 
		$perfil = $this->session->userdata('perfil');
		$nombre = $this->session->userdata('nombre')
?>
<style>
	
</style>
			<div id="page-wrapper" class="container-portada" style="border-right: 1px solid #e7e7e7;" >
				<div class="row ">
					<div class="col-lg-12 ">
						<h1 class="page-header" style="color: white;border-bottom:0px !important;">Bienvenido <?php echo($nombre)?></h1>
						
					</div>
				</div>
			</div>
