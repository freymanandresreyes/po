@extends('layout')

@section('contenido')

{{-- AQUI INICI LA PARTE DE ASIGNAR UNA CAJA A UN EMPLEADO --}}
<br>
  <div class="row">
    <div class="col-lg-12">
      <div class="card ">
        <div class="card-header bg-info">
          <h4 class="m-b-0 text-white">INFORMES DE VENTAS</h4>
        </div>
        <div class="card-body">

            <form action="{{ route('generar_informe') }}" method="POST" class="form-horizontal">
              {{ csrf_field() }}
                <div class="form-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="control-label text-right col-md-3">Zonas:</label>
                        <div class="col-md-9">
                          <select type="date" class="form-control custom-select" id="informe_zona">
                            <option value="">Elija una zona.</option>
                            @foreach ($zonas as $reg)
                              <option value="{{ $reg->id }}">{{ $reg->nombre }}</option>                          
                            @endforeach
                          </select>
      
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="control-label text-right col-md-3">Tienda:</label>
                        <div class="col-md-9">
                          <select type="" class="form-control custom-select" name="diario_tienda" id="informe_tienda_select" disabled>
                            <option value="">Elija una tienda</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                 
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="control-label text-right col-md-3">Inicio:</label>
                        <div class="col-md-9">
                          <input type="date" class="form-control custom-select" name="diario_inicio" id="fecha_inicio">
      
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="control-label text-right col-md-3">Fin:</label>
                        <div class="col-md-9">
                          <input type="date" class="form-control custom-select" name="diario_fin" id="fecha_fin">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="control-label text-right col-md-3">formas de pago:</label>
                          <div class="col-md-9">
                              <select type="date" class="form-control custom-select" name="diario_pago" id="informe_pago">
                                  <option value="">Seleccione una forma de pago</option>
                                  <option value="0">todos</option>
                                  <option value="1">Pagos en efectivo</option>
                                  <option value="2">Pagos con tarjeta</option>
                                  <option value="3">Pagos mistos</option>
                              </select>
                            
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="text-right">
                      <button type="submit" class="btn btn-success" id="buscar_informe">generar</button>
                    </div>
                </div>
              </form>

        </div>
      </div>
    </div>
  </div>

{{-- AQUI INICI LA PARTE DE ASIGNAR UNA CAJA A UN EMPLEADO --}}
<br>
<div id="informe_general">
  @if(isset($objeto_final))
  <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Informe de ventas</h4>
                <div id="titulo_informe" style="display: none">
                        {{ $consulta_tiendas->nombre_tienda }}
                   </div>
                   <div id="titulo" style="display: none">
                       Motivo: INFORME DE VENTAS.
                       
                       Sucursal: {{ $consulta_tiendas->nombre_tienda }}
                       Dirección: {{ $consulta_tiendas->direccion_tienda }}
                       Nit: {{ $consulta_tiendas->nit_tienda }}
                       Desde: {{ $fecha1 }}
                       Hasta: {{ $fecha2 }}
                   </div>
                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                <div class="table-responsive m-t-40">
                    <table id="examplediario" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="display: none">ID</th>
                                <th>Nº FACT</th>
                                <th>FECHA</th>
                                <th>CODIGO</th>
                                <th>NOMBRE</th>
                                <th>BASE</th>
                                <th>IVA</th>
                                <th>IVA EXC</th>
                                <th>I.CONS</th>
                                <th>RETENC</th>
                                <th>NETO</th>   
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th style="display: none">-</th>
                                <th>-</th>
                                <th>-</th>
                                <th>-</th>
                                <th>TOTAL.</th>
                                <th>BASE</th>
                                <th>IVA</th>
                                <th>IVA EXC</th>
                                <th>I.CONS</th>
                                <th>RETENC</th>
                                <th>NETO</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @for ($i = 0; $i < count($objeto_final) ; $i++)
                               
                                <tr>
                                    <td style="display: none">{{ $objeto_final[$i][7] }}</td> 
                                    <td>{{ $objeto_final[$i][0] }}</td> 
                                    <td>{{ $objeto_final[$i][1] }}</td>
                                    <td>{{ $objeto_final[$i][2] }}</td>
                                    <td>{{ $objeto_final[$i][3] }}</td>
                                    <td>{{ $objeto_final[$i][4] }}</td>
                                    <td>{{ $objeto_final[$i][5] }}</td>
                                    <td>0.00</td>
                                    <td>0.00</td>
                                    <td>0.00</td>
                                    <td>{{ round($objeto_final[$i][6]) }}</td>
                                    
                                        
                                </tr> 
                               
                            @endfor
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>   
    </div>
    @endif
</div>
</div>


@endsection

@section('script')
<script>
   var titulo = $('#titulo').text();
            $('#examplediario').DataTable( {
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
         
                            if ( printCounter === 1 ) {
                                return 'This is the first time you have printed this document.';
                            }
                            else {
                                return 'You have printed this document '+printCounter+' times';
                            }
                        },
                        messageTop: titulo,
                        footer: true
                    }
                ],
                "columnDefs": [
                    { "type": "numeric-comma", targets: 3 }
                ],
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
         
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
         
                    // Total over all pages
                    total = api
                        .column( 5 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
      
                    // Update footer
                    $( api.column( 5 ).footer() ).html(
                        (Math.round(total, 2)).toLocaleString() 
                    );

                    total2 = api
                        .column( 6 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         

                    // Update footer
                    $( api.column( 6 ).footer() ).html(
                        (Math.round(total2, 2)).toLocaleString() 
                    );

                    total3 = api
                        .column( 7 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
      
                    $( api.column( 7 ).footer() ).html(
                        (Math.round(total3, 2)).toLocaleString() 
                    );

                    total4 = api
                        .column( 8 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
      
                    $( api.column( 8 ).footer() ).html(
                        (Math.round(total4, 2)).toLocaleString() 
                    );

                    total5 = api
                        .column( 9 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
      
                    $( api.column( 9 ).footer() ).html(
                        (Math.round(total5, 2)).toLocaleString() 
                    );

                    total6 = api
                        .column( 10 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
      
                    $( api.column( 10 ).footer() ).html(
                        (Math.round(total6, 2)).toLocaleString() 
                    );
                }
            } );
</script>
@endsection