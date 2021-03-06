
$(function () {
    var dateFormat = 'dd-mm-yy',
      from = $("#fechaEmbarque")
        .datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1
        })
        .on("change", function () {

            var fecha = $(this).datepicker("getDate");
           
            var fechaTo = LastDayOfMonth(fecha.getFullYear(), fecha.getMonth());

            to.datepicker("setDate", fechaTo);
            to.datepicker("option", "minDate", fechaTo);
           

            from.removeClass("is-invalid");
            to.removeClass("is-invalid");

        }),
      to = $("#termino_vigencia_certificado").datepicker({
          defaultDate: "+5w",
          maxDate: "+1y",
          changeMonth: true,
          numberOfMonths: 1
      })
      .on("change", function () {
          //from.datepicker("option", "maxDate", getDate(this));
          from.datepicker("option", "maxDate", '+1y');
      });

    function getDate(element) {
        var date;
        try {
            date = $.datepicker.parseDate(dateFormat, element.value);
        } catch (error) {
            date = null;
        }

        return date;
    }

    function LastDayOfMonth(Year, Month) {
        var ultimoDia = ( new Date((new Date(Year, Month + 2, 1)) - 1)).getDate();
        var fecha =       new Date(Year, (Month + 1), ultimoDia,);

        return fecha;
    }
});

$("#form-create-certificate").hide();

function showModalGetCertificate()
{
	var resetAfavor = '<option value="0">Seleccione</option>';
	var resetPoliza = '<option value="0">Seleccione</option>';
	
	$.ajax({
		url:"formularioEmision/obtieneClientesModal",
		type:"POST",
		}).done(function(dataClientes) {
		$("#idClientes").html(dataClientes);
		var idCliente = $('#idClientes').val();
		if (idCliente > 0) {
			$.ajax({

				url:"formularioEmision/obtieneTipoPolizaModal",
				type:"POST",
				data:{'idCliente' : idCliente}
			}).done(function(data) {
				$("#idClientes").prop("disabled",true);
				$("#idPolizas").prop("disabled", false)
				$("#idPolizas").html(data);
				$("#idCertificados").html(resetAfavor);

			});
		} else {
			$("#idPolizas").html(resetPoliza);
			$("#idCertificados").html(resetAfavor);
			$("#idClientes").prop("disabled",false);
			$("#idPolizas").prop("disabled", true)
			$("#idPolizas").prop("disabled", true)

		}
	});
	
}

$(document).ready(function() {

	var max_chars = 500;

	$('#max').html(max_chars);

	$('#idDescMercaderia').keyup(function() {
		var chars = $(this).val().length;
		var diff = max_chars - chars;
		$('#contador').html(diff);
	});
});

function showForm()
{
	var resetAfavor = '<option value="0">Seleccione</option>';
	var resetPoliza = '<option value="0">Seleccione</option>';
	var resetContadorMerc = '500 caracteres max.';
	$("#contador").html(resetContadorMerc);
	$.ajax({
		url:"formularioEmision/obtieneClientes",
		type:"POST",
	}).done(function(dataClientes) {
		console.log(dataClientes);
		$("#idClientes").html(dataClientes);
		var idCliente = $('#idClientes').val();
	console.log(idCliente);
	if (idCliente != ""){
		$.ajax({

			url:"formularioEmision/obtieneTipoPoliza",
			type:"POST",
			data:{'idCliente' : idCliente}
		}).done(function(data) {
			console.log(data);
			if (data == '<option value="">Seleccione</option>') {
				$("#form-create-certificate").hide();
				alert('el cliente no posee polizas registradas');
			}else{
				$("#idCliente").prop("readonly");
				$("#idPoliza").prop("disabled",false);
				$("#idPoliza").html(data);
			}
		});  
	}else{
		$("#idPoliza").prop("disabled",true);
		$("#idPoliza").html(resetPoliza);
	}
		setTimeout(function() {
			$('#form-create-certificate').show("slow");
			$("#form-create-certificate")[0].reset();
		}, 0);
	});
	
}
	
$("#idCertificados").change(function() {
		$("#idCertificados option:selected").each(function() {
			if (document.getElementById('idCertificados').value > 0) {
				document.getElementById('btnObtieneDatos').disabled = false;
			} else {
				document.getElementById('btnObtieneDatos').disabled = true;
			}
		});
	});


$("#idClientes").change(function() {
		$("#idClientes option:selected").each(function() {
			var idCliente = $('#idClientes').val();
			if (idCliente > 0) {
				$.ajax({

					url:"formularioEmision/obtieneTipoPolizaModal",
					type:"POST",
					data:{'idCliente' : idCliente}
				}).done(function(data) {
					if (data == '<option value="0">Seleccione</option>') {
						$("#idPolizas").val(0);
						$("#idPolizas").prop("disabled",true);
						$("#btnObtieneDatos").prop("disabled",true);
						alert("El cliente no posee polizas registradas");
					}else{
						$("#idPolizas").prop("disabled",false);
						$("#idPolizas").html(data);
						$("#idCertificados").val(0);
						$("#idCertificados").prop("disabled",true);
						$("#btnObtieneDatos").prop("disabled",true);
					}
				});  
			}else{
				$("#idPolizas").val(0);
				$("#idPolizas").prop("disabled",true);
				$("#btnObtieneDatos").prop("disabled",true);
			}
		});
	});

