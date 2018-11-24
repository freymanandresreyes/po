$('#buscar_facturas_auditorias').click(function()
{
    var codigo=$('#codigo').val();
    if(codigo==""){
        alertify.error("El campo codigo es requerido.");
        return false;
      }

    var url = URLdominio + "buscar_facturas_auditorias";

    $.ajax({
        url: url,
        type: "GET",
        data: {
          codigo: codigo,
        },
        dataType: "json",
        success: function(respuesta) {
          $("#tabla_auditoria").html(respuesta);
          $('#example23').DataTable({
            dom: 'Bfrtip',
            buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
            ]
          });
        }
      });
});