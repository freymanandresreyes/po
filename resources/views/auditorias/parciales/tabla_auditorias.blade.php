



<table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                          <thead>
                              <tr>
                                  <th># FACTURA</th>
                                  <th>CODIGO</th>
                                  <th>CANTIDAD</th>
                                  <th>TOTAL</th>
                                  <th>TIENDA</th>
                                  <th>FECHA</th>
                                </tr>
                          </thead>
                          <tbody>
                          @php
    $i = 0;
@endphp
@foreach($consulta as $reg)
    <tr>
        <td>{{ $reg->factura }}</td>
        <td>{{ $reg->codigo }}</td>
        <td>{{ $reg->cantidad }}</td>
        <td>{{ Round($reg->total) }}</td>
        <td>{{ $reg->tienda }}</td>
        <td>{{ $reg->fecha }}</td>
    </tr>
@php
  $i++;
@endphp
@endforeach
                          </tbody>
                      </table>