/**EL CODIGO DE ESTA SECCION SE ENCIENTRA EN BUSCAR CLIENTE Y TIPOS DE PAGO Y FUNCION CALCULAR SALDO */
//********************************************************** */
$('#valor_sistecredito').keyup(function(){
    var tipo = $("input[name='tipopago']:checked").val();
    var precio_total_puntos = $('#precioTotal').html();
    var sistecredito_puntos = $('#valor_sistecredito').val();
    var valor_abono_puntos = $('#abono').val();
    
    var precio_total = precio_total_puntos.split('.').join('');
    var sistecredito = sistecredito_puntos.split('.').join('');
    var valor_abono = valor_abono_puntos.split('.').join('');

    if(tipo == 7){
        if (valor_abono.length != 0) {
            $("#saldo_abono").css({
                "display": "block",
            });
            //  alert('con abono');
            var precio_total_puntos = $('#precioTotal').html();
            var precio_total = precio_total_puntos.split('.').join('');
            var restante = parseFloat(precio_total)-(parseFloat(sistecredito)+parseFloat(valor_abono));
            $('#caja_efectivo_efectivo').val(restante.toLocaleString());

        } else {
            var restante = parseFloat(precio_total) - parseFloat(sistecredito);
            if(parseFloat(sistecredito) > parseFloat(precio_total)){
                alertify.error("El valor con sistecredito supera el valor de la venta.");
                return false;
               }
               $('#caja_efectivo_efectivo').val(restante.toLocaleString());
        }

        }
    if(tipo == 8){

        if (valor_abono.length != 0) {
            $("#saldo_abono").css({
                "display": "block",
            });
            //  alert('con abono');
            var precio_total_puntos = $('#precioTotal').html();
            var precio_total = precio_total_puntos.split('.').join('');
            var restante = parseFloat(precio_total)-(parseFloat(sistecredito)+parseFloat(valor_abono));
            $('#caja_tarjeta_dos').val(restante.toLocaleString());

        } else {
            var restante = parseFloat(precio_total) - parseFloat(sistecredito);
            if(parseFloat(sistecredito) > parseFloat(precio_total)){
                alertify.error("El valor con sistecredito supera el valor de la venta.");
                return false;
               }
               $('#caja_efectivo_efectivo').val(restante.toLocaleString());
        }
    }
    /*************************************************** */
    /********** PAGOS MIXTOS CON SISTECREDITO ********** */
    /*************************************************** */
    if (tipo == 9) {
        var restante = parseFloat(precio_total) - parseFloat(sistecredito);

        $('#caja_tarjeta').val((restante/2).toLocaleString());
        $('#caja_efectivo').val((restante/2).toLocaleString());

        if (valor_abono.length != 0) {
            $("#saldo_abono").css({
                "display": "block",
            });
            //  alert('con abono');
            var precio_total_puntos = $('#precioTotal').html();
            var precio_total = precio_total_puntos.split('.').join('');
            var restante = parseFloat(precio_total)-(parseFloat(sistecredito)+parseFloat(valor_abono));
            
            $('#caja_tarjeta').val((restante/2).toLocaleString());
            $('#caja_efectivo').val((restante/2).toLocaleString());

        } else {
            var restante = parseFloat(precio_total) - parseFloat(sistecredito);
            if(parseFloat(sistecredito) > parseFloat(precio_total)){
                alertify.error("El valor con sistecredito supera el valor de la venta.");
                return false;
            }
            $('#caja_tarjeta').val((restante/2).toLocaleString());
            $('#caja_efectivo').val((restante/2).toLocaleString());
        }
    }
    if (tipo == 10) {
        // var restante = parseFloat(precio_total) - parseFloat(sistecredito);

        // $('#saldo_valor').val((restante/2).toLocaleString());
        // $('#saldo_valor_dos').val((restante/2).toLocaleString());

        /********** */
        // var restante = parseFloat(precio_total) - parseFloat(sistecredito);

        

        if (valor_abono.length != 0) {
            $("#saldo_abono").css({
                "display": "block",
            });
            //  alert('con abono');
            var precio_total_puntos = $('#precioTotal').html();
            var precio_total = precio_total_puntos.split('.').join('');
            var restante = parseFloat(precio_total)-(parseFloat(sistecredito)+parseFloat(valor_abono));
            
            $('#saldo_valor').val((restante/2).toLocaleString());
            $('#saldo_valor_dos').val((restante/2).toLocaleString());

        } else {
            var restante = parseFloat(precio_total) - parseFloat(sistecredito);
            if(parseFloat(sistecredito) > parseFloat(precio_total)){
                alertify.error("El valor con sistecredito supera el valor de la venta.");
                return false;
            }
            $('#saldo_valor').val((restante/2).toLocaleString());
            $('#saldo_valor_dos').val((restante/2).toLocaleString());
        }
    }
    
});