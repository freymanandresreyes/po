//captura la direccion del servidor
function getAbsolutePath() {
    var loc = window.location;
    var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
    return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
  }
  var URLdominio = getAbsolutePath();

  $('#actualizar_iva').click(function()
  {
    var url= URLdominio+'buscar_iva';
    var id=$("#tiendas_iva").attr('name');
    var iva=$("#iva").val();
    if(iva>100)
    {
        alertify.error("SOLO PUEDES MANEJAR HASTA EL 100% DE IVA");
        return(false);
    }
    var n_iva=isNaN( iva );
    if(n_iva==true)
    {
        alertify.error("SOLO PUEDES INTRODUCIR VALORES ENTEROS");
        return(false);
    }
    if(iva<0)
    {
        alertify.error("SOLO PUEDES INTRODUCIR VALORES MAYORES A (0%)");
        return(false);
    }
    $.ajax({
        url:url,
        type: 'GET',
        data: {
            id:id,
            iva:iva
        },
        dataType: 'json',
        success: function(respuesta){
          if(respuesta==1)
          {
            setTimeout("location.href='configuraciones'");
            alertify.log("EL IVA HA SIDO ACTUALIZADO CORRECTAMENTE.");
            return(false);
          }
        }
      });
  });


  $('#crear_tag').click(function(){

    var url= URLdominio+'crear_tag';
    var nuevo_tag=$("#tag_nuevo").val();
    if(nuevo_tag=="")
    {
        alertify.error("NO PUEDES TENER CAMPOS VACIOS.");
        return(false);
    }
    var objeto=[{"nuevo_tag":nuevo_tag}];
    $.ajax({
        url:url,
        type: 'GET',
        data: {
            objeto:objeto
        },
        dataType: 'json',
        success: function(respuesta){
            if(respuesta==1)
            {
              alertify.error("ESTE TAG YA EXISTE.");
              return(false);
            }
            if(respuesta==0)
            {
              alertify.log("TAG CREADO CORRECTAMENTE.");
              setTimeout("location.href='configuraciones'");
              return(false);
            }
  
          }
      });
  });


  $('#tags_tienda').click(function()
{
    var editar_tag=$("#tags_tienda").val();
    var url= URLdominio+'mostrar_tag';
    if(editar_tag!=0)
    {
        $.ajax({
            url:url,
            type: 'GET',
            data: {
                editar_tag:editar_tag
            },
            dataType: 'json',
            success: function(respuesta){
                $('#editar_tag').html(respuesta);
              }
          });

        $( "#modal_tag" ).addClass( "show" );

        $("#modal_tag").css({
          "display": "block",
          "padding-right": "16px",
          "background": "rgba(0, 0, 0, 0.5)"
        });
    
        $( "#cerrar_tag" ).click(function() {
          $( "cerrar_tag" ).removeClass( "show" );
          $("#modal_tag").css({
            "display": "none"
          });
          setTimeout("location.href='configuraciones'");
        });
    }
});

$('#editar_tag_selecionado').click(function()
{
    var tag=$("#tag").val();
    var tag_id=$("#tag").attr('name');
    // alert(tag_id);
    var url= URLdominio+'editar_tag';

        $.ajax({
            url:url,
            type: 'GET',
            data: {
                tag:tag,
                tag_id:tag_id
            },
            dataType: 'json',
            success: function (respuesta) {
                if(respuesta==0)
                {
                    alertify.log("TAG EDITADO CORRECTAMENTE.");
                    setTimeout("location.href='configuraciones'");
                    return (false);
                }
                if(respuesta==1)
                {
                    alertify.error("NO PUEDEN HABER DOS TAGS CON EL MISMO NOMBRE.");
                    return (false);
                }
            }
           });

        $( "#cerrar_tag" ).click(function() {
          $( "cerrar_tag" ).removeClass( "show" );
          $("#modal_tag").css({
            "display": "none"
          });
          setTimeout("location.href='configuraciones'");
        });

});

$('#tag_selecionado').click(function()
{
    var url= URLdominio+'traerconsecutivo';
    var tag_selecionado=$("#tag_selecionado").val();
    if(tag_selecionado!=0)
    {
        $.ajax({
            url:url,
            type: 'GET',
            data: {
                tag_selecionado:tag_selecionado
            },
            dataType: 'json',
            success: function (respuesta) {
                
                if(respuesta==1)
                {
                    // alert("aca");
                $('#inicializar').prop('disabled', false);
                $('#enviar_consecutivo').prop('disabled', true); 
                $('#imput_consecutivo').prop('disabled',true);
                $('#imput_consecutivo').val("");       
                alertify.error("ESTE TAG NO HA SIDO INICIALIZADO.");
                return (false);
                }
                else
                {
                $('#inicializar').prop('disabled', true);
                $('#enviar_consecutivo').prop('disabled', false);
                $('#imput_consecutivo').prop('disabled',false);
                $('#input_consecutivo').html(respuesta);                
                }
            }
        });
    }
});


$('#inicializar').click(function()
{
    var url= URLdominio+'iniciarconsecutivo';
    var tag_selecionado=$("#tag_selecionado").val();
    if(tag_selecionado==0)
    {
     alertify.error("ASEGURATE DE ELEGIR UN TAG.");
     return (false);
    }
    
    $.ajax({
        url:url,
        type: 'GET',
        data: {
            tag_selecionado:tag_selecionado
        },
        dataType: 'json',
        success: function (respuesta) 
        {
            if(respuesta==0)
            {
                alertify.log("TAG INICIALIZADO CON EXITO.");
                return (false);
            }  
        }
    });
});


$('#enviar_consecutivo').click(function()
{
    var url= URLdominio+'editar_consecutivo';
    var tag_selecionado=$("#tag_selecionado").val();
    var consecutivo=parseInt($("#imput_consecutivo").val());
    var name_valor=parseInt($('#imput_consecutivo').attr('name'));
    // alert(consecutivo);
    // return false;
   if(tag_selecionado==0)
   {
    alertify.error("ASEGURATE DE ELEGIR UN TAG.");
    return (false);
   }

   if(consecutivo>=name_valor)
   {
   
    $.ajax({
        url:url,
        type: 'GET',
        data: {
            tag_selecionado:tag_selecionado,
            consecutivo:consecutivo
        },
        dataType: 'json',
        success: function (respuesta) 
        {
            if(respuesta==1)
            {
                alertify.log("CONSECUTIVO EDITADO CON EXITO.");
                setTimeout("location.href='configuraciones'");
                return (false);
            }
        }
    });
    }

if(consecutivo<name_valor )
   {
    alertify.error("NO PUEDES EDITAR EL CONSECUTIVO POR UN NUMERO MENOR AL EXISTENTE.");
    return (false);
   }
});