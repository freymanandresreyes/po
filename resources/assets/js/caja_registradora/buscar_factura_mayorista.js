$("#codigo_factura").keypress(function (e) {
    if (e.which == 13) {
        var codigo_factura = $("#codigo_factura").val();

        var url = getAbsolutePath() + 'buscar_factura_mayorista';

        $.ajax({
            url: url,
            type: 'POST',
            headers: { 'X-CSRF-Token': $('meta[name=_token]').attr('content') },
            data: {
                codigo_factura: codigo_factura
            },
            dataType: 'json',
            success: function (respuesta) {
                if(respuesta != null){
                    var tipo_factura = respuesta[0];
                    var id_cliente = respuesta[1];
                    if (tipo_factura == 1) {
                        $("#codigo_factura").val('');
                        alertify.error("Esta factura no es de una venta al MAYOR");
                    } else if (tipo_factura == 2) {
                        $("#documento_cliente").val(respuesta[2]['documento']);
                        $("#nombre_cliente").val(respuesta[2]['nombres']);
                        $("#direccion_cliente").val(respuesta[2]['direccion']);
                        $("#telefono_cliente").val(respuesta[2]['telefono']);
                        $("#id_cliente").val(respuesta[2]['id']);
                        buscar_saldo_factura(id_cliente);
                        alertify.success("Factura con venta al MAYOR");
                    }

                }else{
                    alertify.error("Factura no encontrada.");
                }


                /****************+ FIN *************************** */
            }//fin del success
        });//fin de ajax
    }

});

function buscar_saldo_factura(dato) {
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
                
                    /************************************************************************
                     CODIGO PARA AGREGAR EL PRODUCTO CUANDO ACEPTAN SEPARADOS  (ง︡'-'︠)ง
                    *************************************************************************/
                        var saldo_efectivo = 0;
                        var saldo_tarjeta_uno = 0;
                        var saldo_tarjeta_dos = 0;
                        calcular_precios()
                        calcular_saldo();

                        $('#abono').val(respuesta.toLocaleString());
                        $('#estado_saldo').val("1");

                        $('#saldo_abono').css({
                            "display": "block",
                        });

                        $('#codigo_producto').prop('disabled', false);
                        $('#boton_mayor').prop('disabled', false);
                        $('#vendedor_factura').prop('disabled', false);

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
                     
                
                return false
            }else{
                alertify.error("Esta factura no tiene saldo.");
                return false
            }


        }//fin del success
    });//fin de ajax
}