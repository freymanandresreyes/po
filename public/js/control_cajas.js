//captura la direccion del servidor
function getAbsolutePath() {
    var loc = window.location;
    var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
    return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
  }
  var URLdominio = getAbsolutePath();

//   FUNCION PARA LLENAR EL SELECT DE CAJAS
  $("#usuario").click(function()
{
  var url= URLdominio+'buscarcajas';
  var id =$('#usuario').val();
  
  $.ajax({
    url: url,
    type: 'GET',
    data: {
      
    },
    dataType: 'json',
    success: function(respuesta){
      if(respuesta)
      {
        $('#cajas').html(respuesta);
      }
        
    }
  });//FIN AJAX
});

// FUNCION PARA VALIDAR SI ESA CAJA YA LA TIENE ALGUIEN ASIGNADA
$("#cajas").click(function()
{
  var url= URLdominio+'buscarcajarelacionada';
  var id =$('#cajas').val();
  console.log(id);
  if(id=="")
  {
    return (false);
  }
  $.ajax({
    url: url,
    type: 'GET',
    data: {
      id:id
    },
    dataType: 'json',
    success: function(respuesta){
        console.log(respuesta);
        if (respuesta == 1)
        {
            alertify.error("ESTA CAJA YA ESTA ASIGNADA A UN USUARIO.");
            return (false);
        }
    }
  });//FIN AJAX
});

// FUNCION PARA VALIDAR SI ESA CAJA YA LA TIENE ALGUIEN ASIGNADA
// CREAR CAJA
$("#crear_caja").click(function()
{
  var url= URLdominio+'nuevacaja';
  var saldo =$('#saldo').val();
  var estado =$('#estado').val();
  var inicio =$('#hora_inicial').val();
  var fin =$('#hora_final').val();
  var n_caja=1;
if(saldo==""||estado==""||inicio==""||fin=="")
{
  alertify.error("TODOS LOS CAMPOS SON OBLIGATORIOS.");
  return (false);
}

  $.ajax({
    url: url,
    type: 'GET',
    data: {
      saldo:saldo,
      estado:estado,
      inicio:inicio,
      fin:fin,
      n_caja:n_caja
    },
    dataType: 'json',
    success: function(respuesta){
        console.log(respuesta);
      if (respuesta==0)
        {
          alertify.error("NO ESTAS EN NINGUNA TIENDA.");
          return (false);
        }
        if (respuesta == 1)
        {
            alertify.log("LA CAJA A SIDO CREADA CON EXITO.");
            setTimeout("location.href='control_cajas'");
            return (false);
        }
    }
  });//FIN AJAX
});

// ASIGNANDO CAJA A UN USUARIO CON SUS RESPECTIVAS VALIDACIONES
$("#asignar_caja").click(function()
{
  var url= URLdominio+'asignar_caja_usuario';
  var usuario=$("#usuario").val();
  var cajas=$("#cajas").val();

  if(usuario==""||cajas=="")
  {
    alertify.error("LOS CAMPOS SON OBLIGARTORIOS.");
    return (false);
  }

  $.ajax({
    url: url,
    type: 'GET',
    data: {
      usuario:usuario,
      cajas:cajas
    },
    dataType: 'json',
    success: function(respuesta){
      console.log(respuesta);
      if (respuesta == 1)
      {
          alertify.log("CAJA ASIGNADA CORRECTAMENTE.");
          setTimeout("location.href='control_cajas'");
          return (false);
      }
      if(respuesta == 0)
      {
        alertify.error("ESTE USUARIO YA TIENE UNA CAJA ASIGNADA.");
        return (false);
      }
  }
  });//FIN AJAX
});

//   FUNCION PARA QUITARLE UNA CAJA A UN VENDEDOR
$("#usuariocaja").click(function()
{
  var url= URLdominio+'quitarcaja';
  var id =$('#usuariocaja').val();

  $.ajax({
    url: url,
    type: 'GET',
    data: {
      id:id
    },
    dataType: 'json',
    success: function(respuesta){
      console.log(respuesta);
      if(respuesta != 0)
      {
        $('#input').html(respuesta);
      }
      if(respuesta == 0)
      {
        $('#input').html(respuesta);
      }
      if(respuesta == "")
      {
        $('#input').html(respuesta);
      }
  }
  });//FIN AJAX
});

$("#quitar").click(function()
{
  var url= URLdominio+'eliminar_caja';
  var id =$('#usuariocaja').val();
  var caja =$('#caja_quitar').val();

  if(caja=="")
  {
    alertify.error("DEBES ESCOJER UNA CAJA PARA QUITAR.");
    return (false);
  }

  $.ajax({
    url: url,
    type: 'GET',
    data: {
      id:id,
      caja:caja
    },
    dataType: 'json',
    success: function(respuesta){
      console.log(respuesta);
      if(respuesta == 1)
      {
        alertify.log("CAJA QUITADA SATISFACTORIAMENTE.");
        setTimeout("location.href='control_cajas'");
        return (false);
      }
    }
  });//FIN AJAX

});


  //   FUNCION PARA BUSCAR LAS CAJAS DE LA TIENDA SELECCIONADA
  $('#tienda_activar').click(function()
  {
    var url= URLdominio+'buscar_tiendas_activar';
    var tienda_id =$('#tienda_activar').val();
    // console.log(tienda_id);
    if(tienda_id==0)
    {
      return(false);
    }
    else{
      // console.log(tienda_id);
      $.ajax({
        url: url,
        type: 'GET',
        data: {
            tienda_id:tienda_id
        },
        dataType: 'json',
        success: function(respuesta){
          if(respuesta)
          {
           $('#caja_activar').html(respuesta);
          }
        }
      });//FIN AJAX
    }
  });
  
  
    //   FUNCION PARA ACTIVAR O DESACTIVAR UNA CAJA
    $('#activar_desactivar').click(function()
    {
      var url= URLdominio+'activar_desactivar_caja';
      var tienda_id =$('#tienda_activar').val();
      var caja_id =$('#caja_activar').val();
      var estado =$('#estado_activar').val();
      if(tienda_id=="" || caja_id=="" || estado=="")
      {
        alertify.error("TODOS LOS CAMPOS SON OBLIGATORIOS.");
        return (false);
      }
      else{ 
        // console.log("hola");
        $.ajax({
          url: url,
          type: 'GET',
          data: {
              caja_id:caja_id,
              estado:estado
          },
          dataType: 'json',
          success: function(respuesta){
            if(respuesta==1)
            {
              alertify.log("ESTADO DE LA TIENDA EDITADO.");
              setTimeout("location.href='control_cajas'");
              return (false);
            }
          }
        });//FIN AJAX
    }
    });


