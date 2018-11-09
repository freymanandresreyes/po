$('#guardar_modal_apartado').click(function () {
    //   alert('ok');
    var total_venta = $('#total_apartado').val();
    var tipo_pago = $('#apartado_tipo_pago').val();
    var efectivo = $('#input_apartado_efectivo').val();
    var dias_apartado = $('#apartado_dias').val();

    // variables para primer bloque de tarjeta uno
    var saldo_tarjeta_uno = $('#input_apartado_saldo_uno').val();
    var tipo_pago_uno = $('#id_tipo_pago').val();
    var bancos_uno = $('#lista_bancos').val();

    // variables para segundo bloque de tarjeta dos
    var saldo_tarjeta_dos = $('#input_apartado_saldo_dos').val();
    var tipo_pago_dos = $('#id_tipo_pago_dos').val();
    var bancos_dos = $('#lista_bancos_dos').val();

    var id_cliente = $('#id_cliente').val();
    // var efectivo_tarjeta_uno = $('#apartado_saldo_tarjeta_uno').val();

    if (tipo_pago == 1 || tipo_pago == "1") {
        var tope = total_venta / 2;
        $("#total_abono").html(efectivo.toLocaleString());
        if (parseFloat(efectivo) < tope) {
            alertify.error("El valor del abono no puede ser inferior a $ " + tope);
            $('#input_apartado_efectivo').val("");
            return (false);
        }
        if (parseFloat(efectivo) > total_venta) {
            alertify.error("El valor del abono no puede ser superior a $ " + total_venta);
            $('#input_apartado_efectivo').val("");
            return (false);
        }
    }
    /*********************************************************************
     * ****                    PAGOS CON TARJETA          ****************
     *********************************************************************/
    if (tipo_pago == 2 || tipo_pago == "2") {
        var tope = total_venta / 2;
        $("#total_abono").html(saldo_tarjeta_uno.toLocaleString());
        if (tipo_pago_uno && bancos_uno && saldo_tarjeta_uno && dias_apartado) {

            if (parseFloat(saldo_tarjeta_uno) < tope) {
                alertify.error("El valor del abono no puede ser inferior a $ " + tope);
                $('#input_apartado_efectivo').val("");
                return (false);
            }
            if (parseFloat(saldo_tarjeta_uno) > total_venta) {
                alertify.error("El valor del abono no puede ser superior a $ " + total_venta);
                $('#input_apartado_efectivo').val("");
                return (false);
            }

        } else {
            alertify.error("TODOS LOS CAMPOS SON OBLIGATORIOS.");
            return (false);
        }
    }
    /*********************************************************************
     * ****        PAGOS MIXTOS EFECTIVO TARJETA          ****************
     *********************************************************************/
    if (tipo_pago == 3 || tipo_pago == "3") {
        var tope = total_venta / 2;
        var total = parseFloat(saldo_tarjeta_uno) + parseFloat(efectivo);
        $("#total_abono").html(total.toLocaleString());
        if (tipo_pago_uno && bancos_uno && saldo_tarjeta_uno && dias_apartado && efectivo) {
            var suma = (parseFloat(efectivo)) + (parseFloat(saldo_tarjeta_uno))

            if (parseFloat(suma) < tope) {
                alertify.error("El valor del abono no puede ser inferior a $ " + tope);
                $('#input_apartado_efectivo').val("");
                return (false);
            }
            if (parseFloat(suma) > total_venta) {
                alertify.error("El valor del abono no puede ser superior a $ " + total_venta);
                $('#input_apartado_efectivo').val("");
                return (false);
            }

        } else {
            alertify.error("TODOS LOS CAMPOS SON OBLIGATORIOS.");
            return (false);
        }
    }
    /*********************************************************************
     * ****        PAGOS MIXTOS TARJETA - TARJETA          ****************
     *********************************************************************/
    if (tipo_pago == 4 || tipo_pago == "4") {
        var tope = total_venta / 2;
        var total = parseFloat(saldo_tarjeta_uno) + parseFloat(saldo_tarjeta_dos);
        $("#total_abono").html(total.toLocaleString());

        if (tipo_pago_uno && bancos_uno && saldo_tarjeta_uno && tipo_pago_dos && bancos_dos && saldo_tarjeta_dos && dias_apartado) {

            var suma = (parseFloat(saldo_tarjeta_dos)) + (parseFloat(saldo_tarjeta_uno))

            if (parseFloat(suma) < tope) {
                alertify.error("El valor del abono no puede ser inferior a $ " + tope);
                $('#input_apartado_efectivo').val("");
                return (false);
            }
            if (parseFloat(suma) > total_venta) {
                alertify.error("El valor del abono no puede ser superior a $ " + total_venta);
                $('#input_apartado_efectivo').val("");
                return (false);
            }

        } else {
            alertify.error("TODOS LOS CAMPOS SON OBLIGATORIOS.");
            return (false);
        }
    }

    //codigo para contar los productos que
    //se agregaran a la compra
    var header = Array();
    $("table tr th").each(function (i, v) {
        header[i] = $(this).text();
    });

    var data = Array();
    $("table tr").each(function (i, v) {
        data[i] = Array();
        $(this).children('td').each(function (ii, vv) {
            data[i][ii] = $(this).text();
        });
    });
    data.splice(0, 1);
    data.pop();
    // data.shift();
    
    $('#guardar_modal_apartado').prop('disabled', true);
    var url = URLdominio + 'guardar_modal_apartado';
    // FIN FUNCION GLOBAL
    $.ajax({
        url: url,
        type: 'GET',
        data: {
            data: data,
            id_cliente: id_cliente,
            tipo_pago: tipo_pago,
            efectivo: efectivo,
            dias_apartado: dias_apartado,
            saldo_tarjeta_uno: saldo_tarjeta_uno,
            tipo_pago_uno: tipo_pago_uno,
            bancos_uno: bancos_uno,
            saldo_tarjeta_dos: saldo_tarjeta_dos,
            tipo_pago_dos: tipo_pago_dos,
            bancos_dos: bancos_dos,

        },
        dataType: 'json',
        success: function (respuesta) {

            if (respuesta) {
                $("modal_crear_producto_compras").removeClass("show");
                $("#modal_crear_producto_compras").css({
                    "display": "none"
                });
                $('#nueva_factura').html(respuesta);
                window.print();
                console.log(respuesta);
               location.reload();
            } 

        }//fin del success
    });//fin de ajax


});

$("#cerrar_modal_producto").click(function () {
    $("modal_crear_producto_compras").removeClass("show");
    $("#modal_crear_producto_compras").css({
        "display": "none"
    });

    $('#categoria_modal').val("");
    $('#subcategoria_modal').val("");
    $('#titulo_modal').val("");
    $('#descripcion_modal').val("");
    $('#codigo_modal').val("");
});