//FUNCION PARA BUSCAR SI EL CLIENTE TIENE UN APARTADO
$('#id_cliente').val("");
function buscar_separado(dato) {
  var id_cliente = dato;

  var url = getAbsolutePath() + 'buscar_apartado_caja';

  $.ajax({
    url: url,
    type: 'POST',
    headers: { 'X-CSRF-Token': $('meta[name=_token]').attr('content') },
    data: {
      id_cliente: id_cliente
    },
    dataType: 'json',
    success: function (respuesta) {
      console.log(respuesta);
      if (respuesta.length != 0) {
        alertify.confirm("Se encontraron apartados para este cliente. Pulse <b>ACEPTAR</b> para agregarlos a la factura, de lo contrario pulse <b>CANCELAR</b>.</p>", function (e) {
          if (e) {

            /************************************************************************
         CODIGO PARA AGREGAR EL PRODUCTO CUANDO ACEPTAN SEPARADOS  (ง︡'-'︠)ง
        *************************************************************************/
            var saldo_efectivo = 0;
            var saldo_tarjeta_uno = 0;
            var saldo_tarjeta_dos = 0;
            /*******************variables para calcular precios iva, subtotal y total*******/
            var subtotal = 0;
            var ivatotal = 0;
            var precioTotal = 0;
            /**********************FIN*****************************************************/
            $('#consecutivo_apartado').val(respuesta[0]['consecutivo']);

            for (var i = 0; i < respuesta.length; i++) {
              if (parseFloat(respuesta[i]['pago_efectivo'])) {
                saldo_efectivo = saldo_efectivo + (parseFloat(respuesta[i]['pago_efectivo']));
              }
              if (parseFloat(respuesta[i]['pago_tarjeta_uno'])) {

                saldo_tarjeta_uno = saldo_tarjeta_uno + (parseFloat(respuesta[i]['pago_tarjeta_uno']));
              }
              if (parseFloat(respuesta[i]['pago_tarjeta_dos'])) {

                saldo_tarjeta_dos = saldo_tarjeta_dos + (parseFloat(respuesta[i]['pago_tarjeta_dos']));
              }
              /********************************************/
              //Sumar los valores para cada variable
              subtotal += (parseInt(respuesta[i].precio_producto)) - (parseInt(respuesta[i].precio_producto) * 0.19);
              ivatotal += (parseInt(respuesta[i].precio_producto) * 0.19);
              precioTotal += parseInt(respuesta[i].precio_producto);
              /*******************************************/
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
              // 11 = Nombre de la categoria
              // 12 = id de la categoria
              // 13 = id de la subcategoria.
              // 14 = precio costo (al que se compro para la venta).
              // 15 = Configuraciones de productos.
              // 16 = Aplicar iva.
              // 17 = Tipo de factura (mayor o detal).
              // 18 = clasificaciond e productos para facturas.
              // 19 = botonera de opciones
              var fila = '<tr class="dato"><td> ' + respuesta[i]['productos_separados']["titulo"] +
                '</td><td>' + respuesta[i]['productos_separados']["codigo"] +
                '</td><td style="display: none">' + respuesta[i]['precio_detal'] +
                '</td><td style="display: none">' + respuesta[i]['precio_mayorista'] +
                '</td><td style="display: none">' + $('#iva_caja').val() +
                '</td><td>' + respuesta[i]['precio_producto'] +
                '</td><td>' + 0 +
                '</td><td>' + 1 +
                '</td><td >' + respuesta[i]['precio_producto'] +
                '</td><td style="display: none">' + 0 +
                '</td><td style="display: none">' + respuesta[i]["id"] +
                '</td><td style="display: none">' + 'categoria' +
                '</td><td style="display: none">' + respuesta[i]['productos_separados']['id_categoria'] +
                '</td><td style="display: none">' + respuesta[i]['productos_separados']['id_subcategoria'] +
                '</td><td style="display: none">' + respuesta[i]['productos_separados']['precio_costo'] +
                '</td><td style="display: none">' + respuesta[i]['configuracion'] +
                '</td><td style="display: none">' + respuesta[i]['aplicar_iva'] +
                '</td><td style="display: none">' + 1 +
                '</td><td style="display: none">' + 5 +
                '</td><td><button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button></td></tr>';
              //  console.log(fila);
              var conteo = $('#encabezado tr:last');
              conteo.after(fila);
              suma_productos=i+1;
              //fin agregar producto apartado
              
            }
            // calcular_saldo();

            $('#ind_total_productos').html(suma_productos);
              // $('#ind_total_otros').html(suma_otros);

            $('#abono').val(parseFloat(saldo_efectivo) + parseFloat(saldo_tarjeta_uno) + parseFloat(saldo_tarjeta_dos));

            $('#saldo_abono').css({
              "display": "block",
            });

            /**************** IMPRIMIR VALORES EN LA VISTA ****************/
            $("#subtotal").text(new Intl.NumberFormat().format(subtotal));
            $("#iva").text(new Intl.NumberFormat().format(ivatotal));
            $("#precioTotal").text(new Intl.NumberFormat().format(precioTotal));
            /**************************************************************/

            /*** CODIGO PARA CALCULAR PAGO CON TARJETA CUANDO
             *   EL PAGO TRAE ABONO
             **************************************************/
            var valor_abono_puntos = $('#abono').val();
            var precio_total_puntos = $('#precioTotal').html();
            var valor_abono = valor_abono_puntos.split('.').join('');
            var precio_total = precio_total_puntos.split('.').join('');
            var valor_restante = parseFloat(precio_total) - parseFloat(valor_abono);
            $('#caja_tarjeta_dos').val(valor_restante.toLocaleString());
            /****************+ FIN *************************** */
            buscar_saldo_apartado(id_cliente);
            /*************************************************** */
            $('#codigo_producto').prop('disabled', false);
            alertify.success("Has pulsado '" + alertify.labels.ok + "'");
          } else {
            buscar_saldo_devolucion(id_cliente);
            alertify.error("Has pulsado '" + alertify.labels.cancel + "'");
          }
        });
        return false
      } else {
        buscar_saldo_devolucion(id_cliente);
      }


    }//fin del success
  });//fin de ajax

}

