//captura la direccion del servidor
function getAbsolutePath() {
    var loc = window.location;
    var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
    return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
  }
  var URLdominio = getAbsolutePath();

  //   FUNCION PARA ASIGNAR TIENDA A UN EMPLEADO CON SUS VALIDAACIONES
  $("#asignar_tienda").click(function()
{
  var url= URLdominio+'asignar_tienda';
  var id =$('#vendedores').val();
  var locales=$("#locales").val();

  if(id==0 || locales==0)
  {
    alertify.error("ASEGURATE DE ESCOJER UN VENDEDOR Y UNA TIENDA.");
    return (false);
  }
  else
  {
  $.ajax({
    url: url,
    type: 'GET',
    data: {
        id:id,
        locales:locales
    },
    dataType: 'json',
    success: function(respuesta){
      if(respuesta==1)
      {
        alertify.error("ESTE VENDEDOR YA ESTA ADERIDO A UNA TIENDA.");
        return (false);
      }
      if(respuesta==0)
      {
        alertify.log("TIENDA ASIGNADA CORRECTAMENTE.");
        setTimeout("location.href='control_tiendas'");
        return (false);
      }
    }
  });//FIN AJAX
  }
});

  //   FUNCION PARA LISTAR TIENDA EN LA CUA ESTA EL EMPLEADO CON SUS VALIDAACIONES
  $("#vendedores_quitar").click(function()
{
  var url= URLdominio+'cargar_tienda_id';
  var id =$('#vendedores_quitar').val();

    $.ajax({
    url: url,
    type: 'GET',
    data: {
        id:id
    },
    dataType: 'json',
    success: function(respuesta){
        $('#input_tienda').html(respuesta);
      }
  });//FIN AJAX
});


  //   FUNCION PARA QUITAR TIENDA A UN EMPLEADO CON SUS VALIDAACIONES
  $("#quitartienda").click(function()
{
  var url= URLdominio+'quitar';
  var id =$('#vendedores_quitar').val();
  var tienda=$('#tienda_quitar').val();
  if(tienda==undefined && id==0)
  {
    alertify.error("DEBES ESCOJER UN VEDEDOR.");
    return (false);
  }
  if(tienda==undefined && id!=0)
  {
    alertify.error("ESTE VENDEDOR NO TIENE TIENDA ASIGNADA.");
    return (false);
  }
  else
  {
    $.ajax({
    url: url,
    type: 'GET',
    data: {
        id:id,
        tienda:tienda
    },
    dataType: 'json',
    success: function(respuesta){
      if(respuesta==0)
      {
        alertify.log("TIENDA QUITADA CORRECTAMENTE.");
        setTimeout("location.href='control_tiendas'");
        return (false);
      }
    }
  });//FIN AJAX
  }
});


window.onload = function() {
//  alert("hola");
 var url= URLdominio+'enquetiendaestoy';
 $.ajax({
  url: url,
  type: 'GET',
  data: {
     
  },
  dataType: 'json',
  success: function(respuesta){
    if(respuesta)
    {
      $('#tienda_actual').html(respuesta);
    }
  }
});//FIN AJAX
};


