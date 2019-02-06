//FUNCION ES PARA CALCULAR EL SALDO AL ELIMINAR 
// UN PRODUCTO DE LA LISTA
function calcular_saldo() {
  /************************************************************************
  ********** CCODIGO PARA SALDOS  ᕙ(`▿´)ᕗ  *******
  *************************************************************************/
  var iva_tienda = $('#iva_caja').val();
  var suma = 0;
  $('#encabezado tr.dato').each(function () { //filas con clase 'dato', especifica una clase, asi no tomas el nombre de las columnas
    suma += parseInt($(this).find('td').eq(8).text() || 0, 10); //numero de la celda 6
  });
  var precioBase = (parseFloat(suma)/1.19).toFixed(2);
  // alert(precioBase);
  var precioIva = Math.round(((precioBase)*19)/100);
  // alert((precioBase));
  // alert((precioIva));
  var subTotal = parseFloat(suma) - parseFloat(precioIva);
  var precio_total =(parseFloat(subTotal) + parseFloat(precioIva));
  // console.log('precio total:' + precio_total);

  $("#caja_transacciones").val(precio_total.toLocaleString());

  $("#subtotal").html(subTotal.toLocaleString());
  $("#iva").html(precioIva.toLocaleString());
  $("#precioTotal").html(precio_total.toLocaleString());
  /*VARIABLES PARA EL MODAL IMPRIMIR FACTURA*/
  $("#subtotal1").html(subTotal.toLocaleString());
  $("#iva1").html(precioIva.toLocaleString());
  $("#precioTotal1").html(precio_total.toLocaleString());

  /************************************************ */
  /*** CODIGO PARA CALCULAR PAGO CON TARJETA  *****
   **************************************************/
  var tipo = $("input[name='tipopago']:checked").val();
  var precio_total_puntos = $('#precioTotal').html();
  var saldo_abono_puntos = $('#abono').val();
  var precio_total = precio_total_puntos.split('.').join('');
  var saldo_abono = saldo_abono_puntos.split('.').join('');
  
  if (tipo == 2) {
    $('#caja_tarjeta_dos').val(precio_total_puntos); 
  }

  /*********  CALCULO DE SALDO N 6 PAGO SISTECREDITO ******* */
  if (tipo == 6) {
    var restante = parseFloat(precio_total) - parseFloat(saldo_abono);
    $('#valor_sistecredito').val(restante.toLocaleString()); 
  }

  /****************+ FIN *************************** */
};
  // ****** fin funcion calcular saldo ************