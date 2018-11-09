/*** CALCULO PRIMER PAGO ** */
$('#saldo_valor').keyup(function () {
    var tipo = $("input[name='tipopago']:checked").val();
    var precio_total_puntos = $('#precioTotal').html();
    var valor_abono_puntos = $('#abono').val();
    var saldo_valor_uno_puntos = $('#saldo_valor').val();
    var saldo_valor_dos_puntos = $('#saldo_valor_dos').val();
    var sistecredito_puntos = $('#valor_sistecredito').val();

    var precio_total = precio_total_puntos.split('.').join('');
    var valor_abono = valor_abono_puntos.split('.').join('');
    var saldo_valor_uno = saldo_valor_uno_puntos.split('.').join('');
    var saldo_valor_dos = saldo_valor_dos_puntos.split('.').join('');
    var sistecredito = sistecredito_puntos.split('.').join('');


    if (tipo == 4) {
        if (valor_abono.length != 0) {
            var suma_valores = parseFloat(saldo_valor_uno) + parseFloat(saldo_valor_dos);
            var saldo_restante = parseFloat(precio_total) - parseFloat(valor_abono);
    
            var resta = parseFloat(saldo_restante) - parseFloat(saldo_valor_uno);
    
            $('#saldo_valor_dos').val(resta.toLocaleString());
            if (parseFloat(saldo_valor_uno) > parseFloat(saldo_restante)) {
                $('#vender_producto').prop('disabled', true);
                alertify.error("El valor ingresado supera el exedente.");
            } else {
                $('#vender_producto').prop('disabled', false);
            }
    
        } else {
    
            var suma_valores = parseFloat(saldo_valor_uno) + parseFloat(saldo_valor_dos);
            var saldo_restante = parseFloat(precio_total) - parseFloat(saldo_valor_uno);
            var resta = parseFloat(saldo_restante) - parseFloat(saldo_valor_uno);
    
            $('#saldo_valor_dos').val(saldo_restante.toLocaleString());
    
            if (parseFloat(saldo_valor_uno) > parseFloat(precio_total)) {
                $('#vender_producto').prop('disabled', true);
                alertify.error("El valor ingresado supera el exedente.");
            } else {
                $('#vender_producto').prop('disabled', false);
            }
    
        }
        
    }

    if (tipo == 10) {
        if (valor_abono.length != 0) {
            var suma_valores = parseFloat(saldo_valor_uno) + parseFloat(saldo_valor_dos);
            var saldo_restante = parseFloat(precio_total) - (parseFloat(valor_abono)+parseFloat(sistecredito));
    
            var resta = parseFloat(saldo_restante) - parseFloat(saldo_valor_uno);
    
            if (parseFloat(saldo_valor_uno) > parseFloat(saldo_restante)) {
                $('#vender_producto').prop('disabled', true);
                alertify.error("El valor ingresado supera el exedente.");
            } else {
                $('#saldo_valor_dos').val(resta.toLocaleString());
                $('#vender_producto').prop('disabled', false);
            }
    
        } else {

            var saldo_restante = parseFloat(precio_total) - parseFloat(sistecredito);
            var resta = parseFloat(saldo_restante) - parseFloat(saldo_valor_uno);
    
            $('#saldo_valor_dos').val(resta.toLocaleString());
    
            if (parseFloat(saldo_valor_uno) > parseFloat(precio_total)) {
                $('#vender_producto').prop('disabled', true);
                alertify.error("El valor ingresado supera el exedente.");
            } else {
                $('#vender_producto').prop('disabled', false);
            }
    
        }
    }
});
/*** CALCULO PRIMER PAGO ** */
$('#saldo_valor_dos').keyup(function () {
    var tipo = $("input[name='tipopago']:checked").val();
    var precio_total_puntos = $('#precioTotal').html();
    var valor_abono_puntos = $('#abono').val();
    var saldo_valor_uno_puntos = $('#saldo_valor').val();
    var saldo_valor_dos_puntos = $('#saldo_valor_dos').val();
    var sistecredito_puntos = $('#valor_sistecredito').val();

    var precio_total = precio_total_puntos.split('.').join('');
    var valor_abono = valor_abono_puntos.split('.').join('');
    var saldo_valor_uno = saldo_valor_uno_puntos.split('.').join('');
    var saldo_valor_dos = saldo_valor_dos_puntos.split('.').join('');
    var sistecredito = sistecredito_puntos.split('.').join('');

    if (tipo == 4 ) {
        if (valor_abono.length != 0) {
            var suma_valores = parseFloat(saldo_valor_uno) + parseFloat(saldo_valor_dos);
            var saldo_restante = parseFloat(precio_total) - parseFloat(valor_abono);
    
            var resta = parseFloat(saldo_restante) - parseFloat(saldo_valor_dos);
    
            $('#saldo_valor').val(resta.toLocaleString());
    
            if (parseFloat(saldo_valor_dos) > parseFloat(saldo_restante)) {
                $('#vender_producto').prop('disabled', true);
                alertify.error("El valor ingresado supera el exedente.");
            } else {
                $('#vender_producto').prop('disabled', false);
            }
    
        } else {
            var saldo_restante = parseFloat(precio_total) - parseFloat(saldo_valor_dos);
    
            $('#saldo_valor').val(saldo_restante.toLocaleString());
    
            if (parseFloat(saldo_valor_dos) > parseFloat(precio_total)) {
                $('#vender_producto').prop('disabled', true);
                alertify.error("El valor ingresado supera el exedente.");
            } else {
                $('#vender_producto').prop('disabled', false);
            }
    
        }
        
    }

    if (tipo == 10) {
        if (valor_abono.length != 0) {
            var suma_valores = parseFloat(saldo_valor_uno) + parseFloat(saldo_valor_dos);
            var saldo_restante = parseFloat(precio_total) - parseFloat(valor_abono);
    
            var resta = parseFloat(saldo_restante) - parseFloat(saldo_valor_dos);
    
            $('#saldo_valor').val(resta.toLocaleString());
    
            if (parseFloat(saldo_valor_dos) > parseFloat(saldo_restante)) {
                $('#vender_producto').prop('disabled', true);
                alertify.error("El valor ingresado supera el exedente.");
            } else {
                $('#vender_producto').prop('disabled', false);
            }
    
        } else {
            var saldo_restante = parseFloat(precio_total) - parseFloat(sistecredito);
            var resta = parseFloat(saldo_restante) - parseFloat(saldo_valor_dos);
    
            $('#saldo_valor').val(resta.toLocaleString());
    
            if (parseFloat(saldo_valor_dos) > parseFloat(precio_total)) {
                $('#vender_producto').prop('disabled', true);
                alertify.error("El valor ingresado supera el exedente.");
            } else {
                $('#vender_producto').prop('disabled', false);
            }
    
        }
    }
});