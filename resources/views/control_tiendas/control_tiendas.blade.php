@extends('layout')
@section('contenido')


{{-- AQUI INICIA LA PARTE DE ASIGNAR UNA TIENDA A UN EMPLEADO --}}
<br>
  <div class="row">
    <div class="col-lg-12">
      <div class="card ">
        <div class="card-header bg-info">
          <h4 class="m-b-0 text-white">ASIGNAR TIENDA A UN EMPLEADO</h4>
        </div>
        <div class="card-body">
          <form action="#" class="form-horizontal">
            <div class="form-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Empleados:</label>
                    <div class="col-md-9">
                      <select class="form-control custom-select" id="vendedores">
                        <option selected value="0">Selecciona Una Opción</option>
                        @foreach ( $consultavendedores as $reg)
                          <option  value="{{ $reg->id }}">{{ $reg->name }}</option>
                        @endforeach
                      </select>
                      <small class="form-control-feedback"> Listado De Empleados. </small>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Tiendas:</label>
                    <div class="col-md-9">
                      <select class="form-control custom-select" id="locales">
                        <option selected value="0">Selecciona Una Opción</option>
                        @foreach ( $consultatiendas as $reg)
                          <option  value="{{ $reg->id }}">{{ $reg->slug }}</option>
                        @endforeach
                      </select>
                      <small class="form-control-feedback"> Tiendas Actuales. </small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-right">
                <button type="button" class="btn btn-success" id="asignar_tienda">Asignar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

{{-- AQUI INICIA LA PARTE DE QUITAR UNA TIENDA A UN EMPLEADO --}}
<div class="row">
        <div class="col-lg-12">
          <div class="card ">
            <div class="card-header bg-info">
              <h4 class="m-b-0 text-white">QUITAR TIENDA A UN EMPLEADO</h4>
            </div>
            <div class="card-body">
              <form action="#" class="form-horizontal">
                <div class="form-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="control-label text-right col-md-3">Empleados:</label>
                        <div class="col-md-9">
                          <select class="form-control custom-select" id="vendedores_quitar">
                            <option value="0" selected>Selecciona Una Opción</option>
                            @foreach ( $consultavendedores as $reg)
                            <option  value="{{ $reg->id }}">{{ $reg->name }}</option>
                            @endforeach 
                          </select>
                          <small class="form-control-feedback"> Listado De Empleados. </small>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6" id="input_tienda">

                     </div>
                    </div>
                    <div class="text-right">
                      <button type="button" class="btn btn-success" id="quitartienda">Quitar</button>
                    </div>
                   </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
    @endsection