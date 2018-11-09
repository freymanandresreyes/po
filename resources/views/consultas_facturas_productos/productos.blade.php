@extends('layout') 
@section('contenido') 
<br>
<div class="row">
  <div class="col-lg-12">
    <div class="card ">
      <div class="card-header bg-info">
        <h4 class="m-b-0 text-white">CONSULTA PRODUCTOS</h4>
      </div>
      <div class="card-body">
        
          <div class="form-body">
            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Tiendas:</label>
                  <div class="col-md-9">
                    <select type="date" class="form-control custom-select" id="tienda">
                      <option value="">Elija una tienda.</option>
                      @foreach ($tiendas as $reg)
                        <option value="{{ $reg->id }}">{{ $reg->slug }}</option>                       
                      @endforeach
                    </select>

                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                 
                  <div class="col-md-9">
                    <button type="button" class="btn btn-success" id="buscar_informe_productos">Generar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
      

        <div id="tabla_productos_informe">
            
        </div>

      </div>
    </div>
  </div>
</div>
@endsection