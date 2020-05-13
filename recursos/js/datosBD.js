var idCertGlobal;

$('#btnObtieneDatos').click(function(){
	
	var idCliente = $('#idClientes').val();
	var idPoliza = $('#idPolizas').val();
	var idCertificado = $('#idCertificados').val();

	setTimeout(function() {
	$.ajax({
		type: 'POST',
		url:"formularioEmision/obtieneCertificadoPrevio/",
		data:{
			'idCliente':idCliente,
			'idPoliza':idPoliza,
			'idCertificado':idCertificado
		},
		dataType:'JSON',
		success:function(data){
			$('#idCliente').val(data[0].id_cliente);	   
			var idPaisOrigen = data[0].id_pais_origen;
			 $.ajax({

				url:"formularioEmision/obtieneTipoPoliza/",
				type:"POST",
				data:{'idCliente':idCliente,}

			}).done(function(dataPol) {
				
					$("#idPoliza").html(dataPol);
					$('#idPoliza').val(data[0].id_poliza);	  
					$.ajax({

						url:"formularioEmision/obtieneCiudadesPais/",
						type:"POST",
						data:{'idPais':idPaisOrigen,}
					}).done(function(dataCiuOri) {
						$("#idCiudadOrigen").html(dataCiuOri);
						$('#idCiudadOrigen').val(data[0].id_est_reg_origen);
						var idPaisDestino = data[0].id_pais_destino;
						$.ajax({

							url:"formularioEmision/obtieneCiudadesPais/",
							type:"POST",
							data:{'idPais':idPaisDestino,}
						}).done(function(dataCiuDes) {
							$("#idCiudadDestino").html(dataCiuDes);
						    $('#idCiudadDestino').val(data[0].id_est_reg_destino);							

						});  
					});  
				});  
			
			$('#idCertActivo').val(data[0].id_certificado);	
			$('#idCertAct').val(data[0].id_certificado);	
			$('#idCertEli').val(data[0].id_certificado);													
			$('#idAFavor').val(data[0].id_a_favor);							
			$('#idPaisEmision').val(data[0].id_pais_emision);										
			$('#idDireccion').val(data[0].direccion_cliente);
			$('#idRefInterna').val(data[0].referencia_interna);
			$('#idMoneda').val(data[0].id_moneda);										
			$('#idPrimaMinima').val(data[0].deducible);
			$('#idMontoAsegurado').val(data[0].monto_asegurado);
			$('#idTasa').val(data[0].tasa);
			$('#idClausula').val(data[0].id_clausula);										
			$('#idPrima').val(data[0].prima);
			$('#idFechaEmbarque').val(data[0].fecha_embarque);
			$('#idFechaArribo').val(data[0].fecha_arribo);
			$('#idGuiaBl').val(data[0].guia_bl);
			$('#idNomLineaNave').val(data[0].nombre_linea);
			$('#idNomNave').val(data[0].nombre_nave);
			$('#idNumVueloNave').val(data[0].nro_vuelo_nave);
			if (data[0].id_tipo_embalaje == 5) {
				$('#idTipoEmbalaje').val(data[0].id_tipo_embalaje);
				$('#idOtroTipEmb').val(data[0].otro_embalaje);
				$("#idOtroTipEmb").prop('disabled', false);		
			}else{
				$('#idTipoEmbalaje').val(data[0].id_tipo_embalaje);
				$('#idOtroTipEmb').val(data[0].otro_embalaje);		
			}
			$('#idTransporte').val(data[0].id_transporte);	
			if (data[0].id_tipo_embarque == 1) {
				$('#idImportacion').attr('checked', true);
				$('#idExportacion').attr('checked', false);
				$('#idEmbNacional').attr('checked', false);
			} else if (data[0].id_tipo_embarque == 2) {
				$('#idImportacion').attr('checked', false);
				$('#idExportacion').attr('checked', true);
				$('#idEmbNacional').attr('checked', false);
			}else{
				$('#idImportacion').attr('checked', false);
				$('#idExportacion').attr('checked', false);
				$('#idEmbNacional').attr('checked', true);
			}		
			$('#idDescMercaderia').val(data[0].desc_mercaderia);
			$('#idPaisOrigen').val(data[0].id_pais_origen);
			$('#idPuertoOrigen').val(data[0].puerto_origen);	
			$('#idPaisDestino').val(data[0].id_pais_destino);			
			$('#idPuertoDestino').val(data[0].puerto_destino);
			$('#idClientes').val("0");
			$('#idPolizas').val("0");
			$('#idCertificados').val("0");

			var idPolBody = '<option value="0" selected="selected">Seleccione</option>';
			var idCerBody = '<option value="0" selected="selected">Seleccione</option>';
			$('#idCertificados').html(idCerBody);
			$('#idCertificados').val(0);
			$("#idPolizas").html(idPolBody);
			$('#idPolizas').val(0);
			$('#btnObtieneDatos').attr("disabled", true);
			$('#btnModalUpd').attr("disabled", false);
			$('#btnModalEli').attr("disabled", false);
			
			$('#form-create-certificate').show(500);

			
		},error:function(jqXHR, textStatus, errorThrow){
			console.log('error' + errorThrow);
		}
		
	});
	}, 0); 
});