/**************************************************** */
/*      FUNCION PARA BUSCAR SALDOS ACUMULADOS         */
/**************************************************** */

function buscar_saldo_devolucion(dato) {
  var id_cliente = dato;

  var url = getAbsolutePath() + 'buscar_saldo_devolucion';

  $.ajax({
    url: url,
    type: 'POST',
    headers: { 'X-CSRF-Token': $('meta[name=_token]').attr('content') },
    data: {
      id_cliente: id_cliente
    },
    dataType: 'json',
    success: function (respuesta) {
      // console.log(respuesta);
      if (respuesta != 0) {
        alertify.confirm("Se encontró $ " + respuesta + " pesos de saldo a favor de este cliente. Pulse <b>ACEPTAR</b> para agregarlos a la factura, de lo contrario pulse <b>CANCELAR</b>.</p>", function (e) {
          if (e) {

            /************************************************************************
         CODIGO PARA AGREGAR EL PRODUCTO CUANDO ACEPTAN SEPARADOS  (ง︡'-'︠)ง
        *************************************************************************/
            var saldo_efectivo = 0;
            var saldo_tarjeta_uno = 0;
            var saldo_tarjeta_dos = 0;

            // calcular_saldo();

            $('#abono').val(respuesta.toLocaleString());
            $('#estado_saldo').val("1");

            $('#saldo_abono').css({
              "display": "block",
            });

            /************************************************ */
            /*** CODIGO PARA CALCULAR PAGO CON TARJETA CUANDO
             *   EL PAGO TRAE ABONO
             **************************************************/
            var valor_abono_puntos = $('#abono').val();
            var precio_total_puntos = $('#precioTotal').html();
            var valor_abono = valor_abono_puntos.split('.').join('');
            var precio_total = precio_total_puntos.split('.').join('');
            var valor_restante = parseFloat(precio_total) - parseFloat(valor_abono);
            $('#caja_tarjeta_dos').val(valor_restante.toLocaleString());

            /****************+ FIN *************************** */
            alertify.success("Has pulsado '" + alertify.labels.ok + "'");
          } else {
            alertify.error("Has pulsado '" + alertify.labels.cancel + "'");
          }
        });
        return false
      }


    }//fin del success
  });//fin de ajax

}

//FUNCION PARA BUSCAR CLIENTE POR SU DOCUMENTO
$("#documento_cliente").keydown(function (e) {
  // var Ndocumento = $("#documento_cliente").val();
  if (e.which == 8) {
    $('#nombre_cliente').val("");
    $('#direccion_cliente').val("");
    $('#telefono_cliente').val("");
  }

  if (e.which == 13) {
    var Ndocumento = $("#documento_cliente").val();
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
        //console.log('respuesta');
        //console.log(respuesta);
        var Nregistros = Object.keys(respuesta).length;
        if (Nregistros == 0) {

          $("#documento").val(Ndocumento);
          $("#modal_cliente").addClass("show");

          $("#modal_cliente").css({
            "display": "block",
            "padding-right": "16px",
            "background": "rgba(0, 0, 0, 0.5)"
          });
        } else {
          var id_cliente = respuesta.id;
          $("#id_cliente").val(respuesta.id);
          $("#nombre_cliente").val(respuesta.nombres + ' ' + respuesta.apellidos);
          $("#direccion_cliente").val(respuesta.direccion);
          $("#telefono_cliente").val(respuesta.telefono);
          $("#datos_cliente").html(respuesta.nombres + ' ' + respuesta.apellidos + '<br/> Nº.' + respuesta.documento + '<br/>' + respuesta.direccion + '<br/>' + respuesta.telefono);
          $('#tipo_cliente').val(respuesta.confiusuarios_clientes.id_tipo_usuario);
          $('#ind_total_puntos').html(respuesta.puntos);

          //habilitar los input para agregar productos a la factura.
          $('#codigo_producto').prop('disabled', false);
          $('#tag_factura').prop('disabled', false);
          $('#vendedor_factura').prop('disabled', false);

          //ENVIA EL ID DEL CLIENTE PARA BUSCAR SI EXISTE ALGUN SEPARADO
          buscar_separado(id_cliente);

        }
      }//fin del success
    });//fin de ajax
    return (e.which != 13);
  }
});


