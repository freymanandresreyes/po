$('#caja_descuento').keyup(function(){
        var precio = $('#caja_precio').val()
        var porsentaje = $('#caja_descuento').val();

        var d = (parseFloat(precio)*parseFloat(porsentaje))/100;
        var precio_descuento = parseFloat(precio) - d;

        $('#caja_total').val(precio_descuento);

});