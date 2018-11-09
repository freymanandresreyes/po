$('#boton_mayor').on('click', function () {
    swal({   
        title: "Cambio de precios",   
        text: "¿Desea cambiar los precios a mayorista?, si agrego descuentos estos se perderan.",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Si. Cambiar",   
        cancelButtonText: "No. Cancelar",   
        closeOnConfirm: false,   
        closeOnCancel: false 
    }, function(isConfirm){   
        if (isConfirm) { 
             //*******************************************************
    //FUNCION PARA CAMBIAR LOS PRECIOS A MAYORISTA
    //*******************************************************
    // almacenar la data 
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
    // codigo para recalcular si no hay promocion

    // 0 = titulo del producto
    // 1 = codigo del producto
    // 2 = precio al detal
    // 3 = precio al mayor.
    // 4 = iva del producto
    // 5 = precio iva incluido.
    // 6 = porsentaje de descuento
    // 7 = Cantidad de productos.
    // 8 = precio total.
    // 9 = porsentaje de descuento de base de datos
    // 10 = id del producto.
    // 11 = Oferta del producto (Si o No).
    // 12 = id de la categoria
    // 13 = id de la subcategoria.
    // 14 = precio costo (al que se compro para la venta).
    // 15 = Configuraciones de productos.
    // 16 = Aplicar iva.
    // 17 = Tipo de factura (mayor o detal).
    // 18 = clasificaciond e productos para facturas.
    // 19 = botonera de opciones

    $('#encabezado tr:not(:first-child)').remove();
    for (var i = 0; i < data.length; i++) {
        var iva_tienda = $('#iva_caja').val();
        //variables
        var precio_iva = null;
        var precio_total = null;
        var porsentaje = null;
        var clasificacion = null;

        if (data[i][15] == 1) {
            //clasificacion bolsas
            clasificacion = 1;
        } else if (data[i][15] == 2) {
            //clasificacion obsequio sin valor
            clasificacion = 2;
        } else if (data[i][15] == 3) {
            //clasificacion obsequio con valor
            clasificacion = 3;
        } else if (data[i][15] == 5) {
            //solo detal.
            clasificacion = 5;
        } else if (data[i][15] == 4 || data[i][15] == 6) {
            //producto al mayor
            clasificacion = 4;
        }
        //calcula el precio cuando no hay descuento.
        if (data[i][11] == 2 && data[i][16] == 1) {
            precio_iva = (Math.round((parseFloat(data[i][3]) * parseFloat(iva_tienda)) / 100));
            precio_total = Math.round((parseFloat(data[i][3])) + (precio_iva));
            porsentaje = 0;
        } else if (data[i][11] == 1 && data[i][16] == 1) {
            var iva = (Math.round((parseFloat(data[i][3]) * parseFloat(iva_tienda)) / 100));
            var total = Math.round((parseFloat(data[i][3])) + (iva));
            precio_iva = (Math.round((parseFloat(total) * parseFloat(data[i][9])) / 100));
            precio_total = Math.round((parseFloat(total)) - (precio_iva));
            porsentaje = data[i][9];
        } else if (data[i][11] == 2 && data[i][16] == 2) {
            precio_iva = 0;
            precio_total = parseFloat(parseFloat(data[i][3]));
            porsentaje = 0;
        } else if (data[i][11] == 1 && data[i][16] == 2) {
            var iva = (Math.round((parseFloat(data[i][3]) * parseFloat(data[i][9])) / 100));
            var total = Math.round((parseFloat(data[i][3])) - (iva));
            precio_iva = 0;
            precio_total = total;
            porsentaje = data[i][9];
        }

        var fila = '<tr class="dato"><td> ' +
            data[i][0] +
            '</td><td>' + data[i][1] +
            '</td><td style="display: none">' + data[i][2] +
            '</td><td style="display: none">' + data[i][3] +
            '</td><td style="display: none">' + data[i][4] +
            '</td><td>' + precio_total +
            '</td><td>' + porsentaje +
            '</td><td>' + data[i][7] +
            '</td><td >' + precio_total +
            '</td><td style="display: none">' + data[i][9] +
            '</td><td style="display: none">' + data[i][10] +
            '</td><td style="display: none">' + data[i][11] +
            '</td><td style="display: none">' + data[i][12] +
            '</td><td style="display: none">' + data[i][13] +
            '</td><td style="display: none">' + data[i][14] +
            '</td><td style="display: none">' + data[i][15] +
            '</td><td style="display: none">' + data[i][16] +
            '</td><td style="display: none">' + '2' +
            '</td><td style="display: none">' + clasificacion +
            '</td><td><button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button></td></tr>';
        var conteo = $('#encabezado tr:last');
        conteo.after(fila);
        calcular_saldo();
    }
//*******************************************************
// FIN DE LA FUNCION DE CAMBIO DE PRECIO AMYORISTA
//*******************************************************    
            swal("Completado!", "Todos los precios se cambiaron a mayorista.", "success");   
        } else {     
            swal("Cancelar", "No se realizaron cambios:)", "error");   
        } 
    });
   
});