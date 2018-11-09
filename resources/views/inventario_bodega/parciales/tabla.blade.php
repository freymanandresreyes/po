<div class="card">
        <div class="card-body">
            <div class="table-responsive m-t-40">
                <table id="tabla_bodega_json" class="table table-bordered table-striped">
<thead>
 <tr>
   <th>ID</th>
   <th>CODIGO</th>
   <th>CANTIDAD</th>
   <th>FECHA</th>
 </tr>
</thead>
       
<tbody>
  @foreach ($consulta_tabla as $reg)
   <tr>
    <td>{{ $reg->id }}</td>
    <td>{{ $reg->codigo }}</td>
    <td>{{ $reg->cantidad }}</td>
    <td>{{ $reg->created_at }}</td>
   </tr>
  @endforeach
</tbody>
</table>
</div>
</div>
</div>