$("#informe_devoluciones_zona").click(function() {
    var zona = $("#informe_devoluciones_zona").val();
  console.log(zona);
  if (zona == null || zona == "") {
    console.log("pase");
    $("#informe_devoluciones_tienda").attr("disabled", true);
    $("#informe_devoluciones_tienda").val("");
  } else {
      var url = URLdominio + "cargar_tiendas_informe";
    console.log(url);
    $.ajax({
      url: url,
      type: "GET",
      data: {
        zona: zona
      },
      dataType: "json",
      success: function(respuesta) {
        console.log(respuesta);
        if (respuesta.length == 0) {
          ç;
          console.log("pase");
          $("#informe_devoluciones_tienda").attr("disabled", true);
          $("#informe_devoluciones_tienda").val("");
        } else {
          // $('#informe_tienda');
          $("#informe_devoluciones_tienda").html(respuesta);
          $("#informe_devoluciones_tienda").attr("disabled", false);
        }
      }
    });
  }
});

