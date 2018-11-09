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
                       Desde: {{ $inicio }}
                       Hasta: {{ $fin }}
                   </div>
                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                <div class="table-responsive m-t-40">
                    <table id="example24" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>CODIGO</th>
                                <th>DESCRIPCIÓN</th>
                                <th>UNIDAD</th>
                                <th>CANTIDAD</th>
                                <th>VALOR PROM</th>
                                <th>TOTAL</th>   
                                   
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>TOTAL</th>
                                <th>CANTIDAD</th>
                                <th> &nbsp; </th>
                                <th>TOTAL</th> 
                                
                                
                            </tr>
                        </tfoot>
                        <tbody>
                            
                               
                                <tr>
                                    <td>{{ $codigo }}</td> 
                                    <td>{{ $descripcion }}</td>
                                    <td>UND</td>
                                    <td>{{ $cantidad_facturas }}</td>
                                    <td>{{ $valor_producto }}</td>
                                    
                                    <td>{{ $valor_total }}</td>
                                    
                                        
                                </tr> 
                               
                            
                            {{-- @foreach ($objeto_final as $reg)
                                <tr>
                                    <td>{{ $reg->n_factura }}</td>
                                    <td>{{ $reg->created_at }}</td>
                                    <td>{{ $reg->codigo }}</td>
                                    <td>{{ $reg->id_cliente }}</td>
                                    <td>falta</td>
                                    <td>falta</td>
                                    <td>falta</td>
                                    <td>falta</td>
                                    <td>falta</td>
                                    <td>{{ $reg->total }}</td>
                                    
                                </tr>    
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>   
    </div>
</div>