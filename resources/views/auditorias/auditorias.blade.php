@extends('layout')
@section('contenido')


{{-- AQUI INICI LA PARTE DE EDITAR EL IVA DE UNA TIENDA --}}
<br>
  <div class="row">
    <div class="col-lg-12">
      <div class="card ">
        <div class="card-header bg-info">
          <h4 class="m-b-0 text-white">BUSCAR FACTURAS</h4>
        </div>
        <div class="card-body">
          <div  class="form-horizontal">
            <div class="form-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Codigo:</label>
                    <div class="col-md-9">
                      <input type="text" id="codigo"  class="form-control" >
                      <small class="form-control-feedback"> Codigo del Producto. </small>
                    </div>
                  </div>
                </div>
                
              </div>
              <div class="text-right">
                <button type="button" id="buscar_facturas_auditorias" class="btn btn-success" >Buscar</button>
              </div>
            </div>
          </div>
          <div id="tabla_auditoria">
          </div>
        </div>
      </div>
    </div>
  </div>

  @endsection