
$('#caja_efectivo').keyup(function () {
    
    var valor_abono_puntos = $('#abono').val();
    var precio_total_puntos = $('#precioTotal').html();
    var valor_ingresado_puntos = $('#caja_efectivo_efectivo').val();
    var valor_efectivo_puntos = $('#caja_efectivo').val();
    var valor_tarjeta_puntos = $('#caja_tarjeta').val();
    var tipo = $("input[name='tipopago']:checked").val();
    var sistecredito_puntos = $('#valor_sistecredito').val();
    var valor_abono = valor_abono_puntos.split('.').join('');
    var precio_total = precio_total_puntos.split('.').join('');
    var valor_ingresado = valor_ingresado_puntos.split('.').join('');
    var sistecredito = sistecredito_puntos.split('.').join('');
    var valor_tarjeta = valor_tarjeta_puntos.split('.').join('');
    var valor_efectivo = valor_efectivo_puntos.split('.').join('');
    
    if (tipo == 20) {
        
        if(valor_abono.length != 0){
            
            var valor_restante = parseFloat(precio_total) - parseFloat(valor_abono);
            var valor =  valor_restante - parseFloat(valor_ingresado);
            $('#caja_tarjeta').val(valor.toLocaleString());
            
            if (parseFloat(valor_ingresado) > parseFloat(valor_restante)) {
                $('#vender_producto').prop('disabled', true);
                alertify.error("El valor ingresado supera el exedente.");
            } else {
                $('#vender_producto').prop('disabled', false);
            }
            
        }else{
            
            var valor_restante = parseFloat(precio_total);
            var valor =  valor_restante - parseFloat(valor_ingresado);
            $('#caja_tarjeta').val(valor.toLocaleString());
            
            if (parseFloat(valor_ingresado) > parseFloat(valor_restante)) {
                $('#vender_producto').prop('disabled', true);
                alertify.error("El valor ingresado supera el exedente.");
            } else {
                $('#vender_producto').prop('disabled', false);
            }
            
        }
    }

    if (tipo == 9) {
        if(valor_abono.length != 0){
           if(tipo_pago == 1){
               var valor_restante = parseFloat(precio_total) - parseFloat(valor_abono);
               var valor =   parseFloat(valor_ingresado) - valor_restante ;
               $('#caja_cambio').val(valor.toLocaleString());
           }
        }else{
            var valor_restante = parseFloat(precio_total)-(parseFloat(sistecredito) + parseFloat(valor_tarjeta));
            var valor =   parseFloat(valor_efectivo) - valor_restante;
            $('#caja_cambio').val(valor.toLocaleString());
    
            if(tipo_pago == 7){
                var valor_restante = parseFloat(precio_total) - parseFloat(saldo_sistecredito);
                var valor =   parseFloat(valor_ingresado) - valor_restante ;
                $('#caja_cambio').val(valor.toLocaleString());
            }
        }
        
    }
});



