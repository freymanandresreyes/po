$('#producto_compras').click(function(){

    var tienda = $('#tienda_c_p').val();

    if(tienda){

        var url= URLdominio+'consulta_categoria';
    // FIN FUNCION GLOBAL
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                tienda: tienda,
            },
            dataType: 'json',
            success: function(respuesta){
                // console.log(respuesta);
             if(respuesta)
             { 

                 respuesta.forEach(respuesta => {
                    $('#categoria_modal').append('<option value="'+respuesta.id+'">'+respuesta.categoria+'</option>');
                 });
                
                return(false);
             }else{
                $('#proveedor').append('<option value="'+respuesta.id+'">'+respuesta.nombre+'</option>');
                alertify.success("PROVEEDOR CREADO EXITOSAMENTE.");
             }
             
            }//fin del success
          });//fin de ajax

    }else{
        alertify.error("DEBE SELECCIONAR UNA TIENDA.");
        return(false);
    }

    
    // *********** MODAL VENTA ***********
    $("#modal_crear_producto_compras").addClass("show");

    $("#modal_crear_producto_compras").css({
        "display": "block",
        "padding-right": "16px",
        "background": "rgba(0, 0, 0, 0.5)"
    });
    // *********** FIN MODAL VENTA *******
});