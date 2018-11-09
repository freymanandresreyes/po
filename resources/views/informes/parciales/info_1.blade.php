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
                        <table id="example24" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
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
    </div>