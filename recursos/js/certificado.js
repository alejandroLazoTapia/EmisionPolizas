

$("#idClienteCert").change(function() {
	$("#idClienteCert option:selected").each(function() {
		var idCliente = $('#idClienteCert').val();
		var resetAno = '<option selected value="0">Seleccione</option>';
		var resetMes = '<option selected value="">Seleccione</option>';
		var resetTbody = '<tr><td colspan="7" style="text-align: center"><div class="alert alert-warning" role="alert">Seleccione cliente y periodo</div></td></tr>';
		var resetTbodySP = '<tr><td colspan="7" style="text-align: center"><div class="alert alert-warning" role="alert">Cliente no posee pólizas registradas</div></td></tr>';
		console.log(idCliente);
		if (idCliente != "") {
			if (idCliente > 0) {
				$.ajax({
					url:"historialCertificado/obtieneAnoCliente",
					type:"POST",
					data:{'idCliente' : idCliente}
				}).done(function(data) {
					if (data == '<option selected value="0">Seleccione</option>') {
						$("#idAnoCert").html(data);
						$("#idMesCert").html(resetMes);
						$("#idAnoCert").prop("disabled",true);
						$("#idMesCert").prop("disabled",true);
						$("#btnObtieneCertificado").prop("disabled",true);
						$("#idCertificadosEmi").html(resetTbodySP);
						$("#idExcelFooterCert").prop('style','display:none');
						$("#idExcelHeaderCert").prop('style','display:none');
						alert("El cliente no posee certificados emitidos");
					} else {
						$("#idAnoCert").html(data);
						$("#idMesCert").html(resetMes);
						$("#idAnoCert").prop("disabled",false);
						$("#btnObtieneCertificado").prop("disabled",true);
						$("#idExcelFooterCert").prop('style','display:none');
						$("#idExcelHeaderCert").prop('style','display:none');
					}
				});
			} else {
					console.log("entro");
					$.ajax({
						url:"historialCertificado/obtieneCertificadosClientes",
						type:"POST"
					}).done(function(data) {
						$("#idCertificadosEmi").html(data);
						$("#idAnoCert").html(resetAno);
						$("#idAnoCert").prop("disabled",true);
						$("#idMesCert").html(resetMes);
						$("#idMesCert").prop("disabled",true);
						$('#idExcelFooterCert').attr('style','background-color: transparent;margin-top: 23px;border-color: transparent;');
				$('#idExcelHeaderCert').attr('style','background-color: transparent;margin-top: 23px;border-color: transparent;');
						$("#btnObtieneCertificado").prop("disabled",true);
					});		
						$('#idClienteExcel').val(0);
						$('#idAnoExcel').val(0);
						$('#idMesExcel').val(0);
					}	
		} else {
			$("#idAnoCert").html(resetAno);
			$("#idAnoCert").prop("disabled",true);
			$("#idMesCert").html(resetMes);
			$("#idMesCert").prop("disabled",true);
			$("#btnObtieneCertificado").prop("disabled",true);
			$("#idCertificadosEmi").html(resetTbody);
			$("#idExcelFooterCert").prop('style','display:none');
			$("#idExcelHeaderCert").prop('style','display:none');
		}
	});
});


$("#idAnoCert").change(function() {
	$("#idAnoCert option:selected").each(function() {
		var idCliente = $('#idClienteCert').val();
		var idAnoCert = $('#idAnoCert').val();
		var resetAno = '<option selected value="0">Seleccione</option>';
		var resetMes = '<option selected value="">Seleccione</option>';
		
		if (idAnoCert > 0) {

			$.ajax({
				url:"historialCertificado/obtieneMesCliente",
				type:"POST",
				data:{'idCliente' : idCliente, 
					  'idAnoCert' : idAnoCert }
			}).done(function(data) {
				if (data == '<option selected value="0">Seleccione</option>') {
					$("#idAnoCert").html(resetAno);
					$("#idMesCert").html(resetMes);
					$("#idMesCert").prop("disabled",true);
					$("#btnObtieneCertificado").prop("disabled",true);
					alert("El cliente no posee certificados emitidos");
				} else {
					$("#idMesCert").html(data);
					$("#idMesCert").prop("disabled",false);
					$("#btnObtieneCertificado").prop("disabled",true);
				}
			});
		} else {
			$("#idMesCert").html(resetMes);
			$("#idMesCert").prop("disabled",true);
			$("#btnObtieneCertificado").prop("disabled",true);
		}
	});
});


