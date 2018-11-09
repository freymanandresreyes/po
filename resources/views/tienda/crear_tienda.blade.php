@extends('layout')
@section('contenido')
<!-- Row -->
<br>
<div class="row">
  <div class="col-lg-12">
    <div class="card ">
      <div class="card-header bg-info">
        <h4 class="m-b-0 text-white">Caja registradora</h4>
      </div>
      <div class="card">
        <div class="card-body">
          <h3 class="box-title">TIENDAS</h3>
          <hr>
          <a class="btn waves-effect waves-light btn-rounded btn-outline-info mdi mdi-open-in-new" id="crear_tienda"> NUEVA TIENDA</a>
          <div class="table-responsive m-t-40" id="nueva-tabla">
            <table id="myTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Encargado</th>
                  <th>Nit</th>
                  <th>Slug</th>
                  <th>Dirección</th>
                  <th>Ciudad</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="editar_tienda" >
                @foreach($consulta as $reg)
                <tr>
                  <td>{{$reg->nombre_tienda}}</td>
                  <td>{{$reg->encargado}}</td>
                  <td>{{$reg->nit_tienda}}</td>
                  <td>{{$reg->slug}}</td>
                  <td>{{$reg->direccion_tienda}}</td>
                  <td>{{$reg->ciudad}}</td>
                  <td><a class="ti-pencil"  value="{{$reg->id}}" href=""></a></td>
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
<!-- Row -->




@endsection

@section('factura')
 <div class="row">
    
    <div id="modal_tienda" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content" id="factura_compra">
          <div class="modal-body" >
            {!! Form::open(['route' => 'nueva_tienda.crear','id'=>'form','method' => 'get'])!!}
            <div class="form-group" id="grup_id">
              {!! Form::text('nombre_tienda', null, ['class'=>'form-control','style'=>'display:none', 'id'=>'id']) !!}
            </div>
            <div class="form-group" id="grup_nombre_tienda">
              {!! Form::label('nombre_tienda', 'Nombre',['class'=>'control-label']) !!}
              {!! Form::text('nombre_tienda', null, ['class'=>'form-control','required', 'id'=>'nombre_tienda']) !!}
            </div>
            <div class="form-group" id="group_slug">
                {!! Form::label('slug', 'Slug',['class'=>'control-label']) !!}
                {!! Form::text('slug', null, ['class'=>'form-control','required', 'id'=>'slug']) !!}
            </div>
            <div class="form-group" id="group_telefono">
                {!! Form::label('telefono', 'Telefono',['class'=>'control-label']) !!}
                {!! Form::text('telefono', null, ['class'=>'form-control','required', 'id'=>'telefono']) !!}
            </div>
            <div class="form-group" id="grup_encargado">
              {!! Form::label('encargado', 'Encargado',['class'=>'control-label']) !!}
              {!! Form::text('encargado', null, ['class'=>'form-control', 'required','id'=>'encargado']) !!}
            </div>
            <div class="form-group" id="grup_nit_tienda">
              {!! Form::label('nit_tienda', 'Nit',['class'=>'control-label']) !!}
              {!! Form::text('nit_tienda', null, ['class'=>'form-control','required', 'id'=>'nit']) !!}
            </div>
            <div class="form-group" id="grup_direccion_tienda">
              {!! Form::label('direccion_tienda', 'Dirección',['class'=>'control-label']) !!}
              {!! Form::text('direccion_tienda', null, ['class'=>'form-control','required', 'id'=>'direccion']) !!}
            </div>
            <div class="form-group" id="grup_resolucion">
              {!! Form::label('resolucion', 'Resolucion',['class'=>'control-label']) !!}
              {!! Form::text('resolucion', null, ['class'=>'form-control','required', 'id'=>'resolucion']) !!}
            </div>
            <div class="form-group" id="grup_fecha_resolucion">
              {!! Form::label('fecha_resolucion', 'Fecha De Resolucion',['class'=>'control-label']) !!}
              {!! Form::date('fecha_resolucion', null, ['class'=>'form-control','required', 'id'=>'fecha_resolucion']) !!}
            </div>
            <div class="form-group" id="grup_prefijo">
              {!! Form::label('prefijo', 'Prefijo',['class'=>'control-label']) !!}
              {!! Form::text('prefijo', null, ['class'=>'form-control','required', 'id'=>'prefijo']) !!}
            </div>
            <div class="form-group" id="grup_ciudad">
              {!! Form::label('ciudad', 'Ciudad',['class'=>'control-label']) !!}
              {!! Form::text('ciudad', null, ['class'=>'form-control','required', 'id'=>'ciudad']) !!}
            </div>
            <div class="form-group row">
              <div class="col-sm-12">
              {!! Form::label('grupo', 'Grupo',['class'=>'control-label']) !!}
              {!!Form::select('grupo', $consulta_grupo ,null,['class'=>'form-control','required'])!!}
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="cerrar_tienda">Cerrar</button>
              {!! Form::button('Guardar', ['class'=>'btn btn-info waves-effect waves-light', 'id'=>'guardar_tienda', 'type'=> 'submit']) !!}
              {!! Form::button('Actualizar', ['class'=>'btn btn-success waves-effect waves-light', 'style'=>'display:none;' ,'id'=>'actualizar_tienda']) !!}
            </div>
            {!! Form::close() !!}
          </div>
         
        </div>
      </div>
    </div>
    
  </div>

@endsection