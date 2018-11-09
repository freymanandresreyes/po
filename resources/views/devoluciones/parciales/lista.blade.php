@foreach ($consulta as $reg)
<tr>
    <td>{{ $reg->created_at->format('d-m-Y')}}</td>
    <td>{{ $reg->titulo }}</td>
    <td class="codigo">{{ $reg->codigo }}</td>
    <td>{{ $reg->precio_oferta }}</td>
    <td>{{ $reg->cantidad }}</td>
    <td>
     
        <button type="button" class="btn btn-success boton-devoluciones">seleccionar</button>
     
    </td>
</tr>
@endforeach