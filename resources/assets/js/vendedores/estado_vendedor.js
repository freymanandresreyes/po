$('#vendedores_tabla').on('click', '.eliminar_vendedor', function (event) {
    var id_vendedor = this.name;
    var url = getAbsolutePath() + 'estado_vendedor';
    
    $.ajax({
        url: url,
        type: 'GET',
        data: {
            id_vendedor: id_vendedor,
        },
        dataType: 'json',
        success: function (respuesta) {
            if(respuesta==1)
            {
            alertify.success("ESTADO ACTUALIZADO CON EXITO!!.");
            setTimeout("location.href='vista_vendedores'");
            return(false);
            }
        }//fin del success
    });//fin de ajax  
  });