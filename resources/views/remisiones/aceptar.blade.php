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
                        <th>Cantidad</th>
                        <th>Envio</th>
                        <th>Recibe</th>
                        <th>OPCIONES</th>
                    </tr>

                </thead>
                <tbody id="remisiones_aceptar">
                    @for ($i = 0 ; $i < count($consulta); $i++)
                        <tr>
                            <td>{{ $consulta[$i]->codigo }}</td>
                            <td>{{ $consulta[$i]->cantidad }}</td>
                            <td>{{ $consulta[$i]->tiendaremisionenvia['slug'] }}</td>
                            <td>{{ $consulta[$i]->tiendaremisionrecibe['slug'] }}</td>
                            <td>
                                <button class="btn btn-sm btn-icon btn-success btn-outline aceptando_producto_remision" name="{{ $consulta[$i]->id }}">Aceptar</button>
                                <button class="btn btn-sm btn-icon btn-danger btn-outline rechazar_producto_remision" name="{{ $consulta[$i]->id }}">Rechazar</button>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
