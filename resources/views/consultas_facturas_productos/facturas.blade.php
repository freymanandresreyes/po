@extends('layout') 
@section('contenido') 
<br>
<div class="row">
  <div class="col-lg-12">
    <div class="card ">
      <div class="card-header bg-info">
        <h4 class="m-b-0 text-white">CONSULTA FACTURAS</h4>
      </div>
      <div class="card-body">
        
          <div class="form-body">
            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Inicio:</label>
                  <div class="col-md-9">
                    <input type="date" class="form-control custom-select" id="fecha_inicio">

                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Fin:</label>
                  <div class="col-md-9">
                    <input type="date" class="form-control custom-select" id="fecha_fin">
                  </div>
                </div>
              </div>
            </div>
            <div class="text-right">
               
                <button type="button" class="btn btn-success" id="buscar_informe_facturas">Generar</button>
             
            </div>
          </div>
      

        <div id="tabla_facturas_informe">
            
        </div>

      </div>
    </div>
  </div>
</div>
@endsection

