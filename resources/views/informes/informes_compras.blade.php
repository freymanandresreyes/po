@extends('layout') 
@section('contenido') {{-- AQUI INICI LA PARTE DE ASIGNAR UNA CAJA A UN EMPLEADO --}}


<br>

<div class="row">
    <div class="col-lg-12">
        <div class="card ">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">INFORMES DE COMPRAS</h4>
            </div>
            <div class="card-body">
                <form action="#" class="form-horizontal">
                    <div class="form-body">

                        {{-- SIGUIENTE ROW --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Fecha De Inicio:</label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control custom-select" id="fecha1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Fecha De Fin:</label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control custom-select" id="fecha2">
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- FIN DEL ROW --}}
                        <div class="text-right">
                            <button type="button" class="btn btn-success" id="buscar_informe_compras">generar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div id="tabla_facturas_compras">

</div>

@endsection


@section('factura')
<div class="row">
        <div id="modal_factura_compra" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog-carta" > 
                <div class="modal-content modal-sinborde">
                    <div class="modal-body" id="factura_compra">
                        <div id="datos_factura">

                        </div>
                        
                    <div class="text-right">
                        <button class="btn btn-danger ocultar-print" id="cerrar_factura" > Cerrar</button>
                        <button class="btn btn-default btn-outline ocultar-print" id="imprimir_factura_compra"> <span><i class="fa fa-print"></i> Print</span> </button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection