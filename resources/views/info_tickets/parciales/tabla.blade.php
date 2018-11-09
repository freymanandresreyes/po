<table id="example26" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Cantidad productos</th>
            <th>cantidad facturas</th>
            <th>Promedio ticket</th>
            <th>Promedio factura</th>
            <th>total ventas</th>

        </tr>
    </thead>
    <tfoot>
        <tr>
            
            <th>TOTAL:</th>
            <th>-</th>
            <th>-</th>
            <th>-</th>
            <th>-</th>
            <th>-</th>
        </tr>
    </tfoot>
    <tbody>
        @for ($i = 0; $i < count($objeto_final) ; $i++)
        <tr>
            <td>{{ $objeto_final[$i][0] }}</td>
            <td>{{ $objeto_final[$i][1] }}</td>
            <td>{{ $objeto_final[$i][2] }}</td>
            <td>{{ number_format($objeto_final[$i][3])}}</td>
            <td>{{ number_format($objeto_final[$i][4],2)}}</td>
            <td>{{ number_format($objeto_final[$i][5])}}</td>    
        </tr>
        @endfor

    </tbody>

</table>