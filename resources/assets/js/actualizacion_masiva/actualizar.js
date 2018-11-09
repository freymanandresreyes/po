$('#actualizar_masiva').click(function()
{
    var id_tienda=$('#tienda_masiva').val();
    var id_categoria=$('#categoria_masiva').val();
    var id_subcategoria=$('#subcategoria_masiva').val();
    var columna=$('#columna_masiva').val();
    var dato=$('#dato_masiva').val();
    
    var url = getAbsolutePath() + 'actualizar_masivamente';
    if(id_tienda=="" || id_categoria=="" || id_subcategoria=="" || columna=="" || dato==""){
        alertify.error("NO PUEDEN HABER CAMPOS VACIOS.");
        return(false);
    }
    $.ajax({
        url: url,
        type: 'GET',
        data: {
            id_tienda: id_tienda,
            id_categoria: id_categoria,
            id_subcategoria: id_subcategoria,
            columna: columna,
            dato: dato,
        },
        dataType: 'json',
        success: function (respuesta) {
            if(respuesta==0){
                alertify.error("LA COLUMNA QUE QUIERES ACTUALIZAR ESTA ACTUALMENTE VACIA.");
            }
            else if(respuesta=1){
                alertify.success("DATOS ACTUALIZADOS.");
                setTimeout("location.href='vista_actulizacion_masiva'");
                return(false);
            }

        }//fin del success
    });//fin de ajax  
});