<table id="myTable" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Encargado</th>
      <th>Nit</th>
      <th>Slug</th>
      <th>Dirección</th>
      <th>Ciudad</th>
      <th></th>
    </tr>
  </thead>
  <tbody id="editar_tienda" >
    @foreach($consulta as $reg)
      <tr class="dato">
        <td>{{$reg->nombre_tienda}}</td>
        <td>{{$reg->encargado}}</td>
        <td>{{$reg->nit_tienda}}</td>
        <td>{{$reg->slug}}</td>
        <td>{{$reg->direccion_tienda}}</td>
        <td>{{$reg->ciudad}}</td>
        <td><a class="ti-pencil" value="{{$reg->id}}" href=""></a></td>
      </tr>
    @endforeach
  </tbody>
</table>
