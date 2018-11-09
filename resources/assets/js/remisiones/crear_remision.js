$('#codigo_remision').keypress(function(e){
    if (e.which == 13) {
        var url = getAbsolutePath() + 'buscar_productos';
        var codigo = $('#codigo_remision').val();
        var tienda = $('#tienda_remisiones').val();
        var opcion = $('#opciones_remisiones').val();
        codigo=codigo.toUpperCase();   
        if(tienda=="" && opcion == 1){
            alertify.error("Elija una tienda");
        }else{
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    codigo: codigo,
                    tienda: tienda
                },
                dataType: 'json',
                success: function (respuesta) {
                    // console.log(respuesta);
                    if(respuesta == 1){
                        alertify.error("No puedes enviar remisiones a la misma tienda en la que estas");
                        $('#cantidad_remision').prop('disabled', true);
                        $('#crear_remision').prop('disabled',true);
                        $('#precio_remision').val("");
                        $('#id_producto_remision').val("");
                    }
                    else if(respuesta == 2){
                        alertify.error("Este Producto no existe en esta tienda");
                        $('#cantidad_remision').prop('disabled', true);    
                        $('#crear_remision').prop('disabled',true);  
                        $('#precio_remision').val("");
                        $('#id_producto_remision').val("");                 
                    }
                    else if(respuesta == 3 && opcion == 1){
                        alertify.error("Este Producto no existe en la tienda que lo piensas enviar");
                        $('#cantidad_remision').prop('disabled', true);
                        $('#crear_remision').prop('disabled',true);
                        $('#precio_remision').val("");
                        $('#id_producto_remision').val("");                       
                    }
                    else{
                      alertify.success("PRODUCTO ENCONTRADO, "+ respuesta.cantidad +" UND DISPONIBLES");
                      $('#cantidad_remision').prop('disabled', false);
                      $('#precio_remision').val(respuesta.precio);
                      $('#id_producto_remision').val(respuesta.id);
                    }
                }//fin del success
            });//fin de ajax
        }    
    e.preventDefault();
    return (e.which != 13);
    }
});