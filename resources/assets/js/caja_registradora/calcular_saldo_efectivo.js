$('#caja_efectivo_efectivo').keyup(function () {
    var valor_abono_puntos = $('#abono').val();
    var precio_total_puntos = $('#precioTotal').html();
    var valor_ingresado_puntos = $('#caja_efectivo_efectivo').val();
    var tipo_pago = $("input[name='tipopago']:checked").val();
    var saldo_sistecredito_puntos = $('#valor_sistecredito').val();
    var valor_abono = valor_abono_puntos.split('.').join('');
    var precio_total = precio_total_puntos.split('.').join('');
    var valor_ingresado = valor_ingresado_puntos.split('.').join('');
    var saldo_sistecredito = saldo_sistecredito_puntos.split('.').join('');

    if(valor_abono.length != 0){
       if(tipo_pago == 1){
           var valor_restante = parseFloat(precio_total) - parseFloat(valor_abono);
           var valor =   parseFloat(valor_ingresado) - valor_restante ;
           $('#caja_cambio').val(valor.toLocaleString());
       }
       if(tipo_pago == 7){
           var valor_restante = parseFloat(precio_total) - (parseFloat(valor_abono)+ parseFloat(saldo_sistecredito));
           var valor =   parseFloat(valor_ingresado) - valor_restante ;
           $('#caja_cambio').val(valor.toLocaleString());
       }
    }else{
        var valor_restante = parseFloat(precio_total);
        var valor =   parseFloat(valor_ingresado) - valor_restante;
        $('#caja_cambio').val(valor.toLocaleString());

        if(tipo_pago == 7){
            var valor_restante = parseFloat(precio_total) - parseFloat(saldo_sistecredito);
            var valor =   parseFloat(valor_ingresado) - valor_restante ;
            $('#caja_cambio').val(valor.toLocaleString());
        }
    }
});

    
