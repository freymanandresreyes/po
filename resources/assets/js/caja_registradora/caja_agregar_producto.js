$('#caja_agregar_producto').on('click', function(){

  var validacion_codigo=$('#codigo_producto').val();
  var validacion_precio=$('#caja_precio').val();

  if (validacion_codigo == "" || validacion_precio == "") {
    return false;
  }
  
  var fila = '<tr class="dato"><td> ' + $('#caja_titulo').val() +
  '</td><td>' + $('#codigo_producto').val() +
  '</td><td style="display: none">' + $('#caja_precio_detal').val() +
  '</td><td style="display: none">' + $('#caja_precio_mayor').val() +
  '</td><td style="display: none">' + $('#iva_caja').val() +
  '</td><td>' + $('#caja_precio').val() +
  '</td><td>' + $('#caja_descuento').val() +
  '</td><td>' + 1 +
  '</td><td >' + $('#caja_total').val() +
  '</td><td style="display: none">' + $('#caja_descuento_oferta').val() +
  '</td><td style="display: none">' + $('#caja_id_producto').val() +
  '</td><td style="display: none">' + $('#caja_oferta').val() +
  '</td><td style="display: none">' + $('#caja_id_categoria').val() +
  '</td><td style="display: none">' + $('#caja_id_subcategoria').val() +
  '</td><td style="display: none">' + $('#caja_precio_costo').val() +
  '</td><td style="display: none">' + $('#caja_configuraciones').val() +
  '</td><td style="display: none">' + $('#caja_aplicar_iva').val() +
  '</td><td style="display: none">' + '1' +
  '</td><td style="display: none">' + '1' +
  '</td><td style="display: none">' + $('#caja_clasificacion_producto').val() +
  '</td><td><button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button></td></tr>';
 
  var conteo = $('#encabezado tr:last');
  conteo.after(fila);
  precio_iva = null;
  precio_total = null;
  porsentaje = null;
  clasificacion = null;
  $("#producto").val("");
  $("#codigo_producto").val("");
  cod_product = "";
  //CALCULAR SALDO
  calcular_precios();
  calcular_saldo();

  $('#caja_titulo').val("");
  $('#caja_precio').val("");
  $('#caja_descuento').val("");
  $('#caja_total').val("");
  $('#caja_precio_sin_iva').val("");
  $('#caja_iva').val("");
  $('#caja_porsentaje').val("");
  $('#caja_cantidad').val("");
  $('#caja_descuento_oferta').val("");
  $('#caja_id_producto').val("");
  $('#caja_oferta').val("");
  $('#caja_id_categoria').val("");
  $('#caja_id_subcategoria').val("");
  $('#caja_precio_costo').val("");
  $('#caja_configuraciones').val("");
  $('#caja_aplicar_iva').val("");
  $('#caja_tipo_factura').val("");
  $('#caja_clasificacion_producto').val("");
  $("#codigo_producto").prop('disabled',false);
});