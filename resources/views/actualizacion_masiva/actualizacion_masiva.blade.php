@extends('layout') 
@section('contenido') {{-- AQUI INICI LA PARTE DE ASIGNAR UNA CAJA A UN EMPLEADO --}}
<br>
<div class="row menu_ocultar">
  <div class="col-lg-12">
    <div class="card ">
      <div class="card-header bg-info">
        <h4 class="m-b-0 text-white">ACTUALIZACION MASIVA DE PRODUCTOS</h4>
      </div>
      <div class="card-body">
        <form action="#" class="form-horizontal">
          <div class="form-body">
            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Zonas:</label>
                  <div class="col-md-9">
                    <select type="date" class="form-control custom-select" id="zona_masiva">
                      <option value="">Elija una Zona.</option>
                      @foreach ($consulta_zona as $reg)
                        <option value="{{ $reg->id }}">{{ $reg->nombre }}</option>                          
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Tiendas:</label>
                  <div class="col-md-9">
                    <select type="date" disabled class="form-control custom-select" id="tienda_masiva">
                        <option value="">Elija una Tienda.</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            

            <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="control-label text-right col-md-3">Categorias:</label>
                        <div class="col-md-9">
                          <select type="date" disabled class="form-control custom-select" id="categoria_masiva">
                              <option value="">Elija una Categoria.</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="control-label text-right col-md-3">SubCategorias:</label>
                        <div class="col-md-9">
                          <select type="date" disabled class="form-control custom-select" id="subcategoria_masiva">
                                <option value="">Elija una SubCategoria.</option>
                            </select>
                        </div>
                      </div>
                    </div>
                  </div>


            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Columna:</label>
                  <div class="col-md-9">
                    <select type="date" disabled class="form-control custom-select" id="columna_masiva">
                        <option value="">Elija una Columna.</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Dato:</label>
                  <div class="col-md-9">
                    <input type="text" disabled class="form-control custom-select" id="dato_masiva">
                  </div>
                </div>
              </div>
            </div>
            <div class="text-right">
                <button type="button" class="btn btn-success" disabled id="actualizar_masiva">Actualizar</button>
            </div>
          </div>
        </form>
        <div id="tabla">
        </div>
      </div>
    </div>
  </div>
</div>
@endsection