$("#idCliente").change(function() {
		$("#idCliente option:selected").each(function() {
			var idCliente = $('#idCliente').val();
			var resetPoliza = '<option value="">Seleccione</option>';
			if (idCliente != "") {
				$.ajax({

					url:"formularioEmision/obtieneTipoPoliza",
					type:"POST",
					data:{'idCliente' : idCliente}
				}).done(function(data) {
					if (data == '<option value="">Seleccione</option>') {
						$("#idCliente").val('');
						$("#idRutDni").val('');
						$("#idTelefono").val('');
						$("#idDireccion").val('');
						$("#idCondiciones").val('');
						$("#idPoliza").html(resetPoliza);
						$("#idPoliza").prop("disabled", true);
						$("#form-create-certificate")[0].reset();
						alert("el cliente no posee polizas registradas");
					}else{
							$("#idPoliza").prop("disabled", false);
							$("#idPoliza").html(data);
							
							$.ajax({

								url:"formularioEmision/obtieneDatosCliente",
								type:"POST",
								data:{'idCliente' : idCliente},
								dataType:'JSON'
							}).done(function(data) {
								$("#idRutDni").val(data[0].rut_dni);
								$("#idTelefono").val(data[0].telefono);
								$("#idDireccion").val(data[0].direccion);
								$("#idCondiciones").val(data[0].condiciones);
							});  	
						}
				});  	
				
				
			}else{
				$("#idPoliza").html(resetPoliza);
				$("#idPoliza").prop("disabled", true);
				$("#idRutDni").val('');
				$("#idTelefono").val('');
				$("#idDireccion").val('');
				$("#idCondiciones").val('');
			}
		});
	});
	


/*$("#idPoliza").change(function() {
		$("#idPoliza option:selected").each(function() {
			var idCliente = $('#idCliente').val();
			var idPoliza = $('#idPoliza').val();

			$.ajax({

				url:"formularioEmision/obtieneAFavorCliente",
				type:"POST",
				data:{
					'idCliente' : idCliente
				}
			}).done(function(data) {
				$("#idAFavor").html(data);

			});
		});
	});*/

$("#idPolizas").change(function() {
		$("#idPolizas option:selected").each(function() {
			var idCliente = $('#idClientes').val();
			var idPoliza = $('#idPolizas').val();
			if(idPoliza > 0){
				$.ajax({

					url:"formularioEmision/obtieneCertificadoPoliza",
					type:"POST",
					data:{
							'idCliente' : idCliente, 
						 	'idPoliza' : idPoliza
						 }
				}).done(function(data) {
					if (data == '<option value="0">Seleccione</option>') {
						$("#idCertificados").val(0);
						$("#idCertificados").prop("disabled",true);
						$("#btnObtieneDatos").prop("disabled",true);
						alert("La póliza no posee certificados emitidos");
					} else {
					$("#idCertificados").prop("disabled",false);
					$("#idCertificados").html(data);
					$("#btnObtieneDatos").prop("disabled",true);
					}
				});  
			}else{
				$("#idCertificados").val(0);
				$("#idCertificados").prop("disabled",true);
				$("#btnObtieneDatos").prop("disabled",true);
			}
		});
	});
	

/*
 $("#idPaisOrigen").change(function() {
			 $("#idPaisOrigen option:selected").each(function() {
				 var idPais = $('#idPaisOrigen').val();
				 $.ajax({

					 url:"formularioEmision/obtieneCiudadesPais",
					 type:"POST",
					 data:{'idPais' : idPais}		 
				 }).done(function(data) {
					 $("#idCiudadOrigen").html(data);
				 });  	 
			 });
		 });		

$("#idPaisDestino").change(function() {
			 $("#idPaisDestino option:selected").each(function() {
				 var idPais = $('#idPaisDestino').val();	 
				 $.ajax({
					 url:"formularioEmision/obtieneCiudadesPais",
					 type:"POST",
					 data:{'idPais' : idPais}
				 }).done(function(data) {
					 $("#idCiudadDestino").html(data);
				 });  	 
			 });
		 });
*/

$("#idTipoEmbalaje").change(function() {
	$("#idTipoEmbalaje option:selected").each(function() {
		if (document.getElementById('idTipoEmbalaje').value == 5) {
			document.getElementById('idOtroTipEmb').disabled = false;
			document.getElementById('idOtroTipEmb').required = true;
		} else {
			document.getElementById('idOtroTipEmb').value = '';
			document.getElementById('idOtroTipEmb').disabled = true;
			document.getElementById('idOtroTipEmb').required = false;
		}
	});
});


$('#myModal').on('shown.bs.modal', function () {
	$('#myInput').trigger('focus')
})

$('#myModalUpdate').click(function () {
	var idCertificado = $('#idCertAct').val();
	if (idCertificado == "") {
		alert("Debes seleccionar un Certificado");
	} else {
		$('#myInput').trigger('focus')
	}
})

$('#myModalDelete').on('shown.bs.modal', function () {
	$('#myInput').trigger('focus')
})

//formato de miles 
/*$(".miles").on({"focus": function (event) {
        $(event.target).select();
        },
    "keyup": function (event) {
        $(event.target).val(function (index, value ) {
            return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1,$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
        });
    }
});

*/


