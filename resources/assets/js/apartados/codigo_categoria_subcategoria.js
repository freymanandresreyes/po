
// FUNCION PARA ABRIR MODAL AGREGAR UNA CATEGORIA
$('#agregar_categoria_compras').click(function(){
  
    $( "#modal-categoria" ).addClass( "show" );
  
    $("#modal-categoria").css({
      "display": "block",
      "padding-right": "16px",
      "background": "rgba(0, 0, 0, 0.5)"
    });
  });
  // FUNCION PARA CERRAR MODAL AGREGAR UNA CATEGORIA
  $('#cerrar-categoria').click(function(){
    $( "#modal-categoria" ).removeClass( "show" );
  
    $("#modal-categoria").css({
      "display": "none"
    });
  
    $('#error-categoria').removeClass('error');
    $('#categoria-modal').attr("placeholder", "");
  });
  
  // FUNCION PARA GUARDAR UNA CATEGORIA
  $('#guardar_categoria_compras').click(function(){
    var categoria = $( "#categoria_modal_crear" ).val();
    var tienda = $("#tienda_c_p").val();
    console.log(categoria);
    if (categoria == "") {
      $('#error-categoria').addClass('error');
  
      $('#categoria-modal').attr("placeholder", "Este campo es requerido");
  
    }else{
      var url = getAbsolutePath()+'nueva_categoria_compras';
  
      $.ajax({
        url: url,
        type: 'GET',
        data: {
          categoria: categoria,
          tienda: tienda
        },
        dataType: 'json',
        success: function(respuesta){
         console.log(respuesta);
         $('#categoria_modal').html(respuesta);
         
        }//fin del success
      });//fin de ajax
      $( "#modal-categoria" ).removeClass( "show" );
  
    $("#modal-categoria").css({
      "display": "none"
    });
    $( "#categoria_modal_crear" ).val("");
    }// fin else
  });
  
  //*************************************************
  //************************************************* */
  
  // FUNCION PARA ABRIR MODAL AGREGAR UNA SUBCATEGORIA
  $('#agregar-subcategoria').click(function(){
    
    $( "#modal-subcategoria" ).addClass( "show" );
  
    $("#modal-subcategoria").css({
      "display": "block",
      "padding-right": "16px",
      "background": "rgba(0, 0, 0, 0.5)"
    });
  });
  // FUNCION PARA CERRAR MODAL AGREGAR UNA SUBCATEGORIA
  $('#cerrar-subcategoria').click(function(){
    $( "#modal-subcategoria" ).removeClass( "show" );
  
    $("#modal-subcategoria").css({
      "display": "none"
    });
  
    $('#error-subcategoria').removeClass('error');
    $('#subcategoria-modal').attr("placeholder", "");
  });
  
  // FUNCION PARA GUARDAR UNA SUBCATEGORIA
  $('#guardar_subcategoria_compras').click(function(){
    var categoria = $( "#subcategoria-modal" ).val();
    console.log(categoria);
    if (categoria == "") {
      $('#error-subcategoria').addClass('error');
      $('#subcategoria-modal').attr("placeholder", "Este campo es requerido");
    }else{
      var id_categoria = $('#categoria_modal').val();
      var subcategoria_nombre = $('#subcategoria_modal_crear').val();
      var tienda = $("#tienda_c_p").val();
      var url = getAbsolutePath()+'nueva_subcategoria_compras';
  
  
  
      $.ajax({
        url: url,
        type: 'GET',
        data: {
          id_categoria: id_categoria,
          subcategoria_nombre: subcategoria_nombre,
          tienda: tienda
        },
        dataType: 'json',
        success: function(respuesta){
         console.log(respuesta);
         $('#subcategoria_modal').html(respuesta);
         $('#subcategoria').attr("disabled", false);
        }//fin del success
      });//fin de ajax
      $( "#modal-subcategoria" ).removeClass( "show" );
  
    $("#modal-subcategoria").css({
      "display": "none"
    });
    $('#subcategoria-modal').val("");
    }// fin else
  });