$("#codigo_bodega").keypress(function(e) {
  if (e.which == 13) {
      $("#codigo_bodega").prop('disabled',true);
      var codigo = $("#codigo_bodega").val();
      $("#codigo_bodega").val('');
    //   alert(codigo.length);
      if (codigo == "" || codigo.length<=8){
          alertify.error("EL CAMPO ES OBLIGATORIO.");
          $("#codigo_bodega").prop('disabled', false);
          $("#codigo_bodega").val('');
          $("#codigo_bodega").focus();
          return false;
      }
      var url = URLdominio + 'buscar_producto_bodega';
      $.ajax({
          url: url,
          type: 'GET',
          data: {
              codigo: codigo
          },
          dataType: 'json',
          success: function (respuesta) {
              if(respuesta){
                  $("#codigo_bodega").prop('disabled', false);
                  $("#tabla_bodega").html(respuesta);
                  $("#tabla_bodega_json").DataTable({
                    dom: "Bfrtip",
                    buttons: [
                      "copy",
                      "csv",
                      "excel",
                      "pdf",
                      "print"
                    ]
                  });
                  $("#codigo_bodega").focus();
                  alertify.success("Producto Guardado.");
              }
          }
      });
      e.preventDefault();
      return (e.which != 13);
  }
});