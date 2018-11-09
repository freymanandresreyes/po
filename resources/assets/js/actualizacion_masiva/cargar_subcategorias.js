$('#categoria_masiva').click(function()
{
    var id_categoria=$('#categoria_masiva').val();
    var url = getAbsolutePath() + 'cargar_subcategorias';
    if(id_categoria==""){
        $('#columna_masiva').prop('disabled',true);
        return(false);
    }
    $.ajax({
        url: url,
        type: 'GET',
        data: {
            id_categoria: id_categoria,
        },
        dataType: 'json',
        success: function (respuesta) {
                $('#subcategoria_masiva').html(respuesta);
                $('#subcategoria_masiva').prop('disabled',false);
        }//fin del success
    });//fin de ajax  
});