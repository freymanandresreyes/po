$("#buscar_informe_productos").click(function() {
    var tienda = $("#tienda").val();

    var url = URLdominio + "consulta_informa_productos";

    if (tienda == "" ) {
    alertify.error("DEBES SELECCIONAR UNA TIENDA.");
  } else {
    $.ajax({
      url: url,
      type: "GET",
      data: {
        tienda: tienda
      },
      dataType: "json",
      success: function(respuesta) {
        if (respuesta) {
            $("#tabla_productos_informe").html(respuesta);
          $("#example23").DataTable({
            dom: "Bfrtip",
            buttons: ["copy", "csv", "excel", "pdf", "print"]
          });
        }
      }
    });
  }
});