<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
		<?php
			$perfil = $this->session->userdata('perfil');
			$nombre = $this->session->userdata('nombre');
		?>

		<div class="navbar-default navbar-static-side" role="navigation">
			<div class="sidebar-collapse">
				<ul class="nav" id="side-menu" style="border-right: 1px solid #eee!important;">
					<?php
					if ($this->session->userdata('perfil') == 1 ) {
					?>
					<!--<hr style="margin-top: 3px; margin-bottom: 0px"></hr>-->
							<li>
								<a  href="<?= base_url() ?>index.php/cuentaUsuario" style="margin-top: 10px;margin-bottom: 10px">
								<i class="glyphicon glyphicon-user" style="color: #6675df !important;"></i>&nbsp;&nbsp;<b>GESTIONAR USUARIOS</b></a>
							</li>
							<li>
								<a href="<?= base_url() ?>index.php/clienteMantenedor" style="margin-top: 10px;margin-bottom: 10px">
								<i class="fa fa-users" style="color: #6675df !important;"></i>&nbsp;&nbsp;<b>GESTIONAR CLIENTES</b></a>
							</li>
							
							<hr style="margin-top: 10px; margin-bottom: 0px"></hr>
							<li>
								<a href="<?= base_url() ?>index.php/formularioEmision" style="margin-top: 10px;margin-bottom: 10px">
								<i class="glyphicon glyphicon-edit" style="color: #6675df !important;"></i>&nbsp;&nbsp;<b>EMITIR CERTIFICADO </b></a>
							</li>
							<li>
								<a href="<?= base_url() ?>index.php/denunciaSiniestro" style="margin-top: 10px;margin-bottom: 10px">
								<i class="glyphicon glyphicon-certificate" style="color: #6675df !important;"></i>&nbsp;&nbsp;<b>DENUNCIAR SINIESTRO</b></a>
							</li>
							<li>
								<a href="<?= base_url() ?>index.php/historialCertificado" style="margin-top: 10px;margin-bottom: 10px">
									<i class="fa fa-list-alt" style="color: #6675df !important;"></i>&nbsp;&nbsp;<b>HISTORIAL CERTIFICADOS</b></a>
							</li>
							<li>
								<a href="<?= base_url() ?>index.php/primaMensual" style="margin-top: 10px;margin-bottom: 10px">
								<i class="glyphicon glyphicon-usd" style="color: #6675df !important;"></i>&nbsp;&nbsp;<b>PRIMA MENSUAL</b></a>
							</li>
							
				<?php
			}elseif ($this->session->userdata('perfil') == 2 ) {
				?>
								
							<li>
								<a href="<?= base_url() ?>index.php/formularioEmision" style="margin-top: 10px;margin-bottom: 10px">
								<i class="glyphicon glyphicon-edit" style="color: #6675df !important;"></i>&nbsp;&nbsp;<b>EMITIR CERTIFICADO </b></a>
							</li>
							<li>
								<a href="<?= base_url() ?>index.php/clienteMantenedor" style="margin-top: 10px;margin-bottom: 10px">
								<i class="fa fa-users" style="color: #6675df !important;"></i>&nbsp;&nbsp;<b>GESTINAR CLIENTES</b></a>
							</li>
							<li>
								<a href="<?= base_url() ?>index.php/denunciaSiniestro" style="margin-top: 10px;margin-bottom: 10px">
								<i class="glyphicon glyphicon-certificate" style="color: #6675df !important;"></i>&nbsp;&nbsp;<b>DENUNCIAR SINIESTRO</b></a>
							</li>
							<li>
								<a href="<?= base_url() ?>index.php/historialCertificado" style="margin-top: 10px;margin-bottom: 10px">
									<i class="fa fa-list-alt" style="color: #6675df !important;"></i>&nbsp;&nbsp;<b>HISTORIAL CERTIFICADO</b></a>
							</li>
							<li>
								<a href="<?= base_url() ?>index.php/primaMensual" style="margin-top: 10px;margin-bottom: 10px">
									<i class="glyphicon glyphicon-usd" style="color: #6675df !important;"></i>&nbsp;&nbsp;<b>PRIMA MENSUAL</b>
								</a>
							</li>
						
						<?php
					}
						?>
			 	 </ul>
			  </div>
		 </div>
	 </nav>
		 
	