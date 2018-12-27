@extends('layout') 
@section('contenido')
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="card ">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">MODULO DE CLIENTES</h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive m-t-40">
                        <table id="example23" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Documento</th>
                                    <th>Correo</th>
                                    <th>telefono</th>
                                    <th>Direccion</th>
                                    <th>Fecha Nacimiento</th>
                                    <th>Mayorista</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                            <tbody id="cont_inventario">
                                @foreach ($consulta as $reg)
                                <tr>
                                    <td>{{$reg->nombres}}</td>
                                    <td>{{$reg->apellidos}}</td>
                                    <td>{{$reg->documento}}</td>
                                    <td>{{$reg->correo}}</td>
                                    <td>{{$reg->telefono}}</td>
                                    <td>{{$reg->direccion}}</td>
                                    <td>{{$reg->fecha_nacimiento}}</td>
                                    <td>
                                     @if($reg->configuracion == 1)
                                        <span class="label label-danger">NO</span>
                                     @else
                                        <span class="label label-success">SI</span>
                                     @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-success editar_cliente" name="{{ $reg->id }}">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection