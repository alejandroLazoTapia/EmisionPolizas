<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php 
		$perfil = $this->session->userdata('perfil');
		$nombre = $this->session->userdata('nombre')
?>
			<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Bienvenido <?php echo($nombre)?></h1>
					</div>
				</div>
			</div>
