$('#generar_informe_elkin_devoluciones').click(function()
{
    var tienda=$('#informe_tienda_select').val();
    var fecha1=$('#fecha1').val();
    var fecha2=$('#fecha2').val();

    if(tienda==""){
        alertify.error("DEBES ELEGIR UNA TIENDA.");
        return false;
    }
    if(fecha1=="" || fecha2==""){
        alertify.error("LAS FECHAS SON REQUERIDAS.");
        return false;
      }

    var url = URLdominio + "generar_informe_elkin_devoluciones";

    $.ajax({
        url: url,
        type: "GET",
        data: {
          tienda: tienda,
          fecha1: fecha1,
          fecha2: fecha2,
        },
        dataType: "json",
        success: function(respuesta) {
          $("#informe_tabla_elkin_devoluciones").html(respuesta);
          $('#example23').DataTable({
            dom: 'Bfrtip',
            buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
            ]
          });
        }
      });
});