$('#nuevo_vendedor').click(function()
{
    $('#nombres_vendedor').val("");
    $('#apellidos_vendedor').val("");
    $('#documento_vendedor').val("");
    $('#direccion_vendedor').val("");
    $('#telefono_vendedor').val("");
    $('#fecha_nacimiento_vendedor').val("");
    $('#correo_vendedor').val("");
    $('#tienda_vendedor').val("");
    $('#estado_vendedor').val("");
    $('#editar_vendedor').css({ "display": "none" });;
    $('#id').css({ "display": "none" });;
    $('#guardar_vendedor').css({ "display": "block" });;

  $('#tienda_vendedor').css({ "display": "block" });;
  $('#estado_vendedor').css({ "display": "block" });;
  $('#label_ocultar').css({ "display": "block" });;

    $( "#vendedor" ).addClass( "show" );

    $("#vendedor").css({
      "display": "block",
      "padding-right": "16px",
      "background": "rgba(0, 0, 0, 0.5)"
    });

    $( "#cerrar_modal_vendedor" ).click(function() {
        $( "vendedor" ).removeClass( "show" );
        $("#vendedor").css({
          "display": "none"
        });
      });

  });
