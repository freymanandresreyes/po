@extends('layout')
@section('contenido')
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
                        <th>Cantidad</th>
                        <th>nombre cliente</th>
                        <th>cedula cliente</th>
                        <th>Descripcion</th>
                        <th>Estado</th>
                        <th>Opciones</th>
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
                            <td>{{ $reg->cantidad }}</td>
                            <td>{{ $reg['clientesdevolucines']['nombres'] }}</td>
                            <td>{{ $reg['clientesdevolucines']['documento'] }}</td>
                            <td>{{ $reg->descripcion_entrega }}</td>
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
                                <div class="label label-table label-warning">Devolución</div>
                                @endif
                            </td>
                            <td>   
                                @if($reg->estado==3 || $reg->estado==5) 
                                <button type="button" class="btn btn-success entregar" name="{{ $reg->id }}"> 
                                    <i class="mdi mdi-arrow-right-bold"></i> 
                                </button> 
                                @else 
                                @endif  
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
