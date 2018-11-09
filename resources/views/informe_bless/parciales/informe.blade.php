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
                                <th style="display:none">Nº</th>
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
                            @for ($i = 0; $i< count($objeto_final) ; $i++) 
                            <tr>
                                <td style="display:none">{{ $i }}</td>
                                <td>{{ $objeto_final[$i][0] }}</td>
                                <td>{{ $objeto_final[$i][1] }}</td>
                                <td>{{ $objeto_final[$i][2] }}</td>
                                <td>{{ $objeto_final[$i][3] }}</td>
                                <td>{{ number_format($objeto_final[$i][4], 2, '.', ',') }}</td>
                                <td>{{ number_format($objeto_final[$i][5], 2, '.', ',') }}</td>
                                <td>{{ number_format($objeto_final[$i][6], 2, '.', ',') }}</td>
                                <td>{{ '% '.$objeto_final[$i][7] }}</td>
                            </tr>
                            @endfor


                        </tbody>
                        <tfoot>
                            <tr>
                                <th>-</th>
                                <th>-</th>
                                <th>-</th>
                                <th>TOTAL.</th>
                                <th>BASE</th>
                                <th>COSTO</th>
                                <th>V/R UTILID</th>
                                <th>-</th>

                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>