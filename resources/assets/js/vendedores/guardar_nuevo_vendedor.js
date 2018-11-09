$('#guardar_vendedor').click(function()
{
    var nombres = $('#nombres_vendedor').val();
    var apellidos = $('#apellidos_vendedor').val();
    var documento = $('#documento_vendedor').val();
    var direccion = $('#direccion_vendedor').val();
    var telefono = $('#telefono_vendedor').val();
    var fecha_nacimiento = $('#fecha_nacimiento_vendedor').val();
    var correo = $('#correo_vendedor').val();
    var tienda = $('#tienda_vendedor').val();
    var estado = $('#estado_vendedor').val();
    var url = getAbsolutePath() + 'guardar_vendedor';
    if(nombres=="" || apellidos=="" || documento=="" || direccion=="" || telefono=="" || 
       fecha_nacimiento=="" || correo=="" || tienda=="" || estado=="")
    {
      alertify.error("TODOS LOS CAMPOS SON OBLIGATORIOS.");
      return(false);
    }
    $.ajax({
      url: url,
      type: 'GET',
      data: {
        nombres: nombres,
        apellidos: apellidos,
        documento: documento,
        direccion: direccion,
        telefono: telefono,
        fecha_nacimiento: fecha_nacimiento,
        correo: correo,
        tienda: tienda,
        estado: estado,
      },
      dataType: 'json',
      success: function (respuesta) {
        if(respuesta==1)
        {
          alertify.success("VENDEDOR GUARDADO CORRECTAMENTE.");
           $('#nombres_vendedor').val("");
           $('#apellidos_vendedor').val("");
           $('#documento_vendedor').val("");
           $('#direccion_vendedor').val("");
           $('#telefono_vendedor').val("");
           $('#fecha_nacimiento_vendedor').val("");
           $('#correo_vendedor').val("");
           $('#tienda_vendedor').val("");
           $('#estado_vendedor').val("");
           $('#id').val("");
          setTimeout("location.href='vista_vendedores'");
          return(false);
        }
        else
        {
          alertify.error("HA OCURRIDO UN ERROR.");
        }
      }//fin del success
  });//fin de ajax  
  });