
// *******
// FUNCION PARA VER LAS FACTURAS
$('#id_facturas .verFactura').on('click', function (e) {
    var seleccion = $(this).attr('name');
    var url = getAbsolutePath() + 'factura_show';

    $.ajax({
        url: url,
        type: 'GET',
        data: {
            seleccion: seleccion,
        },
        dataType: 'json',
        success: function (respuesta) {
            //console.log(respuesta);
            $('#nueva_factura').html(respuesta);
            $('#fact_recuperada_imprimir').html(respuesta);
            console.log(respuesta);

        }//fin del success
    });//fin de ajax
    $("#modal_factura").addClass("show");

    $("#modal_factura").css({
        "display": "block",
        "padding-right": "16px",
        "background": "rgba(0, 0, 0, 0.5)"
    });
})



$('#print-factura-recuperado').click(function () {
    window.print();
    setTimeout(function () {
        location.reload();
    }, 100);
});

$("#cerrar_factura_recuperados").click(function (e) {
    alert('hola');
    $("#modal_factura").removeClass("show");
    $("#modal_factura").css({
      "display": "none"
    });
    console.log("este es el numero de factura - saliendo" + $('#numero_factura').html());
    e.preventDefault();
  
  });