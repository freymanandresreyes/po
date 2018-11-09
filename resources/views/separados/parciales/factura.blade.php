<!-- ============================================================== -->
<div class="info_tienda">


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
<div class="info_cliente">
    <P>FACTURA DE VENTA</P>
    <P class="text-uppercase">Nº {{ $nuevo_consecutivo->tag.'-'.$nuevo_consecutivo->consecutivo}} FECHA: {{ $nuevo_consecutivo->created_at }}</P>

    <P>CLIENTE: {{ $info_cliente->nombres." ".$info_cliente->apellidos }}</P>
    <P>NIT: {{ $info_cliente->documento }}</P>
    <P>TELEF: {{ $info_cliente->telefono}}</P>
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
                    @for ($i = 0 ; $i
                    < count($data); $i++) <tr>
                        <td class="text-center">{{ $data[$i][2] }}</td>
                        <td class="text-center">{{ $data[$i][0] }}</td>
                        <td class="text-center">{{ $data[$i][5] }}</td>
                        <td class="text-center">{{ $data[$i][4] }}</td>
                        <td class="text-center">{{ $data[$i][5] }}</td>
                        </tr>
                        @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- ============================================================== -->