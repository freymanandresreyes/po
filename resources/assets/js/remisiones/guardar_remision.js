$('#crear_remision').click(function()
{
    
    var id_tienda =$('#tienda_remisiones').val();
    var id_proveedor = $('#proveedor_remisiones').val();
    var opcion = $('#opciones_remisiones').val();
// FUNCION GLOBAL DE LA URL
    var url = URLdominio+'guardar_remision_agregada';
// FIN FUNCION GLOBAL

 //codigo para contar los productos que
        //se agregaran a la remision
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

        console.log(data);
        // return false;
       
        $('#crear_remision').prop('disabled',true);
        
if(data=="")
    {
        alertify.error("TODOS LOS CAMPOS SON OBLIGATORIOS.");
    }
else{
    
    $.ajax({
        url: url,
        type: 'POST',
        headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
        data: {
            datos: data,
            id_tienda: id_tienda,
            opcion: opcion,
            id_proveedor: id_proveedor
        },
        dataType: 'json',
        success: function(respuesta){
        if(respuesta==1)
        {
            alertify.success("REMISION ENVIADA CON EXITO.");
            setTimeout("location.href='crear_remisiones'");
        }
        }//fin del success
      });//fin de ajax
}
});