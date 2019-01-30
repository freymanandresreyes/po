// guardar devolucion
$('#guardar_devolucion2018').click(function () {

    $('#guardar_devolucion2018').attr('disabled',true);
    // ****** VARIABLES ******
    var tipo = $('#tipo_devolucion').val();
    
    var factura = $('#numero_factura_devolucion').val();
    var id_cliente = $('#id_cliente').val();
    var data = Array();

    if(tipo==""){
        alertify.error("EL CAMPO TIPO ES OBLIGATORIO.");
        return false;
    }

    $("#encabezado_devoluciones tr").each(function (i, v) {
        data[i] = Array();
        $(this).children('td').each(function (ii, vv) {
            data[i][ii] = $(this).text();
        });
    });
    data.splice(0, 1);
    


    // ********* INICIO AJAX ************
    var url = getAbsolutePath() + 'guardar_devolucion2018';
    $.ajax({
        url: url,
        type: 'GET',
        data: {
            data: data,
            id_cliente: id_cliente,
            factura: factura
        },
        dataType: 'json',
        success: function (respuesta) {
            
            // $('#contenido_factura').html(respuesta);
            setTimeout("location.href='decoluciones2018'");
            // location.reload();


        }//fin del success
    });//fin de ajax

    //  *********** FIN AJAX **************
    // location.reload();
});






//registrar devoluciones
$('#registrar_devolucion2018').click(function () {
    
    var tipo = $('#tipo_devolucion').val();

    var producto = $('#producto').val();
    var referencia = $('#referencia').val();
    var valor = $('#valor').val();
    var cantidad = parseInt($('#cantidad').val());
    // alert(cantidad);
    var cantidad_devolucion = cantidad;
    var descripcion_devolucion = $('#descripcion_devolucion').val();
    var suma = cantidad + cantidad_devolucion;
    console.log("la SUMA ES: " + suma);

    if(tipo == "" || tipo == null){
        alertify.error("Debes colocar un tipo.");
        return false;
    }
    if(descripcion_devolucion == ""){
        alertify.error("Debes colocar una descripcion.");
        return false;
    }

    if (cantidad_devolucion == "" || cantidad_devolucion == null) {
        $('#alerta_devolucion').css({
            "display": "block"
        })
    } else {
        if (cantidad_devolucion > cantidad & cantidad_devolucion > 0) {
            $('#alerta_devolucion').css({
                "display": "block"
            })
        }
        if (cantidad_devolucion <= cantidad & cantidad_devolucion > 0) {
            var conteo = $('#encabezado_devoluciones tr:last');

            //  e.preventDefault();
            var fila = '<tr class="dato"><td> ' +
                producto +
                '</td><td>' + referencia +
                '</td><td>' + valor +
                '</td><td>' + cantidad_devolucion +
                '</td><td>' + descripcion_devolucion +
                '</td><td>' + tipo +
                '</td><td><button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button></td></tr>';
            //alert(fila);
            conteo.after(fila);

            //cerrar el modar y resetear
            $("#modal_devolucion").removeClass("show");
            $("#modal_devolucion").css({
                "display": "none",
            });
            var fecha = $('#fecha').val("");
            var producto = $('#producto').val("");
            var referencia = $('#referencia').val("");
            var valor = $('#valor').val("");
            var cantidad = $('#cantidad').val("");
            var cantidad_devolucion = $('#cantidad_devolucion').val("");
            var descripcion_devolucion = $('#descripcion_devolucion').val("");
        }//fin if()

    }
});