$('#caja_tarjeta').keyup(function () {
    var tipo = $("input[name='tipopago']:checked").val();
    var valor_abono_puntos = $('#abono').val();
    var precio_total_puntos = $('#precioTotal').html();
    var valor_ingresado_puntos = $('#caja_tarjeta').val();
    var sistecredito_puntos = $('#valor_sistecredito').val();
    var valor_tarjeta_uno_puntos = $('#caja_tarjeta').val();
    
    var valor_abono = valor_abono_puntos.split('.').join('');
    var precio_total = precio_total_puntos.split('.').join('');
    var valor_ingresado = valor_ingresado_puntos.split('.').join('');
    var sistecredito = sistecredito_puntos.split('.').join('');
    var valor_tarjeta_uno = valor_tarjeta_uno_puntos.split('.').join('');

    if (tipo == 3) {
        if(valor_abono.length != 0){
            var valor_restante = parseFloat(precio_total) - parseFloat(valor_abono);
            var valor =  valor_restante - parseFloat(valor_ingresado);
            $('#caja_efectivo').val(valor.toLocaleString());
    
            if (parseFloat(valor_ingresado) > parseFloat(valor_restante)) {
                $('#vender_producto').prop('disabled', true);
                alertify.error("El valor ingresado supera el exedente.");
            } else {
                $('#vender_producto').prop('disabled', false);
            }
    
        }else{
            var valor_restante = parseFloat(precio_total);
      
            var valor =  valor_restante - parseFloat(valor_ingresado);
            $('#caja_efectivo').val(valor.toLocaleString());
    
            if (parseFloat(valor_ingresado) > parseFloat(valor_restante)) {
                $('#vender_producto').prop('disabled', true);
                alertify.error("El valor ingresado supera el exedente.");
            } else {
                $('#vender_producto').prop('disabled', false);
            }
    
        }
        
    }
    /************************************************ */
    /******** PAGOS MIXTOS CON SITECREDITO ********** */
    /************************************************ */
    if(tipo == 9){
        // alert('sistecredito');
        // var restante = parseFloat(precio_total)-parseFloat(sistecredito)-parseFloat(valor_tarjeta_uno);
        // $('#caja_efectivo').val(restante.toLocaleString());

        if(valor_abono.length != 0){
            // alert('ok');
            var valor_restante = parseFloat(precio_total) - (parseFloat(valor_abono) + parseFloat(sistecredito));
            var valor =  valor_restante - parseFloat(valor_ingresado);
            $('#caja_efectivo').val(valor.toLocaleString());
    
            if (parseFloat(valor_ingresado) > parseFloat(valor_restante)) {
                $('#vender_producto').prop('disabled', true);
                alertify.error("El valor ingresado supera el exedente.");
            } else {
                $('#vender_producto').prop('disabled', false);
            }
    
        }else{
    
            if (parseFloat(valor_ingresado) > parseFloat(valor_restante)) {
                $('#vender_producto').prop('disabled', true);
                alertify.error("El valor ingresado supera el exedente.");
            } else {
                // alert('aqui');
                var restante = parseFloat(precio_total)-parseFloat(sistecredito);
                var restante_efectivo = restante-parseFloat(valor_ingresado);
                $('#caja_efectivo').val(restante_efectivo.toLocaleString());
                $('#vender_producto').prop('disabled', false);
            }
    
        }
    }

});
/********************************************** */
// funcion para pagos con sitecredito y tarjeta
//********************************************* */
$('#caja_tarjeta_dos').keyup(function(){
    var valor_abono_puntos = $('#abono').val();
    var precio_total_puntos = $('#precioTotal').html();
    var valor_ingresado_puntos = $('#caja_tarjeta_dos').val();
    
    var valor_abono = valor_abono_puntos.split('.').join('');
    var precio_total = precio_total_puntos.split('.').join('');
    var valor_ingresado = valor_ingresado_puntos.split('.').join('');

    if(valor_abono.length != 0){
        var valor_restante = parseFloat(precio_total) - parseFloat(valor_abono);
        var valor =  valor_restante - parseFloat(valor_ingresado);
        $('#caja_efectivo').val(valor.toLocaleString());

        if (parseFloat(valor_ingresado) > parseFloat(valor_restante)) {
            $('#vender_producto').prop('disabled', true);
            alertify.error("El valor ingresado supera el exedente.");
        } else {
            $('#vender_producto').prop('disabled', false);
        }

    }else{
        var valor_restante = parseFloat(precio_total)- parseFloat(valor_ingresado);
        
        $('#valor_sistecredito').val(valor_restante.toLocaleString());

        if (parseFloat(valor_ingresado) > parseFloat(valor_restante)) {
            $('#vender_producto').prop('disabled', true);
            alertify.error("El valor ingresado supera el exedente.");
        } else {
            $('#vender_producto').prop('disabled', false);
        }

    }
});