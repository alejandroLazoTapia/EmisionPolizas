<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>	



	<script src="<?=base_url() ?>recursos/js/jquery-3.4.1.min.js"> </script>
	<script src="<?=base_url() ?>recursos/sb-admin-v2/js/bootstrap.min.js"> </script>
	<script src="<?=base_url() ?>recursos/sb-admin-v2/js/plugins/metisMenu/jquery.metisMenu.js"> </script>
	<script src="<?=base_url() ?>recursos/js/datepicker.js"> </script>
	<script src="<?=base_url() ?>recursos/js/iframe.js"> </script>
	<script src="<?=base_url() ?>recursos/js/Utilitarios.js"> </script>
	<script src="<?=base_url() ?>recursos/sb-admin-v2/js/sb-admin.js"> </script>
	<script src="<?=base_url() ?>recursos/js/datosBD.js"> </script>
	
	 <script type="text/javascript">
	 $("#form-create-certificate").hide();
		 function showForm(){
			 setTimeout(function() {
				 $('#form-create-certificate').show("slow");
				 $("#form-create-certificate")[0].reset();
			 }, 0);   
		 }
	 </script>

 <script type="text/javascript">
	 $("#form-create-user").hide();
	 function showFormUser()
	 {
		 setTimeout(function() {
			 $('#form-create-user').show("slow");
			 $('#form-create-user')[0].reset();
		 }, 0);
	 }
 </script>

<!--	<script type="text/javascript">
			$(document).ready(function() {
				$(function () {
					$('#idFechaEmbarque').datepicker();
				$(function () {
					$('#idFechaArribo').datepicker();
				});
			});
		});
	</script>
-->
 <script type="text/javascript">
	 $(document).ready(function() {
		 $("#idTipoEmbalaje").change(function() {
			 $("#idTipoEmbalaje option:selected").each(function() {
				 if (document.getElementById('idTipoEmbalaje').value == 5) {
					 document.getElementById('idOtroTipEmb').disabled = false;
					 document.getElementById('idOtroTipEmb').required = true;
				 }else{
					 document.getElementById('idOtroTipEmb').value = '';
					 document.getElementById('idOtroTipEmb').disabled = true;
					 document.getElementById('idOtroTipEmb').required = false;
				 }
			 });
		 });
	 });
 </script>
 
 <script type="text/javascript">
	 $(document).ready(function() {
		 $("#idCertificados").change(function() {
			 $("#idCertificados option:selected").each(function() {
				 if (document.getElementById('idCertificados').value > 0) {
					 document.getElementById('btnObtieneDatos').disabled = false;
				 } else {
					 document.getElementById('btnObtieneDatos').disabled = true;
				 }
			 });
		 });
	 });
 </script>
 
	
	<script type="text/javascript">
	 $(document).ready(function() {
		 $("#idCliente").change(function() {
			 $("#idCliente option:selected").each(function() {
				var idCliente = $('#idCliente').val();
				 $.post("<?php echo base_url(); ?>index.php/formularioEmision/obtieneTipoPoliza", {
					 idCliente : idCliente
				 }, function(data) {
					 $("#idPoliza").html(data);
				 });
			 });
		 });
	 });
	</script>
	
 <script type="text/javascript">
	 $(document).ready(function() {
		 $("#idClientes").change(function() {
			 $("#idClientes option:selected").each(function() {
				 var idCliente = $('#idClientes').val();
				 $.post("<?php echo base_url(); ?>index.php/formularioEmision/obtieneTipoPolizaModal", {
					 idCliente : idCliente
				 }, function(data) {
					 $("#idPolizas").html(data);
				 });
			 });
		 });
	 });
 </script>
	
 <script type="text/javascript">
	 $(document).ready(function() {
		 $("#idPolizas").change(function() {
			 $("#idPolizas option:selected").each(function() {
				 var idCliente = $('#idClientes').val();
				 var idPoliza = $('#idPolizas').val();
				 $.post("<?php echo base_url(); ?>index.php/formularioEmision/obtieneCertificadoPoliza", {
					 idCliente : idCliente, idPoliza : idPoliza
				 }, function(data) {
					 $("#idCertificados").html(data);
				 });
			 });
		 });
	 });
 </script>
 
 <script type="text/javascript">
	 $(document).ready(function() {
		 $("#idPaisOrigen").change(function() {
			 $("#idPaisOrigen option:selected").each(function() {
				 var idPais = $('#idPaisOrigen').val();
				 $.post("<?php echo base_url(); ?>index.php/formularioEmision/obtieneCiudadesPais", {
					 idPais : idPais
				 }, function(data) {
					 $("#idCiudadOrigen").html(data);
				 });
			 });
		 });
	 });
 </script>
 
 <script type="text/javascript">
	 $(document).ready(function() {
		 $("#idPaisDestino").change(function() {
			 $("#idPaisDestino option:selected").each(function() {
				 var idPais = $('#idPaisDestino').val();
				 $.post("<?php echo base_url(); ?>index.php/formularioEmision/obtieneCiudadesPais", {
					 idPais : idPais
				 }, function(data) {
					 $("#idCiudadDestino").html(data);
				 });
			 });
		 });
	 });
 </script>
	
</body>

</html>