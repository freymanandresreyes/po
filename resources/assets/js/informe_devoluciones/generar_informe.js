$("#generar_informe_devoluciones").click(function() {
  var tienda = $("#informe_devoluciones_tienda").val();
  var inicio = $("#fecha_inicio_devoluciones").val();
  var fin = $("#fecha_fin_devoluciones").val();
  if(tienda=="" || inicio=="" || fin==""){
    alertify.error("TODOS LOS CAMPOS SON OBLIGATORIOS.");
    return false;
  }
  var url = URLdominio + "informe_devoluciones_generar";
//   console.log(url);
  $.ajax({
    url: url,
    type: "GET",
    data: {
      tienda: tienda,
      inicio: inicio,
      fin: fin
    },
    dataType: "json",
    success: function(respuesta) {
      console.log(respuesta);
        $("#informe_devoluciones").html(respuesta);
      $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ]
      });
    }
  });
});
