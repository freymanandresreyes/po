<div class="info_tienda" >
      
    <h4>{{ $tienda->nombre_tienda }}</h4>
    <h4>{{ $tienda->encargado }}</h4>
    <h4>{{ $tienda->nit_tienda }}</h4>
    <h4>{{ $tienda->direccion_tienda }}</h4>
    <h4>{{ $tienda->ciudad }}</h4>
    <p class="text-muted m-l-5" id="datos_cliente">  </p>

</div>

<div class="info_cliente" >
    <h4>INGRESO DE CAJA MENOR</h4>
    <h4>{{ $id_consecutivo->tag }} {{ $id_consecutivo->consecutivo }}</h4>
    <h4>{{ $id_entrada->updated_at}}</h4>
       
     <h4>CLIENTE: {{ $id_entrada->entrega}}</h4>
     <h4>NIT: {{ $id_entrada->cedula_entrega }}</h4>
     <p class="text-muted m-l-5" id="datos_cliente">  </p>
    
 </div>  

 <div class="row">
    <div class="col-md-12">
        <div class="table-responsive" style="clear: both;">
            <table class="table ">
                <thead>
                    <tr>
                        <th class="text-center">Motivo</th>
                        <th class="text-right">Valor</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                          <td class="text-center">{{ $id_entrada->motivo}}</td>
                          <td class="text-center">{{ $id_entrada->entrada}}</td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
