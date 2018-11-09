

            <div class="card">
                <div class="card-body">

                    <div class="table-responsive m-t-40">
                        <table id="example23" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Num/Fac</th>
                                    <th>Titulo</th>
                                    <th>Codigo</th>
                                    <th>Talla</th>
                                    <th>Prec/Oferta</th>
                                    <th>Descuento</th>
                                    <th>Cant/Productos</th>
                                    <th>Pago/Efectivo</th>
                                    <th>Pago/Tarjeta</th>
                                    <th>Total/Facturas</th>
                                    <th>Asesor</th>
                                    <th>Precio/Costo</th>
                                    <th>Categoria</th>
                                    <th>Subcategoria</th>
                                    <th>Fech/Factura</th>
                                    <th>Tienda</th>
                                    <th>Zona</th>
                                    <th>Vendedor</th>
                                    <th>Cliente</th>
                                    <th>Tel/Cliente</th>
                                    <th>Fech/Nacimiento/Cliente</th>
                                    <th>Correo/Cliente</th>

                                </tr>
                            </thead>
                            <tbody>
                            @for ($i = 0 ; $i < count($consulta); $i++)
                                <tr>
                                    <td>{{ $consulta[$i]->numero_factura }}</td>
                                    <td>{{ $consulta[$i]->titulo_factura }}</td>
                                    <td>{{ $consulta[$i]->codigo_producto }}</td>
                                    <td>{{ $consulta[$i]->talla }}</td>
                                    <td>{{ $consulta[$i]->precio_oferta }}</td>
                                    <td>{{ $consulta[$i]->descuento }}</td>
                                    <td>{{ $consulta[$i]->cantidad_productos }}</td>
                                    <td>{{ $consulta[$i]->pago_efectivo }}</td>
                                    <td>{{ $consulta[$i]->pago_tarjeta }}</td>
                                    <td>{{ $consulta[$i]->total_facturas }}</td>
                                    <td>{{ $consulta[$i]->nombre_asesor }}</td>
                                    <td>{{ $consulta[$i]->precio_costo }}</td>
                                    <td>{{ $consulta[$i]->nombre_categoria }}</td>
                                    <td>{{ $consulta[$i]->nombre_subcategoria }}</td>
                                    <td>{{ $consulta[$i]->fecha_factura }}</td>
                                    <td>{{ $consulta[$i]->nombre_tienda }}</td>
                                    <td>{{ $consulta[$i]->zona_tienda }}</td>
                                    <td>{{ $consulta[$i]->nombre_vendedor }}</td>
                                    <td>{{ $consulta[$i]->nombre_cliente }}</td>
                                    <td>{{ $consulta[$i]->telefono_cliente }}</td>
                                    <td>{{ $consulta[$i]->fecha_nacimiento_cliente }}</td>
                                    <td>{{ $consulta[$i]->correo_cliente }}</td>

                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- ***************** fin tabla *************** --}} 
        </div>
    </div>
