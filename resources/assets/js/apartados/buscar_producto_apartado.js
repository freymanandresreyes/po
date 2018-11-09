$('#codigo_apartado').keypress(function(e){
        
    if(e.which==13)
    {
      var codigo= $('#codigo_apartado').val();
      var tienda= $('#tienda_apartado').val();
      var iva = $('#iva_apartado').val();
       

      codigo=codigo.toUpperCase();
    //   alert(codigo);
    //   return(false);
      var url= URLdominio+'buscar_producto_compra';
      $.ajax({
        url:url,
        type: 'GET',
        data: {
            codigo:codigo,
            tienda:tienda
        },
        dataType: 'json',
        success: function(respuesta){
             console.log(respuesta);
            if(respuesta==1)
            {
                alertify.error("ESTE PRODUCTO NO EXISTE EN ESTA TIENDA.");
                $('#categoria').val("");
                $('#subcategoria').val("");
                $('#titulo').val("");
                $('#descripcion').val("");
            }
            else
            {
                alertify.success("PRODUCTO ENCONTRADO.");
                $('#proveedor').prop('disabled',false);
                $('#numero_factura').prop('disabled',false);
                $('#forma_pago').prop('disabled',false);
                $('#iva').prop('disabled',false);
                $('#fecha').prop('disabled',false);
                $('#fecha_vencimiento').prop('disabled',false);
                $('#costo_unitario').prop('disabled',false);
                $('#p_detal').prop('disabled',false);
                $('#p_mayor').prop('disabled',false);

                $('#categoria').val(respuesta.categoria_productos.categoria);
                $('#subcategoria').val(respuesta.subcategoria_productos.nombre_categoria);
                $('#titulo').val(respuesta.titulo);
                $('#descripcion').val(respuesta.descripcion);
                $('#id_producto').val(respuesta.id);
                $('#precio_detal_apartado').val(respuesta.precio);
                $('#precio_mayorista_apartado').val(respuesta.Precio_mayorista);
                var precio_producto = (Math.round(((parseFloat(respuesta.precio)* iva)/100)+(parseFloat(respuesta.precio))))
                $('#valor_apartado').val(precio_producto);
                $('#cantidad').val("1");
            }
          }
      });
      e.preventDefault();
      return(e.which!=13);
    }
});

/********** MODAL BUSCAR PRODUCTO ******* */

$('#codigo_modal').keypress(function(e){
        
    if(e.which==13)
    {
      var codigo= $('#codigo_modal').val();
      var tienda= $('#tienda_c_p').val();

      codigo=codigo.toUpperCase();
    //   alert(codigo);
    //   return(false);
      var url= URLdominio+'buscar_producto_compra';
      $.ajax({
        url:url,
        type: 'GET',
        data: {
            codigo:codigo,
            tienda:tienda
        },
        dataType: 'json',
        success: function(respuesta){
            // console.log(respuesta.categoria_productos.categoria);
            if(respuesta==1)
            {
                alertify.error("ESTE PRODUCTO NO EXISTE EN ESTA TIENDA.");
                $('#categoria_modal').val("");
                $('#subcategoria_modal').val("");
                $('#titulo_modal').val("");
                $('#descripcion_modal').val("");
                $('#titulo_modal').prop('disabled',false);
                $('#descripcion_modal').prop('disabled',false);

            }
            else
            {
                alertify.success("PRODUCTO ENCONTRADO.");
                  
                $('#titulo_modal').prop('disabled',true);
                $('#descripcion_modal').prop('disabled',true);
                $('#categoria_modal').prop('disabled',true);
                $('#subcategoria_modal').prop('disabled',true);
                

                $('#categoria_modal').html('<option>'+respuesta.categoria_productos.categoria+'</option>');
                // $('#categoria_modal').html(respuesta.categoria_productos.categoria);
                $('#subcategoria_modal').html('<option>'+respuesta.subcategoria_productos.nombre_categoria+'</option>');
                $('#titulo_modal').val(respuesta.titulo);
                $('#descripcion_modal').val(respuesta.descripcion);
               
            }
          }
      });
      e.preventDefault();
      return(e.which!=13);
    }
});