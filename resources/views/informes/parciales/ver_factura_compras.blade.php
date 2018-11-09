<div class="col-md-12">
    <div class="pull-left">
        <address>
            <h3> &nbsp;<b class="text-danger">{{ $consulta_factura[0]->proveedorescompras['nombre'] }}</b></h3>
            <p class="text-muted m-l-5">NIT {{ $consulta_factura[0]->proveedorescompras['nit'] }},
            <br/> {{ $consulta_factura[0]->proveedorescompras['direccion'] }},
            <br/></p>
            <p> SEÑOR(ES) - {{ $consulta_factura[0]->tiendascompras['encargado'] }}
            <br/> NIT - {{ $consulta_factura[0]->tiendascompras['nit_tienda'] }}  
            <br/> DIRECCION - {{ $consulta_factura[0]->tiendascompras['direccion_tienda'] }}
            <br/> TELEFONO - {{ $consulta_factura[0]->tiendascompras['telefono'] }}</p>
        </address>
    </div>
    <div class="pull-right text-right">
        <address>
            <h3>FACTURA DE VENTA No,</h3>
            <h4 class="font-bold">{{ $consulta_factura[0]['numero_factura'] }},</h4>
            <br/> 
            <p class="m-t-30"><b>FECHA EMISION :</b> <i class="fa fa-calendar"></i> {{ $consulta_factura[0]['fecha'] }}</p>
            <p><b>FECHA VENCIMIENTO :</b> <i class="fa fa-calendar"></i> {{ $consulta_factura[0]['fecha_vencimiento'] }}</p>
            <p><b>FORMA DE PAGO : </b>{{ $forma_pago }}</p>
        </address>
    </div>
</div>
<div class="col-md-12">
    <div class="table-responsive m-t-40" style="clear: both;">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-center">CODIGO</th>
                    <th>DESCRIPCION</th>
                    <th class="text-right">CANT</th>
                    <th class="text-right">VR. UNIDAD</th>
                    <th class="text-right">VR. PARCIAL</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i
                < count($consulta_factura) ; $i++) <tr>
                    <td class="text-center"> {{ $consulta_factura[$i]['codigo_producto'] }}</td>
                    <td>{{ $consulta_factura[$i]->productoscompras['titulo'] }}</td>
                    <td class="text-right">{{ $consulta_factura[$i]['cantidad'] }}</td>
                    <td class="text-right">{{ $consulta_factura[$i]['costo_und'] }}</td>
                    <td class="text-right">{{ $consulta_factura[$i]['compra_total'] }}</td>
                    </tr>
                    @endfor
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-12">
    <div class="pull-right m-t-30 text-right">
        <p>CANTIDAD DE PRODUCTOS: {{ $totalcantidad }}</p>
        <p>SUBTOTAL: ${{ $subtotal }}</p>
        <p>IVA ({{ $consulta_factura[0]['iva'] }}%) : ${{ $subiva }} </p>
        <hr>
        <h3><b>TOTAL :</b> ${{ $total }}</h3>
    </div>
    <div class="clearfix"></div>
</div>