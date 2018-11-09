@extends('layout') 
@section('contenido')
<!-- Row -->
<!-- ***** estructura input crear producto **** -->
<br>
<!--inicio alertas-->
{{--
  @include('producto.parciales.error') --}}
  @include('producto.parciales.errores')
<!--fin alertas-->
<div class="row">
  <div class="col-lg-12">
    <div class="card ">
      <div class="card-header bg-info">
        <h4 class="m-b-0 text-white">Registrar Productos</h4>
      </div>
      <div class="card-body">
        {!! Form::open(['route' => 'pepito','class' => 'form-horizontal']) !!}
          @include('producto.parciales.form') {!! Form::close()
        !!}
      </div>
    </div>
  </div>
</div>
</div>
<!-- ***** fin estructura input crear producto **** -->
<!--  modal categorias -->
<div id="modal-categoria" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
  style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Crear categoria</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group" id="error-categoria">
            <label for="recipient-name" class="control-label">Categoria:</label>
            <input type="text" class="form-control" id="categoria-modal">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="cerrar-categoria">Cerrar</button>
        <button type="button" class="btn btn-success waves-effect waves-light" id="guardar-categoria">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- fin modal categorias -->

<!--  modal subcategorias -->
<div id="modal-subcategoria" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
  style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Crear subcategoria</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group" id="error-subcategoria">
            <label for="recipient-name" class="control-label">Subcategoria:</label>
            <input type="text" class="form-control" id="subcategoria-modal">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="cerrar-subcategoria">Cerrar</button>
        <button type="button" class="btn btn-success waves-effect waves-light" id="guardar-subcategoria">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- fin modal subcategorias -->
@endsection
