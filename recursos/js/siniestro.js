

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
	var frm = $(this).closest('form');
	var data = frm.serialize();
	console.log(data);
	$.ajax({
		url:$(document.activeElement).attr('formaction'),
		type:frm.prop('method'),
		data: data,
		success:function(respuesta) {
			console.log(respuesta);
			if (respuesta > 0) {
				alert("Siniestro Nro: "+respuesta+" ingresado exitosamente");
				$.ajax({
					url:'denunciaSiniestro/obtieneSiniestrosCLiente',
					type:'POST',
					data:{'idClienteSiniestro' : idCliente},
					success:function(resp) {
						console.log(resp);
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

$('.idVerSiniestro').click(function() {
	setTimeout(function() {
		var idSiniestro = $(this).parents("tr").find("td")[0].innerHTML;
		var idCertificado = $(this).parents("tr").find("td")[1].innerHTML;
		console.log(idSiniestro,idCertificado);
		$.ajax({
			type: 'POST',
			url:"denunciaSiniestro/obtieneDetalleSiniestro/",
			data:{idSiniestro, idCertificado},
			success:function(respuesta) {
				console.log(respuesta);
				if (respuesta) {
					$('#myModalSinester').show();
				} else {
					$('#myModalSinester').show();
				}

			},
			error:function(jqXHR, textStatus, errorThrow) {
				alert('Error! = ' + errorThrow);
			}
		});
	});
});
