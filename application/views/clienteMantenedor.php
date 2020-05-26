<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>



<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Registrar Cliente</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<button  class="btn btn-success btn" onclick="showFormClient()" id="btnNuevoCliente">
				Nuevo Cliente
			</button>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-5">
			<div class="row" style="margin-top: 20px;">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading" style="color:#fff;background-color: #428bca;">
							Clientes
						</div>
						<!-- /.panel-heading -->
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr>
											<th>Nro</th>
											<th>Nombre</th>
											<th style="text-align: center;">Editar</th>
											<th style="text-align: center;">Eliminar</th>
										</tr>
									</thead>
									<tbody>

										<?php
										$i = 1;
										foreach ($arrClientes as $index => $key) {
											echo"<tr>";
											echo '<td>'.$i.'</td>';
											echo '<td>'.$key["nombre_cliente"].'</td>';
										?>
										<td style="text-align: center;">
											<a class="idFilaActualizarCliente">
												<span class="glyphicon glyphicon-pencil"></span></a></td>
										<td style="text-align: center;">
											<a class="idFilaDelCliente" data-toggle="modal" data-target="#myModalDelUser">
												<span class="glyphicon glyphicon-remove" ></span></a></td>
										<?php
										echo '<td style="display:none">'.$key["id_cliente"].'</td>';
										echo '<td style="display:none">'.$key["direccion_cliente"].'</td>';
										echo '<td style="display:none">'.$key["condiciones"].'</td>';
										echo '<td style="display:none">'.$key["id_usuario"].'</td>';
										echo '<td style="display:none">'.$key["nombre_usuario"].'</td>';
										echo '<td style="display:none">'.$key["rut_dni"].'</td>';
										echo '<td style="display:none">'.$key["telefono"].'</td>';
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
						<h4 class="modal-title" id="myModalLabel">Eliminar Cliente</h4>
					</div>

					<div class="row" style="text-align:center;">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Estas intentando eliminar al cliente:</label>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<input id="idClientDel" name="idClientDel" style="display: none">
								<input id="idNameClient" name="idNameClient"  type="text" style="background-color:transparent;border-color: transparent;width: 100px;text-align: center;">
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
								<button type="button" class="btn btn-danger" id="idFilaBorrarCliente" name="idFilaBorrarCliente" data-dismiss="modal">Si</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="col-lg-7">
			<div class="row" style="margin-top: 20px;">
				<form role="form" method="POST" accept-charset='UTF-8' id="form-create-client">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading" style="color:#fff;background-color: #428bca;">
								Información principal
							</div>
							<div class="panel-body">
								<div class="row">
				
									<div class="col-lg-12">
										<div class="form-group">
											<label>Nombre Cliente</label>
											<input id="idNombreCliente" name="idNombreCliente" class="form-control" placeholder="ej: sergio.valenzuela" required>
										</div>
									</div>
									<div class="col-lg-4">	
										<div class="form-group">
										<label>RUT/DNI</label>
											<input type="text" name="idRutDni" id="idRutDni" maxlength="20" class="form-control" required>
											</div>
									</div>	
									<div class="col-lg-8">
										<div class="form-group">
												<label>Condiciones</label>
												<input id="idCondiciones" name="idCondiciones" class="form-control" placeholder="ej: Juanito Perez" required>
										</div>
									</div>	

									<div class="col-lg-8">
										<div class="form-group">
											<label>Dirección</label>
												<input id="idDireccionCliente" name="idDireccionCliente"  class="form-control" placeholder="ej: las margaritas 2145, quilicura, santiago" required>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label>Telefono</label>
												<input id="idTelefono" name="idTelefono"  class="form-control" placeholder="ej: las margaritas 2145, quilicura, santiago" required>
										</div>
									</div>

									<?php
									if ($this->session->userdata('perfil')==1) {
									?>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Usuario</label>
											<select class="form-control" id="idUsuario" name="idUsuario" required>
												<option value="" selected>Seleccione</option>
												<?php
									foreach ($arrUsuarios as $index => $key) {
										echo '<option value="'.$key["id_usuario"].'">'.$key["nombre_usuario"].'</option>';
									}
									?>
											</select>
										</div>
									</div>
									<?php } else { ?>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Usuario</label>
											<select class="form-control" id="idUsuario" name="idUsuario" required>
												<?php
									foreach ($arrUsuarios as $index => $key) {
										echo '<option selected readonly value="'.$key["id_usuario"].'">'.$key["nombre_usuario"].'</option>';
									}
									?>
											</select>
										</div>
									</div>
									<?php } ?>
								

								<div class="col-lg-12">
										<div class="form-group">
											<button type="submit" formaction="<?=base_url() ?>index.php/clienteMantenedor/guardarCliente" id="btnRegistrarCliente" class="btn btn btn-success" style="display: none;margin-top: 10px;">Registrar</button>
											<button type="submit" formaction="<?=base_url() ?>index.php/clienteMantenedor/actualizarCliente" id="btnActualizarCliente" class="btn btn btn-success" style="display: none;margin-top: 10px;">Actualizar</button>
										</div>
								</div>
							</div>
						</div>
					</div>
					<input id="idCliente" name="idCliente" style="display: none">
				  </div>
				</form>
			</div>
			
			
			<div class="row" style="margin-top: 20px;" id="div-create-policy">
				<div class="col-lg-12">
					<div class="panel panel-default" >
								<div class="panel-heading" style="color:#fff;background-color: #428bca;">
									Polizas
								</div>
						<div class="col-lg-7" style="margin-top: 15px;">	
											<div class="table-responsive">
												<table class="table table-hover">
													<thead>
														<tr>
															<th>Poliza</th>
															<th>Descripción</th>
															<th style="text-align: center;">Eliminar</th>
														</tr>
													</thead>
													<tbody id="idTBodyPolizas">
													</tbody>
												</table>
											</div>
											<!-- /.table-responsive -->
									</div>
						
								
						<div class="modal fade" id="myModalDelPolicy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header" style="margin-bottom: 20px;">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title" id="myModalLabel">Eliminar Poliza</h4>
									</div>

									<div class="row" style="text-align:center;">
										<div class="col-lg-12">
											<div class="form-group">
												<label>Estas intentando eliminar la poliza:</label>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<input id="idPolDel" name="idPolDel" value="" type="text" style="background-color:transparent;border-color: transparent;width: 70px;text-align: center;" disabled="true">
											</div>
										</div>
										<input id="idPol" name="idPol" style="display: none">
										<div class="col-lg-12">
											<div class="form-group">
												<label>¿Deseas Eliminar?</label>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
												&nbsp;&nbsp;&nbsp;&nbsp;
												<button type="button" class="btn btn-danger" id="idFilaBorrarPoliza" name="idFilaBorrarPoliza" data-dismiss="modal">Si</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>			
								
								
						<div class="col-lg-5" style="margin-top: 23px;">	
								<div class="row">
									<form role="form" method="POST" accept-charset='UTF-8' id="form-create-policy">
										<div class="col-lg-12">
											<div class="form-group">
												<label>Numero Poliza</label>
												<input id="idCodigoPoliza" name="idCodigoPoliza" class="form-control" placeholder="ej: sergio.valenzuela" required>
											</div>
										</div>

										<div class="col-lg-12">
											<div class="form-group">
												<label>Tipo de pólliza</label>
												<select class="form-control" id="idDescripcion" name="idDescripcion" required>
													<option value="">Seleccione</option>
													<option value="Generales">Generales</option>
													<option value="Especiales">Especiales</option>
													<option value="Contenedores">Contenedores</option>
										
												</select>
											</div>
										</div>

										<div class="col-lg-12">
											<div class="form-group">
												<button type="submit" formaction="<?=base_url() ?>index.php/clienteMantenedor/guardarPoliza" id="btnRegistrarPoliza" class="btn btn btn-success" style="display: none;margin-top: 10px;">Registrar</button>
											</div>
										</div>
										<input id="idClientePol" name="idClientePol" style="display: none">
									</form>
								</div>
						</div>
					</div>
				</div>
			</div>
			
<!--	EMPRESAS a Favor-->
<!--			<div class="row" style="margin-top: 20px;" id="div-create-afavor">
				<div class="col-lg-12">
					<div class="panel panel-default" >
						<div class="panel-heading" style="color:#fff;background-color: #428bca;">
							Empresas a Favor
						</div>
						<div class="col-lg-7" style="margin-top: 15px;">
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr>
											<th>Nº</th>
											<th>Nombre</th>
											<th style="text-align: center;">Eliminar</th>
										</tr>
									</thead>
									<tbody id="idTBodyAFavor">
									</tbody>
								</table>
							</div>
						</div>


						<div class="modal fade" id="myModalDelAFavor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header" style="margin-bottom: 20px;">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title" id="myModalLabel">Eliminar Empresa a Favor</h4>
									</div>

									<div class="row" style="text-align:center;">
										<div class="col-lg-12">
											<div class="form-group">
												<label>Estas intentando eliminar Empresa a Favor:</label>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<input id="idNombreDel" name="idNombreDel" value="" type="text" style="background-color:transparent;border-color: transparent;width: 150px;text-align: center;" disabled="true">
											</div>
										</div>
										<input id="idAfavorDel" name="idAfavorDel" style="display: none">
										<div class="col-lg-12">
											<div class="form-group">
												<label>¿Deseas Eliminar?</label>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
												&nbsp;&nbsp;&nbsp;&nbsp;
												<button type="button" class="btn btn-danger" id="idFilaBorraAfavor" name="idFilaBorraAfavor" data-dismiss="modal">Si</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>


						<div class="col-lg-5" style="margin-top: 23px;">
							<div class="row">
								<form role="form" method="POST" accept-charset='UTF-8' id="form-create-afavor">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Nombre Empresa a Favor</label>
											<input id="idNombreAfavor" name="idNombreAfavor" class="form-control" placeholder="ej: sergio.valenzuela" required>
										</div>
									</div>

									<div class="col-lg-12">
										<label>Rut</label>
										<div class="form-inline">
											<input type="number" maxlength="7" maxlength="8" name="idRutAFavor" id="idRutAFavor" class="form-control" style="width: 60%;display: inline-block;" required>
											&nbsp;-&nbsp;
											<input type="text" maxlength="1" name="idDvAFavor" id="idDvAFavor" class="form-control" style="width: 25%;display: inline-block;text-align: center;"  required>
										</div>
									</div>	

									<div class="col-lg-12">
										<div class="form-group">
											<button type="submit" formaction="<?=base_url() ?>index.php/clienteMantenedor/guardarAFavor" id="btnRegistrarAFavor" class="btn btn btn-success" style="display: none;margin-top: 10px;">Registrar</button>
										</div>
									</div>
									<input id="idClienteAFavor" name="idClienteAFavor" style="display: none">
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>-->		
		</div>
	</div>
</div>