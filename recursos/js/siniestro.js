

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


function handleFileSelect(evt)
{
	var f = evt.target.files[0]; // FileList object
	var reader = new FileReader();
	// Closure to capture the file information.
	reader.onload = (function(theFile) {
		return function(e) {
			var binaryData = e.target.result;
			//Converting Binary Data to base 64
			var base64String = window.btoa(binaryData);
			//showing file converted to base64
			$('#Base64Img').val(base64String);
		};
	})(f);
	// Read in the image file as a data URL.
	reader.readAsBinaryString(f);
}