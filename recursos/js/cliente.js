$('.idFilaActualizarCliente').click(function() {

	//valores obtendra el dato del td por posciones [0]
	var nombre_cliente = $(this).parents("tr").find("td")[1].innerHTML;
	var id_cliente = $(this).parents("tr").find("td")[4].innerHTML;
	var direccion_cliente = $(this).parents("tr").find("td")[5].innerHTML;
	var condiciones = $(this).parents("tr").find("td")[6].innerHTML;
	var id_grupo = $(this).parents("tr").find("td")[7].innerHTML;
	var nombre_grupo = $(this).parents("tr").find("td")[8].innerHTML;
	var rut = $(this).parents("tr").find("td")[9].innerHTML;
	var dv = $(this).parents("tr").find("td")[10].innerHTML;
	var dv = $(this).parents("tr").find("td")[10].innerHTML;
	var telefono = $(this).parents("tr").find("td")[11].innerHTML;
	

	$('#idNombreCliente').val(nombre_cliente);
	$('#idCliente').val(id_cliente);
	$('#idClientePol').val(id_cliente);
	$('#idClienteAFavor').val(id_cliente);
	$('#idDireccionCliente').val(direccion_cliente);
	$('#idCondiciones').val(condiciones);
	$('#idGrupo').val(id_grupo);
	$('#idNombreGrupo').val(nombre_grupo);
	$('#idRut').val(rut);
	$('#idDv').val(dv);
	$('#idTelefono').val(telefono);
	$("#idGrupo option[value='0']").remove();
	
	//llenar grilla polizas segun cliente seleccionado
	$.ajax({
		url:'clienteMantenedor/obtienePolizasCLiente',
		type:'POST',
		data:{'idCliente' : id_cliente},
		success:function(respuesta) {
			$("#idTBodyPolizas").html(respuesta);
		},
		error:function(jqXHR, textStatus, errorThrow) {
			alert('Error! = ' + errorThrow);
		}
	});
	
	//llenar grilla afavor segun cliente seleccionado
	$.ajax({
		url:'clienteMantenedor/obtieneAFavorCLiente',
		type:'POST',
		data:{'idCliente' : id_cliente},
		success:function(respuesta) {
			$("#idTBodyAFavor").html(respuesta);
		},
		error:function(jqXHR, textStatus, errorThrow) {
			alert('Error! = ' + errorThrow);
		}
	});
	

	$("#btnRegistrarCliente").hide();
	$("#btnActualizarCliente").show();
	$("#btnRegistrarPoliza").show();
	$("#btnRegistrarAFavor").show();
	$('#form-create-client').show('slow');
	$("#div-create-policy").show('slow');
	$("#div-create-afavor").show('slow');
});

//agrega el bonton al formulario de crecion de usuario
$("#form-create-client").hide();
$("#btnRegistrarCliente").hide();
$("#div-create-policy").hide();
$('#div-create-afavor').hide();

function showFormClient()
{
	setTimeout(function() {
		$("#btnActualizarCliente").hide();
		$("#btnRegistrarPoliza").hide();
		$("#div-create-policy").hide();
		$('#div-create-afavor').hide();
		$('#form-create-client').show("slow");
		$('#form-create-client')[0].reset();
		$("#btnRegistrarCliente").show();
		
		
		if ($("#idGrupo option[value='0'").length == 0 ){
			let $option = $('<option />', {
				text: 'Nuevo',
				style: 'background-color: #ff9b94',
				value: 0,
			});
			$('#idGrupo').prepend($option);
		}

	}, 0);
}
//crea y actualiza cliente
$("#form-create-client").submit(function(e) {
	e.preventDefault();
	var frm = $(this).closest('form');
	var data = frm.serialize();
	$.ajax({
		url:$(document.activeElement).attr('formaction'),
		type:frm.prop('method'),
		data:data,
		success:function(respuesta) {
			if (respuesta == 0) {
				alert("Cliente registrado exitosamente");
				location.reload();
			} else if (respuesta == 1) {
				alert("Cliente ya se encuentra registrado");
			} else if (respuesta == 2) {
				alert("Cliente actualizado exitosamente");
				location.reload();
			} else if (respuesta == 3) {
				alert("No se modifico ningun campo");
			} else {
				alert("No fue posible efectuar la operación");
			}
		},
		error:function(jqXHR, textStatus, errorThrow) {
			alert('Error guardar cliente! = ' + errorThrow);
		}
	});
});

$('#idFilaBorrarCliente').click(function() {

	//valores obtendra el dato del td por posciones [0]
	var nombre_cliente =$('#idNameClient').val();
	var id_cliente = $('#idClientDel').val();

	$.ajax({
		url:'clienteMantenedor/eliminaCliente',
		type:'POST',
		data:{'idCliente' : id_cliente},
		success:function(respuesta) {
			if (respuesta == 0) {
				alert("El cliente '"+ nombre_cliente +"' fue eliminado exitosamente");
				location.reload();
			} else {
				alert("El cliente '"+ nombre_cliente +"' no pudo ser eliminado");
			}
		},
		error:function(jqXHR, textStatus, errorThrow) {
			alert('Error! = ' + errorThrow);
		}
	});

});

//modal con el nombre de cliente e id
$('.idFilaDelCliente').click(function() {
	//valores obtendra el dato del td por posciones [0]
	var nombre_usuario = $(this).parents("tr").find("td")[1].innerHTML;
	var id_cliente = $(this).parents("tr").find("td")[4].innerHTML;
	$('#idNameClient').val(nombre_usuario);
	$('#idClientDel').val(id_cliente);
});


