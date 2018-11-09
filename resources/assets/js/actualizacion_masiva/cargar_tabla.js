$('#tienda_masiva').click(function()
{
    var id_tienda=$('#tienda_masiva').val();
    var url = getAbsolutePath() + 'cargar_tabla';
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
            
                $('#tabla').html(respuesta);
                $('#tabla_masiva').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
                });
        }//fin del success
    });//fin de ajax  
});