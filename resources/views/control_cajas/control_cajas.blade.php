@extends('layout')
@section('contenido')


{{-- AQUI INICI LA PARTE DE ASIGNAR UNA CAJA A UN EMPLEADO --}}
<br>
  <div class="row">
    <div class="col-lg-12">
      <div class="card ">
        <div class="card-header bg-info">
          <h4 class="m-b-0 text-white">ASIGNAR CAJA A UN EMPLEADO</h4>
        </div>
        <div class="card-body">
          <form action="#" class="form-horizontal">
            <div class="form-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Empleados:</label>
                    <div class="col-md-9">
                      <select class="form-control custom-select" id="usuario">
                        <option value="" selected>Selecciona Una Opción</option>
                        @foreach ( $consultausuarios as $reg)
                          <option  value="{{ $reg->id }}">{{ $reg->name }}</option>
                        @endforeach
                      </select>
                      <small class="form-control-feedback"> Empleados De La Actual Tienda. </small>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Cajas:</label>
                    <div class="col-md-9">
                      <select class="form-control custom-select" id="cajas">

                      </select>
                      <small class="form-control-feedback"> Cajas De La Actual Tienda. </small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-right">
                <button type="button" class="btn btn-success" id="asignar_caja">Asignar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


{{-- AQUI INICIA LA PARTE DE CREAR UNA CAJA--}}
  <div class="row">
    <div class="col-lg-12">
      <div class="card ">
        <div class="card-header bg-info">
          <h4 class="m-b-0 text-white">CREAR UNA NUEVA CAJA</h4>
        </div>
        <div class="card-body">
          <form action="#" class="form-horizontal">
            <div class="form-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Saldo Inicial:</label>
                    <div class="col-md-9">
                      <input type="text" id="saldo" class="form-control" placeholder="Saldo $"  >
                      <small class="form-control-feedback"> Saldo Con El Que Inicia La Tienda. </small>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Estado De La Caja:</label>
                    <div class="col-md-9">
                      <select class="form-control custom-select" id="estado" >
                        <option value="" selected>Selecciona Una Opción</option>
                        <option value="0">Activa</option>
                        <option value="1">Inactiva</option>
                      </select>
                      <small class="form-control-feedback"> Estado En El Que Inicia La Tienda. </small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Hora Apertura:</label>
                    <div class="col-md-9">
                      <input type="time" id="hora_inicial" class="form-control" >
                      <small class="form-control-feedback"> Hora De Apertura De La Tienda. </small> 
                    </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="control-label text-right col-md-3">Hora Cierre:</label>
                      <div class="col-md-9">
                        <input type="time" id="hora_final" class="form-control" >
                        <small class="form-control-feedback"> Hora De Cierre De La Tienda. </small> </div>
                      </div>
                    </div>
                  </div>
                  <div class="text-right">
                    <button type="button" class="btn btn-success" id="crear_caja">Crear</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

{{-- ACTIVAR O DESACTIVAR UNA CAJA --}}
<div class="row">
  <div class="col-lg-12">
    <div class="card ">
      <div class="card-header bg-info">
        <h4 class="m-b-0 text-white">ACTIVAR Y DESACTIVAR CAJAS</h4>
      </div>
      <div class="card-body">
        <form action="#" class="form-horizontal">
          <div class="form-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Tiendas:</label>
                  <div class="col-md-9">
                    <select  class="form-control custom-select" id="tienda_activar">
                      <option value="" selected>Selecciona Una Opción</option>
                      @foreach ( $tiendas as $reg)
                        <option  value="{{ $reg->id }}">{{ $reg->slug }}</option>
                      @endforeach
                    </select>
                    
                  </div>

                  <label class="control-label text-right col-md-3">Cajas:</label>
                  <div class="col-md-9">
                    <select  class="form-control custom-select" id="caja_activar">

                    </select>
                    
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Estado:</label>
                    <div class="col-md-9">
                        <select class="form-control custom-select" id="estado_activar" >
                            <option value="" selected>Selecciona Una Opción</option>
                            <option value="0">Activa</option>
                            <option value="1">Inactiva</option>
                        </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-right">
                <button type="button" class="btn btn-success" id="activar_desactivar">Aceptar</button>
              </div>
             </div>
            </form>
          </div>
        </div>
      </div>
    </div>

{{-- AQUI INICIA LA PARTE DE QUITAR UNA CAJA A UN EMPLEADO --}}
<div class="row">
        <div class="col-lg-12">
          <div class="card ">
            <div class="card-header bg-info">
              <h4 class="m-b-0 text-white">QUITAR CAJA A UN EMPLEADO</h4>
            </div>
            <div class="card-body">
              <form action="#" class="form-horizontal">
                <div class="form-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="control-label text-right col-md-3">Empleados:</label>
                        <div class="col-md-9">
                          <select  class="form-control custom-select" id="usuariocaja">
                            <option value="0" selected>Selecciona Una Opción</option>
                            @foreach ( $consultausuarios as $reg)
                              <option  value="{{ $reg->id }}">{{ $reg->name }}</option>
                            @endforeach
                          </select>
                          <small class="form-control-feedback"> Empleados De La Actual Tienda. </small>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6" id="input">

                     </div>
                    </div>
                    <div class="text-right">
                      <button type="button" class="btn btn-success" id="quitar">Quitar</button>
                    </div>
                   </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
    @endsection
