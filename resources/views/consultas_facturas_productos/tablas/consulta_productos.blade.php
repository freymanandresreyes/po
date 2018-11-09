
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive m-t-40">
                        <table id="example23" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    
                                    <th>Titulo</th>
                                    <th>Codigo</th>
                                    <th>Talla</th>
                                    <th>Cant/Ingreso</th>
                                    <th>Cant/Bodega</th>
                                    <th>Cant/Vendidas</th>
                                    <th>Aplica Oferta</th>
                                    <th>Desc/Oferta</th>
                                    <th>Inicio/Oferta</th>
                                    <th>Fin/Oferta</th>
                                    <th>Fecha/Ingreso</th>
                                    <th>Categoria</th>
                                    <th>Subcategoria</th>
                                    <th>Tienda</th>
                                    <th>Zona</th>
                                    <th>Cant/Enviada/traslado</th>
                                    <th>Cant/Recibida/traslado</th>
                                </tr>
                            </thead>
                            <tbody>
                            @for ($i = 0 ; $i < count($consulta); $i++)
                                <tr>
                                    <td>{{ $consulta[$i]->titulo }}</td>
                                    <td>{{ $consulta[$i]->codigo }}</td>
                                    <td>{{ $consulta[$i]->talla }}</td>
                                    <td>{{ $consulta[$i]->cantidad_ingreso }}</td>
                                    <td>{{ $consulta[$i]->cantidad_bodega }}</td>
                                    <td>{{ $consulta[$i]->cantidad_vendidas }}</td>
                                    <td>{{ $consulta[$i]->aplica_oferta }}</td>
                                    <td>{{ $consulta[$i]->descuento_oferta }}</td>
                                    <td>{{ $consulta[$i]->inicio_oferta }}</td>
                                    <td>{{ $consulta[$i]->fin_oferta }}</td>
                                    <td>{{ $consulta[$i]->fecha_ingreso }}</td>
                                    <td>{{ $consulta[$i]->categoria }}</td>
                                    <td>{{ $consulta[$i]->subcategoria }}</td>
                                    <td>{{ $consulta[$i]->nombre_tienda }}</td>
                                    <td>{{ $consulta[$i]->zona_tienda }}</td>
                                    <td>{{ $consulta[$i]->cantidad_enviada_traslado }}</td>
                                    <td>{{ $consulta[$i]->cantidad_recibida_traslado }}</td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
   
