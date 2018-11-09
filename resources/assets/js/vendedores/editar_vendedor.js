$('#vendedores_tabla').on('click', '.editar_vendedor', function (event) {
    var id_vendedor = this.name;
    var url = getAbsolutePath() + 'buscar_editar_vendedor';
    $('#guardar_vendedor').css({ "display": "none" });;
    $('#id').css({ "display": "none" });;
    $('#editar_vendedor').css({ "display": "block" });;
    $.ajax({
        url: url,
        type: 'GET',
        data: {
            id_vendedor: id_vendedor,
        },
        dataType: 'json',
        success: function (respuesta) {
          if(respuesta)
          {
            //   console.log(respuesta[0]['tiendavendedor']['slug']);
            //   return(false);
           $('#id').val(respuesta[0]['id']);
           $('#nombres_vendedor').val(respuesta[0]['nombres']);
           $('#apellidos_vendedor').val(respuesta[0]['apellidos']);
           $('#documento_vendedor').val(respuesta[0]['documento']);
           $('#direccion_vendedor').val(respuesta[0]['direccion']);
           $('#telefono_vendedor').val(respuesta[0]['telefono']);
           $('#fecha_nacimiento_vendedor').val(respuesta[0]['fecha_nacimiento']);
           $('#correo_vendedor').val(respuesta[0]['correo']);
           $('#tienda_vendedor').val(respuesta[0]['tiendavendedor']['id']);
           $('#estado_vendedor').css({ "display": "none" });;
           $('#label_ocultar').css({ "display": "none" });;
          }
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
        }//fin del success
    });//fin de ajax  
  });