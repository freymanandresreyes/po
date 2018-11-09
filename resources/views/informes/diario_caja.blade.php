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
          <div class="form-body">
            @role('administrativo')
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Zonas:</label>
                  <div class="col-md-9">
                    <select type="date" class="form-control custom-select" id="informe_zona">
                      <option value="">Elija una zona.</option>
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
            @endrole
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
                @if (Shinobi::isRole('administrativo'))
                    <button type="button" class="btn btn-default" id="imprimir_informe_diario_zonas">
                    <i class="fa fa-print"></i> Imprimir</button>
                    <button type="button" class="btn btn-success" id="buscar_informe_diario_zonas">Generar</button>
                @else
                <button type="button" class="btn btn-default" id="imprimir_informe_diario">
                  <i class="fa fa-print"></i> Imprimir</button>
                <button type="button" class="btn btn-success" id="buscar_informe_diario">Generar</button>
                @endif
   
             
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


{{-- AQUI INICI LA PARTE DE ASIGNAR UNA CAJA A UN EMPLEADO --}}
<br>
<div id="informe_general_diario">

</div>
@endsection

@section('factura')
<div class="estilo_ocultar" id="vista_info_diario"></div>
@endsection