$("#form-create-certificate").submit(function (e) {
	e.preventDefault();
	var frm = $(this).closest('form');
	var data = frm.serialize();
	console.log($(document.activeElement).attr('formaction'));
	if ($(document.activeElement).attr('formaction') != "no"){
	$.ajax({
		url:$(document.activeElement).attr('formaction'),
		type:frm.prop('method'),
		data:data,
		success:function(respuesta) {
			if (respuesta > 0) {
				alert("Su certificado número "+ respuesta +" fue emitido exitosamente");
				$("#form-create-certificate")[0].reset();
				$('#btnModalUpd').attr("disabled", true);
				$('#btnModalEli').attr("disabled", true);
			} else {
				alert("No fue posible emitir el certificado");
			}
		},
		error:function(jqXHR, textStatus, errorThrow) {
			alert('Error certificado! = ' + errorThrow);
		}
	});
	}
});


$('#btnActualizarCertificado').click(function() {		
	setTimeout(function() {
		$.ajax({
			type: 'POST',
			url:"formularioEmision/actualizaCertificado/",
			data:$("form").serialize(),
			success:function(respuesta) {
				console.log(respuesta);
				if (respuesta == 0) {
					alert("Su certificado fue actualizado exitosamente");
					$("#form-create-certificate")[0].reset();
					$('#btnModalUpd').attr("disabled", true);
					$('#btnModalEli').attr("disabled", true);
				}else{
					console.log(respuesta);
					alert("No fue posible actualizar su certificado");
				}
				
			},
			error:function(jqXHR, textStatus, errorThrow) {
				alert('Error! = ' + errorThrow);
				console.log($("form").serialize());
			}
		});
	});
});

$('#btnEliminarCertificado').click(function() {
	setTimeout(function() {
		$.ajax({
			type: 'POST',
			url:"formularioEmision/eliminaCertificado/",
			data:$("form").serialize(),
			success:function(respuesta) {
				console.log(respuesta);
				if (respuesta == 0) {
					alert("Su certificado fue eliminado exitosamente");
					$("#form-create-certificate")[0].reset();
					$('#btnModalUpd').attr("disabled", true);
					$('#btnModalEli').attr("disabled", true);
				} else {
					console.log(respuesta);
					alert("No fue posible eliminar el certificado");
				}

			},
			error:function(jqXHR, textStatus, errorThrow) {
				alert('Error! = ' + errorThrow);
				console.log($("form").serialize());
			}
		});
	});
});

function validateForm()
{
	var isValid = true;
	$('.valform').each(function() {
		console.log($(this).val());
		if ( $(this).val() === '' )
			isValid = false;
	});
	return isValid;
}

$('#btnModalUpd').click(function() {
	setTimeout(function() {
		console.log('entro');
		console.log(validateForm());
		if (validateForm() == true) {
			$("#myModalUpdate").modal("show");
		}
	});
});






