<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div id="page-wrapper">
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Historial Pagos</h1>
	</div>
</div>
<!--<?php
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
							if (count($arrClientes) == 1) {
							?>
							<select class="form-control" readonly id="idClienteCert" name="idClienteCert" required>
								<?php
								foreach ($arrClientes as $index => $key) {
									echo '<option selected  value="'.$key["id_cliente"].'">'.$key["nombre_cliente"].'</option>';
								}
								?>
							</select>
							<?php
						} else {
							?>
							<select class="form-control" id="idClienteCert" name="idClienteCert" required>
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
					<div class="col-lg-3">
						<div class="form-group">
							<label>Año</label>
							<?php
							if ($this->session->userdata('perfil') == 2) {
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
						} else {
							?>
							<select class="form-control" id="idAnoCert" name="idAnoCert" disabled="true" required>
								<option selected value="0">Seleccione</option>
							</select>
							<?php } ?>
						</div>
					</div>
					<div class="col-lg-3">
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
							<button disabled="true" id="btnObtienePagos" class="btn btn btn-primary form-control">Obtener Pagos</button>
						</div>
					</div>
				</div>


				<!-- /.panel-heading -->
				<div class="panel-body" style="margin-top: 30px">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Item</th>
									<th>Nro Documento</th>
									<th>Fecha Emisión</th>
									<th>Monto</th>
									<th>Estado</th>
									<th style="text-align: center;">Factura</th>
								</tr>
							</thead>
							<tbody id="idCertificadosEmi">

								<?php if ($this->session->userdata('perfil') == 2) { ?>
								<tr>
									<td colspan="7" style="text-align: center">
										<div class="alert alert-warning" role="alert"> Seleccione Periodo</div></td>
								</tr>
								<?php } else { ?>
										<tr>
										<td colspan="7" style="text-align: center">
										<div class="alert alert-warning" role="alert"> Seleccione cliente y Periodo</div></td>
										</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
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
