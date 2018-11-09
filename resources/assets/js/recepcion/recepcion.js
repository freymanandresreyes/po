
$('#recepcion_compras').on('click', '.recepcion_compras', function (event) {
  var id_compra = this.name;

  alertify.confirm("<p>Aquí confirmamos algo.<br><br><b>ENTER</b> y <b>ESC</b> corresponden a <b>Aceptar</b> o <b>Cancelar</b></p>", function (e) {
    if (e) {
      alertify.success("Has pulsado '" + alertify.labels.ok + "'");

      var url = URLdominio + 'aceptarcompra';
      //    console.log(id)
      //    alert(id);
      $.ajax({

        url: url,
        type: 'GET',
        data: {
          id_compra: id_compra
        },
        dataType: 'json',
        success: function (respuesta) {
          if (respuesta == 0) {
            alertify.success("DATOS GUARDADOS CORRECTAMETE.");
            $("#aceptarcompra").removeClass("show");
            $("#aceptarcompra").css({
              "display": "none"
            });
            setTimeout("location.href='listarcompras'");
          }
        }
      });//FIN AJAX

    } else {
      alertify.error("Has pulsado '" + alertify.labels.cancel + "'");
    }
  });


});

