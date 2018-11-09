
// FUNCION PARA ACTIVAR LOS IMPUTS DEL FORMULARIO
// DE CREAR UNA NUEVA COMPRA
$('#crear_apartado').click(function () {

    var id_cliente = $('#id_cliente').val();
    var suma = 0;
    $('#encabezado_separados tr.dato').each(function () { //filas con clase 'dato', especifica una clase, asi no tomas el nombre de las columnas
        suma += parseInt($(this).find('td').eq(4).text() || 0, 10); //numero de la celda 6
        // suma += parseInt($(this).find('td').eq(6).text() || 0, 10); //esperimento
    });

    console.log(suma);



    if (id_cliente) {
        if (suma > 0) {

            var suma = 0;
            $('#encabezado_separados tr.dato').each(function () { //filas con clase 'dato', especifica una clase, asi no tomas el nombre de las columnas
                suma += parseInt($(this).find('td').eq(5).text() || 0, 10); //numero de la celda 6
                // suma += parseInt($(this).find('td').eq(6).text() || 0, 10); //esperimento
            });
            $('#total_apartado').val(suma);

            var subTotalPorsentaje = (parseInt(suma) * 19) / 100;
            var subTotal = suma - subTotalPorsentaje;
            var precio_total = parseInt(subTotal) + parseInt(subTotalPorsentaje);
            // console.log('precio total:' + precio_total);

            $("#subtotal").html(subTotal.toLocaleString());
            $("#iva").html(subTotalPorsentaje.toLocaleString());
            $("#precioTotal").html(precio_total.toLocaleString());
            

            $("#modal_crear_producto_compras").addClass("show");
            $("#modal_crear_producto_compras").css({
                "display": "block",
                "padding-right": "16px",
                "background": "rgba(0, 0, 0, 0.5)"
            });
        } else {
            alertify.error("Debe ingresar minimo 1 producto.");
            return (false);
        }

    } else {
        alertify.error("Seleccione un clinte");
        return (false);
    }

});