$("#idMesCert").change(function() {
	$("#idMesCert option:selected").each(function() {
		var idMesCert = $('#idMesCert').val();
		if (idMesCert != "") {
		$("#btnObtieneCertificado").prop("disabled",false);
		} else {
			$("#btnObtieneCertificado").prop("disabled",true);
		}
	});
});


$('#btnObtieneCertificado').click(function() {
	setTimeout(function() {
	var idCliente = $('#idClienteCert').val();
	var idAnoCert = $('#idAnoCert').val();
	var idMesCert = $('#idMesCert').val();
	console.log("entro");
		$.ajax({
			type: 'POST',
			url:"historialCertificado/obtieneCertificadosCliente",
			data:{
				'idCliente':idCliente,
				'idAnoCert':idAnoCert,
				'idMesCert':idMesCert
			},
			success:function(data) {
				console.log(data);
				$('#idCertificadosEmi').html(data);
				$('#idClienteExcel').val(idCliente);
				$('#idAnoExcel').val(idAnoCert);
				$('#idMesExcel').val(idMesCert);
				$('#idExcelFooterCert').attr('style','background-color: transparent;margin-top: 23px;border-color: transparent;');
				$('#idExcelHeaderCert').attr('style','background-color: transparent;margin-top: 23px;border-color: transparent;');
			},
			error:function(jqXHR, textStatus, errorThrow) {
				alert('Error al traer Certificados! = ' + errorThrow);
			}
		});
	});
});

//descargar desde grilla
$(document).on('click','.idDescargarCertificado',function(event) {
	var idCertificado = $(this).parents("tr").find("td")[3].innerHTML;
	var idPaisEmision = $(this).parents("tr").find("td")[10].innerHTML;
	var idCliente = $(this).parents("tr").find("td")[8].innerHTML;
	var idPoliza = $(this).parents("tr").find("td")[9].innerHTML;

	$('#idClientePdf').val(idCliente);
	$('#idPolizaPdf').val(idPoliza);
	$('#idCertificadoPdf').val(idCertificado);
	$('#idPaisEmisionPdf').val(idPaisEmision);
	$('#formPDF').submit();

});

//llenar modal desde imput dibujado con echo de codeigniter
$(document).on('click','.idAnulaCertificado',function(event) {
		var idCertificado = $(this).parents("tr").find("td")[3].innerHTML;
		
		$('#idCertAnu').val(idCertificado);
});

$('#btnAnularCertificado').click(function() {
	setTimeout(function() {
		var idCertificado = $('#idCertAnu').val();
		var idCliente = $('#idClienteCert').val();
		var idAnoCert = $('#idAnoCert').val();
		var idMesCert = $('#idMesCert').val();
		$.ajax({
			type: 'POST',
			url:"formularioEmision/eliminaCertificado/",
			data:{'idCertActivo':idCertificado},
			success:function(respuesta) {
				if (respuesta == 0) {
					alert("El certificado fue anulado exitosamente");
					if(idCliente > 0){
						$.ajax({
							type: 'POST',
							url:"historialCertificado/obtieneCertificadosCliente",
							data:{
								'idCliente':idCliente,
								'idAnoCert':idAnoCert,
								'idMesCert':idMesCert
							},
							success:function(data) {
								$('#idCertificadosEmi').html(data);
							},
							error:function(jqXHR, textStatus, errorThrow) {
								alert('Error al traer Certificados! = ' + errorThrow);
							}
						});
					}else{
						$.ajax({
						url:"historialCertificado/obtieneCertificadosClientes",
						type:"POST"
					}).done(function(data) {
						$("#idCertificadosEmi").html(data);
					});			
					}

				} else {
					alert("No fue posible anular el certificado");
				}

			},
			error:function(jqXHR, textStatus, errorThrow) {
				alert('Error! = ' + errorThrow);
			}
		});
	});
});

