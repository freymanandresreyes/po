//captura la direccion del servidor
function getAbsolutePath() {
  var loc = window.location;
  var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
  return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
}
var URLdominio = getAbsolutePath();
//alert(URLdomain);


//FUNCION PARA MOSTRAR Y OCULTAR EL MODAL DE NUEVA TIENDA
$("#crear_tienda").click(function() {

  // $('#guardar_tienda').css("display", "block");

  // $('#actualizar_tienda').css("display", "none");

  // document.getElementById("form").reset();

  $("#guardar_tienda").html("Guardar");
  $("#guardar_tienda").removeClass('btn btn-success waves-effect waves-light')
  $("#guardar_tienda").addClass("btn btn-info waves-effect waves-light")

  $( "#modal_tienda" ).addClass( "show" );

  $("#modal_tienda").css({
    "display": "block",
    "padding-right": "16px",
    "background": "rgba(0, 0, 0, 0.5)"
  });

});

$( "#cerrar_tienda" ).click(function() {
  $( "cerrar_tienda" ).removeClass( "show" );
  $("#modal_tienda").css({
    "display": "none"
  });
});

// funcion crear una tienda
$( "#guardar_tienda" ).click(function() {

  var nombre_tienda = $("#nombre_tienda").val();
  var encargado = $("#encargado").val();
  var telefono = $("#telefono").val();
  var direccion_tienda = $("#direccion").val();
  var ciudad = $("#ciudad").val();
  var resolucion = $("#resolucion").val();
  var fecha_resolucion = $("#fecha_resolucion").val();
  var prefijo = $("#prefijo").val();
  var nit_tienda = $("#nit").val();
  var slug = $("#slug").val();
  var grupo = $("#grupo").val();

  if (nombre_tienda != "" & encargado != "" & direccion_tienda != "" & ciudad != "" & nit_tienda != "" & slug != "" & resolucion != "" & fecha_resolucion != "" & prefijo!="" & telefono!="") {
    // FUNCION PARA MENSAJE DE ALERTA AL CREAR UNA NUEVA TIENDA
    alertify.log("TIENDA CREADA CON EXITO.");
  }
});//FIN FUNCION CREAR TIENDA





//FUNCION EDITAR UNA TIENDA

