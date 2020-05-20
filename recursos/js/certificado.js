$("#idClienteCert").change(function() {
	$("#idClienteCert option:selected").each(function() {
		var idCliente = $('#idClienteCert').val();
		console.log(idCliente);
		var resetAno = '<option selected value="0">Seleccione</option>';
		var resetMes = '<option selected value="">Seleccione</option>';
		
		if (idCliente > 0) {
		
			$.ajax({
				url:"historialCertificado/obtieneAnoCliente",
				type:"POST",
				data:{'idCliente' : idCliente}
			}).done(function(data) {
				console.log(data);
				if (data == '<option selected value="0">Seleccione</option>') {
					$("#idAnoCert").html(data);
					$("#idMesCert").html(resetMes);
					$("#idAnoCert").prop("disabled",true);
					$("#idMesCert").prop("disabled",true);
					$("#btnObtieneCertificado").prop("disabled",true);
					alert("El cliente no posee certificados emitidos");
				} else {
					$("#idAnoCert").html(data);
					$("#idMesCert").html(resetMes);
					$("#idAnoCert").prop("disabled",false);
					$("#btnObtieneCertificado").prop("disabled",true);
				}
			});
		} else {
			$("#idAnoCert").html(resetAno);
			$("#idAnoCert").prop("disabled",true);
			$("#idMesCert").html(resetMes);
			$("#idMesCert").prop("disabled",true);
			$("#btnObtieneCertificado").prop("disabled",true);
		}
	});
});


$("#idAnoCert").change(function() {
	$("#idAnoCert option:selected").each(function() {
		var idCliente = $('#idClienteCert').val();
		var idAnoCert = $('#idAnoCert').val();
		console.log(idAnoCert);
		var resetAno = '<option selected value="0">Seleccione</option>';
		var resetMes = '<option selected value="">Seleccione</option>';
		
		if (idAnoCert > 0) {

			$.ajax({
				url:"historialCertificado/obtieneMesCliente",
				type:"POST",
				data:{'idCliente' : idCliente, 
					  'idAnoCert' : idAnoCert }
			}).done(function(data) {
				console.log(data);
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
	console.log(idCliente);
		console.log(idAnoCert);
			console.log(idMesCert);

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
			},
			error:function(jqXHR, textStatus, errorThrow) {
				alert('Error al traer Certificados! = ' + errorThrow);
			}
		});
	});
});

$(document).on('click','.idDescargarCertificado',function(event) {
var idCertificado = $(this).parents("tr").find("td")[3].innerHTML;
	var idPaisEmision = $(this).parents("tr").find("td")[9].innerHTML;
	var idCliente = $(this).parents("tr").find("td")[7].innerHTML;
	var idPoliza = $(this).parents("tr").find("td")[8].innerHTML;

	$('#idClientePdf').val(idCliente);
	$('#idPolizaPdf').val(idPoliza);
	$('#idCertificadoPdf').val(idCertificado);
	$('#idPaisEmisionPdf').val(idPaisEmision);
	$('#formPDF').submit();

});
/*
$('.idDescargarCertificado').click(function() {
	//valores obtendra el dato del td por posciones [0]
	var idCertificado = $(this).parents("tr").find("td")[3].innerHTML;
	var idPaisEmision = $(this).parents("tr").find("td")[9].innerHTML;
	var idCliente = $(this).parents("tr").find("td")[7].innerHTML;
	var idPoliza = $(this).parents("tr").find("td")[8].innerHTML;

	$('#idClientePdf').val(idCliente);
	$('#idPolizaPdf').val(idPoliza);
	$('#idCertificadoPdf').val(idCertificado);
	$('#idPaisEmisionPdf').val(idPaisEmision);	
	$('#formPDF').submit();
});*/
