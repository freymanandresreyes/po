function resumenTicket() {

    var tienda = $('#informe_tienda_select').val();
    var fecha_inicio = $('#fecha_inicio').val();
    var fecha_fin = $('#fecha_fin').val();

    if (tienda && fecha_inicio && fecha_fin) {

        var url = getAbsolutePath() + 'resumen_ticket';

        $.ajax({
            url: url,
            type: 'POST',
            headers: { 'X-CSRF-Token': $('meta[name=_token]').attr('content') },
            data: {
                tienda: tienda,
                fecha_inicio: fecha_inicio,
                fecha_fin: fecha_fin
            },
            dataType: 'json',
            success: function (respuesta) {
                $('#tabla_resumen').html(respuesta);

                // almacenar la data 
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

                console.log(data);

                $('#example26').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copy',
                        {
                            extend: 'excel',
                            footer: true
                        },
                        {
                            extend: 'pdf',
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
                            footer: true
                        }
                    ],
                    "columnDefs": [
                        {
                            "targets": 0, // your case first column
                            "className": "text-center",
                            "width": "1%"
                       },
                       {
                        "targets": 1, // your case first column
                        "className": "text-center",
                        "width": "1%"
                        },
                        {
                            "targets": 2, // your case first column
                            "className": "text-center",
                            "width": "1%"
                        },
                        {
                            "targets": 3, // your case first column
                            "className": "text-center",
                            "width": "1%"
                        },
                        {
                            "targets": 4, // your case first column
                            "className": "text-center",
                            "width": "1%"
                        },
                        {
                            "targets": 5, // your case first column
                            "className": "text-center",
                            "width": "1%"
                        },
                        {   "type": "numeric-comma", 
                            targets: 3
                     }
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
                            .column(1)
                            .data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);


                        // Update footer
                        $(api.column(1).footer()).html(
                            (Math.round(total, 2)).toLocaleString()
                        );
                        
                        total2 = api
                            .column(2)
                            .data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);


                        // Update footer
                        $(api.column(2).footer()).html(
                            (Math.round(total2, 2)).toLocaleString()
                        );
                        total3 = api
                            .column(5)
                            .data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);


                        // Update footer
                        $(api.column(5).footer()).html(
                            '  $ ' + (Math.round(total3, 2)).toLocaleString()
                        );
                    }
                });

            }//fin del success
        });//fin de ajax
        // descarga_exel();

    }




};

