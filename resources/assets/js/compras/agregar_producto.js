$('#agregar_compra').click(function () {
    var proveedor = $('#proveedor').val();
    // console.log(proveedor);
    var id_producto = $('#id_producto').val();
    var codigo = $('#codigo').val();
    var nombre = $('#titulo').val();
    var p_compra = $('#costo_unitario').val();
    var cantidad = $('#cantidad').val();
    var p_detal = $('#p_detal').val();
    var p_mayor = $('#p_mayor').val();
    var aplicar_oferta = $('#aplicar_oferta ').val();
    var porsentaje_oferta = $('#porsentaje_oferta').val();
    var Clasificacion = $('#Clasificacion').val();
    var aplicar_iva = $('#aplicar_iva').val();
    if (id_producto != "" && codigo != "" && nombre != "" && p_compra != "" && cantidad != "" && p_detal != "" && p_mayor != "") {
        // 0 = codigo del producto
        // 1 =  id del producto
        // 2 =  nombre del producto
        // 3 =  precio de compra
        // 4 =  cantidad de productos
        // 5 =  precios al detal
        // 6 =  precios al mayor
        // 7 =  aplicar descuento (si o no)
        // 8 =  % de descuento
        // 9 =  Clasificacion del producto
        // 10 = aplicar iva
        // 11 = botones
        var fila = '<tr class="dato"><td> ' + codigo +
            '</td><td style="display: none">' + id_producto +
            '</td><td>' + nombre +
            '</td><td>' + p_compra +
            '</td><td>' + cantidad +
            '</td><td>' + p_detal +
            '</td><td >' + p_mayor +
            '</td><td >' + aplicar_oferta +
            '</td><td >' + porsentaje_oferta +
            '</td><td >' + Clasificacion +
            '</td><td >' + aplicar_iva +
            '</td><td><button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button></td></tr>';
        //  console.log(fila);
        var conteo = $('#encabezado_compras tr:last');
        conteo.after(fila);

        $('#id_producto').val("");
        $('#codigo').val("");
        $('#titulo').val("");
        $('#costo_unitario').val("");
        $('#cantidad').val("");
        $('#p_detal').val("");
        $('#p_mayor').val("");
        $('#categoria').val("");
        $('#subcategoria').val("");
        $('#descripcion').val("");
        $('#aplicar_oferta ').val("");
        $('#porsentaje_oferta').val("");
        $('#Clasificacion').val("");
        $('#aplicar_iva').val("");
        $('#calculo_mayor').val("");
        $('#calculo_detal').val("");
    } else {
        alertify.error("TODOS LOS CAMPOS SON OBLIGATORIOS.");
        return (false);
    }
});