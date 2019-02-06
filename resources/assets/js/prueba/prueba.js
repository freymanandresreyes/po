// $('#rango_fechas').on('click', function (e) {
//     $("#fechas_prueba").addClass("show");
//     $("#fechas_prueba").css({
//         "display": "block",
//         "padding-right": "16px",
//         "background": "rgba(0, 0, 0, 0.5)"
//     });
//     e.preventDefault();
// });

$('#cerrar_modal_fechas').on('click', function (e) {
    $("fechas_prueba").removeClass("show");
    $("#fechas_prueba").css({
        "display": "none"
    });
    e.preventDefault();
});

$('#prueba').on('click', function () {
    
    var fecha1_prueba=$('#fecha1_prueba').val();
    var fecha2_prueba=$('#fecha2_prueba').val();
    // console.log(numero_factura);
    // console.log(proveedor);
    // console.log(fecha);
    var url= URLdominio+'prueba';
    console.log(fecha1_prueba);
    console.log(fecha2_prueba);
    console.log(url);

    if(fecha1_prueba=="" || fecha2_prueba=="")
    {
        alertify.error("TODOS LOS CAMPOS SON OBLIGATORIOS.");
    }
    else
    {
    $.ajax({
      url:url,
      type: 'GET',
      data: {
         fecha1_prueba:fecha1_prueba,
         fecha2_prueba:fecha2_prueba
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