/******************************************* */
/******************************************* */
/******************************************* */
$('#ticket_buscar').click(function () {

    var tienda = $('#informe_tienda_select').val();
    var fecha_inicio = $('#fecha_inicio').val();
    var fecha_fin = $('#fecha_fin').val();

    if (tienda && fecha_inicio && fecha_fin) {
        $('#descarga').css({
            "display": "block"
        });
        var url = getAbsolutePath() + 'ticket_buscar';

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                tienda: tienda,
                fecha_inicio: fecha_inicio,
                fecha_fin: fecha_fin
            },
            dataType: 'json',
            success: function (respuesta) {

                if (respuesta) {
                    var asesores = new Array();
                    var facturas = new Array();

                    for (var i = 0; i < respuesta.length; i++) {

                        asesores.push(respuesta[i].vendedoresfactura.nombres);
                    }

                    for (var i = 0; i < respuesta.length; i++) {

                        facturas.push(respuesta[i].n_factura);
                    }

                    var unique_asesores = asesores.filter((v, i, a) => a.indexOf(v) === i);
                    var unique_facturas = facturas.filter((v, i, a) => a.indexOf(v) === i);


                    //*** */
                    var datos_suma_ventas = new Array();
                    var datos_promedio_tickets = new Array();
                    var datos_promedio_unidades_tickets = new Array();
                    var datos_nombres_ventas = new Array();

                    var datos_cantidad_facturas = new Array();//numero de facturas generadas
                    var datos_cantidad_productos = new Array();//cantidad de productos vendidos
                    console.log(datos_cantidad_facturas);
                    console.log(datos_cantidad_productos);
                    var suma_ventas = null;
                    var nombres_ventas = null;

                    var cantidad_productos_total = [];
                    var suma_productos_total = null;
                    var total_ventas = null;
                    respuesta.forEach(element => {
                        cantidad_productos_total.push(element.n_factura);
                        var valor = (parseInt(element.total)) / 1.19;
                        // alert((parseInt(valor)));
                        total_ventas = total_ventas + parseInt(valor);

                    });
                    suma_productos_total = cantidad_productos_total.length;
                    var producto_total_unico = cantidad_productos_total.filter((v, i, a) => a.indexOf(v) === i);
                    cantidad_productos_total = producto_total_unico;

                    cantidad_productos_total = cantidad_productos_total.length;
                    //promedio de ticket por tienda
                    var total_ventas_sin_iva = total_ventas;

                    var promedio_tienda = Math.round(total_ventas_sin_iva / cantidad_productos_total);
                    var promedio_unidades_tienda = Math.ceil(suma_productos_total / total_ventas_sin_iva);
                    // console.log(promedio_tienda);
                    // console.log(promedio_unidades_tienda);

                    for (var i = 0; i < unique_asesores.length; i++) {
                        // for (var i = 0; i < 1; i++) {
                        var datos_cantidad_productos_suma = [];

                        respuesta.forEach(element => {
                            //  operaciones para tienda general

                            if (element.vendedoresfactura.nombres == unique_asesores[i]) {
                                var valor = (parseInt(element.total)) / 1.19;
                                suma_ventas = suma_ventas + parseInt(valor);//hacer dinamico el iva
                                nombres_ventas = element.vendedoresfactura.nombres;
                                datos_cantidad_productos_suma.push(element.n_factura);

                            }
                        });
                        //contamos la cantidad de productos vendidos por asesor
                        var suma_p = datos_cantidad_productos_suma.length;
                        datos_cantidad_productos.push(suma_p);

                        //contamos la cantidad de facturas generadas por asesor
                        var facturas_generadas = datos_cantidad_productos_suma.filter((v, i, a) => a.indexOf(v) === i);
                        var suma_f = facturas_generadas.length;
                        datos_cantidad_facturas.push(suma_f);

                        //valor ticket promedio
                        var promedio_ticket = suma_ventas / suma_f;
                        datos_promedio_tickets.push(Math.round(promedio_ticket));

                        //valor unidades por ticket
                        var promedio_unidades_ticket = suma_p / suma_f;
                        datos_promedio_unidades_tickets.push(promedio_unidades_ticket.toFixed(2));

                        datos_cantidad_productos_suma = null;

                        // console.log(cantidad_productos_total);
                        // console.log(datos_cantidad_productos);

                        datos_suma_ventas.push(suma_ventas);
                        datos_nombres_ventas.push(nombres_ventas);
                        suma_ventas = null;
                        nombres_ventas = null;

                    }
                    //reset tabla 
                    $("#promedios_tickets").html("");
                    $('#ocultar_ticket').css({
                        "display": "block"
                    });

                    $('#descarga').css({
                        "display": "none"
                    });
                    // ============================================================== 
                    // GRAFICA POR TIENDA
                    // ============================================================== 
                    var myChart = echarts.init(document.getElementById('bar-chart-tienda'));

                    // specify chart configuration item and data
                    option = {
                        tooltip: {
                            trigger: 'axis'
                        },
                        legend: {
                            data: ['UNIDADES POR TICKET', 'TICKET PROMEDIO']
                        },
                        toolbox: {
                            show: true,
                            feature: {

                                magicType: { show: true, type: ['line', 'bar'] },
                                restore: { show: true },
                                saveAsImage: { show: true }
                            }
                        },
                        color: ["#55ce63", "#009efb"],
                        calculable: true,
                        xAxis: [
                            {
                                type: 'category',
                                data: ['tiendas 1']
                            }
                        ],
                        yAxis: [
                            {
                                type: 'value'
                            }
                        ],
                        series: [
                            {
                                name: 'TICKET PROMEDIO',
                                type: 'bar',
                                data: [(promedio_tienda)],
                                markPoint: {
                                    data: [

                                    ]
                                },
                                markLine: {
                                    data: [
                                        { type: 'average', name: 'Average' }
                                    ]
                                }
                            },
                            {
                                name: 'UNIDADES POR TICKET',
                                type: 'bar',
                                data: [promedio_unidades_tienda],
                                markPoint: {
                                    data: [

                                    ]
                                },
                                markLine: {
                                    data: [
                                        { type: 'average', name: 'Average' }
                                    ]
                                }
                            }
                        ]
                    };


                    // use configuration item and data specified to show chart
                    myChart.setOption(option, true), $(function () {
                        function resize() {
                            setTimeout(function () {
                                myChart.resize()
                            }, 100)
                        }
                        $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
                    });

                    // ============================================================== 
                    // Bar chart option
                    // ============================================================== 
                    var myChart = echarts.init(document.getElementById('bar-chart'));

                    // specify chart configuration item and data
                    option = {
                        tooltip: {
                            trigger: 'axis'
                        },
                        legend: {
                            data: ['UNIDADES POR TICKET', 'TICKET PROMEDIO']
                        },
                        toolbox: {
                            show: true,
                            feature: {

                                magicType: { show: true, type: ['line', 'bar'] },
                                restore: { show: true },
                                saveAsImage: { show: true }
                            }
                        },
                        color: ["#55ce63", "#009efb"],
                        calculable: true,
                        xAxis: [
                            {
                                type: 'category',
                                data: datos_nombres_ventas
                            }
                        ],
                        yAxis: [
                            {
                                type: 'value'
                            }
                        ],
                        series: [
                            {
                                name: 'UNIDADES POR TICKET',
                                type: 'bar',
                                data: datos_promedio_unidades_tickets,
                                markPoint: {
                                    data: [
                                        { type: 'max', name: 'Max' },
                                        { type: 'min', name: 'Min' }
                                    ]
                                },
                                markLine: {
                                    data: [
                                        { type: 'average', name: 'Average' }
                                    ]
                                }
                            },
                            {
                                name: 'TICKET PROMEDIO',
                                type: 'bar',
                                data: datos_promedio_tickets,
                                markPoint: {
                                    data: [
                                        { type: 'max', name: 'Max' },
                                        { type: 'min', name: 'Min' }
                                    ]
                                },
                                markLine: {
                                    data: [
                                        { type: 'average', name: 'Average' }
                                    ]
                                }
                            }
                        ]
                    };


                    // use configuration item and data specified to show chart
                    myChart.setOption(option, true), $(function () {
                        function resize() {
                            setTimeout(function () {
                                myChart.resize()
                            }, 100)
                        }
                        $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
                    });

                    resumenTicket();


                    // for (var i = 0; i < datos_nombres_ventas.length; i++) {
                    //     // alert('ok');

                    //     var fila = '<tr class="dato"><td> ' + datos_nombres_ventas[i] +
                    //         '</td><td>' + datos_cantidad_productos[i] +
                    //         '</td><td>' + datos_cantidad_facturas[i] +
                    //         '</td><td>' + ((datos_promedio_tickets[i]).toLocaleString()) +
                    //         '</td><td>' + datos_promedio_unidades_tickets[i] +
                    //         '</td><td>' + (datos_suma_ventas[i].toLocaleString()) +
                    //         '</td></tr>';

                    //     $("#promedios_tickets").append(fila);

                    // }
                    // setTimeout(function(){


                    // $('#example26').DataTable({
                    //     destroy: true,
                    //     dom: 'Bfrtip',
                    //     buttons: [
                    //         'copy', 'csv', 'excel', 'pdf', 'print'
                    //     ]
                    // });

                    //     }, 1800);






                }//fin del if

            }//fin del success
        });//fin de ajax
        // descarga_exel();

    } else {
        alertify.error("Todos los campos son obligatorios");
        return false;
    }




});



// function descarga_exel() {



    // return false;
// }