$('#tabla_devolucion').on("click", ".entregar", function () {
    // alert("hola");

    $(".entregar").attr('disabled',true);
   
    var identificador = $(this).attr('name');

    // ********* INICIO AJAX ************
    var url = getAbsolutePath() + 'cambio';
 
    $.ajax({
        url: url,
        type: 'GET',
        data: {
            identificador: identificador
        },
        dataType: 'json',
        success: function (respuesta) {
            alertify.log("DATOS ALMACENADOS CORRECTAMENTE.");
            setTimeout("location.href='entregar_devolucion'");
            return(false);
        }
    });//fin de ajax
    //  *********** FIN AJAX **************
});