$('#id_tipo_pago').click(function(){
 var id_pago = $('#id_tipo_pago').val();

 var url = getAbsolutePath()+'buscar_banco';
  
      $.ajax({
        url: url,
        type: 'GET',
        data: {
          id_pago: id_pago,
          
        },
        dataType: 'json',
        success: function(respuesta){
         
         $('#lista_bancos').html(respuesta);
         
        }//fin del success
      });//fin de ajax
});

$('#id_tipo_pago_dos').click(function(){
 var id_pago = $('#id_tipo_pago_dos').val();

 var url = getAbsolutePath()+'buscar_banco';
  
      $.ajax({
        url: url,
        type: 'GET',
        data: {
          id_pago: id_pago,
          
        },
        dataType: 'json',
        success: function(respuesta){
         
         $('#lista_bancos_dos').html(respuesta);
         
        }//fin del success
      });//fin de ajax
});