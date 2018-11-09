$('#informe_zona').click(function () {
    var zona = $('#informe_zona').val();
    console.log(zona);
    if (zona == null || zona == "") {
        console.log('pase');
        $('#informe_tienda_select').attr('disabled', true);
        $('#informe_tienda_select').val("");
    } else {
        var url = URLdominio + 'tiendas_zonas';
        console.log(url);
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                zona: zona
            },
            dataType: 'json',
            success: function (respuesta) {
                console.log(respuesta);
                if (respuesta.length == 0) {
                    ç
                    console.log('pase');
                    $('#informe_tienda_select').attr('disabled', true);
                    $('#informe_tienda_select').val("");
                } else {
                    // $('#informe_tienda');
                    $('#informe_tienda_select').html(respuesta);
                    $('#informe_tienda_select').attr('disabled', false);
                }

            }

        });
    }
});


$('#buscar_informe_diario_zonas').click(function () {
    var tienda = $('#informe_tienda_select').val();
    var inicio = $('#fecha_inicio').val();
    var fin = $('#fecha_fin').val();

    var url = URLdominio + 'generar_informe_diario_zonas';
    console.log(url);
    $.ajax({
        url: url,
        type: 'GET',
        data: {
            tienda: tienda,
            inicio: inicio,
            fin: fin
        },
        dataType: 'json',
        success: function (respuesta) {
            console.log(respuesta);
            $('#informe_general_diario').html(respuesta);
        }
    });
});

//FUNCION PARA IMPRIMIR

$('#imprimir_informe_diario_zonas').click(function (e) {
    var tienda = $('#informe_tienda_select').val();
    var fecha_inicio = $('#fecha_inicio').val();
    var fecha_fin = $('#fecha_fin').val();

    if (fecha_inicio == "" || fecha_fin == "") {
        alertify.alert("<b>Se debe elejir un rango de fechas.", function () {
            return false;
        });
    } else {
        var url = URLdominio + 'informe_diario_imprimir_zona';
        console.log(url);
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                tienda: tienda,
                fecha_inicio: fecha_inicio,
                fecha_fin: fecha_fin,

            },
            dataType: 'json',
            success: function (respuesta) {
                console.log(respuesta);
                $('#vista_info_diario').html(respuesta);

                window.print();
                $('#vista_info_diario').html("");
            }

        });
    }

});