
// $('#buscar_informe_utilidad_factura').click(function () {
//     var tienda = $('#informe_tienda_select').val();
//     var inicio = $('#fecha_inicio').val();
//     var fin = $('#fecha_fin').val();

//     var url = URLdominio + 'utilidad_factura_consultar';
//     console.log(url);
//     $.ajax({
//         url: url,
//         type: 'GET',
//         data: {
//             tienda: tienda,
//             inicio: inicio,
//             fin: fin
//         },
//         dataType: 'json',
//         success: function (respuesta) {
//             console.log(respuesta);
//             $('#informe_generado').html(respuesta);
            
//             setTimeout(function () {
//                 var titulo_informe = $('#titulo_informe').text();
//                 var url = document.title = titulo_informe;
                
//                 var printCounter = 0;
 
//                 // Append a caption to the table before the DataTables initialisation
//                 // $('#example25').append('<caption style="caption-side: bottom">A fictional company\'s staff table.</caption>');
//                 var titulo = $('#titulo').text();
//                 $('#example25').DataTable( {
//                     dom: 'Bfrtip',
//                     "aaSorting": [[ 0, "asc" ]],
//                     buttons: [
//                         'copy',
//                         {
//                             extend: 'excel',
//                             messageTop: titulo,
//                             footer: true
//                         },
//                         {
//                             extend: 'pdf',
//                             messageTop: titulo,
//                             footer: true
                            
//                         },
//                         {
//                             extend: 'print',
//                             messageTop: function () {
//                                 printCounter++;
             
//                                 if ( printCounter === 1 ) {
//                                     return 'This is the first time you have printed this document.';
//                                 }
//                                 else {
//                                     return 'You have printed this document '+printCounter+' times';
//                                 }
//                             },
//                             messageTop: titulo,
//                             footer: true
//                         }
//                     ],

//                         "columnDefs": [
//                             { "type": "numeric-comma", targets: 3 }
//                         ],
//                         "footerCallback": function (row, data, start, end, display) {
//                             var api = this.api(), data;
    
                   
//                             var intVal = function (i) {
//                                 return typeof i === 'string' ?
//                                     i.replace(/[\$,]/g, '') * 1 :
//                                     typeof i === 'number' ?
//                                         i : 0;
//                             };
    
                    
//                             total = api
//                                 .column(4)
//                                 .data()
//                                 .reduce(function (a, b) {
//                                     return intVal(a) + intVal(b);
//                                 }, 0);
    
//                             $(api.column(4).footer()).html(
//                                  (Math.round(total, 2)).toLocaleString()
//                             );
    
//                             total2 = api
//                                 .column(5)
//                                 .data()
//                                 .reduce(function (a, b) {
//                                     return intVal(a) + intVal(b);
//                                 }, 0);
    
//                             $(api.column(5).footer()).html(
//                                  (Math.round(total2, 2)).toLocaleString()
//                             );
    
//                             total3 = api
//                                 .column(6)
//                                 .data()
//                                 .reduce(function (a, b) {
//                                     return intVal(a) + intVal(b);
//                                 }, 0);
    
//                             $(api.column(6).footer()).html(
//                                  (Math.round(total3, 2)).toLocaleString()
//                             );
//                         }
//                 } );
      
//             }, 3000);
//         }
//     });
// });

//FUNCION PARA IMPRIMIR

$('#imprimir_informe_diario_zonas').click(function (e) {
    var tienda = $('#informe_tienda_select').val();
    var fecha_inicio = $('#fecha_inicio').val();
    var fecha_fin = $('#fecha_fin').val();

    if (fecha_inicio == "" || fecha_fin == "") {
        alertify.alert("<b>Se debe elejir un rango de fechas.", function () {
            return false;
        });
    } else {
        var url = URLdominio + 'informe_diario_imprimir_zona';
        console.log(url);
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                tienda: tienda,
                fecha_inicio: fecha_inicio,
                fecha_fin: fecha_fin,
            },
            dataType: 'json',
            success: function (respuesta) {
                console.log(respuesta);
                $('#vista_info_diario').html(respuesta);

                window.print();
                $('#vista_info_diario').html("");
            }

        });
    }

});