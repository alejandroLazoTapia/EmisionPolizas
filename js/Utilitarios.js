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


function activar(){
    document.getElementById("cliente").disabled = false;
    document.getElementById("numPoliza").disabled = false;
    document.getElementById("pais").disabled = false;
    document.getElementById("aFavor").disabled = false;
    document.getElementById("direccion").disabled = false;
    document.getElementById("refInterna").disabled = false;
   // document.getElementById("moneda").disabled = false;
    document.getElementById("primaMinima").disabled = false;
    document.getElementById("montoAsegurado").disabled = false;
    document.getElementById("tasa").disabled = false;
    document.getElementById("clausula").disabled = false;
    document.getElementById("prima").disabled = false;
    document.getElementById("fechaEmbarque").disabled = false;
    document.getElementById("fechaDestino").disabled = false;
    document.getElementById("tipoEmbalaje").disabled = false;
    document.getElementById("nomLineaNave").disabled = false;
    document.getElementById("numVueloNave").disabled = false;
    document.getElementById("guiaBl").disabled = false;
    document.getElementById("transporte").disabled = false;
    document.getElementById("importacion").disabled = false;
    document.getElementById("exportacion").disabled = false;
    document.getElementById("embNacional").disabled = false;
    document.getElementById("descMercaderia").disabled = false;
    document.getElementById("paisOrigen").disabled = false;
    document.getElementById("ciudadOrigen").disabled = false;
    document.getElementById("puertoOrigen").disabled = false;
    document.getElementById("paisDestino").disabled = false;
    document.getElementById("ciudadDestino").disabled = false;
    document.getElementById("puertoDestino").disabled = false;

    document.getElementById("cliente").value = "Seleccione";
    document.getElementById("numPoliza").value = "Seleccione";
    document.getElementById("pais").value = "Seleccione";
    document.getElementById("aFavor").value = "Seleccione";
    document.getElementById("direccion").value = "";
    document.getElementById("refInterna").value = "";
    document.getElementById("primaMinima").value = "";
    document.getElementById("montoAsegurado").value = "";
    document.getElementById("tasa").value = "";
    document.getElementById("clausula").value = "Seleccione";
    document.getElementById("prima").value = "";
    document.getElementById("fechaEmbarque").value = "";
    document.getElementById("fechaDestino").value = "";
    document.getElementById("tipoEmbalaje").value = "Seleccione";
    document.getElementById("nomLineaNave").value = "";
    document.getElementById("numVueloNave").value = "";
    document.getElementById("guiaBl").value = "";
    document.getElementById("transporte").value = "Seleccione";
    document.getElementById("descMercaderia").value = "";
    document.getElementById("paisOrigen").value = "Seleccione";
    document.getElementById("ciudadOrigen").value = "Seleccione";
    document.getElementById("puertoOrigen").value = "";
    document.getElementById("paisDestino").value = "Seleccione";
    document.getElementById("ciudadDestino").value = "Seleccione";
    document.getElementById("puertoDestino").value = "";
  }

  function llenar(){
  //  document.getElementById("cliente").disabled = false;
 //   document.getElementById("numPoliza").disabled = false;
    document.getElementById("pais").disabled = false;
    document.getElementById("aFavor").disabled = false;
    document.getElementById("direccion").disabled = false;
    document.getElementById("refInterna").disabled = false;
   // document.getElementById("moneda").disabled = false;
    document.getElementById("primaMinima").disabled = false;
    document.getElementById("montoAsegurado").disabled = false;
    document.getElementById("tasa").disabled = false;
    document.getElementById("clausula").disabled = false;
    document.getElementById("prima").disabled = false;
    document.getElementById("fechaEmbarque").disabled = false;
    document.getElementById("fechaDestino").disabled = false;
    document.getElementById("tipoEmbalaje").disabled = false;
    document.getElementById("nomLineaNave").disabled = false;
    document.getElementById("numVueloNave").disabled = false;
    document.getElementById("guiaBl").disabled = false;
    document.getElementById("transporte").disabled = false;
    document.getElementById("importacion").disabled = false;
    document.getElementById("exportacion").disabled = false;
    document.getElementById("embNacional").disabled = false;
    document.getElementById("descMercaderia").disabled = false;
    document.getElementById("paisOrigen").disabled = false;
    document.getElementById("ciudadOrigen").disabled = false;
    document.getElementById("puertoOrigen").disabled = false;
    document.getElementById("paisDestino").disabled = false;
    document.getElementById("ciudadDestino").disabled = false;
    document.getElementById("puertoDestino").disabled = false;

//llena campos
    document.getElementById("cliente").value = document.getElementById("clientObtDatos").value;
    document.getElementById("numPoliza").value = document.getElementById("polizaObtDatos").value;
    document.getElementById("pais").value = "Chile";
    document.getElementById("aFavor").value = "1";
    document.getElementById("direccion").value = "av. providencia 1017, providencia";
    document.getElementById("refInterna").value = "xxx Ref Interna xxx";
    document.getElementById("primaMinima").value = "xxx prima Mínima xxx";
    document.getElementById("montoAsegurado").value = "5555555";
    document.getElementById("tasa").value = "0.25";
    document.getElementById("clausula").value = "A";
    document.getElementById("prima").value = "500";
    document.getElementById("fechaEmbarque").value = "17-03-2020";
    document.getElementById("fechaDestino").value = "25-03-2020";
    document.getElementById("tipoEmbalaje").value = "CONTAINER";
    document.getElementById("nomLineaNave").value = "25647812";
    document.getElementById("numVueloNave").value = "LAN-223";
    document.getElementById("guiaBl").value = "35FJ842G5TR";
    document.getElementById("transporte").value = "Aire";
    document.getElementById("descMercaderia").value = "chocolates, pasteles, tortas"
    document.getElementById("paisOrigen").value = "Chile"
    document.getElementById("ciudadOrigen").value = "Santiago"
    document.getElementById("puertoOrigen").value = "PUERTO DE SAN ANTONIO"
    document.getElementById("paisDestino").value = "China"
    document.getElementById("ciudadDestino").value = "Hong Kong"
    document.getElementById("puertoDestino").value = "PUERTO DE HONG KONG"
  }




function HabilitarGrilla(){
    $("#grillaCert").show();
 //   document.getElementById("grillaCertificados").style.display = "block";
}

