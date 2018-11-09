
//alert(URLdomain);
// *************** PRELOADER PARA AJAX *****************
function descarga(){
  $('#descarga').css({
    'display': 'block'
  });
}
function completo(){
    $('#descarga').css({
    'display': 'none'
  });
}

$("#cerrar_factura").click(function (e) {
  //alert('hola');
  $("#modal_factura").removeClass("show");
  $("#modal_factura").css({
    "display": "none"
  });
  console.log("este es el numero de factura - saliendo" + $('#numero_factura').html());
  e.preventDefault();

});




