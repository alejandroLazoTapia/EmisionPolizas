<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Historial Certificados</h1>
		</div>
	</div>
<!--	<?php
/*	echo "<pre>";
	print_r($arrClientes);
	print_r($arrCertificados);
	echo "</pre>";*/
	?>-->
	<div class="row">
		<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="color:#fff;background-color: #428bca;">
				Seleccione Periodo
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12" style="margin-bottom: 50px">
						<div class="col-lg-3">
							<div class="form-group">
								<label>Cliente</label>
								<?php
								if ($this->session->userdata('perfil') == 2) {
									if (is_null($arrClientes)) { ?>
										<select class="form-control" readonly id="idClienteCert" name="idClienteCert" required>
											<option selected value="">Seleccione</option>
										</select>
								<?php	}else{  if (count($arrClientes) == 1) {  ?>
											  	<select class="form-control" readonly id="idClienteCert" name="idClienteCert" required>
													<?php
												foreach ($arrClientes as $index => $key) {
													echo '<option selected value="'.$key["id_cliente"].'">'.$key["nombre_cliente"].'</option>';
												}
												?>
												</select>
											<?php  }else{ ?>
											  	<select class="form-control"  id="idClienteCert" name="idClienteCert" required>
											  	<option selected value="">Seleccione</option>
														<?php
													foreach ($arrClientes as $index => $key) {
														echo '<option value="'.$key["id_cliente"].'">'.$key["nombre_cliente"].'</option>';
													}
													?>
													</select>
								<?php
							} } } else {
								?>
									<select class="form-control" id="idClienteCert" name="idClienteCert" required>
									<option selected style="background-color: red" value="0">Todos</option>
									<option value="">Seleccione</option>
									<?php
								foreach ($arrClientes as $index => $key) {
									echo '<option value="'.$key["id_cliente"].'">'.$key["nombre_cliente"].'</option>';
								}
								?>
								</select>
								<?php } ?>
							</div>

						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label>Año</label>
									<?php
									if ($this->session->userdata('perfil') == 2) { 
										if (is_null($arrClientes)) { ?>
											<select readonly class="form-control" id="idAnoCert" name="idAnoCert" required>
											<option selected value="0">Seleccione</option>
											</select>
										<?php }else{
									?>
									<select class="form-control" id="idAnoCert" name="idAnoCert" required>
										<option selected value="0">Seleccione</option>
										<?php
									foreach ($arrAno as $index => $key) {
										echo '<option value="'.$key["ano"].'">'.$key["ano"].'</option>';
									}
									?>
									</select>
									<?php
								} } else {
									?>
									<select class="form-control" id="idAnoCert" name="idAnoCert" disabled="true" required>
										<option selected value="0">Seleccione</option>
									</select>
									<?php } ?>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="form-group">
								<label>Mes</label>
									<select class="form-control" id="idMesCert" name="idMesCert" disabled="true">
									<option selected value="">Seleccione</option>	
								</select>
							</div>
						</div>

						<div class="col-lg-2">
							<div class="form-group">
								<label>&nbsp;</label>
								<button disabled="true" id="btnObtieneCertificado" type="submit" class="btn btn btn-primary form-control">Obtener Certificados</button>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="form-group" style="text-align: right">
								<label>&nbsp;</label>
								<button style="background-color: transparent;margin-top: 23px;border-color: transparent;" type="submit" form="formExcel" ><img src="<?=base_url() ?>recursos/images/logo_excel.jpg" width="30" height="30"></button>
							</div>
						</div>						
					</div>

					<!-- /.panel-heading -->
					<div class="panel-body" style="margin-top: 30px">
						<div class="table-responsive">
							<table class="table table-hover">
							<?php if ($this->session->userdata('perfil') == 2) { ?>
								<thead>
									<tr>
										<th>Item</th>
										<th>Cliente</th>
										<th>Poliza</th>
										<th>Nro Certificado</th>
										<th>FechaEmision</th>
										<th>Usuario Emision</th>
										<th style="text-align: center;">Descargar</th>
									</tr>
								</thead>
							<?php } else{ ?>
								<thead>
									<tr>
										<th>Item</th>
										<th>Cliente</th>
										<th>Poliza</th>
										<th>Nro Certificado</th>
										<th>FechaEmision</th>
										<th>Usuario Emision</th>
										<th style="text-align: center;">Descargar</th>
										<th style="text-align: center;">Anular</th>
									</tr>
								</thead>
							<?php } ?>	
								<tbody id="idCertificadosEmi">

										<?php if ($this->session->userdata('perfil') == 2) { ?>
										<tr>
											<td colspan="7" style="text-align: center">
												<div class="alert alert-warning" role="alert"> Seleccione cliente y periodo</div></td>
										</tr>
										<?php
									} else if (!empty($arrCertificados)) {
										$i = 1;
										foreach ($arrCertificados as $index => $key) {
											if($key['estado_reg'] == 0){
												echo '<tr style="background-color: #FCAAAA;">';
											}else{
												echo'<tr>';
											}
											
											echo '<td>'.$i.'</td>';
											echo '<td>'.$key["nombre_cliente"].'</td>';
											echo '<td>'.$key["codigo_poliza"].'</td>';
											echo '<td>'.$key["id_certificado"].'</td>';
											echo '<td>'.$key["fecha_emision"].'</td>';
											echo '<td>'.$key["usuario"].'</td>';
										?>
										<td style="text-align: center;">
											<a class="idDescargarCertificado">
												<span class="glyphicon glyphicon-download-alt"></span>
											</a>
										</td>
										<?php
										if($key['estado_reg'] == 0){
											echo '<td style="text-align: center;"><b>Anulado</b></td>';
											}else{ ?>
											<td style="text-align: center;">
												<a class="idAnulaCertificado" data-toggle="modal" data-target="#myModalAnular">
													<span class="glyphicon glyphicon glyphicon-remove"></span>
												</a>
											</td>
										<?php } 			
								
										echo '<td style="display:none">'.$key["id_cliente"].'</td>';
										echo '<td style="display:none">'.$key["id_poliza"].'</td>';
										echo '<td style="display:none">'.$key["id_pais_emision"].'</td>';
										echo'</tr>';
										$i = $i +1;
									}
									}else{
										?>
										<tr>
											<td colspan="7" style="text-align: center">
												<div class="alert alert-warning" role="alert">Seleccione cliente y periodo</div></td>
										</tr>
										<?php
									}
								?>
								</tbody>
							</table>
						</div>
			<form role="form" id="formExcel" action="<?=base_url() ?>index.php/historialCertificado/generar_excel/"  method="post" accept-charset='UTF-8' target="_blank" style="display: none">
				<input id="idClienteExcel" name="idClienteExcel" form="formExcel">
				<input id="idAnoExcel" name="idAnoExcel" form="formExcel">
				<input id="idMesExcel" name="idMesExcel" form="formExcel">
			</form>	
		</div>
				
	<!--Modal delete-->
				<div class="modal fade" id="myModalAnular" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
										<label>Nº </label> <input id="idCertAnu" name="idCertAnu"  type="text" style="background-color:transparent;border-color: transparent;width: 100px;text-align: center;" disabled="true">
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
										<button type="button" class="btn btn-danger" id="btnAnularCertificado" name="btnObtieneDatos" data-dismiss="modal">Si</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="form-group" style="text-align: right">
					<label>&nbsp;</label>
					<button style="background-color: transparent;margin-top: 13px;border-color: transparent;" type="submit" form="formExcel" ><img src="<?=base_url() ?>recursos/images/logo_excel.jpg" width="30" height="30"></button>
				</div>
			</div>
		</div>    
			<!--GENERA EL PDF-->
			<form role="form" id="formPDF" action="<?=base_url() ?>index.php/formularioEmision/descargarPdf/"  method="post" accept-charset='UTF-8' target="_blank" style="display: none">
				<input id="idCertificadoPdf" name="idCertificadoPdf" form="formPDF">
				<input id="idPolizaPdf" name="idPolizaPdf" form="formPDF">
				<input id="idClientePdf" name="idClientePdf" form="formPDF">
				<input id="idPaisEmisionPdf" name="idPaisEmisionPdf" form="formPDF">
			</form>	 
</div>
