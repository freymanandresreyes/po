@extends('layout')
@section('contenido')
<!-- Row -->
<div class="row">
  <div class="col-lg-12">
    <div class="card ">
      <div class="card-header bg-info">
        <h4 class="m-b-0 text-white">Caja registradora</h4>
      </div>
      <div class="card">
        <div class="card-body">
          <h3 class="box-title">Entradas De Caja Menor</h3>
          <hr>
          <div class="table-responsive m-t-40" id="nueva-tabla">
            <table id="myTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Cedula</th>
                  <th>Motivo</th>
                  <th>Valor</th>
                  <th>Fecha</th>
                </tr>
              </thead>
              <tbody>
                @foreach($entradas as $reg)
                <tr>
                  <td>{{$reg->entrega}}</td>
                  <td>{{$reg->cedula_entrega}}</td>
                  <td>{{$reg->motivo}}</td>
                  <td>{{$reg->entrada}}</td>
                  <td>{{$reg->updated_at}}</td>
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
@endsection