$('#varios_buscar_informe').click(function (e) {
    // alert('ok');
    var tienda = $('#informe_tienda_select').val();
    var inicio = $('#fecha_inicio').val();
    var fin = $('#fecha_fin').val();
    var subcategoria = $('#producto_varios').val();

    var url = URLdominio + 'generar_informe_varios';

    if (tienda && inicio && fin && subcategoria) {
        
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                
                tienda: tienda,
                inicio: inicio,
                fin: fin,
                subcategoria: subcategoria
    
            },
            dataType: 'json',
            success: function (respuesta) {
                console.log(respuesta);
                $('#informe_general').html(respuesta);
    
                setTimeout(function () {
                    var titulo_informe = $('#titulo_informe').text();
                    var url = document.title = titulo_informe;
    
                    var printCounter = 0;
    
                    // Append a caption to the table before the DataTables initialisation
                    // $('#example25').append('<caption style="caption-side: bottom">A fictional company\'s staff table.</caption>');
                    var titulo = $('#titulo').text();
                    $('#example24').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            'copy',
                            {
                                extend: 'excel',
                                messageTop: titulo,
                                footer: true
                            },
                            {
                                extend: 'pdf',
                                messageTop: titulo,
                                footer: true
    
                            },
                            {
                                extend: 'print',
                                messageTop: function () {
                                    printCounter++;
    
                                    if (printCounter === 1) {
                                        return 'This is the first time you have printed this document.';
                                    }
                                    else {
                                        return 'You have printed this document ' + printCounter + ' times';
                                    }
                                },
                                messageTop: titulo,
                                footer: true
                            }
                        ],
                        "columnDefs": [
                            { "type": "numeric-comma", targets: 3 }
                        ],
                        "footerCallback": function (row, data, start, end, display) {
                            var api = this.api(), data;
    
                            // Remove the formatting to get integer data for summation
                            var intVal = function (i) {
                                return typeof i === 'string' ?
                                    i.replace(/[\$,]/g, '') * 1 :
                                    typeof i === 'number' ?
                                        i : 0;
                            };
    
                            // Total over all pages
                            total = api
                                .column(3)
                                .data()
                                .reduce(function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);
    
    
                            // Update footer
                            $(api.column(3).footer()).html(
                                 (Math.round(total, 2)).toLocaleString()
                            );
    
                            total2 = api
                                .column(5)
                                .data()
                                .reduce(function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);
    
    
                            // Update footer
                            $(api.column(5).footer()).html(
                                '  $ ' + (total2).toLocaleString()
                            );
    
                          
                        }
                    });
    
                }, 2000);
            }
        });
    }else{
        alertify.error("TODOS LOS CAMPOS SON OBLIGATORIOS.");
    }


});