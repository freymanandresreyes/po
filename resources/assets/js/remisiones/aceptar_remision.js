$('#remisiones_aceptar').on("click", ".aceptando_producto_remision", function () {
    // alert("hola");
    $(this).attr('disabled', true);
    var identificador = $(this).attr('name');
    
    // ********* INICIO AJAX ************
    var url = getAbsolutePath() + 'aceptar_remision_seleccionada';

    $.ajax({
        url: url,
        type: 'GET',
        data: {
            identificador: identificador
        },
        dataType: 'json',
        success: function (respuesta) {
            if(respuesta){
                alertify.success("DATOS ALMACENADOS CORRECTAMENTE.");
                location.reload();
    
            }
        }
    }).fail( function( jqXHR, textStatus, errorThrown ) {

        if (jqXHR.status === 0) {
      
          alert('Not connect: Verify Network.');
      
        } else if (jqXHR.status == 404) {

            var mensaje = jQuery.parseJSON( jqXHR.responseText );
            alertify.log(mensaje.message);
      
        } else if (jqXHR.status == 500) {
      
          alert('Internal Server Error [500].');
      
        } else if (textStatus === 'parsererror') {
      
          alert('Requested JSON parse failed.');
      
        } else if (textStatus === 'timeout') {
      
          alert('Time out error.');
      
        } else if (textStatus === 'abort') {
      
          alert('Ajax request aborted.');
      
        } else {
      
          alert('Uncaught Error: ' + jqXHR.responseText);
      
        }
      
      });//fin de ajax
    //  *********** FIN AJAX **************
});

$('#remisiones_aceptar').on("click", ".rechazar_producto_remision", function () {
    // alert("hola");
    var identificador = $(this).attr('name');
    
    // ********* INICIO AJAX ************
    var url = getAbsolutePath() + 'rechazar_remision_seleccionada';

    $.ajax({
        url: url,
        type: 'GET',
        data: {
            identificador: identificador
        },
        dataType: 'json',
        success: function (respuesta) {
            if(respuesta){
                alertify.log("PRODUCTO RECHAZADO.");
                location.reload();
                
            }
        }
    });//fin de ajax
    //  *********** FIN AJAX **************
});