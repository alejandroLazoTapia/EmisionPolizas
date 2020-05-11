<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Registrar Usuario</h1>
		</div>
	</div>
	<!--<?php
	echo "<pre>";
	print_r($arrUsuarios);
	echo "</pre>";
	?>-->
	<div class="row">
		<div class="col-lg-12">
			<button  class="btn btn-success btn" onclick="showFormUser()" >
				Nuevo Usuario
			</button>
		</div>
	</div>
<!--	<form role="form" action="<?=base_url() ?>index.php/formularioEmision/crearUsuario" method="post" accept-charset='UTF-8' >-->
		<div class="row">
			<div class="col-lg-5">
				<div class="row" style="margin-top: 20px;">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading" style="color:#fff;background-color: #428bca;">
								Usuarios
							</div>
							<!-- /.panel-heading -->
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>Nro</th>
												<th>Usuario</th>
												<th>Tipo Perfil</th>
											<th style="text-align: center;">Editar</th>
											</tr>
										</thead>
										<tbody>
										
											<?php 
											$i = 1;
											foreach ($arrUsuarios as $index => $key) {
												echo"<tr>";
													echo '<td>'.$i.'</td>';
													echo '<td>'.$key["nombre_usuario"].'</td>';
													echo '<td>'.$key["tipo_perfil"].'</td>';
													?>
														  <td style="text-align: center;"><a class="idFila"><span class="glyphicon glyphicon-pencil"></span></a></td>
											<?php 
											echo '<td style="display:none">'.$key["id_usuario"].'</td>';
											echo '<td style="display:none">'.$key["nombre"].'</td>';
											echo '<td style="display:none">'.$key["id_perfil"].'</td>';
											echo '<td style="display:none">'.$key["id_pais"].'</td>';
											echo '<td style="display:none">'.$key["id_cliente"].'</td>';
												echo'</tr>';
												$i = $i +1;
											}
											?>
										</tbody>
									</table>
								</div>
								<!-- /.table-responsive -->
							</div>
							<!-- /.panel-body -->
						</div>
						<!-- /.panel -->
					</div>
				</div>
			</div>

			
			<div class="col-lg-7">
				<div class="row" style="margin-top: 20px;">
				<form role="form" action="<?=base_url() ?>index.php/formularioEmision/crearUsuario" method="post" accept-charset='UTF-8' id="form-create-user">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading" style="color:#fff;background-color: #428bca;">
								Información principal
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-12">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Usuario</label>
												<input id="idNombreUsuario" name="idUsuario" class="form-control" placeholder="ej: sergio.valenzuela" required>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Contraseña</label>
												<input id="idContrasena" name="idContrasena" type="password" class="form-control" placeholder="**********" required>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Nombre</label>
												<input id="idNombre" name="idNombre" class="form-control" placeholder="ej: Juanito Perez" required>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Pais</label>
													<select class="form-control" id="idPaisEmision" name="idPaisEmision" required>
														<option value="">Seleccione</option>
														<?php
													foreach ($arrPaisesEmision as $index => $key) {
														echo '<option value="'.$key["id_pais"].'">'.$key["nombre_pais"].'</option>';
													}
													?>
													</select>
											</div>
										</div>
									</div>
										<div class="col-lg-12">
											<div class="col-lg-4">
												<div class="form-group">
												<label>Perfil</label>
													<select class="form-control" id="idPerfil" name="idPerfil" required>
														<option value="">Seleccione</option>
														<?php
													foreach ($arrPerfiles as $index => $key) {
														echo '<option value="'.$key["id_perfil"].'">'.$key["tipo_perfil"].'</option>';
													}
													?>
													</select>
													
												</div>
											</div>
											<div class="col-lg-8">
												<div class="form-group">
													<label>Cliente</label>
													<select class="form-control" id="idAFavor" name="idAFavor" required>
														<option value="">Seleccione</option>
														<?php
														foreach ($arrClientes as $index => $key) {
															echo '<option value="'.$key["id_cliente"].'">'.$key["nombre_cliente"].'</option>';
													}
													?>
													</select>
												</div>
											</div>
										</div>
										
										<div class="col-lg-12">
											<div class="col-lg-12">
												<div class="form-group">
												<div id="btnGrilla"></div>
<!--													<button id="btnGrilla" type="submit" class="btn btn btn-primary" style="margin-top: 10px">Registrar</button>-->
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<input id="idUsuario" name="idUsuario" style="display: none">
				</form>
				</div>
			</div>
		</div>	
<!--	</form>-->
</div>