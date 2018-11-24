$('#generar_informe_elkin').click(function()
{
    var fecha1=$('#fecha1').val();
    var fecha2=$('#fecha2').val();

    if(fecha1=="" || fecha2==""){
        alertify.error("LAS FECHAS SON REQUERIDAS.");
        return false;
      }

    var url = URLdominio + "generar_informe_elkin";

    $.ajax({
        url: url,
        type: "GET",
        data: {
          fecha1: fecha1,
          fecha2: fecha2,
        },
        dataType: "json",
        success: function(respuesta) {
          $("#informe_tabla_elkin").html(respuesta);
          $('#example23').DataTable({
            dom: 'Bfrtip',
            buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
            ]
          });
        }
      });
});