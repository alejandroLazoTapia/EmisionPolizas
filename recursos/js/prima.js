$("#idClientePrima").change(function() {
	$("#idClientePrima option:selected").each(function() {
		var idCliente = $('#idClientePrima').val();
		var resetAno = '<option selected value="0">Seleccione</option>';
		var resetMes = '<option selected value="">Seleccione</option>';
		var resetTbody = '<tr><td colspan="12" style="text-align: center"><div class="alert alert-warning" role="alert">Seleccione cliente y periodo</div></td></tr>';
		var resetTbodySP = '<tr><td colspan="12" style="text-align: center"><div class="alert alert-warning" role="alert">Cliente no posee pólizas registradas</div></td></tr>';
		console.log(idCliente);
		if (idCliente != "") {
				$.ajax({
					url:"PrimaMensual/obtieneAnoPrima",
					type:"POST",
					data:{'idCliente' : idCliente}
				}).done(function(data) {
					console.log(data);
					if (data == '<option selected value="0">Seleccione</option>') {
						$("#idAnoPrima").html(data);
						$("#idMesPrima").html(resetMes);
						$("#idAnoPrima").prop("disabled",true);
						$("#idMesPrima").prop("disabled",true);
						$("#btnObtienePrima").prop("disabled",true);
						$("#idCalculoPrimas").html(resetTbodySP);
						$("#idExcelFooter").prop('style','display:none');
						$("#idExcelHeader").prop('style','display:none');
						alert("El cliente no posee certificados emitidos");
					} else {
						console.log('entro a datos');
						$("#idAnoPrima").html(data);
						$("#idMesPrima").html(resetMes);
						$("#idCalculoPrimas").html(resetTbody);
						$("#idExcelFooter").prop('style','display:none');
						$("#idExcelHeader").prop('style','display:none');
						$("#idAnoPrima").prop("disabled",false);
						$("#btnObtienePrima").prop("disabled",true);
					}
				});
		} else {
			$("#idAnoPrima").html(resetAno);
			$("#idAnoPrima").prop("disabled",true);
			$("#idMesPrima").html(resetMes);
			$("#idMesPrima").prop("disabled",true);
			$("#btnObtienePrima").prop("disabled",true);
			$("#idCalculoPrimas").html(resetTbody);
			$("#idExcelFooter").prop('style','display:none');
			$("#idExcelHeader").prop('style','display:none');
		}
	});
});


$("#idAnoPrima").change(function() {
	$("#idAnoPrima option:selected").each(function() {
		var idCliente = $('#idClientePrima').val();
		var idAnoPrima = $('#idAnoPrima').val();
		var resetAno = '<option selected value="0">Seleccione</option>';
		var resetMes = '<option selected value="">Seleccione</option>';
		console.log(idCliente);
		console.log(idAnoPrima);
			
		if (idAnoPrima > 0) {

			$.ajax({
				url:"PrimaMensual/obtieneMesPrima",
				type:"POST",
				data:{'idCliente' : idCliente, 
					  'idAnoPrima' : idAnoPrima }
			}).done(function(data) {
				if (data == '<option selected value="0">Seleccione</option>') {
					$("#idAnoPrima").html(resetAno);
					$("#idMesPrima").html(resetMes);
					$("#idMesPrima").prop("disabled",true);
					$("#btnObtienePrima").prop("disabled",true);
					alert("El cliente no posee certificados emitidos");
				} else {
					$("#idMesPrima").html(data);
					$("#idMesPrima").prop("disabled",false);
					$("#btnObtienePrima").prop("disabled",true);
				}
			});
		} else {
			$("#idMesPrima").html(resetMes);
			$("#idMesPrima").prop("disabled",true);
			$("#btnObtienePrima").prop("disabled",true);
		}
	});
});


$("#idMesPrima").change(function() {
	$("#idMesPrima option:selected").each(function() {
		var idMesPrima = $('#idMesPrima').val();
		if (idMesPrima != "") {
		$("#btnObtienePrima").prop("disabled",false);
		} else {
			$("#btnObtienePrima").prop("disabled",true);
		}
	});
});

$('#btnObtienePrima').click(function() {
	setTimeout(function() {
	var idCliente = $('#idClientePrima').val();
	var idAnoPrima = $('#idAnoPrima').val();
	var idMesPrima = $('#idMesPrima').val();

		$.ajax({
			type: 'POST',
			url:"PrimaMensual/obtieneDetallePrimaMensual",
			data:{
				'idCliente':idCliente,
				'idAnoPrima':idAnoPrima,
				'idMesPrima':idMesPrima
			},
			success:function(data) {
				$('#idCalculoPrimas').html(data);
				$('#idExcelFooter').attr('style','');
				$('#idExcelHeader').attr('style','');
				$('#idClientePrimaExcel').val(idCliente);
				$('#idAnoPrimaExcel').val(idAnoPrima);
				$('#idMesPrimaExcel').val(idMesPrima);
				console.log($('#idClientePrimaExcel').val());
				console.log($('#idAnoPrimaExcel').val());
				console.log($('#idMesPrimaExcel').val());
				console.log('******************');
				console.log(idCliente);
				console.log(idAnoPrima);
				console.log(idMesPrima);
			},
			error:function(jqXHR, textStatus, errorThrow) {
				alert('Error al traer Certificados! = ' + errorThrow);
			}
		});
	});
});