$("#cerrar_cliente").click(function () {
  $("cerrar_cliente").removeClass("show");
  $("#modal_cliente").css({
    "display": "none"
  });
});

// FUNCION ES PARA CREAR UN NUEVO CLIENTE
$("#guardar_cliente_caja").click(function () {

  var documento = $("#documento").val();
  var nombre = $("#nombres").val();
  var apellido = $("#apellidos").val();
  var direccion = $("#direccion").val();
  var telefono = $("#telefono").val();
  var fecha = $('#fecha-nacimiento').val();
  var correo = $("#correo").val()

  
    if($("#correo").val().indexOf('@', 0) == -1 || $("#correo").val().indexOf('.', 0) == -1) {
      alertify.error("El correo no tiene un formato valido.");
        return false;
    }


  else if (!documento || !nombre || !apellido || !direccion || !telefono || !fecha ) {
    alertify.error("Todos los campos son obligatorios.");
    return false;
  } else {

    var url = getAbsolutePath() + 'crearcliente'; //ClientesController

    // FUNCION PARA MENSAJE DE ALERTA AL CREAR CLIENTE
    // function cliente_crear() {
    //   alertify.log("El cliente fue creado con exito.");
    //   return false;
    // }
    $('#guardar_cliente_c').prop('disabled', true);
    $.ajax({
      url: url,
      type: 'GET',
      data: {
        documento: documento,
        nombre: nombre,
        apellido: apellido,
        direccion: direccion,
        telefono: telefono,
        fecha: fecha,
        correo: correo
      },
      dataType: 'json',
      success: function (respuesta) {

        $("#id_cliente").val(respuesta);
      }//fin del success
    });//fin de ajax
    // cliente_crear();
    $("#documento_cliente").val(documento);
    $("#nombre_cliente").val(nombre + ' ' + apellido);
    $("#direccion_cliente").val(direccion);
    $("#telefono_cliente").val(telefono);
    $("#codigo_producto").prop('disabled', false);
    $("#vendedor_factura").prop('disabled', false);


    /********** LLENA LOS DATOS DEL CLIENTE PARA MODAR IMPRIMIR FACTURA **********/
    $("cerrar_cliente").removeClass("show");
    $("#modal_cliente").css({
      "display": "none"
    });
    $('#guardar_cliente_c').prop('disabled', false);
    $('#correo').val("");
    $('#fecha-nacimiento').val("");
    $("#telefono").val("");
    $("#documento").val("");
    $("#nombres").val("");
    $("#apellidos").val("");
    $("#direccion").val("");
  }
});

function buscar_saldo_apartado(dato) {
  /**************************************************** */
  /***** BUSCAR SI HAY SALDO Y AGREGAR AL APARTADO **** */
  /*************************************************** */
  var id_cliente = dato;
  var url = getAbsolutePath() + 'buscar_saldo_devolucion';

  $.ajax({
    url: url,
    type: 'POST',
    headers: { 'X-CSRF-Token': $('meta[name=_token]').attr('content') },
    data: {
      id_cliente: id_cliente
    },
    dataType: 'json',
    success: function (respuesta) {
      if (respuesta != 0) {
        alertify.confirm("Se encontró $ " + respuesta + " pesos de saldo a favor de este cliente. Pulse <b>ACEPTAR</b> para agregarlos a la factura, de lo contrario pulse <b>CANCELAR</b>.</p>", function (e) {
          if (e) {
            
            /************************************************************************
             CODIGO PARA AGREGAR EL PRODUCTO CUANDO ACEPTAN SEPARADOS  (ง︡'-'︠)ง
             *************************************************************************/
            var saldo_efectivo = 0;
            var saldo_tarjeta_uno = 0;
            var saldo_tarjeta_dos = 0;
            
            // calcular_saldo();
            var abono_inicial = $('#abono').val();
            var total_abono = parseFloat(abono_inicial) + parseFloat(respuesta);
            
            $('#abono').val(total_abono.toLocaleString());
            $('#estado_saldo').val("1");

            $('#saldo_abono').css({
              "display": "block",
            });

            /************************************************ */
            /*** CODIGO PARA CALCULAR PAGO CON TARJETA CUANDO
             *   EL PAGO TRAE ABONO
             **************************************************/
            var valor_abono_puntos = $('#abono').val();
            var precio_total_puntos = $('#precioTotal').html();
            var valor_abono = valor_abono_puntos.split('.').join('');
            var precio_total = precio_total_puntos.split('.').join('');
            var valor_restante = parseFloat(precio_total) - parseFloat(valor_abono);
            $('#caja_tarjeta_dos').val(valor_restante.toLocaleString());

            /****************+ FIN *************************** */
            alertify.success("Has pulsado '" + alertify.labels.ok + "'");
          } else {
            alertify.error("Has pulsado '" + alertify.labels.cancel + "'");
          }
        });
        return false
      }


    }//fin del success
  });//fin de ajax
}