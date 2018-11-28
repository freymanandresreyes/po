// $('#informe_zona').click(function()
// {
//     var zona=$('#informe_zona').val();
//         if(zona==""){
//             return false;
//         }

//     var url = URLdominio + "buscar_tienda_zona";

//     $.ajax({
//         url: url,
//         type: "GET",
//         data: {
//           zona: zona,
//         },
//         dataType: "json",
//         success: function(respuesta) {
//             alert(respuesta);
//           $("#informe_tienda_select").prop('disabled', false);
//         //   $("#informe_tienda_select").html(respuesta);
          
//         }
//       });
// });