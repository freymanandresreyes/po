@extends('layout')
@section('contenido')

<br>

<div class="card">
    <div class="card-body">

        <div class="table-responsive m-t-40">
            <table id="myTable" class="table table-bordered table-striped">
                <thead>

                    <tr>
                        <th>Codigo</th>
                        <th>Fecha</th>
                        <th>Destino</th>
                        <th>Opciones</th>
                    </tr>

                </thead>
                <tbody >    
                    @for ($i = 0 ; $i < count($objeto_final); $i++)
                        <tr>
                            <td>{{ $objeto_final[$i][0] }}</td>
                            <td>{{ $objeto_final[$i][1] }}</td>
                            <td>{{ $objeto_final[$i][2] }}</td>    
                            <td>
                                <button type="button" class="btn btn-secondary ver_remision" name="{{ $objeto_final[$i][0] }}">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </td>    
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
@section('factura')
<div class="row">
    <div id="modal_remision" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog-carta" > 
            <div class="modal-content modal-sinborde">
                <div class="modal-body" id="factura_compra">
                    <div id="datos_remision">
                    </div>
                    
                <div class="text-right">
                    <button class="btn btn-danger ocultar-print" id="cerrar_remision" > Cerrar</button>
                    <button class="btn btn-default btn-outline ocultar-print" id="imprimir_remision"> <span><i class="fa fa-print"></i> Print</span> </button>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection