@extends('layout') 
@section('contenido') {{-- AQUI INICI LA PARTE DE ASIGNAR UNA CAJA A UN EMPLEADO --}}
<br>
<div class="row menu_ocultar">
  <div class="col-lg-12">
    <div class="card ">
      <div class="card-header bg-info">
        <h4 class="m-b-0 text-white">INFORMES DE VENTAS DIARIO</h4>
      </div>
      <div class="card-body">
        <form action="#" class="form-horizontal">
            <!-- .col-lg-12 -->
            {{-- <div class="col-md-12">
                <h4 class="card-title">Escoje un Rango "$"</h4>
                <div id="range_03"></div>
            </div> --}}
            <!-- /.col-lg-12 -->
          <div class="form-body">
            
            {{-- <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Tienda:</label>
                  <div class="col-md-9">
                    <select type="date" class="form-control custom-select" id="informe_zona">
                      <option value="">Elija una tienda.</option>
                      @foreach ($consulta_tiendas as $reg)
                        <option value="{{ $reg->id }}">{{ $reg->slug }}</option>                          
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div> --}}
            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Inicio:</label>
                  <div class="col-md-9">
                    <input type="date" class="form-control custom-select" id="fecha1_informeuno">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Fin:</label>
                  <div class="col-md-9">
                    <input type="date" class="form-control custom-select" id="fecha2_informeuno">
                  </div>
                </div>
              </div>
            </div>
            <div class="text-right">
                
                <button type="button" class="btn btn-default" id=""><i class="fa fa-print"></i> Imprimir</button>
                <button type="button" class="btn btn-success" id="generar_informe_mator_detal">Generar</button>
                
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection