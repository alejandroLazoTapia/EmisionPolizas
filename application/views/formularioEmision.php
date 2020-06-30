<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Emisión Certificado</h1>
			</div>

			<div class="col-lg-12">
			<button  class="btn btn-success btn" onclick="showForm()" style="font-size: 15px;text-align: center;width: 150px;height: 40px;margin-top: 10px;">
						Nuevo
					</button>
				&nbsp;&nbsp;
			<button class="btn btn-warning btn" data-toggle="modal" data-target="#myModal" style="font-size: 15px;text-align: center;width: 150px;height: 40px;margin-top: 10px;" onclick="showModalGetCertificate()">
						Obtener Datos
					</button>
			</div>			
			<div class="col-lg-12">		
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header" style="margin-bottom: 20px;">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Obtener Certificado Previo</h4>
							</div>

								<div class="row">
									<div class="col-lg-12">
										<div class="col-lg-12">
											<div class="form-group">
												<label>Cliente</label>
												<select class="form-control" id="idClientes" name="idClientes" required>
													<option value="0">Seleccione</option>
													<?php
													if (count($arrClientes)==1) {
														foreach ($arrClientes as $index => $key) {
															echo '<option selected value="'.$key["id_cliente"].'">'.$key["nombre_cliente"].'</option>';
														}
													} else {
														foreach ($arrClientes as $index => $key) {
															echo '<option value="'.$key["id_cliente"].'">'.$key["nombre_cliente"].'</option>';
														}
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label>Póliza</label>
												<select class="form-control" id="idPolizas" name="idPolizas" disabled="true">
													<option value="0">Seleccione</option>
												</select>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label>Certificado</label>
										<select class="form-control" id="idCertificados" name="idCertificados" disabled="true">
													<option value="0">Seleccione</option>
												</select>
											</div>
										</div>
									</div>
								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Volver</button>
								<button type="button" class="btn btn-success" id="btnObtieneDatos" name="btnObtieneDatos" data-dismiss="modal" disabled="true">Obtener Datos</button>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /.row -->
		
		<div class="row" style="margin-top: 20px;">
			<form role="form" method="post" accept-charset='UTF-8' id="form-create-certificate">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading" style="color:#fff;background-color: #428bca;">
							Información principal
						</div>
					<div class="panel-body">
						<div class="row">
						<?php if ($this->session->userdata('perfil') == 2) { 
						        if (is_null($arrClientes)) { ?>
							        <div class="col-lg-12">
								        <div class="col-lg-4">
											<div class="form-group">
												<label>Cliente</label>
								        		<select class="form-control" readonly id="idClienteCert" name="idClienteCert" required>
													<option selected value="">Seleccione</option>
												</select>
											</div>
										</div>		
										<div class="col-lg-4" >
											<div class="form-group">
												<label>RUT/DNI</label>
												<input readonly class="form-control valform" id="idRutDni" name="idRutDni">
											</div>	
										</div>
											<div class="col-lg-4" >
												<div class="form-group">
													<label>Teléfono</label>
													<input readonly class="form-control valform" id="idTelefono" name="idTelefono">
												</div>
											</div>
										</div>
										<div class="col-lg-12">	
											<div class="col-lg-6">
												<div class="form-group">
													<label>Dirección</label>
													<input readonly class="form-control valform" id="idDireccion" name="idDireccion"  required>
												</div>
											</div>
											<div class="col-lg-6" >
												<div class="form-group">
													<label>Condiciones</label>
													<input readonly class="form-control valform" id="idCondiciones" name="idCondiciones">
												</div>
											</div>
										</div>
						   <?php } else{ if (count($arrClientes) == 1) {  ?>
						   	<div class="col-lg-12">
								<div class="col-lg-4">
									<div class="form-group">
										<label>Cliente</label>
													<select readonly class="form-control valform"  id="idCliente" name="idCliente" required>
													<?php
													foreach ($arrClientes as $index => $key) {
														echo '<option selected value="'.$key["id_cliente"].'">'.$key["nombre_cliente"].'</option>';
													}
													?>
													</select>	
									</div>
								</div>
								<div class="col-lg-4" >
									<div class="form-group">
										<label>RUT/DNI</label>
										<?php
										foreach ($arrClientes as $index => $key) {
											echo '<input readonly class="form-control valform" id="idRutDni" name="idRutDni" value="'.$key["rut_dni"].'">';
										}
										?>
									</div>	
								</div>
								<div class="col-lg-4" >
									<div class="form-group">
										<label>Teléfono</label>
										<?php
										foreach ($arrClientes as $index => $key) {
											echo '<input readonly class="form-control valform" id="idTelefono" name="idTelefono" value="'.$key["telefono"].'">';
										}
										?>
									</div>
								</div>
							</div>
							<div class="col-lg-12">	
								<div class="col-lg-6">
									<div class="form-group">
										<label>Dirección</label>
										<?php
										foreach ($arrClientes as $index => $key) {
											echo '<input readonly class="form-control valform" id="idDireccion" name="idDireccion" value="'.$key["telefono"].'">';
										}
										?>
									</div>
								</div>
								<div class="col-lg-6" >
									<div class="form-group">
										<label>Condiciones</label>
										<?php
										foreach ($arrClientes as $index => $key) {
											echo '<input readonly class="form-control valform" id="idCondiciones" name="idCondiciones" value="'.$key["condiciones"].'">';
										}
										?>
									</div>
								</div>
							</div>
						   	<?php } else{ ?>
											<div class="col-lg-12">
												<div class="col-lg-4">
													<div class="form-group">
														<label>Cliente</label>
														<select class="form-control valform" id="idCliente" name="idCliente" required>
																		<?php
																		echo '<option selected value="">Seleccione</option>';
																		foreach ($arrClientes as $index => $key) {
																			echo '<option value="'.$key["id_cliente"].'">'.$key["nombre_cliente"].'</option>';
																		}
																		?>
																	</select>
													</div>
												</div>
												<div class="col-lg-4" >
													<div class="form-group">
														<label>RUT/DNI</label>
														<input readonly class="form-control valform" id="idRutDni" name="idRutDni">
													</div>	
												</div>
												<div class="col-lg-4" >
													<div class="form-group">
														<label>Teléfono</label>
														<input readonly class="form-control valform" id="idTelefono" name="idTelefono">
													</div>
												</div>
											</div>
											<div class="col-lg-12">	
												<div class="col-lg-6">
													<div class="form-group">
														<label>Dirección</label>
														<input readonly class="form-control valform" id="idDireccion" name="idDireccion"  required>
													</div>
												</div>
												<div class="col-lg-6" >
													<div class="form-group">
														<label>Condiciones</label>
														<input readonly class="form-control valform" id="idCondiciones" name="idCondiciones">
													</div>
												</div>
						 					</div>
				<?php } } } else { ?>
							<div class="col-lg-12">
								<div class="col-lg-4">
									<div class="form-group">
										<label>Cliente</label>
										<select class="form-control valform" id="idCliente" name="idCliente" required>
														<?php
														echo '<option selected value="">Seleccione</option>';
														foreach ($arrClientes as $index => $key) {
															echo '<option value="'.$key["id_cliente"].'">'.$key["nombre_cliente"].'</option>';
														}
														?>
													</select>
									</div>
								</div>
								<div class="col-lg-4" >
									<div class="form-group">
										<label>RUT/DNI</label>
										<input readonly class="form-control valform" id="idRutDni" name="idRutDni">
									</div>	
								</div>
								<div class="col-lg-4" >
									<div class="form-group">
										<label>Teléfono</label>
										<input readonly class="form-control valform" id="idTelefono" name="idTelefono">
									</div>
								</div>
							</div>
							<div class="col-lg-12">	
								<div class="col-lg-6">
									<div class="form-group">
										<label>Dirección</label>
										<input readonly class="form-control valform" id="idDireccion" name="idDireccion"  required>
									</div>
								</div>
								<div class="col-lg-6" >
									<div class="form-group">
										<label>Condiciones</label>
										<input readonly class="form-control valform" id="idCondiciones" name="idCondiciones">
									</div>
								</div>
							</div>
								<?php
							}
							?>
							
							
							<div class="col-lg-12">	
								<div class="col-lg-4">
									<div class="form-group">
										<label>Póliza</label>
										<select class="form-control valform" id="idPoliza" name="idPoliza" disabled="true" required>
												<option value="">Seleccione</option>
											</select>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>País Emisión</label>
										<select class="form-control valform" id="idPaisEmision" name="idPaisEmision" required>
											<option value="">Seleccione</option>
											<?php
								foreach ($arrPaisesEmision as $index => $key) {
									echo '<option value="'.$key["id_pais"].'">'.$key["nombre_pais"].'</option>';
								}
								?>
										</select>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>Referencia Interna</label>
										<input class="form-control valform" placeholder="" id="idRefInterna"  name="idRefInterna" required>
									</div>
								</div>
							</div>
								
							
						</div>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading" style="color:#fff;background-color: #428bca;" >
						Costos
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="col-lg-4">
									<div class="form-group">
										<label>Moneda</label>
										<select class="form-control valform" id="idMoneda" name="idMoneda" required>
											<option value="">Seleccione</option>
												<?php
												foreach ($arrMoneda as $index => $key) {
													echo '<option value="'.$key["id_moneda"].'">'.$key["nombre_moneda"].'</option>';
												}
												?>
										</select>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>Deducible</label>
										<input class="form-control valform" placeholder="" id="idDeducible" name="idDeducible" required></input>

									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>Monto Asegurado</label>
										<input min="1" class="form-control valform miles" placeholder="" id="idMontoAsegurado" name="idMontoAsegurado" required>
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="col-lg-4">
									<div class="form-group">
										<label>Tasa</label>
										<input class="form-control valform" step="0.01" placeholder="ej: 0,15% del monto asegurado" id="idTasa" name="idTasa" required>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>Clausula</label>
										<select class="form-control valform" id="idClausula" name="idClausula" required>
											<option value="">Seleccione</option>
												<?php
												foreach ($arrClausula as $index => $key) {
													echo '<option value="'.$key["id_clausula"].'">'.$key["nombre_clausula"].'</option>';
												}
												?>
										</select>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>Prima</label>
										<input class="form-control valform miles" id="idPrima" name="idPrima" required>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading" style="color:#fff;background-color: #428bca;">
						Viaje
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="col-lg-4">
									<div class="form-group">
										<label>Fecha Embarque</label>
										<div class='input-group date'>
											<input type='date' class="form-control valform" id="idFechaEmbarque" name="idFechaEmbarque" required>
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
									</div>
								</div>

								<div class="col-lg-4">
									<div class="form-group">
										<label>Fecha de Arribo</label>
										<div class='input-group date'>
											<input type="date" class="form-control valform" id="idFechaArribo" name="idFechaArribo" required>
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
									</div>
								</div>


								<div class="col-lg-4">
									<div class="form-group">
										<label>Guía o BL</label>
										<input class="form-control valform" placeholder="Ej: LFLSHA91210504" id="idGuiaBl" name="idGuiaBl" required>
									</div>
								</div>
							</div>

							<div class="col-lg-12">
								<div class="col-lg-4">
									<div class="form-group">
										<label>Nombre Linea Aerea/Compañia naviera</label>
										<input class="form-control valform" placeholder="Ej: Latam" id="idNomLineaNave" name="idNomLineaNave" required>
									</div>
								</div>

								<div class="col-lg-4">
									<div class="form-group">
										<label>Nombre Nave/Motonave</label>
										<input class="form-control valform" placeholder="Ej: Edbac" id="idNomNave" name="idNomNave" required>
									</div>
								</div>

								<div class="col-lg-4">
									<div class="form-group">
										<label>Número Vuelo/Nave</label>
										<input class="form-control valform" placeholder="Ej: L-123" id="idNumVueloNave" name="idNumVueloNave" required>
									</div>
								</div>

							</div>

							<div class="col-lg-12">

								<div class="col-lg-6">
									<div class="form-group">
										<label>Tipo de Embalaje</label>
										<select class="form-control valform" id="idTipoEmbalaje" name="idTipoEmbalaje" required>
											<option value="">Seleccione</option>
												<?php
												foreach ($arrTipoEmbalaje as $index => $key) {
													echo '<option value="'.$key["id_embalaje"].'">'.$key["tipo_embalaje"].'</option>';
												}
												?>
										</select>
									</div>
								</div>

								<div class="col-lg-6">
									<div class="form-group">
										<label>Otro</label>
										<input class="form-control" placeholder="ej: Full Consolidado" id="idOtroTipEmb" name="idOtroTipEmb" disabled="true" >
									</div>
								</div>
							</div>

							<div class="col-lg-12">
								<div class="col-lg-4">
									<div class="form-group">
										<label>Transporte</label>
										<select class="form-control valform" id="idTransporte" name="idTransporte" required>
											<option value="">Seleccione</option>
												<?php
												foreach ($arrTransporte as $index => $key) {
													echo '<option value="'.$key["id_transporte"].'">'.$key["tipo_transporte"].'</option>';
												}
												?>
										</select>
									</div>
								</div>

								<div class="col-lg-2">
									<div class="form-group">
										<label>Tipo Embarque</label>
										<div class="radio">
											<label>
													<input type="radio" name="idTipoEmbarque" value="1" id="idImportacion"  checked>Importación
											</label>
										</div>
										<div class="radio">
											<label>
													<input type="radio" name="idTipoEmbarque" value="2" id="idExportacion" >Exportación
											</label>
										</div>
										<div class="radio">
											<label>
													<input type="radio" name="idTipoEmbarque" value="3" id="idEmbNacional" >Embarque Nacional
											</label>
										</div>
									</div>
								</div>

								<div class="col-lg-6">
									<div class="form-group">
										<label>Descripción de la Mercadería</label>
										<textarea style="resize: none;" class="form-control valform" rows="7" maxlength="500" id="idDescMercaderia" name="idDescMercaderia" required></textarea>
										<div id="contador" style="text-align: right;font-style: italic;">500 caracteres max.</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


				<div class="panel panel-default">
					<div class="panel-heading" style="color:#fff;background-color: #428bca;">
						Origen
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="col-lg-4">
									<div class="form-group">
										<label>Pais</label>
										<input class="form-control valform" placeholder="Ej: China" id="idPaisOrigen" name="idPaisOrigen" required>
									<!--	<select class="form-control valform" id="idPaisOrigen" name="idPaisOrigen" required>
											<option value="">Seleccione</option>
													<?php
													foreach ($arrPaises as $index => $key) {
														echo '<option value="'.$key["id_pais"].'">'.$key["nombre_pais"].'</option>';
													}
													?>
										</select>-->
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>Ciudad</label>
										<input class="form-control valform" placeholder="Ej: Shanghái" id="idCiudadOrigen" name="idCiudadOrigen" required>
									<!--	<select class="form-control valform" id="idCiudadOrigen" name="idCiudadOrigen" required>
												<option value="">Seleccione</option>
											</select>-->
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>Puerto</label>
										<input class="form-control valform" placeholder="Ej: Puerto de Shanghái" id="idPuertoOrigen" name="idPuertoOrigen" required>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading" style="color:#fff;background-color: #428bca;">
						Destino
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="col-lg-4">
									<div class="form-group">
										<label>Pais</label>
										<input class="form-control valform" placeholder="Ej: Chile" id="idPaisDestino" name="idPaisDestino" required>	
								<!--		<select class="form-control valform" id="idPaisDestino" name="idPaisDestino" required>
												<option value="">Seleccione</option>
													<?php
													foreach ($arrPaises as $index => $key) {
														echo '<option value="'.$key["id_pais"].'">'.$key["nombre_pais"].'</option>';
													}
													?>
											</select>-->
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>Ciudad</label>
										<input class="form-control valform" placeholder="Ej: Santiago" id="idCiudadDestino" name="idCiudadDestino" required>
							<!--<select class="form-control valform" id="idCiudadDestino" name="idCiudadDestino" required>
												<option value="">Seleccione</option>
											</select>	-->		
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>Puerto</label>
										<input class="form-control valform" placeholder="Ej: Puerto de san antonio" id="idPuertoDestino" name="idPuertoDestino" required>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
					<input id="idCertActivo" name="idCertActivo" style="display: none">
				<?php
				if ($this->session->userdata('perfil') == 1) {
				?>
				<div class="col-lg-12 " style="margin-bottom: 40px;">
					<div class="col-lg-4">
						<div class="form-group">
							<button style="font-size: 15px;text-align: center;width: 150px;height: 40px;" type="submit" formaction="<?=base_url() ?>index.php/formularioEmision/guardarCertificado" class="btn btn btn-success">Emitir</button>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<button style="font-size: 15px;text-align: center;width: 150px;height: 40px;background-color: #6675df" type="submit" formaction="no" id="btnModalUpd" name="btnModalUpd" class="btn btn btn-primary"  disabled="true">Actualizar</button>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<button style="font-size: 15px;text-align: center;width: 150px;height: 40px;" id="btnModalEli" name="btnModalEli" type="button" class="btn btn btn-danger" data-toggle="modal" data-target="#myModalDelete" disabled="true">Anular</button>
						</div>
					</div>
				</div>
				<?php }else{
				?>
				<div class="col-lg-12 " style="margin-bottom: 40px;">
					<div class="col-lg-4">
						<div class="form-group">
							<button style="font-size: 15px;text-align: center;width: 150px;height: 40px;" type="submit" formaction="<?=base_url() ?>index.php/formularioEmision/guardarCertificado" class="btn btn btn-success">Emitir</button>
						</div>
					</div>
				</div>
				<?php	
				} 
				?>
			</div>
			</form>		

<!--GENERA EL PDF-->
		<form role="form" id="formPDF" action="<?=base_url() ?>index.php/formularioEmision/descargarPdf/"  method="post" accept-charset='UTF-8' target="_blank" style="display: none">	
			<input id="idCertificadoPdf" name="idCertificadoPdf" form="formPDF">
			<input id="idPolizaPdf" name="idPolizaPdf" form="formPDF">
			<input id="idClientePdf" name="idClientePdf" form="formPDF">	
			<input id="idPaisEmisionPdf" name="idPaisEmisionPdf" form="formPDF">
		</form>		
			
			<div class="modal fade" id="myModalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header" style="margin-bottom: 20px;">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="myModalLabel">Actualizando Certificado</h4>
						</div>

						<div class="row"  style="text-align:center;">
							<div class="col-lg-12">
								<div class="form-group">
									<label>Estas intentando actualizar el certificado</label>  
								</div>	
							</div>
								<div class="col-lg-12">
									<div class="form-group">
									<label>Nº</label><input id="idCertAct" name="idCertAct" value="" type="text" style="background-color:transparent;border-color: transparent;width: 70px;text-align: center;" disabled="true">
									</div>
								</div>	
								
								<div class="col-lg-12">
									<div class="form-group">
										<label>¿Deseas Actualizar?</label>
									</div>
								</div>	
								<div class="col-lg-12">
									<div class="form-group">
									<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
									&nbsp;&nbsp;&nbsp;&nbsp;
								<button class="btn btn-primary" id="btnActualizarCertificado" data-dismiss="modal">Si</button>
									</div>
								</div>	
							</div>
						</div>
					</div>
				</div>

			
			<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header" style="margin-bottom: 20px;">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="myModalLabel">Eliminar Certificado</h4>
						</div>

						<div class="row" style="text-align:center;">
							<div class="col-lg-12">
								<div class="form-group">
									<label>Estas intentando eliminar el certificado</label>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label>Nº </label> <input id="idCertEli" name="idCertEli"  type="text" style="background-color:transparent;border-color: transparent;width: 100px;text-align: center;" disabled="true">
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
									<button type="button" class="btn btn-danger" id="btnEliminarCertificado" name="btnObtieneDatos"
										data-dismiss="modal">Si</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>


