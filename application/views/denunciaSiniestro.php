<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

	<?php
/*echo "
<pre>";
print_r(is_null($arrPolizas));
echo "</pre>";*/
	?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Denunciar Siniestro</h1>
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
									  	<div class="col-lg-6">
												<div class="col-lg-12">
													<div class="form-group">
														<label>Cliente</label>
													<?php if (count($arrClientes) == 1) { ?>
														  <select class="form-control" readonly id="idClienteSiniestro" name="idClienteSiniestro" required>
															<?php
																foreach ($arrClientes as $index => $key) {
																	echo '<option selected  value="'.$key["id_cliente"].'">'.$key["nombre_cliente"].'</option>';
																}
															?>
															</select>
															<?php
														} else {
															?>
															<select class="form-control" id="idClienteSiniestro" name="idClienteSiniestro" required>
																<option selected value="0">Seleccione</option>
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
																	<th>Ingreso</th>
																	<th>Estado</th>
																	<th style="text-align: center;">Ver</th>
																</tr>
															</thead>
														<tbody id="idTBodySiniestros">

															<?php
													if (!empty($arrSiniestros)) {
														if ($this->session->userdata('perfil')==1) {
														?>
														<tr>
															<td colspan="4">
																<div class="alert alert-warning" role="alert"> Seleccione Cliente</div></td>
														</tr>
														<?php 
														}else{
													$i = 1;
													foreach ($arrSiniestros as $index => $key) {
														echo"<tr>";
														echo '<td>'.$key["id_siniestro"].'</td>';
														echo '<td>'.$key["id_certificado"].'</td>';
														echo '<td>'.$key["fecha_ingreso"].'</td>';
														echo '<td>'.$key["estado_siniestro"].'</td>';
												?>
															<td style="text-align: center;">
																<a class="idVerSiniestro">
																	<span class="glyphicon glyphicon-eye-open"></span>
																</a>
															</td>
															<?php
															echo'</tr>';
																		$i = $i +1;
																	}
																}
														} else {
															if ($this->session->userdata('perfil')==1){
															
																?>
																			<tr>
																				<td colspan="4">
																					<div class="alert alert-warning" role="alert"> Seleccione Cliente</div></td>
																			</tr>
																		<?php 	} else {


																		?>
																		<tr>
																			<td colspan="4">
																				<div class="alert alert-warning" role="alert"> Cliente no posee sinietros ingresados</div></td>
																		</tr>
																		<?php
																	}
																}
																		?>
															</tbody>
														</table>
													</div><!-- /.table-responsive -->
												</div>

												
												<!--//modal de ver siniestro-->
												<div class="modal fade" id="myModalSinester" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header" style="margin-bottom: 20px;">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																<h4 class="modal-title" id="myModalLabel">Detalle Siniestro</h4>
																<div class="col-lg-12">
																	
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										<div class="col-lg-6">
											<div class="col-lg-12">
												<div class="form-group">
													<label>Póliza</label>
													
													<?php 
													if ($this->session->userdata('perfil') == 1) {
													?>
													<select class="form-control" id="idPolizaSiniestro" name="idPolizaSiniestro" required disabled="true">
														<option value="">Seleccione</option>
													</select>
													<?php
												} else {
													?>
													<select class="form-control" id="idPolizaSiniestro" name="idPolizaSiniestro" required>
													<option value="">Seleccione</option>
													<?php
								
														foreach ($arrPolizas as $arrPoliza => $key) {
															echo '<option value="'.$key["id_poliza"].'">'.$key["nombre_poliza"].'</option>';
													}
												}
														?>
													</select>
													
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group">
													<label>Certificado</label>
													<select class="form-control" id="idCertificadoSiniestro" name="idCertificadoSiniestro" required disabled="true">
														<option value="">Seleccione</option>
													</select>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group">
													<label>Detalle Siniestro</label>
													<textarea class="form-control valform" rows="13" id="idDetalle" name="idDetalle" required></textarea>
												</div>
											</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label>Monto</label>
														<input class="form-control" placeholder="ej: 400.000" id="idMonto" name="idMonto" required>
													</div>
												</div>	
												<div class="col-lg-6">	
													<div class="form-group">
														<label>Fecha Siniestro</label>
														<input type="date" class="form-control" placeholder="" id="idFecha" name="idFecha" required>
													</div>
												</div>	
											
											<div class="col-lg-12">
												<div class="form-group">
													<label>Subir Archivo</label>
													<input type="file" onchange="encodeImageFileAsURL(this)" name="idArchivo" title="seleccionar archivo" id="idArchivo" accept=".xls,.xlsx,.pdf,.PDF,.JPG,.jpg, .PNG, .png" required form="form-create-sinister"/>
												</div>
											</div>
											<div class="col-lg-12">
													<div class="form-group">
													<button type="submit" formaction="<?=base_url() ?>index.php/denunciaSiniestro/guardarSiniestro" class="btn btn btn-success" style="margin-top: 10px;">Registrar</button>
													</div>
											</div>
										</div> <!--//cierre columna 6 "ingreso de datos"-->
									</div>	<!--//cierre grilla completa"-->									
								</div>
							</div>
						</div>
						<textarea style="display: none" class="form-control valform" rows="13" id="Base64Img" name="Base64Img"></textarea>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>	
	