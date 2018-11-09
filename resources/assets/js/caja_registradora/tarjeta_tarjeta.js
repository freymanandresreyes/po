$('#radio_selec_pago').on('click', function () {
    setTimeout(function () {

        var tipo = $("input[name='pago']:checked").val();

        var url = getAbsolutePath() + 'buscar_banco';

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                id_pago: tipo,

            },
            dataType: 'json',
            success: function (respuesta) {
                $('#lista_bancos').html(respuesta);

            }//fin del success
        });//fin de ajax

    }, 300);


});
$('#radio_selec_pago_dos').on('click', function () {
    var tipo = $("input[name='pago2']:checked").val();

    var url = getAbsolutePath() + 'buscar_banco';

    $.ajax({
        url: url,
        type: 'GET',
        data: {
            id_pago: tipo,

        },
        dataType: 'json',
        success: function (respuesta) {
            $('#lista_bancos_dos').html(respuesta);

        }//fin del success
    });//fin de ajax

});

