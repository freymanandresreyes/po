/* TODO: *********************************************
   ********** CODIGO PARA DEVOLUCIONES *********
   FIXME: ******************************************** */

//    alert('ok');
$("#numero_factura_devolucion").keypress(function (e) {
    if (e.which == 13) {
        var nFactura = $("#numero_factura_devolucion").val();
        var url = getAbsolutePath() + 'buscar_factura';
        
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                nFactura: nFactura
            },
            dataType: 'json',
            success: function (respuesta) {
                console.log(respuesta);
                $('#contenido_factura').html(respuesta);
                var Nregistros = Object.keys(respuesta).length;
                var url = getAbsolutePath() + 'datos_cliente';
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        nFactura: nFactura
                    },
                    dataType: 'json',
                    success: function (respuesta) {
                        $("#nombre_cliente").val(respuesta[0]['nombres']);
                        $("#cedula_cliente").val(respuesta[0]['documento']);
                        $("#direccion_cliente").val(respuesta[0]['direccion']);
                        $("#id_cliente").val(respuesta[0]['id']);
                    }//fin del success
                });//fin de ajax
                

            }//fin del success
        });//fin de ajax
        e.preventDefault();
        return (e.which != 13);
    }
});



$("#contenido_factura").on("click", ".boton-devoluciones", function () {
    
    
    var valores = []
    // capturamos el la fila seleccionada 
    $(this).parents("tr").find("td").each(function () {
        var celda = $(this).html() + "\n";
        valores.push(celda);
    });
  
    // gregamos la informacion al modal
    var fecha = $('#fecha').val(valores[0]);
    var producto = $('#producto').val(valores[1]);
    var referencia = $('#referencia').val(valores[2]);
    var valor = $('#valor').val(valores[3]);
    var cantidad = $('#cantidad').val(valores[4]);



    $("#modal_devolucion").addClass("show");

    $("#modal_devolucion").css({
        "display": "block",
        "padding-right": "16px",
        "background": "rgba(0, 0, 0, 0.5)"
    });
});

$('#cerrar_devolucion').click(function () {
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

    $('#alerta_devolucion').css({
        "display": "none"
    })
});

//registrar devoluciones
$('#registrar_devolucion').click(function () {
    
    var producto = $('#producto').val();
    var referencia = $('#referencia').val();
    var valor = $('#valor').val();
    var cantidad = parseInt($('#cantidad').val());
    // alert(cantidad);
    var cantidad_devolucion = cantidad;
    var descripcion_devolucion = $('#descripcion_devolucion').val();
    var suma = cantidad + cantidad_devolucion;
    console.log("la SUMA ES: " + suma);


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
// guardar devolucion
$('#guardar_devolucion').click(function () {
    // ****** VARIABLES ******
    var factura = $('#numero_factura_devolucion').val();
    var id_cliente = $('#id_cliente').val();
    var data = Array();
    $("#encabezado_devoluciones tr").each(function (i, v) {
        data[i] = Array();
        $(this).children('td').each(function (ii, vv) {
            data[i][ii] = $(this).text();
        });
    });
    data.splice(0, 1);
    


    // ********* INICIO AJAX ************
    var url = getAbsolutePath() + 'guardar_devolucion';
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
            setTimeout("location.href='crear_devoluciones'");


        }//fin del success
    });//fin de ajax

    //  *********** FIN AJAX **************
    // location.reload();
});


$('#tabla_devolucion').on("click", ".ver", function () {
    
    var identificador = $(this).attr('name');
    

    // ********* INICIO AJAX ************
    var url = getAbsolutePath() + 'editar_devolucion';

    $.ajax({
        url: url,
        type: 'GET',
        data: {
            identificador: identificador
        },
        dataType: 'json',
        success: function (respuesta) {
            // console.log(respuesta);
            descarga();
            if (respuesta) {
                completo();
                $('#id_modal').val(respuesta['id']);
                $('#producto_modal').val(respuesta['producto']);
                $('#motivo_modal').val(respuesta['descripcion_recibo']);
                $('#estado_modal').val(respuesta['estado']);

                $("#modal_devolucion").addClass("show");

                $("#modal_devolucion").css({
                    "display": "block",
                    "padding-right": "16px",
                    "background": "rgba(0, 0, 0, 0.5)"
                });
            }

            // $('#contenido_factura').html(respuesta);
        }//fin del success
    });//fin de ajax
    //  *********** FIN AJAX **************
});

$('#cerrar_devolucion').click(function () {
    $("#modal_devolucion").removeClass("show");
    $("#modal_devolucion").css({
        "display": "none",

    });
    $('#respuesta_modal').val("");
});

$('#actualizar_devolucion').click(function () {
    
    var id = $('#id_modal').val();
    var estado = $('#estado_modal').val();
    var comentario = $('#respuesta_modal').val();
    //  *********** INICIO AJAX **************
    var url = getAbsolutePath() + 'editar_devolucion_guardar';

    $.ajax({
        url: url,
        type: 'GET',
        data: {
            id: id,
            estado: estado,
            comentario: comentario

        },
        dataType: 'json',
        success: function (respuesta) {
            console.log(respuesta);
            descarga();
            if (respuesta) {
                completo();
                $('#id_modal').val(respuesta['id']);
                $('#producto_modal').val(respuesta['producto']);
                $('#motivo_modal').val(respuesta['descripcion_recibo']);
                $('#estado_modal').val(respuesta['estado']);

                $("#modal_devolucion").addClass("show");

                $("#modal_devolucion").css({
                    "display": "block",
                    "padding-right": "16px",
                    "background": "rgba(0, 0, 0, 0.5)"
                });
                
            }

            // $('#contenido_factura').html(respuesta);
        }//fin del success
        
    });//fin de ajax
    //  *********** FIN AJAX **************

    $("#modal_devolucion").removeClass("show");
    $("#modal_devolucion").css({
        "display": "none",

    });
    $('#respuesta_modal').val("");
    setTimeout("location.href='ver_devolucion'");
});