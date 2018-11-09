$('#agregar_apartado').click(function(){
    var proveedor = $('#proveedor').val();
    // console.log(proveedor);
    var id_producto =$('#id_producto').val();
    var codigo = $('#codigo_apartado').val();
    var nombre = $('#titulo').val();
    var p_compra = $('#valor_apartado').val();
    var cantidad = $('#cantidad').val();
    var precio_detal = $('#precio_detal_apartado').val();
    var precio_mayorista = $('#precio_mayorista_apartado').val();
    if(id_producto != "" && codigo != "" && nombre != "" && p_compra != "" &&  cantidad != ""){
    var fila = '<tr class="dato"><td> ' +
            codigo +
            '</td><td style="display: none">' + id_producto+
            '</td><td>' + nombre+
            '</td><td>' + p_compra +
            '</td><td>' + cantidad +
            '</td><td>' + (p_compra * cantidad) +
            '</td><td style="display: none">' + (precio_detal) +
            '</td><td style="display: none">' + (precio_mayorista) +
            '</td><td><button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button></td></tr>';
            //  console.log(fila);
    var conteo = $('#encabezado_separados tr:last');
    conteo.after(fila);

    $('#id_producto').val("");
    $('#codigo').val("");
    $('#titulo').val("");
    $('#costo_unitario').val("");
    $('#cantidad').val("");
    $('#p_detal').val("");
    $('#p_mayor').val("");
    $('#categoria').val("");
    $('#subcategoria').val("");
    $('#descripcion').val("");
    $('#valor_apartado').val("");
    $('#codigo_apartado').val("");

    
    }else{
        alertify.error("TODOS LOS CAMPOS SON OBLIGATORIOS.");
        return(false);
    }
});