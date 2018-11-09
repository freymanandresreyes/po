@extends('layout')
@section('contenido')

<br>
<div id="appVue">
<div class="card">
    <div class="card-body">

        <div class="table-responsive m-t-40">
            <table id="myTable" class="table table-bordered table-striped">
                <thead>

                    <tr>
                        <th>Codigo</th>
                        <th>Cantidad</th>
                        <th>Envio</th>
                        <th>Recibe</th>
                        <th>FECHA DE ENVIO</th>
                        <th>FECHA DE RECIBIDO</th>
                        <th>ESTADO</th>
                        <th>OPCIONES</th>
                    </tr>

                </thead>
                <tbody >
                    @for ($i = 0 ; $i < count($consulta); $i++)
                        <tr>
                            <td>{{ $consulta[$i]->codigo }}</td>
                            <td>{{ $consulta[$i]->cantidad }}</td>
                            <td>{{ $consulta[$i]->tiendaremisionenvia['slug'] }}</td>
                            <td>{{ $consulta[$i]->tiendaremisionrecibe['slug'] }}</td>
                            <td>{{ $consulta[$i]->created_at }}</td>
                            <td>{{ $consulta[$i]->updated_at }}</td>
                            @if($consulta[$i]->estado == 1) <td><span class="label label-info">ACEPTADO</span></td> 
                            @else<td><span class="label label-danger">SIN ACEPTAR</span></td>
                            @endif
                            <td class="text-center">
                               <button data-toggle="modal" data-target="#print_traslado" title="Visualizar traslado" type="button" v-on:click="buscaTraslado('{{ $consulta[$i]->id }}')" class="btn btn-default"><i class="fa fa-eye"></i></button> 
                            </td> 
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="print_traslado" tabindex="-1" role="dialog" aria-labelledby="print_apartado_label" style="    top: inherit;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="modal-body">
            <div class="card card-body">
                <div id="printableArea">
            <div class="text-center">
                <p>{{ $tienda->nombre_tienda }}</p> 
                  <p>{{ $tienda->encargado }}</p>
                   <p>{{ $tienda->nit_tienda }}</p>
                    <p>{{ $tienda->direccion_tienda }}</p>
                     <p>{{ $tienda->ciudad }}</p>
            </div>
             <div class="info_cliente" v-if="!(traslado == '')">
                <p>FACTURA DE TRASLADO</p>
                      <p id="datos_cliente" class="text-muted m-l-5">
                        <p>FECHA: @{{ traslado.created_at }}</p>  
                      </p>
                       <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive" style="clear: both;">
                                <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="text-center">Prod</th>
                                        <th class="text-center">Codigo</th>
                                        <th class="text-center">Cant</th>
                                        <th class="text-center">Tienda envia</th>
                                        <th class="text-center">Tienda recibe</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>@{{ traslado.remision_producto.titulo }}</td>
                                    <td>@{{ traslado.codigo }}</td>
                                    <td>@{{ traslado.cantidad }}</td>
                                    <td>@{{ traslado.tiendaremisionenvia.nombre_tienda }}</td>
                                    <td>@{{ traslado.tiendaremisionrecibe.nombre_tienda }}</td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                             <div class="col-md-12">
                               
                                    <div class="clearfix">
                                    </div>
                                     <hr> 
                                     <div class="footer_factura text-center col-md-12 ">
                                        <br> 
                                        <p>AUTORIZACION NUMERICA DE FACTURACION</p>
                                         <p>18762008098819</p>
                                          <p>2018-05-05</p>
                                           <p>DEL S2 1 AL S2 3750</p>
                                            <p>Gracias por su compra</p>
                                             <p>sis-post www.bless.com</p>
                                         </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                      <div class="modal-footer">
                        <button type="button" v-on:click="print" class="btn btn-default">Imprimir</button>
                         <button type="button" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
                     </div>
              
             </div>
    </div>
  </div>
</div>
</div>
</div>
<div class="modal-body estilo_ocultar text-center facturaVue" id="printApartado" style="width: auto; border: 0; margin: 0 5%;padding: 0;float: none !important;">

    <div class="row">
        <div class="col-md-12">
            <div class="img_factura">
                <br>
                <img src="{{ asset($tienda->logo)  }}" alt="">
            </div>
            <br>
            <br>
            <div class="contenedor_factura" id="areaImprimir">
                <div id="fact_recuperada_imprimir" class="nueva_factura" v-if="!(traslado == '')"><!-- ============================================================== -->

<div class="info_tienda">
 <p>{{ $tienda->nombre_tienda }}</p> 
  <p>{{ $tienda->encargado }}</p>
   <p>{{ $tienda->nit_tienda }}</p>
    <p>{{ $tienda->direccion_tienda }}</p>
     <p>{{ $tienda->ciudad }}</p>
    <p class="text-muted m-l-5" id="datos_cliente">
    </p>
<br>
</div>
<div class="info_cliente">
   <p>FACTURA DE TRASLADO</p>
<p id="datos_cliente" class="text-muted m-l-5">
 <p>FECHA: @{{ traslado.created_at }}</p>                         
</p>
</div>         
<div class="row">
<div class="col-md-12">
<div class="table-responsive" style="clear: both;">
    <table class="table ">
        <thead>
            <tr>
                <th class="text-center">Prod</th>
                <th class="text-center">Codigo</th>
                <th class="text-center">Cant</th>
                <th class="text-center">Tienda envia</th>
                <th class="text-center">Tienda recibe</th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <td>@{{ traslado.remision_producto.titulo }}</td>
            <td>@{{ traslado.codigo }}</td>
            <td>@{{ traslado.cantidad }}</td>
            <td>@{{ traslado.tiendaremisionenvia.nombre_tienda }}</td>
            <td>@{{ traslado.tiendaremisionrecibe.nombre_tienda }}</td>
        </tr>
        </tbody>
    </table>
</div>
<div class="col-md-12">


    <div class="clearfix"></div>
    <hr>
    <div class="footer_factura text-center col-md-12 ">
        <br>
        <p>AUTORIZACION NUMERICA DE FACTURACION</p>
        <p>18762008098819</p>
        <p>2018-05-05</p>
        <p>DEL S2 1 AL S2 3750</p>
        <p>Gracias por su compra</p>
        <p>sis-post www.bless.com</p>
    </div>

</div>

</div>
</div>


<!-- ============================================================== -->
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
</div>
<style>
    td{
        word-break: break-all;
    }
</style>
@endsection