@foreach($consulta as $reg)
  <tr>
    <td>{{$reg->nombre_tienda}}</td>
    <td>{{$reg->encargado}}</td>
    <td>{{$reg->nit_tienda}}</td>
    <td>{{$reg->direccion_tienda}}</td>
    <td>{{$reg->ciudad}}</td>
    <td><a class="ti-pencil" value="{{$reg->id}}" href=""></a></td>
  </tr>
@endforeach
