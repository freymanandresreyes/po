$('#agregar_remision').click(function(){
    
    $('#tienda_remisiones').prop('disabled', true);
    $('#crear_remision').prop('disabled',false);
    var codigo = $('#codigo_remision').val();
    var tienda = $('#tienda_remisiones').val();
    var combo = document.getElementById("tienda_remisiones");
    var tienda_nombre = combo.options[combo.selectedIndex].text;
    
    var cantidad = $('#cantidad_remision').val();
    var precio = $('#precio_remision').val();
    var id_producto = $('#id_producto_remision').val();
    var opcion = $('#opciones_remisiones').val();

    codigo=codigo.toUpperCase();
    if (opcion == 1) {
        if(codigo==""||tienda==""||cantidad==""||precio==""||id_producto==""){
            alertify.error("todos los campos son obligatorios");
            return(false);
        }
        else{
            var fila = '<tr class="dato"><td> ' +
            codigo +
            '</td><td style="display: none">' + id_producto+
            '</td><td>' + precio+
            '</td><td>' + cantidad +
            '</td><td>' + tienda_nombre +
            '</td><td><button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button></td></tr>';
            var conteo = $('#encabezado_remision tr:last');
            conteo.after(fila);
    
            $('#codigo_remision').val("");
            $('#cantidad_remision').val("");
            $('#precio_remision').val("");
            $('#id_producto_remision').val("");
        }
        
    }else if (opcion == 2) {
        if(codigo=="" || cantidad=="" || precio=="" || id_producto==""){
            alertify.error("todos los campos son obligatorios");
            return(false);
        }
        else{
            var fila = '<tr class="dato"><td> ' +
            codigo +
            '</td><td style="display: none">' + id_producto+
            '</td><td>' + precio+
            '</td><td>' + cantidad +
            '</td><td>' + tienda_nombre +
            '</td><td><button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button></td></tr>';
            var conteo = $('#encabezado_remision tr:last');
            conteo.after(fila);
    
            $('#codigo_remision').val("");
            $('#cantidad_remision').val("");
            $('#precio_remision').val("");
            $('#id_producto_remision').val("");
        }
        
    }
  });