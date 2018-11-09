
$(function() {
    $(document).on('click', 'input[type="button"]', function(event) {
       let id = this.id;
       var url= URLdominio+'ver_factura_compra';
    //    console.log(id)
    //    alert(id);
       $.ajax({
    
        url: url,
        type: 'GET',
        data: {
          id : id
        },
        dataType: 'json',
        success: function(respuesta){
            $('#datos_factura').html(respuesta);
        }
      });//FIN AJAX

      $( "#modal_factura_compra" ).addClass( "show" );

      $("#modal_factura_compra").css({
        "display": "block",
        "padding-right": "16px",
        "background": "rgba(0, 0, 0, 0.5)"
      });

      $('#imprimir_factura_compra').click(function()
    {
      $("#modal_factura_compra").css({
        "display": "block",
        "padding-right": "0px",
        "background": "#fff"
      });
        window.print();
        $( "cerrar_factura" ).removeClass( "show" );
        $("#modal_factura_compra").css({
          "display": "none"});
    });
    
      $( "#cerrar_factura" ).click(function() {
        $( "cerrar_factura" ).removeClass( "show" );
        $("#modal_factura_compra").css({
          "display": "none"
        });
      });
     });
   });