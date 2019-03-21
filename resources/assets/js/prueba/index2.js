$('#index2').on('click', function () {
    
    var fecha1_index2=$('#fecha1_index2').val();
    var fecha2_index2=$('#fecha2_index2').val();
    // console.log(numero_factura);
    // console.log(proveedor);
    // console.log(fecha);
    var url= URLdominio+'generar_index2';
    console.log(fecha1_index2);
    console.log(fecha2_index2);
    console.log(url);

    if(fecha1_index2=="" || fecha2_index2=="")
    {
        alertify.error("TODOS LOS CAMPOS SON OBLIGATORIOS.");
    }
    else
    {
    $.ajax({
      url:url,
      type: 'GET',
      data: {
         fecha1_index2:fecha1_index2,
         fecha2_index2:fecha2_index2
      },
      dataType: 'json',
      success: function(respuesta){
        $('#aca').html(respuesta);
        $("#example23").DataTable({
            dom: "Bfrtip",
            buttons: ["copy", "csv", "excel", "pdf", "print"]
          });
      }
     });
    }
    // e.preventDefault();
});