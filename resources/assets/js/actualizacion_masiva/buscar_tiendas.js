$('#zona_masiva').click(function()
{
    var id_zona=$('#zona_masiva').val();
    var url = getAbsolutePath() + 'buscar_tiendas';

    $.ajax({
        url: url,
        type: 'GET',
        data: {
            id_zona: id_zona,
        },
        dataType: 'json',
        success: function (respuesta) {
            if(respuesta==1){
                $('#tienda_masiva').prop('disabled',true);
                return(false);
            }else{
                $('#tienda_masiva').html(respuesta);
                $('#tienda_masiva').prop('disabled',false);
            }
        }//fin del success
    });//fin de ajax  
});