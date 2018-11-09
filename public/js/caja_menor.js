//captura la direccion del servidor
function getAbsolutePath() {
  var loc = window.location;
  var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
  return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
}
var URLdominio = getAbsolutePath();

$("#caja_menor").click(function()
{
  var url= URLdominio+'inser_caja_menor';

  var valor = $("#valor").val();
  var opcion = $("#opcion").val();
  var tienda = $("#tienda").val();
  var descripcion = $("#descripcion").val();
  var nombre = $("#nombre").val();
  var cedula = $("#cedula").val();
  var motivo = $("#motivo").val();
  var base = $('#base').attr('name');

  if(tienda== "")
  {
    alertify.error("NO ESTAS ACTUALEMENTE EN NINGUNA TIENDA.");
    return(false);
  }
  if(valor==""||opcion==""||tienda==""||descripcion==""||nombre==""||cedula==""||motivo==""||base=="")
  {
    alertify.error("TODOS LOS CAMPOS SON OBLIGARTORIOS.");
    return(false);
  }

  if (opcion == 1 )
  {
    if (base==undefined)
    {
      alertify.error("NO TIENES SUFICIENTE SALDO EN CAJA MENOR.");
      return(false);
    }
    var c_base=base.length;
    var c_valor=valor.length;

    if ( c_base<c_valor  )
    {
      alertify.error("NO TIENES SUFICIENTE SALDO EN CAJA MENOR.");
      return(false);
    }
    
    if (base>=valor || c_base>c_valor  )
    {
      
      $.ajax({
        url:url,
        type: 'GET',
        data: {
          valor:valor,
          opcion:opcion,
          descripcion:descripcion,
          nombre:nombre,
          cedula:cedula,
          motivo:motivo
        },
        dataType: 'json',
        success: function(respuesta){
          if(respuesta)
          {
            $('#nueva_factura').html(respuesta);
          
          }
          
        }
      });
      
      $( "#modal_cm" ).addClass( "show" );
      
      $("#modal_cm").css({
        
        "display": "block",
        "padding-right": "16px",
        "background": "rgba(0, 0, 0, 0.5)"
      });
      
    
      $( "#cerrar_cm" ).click(function() {
        $( "cerrar_cm" ).removeClass( "show" );
        $("#modal_cm").css({
          "display": "none"
        });
        setTimeout("location.href='caja_menor'");
      });
      $('#imprimir').click(function(){
        window.print();
        setTimeout("location.href='caja_menor'");
      });
      return(false);
    }
    if ( base<valor )
    {
      alertify.error("NO TIENES SUFICIENTE SALDO EN CAJA MENOR.");
      return(false);
    }
  }
  
  if (opcion == 0)
  {
    $.ajax({
      url:url,
      type: 'GET',
      data: {
        valor:valor,
        opcion:opcion,
        descripcion:descripcion,
        nombre:nombre,
        cedula:cedula,
        motivo:motivo
      },
      dataType: 'json',
      success: function(respuesta){
        if(respuesta)
        {
          $('#nueva_factura').html(respuesta);
        }
       
        
      }
    });
    
    $( "#modal_cm" ).addClass( "show" );

    $("#modal_cm").css({
      "display": "block",
      "padding-right": "16px",
      "background": "rgba(0, 0, 0, 0.5)"
    });
    
    
  
    $( "#cerrar_cm" ).click(function() {
      $( "cerrar_cm" ).removeClass( "show" );
      $("#modal_cm").css({
        "display": "none"
      });
      setTimeout("location.href='caja_menor'");
    });
    $('#imprimir').click(function(){
      window.print();
      setTimeout("location.href='caja_menor'");
    });
  }
});
