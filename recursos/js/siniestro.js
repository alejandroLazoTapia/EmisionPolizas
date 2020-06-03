

function showFormSinister()
{
	setTimeout(function() {
		$('#form-create-sinister').show("slow");
		$('#form-create-sinister')[0].reset();
		$("#idPolizaSiniestro").attr("disabled","true");
		$("#idCertificadoSiniestro").attr("disabled","true");
	}, 0);
}


$("#form-create-sinister").submit(function(e) {
	e.preventDefault();
	var idCliente = $('#idClienteSiniestro').val();
	var monto = $('#idMonto').val().replace('.', '').replace(',', '.');  
	$('#idMonto').val(monto);
	var frm = $(this).closest('form');
	var data = frm.serialize();
	$.ajax({
		url:$(document.activeElement).attr('formaction'),
		type:frm.prop('method'),
		data: data,
		success:function(respuesta) {
			if (respuesta > 0) {
				alert("Siniestro Nro: "+respuesta+" ingresado exitosamente");
				$.ajax({
					url:'denunciaSiniestro/obtieneSiniestrosCLiente',
					type:'POST',
					data:{'idClienteSiniestro' : idCliente},
					success:function(resp) {
						$("#idTBodySiniestros").html(resp);
						$('#form-create-sinister')[0].reset();
					},
					error:function(jqXHR, textStatus, errorThrow) {
						alert('Error al refrescar grilla! = ' + errorThrow);
					}
				});
			} else if(respuesta == -1) {
				alert("No fue posible registrar el siniestro");
			} else if (respuesta == -2) {
				alert("Ya existe un siniestro asociado al certificado seleccionado");
			} else {
				alert(respuesta);
			}
		},
		error:function(jqXHR, textStatus, errorThrow) {
			alert('Error guardar siniestro! = ' + errorThrow);
		}
	});
});




function encodeImageFileAsURL(element)
{
	var filename = $('input[type=file]').val().split('\\').pop();
	
	$('#idExtencion').val(filename.split('.').pop()); 

	var file = element.files[0];
	getBase64(file).then(
	data => $('#Base64Img').val(data)
	);
}


function getBase64(file)
{
	return new Promise((resolve, reject) => {
		const reader = new FileReader();
		reader.readAsDataURL(file);
		reader.onload = () => {
			let encoded = reader.result.replace(/^data:(.*;base64,)?/, '');
			if ((encoded.length % 4) > 0) {
				encoded += '='.repeat(4 - (encoded.length % 4));
			}
			resolve(encoded);
		};
		reader.onerror = error => reject(error);
	});
}


$(document).on('click','#btnVerSiniestro',function(event) {		
		var idSiniestro = $(this).parents("tr").find("td")[0].innerHTML;
		var idCertificado = $(this).parents("tr").find("td")[1].innerHTML;
		console.log(idSiniestro);
		console.log(idCertificado);
		$.ajax({
			type: 'POST',
			url:"denunciaSiniestro/obtieneDetalleSiniestro/",
			data:{"idSiniestro" : idSiniestro,
				 "idCertificado" : idCertificado},
			dataType:'JSON',
			success:function(respuesta) {
				if (respuesta) {
					console.log(respuesta);
					if(respuesta[0].extension.toUpperCase() == 'JPG' || respuesta[0].extension.toUpperCase() == 'PNG'){
						console.log("entro");
						var src = "data:image/jpeg;base64,";
						src += respuesta[0].adjunto;
						var newImage = document.createElement('img');
						newImage.src = src;
						newImage.style.width="70%";
						/*newImage.width = "800";*/
						/*newImage.height = "600";*/
						
						/*var a = document.createElement('a');
						a.href = src;
						a.download = true;
						a.target = '_blank';
						a.click();*/
				
						document.querySelector('#imageContainer').innerHTML = newImage.outerHTML;//where to insert your image
						$('#iframePdf').attr("style",'display:none');
					}else if(respuesta[0].extension.toUpperCase() == 'PDF'){
						document.querySelector('#imageContainer').innerHTML = '';
						data = 'data:application/pdf;base64,{0}'.replace('{0}', respuesta[0].adjunto);
						document.querySelector('#iframePdf').src = data;
						$('#iframePdf').attr("style",'');
					}else{
						$('#iframePdf').attr("style",'display:none');
					}
					
					
				} else {
					$('#myModalSinester').hide();
				}

			},
			error:function(jqXHR, textStatus, errorThrow) {
				alert('Error! = ' + errorThrow);
			}
		});
	});

$("#idClienteSiniestro").change(function() {
	$("#idClienteSiniestro option:selected").each(function() {
		var idCliente = $('#idClienteSiniestro').val();
		var resetTbody = '<tr><td colspan="4"><div class="alert alert-warning" role="alert"> Seleccione Cliente</div></td></tr>';
		var resetPoliza = '<option value="">Seleccione</option>';
		var resetCert = '<option value="">Seleccione</option>';
		var resetTbodySP = '<tr><td colspan="4"><div class="alert alert-warning" role="alert"> Cliente no posee polizas registradas</div></td></tr>'
		if (idCliente != "") {
			$.ajax({
				url:"formularioEmision/obtieneTipoPoliza",
				type:"POST",
				data:{'idCliente' : idCliente}
			}).done(function(data) {
				if (data == '<option value="">Seleccione</option>') {
					$("#idPolizaSiniestro").prop("disabled",false);
					$("#idCertificadoSiniestro").prop("disabled",false);			
					$("#idPolizaSiniestro").html(data);
					$("#idCertificadoSiniestro").html(resetCert);
					$("#idPolizaSiniestro").prop("disabled",true);
					$("#idCertificadoSiniestro").prop("disabled",true);			
					$("#idTBodySiniestros").html(resetTbodySP);
				alert("El cliente no posee polizas registradas");		
				}else{
					$("#idPolizaSiniestro").html(data);
					$("#idPolizaSiniestro").removeAttr('disabled');
					$("#idCertificadoSiniestro").html(resetCert);
					$("#idCertificadoSiniestro").prop("disabled",true);
					$.ajax({
						url:'denunciaSiniestro/obtieneSiniestrosCLiente',
						type:'POST',
						data:{'idClienteSiniestro' : idCliente},
						success:function(respuesta) {
							$("#idTBodySiniestros").html(respuesta);
						},
						error:function(jqXHR, textStatus, errorThrow) {
							alert('Error! = ' + errorThrow);
						}
					});
				}
			});
		} else {
			$("#idPolizaSiniestro").html(resetPoliza);
			$("#idCertificadoSiniestro").html(resetCert);
			$("#idPolizaSiniestro").prop("disabled",true);
			$("#idCertificadoSiniestro").prop("disabled",true);								
			$("#idTBodySiniestros").html(resetTbody);
		}
	});
});

