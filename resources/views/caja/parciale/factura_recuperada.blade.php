<!-- ============================================================== -->

<div class="info_tienda" >
   
    <p>{{ $contenido[0]->tiendafactura['nombre_tienda'] }}</p>
    <p>{{ $contenido[0]->tiendafactura['encargado'] }}</p>
    <p>{{ $contenido[0]->tiendafactura['nit_tienda'] }}</p>
    <p>{{ $contenido[0]->tiendafactura['direccion_tienda'] }}</p>
    <p>{{ $contenido[0]->tiendafactura['ciudad'] }}</p>
    <p class="text-muted m-l-5" id="datos_cliente">
    </p>


</div>
<div class="info_cliente" >
<p>FACTURA DE VENTA</p>
<p class="text-uppercase">Nº {{ $num_facturta }} FECHA: {{ $fecha_factura }}</p>

<p>CLIENTE: {{ $contenido[0]->clientesfactura['nombres']." ". $contenido[0]->clientesfactura['apellidos'] }}</p>
<p>NIT: {{ $contenido[0]->clientesfactura['documento'] }}</p>
<p>TELEF: {{ $contenido[0]->clientesfactura['telefono']}}</p>
<p>VENDED: {{ $contenido[0]->vendedoresfactura['nombres'] }}</p>
<p>CAJERO: {{ $contenido[0]->userfactura['name'] }}</p>
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
            @foreach ($contenido as $reg)
              <tr>
                  <td class="text-center">{{ $reg->titulo }}</td>
                  <td class="text-center">{{ $reg->codigo }}</td>
                  <td class="text-center">{{ $reg->precio_oferta }}</td>
                  <td class="text-center">{{ $reg->cantidad }}</td>
                  <td class="text-center">{{ $reg->total }}</td
              </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="col-md-12">

    <div class="pull-right m-t-30 text-right modal-valore">
        <p>SUB - TOTALt: $ <span id="subtotal1">{{ number_format($subtotal) }}</span> </p>
        <p>IVA ({{ $contenido[0]['porsentaje_iva'] }}%) : $ {{ number_format($iva_venta) }} </p>
        <hr>
        <h3><b>Total :</b> $<span id="precioTotal1" class="precio-total">{{ number_format($total_venta) }}</span> </h3>
    </div>
    <div class="clearfix"></div>
    <hr>
    <div class="footer_factura text-center col-md-12 ">
        <br>
        <p>AUTORIZACION NUMERICA DE FACTURACION</p>
        <p>{{ $contenido[0]->tiendafactura['resolucion'] }}</p>
        <p>{{ $contenido[0]->tiendafactura['fecha_resolucion'] }}</p>
        <p>{{ $contenido[0]->tiendafactura['prefijo'] }}</p>
        <p>Gracias por su compra</p>
        <p>sis-post www.bless.com</p>
    </div>

</div>

</div>
</div>


<!-- ============================================================== -->
