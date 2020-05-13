
//metodo para obtener las filas de la grilla de usuario
$('.idFilaActualizar').click(function() {

	//valores obtendra el dato del td por posciones [0]
	var nombre_usuario = $(this).parents("tr").find("td")[1].innerHTML;
	var id_usuario = $(this).parents("tr").find("td")[5].innerHTML;
	var nombre = $(this).parents("tr").find("td")[6].innerHTML;
	var id_perfil = $(this).parents("tr").find("td")[7].innerHTML;
	var id_pais = $(this).parents("tr").find("td")[8].innerHTML;
	var id_cliente = $(this).parents("tr").find("td")[9].innerHTML;


	$('#idUsuario').val(id_usuario);
	$('#idNombreUsuario').val(nombre_usuario);
	$('#idNombre').val(nombre);
	$('#idPaisEmision').val(id_pais);
	$('#idCliente').val(id_cliente);
	$('#idPerfil').val(id_perfil);
	$("#btnRegistrarUsuario").hide();
	$("#btnActualizarUsuario").show();
	$('#form-create-user').show(500);
});



//agrega el bonton al formulario de crecion de usuario
$("#form-create-user").hide();
$("#btnRegistrarUsuario").hide();

function showFormUser()
{
	setTimeout(function() {
		$("#btnActualizarUsuario").hide();
		$('#form-create-user').show("slow");
		$('#form-create-user')[0].reset();
		$("#btnRegistrarUsuario").show();

	}, 0);
}

$("#form-create-user").submit(function(e) {
	e.preventDefault();
	var frm = $(this).closest('form');
	var data = frm.serialize();
	$.ajax({
		url:$(document.activeElement).attr('formaction'),
		type:frm.prop('method'),
		data:data,
		success:function(respuesta) {
			if (respuesta == 0) {
				alert("Usuario creado exitosamente");
				location.reload();
			} else if (respuesta == 1) {
				alert("Usuario ya se encuentra registrado");
			} else if (respuesta == 2) {
				alert("Usuario actualizado exitosamente");
				location.reload();
			} else if (respuesta == 3) {
				alert("No se modifico ningun campo");
			} else {
				alert("No fue posible crear el usuario");
			}
		},
		error:function(jqXHR, textStatus, errorThrow) {
			alert('Error ajax! = ' + errorThrow);
		}
	});
});


// accion de eliminar usuario
$('#idFilaBorrar').click(function() {

	//valores obtendra el dato del td por posciones [0]
	var nombre_usuario =$('#idNameUser').val();
	var id_usuario = $('#idUserDel').val();

	console.log(id_usuario +' ' +nombre_usuario);
	$.ajax({
		url:'cuentaUsuario/eliminaUsuario',
		type:'POST',
		data:{'idUsuario' : id_usuario},
		success:function(respuesta) {
			console.log(respuesta);
			if (respuesta == 0) {
				alert("el usuario "+ nombre_usuario +" fue eliminado exitosamente");
				location.reload();
			} else {
				console.log(respuesta);
				alert("el usuario "+ nombre_usuario +" no pudo ser eliminado");
			}
		},
		error:function(jqXHR, textStatus, errorThrow) {
			alert('Error! = ' + errorThrow);
		}
	});

});

//modal con el nombre de usuario
$('.idFilaDel').click(function() {
	//valores obtendra el dato del td por posciones [0]
	var nombre_usuario = $(this).parents("tr").find("td")[1].innerHTML;
	var id_usuario = $(this).parents("tr").find("td")[5].innerHTML;
	$('#idNameUser').val(nombre_usuario);
	$('#idUserDel').val(id_usuario);
});


