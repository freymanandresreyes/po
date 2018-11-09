$('#tienda_masiva').click(function()
{
    var id_tienda=$('#tienda_masiva').val();
    var url = getAbsolutePath() + 'cargar_categorias';
    if(id_tienda==""){
        $('#columna_masiva').prop('disabled',true);
        return(false);
    }
    $.ajax({
        url: url,
        type: 'GET',
        data: {
            id_tienda: id_tienda,
        },
        dataType: 'json',
        success: function (respuesta) {
                $('#categoria_masiva').html(respuesta);
                $('#categoria_masiva').prop('disabled',false);
        }//fin del success
    });//fin de ajax  
});