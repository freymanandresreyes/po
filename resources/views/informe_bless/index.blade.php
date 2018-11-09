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

            <form action="{{ route('bless_generar') }}" method="POST" class="form-horizontal">
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
                          <select type="" class="form-control custom-select" name="tienda" id="informe_tienda_select" disabled>
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
                          <input type="date" class="form-control custom-select" name="inicio" id="fecha_inicio">
      
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="control-label text-right col-md-3">Fin:</label>
                        <div class="col-md-9">
                          <input type="date" class="form-control custom-select" name="fin" id="fecha_fin">
                        </div>
                      </div>
                    </div>
                   
                  </div>
                  <div class="text-right">
                      <button type="submit" class="btn btn-success" id="buscar_informe_sistecredito">generar</button>
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
  @if(isset($busqueda))
  <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Informe de ventas</h4>
                <div id="titulo_informe" style="display: none">
                        {{-- {{ $consulta_tiendas->nombre_tienda }} --}}
                   </div>
                   <div id="titulo" style="display: none">
                       {{-- Motivo: INFORME DE VENTAS.
                       
                       Sucursal: {{ $consulta_tiendas->nombre_tienda }}
                       Dirección: {{ $consulta_tiendas->direccion_tienda }}
                       Nit: {{ $consulta_tiendas->nit_tienda }}
                       Desde: {{ $fecha1 }}
                       Hasta: {{ $fecha2 }} --}}
                   </div>
                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                <div class="table-responsive m-t-40">
                    <table id="examplediario" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>NOMBRES</th>
                                <th>APELLIDOS</th>
                                <th>DOCUMENTO</th>
                                <th>FECHA</th>
                                <th>VALOR</th>
                                  
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                
                                <th>-</th>
                                <th>-</th>
                                <th>-</th>
                                <th>TOTAL.</th>
                                <th>BASE</th>
                                
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($busqueda as $reg)
                                
                           
                               
                                <tr>
                                   
                                    <td>{{ $reg->clientesfactura->nombres }}</td> 
                                    <td>{{ $reg->clientesfactura->apellidos }}</td> 
                                    <td>{{ $reg->clientesfactura->documento }}</td> 
                                    <td>{{ ($reg->created_at)->format('d/m/Y')}}</td> 
                                    <td>{{ $reg->pagos_bless }}</td> 
                                    
                                        
                                </tr> 
                               
                                @endforeach
                           
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
            $('#examplediario').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy',
                    {
                        extend: 'excel',
                        // messageTop: titulo,
                        footer: true
                    },
                    {
                        extend: 'pdf',
                        // messageTop: titulo,
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
                        // messageTop: titulo,
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
                        .column( 4 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
      
                    // Update footer
                    $( api.column( 4 ).footer() ).html(
                        (Math.round(total, 2)).toLocaleString() 
                    );
                }
            } );
</script>
@endsection