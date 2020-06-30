<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Registrar Usuario</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<button  class="btn btn-success btn" onclick="showFormUser()" >
				Nuevo Usuario
			</button>
		</div>
	</div>

		<div class="row">
			<div class="col-lg-5">
				<div class="row" style="margin-top: 20px;">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
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
											<th style="text-align: center;">Eliminar</th>
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
													<td style="text-align: center;"><a class="idFilaActualizar"><span class="glyphicon glyphicon-pencil" style="color: #6675df !important;"></span></a></td>
										<td style="text-align: center;">
											<a class="idFilaDel" data-toggle="modal" data-target="#myModalDelUser">
												<span class="glyphicon glyphicon-remove" style="color: red"></span></a></td>
											<?php 
											echo '<td style="display:none">'.$key["id_usuario"].'</td>';
											echo '<td style="display:none">'.$key["nombre"].'</td>';
											echo '<td style="display:none">'.$key["id_perfil"].'</td>';
											echo '<td style="display:none">'.$key["id_pais"].'</td>';
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

		<div class="modal fade" id="myModalDelUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="margin-bottom: 20px;">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Eliminar Usuario</h4>
					</div>

					<div class="row" style="text-align:center;">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Estas intentando eliminar al usuario:</label>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<input id="idUserDel" name="idUserDel" style="display: none">
								<input id="idNameUser" name="idNameUser"  type="text" style="background-color:transparent;border-color: transparent;width: 100px;text-align: center;">
							</div>
						</div>

						<div class="col-lg-12">
							<div class="form-group">
								<label>¿Deseas Eliminar?</label>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
								&nbsp;&nbsp;&nbsp;&nbsp;
								<button type="button" class="btn btn-danger" id="idFilaBorrar" name="idFilaBorrar" data-dismiss="modal">Si</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
			
			
			<div class="col-lg-7">
				<div class="row" style="margin-top: 20px;">
				<form role="form" method="POST" accept-charset='UTF-8' id="form-create-user">
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
												<input id="idNombreUsuario" name="idNombreUsuario" class="form-control" placeholder="ej: sergio.valenzuela" required>
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
													<button type="submit" formaction="<?=base_url() ?>index.php/cuentaUsuario/guardarUsuario" id="btnRegistrarUsuario" class="btn btn btn-success" style="display: none;margin-top: 25px;">Registrar</button>
													<button type="submit" formaction="<?=base_url() ?>index.php/cuentaUsuario/actualizarUsuario" id="btnActualizarUsuario" class="btn btn btn-success" style="display: none;margin-top: 25px;">Actualizar</button>
												</div>
											</div>
										</div>
										
										<!--<div class="col-lg-12">
											<div class="col-lg-12">
												<div class="form-group">
												<button type="submit" formaction="<?=base_url() ?>index.php/cuentaUsuario/guardarUsuario" id="btnRegistrarUsuario" class="btn btn btn-success" style="display: none;margin-top: 10px;">Registrar</button>
												<button type="submit" formaction="<?=base_url() ?>index.php/cuentaUsuario/actualizarUsuario" id="btnActualizarUsuario" class="btn btn btn-success" style="display: none;margin-top: 10px;">Actualizar</button>
												</div>
											</div>
										</div>-->
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