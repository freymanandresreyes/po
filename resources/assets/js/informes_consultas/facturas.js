$("#buscar_informe_facturas").click(function() {
    var fecha1 = $("#fecha_inicio").val();
    var fecha2 = $("#fecha_fin").val();

  var url = URLdominio + "consulta_informa_facturas";

  if (fecha1 == "" || fecha2 == "") {
    alertify.error("TODOS LOS CAMPOS SON OBLIGATORIOS.");
  } else {
    $.ajax({
      url: url,
      type: "GET",
      data: {
        fecha1: fecha1,
        fecha2: fecha2
      },
      dataType: "json",
      success: function(respuesta) {
        if (respuesta) {
            $("#tabla_facturas_informe").html(respuesta);
            $('#example23').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        }
      }
    });
  }
});