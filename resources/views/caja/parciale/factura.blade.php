<!-- ============================================================== -->
<div class="info_tienda" >
   
      
            <p>{{ $encabezado->nombre_tienda }}</p>
            <p>{{ $encabezado->encargado }}</p>
            <p>{{ $encabezado->nit_tienda }}</p>
            <p>{{ $encabezado->direccion_tienda }}</p>
            <p>{{ $encabezado->ciudad }}</p>
            <p class="text-muted m-l-5" id="datos_cliente">
            </p>
       
    
</div>
<br>
<br>
<div class="info_cliente" >
   <P>FACTURA DE VENTA</P>
   <P class="text-uppercase">Nº {{ $num_facturta }} FECHA: {{ $fecha_factura }}</P>
      
    <P>CLIENTE: {{ $cliente->nombres." ".$cliente->apellidos }}</P>
    <P>NIT: {{ $cliente->documento }}</P>
    <P>TELEF: {{ $cliente->telefono}}</P>
    <P>PUNTOS FACTURA: {{ $consulta_puntos_f[0]->puntos_f }}</P>
    <P>TOTAL PUNTOS: {{ $cliente->puntos }}</P>
    <P>VENTA: {{ $tipo_factura }} </P>
    <P>T/PAGO: {{ $tipo_pago }}</P>
    <P>VENDED: {{ $datos_asesor->nombres }}</P>
    <P>CAJERO: {{ Auth::user()->name }}</P>
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
    </div>
</div>
<!-- ============================================================== -->
