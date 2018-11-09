$('#guardar_modal_producto').click(function(){
    //  alert('ok');
    var tienda = $('#tienda_c_p').val();
    var categoria = $('#categoria_modal').val();
    var subcategoria = $('#subcategoria_modal').val();
    var titulo = $('#titulo_modal').val();
    var descripcion = $('#descripcion_modal').val();
    var codigo = $('#codigo_modal').val();

    if(tienda != "" && categoria != "" && subcategoria != "" && titulo != "" && descripcion != "" && codigo != ""){

        var url= URLdominio+'guardar_modal_producto';
    // FIN FUNCION GLOBAL
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                tienda: tienda,
                categoria: categoria,
                subcategoria: subcategoria,
                titulo: titulo,
                descripcion: descripcion,
                codigo: codigo
            },
            dataType: 'json',
            success: function(respuesta){
                
             if(respuesta)
             { 
                // console.log(respuesta);
                $('#proveedor').prop('disabled',false);
                $('#numero_factura').prop('disabled',false);
                $('#forma_pago').prop('disabled',false);
                $('#iva').prop('disabled',false);
                $('#fecha').prop('disabled',false);
                $('#fecha_vencimiento').prop('disabled',false);
                $('#cantidad').prop('disabled',false);
                $('#costo_unitario').prop('disabled',false);
                $('#p_detal').prop('disabled',false);
                $('#p_mayor').prop('disabled',false);

                $('#codigo').val(respuesta.codigo);
                $('#id_producto').val(respuesta.id);
                $('#categoria').val(respuesta.categoria_productos.categoria);
                $('#subcategoria').val(respuesta.subcategoria_productos.nombre_categoria);
                $('#titulo').val(respuesta.titulo);
                $('#descripcion').val(respuesta.descripcion);
                $('#id_producto').val(respuesta.id);

                $('#categoria_modal').val("");
                $('#subcategoria_modal').val("");
                $('#titulo_modal').val("");
                $('#descripcion_modal').val("");
                $('#codigo_modal').val("");

                $("modal_crear_producto_compras").removeClass("show");
                $("#modal_crear_producto_compras").css({
                    "display": "none"
                });
             }else{
                $('#proveedor').append('<option value="'+respuesta.id+'" selected="selected">'+respuesta.nombre+'</option>');
                alertify.success("PROVEEDOR CREADO EXITOSAMENTE.");
             }
             
            }//fin del success
          });//fin de ajax

    }else{
        alertify.error("TODOS LOS CAMPOS SON OBLIGATORIOS.");
        return(false);
    }
});

$("#cerrar_modal_producto").click(function () {
    $("modal_crear_producto_compras").removeClass("show");
    $("#modal_crear_producto_compras").css({
      "display": "none"
    });

    $('#categoria_modal').val("");
    $('#subcategoria_modal').val("");
    $('#titulo_modal').val("");
    $('#descripcion_modal').val("");
    $('#codigo_modal').val("");
  });