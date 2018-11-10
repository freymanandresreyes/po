//************************************************************
//*********** CAJA_REGISTRADORA/VENDER_PRODUCTOS *************
//***********************************************************
//funcion para cconsultar factura a imprimir
function consultar_factura(nFactura) {
    var numero_factura = nFactura;
    var documento = documento;
    var asesor = $('#vendedor_factura').val();
    var url = getAbsolutePath() + "generar_factura";
    $.ajax({
        url: url,
        type: 'GET',
        data: {
            factura: numero_factura,
            asesor: asesor
        },
        dataType: 'json',
        success: function (respuesta) {
            // console.log(respuesta);
            $('#nueva_factura').html(respuesta);
            window.print();
            setTimeout(function () {
                location.reload();
            }, 100);
        }//fin del success
    });//fin de ajax
}

$("#vender_producto").click(function (e) {
    //************************************
    var tipo_factura = $("#tag_factura option:selected" ).attr("name");
    
    var documento = $('#id_cliente').val();
    var vendedor = $('#vendedor_factura').val(); // captura el id del vendedor
    var tipo_pago = $("input[name='tipopago']:checked").val();
    var consecutivo_apartado = $('#consecutivo_apartado').val();
    var estado_saldo = $('#estado_saldo').val();

    var id_pago = $("input[name='pago']:checked").val();
    var id_banco = $('#lista_bancos').val();
    var id_pago_dos = $("input[name='pago2']:checked").val();
    var id_banco_dos = $('#lista_bancos_dos').val();

    //valores con separadores
    var precio_total_puntos = $('#precioTotal').html();
    var valor_abono_puntos = $('#abono').val();
    var valor_efectivo_efectivo_puntos = $('#caja_efectivo_efectivo').val();
    var valor_saldo_tarjeta_uno_puntos = $('#caja_tarjeta').val();
    var valor_saldo_efectivo_tarjeta_uno_puntos = $('#caja_efectivo').val();
    var valor_saldo_tarjeta_tarjeta_uno_puntos = $('#saldo_valor').val();
    var valor_saldo_tarjeta_dos_puntos = $('#saldo_valor_dos').val();

    //valores sin separadores
    //precio total de la compra
    var precio_total = precio_total_puntos.split('.').join('');
    // saldo del abono
    var valor_abono = valor_abono_puntos.split('.').join('');
    // saldo de pago en efectivo
    var valor_efectivo_efectivo = valor_efectivo_efectivo_puntos.split('.').join('');
    // saldo tarjeta uno
    var valor_saldo_tarjeta_uno = valor_saldo_tarjeta_uno_puntos.split('.').join('');
    // saldo tarjeta dos
    var valor_saldo_tarjeta_dos = valor_saldo_tarjeta_dos_puntos.split('.').join('');
    // saldo tarjeta tarjeta uno
    var valor_saldo_tarjeta_tarjeta_uno = valor_saldo_tarjeta_tarjeta_uno_puntos.split('.').join('');
    // saldo efectivo tarjeta uno
    var valor_saldo_efectivo_tarjeta_uno = valor_saldo_efectivo_tarjeta_uno_puntos.split('.').join('');

    var id_cliente = $("#id_cliente").val();// captura el id del cliente
    var tag_factura = $('#tag_factura').val(); // captura el tag de la factura
    var name_tag_factura = $('#tag_factura option:selected').attr("name"); //name del tag trae el numero de tag

    if(tipo_factura == 2){
        var fecha_factura = $('#fecha_factura').val();
        if(fecha_factura == null || fecha_factura == ""){
            alertify.error("El campo fecha de la factura esta vacío.");
                return false;
        }
    }
    //*** validacion pagos en efectivo *** */
    if (tipo_pago == 1) {
        if (valor_abono.length != 0) {
            if (parseFloat(valor_abono) > parseFloat(precio_total)){
                alertify.error("El valor en abono supera al valor de la compra.");
                return false;
            }
            if (((parseFloat(valor_efectivo_efectivo) + parseFloat(valor_abono)) < parseFloat(precio_total))) {
                alertify.error("El valor en efectivo es inferior.");
                return false;
            }
        }else{
            if ((parseFloat(valor_efectivo_efectivo) < parseFloat(precio_total)) ) {
                alertify.error("El valor en efectivo es inferior.");
                return false;
            }
        }
    }
    /****** PAGOS CON TARJETA ************ */
    if (tipo_pago == 2) {


        var id_pago = $("input[name='pago']:checked").val();
        var id_banco = $('#lista_bancos').val();

        if (id_pago == null || id_pago == "") {
            alertify.error("No se encontro ningun tipo de pago.");
            return false;
        }
        if (id_banco == null || id_banco == "") {
            alertify.error("La entidad bancaria no puede estar vacía.");
            return false;
        }

    }

    if (tipo_pago == 3) {

        var id_pago = $("input[name='pago']:checked").val();
        var id_banco = $('#lista_bancos').val();

        if (id_pago == null || id_pago == "") {
            alertify.error("No se encontro ningun tipo de pago.");
            return false;
        }
        if (id_banco == null || id_banco == "") {
            alertify.error("La entidad bancaria no puede estar vacía.");
            return false;
        }

        if (valor_abono.length != 0) {
            if ((parseFloat(valor_saldo_tarjeta_uno) + parseFloat(valor_saldo_efectivo_tarjeta_uno) + parseFloat(valor_abono)) != precio_total) {
                alertify.error("El valor no coincide al de la venta.");
                return false;
            }
        } else {
            if ((parseFloat(valor_saldo_tarjeta_uno) + parseFloat(valor_saldo_efectivo_tarjeta_uno)) != precio_total) {
                alertify.error("El valor no coincide al de la venta.");
                return false;
            }
        }

    }
    /*********************************************************** */
    /******************* PAGOS TARJETA TARJETA ***************** */
    /*********************************************************** */
    if (tipo_pago == 4) {

        var id_pago = $("input[name='pago']:checked").val();
        var id_banco = $('#lista_bancos').val();


        if (id_pago == null || id_pago == "") {
            alertify.error("No se encontro ningun tipo de pago.");
            return false;
        }
        if (id_banco == null || id_banco == "") {
            alertify.error("La entidad bancaria no puede estar vacía.");
            return false;
        }
        var id_pago_dos = $("input[name='pago2']:checked").val();
        var id_banco_dos = $('#lista_bancos_dos').val();

        if (id_pago_dos == null || id_pago_dos == "") {
            alertify.error("No se encontro ningun tipo de pago.");
            return false;
        }
        if (id_banco_dos == null || id_banco_dos == "") {
            alertify.error("La entidad bancaria no puede estar vacía.");
            return false;
        }

        if (valor_abono.length != 0) {
            if ((parseFloat(valor_saldo_tarjeta_tarjeta_uno) + parseFloat(valor_saldo_tarjeta_dos) + parseFloat(valor_abono)) != precio_total) {
                alertify.error("El valor no coincide al de la venta.");
                return false;
            }
        } else {

            if ((parseFloat(valor_saldo_tarjeta_tarjeta_uno) + parseFloat(valor_saldo_tarjeta_dos)) != precio_total) {
                alertify.error("El valor no coincide al de la venta.");
                return false;
            }
        }
    }

    /*********************************************************** */
    /**************** PAGOS DEVOLUCIONES MAYORISTAS************** */
    /*********************************************************** */
    if (tipo_pago == 5) {
        if (valor_abono.length != 0) {
            if ((parseFloat(valor_abono)) != precio_total) {
                alertify.error("El valor no coincide al de la venta.");
                return false;
            }
        } else {        
            alertify.error("No hay saldos a favor.");
            return false;       
        }
    }
    /***************************************************** 
     * ***** variables para sistecredito *****************
     * ***************************************************
    */
    //variables con separadores
    var saldo_sistecredito_puntos = $('#valor_sistecredito').val();
    var caja_cambio_puntos = $('#caja_cambio').val();
    var saldo_tarjeta_uno_puntos = $('#caja_tarjeta_dos').val();
    
    //variables sin separadores
    var saldo_sistecredito = saldo_sistecredito_puntos.split('.').join('');
    var caja_cambio = caja_cambio_puntos.split('.').join('');
    var saldo_tarjeta_uno = saldo_tarjeta_uno_puntos.split('.').join('');

     //*** validacion pagos con sistecredito *** */
    //  alert('antes de validar');
     if (tipo_pago == 6) {
        if (valor_abono.length != 0) {
            if (parseFloat(valor_abono) > parseFloat(precio_total)){
                alertify.error("El valor en abono supera al valor de la compra.");
                return false;
            }
            if (((parseFloat(saldo_sistecredito) + parseFloat(valor_abono)) < parseFloat(precio_total))) {
                alertify.error("El valor es inferior al valor de la venta.");
                return false;
            }
            if (((parseFloat(saldo_sistecredito) + parseFloat(valor_abono)) > parseFloat(precio_total))) {
                alertify.error("El valor es superior al valor de la venta.");
                return false;
            }
        }else{
            // alert('voy a validar');
            if (parseFloat(saldo_sistecredito) < parseFloat(precio_total) || parseFloat(saldo_sistecredito) > parseFloat(precio_total)){
                alertify.error("El valor ingresado no coincide con el de la venta.");
                return false;
            }
        }
    }
    
    //*** validacion pagos en efectivo y sistecredito *** */
    if (tipo_pago == 7) {
        if (valor_abono.length != 0) {
            var efectivo = (parseFloat(valor_efectivo_efectivo)-parseFloat(caja_cambio)) + parseFloat(valor_abono)+parseFloat(saldo_sistecredito);
            if (parseFloat(saldo_sistecredito) > parseFloat(precio_total)){
                alertify.error("El pago con Sistecredito supera al valor de la compra.");
                return false;
            }
            if (parseFloat(valor_abono) > parseFloat(precio_total)){
                alertify.error("El pago con abono supera al valor de la compra.");
                return false;
            }
            if ( efectivo < parseFloat(precio_total)) {
                alertify.error("El valor en efectivo es inferior.");
                return false;
            }
            if ( efectivo > parseFloat(precio_total)) {
                alertify.error("El saldo ingresado es superior al de la venta.");
                return false;
            }
        }else{
            if (parseFloat(saldo_sistecredito) > parseFloat(precio_total)){
                alertify.error("El pago con Sistecredito supera al valor de la compra.");
                return false;
            }
            if (((parseFloat(valor_efectivo_efectivo) - parseFloat(caja_cambio))+parseFloat(saldo_sistecredito)) > parseFloat(precio_total)){
                alertify.error("El pago con Sistecredito supera al valor de la compra2.");
                return false;
            }
            if ((parseFloat(valor_efectivo_efectivo)+parseFloat(saldo_sistecredito)) < parseFloat(precio_total))  {
                alertify.error("El valor en efectivo es inferior.");
                return false;
            }
        }
    }
    /********************************************************** */
    /*********** PAGOS CON TARJETA Y SISTECREDITO ************* */
    /********************************************************** */
    if (tipo_pago == 8) {
        // alert('verifica');
        var id_pago = $("input[name='pago']:checked").val();
        var id_banco = $('#lista_bancos').val();

        if (id_pago == null || id_pago == "") {
            alertify.error("No se encontro ningun tipo de pago.");
            return false;
        }
        if (id_banco == null || id_banco == "") {
            alertify.error("La entidad bancaria no puede estar vacía.");
            return false;
        }

        //----------------------------------
        if (valor_abono.length != 0) {
            if (parseFloat(saldo_sistecredito) > parseFloat(precio_total)){
                alertify.error("El pago con Sistecredito supera al valor de la compra.");
                return false;
            }
            if (parseFloat(valor_abono) > parseFloat(precio_total)){
                alertify.error("El pago con abono supera al valor de la compra.");
                return false;
            }
            if (((parseFloat(saldo_sistecredito) + parseFloat(valor_abono)+parseFloat(saldo_tarjeta_uno)) < parseFloat(precio_total))) {
                alertify.error("El saldo ingresado para esta compra es inferior.");
                return false;
            }
            if (((parseFloat(saldo_sistecredito) + parseFloat(valor_abono)+parseFloat(saldo_tarjeta_uno)) > parseFloat(precio_total))) {
                alertify.error("El saldo ingresado para esta venta es superior.");
                return false;
            }
        }else{
            if (parseFloat(saldo_sistecredito) > parseFloat(precio_total)){
                alertify.error("El pago con Sistecredito supera al valor de la compra.");
                return false;
            }
            if ((parseFloat(saldo_tarjeta_uno) +parseFloat(saldo_sistecredito)) > parseFloat(precio_total)){
                alertify.error("El pago con Sistecredito supera al valor de la compra2.");
                return false;
            }
            if ((parseFloat(saldo_tarjeta_uno)+parseFloat(saldo_sistecredito)) < parseFloat(precio_total))  {
                alertify.error("El valor ingresado es inferior es inferior.");
                return false;
            }
        }
    }

    if (documento == null || documento == "") {
        alertify.error("No se encontro ningun cliente");
        return false;
    }
    if (vendedor == null || vendedor == "") {
        alertify.error("No se encontro ningun vendedor");
        return false;
    }


    

    // *********** MODAL VENTA ***********
    $("#modal_venta").addClass("show");

    $("#modal_venta").css({
        "display": "block",
        "padding-right": "16px",
        "background": "rgba(0, 0, 0, 0.5)"
    });
    // *********** FIN MODAL VENTA *******

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

    if (tag_factura == "" || tag_factura == null) {
        alertify.alert("<b>Blog Reaccion Estudio</b> probando Alertify", function () {
            //aqui introducimos lo que haremos tras cerrar la alerta.
            //por ejemplo -->  location.href = 'http://www.google.es/';  <-- Redireccionamos a GOOGLE.
        });
    }
   
    // ******** APLICA CUANDO EL PAGO ES EN EFECTIVO *******
    var cambio = $('#caja_cambio').val();

    if(cambio != null || cambio != ""){

        var c_efectivo = $('#caja_efectivo_efectivo').val();
        var c_cambio = $('#caja_cambio').val();
    
        $('#efectivo_cambio').html(c_efectivo);
        $('#cambio_cambio').html(c_cambio);
    }
    //inicio del ajax 
    var fecha_factura = $('#fecha_factura').val();
    var check_mayorista = $('#check_mayorista').val();
    var url = getAbsolutePath() + 'crear_facturas';

    $("#vender_producto").prop('disabled',true);
    // alert(precio_total);
    $.ajax({
        url: url,
        type: 'POST',
        headers: { 'X-CSRF-Token': $('meta[name=_token]').attr('content') },
        data: {
            check_mayorista: check_mayorista,
            productos: data,
            id_cliente: id_cliente,
            tipo_pago: tipo_pago,
            id_asesor: vendedor,
            tag_factura: tag_factura,
            valor_abono: valor_abono,
            precio_total: precio_total,
            valor_saldo_tarjeta_uno: valor_saldo_tarjeta_uno,
            valor_saldo_tarjeta_dos: valor_saldo_tarjeta_dos,
            valor_saldo_tarjeta_tarjeta_uno: valor_saldo_tarjeta_tarjeta_uno,
            valor_saldo_efectivo_tarjeta_uno: valor_saldo_efectivo_tarjeta_uno,
            id_pago: id_pago,
            id_banco: id_banco,
            id_pago_dos: id_pago_dos,
            id_banco_dos: id_banco_dos,
            consecutivo_apartado: consecutivo_apartado,
            estado_saldo: estado_saldo,
            tipo_factura: tipo_factura,
            fecha_factura: fecha_factura,
            saldo_sistecredito: saldo_sistecredito,
            saldo_tarjeta_uno: saldo_tarjeta_uno,
            name_tag_factura: name_tag_factura
        },
        dataType: 'json',
        success: function (respuesta) {
            $('#numero_factura').html(respuesta);
            consultar_factura(respuesta);

        }//fin del success
    });
    //fin de ajax

    //********************************
    // console.log("este es el numero de factura" + $('#numero_factura').html());
    $("#modal_factura").addClass("show");

    $("#modal_factura").css({
        "display": "block",
        "padding-right": "16px",
        "background": "rgba(0, 0, 0, 0.5)"
    });

    //
    var suma = 0;
    $('#encabezado tr.dato').each(function () { //filas con clase 'dato', especifica una clase, asi no tomas el nombre de las columnas
        suma += parseInt($(this).find('td').eq(4).text() || 0, 10); //numero de la celda 3
    });

    e.preventDefault();

});