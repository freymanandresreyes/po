@extends('layout') 
@section('contenido') 
<br>
<div class="row">
  <div class="col-lg-12">
    <div class="card ">
      <div class="card-header bg-info">
        <h4 class="m-b-0 text-white">Elije un rango de fechas</h4>
      </div>
      <div class="card-body">
        
          <div class="form-body">
            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Inicio:</label>
                  <div class="col-md-9">
                    <input type="date" class="form-control custom-select" id="fecha1_prueba">

                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Fin:</label>
                  <div class="col-md-9">
                    <input type="date" class="form-control custom-select" id="fecha2_prueba">
                  </div>
                </div>
              </div>
            </div>
            <div class="text-right">
               
                <button type="button" class="btn btn-success" id="prueba">Generar</button>
             
            </div>
          </div>
      

          
        <div id="aca">
            
            </div>

      </div>
    </div>
  </div>
</div>
@endsection

