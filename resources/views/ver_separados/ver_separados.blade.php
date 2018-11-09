@extends('layout') 
@section('contenido')
<!-- ***** estructura input crear producto **** -->
<br>
<div id="appVue">
<div class="row">
    <div class="col-lg-12">
        <div class="card ">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">Apartados</h4>
            </div>
           
            <div class="card">
                <div class="card-body">
                     
                    <div class="table-responsive m-t-40">
                        <table id="example23" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#/Apartado</th>
                                    <th>Nomb/Cliente</th>
                                    <th>CC/Cliente</th>
                                    <th>Codigo</th>
                                    <th>Titulo</th>
                                    <th>Prec/Productos</th>
                                    <th>Total/Abono</th>
                                    <th>Fec/Venci</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($consulta as $reg)
                                <tr>
                                    <td>{{ $reg->consecutivo }}</td>
                                    <td>{{ $reg->clienteseparados->nombres }}</td>
                                    <td>{{ $reg->clienteseparados->documento }}</td>
                                    <td>{{ $reg->codigoproducto->codigo }}</td>
                                    <td>{{ $reg->codigoproducto->titulo }}</td>
                                    <td>{{ Round($reg->precio_producto) }}</td>
                                    <td>{{ Round($reg->pago_efectivo) }}</td>
                                    <td>{{ $reg->fecha_vencimiento }}</td>
                                    <td>
                                        @if($reg->estado==0)
                                        <span class="label label-success">Sin Retirar</span>
                                        @else
                                        <span class="label label-danger">Retirado</span>
                                        @endif
                                    </td>   
                                    <td class="text-center">
                                       <button data-toggle="modal" data-target="#print_apartado" title="Visualizar apartado" type="button" v-on:click="buscaApartado('{{ $reg->consecutivo }}')" class="btn btn-default"><i class="fa fa-eye"></i></button> 
                                    </td>             
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>
              <div class="modal fade" id="print_apartado" tabindex="-1" role="dialog" aria-labelledby="print_apartado_label">
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
                             <div class="info_cliente" v-if="apartados.length > 0">
                                <p>FACTURA DE APARTADO</p>
                                 <p class="text-uppercase">Nº @{{ apartados[0].consecutivo }}</p>
                                  <p>FECHA: @{{ apartados[0].created_at }}</p>
                                  <p>CLIENTE: @{{ apartados[0].clienteseparados.nombres }}  @{{ apartados[0].clienteseparados.apellidos }}</p>
                                   <p>NIT: @{{ apartados[0].clienteseparados.documento }}</p>
                                   <p>TELEF: @{{ apartados[0].clienteseparados.telefono }}</p>
                                      <p id="datos_cliente" class="text-muted m-l-5">
                                          
                                      </p>
                                       <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive" style="clear: both;">
                                                <table class="table ">
                                                    <thead>
                                                <tr>
                                                <th class="text-center">Prod</th>
                                                 <th class="text-right">Cod</th>
                                                  <th class="text-right">Val</th>
                                                   <th class="text-right">Cant</th>
                                                    <th class="text-right">Total</th>
                                                </tr>
                                            </thead>
                                             <tbody>
                                                <tr v-for="apartado in apartados">
                                                    <td class="text-center">@{{ apartado.codigoproducto.titulo }}</td>
                                                     <td class="text-center">@{{ apartado.codigoproducto.codigo }}</td>
                                                      <td class="text-center">@{{ new Intl.NumberFormat().format(Math.round(apartado.codigoproducto.precio) + ((Math.round(apartado.codigoproducto.precio) * 0.19))) }}</td>
                                                       <td class="text-center">1</td>
                                                        <td class="text-center">@{{ new Intl.NumberFormat().format(Math.round(apartado.codigoproducto.precio) + ((Math.round(apartado.codigoproducto.precio) * 0.19))) }}</td>
                                                    </tr>
                                                </tbody>
                                                </table>
                                            </div>
                                             <div class="col-md-12">
                                                <div class="pull-right m-t-30 text-right modal-valore">
                                                    <p>SUB - TOTALt: $ 
                                                    <span id="subtotal1">@{{ new Intl.NumberFormat().format(subTotal) }}</span></p>
                                                     <p>IVA (19%) : $ @{{ new Intl.NumberFormat().format(ivaTotal) }} </p>
                                                      <hr>
                                                       <h3><b>Total :</b> $<span id="precioTotal1" class="precio-total">@{{ new Intl.NumberFormat().format(precioTotal) }}</span></h3>
                                                   </div>
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
                <div id="fact_recuperada_imprimir" class="nueva_factura" v-if="apartados.length > 0"><!-- ============================================================== -->

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
<p>FACTURA DE APARTADO</p>
 <p class="text-uppercase">Nº @{{ apartados[0].consecutivo }}</p>
<p>FECHA: @{{ apartados[0].created_at }}</p>
<p>CLIENTE: @{{ apartados[0].clienteseparados.nombres }}  @{{ apartados[0].clienteseparados.apellidos }}</p>
<p>NIT: @{{ apartados[0].clienteseparados.documento }}</p>
<p>TELEF: @{{ apartados[0].clienteseparados.telefono }}</p>
<p class="text-muted m-l-5" id="datos_cliente">
</p>


</div>         
<div class="row">
<div class="col-md-12">
<div class="table-responsive" style="clear: both;">
    <table class="table ">
        <thead>
            <tr>
                <th class="text-center">Prod</th>
                <th class="text-right">Cod</th>
                <th class="text-right">Val</th>
                <th class="text-right">Cant</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
       <tr v-for="apartado in apartados">
        <td class="text-center">@{{ apartado.codigoproducto.titulo }}</td>
         <td class="text-center">@{{ apartado.codigoproducto.codigo }}</td>
          <td class="text-center">@{{ new Intl.NumberFormat().format(Math.round(apartado.codigoproducto.precio) + ((Math.round(apartado.codigoproducto.precio) * 0.19))) }}</td>
           <td class="text-center">1</td>
            <td class="text-center">@{{ new Intl.NumberFormat().format(Math.round(apartado.codigoproducto.precio) + ((Math.round(apartado.codigoproducto.precio) * 0.19))) }}</td>
        </tr>
                </tbody>
    </table>
</div>
<div class="col-md-12">

<div class="pull-right m-t-30 text-right modal-valore">
    <p>SUB - TOTALt: $ 
    <span id="subtotal1">@{{ new Intl.NumberFormat().format(subTotal) }}</span></p>
     <p>IVA (19%) : $ @{{ new Intl.NumberFormat().format(ivaTotal) }} </p>
      <hr>
       <h3><b>Total :</b> $<span id="precioTotal1" class="precio-total">@{{ new Intl.NumberFormat().format(precioTotal) }}</span></h3>
   </div>
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