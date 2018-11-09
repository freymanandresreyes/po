//captura la direccion del servidor
function getAbsolutePath() {
    var loc = window.location;
    var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
    return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
}
var URLdominio = getAbsolutePath();
//alert(URLdomain);

$('#categoria').click(function(){
  var categoria = $('#categoria').val();
  // console.log("valor categoria es: " + categoria);
  var url = getAbsolutePath()+'buscar_categorias';
  
  if(categoria == 0 || categoria == null || categoria.length == 0){
    // console.log("dentro de categoria");
    $('#agregar-subcategoria').attr("disabled", true);
    $('#subcategoria').attr("disabled", true);
    return false;
  }else{

  if(categoria.length != 0){
    // console.log("dentro de ajax");
    $.ajax({
      url: url,
      type: 'GET',
      data: {
        categoria: categoria
      },
      dataType: 'json',
      success: function(respuesta){
      //  console.log(respuesta);
       var conteo_array = respuesta.length;
       if(conteo_array == 0){
         alertify.error("No se encontraron subcategorias.");
         $('#subcategoria').attr('disabled',true);
         $('#agregar-subcategoria').attr('disabled',false);
       }else{
         $('#subcategoria').html(respuesta);
         $('#subcategoria').attr('disabled',false);
         $('#agregar-subcategoria').attr("disabled", false);
       }
      //  console.log('tiene:'+ conteo_array);
      }//fin del success
    });//fin de ajax
  }
}
});

// FUNCION PARA ABRIR MODAL AGREGAR UNA CATEGORIA
$('#agregar-categoria').click(function(){
  
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
$('#guardar-categoria').click(function(){
  var categoria = $( "#categoria-modal" ).val();
  console.log(categoria);
  if (categoria == "") {
    $('#error-categoria').addClass('error');

    $('#categoria-modal').attr("placeholder", "Este campo es requerido");

  }else{
    var url = getAbsolutePath()+'nueva_categoria';

    $.ajax({
      url: url,
      type: 'GET',
      data: {
        categoria: categoria
      },
      dataType: 'json',
      success: function(respuesta){
       console.log(respuesta);
       $('#categoria').html(respuesta);
       
      }//fin del success
    });//fin de ajax
    $( "#modal-categoria" ).removeClass( "show" );

  $("#modal-categoria").css({
    "display": "none"
  });
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
$('#guardar-subcategoria').click(function(){
  var categoria = $( "#subcategoria-modal" ).val();
  console.log(categoria);
  if (categoria == "") {
    $('#error-subcategoria').addClass('error');
    $('#subcategoria-modal').attr("placeholder", "Este campo es requerido");
  }else{
    var id_categoria = $('#categoria').val();
    var url = getAbsolutePath()+'nueva_subcategoria';



    $.ajax({
      url: url,
      type: 'GET',
      data: {
        id_categoria: id_categoria,
        categoria: categoria
      },
      dataType: 'json',
      success: function(respuesta){
       console.log(respuesta);
       $('#subcategoria').html(respuesta);
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

// FUNCION PARA OFERTAS
$('#oferta').click(function(){
  
  var oferta = $("#oferta").val();
  if (oferta == 1 || oferta == "") {
    $('#fechaInicio').attr('disabled',true);
    $('#fechaFin').attr('disabled',true);
    $('#descuento').attr('disabled',true);
  }else{
    $('#fechaInicio').attr('disabled',false);
    $('#fechaFin').attr('disabled',false);
    $('#descuento').attr('disabled',false);
  }// fin else
});

//********** funciones para administrar 
// ofertas segun parametros de busqueda 


// FUNCION PARA GUARDAR UNA SUBCATEGORIA
$('#vista').click(function(){
  var categoria = $( "#categoria" ).val();
  var subcategoria = $( "#subcategoria" ).val();
  var titulo = $( "#titulo" ).val();
  
  var url = getAbsolutePath()+'buscar_producto';

    $.ajax({
      url: url,
      type: 'GET',
      data: {
        categoria: categoria,
        subcategoria: subcategoria,
        titulo: titulo
      },
      dataType: 'json',
      success: function(respuesta){
       console.log(respuesta);
       $('#myTable').html(respuesta);
      }//fin del success
    });//fin de ajax
});
//actualizar promocion
$('#actualizar-promo').click(function(){
  var categoria = $( "#categoria" ).val();
  var subcategoria = $( "#subcategoria" ).val();
  var titulo = $( "#titulo" ).val();
  var valor_promo = $("#valor-promo").val();
  
  var url = getAbsolutePath()+'actualizar_oferta';

    $.ajax({
      url: url,
      type: 'GET',
      data: {
        categoria: categoria,
        subcategoria: subcategoria,
        titulo: titulo,
        valor_promo: valor_promo
      },
      dataType: 'json',
      success: function(respuesta){
      //  console.log(respuesta);
       $('#myTable').html(respuesta);
      }//fin del success
    });//fin de ajax
});