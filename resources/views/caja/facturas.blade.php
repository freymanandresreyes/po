@extends('layout') 
@section('contenido')
<div class="card">
    <div class="card-body">

        <div class="table-responsive m-t-40">
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
                    < count($consulta); $i++) <tr>
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
    </div>
</div>
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