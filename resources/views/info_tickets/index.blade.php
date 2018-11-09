@extends('layout') 
@section('contenido') {{-- AQUI INICI LA PARTE DE ASIGNAR UNA CAJA A UN EMPLEADO --}}
<br>
<div class="row menu_ocultar">
    <div class="col-lg-12">
        <div class="card ">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">TICKETS</h4>
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
                            <button type="button" class="btn btn-success" id="ticket_buscar">Generar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<br>
<!-- column -->
<div class="col-lg-12" id="ocultar_ticket" style="display: none">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Reporte ticket promedio tienda</h4>
            <br>
            <div id="bar-chart-tienda" style="width:100%; height:400px;"></div>
            <br>
            <h4 class="card-title">Reporte ticket promedio empleados</h4>
            <br>
            <div id="bar-chart" style="width:100%; height:400px;"></div>
            <br>

            <div class="table-responsive m-t-40" id="tabla_resumen">
            </div>

        </div>
    </div>
</div>
<br>



@endsection