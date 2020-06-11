<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
		<?php
			$perfil = $this->session->userdata('perfil');
			$nombre = $this->session->userdata('nombre');
		?>

		<div class="navbar-default navbar-static-side" role="navigation">
			<div class="sidebar-collapse">
				<ul class="nav" id="side-menu">
					<?php
					if ($this->session->userdata('perfil') == 1 ) {
					?>
							<li>
								<a  href="<?= base_url() ?>index.php/cuentaUsuario">
								<i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;Gestionar Usuarios</a>
							</li>
							<li>
								<a href="<?= base_url() ?>index.php/clienteMantenedor">
								<i class="fa fa-users"></i>&nbsp;&nbsp;Gestionar Clientes</a>
							</li>
							
							<hr style="margin-top: 10px; margin-bottom: 0px"></hr>
							<li>
								<a href="<?= base_url() ?>index.php/formularioEmision"</a>
								<i class="glyphicon glyphicon-edit"></i>&nbsp;&nbsp;Emitir Certificado </a>
							</li>
							<li>
								<a href="<?= base_url() ?>index.php/denunciaSiniestro">
								<i class="glyphicon glyphicon-certificate"></i>&nbsp;&nbsp;Denunciar Siniestro</a>
							</li>
							<li>
								<a href="<?= base_url() ?>index.php/historialCertificado">
									<i class="fa fa-list-alt"></i>&nbsp;&nbsp;Historial Certificados</a>
							</li>
							<li>
								<a href="<?= base_url() ?>index.php/primaMensual">
								<i class="glyphicon glyphicon-usd"></i>&nbsp;&nbsp;Prima Mensual</a>
							</li>
							<!--<li>
								<a href="<?= base_url() ?>index.php/historialPago">
								<i class="fa fa-calendar"></i>&nbsp;&nbsp;historial Pagos</a>
							</li>
							<li>
								<a href="<?= base_url() ?>index.php/informeCierre">
								<i class="fa fa-book"></i>&nbsp;&nbsp;Informe Cierre</a>
							</li>-->
							
				<?php
			}elseif ($this->session->userdata('perfil') == 2 ) {
				?>
								
							<li>
								<a href="<?= base_url() ?>index.php/formularioEmision"</a>
								<i class="glyphicon glyphicon-edit"></i>&nbsp;&nbsp;Emitir Certificado </a>
							</li>
							<li>
								<a href="<?= base_url() ?>index.php/clienteMantenedor">
								<i class="fa fa-users"></i>&nbsp;&nbsp;Gestionar Clientes</a>
							</li>
							<li>
								<a href="<?= base_url() ?>index.php/denunciaSiniestro">
								<i class="glyphicon glyphicon-certificate"></i>&nbsp;&nbsp;Denunciar Siniestro</a>
							</li>
							<li>
								<a href="<?= base_url() ?>index.php/historialCertificado">
									<i class="fa fa-list-alt"></i>&nbsp;&nbsp;Historial Certificados</a>
							</li>
							<li>
								<a href="<?= base_url() ?>index.php/primaMensual">
								<i class="glyphicon glyphicon-usd"></i>&nbsp;&nbsp;Prima Mensual</a>
							</li>
							<!--<li>
								<a href="<?= base_url() ?>index.php/historialPago">
								<i class="fa fa-calendar"></i>&nbsp;&nbsp;historial Pagos</a>
							</li>-->
						
						<?php
					}
						?>
			 	 </ul>
			  </div>
		 </div>
	 </nav>
		 
	