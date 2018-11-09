$('.ver_remision').on('click', function(){
 var conse = $(this).attr('name');
 var url = URLdominio+'informe_remision';
 $.ajax({
     url: url,
     type: 'POST',
     headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
     data: {
         conse: conse
        },
        dataType: 'json',
        success: function(respuesta){
            // alert('ok');
    if(respuesta)
    {
        $('#datos_remision').html(respuesta);
        // alert(respuesta);
        // *********** MODAL VENTA ***********
    $("#modal_remision").addClass("show");

    $("#modal_remision").css({
        "display": "block",
        "padding-right": "16px",
        "background": "rgba(0, 0, 0, 0.5)"
    });
    // *********** FIN MODAL VENTA *******
    }
    }//fin del success
  });//fin de ajax

});

$('#cerrar_remision').on('click', function(){
    $("#modal_remision").removeClass("show");

    $("#modal_remision").css({
        "display": "none",
        "padding-right": "16px",
        "background": "rgba(0, 0, 0, 0.5)"
    });
});
$('#imprimir_remision').on('click', function(){
    window.print();

    location.reload();
});

