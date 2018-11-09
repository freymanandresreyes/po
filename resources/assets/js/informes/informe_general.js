// $('#buscar_informe').click(function(e){
//    var tienda = $('#informe_tienda_select').val();
//    var forma_pago = $('#informe_pago').val();
//    var fecha_inicio = $('#fecha_inicio').val();
//    var fecha_fin = $('#fecha_fin').val();

//    var url= URLdominio+'generar_informe';
//    $.ajax({
//      url:url,
//      type: 'GET',
//      data: {
//         fecha_inicio:fecha_inicio,
//         fecha_fin:fecha_fin,
//         tienda: tienda,
//         forma_pago:forma_pago

//      },
//      dataType: 'json',
//      success: function(respuesta){
//         console.log(respuesta);
//         $('#informe_general').html(respuesta);
        
//         setTimeout(function(){
//             var titulo_informe = $('#titulo_informe').text();
//             var url = document.title = titulo_informe;

//             var printCounter = 0;
 
//             // Append a caption to the table before the DataTables initialisation
//             // $('#example25').append('<caption style="caption-side: bottom">A fictional company\'s staff table.</caption>');
//             // var titulo = $('#titulo').text();
//             // $('#example24').DataTable( {
//             //     dom: 'Bfrtip',
//             //     buttons: [
//             //         'copy',
//             //         {
//             //             extend: 'excel',
//             //             messageTop: titulo,
//             //             footer: true
//             //         },
//             //         {
//             //             extend: 'pdf',
//             //             messageTop: titulo,
//             //             footer: true
                        
//             //         },
//             //         {
//             //             extend: 'print',
//             //             messageTop: function () {
//             //                 printCounter++;
         
//             //                 if ( printCounter === 1 ) {
//             //                     return 'This is the first time you have printed this document.';
//             //                 }
//             //                 else {
//             //                     return 'You have printed this document '+printCounter+' times';
//             //                 }
//             //             },
//             //             messageTop: titulo,
//             //             footer: true
//             //         }
//             //     ],
//             //     "columnDefs": [
//             //         { "type": "numeric-comma", targets: 3 }
//             //     ],
//             //     "footerCallback": function ( row, data, start, end, display ) {
//             //         var api = this.api(), data;
         
//             //         // Remove the formatting to get integer data for summation
//             //         var intVal = function ( i ) {
//             //             return typeof i === 'string' ?
//             //                 i.replace(/[\$,]/g, '')*1 :
//             //                 typeof i === 'number' ?
//             //                     i : 0;
//             //         };
         
//             //         // Total over all pages
//             //         total = api
//             //             .column( 4 )
//             //             .data()
//             //             .reduce( function (a, b) {
//             //                 return intVal(a) + intVal(b);
//             //             }, 0 );
         
      
//             //         // Update footer
//             //         $( api.column( 4 ).footer() ).html(
//             //             (Math.round(total, 2)).toLocaleString() 
//             //         );

//             //         total2 = api
//             //             .column( 5 )
//             //             .data()
//             //             .reduce( function (a, b) {
//             //                 return intVal(a) + intVal(b);
//             //             }, 0 );
         

//             //         // Update footer
//             //         $( api.column( 5 ).footer() ).html(
//             //             (Math.round(total2, 2)).toLocaleString() 
//             //         );

//             //         total3 = api
//             //             .column( 6 )
//             //             .data()
//             //             .reduce( function (a, b) {
//             //                 return intVal(a) + intVal(b);
//             //             }, 0 );
      
//             //         $( api.column( 6 ).footer() ).html(
//             //             (Math.round(total3, 2)).toLocaleString() 
//             //         );

//             //         total4 = api
//             //             .column( 7 )
//             //             .data()
//             //             .reduce( function (a, b) {
//             //                 return intVal(a) + intVal(b);
//             //             }, 0 );
      
//             //         $( api.column( 7 ).footer() ).html(
//             //             (Math.round(total4, 2)).toLocaleString() 
//             //         );

//             //         total5 = api
//             //             .column( 8 )
//             //             .data()
//             //             .reduce( function (a, b) {
//             //                 return intVal(a) + intVal(b);
//             //             }, 0 );
      
//             //         $( api.column( 8 ).footer() ).html(
//             //             (Math.round(total5, 2)).toLocaleString() 
//             //         );

//             //         total6 = api
//             //             .column( 9 )
//             //             .data()
//             //             .reduce( function (a, b) {
//             //                 return intVal(a) + intVal(b);
//             //             }, 0 );
      
//             //         $( api.column( 9 ).footer() ).html(
//             //             (Math.round(total6, 2)).toLocaleString() 
//             //         );
//             //     }
//             // } );
       
//             }, 2000);
//      }
//     });

    
// });