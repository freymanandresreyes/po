$('#generar_informe_mator_detal').click(function()
{
    var fecha1=$('#fecha1_informeuno').val();
    var fecha2=$('#fecha2_informeuno').val();
    // var rango1=$('.irs-from').html();
    // var rango2=$('.irs-to').html();
    // console.log(fecha1);
    
    // var rango1=rango1.substr(1);
    // var rango2=rango2.substr(1);
    
    // var fecha1=fecha1.replace('T', ' ');
    // return(false);
    // var rango2=rango2.replace(' ', '');
    // alert('aca vamos bebe');
    var url= URLdominio+'generar_informeuno';

    if(fecha1=="" || fecha2=="")
    {
        alertify.error("TODOS LOS CAMPOS SON OBLIGATORIOS.");
    }
    else
    {
    $.ajax({
      url:url,
      type: 'GET',
      data: {
         fecha1:fecha1,
         fecha2:fecha2,
        //  rango1:rango1,
        //  rango2:rango2
      },
      dataType: 'json',
      success: function(respuesta){
        if(respuesta==0){
            alertify.error("No se encontraron registros.");
            return(false);
        }
      }
     });
    }
});