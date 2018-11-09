@extends('layout') 
@section('contenido')

<br>
<div id="appVue">
<div class="card">
 <div class="card-header bg-info">
      <h4 class="m-b-0 text-white">INFORME INVENTARIO POR TIENDA</h4>
    </div>
    <div class="card-body">
     <form method="GET" action="{{ route('informe_inventario') }}">
    <div class="row">
    <div class="col-md-6">
      <div class="form-group row">
        <label class="control-label col-md-3">SELECCIONE UNA ZONA:</label>
        <div class="col-md-9">
          <select class="form-control" id="zonas" name="zonas" v-on:change="buscaTiendas">
            <option disabled="" value="" selected="">Seleccione una opcion</option>
              @foreach($zonas as $zona)
               <option value="{{ $zona->id }}" @if($request->zonas == $zona->id) selected="" @endif>{{ $zona->nombre }}</option>
              @endforeach
          </select>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group row">
        <label class="control-label col-md-3">SELECCIONE UNA TIENDA:</label>
        <div class="col-md-9">
          <select class="form-control" id="tienda" name="tienda">
               <option v-for="tienda in tiendasZona" :value="tienda.id">@{{ tienda.slug }}</option>
          </select>
        </div>
      </div>
    </div>
  </div>
      <div class="text-right">
  <button type="submit" class="btn btn-success">Generar informe</button>
</div>
</form>
    @if(isset($tienda))
    <h3>Informe de inventario de la tienda: <b>{{ $tienda->slug }}</b></h3>
    @endif
        <div class="table-responsive m-t-40">
            <table id="myTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>CODIGO</th>
                        <th>U_COMPRA</th>
                        <th>U_INVENTARIO</th>
                        <th>U_VENDIDAS</th>
                        <th>U_RECIBIDAS</th>
                        <th>U_ENVIADAS</th>
                        <th>RESUL_PRODUCTOS</th>
                        <th>UC</th>
                        <th>UR</th>
                        <th>UF</th>
                        <th>UE</th>
                        <th>RE_FINAL_INVENTARIO</th>
                    </tr>
                </thead>
                <tbody id="id_facturas">
                    @if(!empty($data))
                    @foreach($data as $d)
                   <tr>
                       <td>{{ $d->CODIGO }}</td>
                       <td>{{ $d->U_COMPRA }}</td>
                       <td>{{ $d->U_INVENTARIO }}</td>
                       <td>{{ $d->U_VENDIDAS }}</td>
                       <td>{{ $d->U_RECIBIDAS }}</td>
                       <td>{{ $d->U_ENVIADAS }}</td>
                       <td>{{ $d->RESUL_PRODUCTOS }}</td>
                       <td>{{ $d->UC }}</td>
                       <td>{{ $d->UR }}</td>
                       <td>{{ $d->UF }}</td>
                       <td>{{ $d->UE }}</td>
                       <td>{{ $d->RE_FINAL_INVENTARIO}}</td>
                   </tr>
                   @endforeach
                   @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection

<script>
    // alert('hola');
                $('#myTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
                });
</script>

 