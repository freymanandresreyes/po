$('#buscar_informe_diario').click(function(e){
    var tienda = $('#informe_tienda_select').val() ;
    var fecha_inicio = $('#fecha_inicio').val();
    var fecha_fin = $('#fecha_fin').val();
    var forma_pago = $('#informe_pago').val();
 
    var url= URLdominio+'generar_informe_diario';
   console.log(url);
    $.ajax({
      url:url,
      type: 'GET',
      data: {
        tienda: tienda,
        fecha_inicio:fecha_inicio,
        fecha_fin:fecha_fin,
        forma_pago: forma_pago
         
      },
      dataType: 'json',
      success: function(respuesta){
         console.log(respuesta);
         $('#informe_general_diario').html(respuesta);
      }
     });    
 });


 //FUNCION PARA IMPRIMIR

 $('#imprimir_informe_diario').click(function(e){
    // alert("imprmiendo");
    var fecha_inicio = $('#fecha_inicio').val();
    var fecha_fin = $('#fecha_fin').val();
    
    if(fecha_inicio == "" || fecha_fin == ""){
        alertify.alert("<b>Se debe elejir un rango de fechas.", function () {
            return false;
        });
    }else{
        var url= URLdominio+'informe_diario_imprimir';
        console.log(url);
        $.ajax({
        url:url,
         type: 'GET',
         data: {
         fecha_inicio:fecha_inicio,
         fecha_fin:fecha_fin,
         
      },
      dataType: 'json',
      success: function(respuesta){
         console.log(respuesta);
         $('#vista_info_diario').html(respuesta);

        window.print();
        $('#vista_info_diario').html("");
      }
      
     });
    }
        
 });