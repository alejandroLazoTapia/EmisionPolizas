<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div id="page-wrapper">
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Prima Mensual</h1>
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
							if ($this->session->userdata('perfil') == 2) {
								if (is_null($arrClientes)) { ?>
									<select readonly class="form-control" id="idClientePrima" name="idClientePrima" required>
										<option selected value="">Seleccione</option>
									</select> 
							<?php } else { if (count($arrClientes) == 1) {  ?>
											<select readonly class="form-control" id="idClientePrima" name="idClientePrima" required>
												<?php
												foreach ($arrClientes as $index => $key) {
													echo '<option selected  value="'.$key["id_cliente"].'">'.$key["nombre_cliente"].'</option>';
												}
												?>
											</select>
									<?php	}else{ ?>
											<select class="form-control" id="idClientePrima" name="idClientePrima" required>
											<option selected value="0" style="background-color: red">Todos</option>
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
							<select class="form-control" id="idClientePrima" name="idClientePrima" required>
								<option value="0" style="background-color: red">Todos</option>
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
					<div class="col-lg-3">
						<div class="form-group">
							<label>Año</label>
							<?php
									if ($this->session->userdata('perfil') == 2) { 
										if (is_null($arrClientes)) { ?>
											<select readonly class="form-control" id="idAnoPrima" name="idAnoPrima" required>
											<option selected value="0">Seleccione</option>
											</select>
										<?php }else{
									?>
									<select class="form-control" id="idAnoPrima" name="idAnoPrima" required>
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
									<select class="form-control" id="idAnoPrima" name="idAnoPrima" disabled="true" required>
										<option selected value="0">Seleccione</option>
									</select>
									<?php } ?>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<label>Mes</label>
							<select class="form-control" id="idMesPrima" name="idMesPrima" disabled="true">
								<option selected value="">Seleccione</option>
							</select>
						</div>
					</div>

					<div class="col-lg-2">
						<div class="form-group">
							<label>&nbsp;</label>
							<button disabled="true" id="btnObtienePrima" type="submit" class="btn btn btn-primary form-control">Obtener Prima</button>
						</div>
					</div>
					<div class="col-lg-2" id="idExcelHeader" style="display:none">
							<div class="form-group" style="text-align: right">
								<label>&nbsp;</label>
								<button style="background-color: transparent;margin-top: 23px;border-color: transparent;" type="submit" form="formPrimaExcel" ><img src="<?=base_url() ?>recursos/images/logo_excel.jpg" width="30" height="30"></button>
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
									<th>Cliente</th>
									<th>Póliza</th>
									<th>Nro Certificado</th>
									<th>Fecha Emision</th>
									<th>Usuario</th>
									<th style="text-align: right;">Monto Asegurado</th>
									<th style="text-align: right;">Prima Cliente</th>
									<?php if ($this->session->userdata('perfil') == 1) { ?>
									<th style="text-align: right;">Prima Usuario</th>
									<th style="text-align: right;">Prima Compañia</th>
									<th style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Utilidad</th>
									<th style="text-align: right;">Editar</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody id="idCalculoPrimas">

								<?php
								if ($this->session->userdata('perfil') == 2) {
								?>
								<tr>
									<td colspan="12" style="text-align: center">
										<div class="alert alert-warning" role="alert"> Seleccione cliente y periodo</div></td>
								</tr>
								<?php }else{		
										?>											
										<tr>
										<td colspan="12" style="text-align: center">
										<div class="alert alert-warning" role="alert"> Seleccione cliente y periodo</div></td>
										</tr>
								<?php		
									}
								?>
							</tbody>
						</table>
					</div>
					<form role="form" id="formPrimaExcel" action="<?=base_url() ?>index.php/PrimaMensual/generar_excel/"  method="post" accept-charset='UTF-8' target="_blank" style="display: none">
				<input id="idClientePrimaExcel" name="idClientePrimaExcel" form="formPrimaExcel">
				<input id="idAnoPrimaExcel" name="idAnoPrimaExcel" form="formPrimaExcel">
				<input id="idMesPrimaExcel" name="idMesPrimaExcel" form="formPrimaExcel">
			</form>	
				</div>
			</div>
			<div class="col-lg-12" id="idExcelFooter" style="display:none">
				<div class="form-group" style="text-align: right">
					<label>&nbsp;</label>
					<button style="background-color: transparent;margin-top: 5px;border-color: transparent;" type="submit" form="formPrimaExcel" ><img src="<?=base_url() ?>recursos/images/logo_excel.jpg" width="30" height="30"></button>
				</div>
			</div>	
		</div>
	</div>
</div>
