<thead>
        <tr>
            <th>Categoria</th>
            <th>Subcategoria</th>
            <th>Titulo</th>
            <th>codigo</th>
            <th>precio</th>
            <th>oferta</th>
        </tr>
</thead>
<tbody> 
    @foreach ($consulta as $reg)
        <tr>
            <td>{{ $reg->categoriaProductos->categoria }}</td>
            <td>{{ $reg->subcategoriaProductos->nombre_categoria }}</td>
            <td>{{ $reg->titulo }}</td>
            <td>{{ $reg->precio }}</td>
            <td>2011/04/25</td>
            <td><span class="badge badge-pill badge-info">{{ $reg->oferta }} %</span></td>
        </tr> 
    @endforeach                                
</tbody>