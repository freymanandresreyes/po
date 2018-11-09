// alert('ok');
$('#id_facturas .anular').on('click', function (e) {
    var seleccion = $(this).attr('name');

    alertify.confirm("<p>Se anulara la factura Nº. " + seleccion + ".<br><br><b>ENTER</b> y <b>ESC</b> corresponden a <b>Aceptar</b> o <b>Cancelar</b></p>", function (e) {
        if (e) {
            alertify.success("Has pulsado '" + alertify.labels.ok + "'");
            console.log(seleccion);

            var url = URLdominio + 'anular_factura';
            console.log(url);
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    factura: seleccion,
                    },
                dataType: 'json',
                success: function (respuesta) {
                    console.log(respuesta);
                    if(respuesta){
                        location.reload();
                    }
                                        
                }
            });
            // setTimeout(function(){ 
            //     location.reload(); }, 300);
            
        } else {
            alertify.error("Has pulsado '" + alertify.labels.cancel + "'");
        }
    });
    return false
    e.preventDefault();
});