// window.onload(alert("hola"));
$('#codigo_c_p').keypress(function(e){
        
    if(e.which==13)
    {
      var codigo= $('#codigo_c_p').val();
      var tienda= $('#tienda_c_p').val();
        console.log(tienda);
      codigo=codigo.toUpperCase();
    //   alert(tienda);
      var url= URLdominio+'buscar_c_p';
      $.ajax({
        url:url,
        type: 'GET',
        data: {
            codigo:codigo,
            tienda:tienda
        },
        dataType: 'json',
        success: function(respuesta){
            // console.log(consulta_c_p);
            if(respuesta==1)
            {
                var url= URLdominio+'select_categorias';
                $.ajax({
                url:url,
                type:'GET',
                data:{

                },
                dataType:'json',
                success:function(respuesta){
                    $('#categoria').html(respuesta);
                }
                });
                alertify.error("ESTE PRODUCTO NO ESTA EN ESTA TIENDA.");
                $('#categoria').prop('disabled', false);
                $('#subcategoria').prop('disabled',false);
                $('#titulo').prop('disabled', false); 
                $('#titulo').val('');
                $('#descripcion').val('');
                $('#descripcion').prop('disabled',false);
                $('#precio').prop('disabled',false);
                $('#precio_mayorista').prop('disabled',false);
                $('#cantidad').prop('disabled',false);
                $('#productoguardar').prop('disabled',false);
                $('#oferta').prop('disabled',false);
                return (false);
            }
            else
            {
                // console.log(respuesta);
                alertify.success("ESTE PRODUCTO YA EXISTE.");
                $('#categoria').prop('disabled', true);
                $('#subcategoria').prop('disabled',true);
                $('#titulo').prop('disabled', true); 
                $('#descripcion').prop('disabled',true);
                $('#productoguardar').prop('disabled',true);

                
                $('#categoria').html('<option value="'+respuesta.categoria_productos.id+'"'+'>'+respuesta.categoria_productos.categoria+'</option>');
                
                $('#subcategoria').html('<option>'+respuesta.subcategoria_productos.nombre_categoria+'</option>');
                $('#titulo').val(respuesta.titulo);
                $('#descripcion').val(respuesta.descripcion);
                
                // return(false);
                // $('#id_categoria').prop('disabled', false);
                
                return (false);
            }
          }
      });
      e.preventDefault();
      return(e.which!=13);
    }
});

// ********************************************
// *** FUNCION PARA BUSCAR ZONAS POR TIENDA ***
// ********************************************


$('#tienda_zona_crear').click(function(e){
    var zona = $('#tienda_zona_crear').val();

    if(zona){
        // console.log(zona);
        var url= URLdominio+'tienda_zona_crear';
        $.ajax({
            url:url,
            type: 'GET',
            data: {
            zona:zona,
            },
            dataType: 'json',
            success: function(respuesta){
                console.log(respuesta);
                $('#tienda_c_p').html(respuesta);
       
            }
      });
      
    }
});
