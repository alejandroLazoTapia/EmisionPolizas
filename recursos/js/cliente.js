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
	var telefono = $(this).parents("tr").find("td")[11].innerHTML;
	

	$('#idNombreCliente').val(nombre_cliente);
	$('#idCliente').val(id_cliente);
	$('#idClientePol').val(id_cliente);
	$('#idDireccionCliente').val(direccion_cliente);
	$('#idCondiciones').val(condiciones);
	$('#idGrupo').val(id_grupo);
	$('#idNombreGrupo').val(nombre_grupo);
	$('#idRut').val(rut);
	$('#idDv').val(dv);
	$('#idTelefono').val(telefono);
	$("#idGrupo option[value='0']").remove();
	
	$.ajax({
		url:'clienteMantenedor/obtienePolizasCLiente',
		type:'POST',
		data:{'idCliente' : id_cliente},
		success:function(respuesta) {
			console.log(respuesta);
			$("#idTBodyPolizas").html(respuesta);
		},
		error:function(jqXHR, textStatus, errorThrow) {
			alert('Error! = ' + errorThrow);
		}
	});
	

	$("#btnRegistrarCliente").hide();
	$("#btnActualizarCliente").show();
	$("#btnRegistrarPoliza").show();
	$("#div-create-policy").show('slow')
	$('#form-create-client').show(500);
});

//agrega el bonton al formulario de crecion de usuario
$("#form-create-client").hide();
$("#btnRegistrarCliente").hide();
$("#div-create-policy").hide();

function showFormClient()
{
	setTimeout(function() {
		$("#btnActualizarCliente").hide();
		$('#form-create-client').show("slow");
		$('#form-create-client')[0].reset();
		$("#btnRegistrarCliente").show();

	}, 0);
}

$("#form-create-client").submit(function(e) {
	e.preventDefault();
	var frm = $(this).closest('form');
	var data = frm.serialize();
	console.log(data);
		console.log($(document.activeElement).attr('formaction'));
		console.log(frm.prop('method'));
	$.ajax({
		url:$(document.activeElement).attr('formaction'),
		type:frm.prop('method'),
		data:data,
		success:function(respuesta) {
			console.log(respuesta);
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

	console.log(id_cliente +' ' +nombre_cliente);
	$.ajax({
		url:'clienteMantenedor/eliminaCliente',
		type:'POST',
		data:{'idCliente' : id_cliente},
		success:function(respuesta) {
			console.log(respuesta);
			if (respuesta == 0) {
				alert("El cliente '"+ nombre_cliente +"' fue eliminado exitosamente");
				location.reload();
			} else {
				console.log(respuesta);
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


$('#idFilaBorrarPoliza').click(function() {

	//valores obtendra el dato del td por posciones [0]
	var nombre_cliente =$('#idNameClient').val();
	var id_cliente = $('#idClientDel').val();

	console.log(id_cliente +' ' +nombre_cliente);
	$.ajax({
		url:'clienteMantenedor/eliminaCliente',
		type:'POST',
		data:{'idCliente' : id_cliente},
		success:function(respuesta) {
			console.log(respuesta);
			if (respuesta == 0) {
				alert("El cliente '"+ nombre_cliente +"' fue eliminado exitosamente");
				location.reload();
			} else {
				console.log(respuesta);
				alert("El cliente '"+ nombre_cliente +"' no pudo ser eliminado");
			}
		},
		error:function(jqXHR, textStatus, errorThrow) {
			alert('Error! = ' + errorThrow);
		}
	});

});

//llenar modal desde imput dibujado con echo de codeigniter
$(document).on('click','#btnDelPolicy',function(event) {
		console.log("entro");
		console.log("entro");
		var numero_poliza = $(this).parents("tr").find("td")[0].innerHTML;
		var id_poliza = $(this).parents("tr").find("td")[3].innerHTML;
		console.log(numero_poliza);
		console.log(id_poliza);
		$('#idPolDel').val(numero_poliza);
		$('#idPol').val(id_poliza);
});

