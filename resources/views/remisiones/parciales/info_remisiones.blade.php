<div class="col-md-12">
        <div class="pull-left">
            <address>
                <h3> &nbsp;<b class="text-danger">{{ $consulta[0]->tiendaremisionenvia['nombre_tienda'] }}</b></h3>
                <p>  {{ $consulta[0]->tiendaremisionenvia['encargado'] }}</p>
                <p class="text-muted m-l-5">NIT {{ $consulta[0]->tiendaremisionenvia['nit_tienda'] }},
                <br/> {{ $consulta[0]->tiendaremisionenvia['direccion_tienda'] }},
                <br/></p>
                {{-- <br/> NIT - {{ $consulta[0]->tiendascompras['nit_tienda'] }}  
                <br/> DIRECCION - {{ $consulta[0]->tiendascompras['direccion_tienda'] }}
                <br/> TELEFONO - {{ $consulta[0]->tiendascompras['telefono'] }}</p> --}}
            </address>
        </div>
        <div class="pull-right text-right">
            <address>
                <h3>CONSECUTIVO INTERNO No,</h3>
                <h4 class="font-bold">{{ $consulta[0]['consecutivo'] }},</h4>
                <br/> 
                <p class="m-t-30"><b>FECHA:</b> <i class="fa fa-calendar"></i> {{ $consulta[0]['created_at'] }}</p>
                {{-- <p><b>FECHA VENCIMIENTO :</b> <i class="fa fa-calendar"></i> {{ $consulta[0]['fecha_vencimiento'] }}</p>
                <p><b>FORMA DE PAGO : </b>{{ $forma_pago }}</p> --}}
            </address>
        </div>
    </div>
    <div class="col-md-12">
        <div class="table-responsive m-t-40" style="clear: both;">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="display: none">id</th>
                        <th class="text-center">CODIGO</th>
                        <th class="text-center">TITULO</th>
                        <th class="text-center">DESCRIPCIÓN</th>
                        <th class="text-center">CANT</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($consulta as $value)
                    <tr>
                        <td style="display: none"> {{ $value->id }}</td>
                        <td class="text-center"> {{ $value->remisionProducto->codigo }}</td>
                        <td class="text-center"> {{ $value->remisionProducto->titulo }}</td>
                        <td class="text-center"> {{ $value->remisionProducto->descripcion }}</td>
                        <td class="text-center"> {{ $value->cantidad }}</td>
                        
                        
                    </tr>
                        
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-12">
        <div class="pull-right m-t-30 text-right">
            <h4>CANTIDAD DE PRODUCTOS: {{ $cantidad }}</p>
            {{-- <p>SUBTOTAL: ${{ $subtotal }}</p>
            <p>IVA ({{ $consulta_factura[0]['iva'] }}%) : ${{ $subiva }} </p>
            <hr>
            <h3><b>TOTAL :</b> ${{ $total }}</h3> --}}
        </div>
        <div class="clearfix"></div>
    </div>