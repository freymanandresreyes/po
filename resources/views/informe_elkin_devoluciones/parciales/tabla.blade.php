



<table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                          <thead>
                              <tr>
                                  <th>Codigo</th>
                                  <th>Bodega</th>
                                  <th>Cantidad</th>
                                  <th>Valor Unitario</th>
                                  <th>Lote</th>
                                  <th>Centro De Costo</th>
                                </tr>
                          </thead>
                          <tbody>
                          @php
    $i = 0;
@endphp
@foreach($consulta as $reg)
    <tr>
        <td>{{ $reg->codigo }}</td>
        <td>{{ $reg->bodega }}</td>
        <td>1</td>
        <td>{{ $reg->total }}</td>
        <td>00</td>
        <td>00</td>
    </tr>
@php
  $i++;
@endphp
@endforeach
                          </tbody>
                      </table>