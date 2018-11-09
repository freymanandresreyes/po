<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Facturas De Compras</h4>
                <h6 class="card-subtitle">Facturas Generadas En Las Fechas Indicadas</h6>
                <div class="table-responsive m-t-40">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Numero De Fctura</th>
                                <th>Proveedor</th>
                                <th>Nit</th>
                                <th>Fecha</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                        @for ($i = 0; $i< count($objeto_final) ; $i++) 
                            <tr>
                                <td>{{ $objeto_final[$i][0] }}</td>
                                <td>{{ $objeto_final[$i][1] }}</td>
                                <td>{{ $objeto_final[$i][2] }}</td>
                                <td>{{ $objeto_final[$i][3] }}</td>
                                <td><input type="button"  value="Ver" class="btn btn-sm btn-icon btn-success btn-outline" id="{{ $objeto_final[$i][0] }}"></td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>