@extends('layout') 
@section('contenido')
<div >




  <div class="row">
      <div class="col-lg-12">
          <div class="card">
              <div class="card-body">
                  <h4 class="card-title">INFORME DEVOLUCIONES</h4>
                  <h6 class="card-subtitle">Informe don elkin.</h6>                 
                  <div class="table-responsive m-t-40">



<div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Zonas:</label>
                  <div class="col-md-9">
                    <select type="date" class="form-control custom-select" id="informe_zona">
                      <option selected disabled value="">Elija una zona.</option>
                      @foreach ($zonas as $reg)
                        <option value="{{ $reg->id }}">{{ $reg->nombre }}</option>                          
                      @endforeach
                    </select>

                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Tienda:</label>
                  <div class="col-md-9">
                    <select type="" class="form-control custom-select" id="informe_tienda_select" disabled>
                      <option value="">Elija una tienda</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>



  <div class="row">

                <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Inicio:</label>
                  <div class="col-md-9">
                    <input type="date" class="form-control custom-select" id="fecha1">

                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Fin:</label>
                  <div class="col-md-9">
                    <input type="date" class="form-control custom-select" id="fecha2">
                  </div>
                </div>
                <br>
                  <br>
                  <div class="text-right">
  <button id="generar_informe_elkin_devoluciones" class="btn btn-success">GENERAR INFORME</button>
</div>
            </div>





              </div>
              <div id="informe_tabla_elkin_devoluciones">
                      
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection

 