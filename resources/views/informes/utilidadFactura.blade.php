@extends('layout') 
@section('contenido') {{-- AQUI INICI LA PARTE DE ASIGNAR UNA CAJA A UN EMPLEADO --}}
<br>
<div class="row menu_ocultar">
  <div class="col-lg-12">
    <div class="card ">
      <div class="card-header bg-info">
        <h4 class="m-b-0 text-white">MARGEN DE UTILIDAD POR FACTURA</h4>
      </div>
      <div class="card-body">
        <form action="{{ route('utilidad_factura_consultar') }}" class="form-horizontal" method="POST">
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
                    <select type="" name="informe_tienda_select" class="form-control custom-select" id="informe_tienda_select" disabled>
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
                    <input type="date" name="fecha_inicio" class="form-control custom-select" id="fecha_inicio">

                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Fin:</label>
                  <div class="col-md-9">
                    <input type="date" name="fecha_fin" class="form-control custom-select" id="fecha_fin">
                  </div>
                </div>
              </div>
            </div>
            <div class="text-right">         
             <button type="submit" class="btn btn-success" id="buscar_informe_utilidad_factura">Generar</button>  
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


{{-- AQUI INICI LA PARTE DE ASIGNAR UNA CAJA A UN EMPLEADO --}}
<br>
<div >
  @if(isset($facturas))
  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-body">
                  <h4 class="card-title">INFORME</h4>
                  <h6 class="card-subtitle">Informe de utilidades por factura.</h6>
                  <div id="titulo_informe" style="display: none">
                       {{ $consulta_tiendas->nombre_tienda }}
                  </div>
                  <div id="titulo" style="display: none">
                      Motivo: INFORME DE UTILIDADES POR FACTURA.
                      
                      Sucursal: {{ $consulta_tiendas->nombre_tienda }}
                      Dirección: {{ $consulta_tiendas->direccion_tienda }}
                      Nit: {{ $consulta_tiendas->nit_tienda }}
                      Desde: {{ $inicio }}
                      Hasta: {{ $fin }}
                  </div>
                      
                  <div class="table-responsive m-t-40">
                      <table id="example25" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                          <thead>
                             
                              <tr>
                                  
                                  <th>Nº FACT</th>
                                  <th>FECHA</th>
                                  <th>CODIGO</th>
                                  <th>NOMBRE</th>
                                  <th>BASE</th>
                                  <th>COSTO</th>
                                  <th>V/R UTILID</th>
                                  <th>% UTILIDAD</th>
                              </tr>
                          </thead>
                          <tbody>
                            @php
                              $i = 0;
                            @endphp
                          @foreach($facturas as $factura)
                            <tr>
                              <td>{{ $factura->n_factura }}</td>
                              <td>{{ $factura->created_at->format('d/m/Y') }}</td>
                              <td>{{ $factura->clientesfactura->documento }}</td>
                              <td>{{ $factura->clientesfactura->nombres }}</td>
                              <td>{{ Round($factura->precio_oferta/1.19,0) }}</td>
                              <td>{{ $factura->precio_costo }}</td>
                              <td>{{ Round($factura->precio_oferta/1.19,0)-$factura->precio_costo }}</td>
                              <td>% {{ $porcentaje[$i] }}</td>
                            </tr>
                          @php
                            $i++;
                          @endphp
                          @endforeach
                          </tbody>
                          <tfoot>
                              <tr>
                                  <th>Nº FACT</th>
                                  <th>FECHA</th>
                                  <th>CODIGO</th>
                                  <th>NOMBRE</th>
                                  <th>{{ number_format(Round($ff/1.19)) }}</th>
                                  <th>COSTO</th>
                                  <th>V/R UTILID</th>
                                  <th>% UTILIDAD</th>
                              </tr>
                          </tfoot>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>
  @endif

</div>
@endsection

@section('script')
<script>
  $('#example25').DataTable( {
                    dom: 'Bfrtip',
                    "aaSorting": [[ 0, "asc" ]],
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
                        "footerCallback": function (row, data, start, end, display) {
                            var api = this.api(), data;
    
                   
                            var intVal = function (i) {
                                return typeof i === 'string' ?
                                    i.replace(/[\$,]/g, '') * 1 :
                                    typeof i === 'number' ?
                                        i : 0;
                            };
    
                    
    
                            total2 = api
                                .column(5)
                                .data()
                                .reduce(function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);
    
                            $(api.column(5).footer()).html(
                                 (Math.round(total2, 2)).toLocaleString()
                            );
    
                            total3 = api
                                .column(6)
                                .data()
                                .reduce(function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);
    
                            $(api.column(6).footer()).html(
                                 (Math.round(total3, 2)).toLocaleString()
                            );
                            total = api
                                .column(7)
                                .data()
                                .reduce(function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);
    
                            $(api.column(7).footer()).html(
                                 (Math.round(total, 2)).toLocaleString()
                            );
                        }
                } );
</script>
@endsection