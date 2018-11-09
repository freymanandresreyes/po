@extends('layout')
@section('contenido')

<br>

<div class="card">
    <div class="card-body">

        <div class="table-responsive m-t-40">
            <table id="myTable" class="table table-bordered table-striped">
                <thead>

                    <tr>
                        <th>NUMERO FACTURA</th>
                        <th>CODIGO PRODUCTO</th>
                        <th>CANTIDAD</th>
                        <th>V/COMPRA</th>
                        <th>P.V.UNIDAD</th>
                        <th>P.V.MAYOR</th>
                        <th>OPCIONES</th>
                    </tr>

                </thead>
                <tbody id="recepcion_compras">
                    @for ($i = 0 ; $i < count($consulta); $i++)
                        <tr>
                            <td>{{ $consulta[$i]->numero_factura }}</td>
                            <td>{{ $consulta[$i]->codigo_producto }}</td>
                            <td>{{ $consulta[$i]->cantidad }}</td>
                            <td>{{ number_format($consulta[$i]->costo_und) }}</td>
                            <td>{{ number_format($consulta[$i]->precio_detal) }}</td>
                            <td>{{ number_format($consulta[$i]->precio_mayor) }}</td>
                            <td><button class="btn btn-sm btn-icon btn-success btn-outline recepcion_compras" name="{{ $consulta[$i]->id }}">Aceptar</button></td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>



<div class="row menu_ocultar">
        <!-- sample modal content -->
        <div id="aceptarcompra" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                  <h3>PRECIOS DE VENTA</h3>
              </div>
              <div class="modal-body">
  
                    <form>
                        <div class="form-group"  style="display:none" >
                            <label for="recipient-name" class="control-label">PRECIO DE VENTA AL MAYORISTA:</label>
                            <input type="text" class="form-control" id="id">
                        </div>
                        <div class="form-group" >
                            <label for="recipient-name" class="control-label">PRECIO DE VENTA AL PUBLICO:</label>
                            <input type="text" class="form-control" id="pvp">
                        </div>
                        <div class="form-group" >
                            <label for="recipient-name" class="control-label">PRECIO DE VENTA AL MAYORISTA:</label>
                            <input type="text" class="form-control" id="pvm">
                        </div>
                    </form>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="cerrarcompra">Cerrar</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="guardarponderado">Guardar</button>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>


@endsection
