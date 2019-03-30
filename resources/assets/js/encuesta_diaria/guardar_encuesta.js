$('#guardar_encuesta').click(function () {

    $('#guardar_encuesta').prop('disabled',true);

    var pregunta1 = $('#pregunta1').val();
    var pregunta2 = $('#pregunta2').val();
    var pregunta3 = $('#pregunta3').val();
    var id_formulario = $('#id_formulario').val();
    var referencia1 = $('#referencia1').val();
    var referencia2 = $('#referencia2').val();
    var respuesta1 = $('#respuesta1').val();
    var respuesta2 = $('#respuesta2').val();
    var respuesta3 = $('#respuesta3').val();
    var informe_tienda_select = $('#informe_tienda_select').val();

    var url = URLdominio + 'guardar_encuesta';

    if(informe_tienda_select=="" || respuesta1==null || respuesta2==null || respuesta3==null)
    {
        alertify.error("TODOS LOS CAMPOS SON OBLIGATORIOS.");
        $('#guardar_encuesta').prop('disabled',false);
        return false;
    }
    else
    {
    $.ajax({
        url: url,
        type: 'GET',
        data: {
            pregunta1:pregunta1,
            pregunta2:pregunta2,
            pregunta3:pregunta3,
            informe_tienda_select:informe_tienda_select,
            id_formulario:id_formulario,
            referencia1:referencia1,
            referencia2:referencia2,
            respuesta1:respuesta1,
            respuesta2:respuesta2,
            respuesta3:respuesta3
        },
        dataType: 'json',
        success: function (respuesta) {
            $( "#modal_encuesta_diaria" ).removeClass( "show" );
            $("#modal_encuesta_diaria").css({
              "display": "none"
            });
            alertify.success("DATOS ALMACENADOS CORRECTAMENTE.");
            $('#guardar_encuesta').prop('disabled',false);
        }
    });
    }
});