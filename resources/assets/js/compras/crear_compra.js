
// FUNCION PARA ACTIVAR LOS IMPUTS DEL FORMULARIO
// DE CREAR UNA NUEVA COMPRA
$('#crear_compra').click(function(){
    var tipo = $("#acction_compras option:selected" ).attr("value");
    var bodega = $('#bodega').prop('name');
    if (tipo == 1 || tipo == "1") {//COMPRAS
        // LOS VALUES DE FORMA DE PAGO SON:
        // UNO (1) PARA CREDITO
        // DOS (2) PARA CONTADO
        
        var id_proveedor        =$('#proveedor').val();
        var iva                 =$('#iva').val();
        var id_tienda           =$('#tienda_c_p').val();
        var codigo              =$('#codigo').val();
        var numero_factura      =$('#numero_factura').val();
        var forma_pago          =$('#forma_pago').val();
        var fecha               =$('#fecha').val();
        var fecha_vencimiento   =$('#fecha_vencimiento').val();
        var cantidad            =$('#cantidad').val();
        var costo_unitario      =$('#costo_unitario').val();
        // console.log(producto);
        // FUNCION GLOBAL DE LA URL
        var url = URLdominio+'crear_compra';
        // FIN FUNCION GLOBAL
        var header = Array();
        $("table tr th").each(function (i, v) {
            header[i] = $(this).text();
        });
        
        var data = Array();
        $("table tr").each(function (i, v) {
            data[i] = Array();
            $(this).children('td').each(function (ii, vv) {
                data[i][ii] = $(this).text();
            });
        });
        data.splice(0, 1);
        data.pop();
        // data.shift();
        
        if(data.length <= 0 || id_proveedor==0  || numero_factura=="" || forma_pago==0 || fecha=="" || fecha_vencimiento=="" ||  forma_pago==null)
        {
            alertify.error("TODOS LOS CAMPOS SON OBLIGATORIOS.");
        }
        else
        {
            //codigo para contar los productos que
            //se agregaran a la compra
            $('#crear_compra').prop('disabled',true);
            $.ajax({
                url: url,
                type: 'POST',
                headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
                data: {
                    datos: data,
                    id_tienda: id_tienda,
                    id_proveedor: id_proveedor,
                    iva: iva,
                    codigo: codigo,
                    numero_factura: numero_factura,
                    forma_pago: forma_pago,
                    fecha: fecha,
                    fecha_vencimiento: fecha_vencimiento,
                    tipo: tipo
                },
                dataType: 'json',
                success: function(respuesta){
                    if(respuesta)
                    {
                        alertify.success("COMPRA REGISTRADA CON EXITO.");
                        location.reload();
                    }
                }//fin del success
            });//fin de ajax
        }
        
    }else if(tipo == 2 || tipo == "2"){//TRASLADOS
        // LOS VALUES DE FORMA DE PAGO SON:
        // UNO (1) PARA CREDITO
        // DOS (2) PARA CONTADO
                var iva                 =$('#iva').val();
                var id_tienda           =$('#tienda_c_p').val();
                var codigo              =$('#codigo').val();
                var cantidad            =$('#cantidad').val();
                var costo_unitario      =$('#costo_unitario').val();
                var id_proveedor = bodega;
            // console.log(producto);
            // FUNCION GLOBAL DE LA URL
                var url = URLdominio+'crear_compra';
            // FIN FUNCION GLOBAL
            var header = Array();
                    $("table tr th").each(function (i, v) {
                        header[i] = $(this).text();
                    });
            
                    var data = Array();
                    $("table tr").each(function (i, v) {
                        data[i] = Array();
                        $(this).children('td').each(function (ii, vv) {
                            data[i][ii] = $(this).text();
                        });
                    });
                    data.splice(0, 1);
                    data.pop();
                    // data.shift();
            
            if(data.length <= 0 || id_tienda == 0 )
                {
                    alertify.error("TODOS LOS CAMPOS SON OBLIGATORIOS.");
                    return false;
                }
            else
                {
                    //codigo para contar los productos que
                    //se agregaran a la compra
                    var header = Array();
                    $("table tr th").each(function (i, v) {
                        header[i] = $(this).text();
                    });
            
                    var data = Array();
                    $("table tr").each(function (i, v) {
                        data[i] = Array();
                        $(this).children('td').each(function (ii, vv) {
                            data[i][ii] = $(this).text();
                        });
                    });
                    data.splice(0, 1);
                    data.pop();
                    // data.shift();
                    
                $('#crear_compra').prop('disabled',true);
                $.ajax({
                    url: url,
                    type: 'POST',
                    headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
                    data: {
                        datos: data,
                        id_tienda: id_tienda,
                        id_proveedor: id_proveedor,
                        iva: iva,
                        codigo: codigo,
                        numero_factura: numero_factura,
                        forma_pago: forma_pago,
                        fecha: fecha,
                        fecha_vencimiento: fecha_vencimiento,
                        tipo: tipo
                    },
                    dataType: 'json',
                    success: function(respuesta){
                    if(respuesta)
                    {
                        alertify.success("COMPRA REGISTRADA CON EXITO.");
                        location.reload();
                    }
                    }//fin del success
                  });//fin de ajax
                }
            
        }
    });