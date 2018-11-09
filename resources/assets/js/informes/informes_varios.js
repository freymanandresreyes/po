$('#informe_tienda_select').click(function(){
    var tienda = $('#informe_tienda_select').val();

    if (tienda) {

        var url= URLdominio+'buscar_categoria_varios';
   $.ajax({
     url:url,
     type: 'GET',
     data: {
        tienda: tienda,
     },
     dataType: 'json',
     success: function(respuesta){
        // console.log(respuesta);
        $('#producto_varios').html(respuesta);
 
     }
    });//fin ajax
        
    }
});