//eliminar poliza
$('#idFilaBorrarPoliza').click(function() {

	//valores obtendra el dato del td por posciones [0]
	var idPoliza = $('#idPol').val();
	var idCliente = $('#idClientePol').val();
	
	$.ajax({
		url:'clienteMantenedor/eliminaPoliza',
		type:'POST',
		data:{'idPoliza' : idPoliza},
		success:function(respuesta) {
			if (respuesta == 0) {
				alert("La poliza fue eliminada exitosamente");
						//refresco polizas
					   	$.ajax({
						url:'clienteMantenedor/obtienePolizasCLiente',
						type:'POST',
						data:{'idCliente' : idCliente},
						success:function(resp) {
							$("#idTBodyPolizas").html(resp);
						},
						error:function(jqXHR, textStatus, errorThrow) {
							alert('Error! = ' + errorThrow);
						}
					});
			} else {
				alert("la poliza no pudo ser eliminado");
			}
		},
		error:function(jqXHR, textStatus, errorThrow) {
			alert('Error! = ' + errorThrow);
		}
	});

});

//llenar modal desde imput dibujado con echo de codeigniter
$(document).on('click','#btnDelPolicy',function(event) {
		var numero_poliza = $(this).parents("tr").find("td")[0].innerHTML;
		var id_poliza = $(this).parents("tr").find("td")[3].innerHTML;
		$('#idPolDel').val(numero_poliza);
		$('#idPol').val(id_poliza);
});

//Registrar Poliza
$("#form-create-policy").submit(function(e) {
	e.preventDefault();
	var idCliente = $('#idClientePol').val();
	var frm = $(this).closest('form');
	var data = frm.serialize();
	$.ajax({
		url:$(document.activeElement).attr('formaction'),
		type:frm.prop('method'),
		data:data,
		success:function(respuesta) {
			if (respuesta == 0) {
				alert("Poliza Registrada exitosamente");
				//refresco polizas
				$.ajax({
					url:'clienteMantenedor/obtienePolizasCLiente',
					type:'POST',
					data:{'idCliente' : idCliente},
					success:function(resp) {
						$("#idTBodyPolizas").html(resp);
					},
					error:function(jqXHR, textStatus, errorThrow) {
						alert('Error! = ' + errorThrow);
					}
				});
				
			} else if (respuesta == 2) {
				alert("Poliza ya se encuentra registrada");
			} else {
				alert("No fue posible registrar la póliza");
			}
		},
		error:function(jqXHR, textStatus, errorThrow) {
			alert('Error guardar poliza! = ' + errorThrow);
		}
	});
});



//Registrar A Favor
$("#form-create-afavor").submit(function(e) {
	e.preventDefault();
	var idCliente = $('#idClienteAFavor').val();
	var frm = $(this).closest('form');
	var data = frm.serialize();
	$.ajax({
		url:$(document.activeElement).attr('formaction'),
		type:frm.prop('method'),
		data:data,
		success:function(respuesta) {
			if (respuesta == 0) {
				alert("Empresa a favor registrada exitosamente");
				//refresco polizas
				//llenar grilla afavor segun cliente seleccionado
				$.ajax({
					url:'clienteMantenedor/obtieneAFavorCLiente',
					type:'POST',
					data:{'idCliente' : idCliente},
					success:function(resp) {
						$("#idTBodyAFavor").html(resp);
					},
					error:function(jqXHR, textStatus, errorThrow) {
						alert('Error! = ' + errorThrow);
					}
				});

			} else if (respuesta == 2) {
				alert("El rut de la empresa a favor ya se encuentra registrada");
			} else {
				alert("No fue posible registrar la póliza");
			}
		},
		error:function(jqXHR, textStatus, errorThrow) {
			alert('Error guardar poliza! = ' + errorThrow);
		}
	});
});


//llenar modal desde imput dibujado con echo de codeigniter
$(document).on('click','#btnDelAFavor',function(event) {
	var nombre = $(this).parents("tr").find("td")[1].innerHTML;
	var id_a_favor = $(this).parents("tr").find("td")[3].innerHTML;
	$('#idNombreDel').val(nombre);
	$('#idAfavorDel').val(id_a_favor);
});


//eliminar poliza
$('#idFilaBorraAfavor').click(function() {

	//valores obtendra el dato del td por posciones [0]
	var idAFavor = $('#idAfavorDel').val();
	var idCliente = $('#idClienteAFavor').val();

	$.ajax({
		url:'clienteMantenedor/eliminaAFavor',
		type:'POST',
		data:{'idAFavor' : idAFavor},
		success:function(respuesta) {
			if (respuesta == 0) {
				alert("La poliza fue eliminada exitosamente");
				//refresco polizas
				$.ajax({
					url:'clienteMantenedor/obtieneAFavorCLiente',
					type:'POST',
					data:{'idCliente' : idCliente},
					success:function(resp) {
						$("#idTBodyAFavor").html(resp);
					},
					error:function(jqXHR, textStatus, errorThrow) {
						alert('Error! = ' + errorThrow);
					}
				});
			} else {
				alert("la poliza no pudo ser eliminado");
			}
		},
		error:function(jqXHR, textStatus, errorThrow) {
			alert('Error! = ' + errorThrow);
		}
	});

});
