@extends('layout') 
@section('contenido')
<div class="card">
     <div class="card-header bg-info">
      <h4 class="m-b-0 text-white">VISUALIZAR FACTURAS</h4>
    </div>
    <div class="card-body">
        <p>* Ingresa desde y hasta que fecha quieres ver las facturas.</p>
     <form method="GET" action="{{ route('ver_facturas') }}">
    <div class="row">
    <div class="col-md-6">
      <div class="form-group row">
        <label class="control-label col-md-3">DESDE:</label>
        <div class="col-md-9">
            <input type="date" name="desde" class="form-control custom-select" id="desde" required="">
        </div>
      </div>
    </div>
      <div class="col-md-6">
      <div class="form-group row">
        <label class="control-label col-md-3">HASTA:</label>
        <div class="col-md-9">
            <input type="date" name="hasta" class="form-control custom-select" id="hasta" required="">
        </div>
      </div>
    </div>
  </div>
      <div class="text-right">
  <button type="submit" class="btn btn-success">GENERAR FACTURAS</button>
</div>
</form>
<hr>
@if(!empty($consulta))
        <div class="table-responsive">
            <table id="myTable" class="table table-bordered table-striped">
                <thead>

                    <tr>
                        <th>Número Factura</th>
                        <th>Nombre Cliente</th>
                        <th>Cedula Cliente</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Total</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody id="id_facturas">
                    @for ($i = 0 ; $i
                    < count($consulta); $i++) 
                        <tr>
                            <td>{{ $consulta[$i]->Numero_Factura }}</td>
                            <td>{{ $consulta[$i]->Nombre_Cliente }}</td>
                            <td>{{ $consulta[$i]->Cedula_Cliente }}</td>
                            <td>{{ $consulta[$i]->Fecha }}</td>
                            <td>{{ $consulta[$i]->hora }}</td>
                            <td>{{ $consulta[$i]->total }}</td>
                            <td>
                                <button type="button" class="btn btn-secondary verFactura" name="{{ $consulta[$i]->Numero_Factura }}">
                                    <i class="fa fa-eye"></i>
                                </button> 
                                @role('admin_tiendas') 
                                @if($consulta[$i]->estado == 0)
                                <button class="btn btn-danger anular" name="{{ $consulta[$i]->Numero_Factura  }}">Anular</button> 
                                @else
                                <button class="btn btn-default" disabled>Anular</button> 
                                @endif 
                                @endrole
                            </td>
                        </tr>
                        @endfor

                </tbody>
            </table>
        </div>
@endif
    </div>
</div>
@if(!empty($consulta))
<!-- MODAL FACTURA -->
<div id="modal_factura" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content" id="factura_compra">


            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-body printableArea">

                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">

                                    </div>

                                </div>
                                <div id="nueva_factura" class="nueva_factura">

                                </div>

                                <div class="modal-footer">
                                    <button id="print-factura-recuperado" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Imprimir</span> </button>
                                    <button type="button" class="btn btn-danger waves-effect waves-light" id="cerrar_factura">Cerrar</button>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>


            </div>


        </div>
    </div>
</div>
<!-- /.modal -->
@endif
@endsection
 
@section('factura')
<!-- MODAL FACTURA -->


<!-- MODAL FACTURA -->
<div class="modal-body factura_venta estilo_ocultar">

    <div class="row">
        <div class="col-md-12">
            <div class="img_factura">
                <img src="{{ $info_tienda->logo }}" alt="">
            </div>
            <br>
            <br>
            <div class="contenedor_factura" id="areaImprimir">


                <div id="fact_recuperada_imprimir" class="nueva_factura">

                </div>

                <div class="">




                    <div class="clearfix"></div>

                    <div class="modal-footer">
                        <button class="btn btn-default btn-outline ocultar-print" type="button" id="imprimir_factura"> <span><i class="fa fa-print"></i> Imprimir</span> </button>
                        <button type="button" class="btn btn-danger waves-effect waves-light ocultar-print" id="cerrar_factura_recuperados">Cerrar</button>
                    </div>
                </div>


            </div>
        </div>
    </div>


</div>




<!-- /.modal -->
<!-- /.modal -->
@endsection