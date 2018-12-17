//*******************************************************
//***** CODIGO PARA PRODUCTOS EN CAJA REGISTRADORA ******
//*******************************************************
// VARIABLE QUE ALMACENA EL CODIGO DEL Producto

var producto_consulta;

$("#codigo_producto").keypress(function (e) {
  if (e.which == 13) {

    var tipo_tienda = $('#tipo_tienda').val();
    //Comprobar si la tienda aplican precios (1. mayorista), (2. detal)
    if (tipo_tienda == 1) {
      // *****************************************************
      //****** CODIGO PARA TIENDA CUANDO ES MAYORISTA ****** */
      //**************************************************** */
      var tipo_cliente = $('#tipo_cliente').val();
      if (tipo_cliente == 1) {
        //cliente estandar
      } else if (tipo_cliente == 2) {
        //cliente Mayorista.
        // alert('mayor');
        $('#boton_mayor').prop('disabled', false);
        // $("#codigo_producto").focus();
      }

    } else if (tipo_tienda == 2) {
      // *****************************************************
      //**** CODIGO PARA TIENDA CUANDO NO ES MAYORISTA ***** */
      //**************************************************** */

    }
    
    
 
  /************************************************************** */
  /********* LISTAR PRODUCTO PARA SER AGREGADO A LA FACTURA ***** */
  /************************************************************** */

  var codigo = $("#codigo_producto").val();
  var cod_product = codigo;
  var url = getAbsolutePath() + 'consulta_producto';
  var iva = $('#iva_caja').val();

  $.ajax({
    url: url,
    type: 'GET',
    data: {
      codigo_producto: codigo
    },
    dataType: 'json',
    success: function (respuesta) {
      console.log('respuesta del producto');
      console.log(respuesta);
      if (respuesta.length == 0) {
        alertify.alert("<b>No se encontradon registros de este producto.</b>", function () {
          $("#codigo_producto").val("");
          $("#precio_base").val("");
          $("#precio_descuento").val("");
          $("#porsentaje_descuento").val("");
          $("#cantidad_producto").val("");
          cod_product = "";
        });
      } else {
        // var saldo = $(this).attr("parametro2");
        var facturacion = $('#tag_factura option:selected').attr("name");
        /************************************************************************
         CODIGO PARA AGREGAR EL PRODUCTO AUTOMATICO  (ง︡'-'︠)ง
         *************************************************************************/
        // 0 = titulo del producto
        // 1 = codigo del producto
        // 2 = precio al detal
        // 3 = precio al mayor.
        // 4 = iva del producto
        // 5 = precio iva incluido.
        // 6 = porsentaje de descuento
        // 7 = Cantidad de productos.
        // 8 = precio total.
        // 9 = porsentaje de descuento de base de datos
        // 10 = id del producto.
        // 11 = Oferta del producto (Si o No).
        // 12 = id de la categoria
        // 13 = id de la subcategoria.
        // 14 = precio costo (al que se compro para la venta).
        // 15 = Configuraciones de productos.
        // 16 = Aplicar iva.
        // 17 = Tipo de factura (mayor o detal).
        // 18 = clasificaciond e productos para facturas.
        // 19 = botonera de opciones
        // if (respuesta[0]["oferta"] == 2) {
        var iva_tienda = $('#iva_caja').val();
        producto_consulta = respuesta;
        if (facturacion == 3) {
          var aplicar_iva = $('#select_seleccionar_iva').val();
          $('#boton_mayor').prop('disabled', false);
          if (aplicar_iva == 1) {
            // agregamos producto con iva

            //variables
        var precio_iva = null;
        var precio_total = null;
        var porsentaje = null;
        var clasificacion = null;

        if (respuesta.id_configuraciones == 1) {
          //clasificacion bolsas
          clasificacion = 3;
        } else if (respuesta.id_configuraciones == 2) {
          //clasificacion obsequio sin valor
          clasificacion = 4;
        } else if (respuesta.id_configuraciones == 3) {
          //clasificacion obsequio con valor
          clasificacion = 5;
        } else if (respuesta.id_configuraciones == 5) {
          //solo detal.
          clasificacion = 1;
        }
        //calcula el precio cuando no hay descuento.
        // 1. con oferta
        // 2. sin oferta
        if (respuesta.oferta == 2 && respuesta.aplicar_iva == 1) {
          precio_iva = (Math.round((parseFloat(respuesta.precio) * parseFloat(iva_tienda)) / 100));
          precio_total = Math.round((parseFloat(respuesta.precio)) + (precio_iva));
          porsentaje = 0;
        } else if (respuesta.oferta == 1 && respuesta.aplicar_iva == 1) {
          // alert('iva');
          var iva = (Math.round((parseFloat(respuesta.precio) * parseFloat(iva_tienda)) / 100));
          var total = Math.round((parseFloat(respuesta.precio)) + (iva));
          precio_iva = (Math.round((parseFloat(respuesta.precio)+(parseFloat(respuesta.precio) * parseFloat(iva_tienda)) / 100)));
          descuentoIva = (Math.round((parseFloat(total) * parseFloat(producto_consulta.descuentoOferta)) / 100));
          precio_total = Math.round((parseFloat(total)) - (descuentoIva));
          porsentaje = producto_consulta.descuentoOferta;
        } else if (respuesta.oferta == 2 && respuesta.aplicar_iva == 2) {
          precio_iva = 0;
          precio_total = parseFloat(respuesta.precio);
          porsentaje = 0;
        } else if (respuesta.oferta == 1 && respuesta.aplicar_iva == 2) {
          var iva = (Math.round((parseFloat(respuesta.precio) * parseFloat(producto_consulta.descuentoOferta)) / 100));
          var total = Math.round((parseFloat(respuestaprecio)) - (iva));
          precio_iva = 0;
          precio_total = total;
          porsentaje = producto_consultadescuentoOferta;
        }
        $('#caja_precio_detal').val(respuesta.precio);
        $('#caja_precio_mayor').val(respuesta.Precio_mayorista);
        $('#caja_titulo').val(respuesta.titulo);
        $('#caja_precio').val(precio_total);
        $('#caja_descuento').val(respuesta.descuentoOferta);
        $('#caja_total').val(precio_total);
        $('#caja_precio_sin_iva').val(producto_consulta.Precio_mayorista);
        $('#caja_iva').val(producto_consulta.Precio_mayorista);
        $('#caja_porsentaje').val(porsentaje);
        $('#caja_cantidad').val(1);
        $('#caja_descuento_oferta').val(producto_consulta.descuentoOferta);
        $('#caja_id_producto').val(producto_consulta.id);
        $('#caja_oferta').val(respuesta.oferta);
        $('#caja_id_categoria').val(producto_consulta.id_categoria);
        $('#caja_id_subcategoria').val(producto_consulta.id_subcategoria);
        $('#caja_precio_costo').val(producto_consulta.precio_costo);
        $('#caja_configuraciones').val(producto_consulta.id_configuraciones);
        $('#caja_aplicar_iva').val(producto_consulta.aplicar_iva);
        $('#caja_tipo_factura').val(1);
        $('#caja_clasificacion_producto').val(clasificacion);

        $("#codigo_producto").prop('disabled', true);


        // descuento
        // De
        // BONOS
        var cliente=$('#id_cliente').val();
        var url22 = getAbsolutePath() + 'descuento_bono_cliente';
        $.ajax({
          url: url22,
          type: 'GET',
          data: {
            cliente: cliente
          },
          dataType: 'json',
          success: function (respuesta) {
            if(respuesta!=0)
            {
              $('#caja_descuento').prop('disabled', true);
              $('#caja_descuento').val(respuesta);
              $('#caja_total').val(-precio_total*respuesta/100+precio_total);

            }
            else{
              $('#caja_descuento').prop('disabled', false);
              $('#caja_descuento').val(0);
            }
          }//fin del success
        });//fin de ajax
          }else if(aplicar_iva == 2){
            // producto sin iva

            //variables
        var precio_iva = null;
        var precio_total = null;
        var porsentaje = null;
        var clasificacion = null;

        if (respuesta.id_configuraciones == 1) {
          //clasificacion bolsas
          clasificacion = 3;
        } else if (respuesta.id_configuraciones == 2) {
          //clasificacion obsequio sin valor
          clasificacion = 4;
        } else if (respuesta.id_configuraciones == 3) {
          //clasificacion obsequio con valor
          clasificacion = 5;
        } else if (respuesta.id_configuraciones == 5) {
          //solo detal.
          clasificacion = 1;
        }
        //calcula el precio cuando no hay descuento.
        // 1. con oferta
        // 2. sin oferta
        // if (respuesta.oferta == 2 && respuesta.aplicar_iva == 1) {
        //   precio_iva = (Math.round((parseFloat(respuesta.precio) * parseFloat(iva_tienda)) / 100));
        //   precio_total = Math.round((parseFloat(respuesta.precio)) + (precio_iva));
        //   porsentaje = 0;
        // } else if (respuesta.oferta == 1 && respuesta.aplicar_iva == 1) {
        //   // alert('iva');
        //   var iva = (Math.round((parseFloat(respuesta.precio) * parseFloat(iva_tienda)) / 100));
        //   var total = Math.round((parseFloat(respuesta.precio)) + (iva));
        //   precio_iva = (Math.round((parseFloat(respuesta.precio)+(parseFloat(respuesta.precio) * parseFloat(iva_tienda)) / 100)));
        //   descuentoIva = (Math.round((parseFloat(total) * parseFloat(producto_consulta.descuentoOferta)) / 100));
        //   precio_total = Math.round((parseFloat(total)) - (descuentoIva));
        //   porsentaje = producto_consulta.descuentoOferta;
        // } else if (respuesta.oferta == 2 && respuesta.aplicar_iva == 2) {
          precio_iva = respuesta.precio;
          precio_total = parseFloat(respuesta.precio);
          porsentaje = 0;

        // } else if (respuesta.oferta == 1 && respuesta.aplicar_iva == 2) {
        //   var iva = (Math.round((parseFloat(respuesta.precio) * parseFloat(producto_consulta.descuentoOferta)) / 100));
        //   var total = Math.round((parseFloat(respuestaprecio)) - (iva));
        //   precio_iva = 0;
        //   precio_total = total;
        //   porsentaje = producto_consultadescuentoOferta;
        // }
        $('#caja_precio_detal').val(respuesta.precio);
        $('#caja_precio_mayor').val(respuesta.Precio_mayorista);
        $('#caja_titulo').val(respuesta.titulo);
        $('#caja_precio').val(precio_iva);
        $('#caja_descuento').val(0);
        $('#caja_total').val(precio_total);
        $('#caja_precio_sin_iva').val(producto_consulta.Precio_mayorista);
        $('#caja_iva').val(producto_consulta.Precio_mayorista);
        $('#caja_porsentaje').val(porsentaje);
        $('#caja_cantidad').val(1);
        $('#caja_descuento_oferta').val(producto_consulta.descuentoOferta);
        $('#caja_id_producto').val(producto_consulta.id);
        $('#caja_oferta').val(respuesta.oferta);
        $('#caja_id_categoria').val(producto_consulta.id_categoria);
        $('#caja_id_subcategoria').val(producto_consulta.id_subcategoria);
        $('#caja_precio_costo').val(producto_consulta.precio_costo);
        $('#caja_configuraciones').val(producto_consulta.id_configuraciones);
        $('#caja_aplicar_iva').val(producto_consulta.aplicar_iva);
        $('#caja_tipo_factura').val(1);
        $('#caja_clasificacion_producto').val(clasificacion);

        $("#codigo_producto").prop('disabled', true);


        // descuento
        // De
        // BONOS
        var cliente=$('#id_cliente').val();
        var url22 = getAbsolutePath() + 'descuento_bono_cliente';
        $.ajax({
          url: url22,
          type: 'GET',
          data: {
            cliente: cliente
          },
          dataType: 'json',
          success: function (respuesta) {
            if(respuesta!=0)
            {
              $('#caja_descuento').prop('disabled', true);
              $('#caja_descuento').val(respuesta);
              $('#caja_total').val(-precio_total*respuesta/100+precio_total);
            }
            else{
              $('#caja_descuento').prop('disabled', false);
              $('#caja_descuento').val(0);
            }
          }//fin del success
        });//fin de ajax
          }
          
        }else{
        //variables
        var precio_iva = null;
        var precio_total = null;
        var porsentaje = null;
        var clasificacion = null;

        if (respuesta.id_configuraciones == 1) {
          //clasificacion bolsas
          clasificacion = 3;
        } else if (respuesta.id_configuraciones == 2) {
          //clasificacion obsequio sin valor
          clasificacion = 4;
        } else if (respuesta.id_configuraciones == 3) {
          //clasificacion obsequio con valor
          clasificacion = 5;
        } else if (respuesta.id_configuraciones == 5) {
          //solo detal.
          clasificacion = 1;
        }
        //calcula el precio cuando no hay descuento.
        // 1. con oferta
        // 2. sin oferta
        if (respuesta.oferta == 2 && respuesta.aplicar_iva == 1) {
          precio_iva = (Math.round(((parseFloat(respuesta.precio) * parseFloat(iva_tienda)) / 100)+parseFloat(respuesta.precio)));
          a = (Math.round((parseFloat(respuesta.precio) * parseFloat(iva_tienda)) / 100));
          precio_total = Math.round((parseFloat(respuesta.precio)) + (a));
          porsentaje = 0;
          $("#caja_precio").val(precio_iva);
          $("#caja_total").val(precio_iva);
        } else if (respuesta.oferta == 1 && respuesta.aplicar_iva == 1) {
          // alert('iva');
          var iva = (Math.round((parseFloat(respuesta.precio) * parseFloat(iva_tienda)) / 100));
          var total = Math.round((parseFloat(respuesta.precio)) + (iva));
          precio_iva = (Math.round((parseFloat(respuesta.precio)+(parseFloat(respuesta.precio) * parseFloat(iva_tienda)) / 100)));
          descuentoIva = (Math.round((parseFloat(total) * parseFloat(producto_consulta.descuentoOferta)) / 100));
          precio_total = Math.round((parseFloat(total)) - (descuentoIva));
          porsentaje = producto_consulta.descuentoOferta;
          $("#caja_precio").val(precio_iva);
          $("#caja_total").val(precio_iva);
        } else if (respuesta.oferta == 2 && respuesta.aplicar_iva == 2) {
          precio_iva = 0;
          precio_total = parseFloat(respuesta.precio);
          porsentaje = 0;
          $("#caja_precio").val(precio_total);
          $("#caja_total").val(precio_total);
          // alert(precio_total);
        } else if (respuesta.oferta == 1 && respuesta.aplicar_iva == 2) {
          var iva = (Math.round((parseFloat(respuesta.precio) * parseFloat(producto_consulta.descuentoOferta)) / 100));
          var total = Math.round((parseFloat(respuestaprecio)) - (iva));
          precio_iva = 0;
          precio_total = total;
          porsentaje = producto_consultadescuentoOferta;
          $("#caja_precio").val(precio_iva);
          $('#caja_total').val(precio_iva);
        }
        $('#caja_precio_detal').val(respuesta.precio);
        $('#caja_precio_mayor').val(respuesta.Precio_mayorista);
        $('#caja_titulo').val(respuesta.titulo);
        $('#caja_descuento').val(respuesta.descuentoOferta);
        $('#caja_precio_sin_iva').val(producto_consulta.Precio_mayorista);
        $('#caja_iva').val(producto_consulta.Precio_mayorista);
        $('#caja_porsentaje').val(porsentaje);
        $('#caja_cantidad').val(1);
        $('#caja_descuento_oferta').val(producto_consulta.descuentoOferta);
        $('#caja_id_producto').val(producto_consulta.id);
        $('#caja_oferta').val(respuesta.oferta);
        $('#caja_id_categoria').val(producto_consulta.id_categoria);
        $('#caja_id_subcategoria').val(producto_consulta.id_subcategoria);
        $('#caja_precio_costo').val(producto_consulta.precio_costo);
        $('#caja_configuraciones').val(producto_consulta.id_configuraciones);
        $('#caja_aplicar_iva').val(producto_consulta.aplicar_iva);
        $('#caja_tipo_factura').val(1);
        $('#caja_clasificacion_producto').val(clasificacion);

        $("#codigo_producto").prop('disabled', true);


        // descuento
        // De
        // BONOS
        var cliente=$('#id_cliente').val();
        var url22 = getAbsolutePath() + 'descuento_bono_cliente';
        $.ajax({
          url: url22,
          type: 'GET',
          data: {
            cliente: cliente
          },
          dataType: 'json',
          success: function (respuesta) {
            if(respuesta!=0)
            {
              $('#caja_descuento').prop('disabled', true);
              $('#caja_descuento').val(respuesta);
              $('#caja_total').val(-precio_total*respuesta/100+precio_total);
            }
            else{
              $('#caja_descuento').prop('disabled', false);
              $('#caja_descuento').val(0);
            }
          }//fin del success
        });//fin de ajax
        }
      }
      
    }//fin del success
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
  return (e.which != 13);
}
});