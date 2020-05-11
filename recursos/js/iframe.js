$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
  })
  
$('#myModalUpdate').click(function () {
	var idCertificado = $('#idCertAct').val();
		console.log(idCertificado);
		if (idCertificado == "") {
			alert("Debes seleccionar un Certificado");
		} else {
	  $('#myInput').trigger('focus')
	  }
  })

  
$('#myModalDelete').on('shown.bs.modal', function () {
	  $('#myInput').trigger('focus')
  })  
  