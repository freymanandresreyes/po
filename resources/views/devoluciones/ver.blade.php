@extends('layout')
@section('contenido')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Data Export</h4>
        <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
        <div class="table-responsive m-t-40" >
            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Factura</th>
                        <th>Radicado</th>
                        <th>Producto</th>
                        <th>Referencia</th>
                        <th>Valor</th>
                        <th>Cantidad</th>
                        <th>nombre cliente</th>
                        <th>cedula cliente</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Descripcion</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
           
                <tbody id="tabla_devolucion">
                    @foreach ($consulta as $reg)
                        <tr>
                            <td>{{ $reg->factura }}</td>
                            <td>{{ $reg->radicado }}</td>
                            <td>{{ $reg->producto }}</td>
                            <td>{{ $reg->referencia }}</td>
                            <td>{{ $reg->valor }}</td>
                            <td>{{ $reg->cantidad }}</td>
                            <td>{{ $reg['clientesdevolucines']['nombres'] }}</td>
                            <td>{{ $reg['clientesdevolucines']['documento'] }}</td>
                            <td>{{ $reg->created_at }}</td>
                            <td>{{ $reg->descripcion_recibo }}</td>
                            <td>
                                @if($reg->estado == 0)
                                <div class="label label-table bg-dark">Recibido</div>
                                @elseif($reg->estado == 1)
                                <div class="label label-table label-danger">Rechazado</div>
                                @elseif($reg->estado == 2)
                                <div class="label label-table label-warning">Proceso</div>
                                @elseif($reg->estado == 3)
                                <div class="label label-table label-info">Cambio</div>
                                @elseif($reg->estado == 4)
                                <div class="label label-table label-success">Entregado</div>
                                @elseif($reg->estado == 5)
                                <div class="label label-table label-warning">Devoluci贸n</div>
                                @endif
                            </td>
                            <td>   
                                <button type="button" class="btn btn-success ver" name="{{ $reg->id }}"> <i class="fa fa-eye"></i> </button>  
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL DEVOLUCION -->
<div id="modal_devolucion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Devoluciones</h4>

                  </div>
                  <div class="modal-body">
                    <form>
                        <input type="hidden" id="id_modal">
                      <div class="form-group">
                        <label for="recipient-name" class="control-label">Producto:</label>
                        <input type="text" class="form-control" id="producto_modal">
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="control-label">Motivo devoluci贸n:</label>
                        <textarea type="text" class="form-control" id="motivo_modal"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="message-text" class="control-label">Estado:</label>
                        <select class="form-control" id="estado_modal">
                            <option value="volvo">Seleccione un estado.</option>
                            <option value="1">Rechazado</option>
                            <option value="2">Proceso</option>
                            <option value="3">Cambio</option>
                            <option value="5">Devoluci贸n</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="message-text" class="control-label">Respuesta:</label>
                        <textarea class="form-control" id="respuesta_modal"></textarea>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="cerrar_devolucion">Cerrar</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="actualizar_devolucion">Guardar</button>
                  </div>
                </div>
              </div>
</div>
<!-- /.modal -->
@endsection
