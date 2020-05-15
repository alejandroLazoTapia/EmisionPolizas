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
	function showForm()
	{
		setTimeout(function() {
			$('#form-create-certificate').show("slow");
			$("#form-create-certificate")[0].reset();
		}, 0);
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
			
			$.ajax({

				url:"formularioEmision/obtieneTipoPolizaModal",
				type:"POST",
				data:{'idCliente' : idCliente}
			}).done(function(data) {
				$("#idPolizas").html(data);

			});  


		});
	});

$("#idCliente").change(function() {
		$("#idCliente option:selected").each(function() {
			var idCliente = $('#idCliente').val();
			$.ajax({

				url:"formularioEmision/obtieneTipoPoliza",
				type:"POST",
				data:{'idCliente' : idCliente}
			}).done(function(data) {
				$("#idPoliza").html(data);

			});  
		/*	$.post("<?php echo base_url(); ?>formularioEmision/obtieneTipoPoliza", {*/
		});
	});
	

$("#idClienteSiniestro").change(function() {
		$("#idClienteSiniestro option:selected").each(function() {
			var idCliente = $('#idClienteSiniestro').val();
			$.ajax({

				url:"formularioEmision/obtieneTipoPoliza",
				type:"POST",
				data:{'idCliente' : idCliente}
			}).done(function(data) {
				$("#idPolizaSiniestro").html(data);
				$("#idPolizaSiniestro").removeAttr('disabled');
				$("#idCertificadoSiniestro").val("");
				$("#idCertificadoSiniestro").attr("disabled","true");
				$.ajax({
					url:'denunciaSiniestro/obtieneSiniestrosCLiente',
					type:'POST',
					data:{'idClienteSiniestro' : idCliente},
					success:function(respuesta) {
						console.log(respuesta);
						$("#idTBodySiniestros").html(respuesta);
					},
					error:function(jqXHR, textStatus, errorThrow) {
						alert('Error! = ' + errorThrow);
					}
				});
				
			});
		});
	});


$("#idPolizas").change(function() {
		$("#idPolizas option:selected").each(function() {
			var idCliente = $('#idClientes').val();
			var idPoliza = $('#idPolizas').val();
			
			$.ajax({

				url:"formularioEmision/obtieneCertificadoPoliza",
				type:"POST",
				data:{
						'idCliente' : idCliente, 
					 	'idPoliza' : idPoliza
					 }
			}).done(function(data) {
				$("#idCertificados").html(data);

			});  
		});
	});
	
$("#idPolizaSiniestro").change(function() {
		$("#idPolizaSiniestro option:selected").each(function() {
			var idCliente = $('#idClienteSiniestro').val();
			var idPoliza = $('#idPolizaSiniestro').val();

			$.ajax({

				url:"formularioEmision/obtieneCertificadoPoliza",
				type:"POST",
				data:{
					'idCliente' : idCliente,
					'idPoliza' : idPoliza
				}
			}).done(function(data) {
				$("#idCertificadoSiniestro").html(data);
				$("#idCertificadoSiniestro").removeAttr('disabled');
			});
		});
	});

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
