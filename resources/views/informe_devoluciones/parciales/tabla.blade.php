<div class="card">
    <div class="card-body">
        <h4 class="card-title">Data Export</h4>
        <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
        <div class="table-responsive m-t-40" >
            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Factura</th>
                        <th>Radicado</th>
                        <th>Producto</th>
                        <th>Referencia</th>
                        <th>Valor</th>
                        <th>Valor2</th>
                        <th>Valor3</th>
                        <th>Fecha</th>
                        <th>Cantidad</th>
                        <th>nombre cliente</th>
                        <th>cedula cliente</th>
                        <th>Estado</th>
                        <th>Descripcion</th>
                    </tr>
                </thead>
           
                <tbody id="tabla_devolucion">
                    @foreach ($consulta as $reg)
                        <tr>
                            <td>{{ $reg->factura }}</td>
                            <td>{{ $reg->radicado }}</td>
                            <td>{{ $reg->producto }}</td>
                            <td>{{ $reg->referencia }}</td>
                            <td>{{ $reg->valor }}</td>
                            <td>{{ round($reg->valor/1.19) }}</td>
                            <td>{{ round($reg->valor-$reg->valor/1.19) }}</td>
                            <td>{{ $reg->created_at }}</td>
                            <td>{{ $reg->cantidad }}</td>
                            <td>{{ $reg['clientesdevolucines']['nombres'] }}</td>
                            <td>{{ $reg['clientesdevolucines']['documento'] }}</td>
                            <td>{{ $reg->descripcion_recibo }}</td>
                            <td>
                                @if($reg->estado == 0)
                                <div class="label label-table bg-dark">Recibido</div>
                                @elseif($reg->estado == 1)
                                <div class="label label-table label-danger">Rechazado</div>
                                @elseif($reg->estado == 2)
                                <div class="label label-table label-warning">Proceso</div>
                                @elseif($reg->estado == 3)
                                <div class="label label-table label-info">Cambio</div>
                                @elseif($reg->estado == 4)
                                <div class="label label-table label-success">Entregado</div>
                                @elseif($reg->estado == 5)
                                <div class="label label-table label-warning">Devoluci贸n</div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>