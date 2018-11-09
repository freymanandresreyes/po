<div class="card">
        <div class="card-body">
            <div class="table-responsive m-t-40">
                <table id="tabla_masiva" class="table table-bordered table-striped">
<thead>
 <tr>
  @for ($i = 0 ; $i < count($consulta_columnas); $i++)
   <th>{{ $consulta_columnas[$i] }}</th>
  @endfor
 </tr>
</thead>
       
<tbody>
  @foreach ($consulta as $reg)
   <tr>
    <td>{{ $reg->id }}</td>
    <td>{{ $reg->tiendaProductos->slug }}</td>
    <td>{{ $reg->categoriaProductos->categoria }}</td>
    <td>{{ $reg->subcategoriaProductos->nombre_categoria }}</td>
    <td>{{ $reg->ruta }}</td>
    <td>{{ $reg->titulo }}</td>
    <td>{{ $reg->codigo }}</td>
    <td>{{ $reg->descripcion }}</td>
    <td>{{ " $ ".$reg->precio }}</td>
    <td>{{ $reg->cantidad_ingreso }}</td>
    <td>{{ $reg->cantidad }}</td>
    <td>{{ $reg->cantidad_ventas }}</td>
    <td>{{ $reg->oferta }}</td>
    <td>{{ $reg->descuentoOferta }}</td>
    <td>{{ $reg->inicioOferta }}</td>
    <td>{{ $reg->finOferta }}</td>
    <td>{{ $reg->created_at }}</td>
    <td>{{ $reg->updated_at }}</td>
    <td>{{ " $ ".$reg->Precio_mayorista }}</td>
    <td>{{ $reg->precio_costo }}</td>
    <td>{{ $reg->id_configuraciones }}</td>    
    <td>{{ $reg->aplicar_iva }}</td>
   </tr>
  @endforeach
</tbody>
</table>
</div>
</div>
</div>