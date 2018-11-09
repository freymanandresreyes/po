$('#opciones_remisiones').on('click', function(){
  var opcion = $(this).val();

  if (opcion == 1) {
      //traslado
      $('#t_r_uno').css({
        "display":"block"
    });
    $('#i_r_uno').css({
        "display":"block"
    });
    $('#t_r_dos').css({
        "display":"none"
    });
    $('#i_r_dos').css({
        "display":"none"
    });

    $('#tienda_remisiones').prop('disabled', false);
    $('#proveedor_remisiones').prop('disabled', true);
    $('#tienda_remisiones').val('');
    $('#proveedor_remisiones').val('');
    $('#codigo_remision').prop('disabled', false);
    $('#codigo_remision').val('');
      
  }else if(opcion == 2){
      //remisión

      $('#t_r_uno').css({
          "display":"none"
      });
      $('#i_r_uno').css({
          "display":"none"
      });
      $('#t_r_dos').css({
          "display":"block"
      });
      $('#i_r_dos').css({
          "display":"block"
      });

    $('#tienda_remisiones').prop('disabled', true);
    $('#proveedor_remisiones').prop('disabled', false);
    $('#tienda_remisiones').val('');
    $('#proveedor_remisiones').val('');

    $('#codigo_remision').prop('disabled', false);
    $('#codigo_remision').val('');
     

  }else if(opcion == ""){
    $('#t_r_uno').css({
        "display":"none"
    });
    $('#i_r_uno').css({
        "display":"none"
    });
    $('#t_r_dos').css({
        "display":"block"
    });
    $('#i_r_dos').css({
        "display":"block"
    });

   
    $('#tienda_remisiones').prop('disabled', true);
    $('#proveedor_remisiones').prop('disabled', true);
    $('#codigo_remision').prop('disabled', true);
    $('#cantidad_remision').prop('disabled', true);
    $('#codigo_remision').val('');
    $('#tienda_remisiones').val('');
    $('#proveedor_remisiones').val('');
    $('#precio_remision').val('');
    $('#cantidad_remision').val('');
    
  }
});