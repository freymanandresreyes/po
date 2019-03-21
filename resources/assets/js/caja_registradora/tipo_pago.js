//************************************************************
//*********** CAJA_REGISTRADORA/TIPO_PAGO*************
//***********************************************************
$('#tipo_pago').on('click', function () {
    var tipo = $("input[name='tipopago']:checked").val();

    if (tipo == 1) {
        $("#documento_cliente").prop('disabled',false);
        $("#input_efectivo").css({
            "display": "block",
        });
        $("#input_cambio").css({
            "display": "block",
        });
        $("#input_tarjeta").css({
            "display": "none",
        });

        $("#input_transaccion").css({
            "display": "none",
        });
        
        $("#tipo_pago_select").css({
            "display": "none",
        });
        $("#franquicias").css({
            "display": "none",
        });
        $("#input_tarjeta_dos").css({
            "display": "none",
        });
        $("#input_efectivo").css({
            "display": "none",
        });
        $("#input_efectivo_efectivo").css({
            "display": "block",
        });

        $("#input_credito").css({
            "display": "none",
        });

        $("#saldo_abono").css({
            "display": "none",
        });
        $("#numero_factura").css({
            "display": "none",
        });
        $("#numero_factura").val('');

        $("#tipo_pago_select_dos").css({
            "display": "none",
        });
        $("#franquicias_dos").css({
            "display": "none",
        });
        $("#valor_dos").css({
            "display": "none",
        });
        $("#valor_uno").css({
            "display": "none",
        });
        // input saldo sistecredito
        $("#saldo_sistecredito").css({
            "display": "none",
        });

    }

    if (tipo == 2) {
        $("#documento_cliente").prop('disabled',false);
        $('#id_tipo_pago').val('');
        $('#lista_bancos').val('');
        $("#input_efectivo").css({
            "display": "none",
        });
        $("#input_cambio").css({
            "display": "none",
        });
        $("#input_tarjeta").css({
            "display": "none",
        });
        $("#tipo_pago_select").css({
            "display": "block",
        });
        $("#franquicias").css({
            "display": "block",
        });
        $("#input_tarjeta_dos").css({
            "display": "block",
        });

        $("#input_transaccion").css({
            "display": "none",
        });

        $("#input_efectivo_efectivo").css({
            "display": "none",
        });
        $("#saldo_abono").css({
            "display": "none",
        });
        $("#numero_factura").css({
            "display": "none",
        });

        $("#input_credito").css({
            "display": "none",
        });

        $("#valor_uno").css({
            "display": "none",
        });
        $("#valor_dos").css({
            "display": "none",
        });
        $("#franquicias_dos").css({
            "display": "none",
        });
        $("#tipo_pago_select_dos").css({
            "display": "none",
        });
        $("#numero_factura").val('');

        // input saldo sistecredito
        $("#saldo_sistecredito").css({
            "display": "none",
        });

        /************************************************ */
        /*** CODIGO PARA CALCULAR PAGO CON TARJETA CUANDO
         *   EL PAGO VIENE CON ABONO
         **************************************************/
        var valor_abono_puntos = $('#abono').val();
        var valor_abono = valor_abono_puntos.split('.').join('');
        if (valor_abono.length != 0) {
            $("#saldo_abono").css({
                "display": "block",
            });
            // alert('con abono');
            var precio_total_puntos = $('#precioTotal').html();
            var precio_total = precio_total_puntos.split('.').join('');
            var valor = parseFloat(precio_total)-parseFloat(valor_abono);
            $('#caja_tarjeta_dos').val(valor.toLocaleString());

        } else {

            var precio_total_puntos = $('#precioTotal').html();
            
            $('#caja_tarjeta_dos').val(precio_total_puntos);
        }

        /****************+ FIN *************************** */
    }

    if (tipo == 3) {
        $("#documento_cliente").prop('disabled',false);
        $('#id_tipo_pago').val('');
        $('#lista_bancos').val('');
        $("#input_efectivo").css({
            "display": "block",
        });

        $("#input_tarjeta").css({
            "display": "block",
        });

        $("#input_cambio").css({
            "display": "none",
        });

        $("#tipo_pago_select").css({
            "display": "block",
        });
        $("#franquicias").css({
            "display": "block",
        });

        $("#tipo_pago_select_dos").css({
            "display": "none",
        });
        $("#franquicias_dos").css({
            "display": "none",
        });
        $("#valor_dos").css({
            "display": "none",
        });
        $("#input_tarjeta_dos").css({
            "display": "none",
        });
        $("#input_efectivo_efectivo").css({
            "display": "none",
        });
        $("#saldo_abono").css({
            "display": "none",
        });
        $("#numero_factura").css({
            "display": "none",
        });

        $("#input_credito").css({
            "display": "none",
        });

        $("#input_transaccion").css({
            "display": "none",
        });

        $("#numero_factura").val('');
        $("#valor_uno").css({
            "display": "none",
        });

        // input saldo sistecredito
        $("#saldo_sistecredito").css({
            "display": "none",
        });

        $('#caja_tarjeta').prop('disabled', false);

        /************************************************ */
        /*** CODIGO PARA CALCULAR PAGO CON TARJETA CUANDO
         *   EL PAGO VIENE CON ABONO
         **************************************************/
        var valor_abono_puntos = $('#abono').val();
        var valor_abono = valor_abono_puntos.split('.').join('');
        if (valor_abono.length != 0) {
            $("#saldo_abono").css({
                "display": "block",
            });
            //  alert('con abono');
            var precio_total_puntos = $('#precioTotal').html();
            var precio_total = precio_total_puntos.split('.').join('');
            var valor = parseFloat(precio_total)-parseFloat(valor_abono);
            $('#caja_tarjeta_dos').val(valor.toLocaleString());

        } else {

            var precio_total_puntos = $('#precioTotal').html();
            
            $('#caja_tarjeta_dos').val(precio_total_puntos);
        }

        /****************+ FIN *************************** */
    }
    if (tipo == 4) {
        $("#documento_cliente").prop('disabled',false);
        $('#id_tipo_pago').val('');
        $('#lista_bancos').val('');
        $("#input_efectivo").css({
            "display": "block",
        });

        $("#input_tarjeta").css({
            "display": "block",
        });

        $("#input_cambio").css({
            "display": "none",
        });

        $("#tipo_pago_select").css({
            "display": "block",
        });
        $("#franquicias").css({
            "display": "block",
        });
        $("#valor_uno").css({
            "display": "block",
        });
        $("#tipo_pago_select_dos").css({
            "display": "block",
        });
        $("#franquicias_dos").css({
            "display": "block",
        });
        $("#valor_dos").css({
            "display": "block",
        });
        $("#input_efectivo").css({
            "display": "none",
        });
        $("#input_tarjeta").css({
            "display": "none",
        });
        $("#input_tarjeta_dos").css({
            "display": "none",
        });
        $("#input_efectivo_efectivo").css({
            "display": "none",
        });

        $("#input_transaccion").css({
            "display": "none",
        });

        $("#input_credito").css({
            "display": "none",
        });

        $("#saldo_abono").css({
            "display": "none",
        });
        $("#numero_factura").css({
            "display": "none",
        });
        // input saldo sistecredito
        $("#saldo_sistecredito").css({
            "display": "none",
        });
        $("#numero_factura").val('');

        $('#caja_tarjeta').prop('disabled', false);

        /************************************************ */
        /*** CODIGO PARA CALCULAR PAGO CON TARJETA CUANDO
         *   EL PAGO VIENE CON ABONO
         **************************************************/
        var valor_abono_puntos = $('#abono').val();
        var valor_abono = valor_abono_puntos.split('.').join('');
        if (valor_abono.length != 0) {
            $("#saldo_abono").css({
                "display": "block",
            });
            //  alert('con abono');
            var precio_total_puntos = $('#precioTotal').html();
            var precio_total = precio_total_puntos.split('.').join('');
            var valor = parseFloat(precio_total)-parseFloat(valor_abono);
            $('#caja_tarjeta_dos').val(valor.toLocaleString());

        } else {

            var precio_total_puntos = $('#precioTotal').html();
            
            $('#caja_tarjeta_dos').val(precio_total_puntos);
        }

        /****************+ FIN *************************** */
    }
    if (tipo == 5) {
        $('#id_tipo_pago').val('');
        $('#lista_bancos').val('');
        $("#numero_factura").css({
            "display": "block",
        });

        $("#documento_cliente").prop('disabled',true);
        $("#documento_cliente").val('');
        $("#nombre_cliente").val('');
        $("#direccion_cliente").val('');
        $("#telefono_cliente").val('');
        $("#id_cliente").val('');
        $("#abono").val('');
        $("#input_tarjeta").css({
            "display": "none",
        });

        $("#input_cambio").css({
            "display": "none",
        });

        $("#tipo_pago_select").css({
            "display": "none",
        });
        $("#franquicias").css({
            "display": "none",
        });
        $("#valor_uno").css({
            "display": "none",
        });
        $("#input_credito").css({
            "display": "none",
        });

        $("#input_transaccion").css({
            "display": "none",
        });

        $("#tipo_pago_select_dos").css({
            "display": "none",
        });
        $("#franquicias_dos").css({
            "display": "none",
        });
        $("#valor_dos").css({
            "display": "none",
        });
        $("#input_efectivo").css({
            "display": "none",
        });
        $("#input_tarjeta").css({
            "display": "none",
        });
        $("#input_tarjeta_dos").css({
            "display": "none",
        });
        $("#input_efectivo_efectivo").css({
            "display": "none",
        });
        $("#saldo_abono").css({
            "display": "block",
        });
        // input saldo sistecredito
        $("#saldo_sistecredito").css({
            "display": "block",
        });

        // input saldo sistecredito
        $("#saldo_sistecredito").css({
            "display": "none",
        });
        $('#caja_tarjeta').prop('disabled', false);
    }
    if (tipo == 6) {
        // 6. imput de saldo sistecredito
        // id = saldo_sistecredito
        $('#id_tipo_pago').val('');
        $('#lista_bancos').val('');
        $("#numero_factura").css({
            "display": "block",
        });
        $("#saldo_sistecredito").css({
            "display": "block",
        });

        $("#documento_cliente").prop('disabled',true);
        // $("#documento_cliente").val('');
        // $("#nombre_cliente").val('');
        // $("#direccion_cliente").val('');
        // $("#telefono_cliente").val('');
        // $("#id_cliente").val('');
        // $("#abono").val('');
        $("#input_tarjeta").css({
            "display": "none",
        });

        $("#input_cambio").css({
            "display": "none",
        });

        $("#tipo_pago_select").css({
            "display": "none",
        });
        $("#franquicias").css({
            "display": "none",
        });
        $("#valor_uno").css({
            "display": "none",
        });
        $("#tipo_pago_select_dos").css({
            "display": "none",
        });
        $("#franquicias_dos").css({
            "display": "none",
        });
        $("#valor_dos").css({
            "display": "none",
        });
        $("#input_efectivo").css({
            "display": "none",
        });
        $("#input_tarjeta").css({
            "display": "none",
        });
        $("#input_credito").css({
            "display": "none",
        });
        $("#input_tarjeta_dos").css({
            "display": "none",
        });

        $("#input_transaccion").css({
            "display": "none",
        });

        $("#input_efectivo_efectivo").css({
            "display": "none",
        });
        //INPUT SALDO ABONOS
        $("#saldo_abono").css({
            "display": "none",
        });

        $('#caja_tarjeta').prop('disabled', false);

         /************************************************ */
        /*** CODIGO PARA CALCULAR PAGO CON TARJETA CUANDO
         *   EL PAGO VIENE CON ABONO
         **************************************************/
        var valor_abono_puntos = $('#abono').val();
        var valor_abono = valor_abono_puntos.split('.').join('');
        if (valor_abono.length != 0) {
            $("#saldo_abono").css({
                "display": "block",
            });
            //  alert('con abono');
            var precio_total_puntos = $('#precioTotal').html();
            var precio_total = precio_total_puntos.split('.').join('');
            var valor = parseFloat(precio_total)-parseFloat(valor_abono);
            $('#valor_sistecredito').val(valor.toLocaleString());

        } else {

            var precio_total_puntos = $('#precioTotal').html();
            
            $('#caja_tarjeta_dos').val(precio_total_puntos);
        }

        /****************+ FIN *************************** */
    }
    if (tipo == 7) {
        // 7.  sistecredito y efectivo
        // id = saldo_sistecredito
        $('#id_tipo_pago').val('');
        $('#lista_bancos').val('');
        $("#numero_factura").css({
            "display": "none",
        });
        // input saldo sistecredito
        $("#saldo_sistecredito").css({
            "display": "block",
        });

        $("#documento_cliente").prop('disabled',false);
        // $("#documento_cliente").val('');
        // $("#nombre_cliente").val('');
        // $("#direccion_cliente").val('');
        // $("#telefono_cliente").val('');
        // $("#id_cliente").val('');
        // $("#abono").val('');
        $("#input_tarjeta").css({
            "display": "none",
        });
        //INPUT CAMBIO
        $("#input_cambio").css({
            "display": "block",
        });

        $("#tipo_pago_select").css({
            "display": "none",
        });
        $("#franquicias").css({
            "display": "none",
        });
        $("#valor_uno").css({
            "display": "none",
        });
        $("#tipo_pago_select_dos").css({
            "display": "none",
        });
        $("#input_credito").css({
            "display": "none",
        });
        $("#franquicias_dos").css({
            "display": "none",
        });
        $("#valor_dos").css({
            "display": "none",
        });
        $("#input_efectivo").css({
            "display": "none",
        });
        $("#input_tarjeta").css({
            "display": "none",
        });
        $("#input_tarjeta_dos").css({
            "display": "none",
        });

        $("#input_transaccion").css({
            "display": "none",
        });
        //input pagos efectivo
        $("#input_efectivo_efectivo").css({
            "display": "block",
        });
        //INPUT SALDO ABONOS
        var valor_abono_puntos = $('#abono').val();
        var valor_abono = valor_abono_puntos.split('.').join('');
        if (valor_abono > 0) {
            $("#saldo_abono").css({
                "display": "block",
            }); 
        }else{
            $("#saldo_abono").css({
                "display": "none",
            });
        }

        $('#caja_tarjeta').prop('disabled', false);
    }
    if (tipo == 8) {
        // 6. imput pago sistecredito y tarjeta
        // id = saldo_sistecredito
        $('#id_tipo_pago').val('');
        $('#lista_bancos').val('');
        //numero de factura para mayoristas
        $("#numero_factura").css({
            "display": "none",
        });
        // input saldo sistecredito
        $("#saldo_sistecredito").css({
            "display": "block",
        });

        $("#documento_cliente").prop('disabled',false);
        // $("#documento_cliente").val('');
        // $("#nombre_cliente").val('');
        // $("#direccion_cliente").val('');
        // $("#telefono_cliente").val('');
        // $("#id_cliente").val('');
        // $("#abono").val('');
        $("#input_tarjeta").css({
            "display": "none",
        });
        //INPUT CAMBIO
        $("#input_cambio").css({
            "display": "none",
        });
        // seleccionar pago debito o credito 1
        $("#tipo_pago_select").css({
            "display": "block",
        });
        //seleccionar banco o franquicia 1
        $("#franquicias").css({
            "display": "block",
        });
        // valor pagado con tarjeta 1
        $("#input_tarjeta_dos").css({
            "display": "block",
        });
        $('#caja_tarjeta_dos').prop('disabled', false);
        $('#caja_tarjeta').prop('disabled', false);
        $("#valor_uno").css({
            "display": "none",
        });
        $("#input_credito").css({
            "display": "none",
        });
        $("#tipo_pago_select_dos").css({
            "display": "none",
        });
        $("#franquicias_dos").css({
            "display": "none",
        });
        $("#valor_dos").css({
            "display": "none",
        });
        $("#input_efectivo").css({
            "display": "none",
        });
        $("#input_tarjeta").css({
            "display": "none",
        });

        $("#input_transaccion").css({
            "display": "none",
        });
        
        //input pagos efectivo
        $("#input_efectivo_efectivo").css({
            "display": "none",
        });
        //INPUT SALDO ABONOS
        $("#saldo_abono").css({
            "display": "none",
        });
         /************************************************ */
        /*** CODIGO PARA CALCULAR PAGO CON TARJETA CUANDO
         *   EL PAGO VIENE CON ABONO
         **************************************************/
        var valor_abono_puntos = $('#abono').val();
        var valor_abono = valor_abono_puntos.split('.').join('');
        if (valor_abono.length != 0) {
            $("#saldo_abono").css({
                "display": "block",
            });
            // //  alert('con abono');
            // var precio_total_puntos = $('#precioTotal').html();
            // var precio_total = precio_total_puntos.split('.').join('');
            // var valor = parseFloat(precio_total)-parseFloat(valor_abono);
            // $('#valor_sistecredito').val(valor.toLocaleString());
            $('#caja_tarjeta_dos').val('');

        } else {

            // var precio_total_puntos = $('#precioTotal').html();
            
            // $('#caja_tarjeta_dos').val(precio_total_puntos);
        }

        /****************+ FIN *************************** */

    }

    if (tipo == 9) {

        // input saldo sistecredito
        $("#saldo_sistecredito").css({
            "display": "block",
        });

        $("#documento_cliente").prop('disabled',false);
        $('#id_tipo_pago').val('');
        $('#lista_bancos').val('');
        $("#input_efectivo").css({
            "display": "block",
        });

        $("#input_tarjeta").css({
            "display": "block",
        });

        $("#input_cambio").css({
            "display": "display",
        });

        $("#tipo_pago_select").css({
            "display": "block",
        });
        $("#franquicias").css({
            "display": "block",
        });

        $("#tipo_pago_select_dos").css({
            "display": "none",
        });
        $("#input_credito").css({
            "display": "none",
        });
        $("#franquicias_dos").css({
            "display": "none",
        });
        $("#valor_dos").css({
            "display": "none",
        });
        $("#input_tarjeta_dos").css({
            "display": "none",
        });
        $("#input_efectivo_efectivo").css({
            "display": "none",
        });
        $("#saldo_abono").css({
            "display": "none",
        });
        $("#numero_factura").css({
            "display": "none",
        });
        $("#numero_factura").val('');
        $("#valor_uno").css({
            "display": "none",
        });

        $("#input_transaccion").css({
            "display": "none",
        });

        $('#caja_tarjeta').prop('disabled', false);

         /************************************************ */
        /*** CODIGO PARA CALCULAR PAGO CON TARJETA CUANDO
         *   EL PAGO VIENE CON ABONO
         **************************************************/
        var valor_abono_puntos = $('#abono').val();
        var valor_abono = valor_abono_puntos.split('.').join('');
        if (valor_abono.length != 0) {
            $("#saldo_abono").css({
                "display": "block",
            });
            // //  alert('con abono');
            // var precio_total_puntos = $('#precioTotal').html();
            // var precio_total = precio_total_puntos.split('.').join('');
            // var valor = parseFloat(precio_total)-parseFloat(valor_abono);
            // $('#valor_sistecredito').val(valor.toLocaleString());
            $('#caja_tarjeta_dos').val('');

        } else {

            // var precio_total_puntos = $('#precioTotal').html();
            
            // $('#caja_tarjeta_dos').val(precio_total_puntos);
        }

        /****************+ FIN *************************** */
    }

    if (tipo == 10) {

        // input saldo sistecredito
        $("#saldo_sistecredito").css({
            "display": "block",
        });

        $("#documento_cliente").prop('disabled',false);
        $('#id_tipo_pago').val('');
        $('#lista_bancos').val('');
        $("#input_efectivo").css({
            "display": "block",
        });

        $("#input_tarjeta").css({
            "display": "block",
        });

        $("#input_cambio").css({
            "display": "none",
        });

        $("#tipo_pago_select").css({
            "display": "block",
        });
        $("#franquicias").css({
            "display": "block",
        });
        $("#valor_uno").css({
            "display": "block",
        });
        $("#tipo_pago_select_dos").css({
            "display": "block",
        });
        $("#franquicias_dos").css({
            "display": "block",
        });
        $("#valor_dos").css({
            "display": "block",
        });
        $("#input_efectivo").css({
            "display": "none",
        });
        $("#input_tarjeta").css({
            "display": "none",
        });
        $("#input_credito").css({
            "display": "none",
        });
        $("#input_tarjeta_dos").css({
            "display": "none",
        });
        $("#input_efectivo_efectivo").css({
            "display": "none",
        });
        $("#saldo_abono").css({
            "display": "none",
        });
        $("#numero_factura").css({
            "display": "none",
        });

        $("#input_transaccion").css({
            "display": "none",
        });

        $("#numero_factura").val('');

        $('#caja_tarjeta').prop('disabled', false);

        /************************************************ */
        /*** CODIGO PARA CALCULAR PAGO CON TARJETA CUANDO
         *   EL PAGO VIENE CON ABONO
         **************************************************/
        var valor_abono_puntos = $('#abono').val();
        var valor_abono = valor_abono_puntos.split('.').join('');
        if (valor_abono.length != 0) {
            $("#saldo_abono").css({
                "display": "block",
            });
            // //  alert('con abono');
            // var precio_total_puntos = $('#precioTotal').html();
            // var precio_total = precio_total_puntos.split('.').join('');
            // var valor = parseFloat(precio_total)-parseFloat(valor_abono);
            // $('#valor_sistecredito').val(valor.toLocaleString());
            $('#caja_tarjeta_dos').val('');

        } else {

            // var precio_total_puntos = $('#precioTotal').html();
            
            // $('#caja_tarjeta_dos').val(precio_total_puntos);
        }

        /****************+ FIN *************************** */
    }
    if (tipo == 11) {

        // input saldo sistecredito
        $("#saldo_sistecredito").css({
            "display": "none",
        });

        $("#documento_cliente").prop('disabled',false);
        $('#id_tipo_pago').val('');
        $('#lista_bancos').val('');
        $("#input_efectivo").css({
            "display": "none",
        });

        $("#input_tarjeta").css({
            "display": "none",
        });

        $("#input_cambio").css({
            "display": "none",
        });

        $("#tipo_pago_select").css({
            "display": "none",
        });
        $("#franquicias").css({
            "display": "none",
        });
        $("#valor_uno").css({
            "display": "none",
        });
        $("#tipo_pago_select_dos").css({
            "display": "none",
        });
        $("#franquicias_dos").css({
            "display": "none",
        });
        $("#valor_dos").css({
            "display": "none",
        });
        $("#input_efectivo").css({
            "display": "none",
        });
        $("#input_tarjeta").css({
            "display": "none",
        });
        $("#input_tarjeta_dos").css({
            "display": "none",
        });
        $("#input_efectivo_efectivo").css({
            "display": "none",
        });
        $("#input_credito").css({
            "display": "none",
        });
        $("#saldo_abono").css({
            "display": "none",
        });
        $("#numero_factura").css({
            "display": "none",
        });
        $("#numero_factura").val('');

        $('#caja_tarjeta').prop('disabled', false);

        $('#tag_factura').val('BLESS');

        $('#seleccionar_iva').css({
            "display": "block"
        });

        $("#input_transaccion").css({
            "display": "none",
        });

        /****************+ FIN *************************** */
    }
    if (tipo == 12) {
        $("#documento_cliente").prop('disabled',false);
        $('#id_tipo_pago').val('');
        $('#lista_bancos').val('');
        $("#input_efectivo").css({
            "display": "none",
        });

        $("#input_tarjeta").css({
            "display": "block",
        });

        $("#input_cambio").css({
            "display": "none",
        });

        $("#tipo_pago_select").css({
            "display": "block",
        });
        $("#franquicias").css({
            "display": "block",
        });
        $("#valor_uno").css({
            "display": "none",
        });
        $("#input_transaccion").css({
            "display": "block",
        });
        $("#input_credito").css({
            "display": "none",
        });
        $("#tipo_pago_select_dos").css({
            "display": "none",
        });
        $("#franquicias_dos").css({
            "display": "none",
        });
        $("#valor_dos").css({
            "display": "none",
        });
        $("#input_efectivo").css({
            "display": "none",
        });
        $("#input_tarjeta").css({
            "display": "none",
        });
        $("#input_tarjeta_dos").css({
            "display": "none",
        });
        $("#input_efectivo_efectivo").css({
            "display": "none",
        });
        $("#saldo_abono").css({
            "display": "none",
        });
        $("#numero_factura").css({
            "display": "none",
        });
        // input saldo sistecredito
        $("#saldo_sistecredito").css({
            "display": "none",
        });
        $("#numero_factura").val('');

        $('#caja_tarjeta').prop('disabled', false);

        /************************************************ */
        /*** CODIGO PARA CALCULAR PAGO CON TARJETA CUANDO
         *   EL PAGO VIENE CON ABONO
         **************************************************/
        var valor_abono_puntos = $('#abono').val();
        var valor_abono = valor_abono_puntos.split('.').join('');
        if (valor_abono.length != 0) {
            $("#saldo_abono").css({
                "display": "block",
            });
            //  alert('con abono');
            var precio_total_puntos = $('#precioTotal').html();
            var precio_total = precio_total_puntos.split('.').join('');
            var valor = parseFloat(precio_total)-parseFloat(valor_abono);
            $('#caja_tarjeta_dos').val(valor.toLocaleString());

        } else {

            var precio_total_puntos = $('#precioTotal').html();
            
            $('#caja_tarjeta_dos').val(precio_total_puntos);
        }

        /****************+ FIN *************************** */
    }

    if (tipo == 13) {
        $("#documento_cliente").prop('disabled',false);
        $('#id_tipo_pago').val('');
        $('#lista_bancos').val('');
        $("#input_efectivo").css({
            "display": "none",
        });

        $("#input_tarjeta").css({
            "display": "none",
        });

        $("#input_cambio").css({
            "display": "none",
        });

        $("#tipo_pago_select").css({
            "display": "none",
        });
        $("#franquicias").css({
            "display": "none",
        });
        $("#valor_uno").css({
            "display": "none",
        });
        $("#input_transaccion").css({
            "display": "none",
        });
        $("#input_credito").css({
            "display": "block",
        });
        $("#tipo_pago_select_dos").css({
            "display": "none",
        });
        $("#franquicias_dos").css({
            "display": "none",
        });
        $("#valor_dos").css({
            "display": "none",
        });
        $("#input_efectivo").css({
            "display": "none",
        });
        $("#input_tarjeta").css({
            "display": "none",
        });
        $("#input_tarjeta_dos").css({
            "display": "none",
        });
        $("#input_efectivo_efectivo").css({
            "display": "none",
        });
        $("#saldo_abono").css({
            "display": "none",
        });
        $("#numero_factura").css({
            "display": "none",
        });
        // input saldo sistecredito
        $("#saldo_sistecredito").css({
            "display": "none",
        });
        $("#numero_factura").val('');

        $('#caja_tarjeta').prop('disabled', false);

        /************************************************ */
        /*** CODIGO PARA CALCULAR PAGO CON TARJETA CUANDO
         *   EL PAGO VIENE CON ABONO
         **************************************************/
        var valor_abono_puntos = $('#abono').val();
        var valor_abono = valor_abono_puntos.split('.').join('');
        if (valor_abono.length != 0) {
            $("#saldo_abono").css({
                "display": "block",
            });
            //  alert('con abono');
            var precio_total_puntos = $('#precioTotal').html();
            var precio_total = precio_total_puntos.split('.').join('');
            var valor = parseFloat(precio_total)-parseFloat(valor_abono);
            $('#caja_tarjeta_dos').val(valor.toLocaleString());

        } else {

            var precio_total_puntos = $('#precioTotal').html();
            
            $('#caja_tarjeta_dos').val(precio_total_puntos);
        }

        /****************+ FIN *************************** */
    }
});