<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Registro de Siniestros</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="row" style="margin-top: 20px;">
				<form role="form" method="POST" accept-charset='UTF-8' id="form-create-sinister">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading" style="color:#fff;background-color: #428bca;">
								Ingresar Información Siniestro
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-12">
									  	<div class="col-lg-7">
												<div class="col-lg-12">
													<div class="form-group">
														<label>Cliente</label>
													<?php if ($this->session->userdata('perfil') == 2) { 
															 if (is_null($arrClientes)) {
													?>
													<select readonly class="form-control" id="idClienteSiniestro" name="idClienteSiniestro" required>
														<option selected value="">Seleccione</option>
														</select>
															<?php
														}else if (count($arrClientes) > 1 ) { ?>
															<select class="form-control" id="idClienteSiniestro" name="idClienteSiniestro" required>
															<option value="0" style="background-color: red">Todos</option>
																<option selected value="">Seleccione</option>
															<?php
																foreach ($arrClientes as $index => $key) {
																	echo '<option value="'.$key["id_cliente"].'">'.$key["nombre_cliente"].'</option>';
																}
															?>
																</select>
														<?php
														}else { ?>
															
															  <select class="form-control" readonly id="idClienteSiniestro" name="idClienteSiniestro" required>
															<?php
																foreach ($arrClientes as $index => $key) {
																	echo '<option selected  value="'.$key["id_cliente"].'">'.$key["nombre_cliente"].'</option>';
																}
															?>
															</select>
													<?php }
													} else {
													?>
													<select class="form-control" form="form-create-sinister" id="idClienteSiniestro" name="idClienteSiniestro" required>
																<option value="0" style="background-color: red;">Todos</option>
																<option selected value="">Seleccione</option>
																<?php
															foreach ($arrClientes as $index => $key) {
																echo '<option value="'.$key["id_cliente"].'">'.$key["nombre_cliente"].'</option>';
															}
															?>
															</select>
															<?php } ?>
													</div>
												</div>

												<div class="col-lg-12">	
													<div class="table-responsive">
														<table class="table table-hover">
															<thead>
																<tr>
																	<th>Nro Siniestro</th>
																	<th>Nro Certificado</th>
																	<th>Nro Póliza</th>
																	<th>Ingreso</th>
																	<th>Monto</th>
																	<th style="text-align: center">Ver Adjunto</th>
																</tr>
															</thead>
														<tbody id="idTBodySiniestros">
													    <?php if ($this->session->userdata('perfil') == 2) { 
													    		if (is_null($arrSiniestros))
																	{ ?>
																		<tr>
																			<td colspan="6" style="text-align: center">
																				<div class="alert alert-warning" role="alert"> No hay siniestros registrados</div></td>
																		</tr>
																	<?php 
																}else if(count($arrClientes)>1){ ?>
																		<tr>
																			<td colspan="6" style="text-align: center">
																				<div class="alert alert-warning" role="alert"> Seleccione Cliente</div></td>
																		</tr>
																<?php }else{
																	
																foreach ($arrSiniestros as $index => $key) {
																	echo"<tr>";
																	echo '<td>'.$key["id_siniestro"].'</td>';
																	echo '<td>'.$key["id_certificado"].'</td>';
																	echo '<td>'.$key["poliza"].'</td>';
																	echo '<td>'.$key["fecha_ingreso"].'</td>';
																	echo '<td>'.$key["monto"].'</td>';
																	echo '<td style="text-align: center"><a id="btnVerSiniestro" data-toggle="modal" data-target="#myModalSinester"><span class="glyphicon glyphicon-eye-open" ></span></a></td>';
																	echo"</tr>";
																}
																?>
															
														<?php } }else { ?>
															<tr>
																<td colspan="6" style="text-align: center">
																	<div class="alert alert-warning" role="alert"> Seleccione Cliente</div></td>
															</tr>
															<?php } ?>
															</tbody>
														</table>
													</div><!-- /.table-responsive -->
												</div>

												
												<!--//modal de ver imagen siniestro-->
												<div class="modal fade" id="myModalSinester" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
													<div class="modal-body">
														<div class="modal-content">
															<div class="modal-header" style="margin-bottom: 20px;">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																<h4 class="modal-title" id="myModalLabel">Archivo adjunto</h4>
																
															</div>
															<iframe id="iframePdf" style="display:none" src="" height="580px" width="100%"></iframe>
															
															<div style="margin:40px;text-align:center" id="imageContainer"></div>
														</div>
													</div>
												</div>
											</div>
										<div class="col-lg-5">
											<div class="col-lg-12">
												<div class="form-group">
													<label>Póliza</label>
													
													<?php 
													if ($this->session->userdata('perfil') == 1) {
													?>
													<select class="form-control" id="idPolizaSiniestro" name="idPolizaSiniestro" disabled="true" required>
														<option value="">Seleccione</option>
													</select>
													<?php
												} else {
													if (is_null($arrClientes)){ ?>
														<select readonly class="form-control" id="idPolizaSiniestro" name="idPolizaSiniestro" required>
														<option value="">Seleccione</option>
														</select>
													<?php }
													else{ ?>
													<select class="form-control" id="idPolizaSiniestro" name="idPolizaSiniestro" required>
													<option value="">Seleccione</option>
													<?php
														foreach ($arrPolizas as $arrPoliza => $key) {
															echo '<option value="'.$key["id_poliza"].'">'.$key["nombre_poliza"].'</option>';
													}
														?>
													</select>
													<?php } } ?>
													
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group">
													<label>Certificado</label>
													<select class="form-control" id="idCertificadoSiniestro" name="idCertificadoSiniestro"  disabled="true" required>
														<option value="0">Seleccione</option>
													</select>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group">
													<label>Detalle Siniestro</label>
													<textarea disabled="true" class="form-control valform" rows="13" id="idDetalle" name="idDetalle" required></textarea>
												</div>
											</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label>Monto</label>
														<input disabled="true" class="form-control miles" min="1" placeholder="" id="idMonto" name="idMonto" required>
													</div>
												</div>	
												<div class="col-lg-6">	
													<div class="form-group">
														<label>Fecha Siniestro</label>
														<input disabled="true" type="date" class="form-control" placeholder="" id="idFecha" name="idFecha" required>
													</div>
												</div>	
											
											<div class="col-lg-12">
												<div class="form-group">
													<label>Subir Archivo</label>
													<input disabled="true" type="file" onchange="encodeImageFileAsURL(this)" name="idArchivo" title="seleccionar archivo" id="idArchivo" accept=".pdf,.PDF,.JPG,.jpg,.PNG,.png" required form="form-create-sinister"/>
												</div>
											</div>
											<div class="col-lg-12">
													<div class="form-group">
													<button disabled="true" type="submit" formaction="<?=base_url() ?>index.php/denunciaSiniestro/guardarSiniestro" class="btn btn btn-success" id="btnSiniestro" name="btnSiniestro" style="margin-top: 10px;">Registrar</button>
													</div>
											</div>
										</div> <!--//cierre columna 6 "ingreso de datos"-->
									</div>	<!--//cierre grilla completa"-->									
								</div>
							</div>
						</div>
						<textarea style="display: none" class="form-control valform" rows="13" id="Base64Img" name="Base64Img"></textarea>
						<textarea style="display: none" class="form-control valform" rows="13" id="idExtencion" name="idExtension"></textarea>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>	
	