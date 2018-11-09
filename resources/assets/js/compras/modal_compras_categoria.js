$('#categoria_modal').click(function () {
    // alert('ok');
    var tienda = $('#tienda_c_p').val();
    var categoria = $('#categoria_modal').val();

    if (tienda) {

        var url = URLdominio + 'consulta_subcategoria_modal';
        // FIN FUNCION GLOBAL
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                tienda: tienda,
                categoria: categoria
            },
            dataType: 'json',
            success: function (respuesta) {

                if (respuesta) {
                    $('#subcategoria_modal').html(respuesta);

                } else {
                    $('#proveedor').append('<option value="' + respuesta.id + '" selected="selected">' + respuesta.nombre + '</option>');
                    alertify.success("PROVEEDOR CREADO EXITOSAMENTE.");
                }

            }//fin del success
        });//fin de ajax

    } else {
        alertify.error("DEBE SELECCIONAR UNA TIENDA.");
        return (false);
    }
});