$("#editar_tienda a").click(function(e) {

  var id = $(this).attr('value');
  var url= URLdominio+'buscar_tienda';

  $('#actualizar_tienda').css("display", "block");

  $('#guardar_tienda').css("display", "none");
  // alert(h);
// alert("hola");

  $.ajax({
    
    url: url,
    type: 'GET',
    data: {
      id : id
    },
    dataType: 'json',
    success: function(respuesta){
      if(respuesta)
      {
        $("#id").val(respuesta['id']);
        $("#nombre_tienda").val(respuesta['nombre_tienda']);
        $("#encargado").val(respuesta['encargado']);
        $("#telefono").val(respuesta['telefono']);
        $("#nit").val(respuesta['nit_tienda']);
        $("#resolucion").val(respuesta['resolucion']);
        $("#fecha_resolucion").val(respuesta['fecha_resolucion']);
        $("#prefijo").val(respuesta['prefijo']);
        $("#direccion").val(respuesta['direccion_tienda']);
        $("#ciudad").val(respuesta['ciudad']);
        $("#slug").val(respuesta['slug']);
        
      }
    }
  });//FIN AJAX


  $( "#modal_tienda" ).addClass( "show" );

  $("#modal_tienda").css({
    "display": "block",
    "padding-right": "16px",
    "background": "rgba(0, 0, 0, 0.5)"
  });

  $( "#cerrar_tienda" ).click(function() {
    $( "cerrar_tienda" ).removeClass( "show" );
    $("#modal_tienda").css({
      "display": "none"
    });
  });


e.preventDefault();
});//FUNCION PARA EDITAR UNA TIENDA



  $( "#actualizar_tienda" ).click(function() {

    var id = $("#id").val();
    var nombre_tienda = $("#nombre_tienda").val();
    var encargado = $("#encargado").val();
    var direccion_tienda = $("#direccion").val();
    var telefono = $("#telefono").val();
    var ciudad = $("#ciudad").val();
    var resolucion = $("#resolucion").val();
    var fecha_resolucion = $("#fecha_resolucion").val();
    var prefijo = $("#prefijo").val();
    var nit_tienda = $("#nit").val();
    var slug = $("#slug").val();
    var url= URLdominio+'tienda_editar';


     if (nombre_tienda == "") {
      $( "#grup_nombre_tienda" ).addClass( "error" );
      $( "#nombre_tienda" ).attr( "placeholder", "este campo es requerido" );
      return false;
    }
    else if (encargado == "") {
      $("#grup_encargado").addClass("error");
      $("#encargado").attr("placeholder", "este campo es requerido");
      return false;
    }
    else if (nit_tienda == "") {
      $( "#grup_nit_tienda" ).addClass( "error" );
      $( "#nit" ).attr( "placeholder", "este campo es requerido" );
      return false;
    }
    else if (telefono == "") {
      $( "#grup_telefono" ).addClass( "error" );
      $( "#telefono" ).attr( "placeholder", "este campo es requerido" );
      return false;
    }
    else if (direccion_tienda == "") {
      $( "#grup_direccion_tienda" ).addClass( "error" );
      $( "#direccion" ).attr( "placeholder", "este campo es requerido" );
      return false;
    }
    else if (ciudad == "") {
      $( "#grup_ciudad" ).addClass( "error" );
      $( "#ciudad" ).attr( "placeholder", "este campo es requerido" );
      return false;
    }
     else if (resolucion == "") {
       $("#grup_resolucion").addClass("error");
       $("#resolucion").attr("placeholder", "este campo es requerido");
       return false;
     }
     else if (fecha_resolucion == "") {
       $("#grup_fecha_resolucion").addClass("error");
       $("#fecha_resolucion").attr("placeholder", "este campo es requerido");
       return false;
     }
     else if (prefijo == "") {
       $("#grup_prefijo").addClass("error");
       $("#prefijo").attr("placeholder", "este campo es requerido");
       return false;
     }
    else if (slug == "") {
      $( "#group_slug" ).addClass( "error" );
      $( "#slug" ).attr( "placeholder", "este campo es requerido" );
      return false;
    }

else{

  
    $.ajax({

      url: url,
      type: 'GET',
      data: {
        id:id,
        nombre_tienda: nombre_tienda,
        encargado : encargado,
        nit_tienda: nit_tienda,
        telefono: telefono,
        direccion_tienda: direccion_tienda,
        resolucion: resolucion,
        fecha_resolucion: fecha_resolucion,
        prefijo: prefijo,
        slug: slug,
        ciudad: ciudad
      },
      dataType: 'json',
      success: function(respuesta){
        if(respuesta)
        {
          setTimeout("location.href='crear_tienda'");
          
        }
      }
    });//FIN AJAX


    $('cerrar_tienda').removeClass('show');
    $("#modal_tienda").css({
      "display": "none"
    });

    document.getElementById("form").reset();

    // FUNCION PARA MENSAJE DE ALERTA AL EDITAR UNA TIENDA
    alertify.log("TIENDA ACTUALIZADA CON EXITO.");

    
  }

  });

// FUNCION PARA LISTAR LAS TIENDAS ANTES DE CAMBIAR DE TIENDA
  $("#cambiar_tienda ").click(function(e)
  {
    var url= URLdominio+'cambiar_tienda';

    $( "#cambiar_t" ).addClass( "show" );

    $("#cambiar_t").css({
      "display": "block",
      "padding-right": "16px",
      "background": "rgba(0, 0, 0, 0.5)"
    });

    $( "#cerrar_" ).click(function() {
      $( "cerrar_" ).removeClass( "show" );
      $("#cambiar_t").css({
        "display": "none"
      });
    });

    $.ajax({
      url:url,
      type: 'GET',
      data: {

      },
      dataType: 'json',
      success: function(respuesta){
      $('#mySmallModalLabel').html(respuesta);
      }
    });
    e.preventDefault();
  });


// FUNCION PARA CAMBIAR DE TIENDA

$("#cambiando").click(function(){
  $( "cerrar_" ).removeClass( "show" );
  $("#cambiar_t").css({
    "display": "none"
  });
});
