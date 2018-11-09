//FUNCION PARA BUSCAR CLIENTE POR SU DOCUMENTO
$("#documento_sistecredito").keydown(function (e) {
    // var Ndocumento = $("#documento_cliente").val();
    if (e.which == 13) {
      var Ndocumento = $("#documento_sistecredito").val();
      var url = getAbsolutePath() + 'clienteConsultar';
      
      $.ajax({
        url: url,
        type: 'GET',
        data: {
          cedula: Ndocumento
        },
        dataType: 'json',
        success: function (respuesta) {
          // alert(Ndocumento);
          console.log('respuesta');
          console.log(respuesta);
          var Nregistros = Object.keys(respuesta).length;
          if (Nregistros == 0) {
            alertify.error("El usuario no existe."); 
            return false; 
            
          } else {
            var id_cliente = respuesta.id;
            $("#nombres_sistecredito").val(respuesta.nombres + ' ' + respuesta.apellidos);
            
            //habilitar los input para agregar productos a la factura.
            $('#codigo_producto').prop('disabled', false);
            $('#tag_factura').prop('disabled', false);
            $('#vendedor_factura').prop('disabled', false);
  
  
          }
        }//fin del success
      });//fin de ajax
      return (e.which != 13);
    }
  });

  function buscar_facturas_sistecredito(dato){
      
  }