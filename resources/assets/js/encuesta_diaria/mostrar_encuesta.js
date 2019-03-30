$('#buscar_informe_diario_zonas').click(function () {
    var fecha_inicio = $('#fecha_inicio').val();
    var fecha_fin = $('#fecha_fin').val();
    var informe_tienda_select = $('#informe_tienda_select').val();
    var url = URLdominio + 'traer_encuesta';

    if(informe_tienda_select=="" || fecha_inicio=="" || fecha_fin=="")
    {
        alertify.error("TODOS LOS CAMPOS SON OBLIGATORIOS.");
        return false;
    }
    else
    {
    $.ajax({
        url: url,
        type: 'GET',
        data: {
            fecha_inicio:fecha_inicio,
            fecha_fin:fecha_fin,
            informe_tienda_select:informe_tienda_select
        },
        dataType: 'json',
        success: function (respuesta) {
            $('#cargar_encuesta').html(respuesta);
            $("#modal_encuesta_diaria" ).addClass( "show" );
            $("#modal_encuesta_diaria").css({
                        "display": "block",
                        "padding-right": "16px",
                        "background": "rgba(0, 0, 0, 0.5)"
                    });
        }
    });
    }
});