//descargar desde grilla
$(document).on('click','.idEditarPrima',function(event) {
	
	var i = $(this).parents("tr").find("td")[0].innerHTML;
	
	/*var idPrimaCliente = $(this).parents("tr").find("td")[6].innerHTML;*/
	var idPrimaUsuario = $(this).parents("tr").find("td")[8].innerHTML;
	var idPrimaCompania = $(this).parents("tr").find("td")[9].innerHTML;
	var idUtilidad = $(this).parents("tr").find("td")[10].innerHTML;
    
	
	/*var inputPrimaCliente = '<input id="idPrimaCliente'+i+'" name="idPrimaCliente'+i+'" class="miles" style="text-align: right;" size="7" value="'+idPrimaCliente+'">';*/
	var inputPrimaUsuario = '<input id="idPrimaUsuario'+i+'" name="idPrimaUsuario'+i+'" class="miles" style="text-align: right;" size="7" value="'+idPrimaUsuario+'">';
	var inputPrimaCompania = '<input id="idPrimaCompania'+i+'" name="idPrimaCompania'+i+'" class="miles" style="text-align: right;" size="7" value="'+idPrimaCompania+'">';
	var inputUtilidad = '<input id="idUtilidad'+i+'" name="idUtilidad'+i+'" class="miles" style="text-align: right;" size="3" value="'+idUtilidad+'">';
	var inputEdit = '<a><span class="glyphicon glyphicon-pencil" style="color:#6675df"></span></a>';
	var inputGuardar = '<a class="idGuardaPrima"><span class="glyphicon glyphicon-floppy-disk" style="color:red"></span></a>';
	
	/*$(this).parents("tr").find("td")[6].innerHTML = inputPrimaCliente;*/
	$(this).parents("tr").find("td")[8].innerHTML = inputPrimaUsuario;
	$(this).parents("tr").find("td")[9].innerHTML = inputPrimaCompania;
	$(this).parents("tr").find("td")[10].innerHTML = inputUtilidad;
	$(this).parents("tr").find("td")[11].innerHTML = inputGuardar;
	
});

$(document).on('click','.idGuardaPrima',function(event) {
	
	var i = $(this).parents("tr").find("td")[0].innerHTML;
	var idCertificado = $(this).parents("tr").find("td")[3].innerHTML;
	var idPrimaUsuario = $('#idPrimaUsuario'+i).val();  
	var idPrimaCompania = $('#idPrimaCompania'+i).val();  
	var idUtilidad = $('#idUtilidad'+i).val();  
	var idCliente = $('#idClientePrima').val();
	var idAnoPrima = $('#idAnoPrima').val();
	var idMesPrima = $('#idMesPrima').val();
	var inputEdit = '<a class="idEditarPrima"><span class="glyphicon glyphicon-pencil" style="color:#6675df"></span></a>';
	
	var idGPrimaUsuario = $('#idPrimaUsuario'+i).val().replace('.', '').replace('.', '').replace(',', '.');
	var idGPrimaCompania = $('#idPrimaCompania'+i).val().replace('.', '').replace('.', '').replace(',', '.');
	var idGUtilidad = $('#idUtilidad'+i).val().replace('.', '').replace('.', '').replace(',', '.'); 
	
	$(this).parents("tr").find("td")[8].innerHTML = idPrimaUsuario;
	$(this).parents("tr").find("td")[9].innerHTML = idPrimaCompania;
	$(this).parents("tr").find("td")[10].innerHTML = idUtilidad;
	$(this).parents("tr").find("td")[11].innerHTML = inputEdit;
	console.log("********************");
	console.log(idGPrimaUsuario);
	console.log(idGPrimaCompania);
	console.log(idGUtilidad);
	console.log("********************");
	$.ajax({
			type: 'POST',
			url:"PrimaMensual/guardarPrima",
			data:{
				  'idCertificado':idCertificado,
				  'idPrimaUsuario':idGPrimaUsuario,
				  'idPrimaCompania':idGPrimaCompania,
				  'idUtilidad':idGUtilidad
				}, 
			dataType:'JSON',
			success:function(data) {
				console.log("respuesta");
				console.log(data);
				console.log("respuesta");
				if(data > 0){
					
					$.ajax({
							type: 'POST',
							url:"PrimaMensual/obtieneCalculoPrimaMensual",
							data:{
								  'idCliente':idCliente,
								  'idAnoPrima':idAnoPrima,
								  'idMesPrima':idMesPrima
								}, 
							dataType:'JSON',
							success:function(data) {
								console.log(data[0].prima_cliente);
								console.log(data[0].prima_usuario);
								console.log(data[0].prima_compania);
								console.log(data[0].utilidad);
								
								$('#totPrimaCliente').html('$ ' + data[0].prima_cliente);
								$('#totPrimaUsuario').html('$ ' + data[0].prima_usuario);
								$('#totPrimaCompania').html('$ ' + data[0].prima_compania);
								$('#totUtilidad').html('$ ' + data[0].utilidad);
							},
							error:function(jqXHR, textStatus, errorThrow) {
								alert('Error al traer Certificados! = ' + errorThrow);
							}
						});							
				}else{
					alert('no fue posible guardar valores');
				}	
			},
			error:function(jqXHR, textStatus, errorThrow) {
				alert('Error al guardar prima = ' + errorThrow);
			}
		});
});


//formato de miles 
$(document).on('focus', '.miles',function (event) {
	$(event.target).select();
	$(document).on('keyup', '.miles',function (event) {
        $(event.target).val(function (index, value ) {
            return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1,$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
        });
    });
});


