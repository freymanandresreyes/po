//FUNCION PARA BUSCAR SI EL CLIENTE TIENE UN APARTADO
function buscar_separado_apartado(dato) {
  var id_cliente = dato;

  var url = getAbsolutePath() + 'buscar_apartado_caja';

  $.ajax({
    url: url,
    type: 'POST',
    headers: { 'X-CSRF-Token': $('meta[name=_token]').attr('content') },
    data: {
      id_cliente: id_cliente
    },
    dataType: 'json',
    success: function (respuesta) {
      console.log(respuesta.length);
      if (respuesta.length != 0) {
        alertify.alert("Este usuario ya tiene un apartado, solo es permitido un apartado por usuario.", function () {
          $('#id_cliente').val("");
          $('#documento_cliente_apartado').val("");
          $('#nombre_cliente').val("");
        });
        return false
      } else {
        $('#codigo_apartado').prop('disabled', false);
      }
    }//fin del success
  });//fin de ajax
}

//FUNCION PARA BUSCAR CLIENTE POR SU DOCUMENTO
$("#documento_cliente_apartado").keydown(function (e) {
  var Ndocumento = $("#documento_cliente").val();

  if (e.which == 8) {
    $('#id_cliente').val("");
    $('#nombre_cliente').val("");
    $('#direccion_cliente').val("");
    $('#telefono_cliente').val("");
  }


  if (e.which == 13) {
    var Ndocumento = $("#documento_cliente_apartado").val();
    var url = getAbsolutePath() + 'clienteConsultar';

    $.ajax({
      url: url,
      type: 'GET',
      data: {
        cedula: Ndocumento
      },
      dataType: 'json',
      success: function (respuesta) {
        console.log(respuesta);
        var Nregistros = Object.keys(respuesta).length;
        if (Nregistros == 0) {

          $("#documento").val(Ndocumento);
          $("#modal_cliente").addClass("show");

          $("#modal_cliente").css({
            "display": "block",
            "padding-right": "16px",
            "background": "rgba(0, 0, 0, 0.5)"
          });
        } else {
          var id_cliente = respuesta.id;
          $("#id_cliente").val(respuesta.id);
          $("#nombre_cliente").val(respuesta.nombres + ' ' + respuesta.apellidos);
          $("#direccion_cliente").val(respuesta.direccion);
          $("#telefono_cliente").val(respuesta.telefono);
          $("#datos_cliente").html(respuesta.nombres + ' ' + respuesta.apellidos + '<br/> Nº.' + respuesta.documento + '<br/>' + respuesta.direccion + '<br/>' + respuesta.telefono);

          //ENVIA EL ID DEL CLIENTE PARA BUSCAR SI EXISTE ALGUN SEPARADO
          buscar_separado_apartado(id_cliente);
        }
      }//fin del success
    });//fin de ajax
    return (e.which != 13);
  }
});


$("#cerrar_cliente").click(function () {
  $("cerrar_cliente").removeClass("show");
  $("#modal_cliente").css({
    "display": "none"
  });
});

// FUNCION ES PARA CREAR UN NUEVO CLIENTE
$("#guardar_cliente_c").click(function () {
  var documento = $("#documento").val();
  var nombre = $("#nombres").val();
  var apellido = $("#apellidos").val();
  var direccion = $("#direccion").val();
  var telefono = $("#telefono").val();
  var fecha = $('#fecha-nacimiento').val();
  var correo = $('#correo').val();


  if (!documento || !nombre || !apellido || !direccion || !telefono || !fecha) {
    alertify.error("Todos los campos son obligatorios.");
  } else {

    var url = getAbsolutePath() + 'crearcliente'; //ClientesController

    // FUNCION PARA MENSAJE DE ALERTA AL CREAR CLIENTE
    function cliente_crear() {
      alertify.log("El cliente fue creado con exito.");
      return false;
    }

    $.ajax({
      url: url,
      type: 'GET',
      data: {
        documento: documento,
        nombre: nombre,
        apellido: apellido,
        direccion: direccion,
        telefono: telefono,
        fecha: fecha,
        correo: correo
      },
      dataType: 'json',
      success: function (respuesta) {
        $("#id_cliente").val(respuesta);
      }//fin del success
    });//fin de ajax
    cliente_crear();
    $("#documento_cliente").val(documento);
    $("#nombre_cliente").val(nombre + ' ' + apellido);
    $("#direccion_cliente").val(direccion);
    $("#telefono_cliente").val(telefono);

    /********** LLENA LOS DATOS DEL CLIENTE PARA MODAR IMPRIMIR FACTURA **********/
    $("cerrar_cliente").removeClass("show");
    $("#modal_cliente").css({
      "display": "none"
    });
  }
});