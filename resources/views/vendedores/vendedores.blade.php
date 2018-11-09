@extends('layout')
@section('contenido')

<br>
<div class="card">
    <div class="card-body">
        <div class="table-responsive m-t-40">
            <button class="btn btn-sm mdi mdi-account-plus btn-waves btn-outline" id="nuevo_vendedor">Nuevo Vendedor</button>
            <table id="myTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Tienda</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="vendedores_tabla">
                    @for ($i = 0 ; $i < count($consulta); $i++)
                        <tr>
                            <td>{{ $consulta[$i]->nombres }}</td>
                            <td>{{ $consulta[$i]->apellidos }}</td>
                            <td>{{ $consulta[$i]->tiendavendedor['slug'] }}</td>
                            <td><button class="btn btn-sm mdi mdi-border-color btn-success btn-outline editar_vendedor" name="{{ $consulta[$i]->id }}"></button></td>
                            @if($consulta[$i]->estado == 1) <td><button class="btn-sm mdi mdi-delete-forever btn-info btn-outline eliminar_vendedor" name="{{ $consulta[$i]->id }}"></button></td> 
                            @else<td><button class="btn-sm mdi mdi-delete-forever btn-danger btn-outline eliminar_vendedor" name="{{ $consulta[$i]->id }}"></button></td>
                            @endif
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>






<div class="row menu_ocultar">
        <!-- sample modal content -->
        <div id="vendedor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                  <h3>VENDEDOR</h3>
              </div>
              
              <div class="modal-body">
  
                    <form>
                            <input type="text" class="form-control" id="id">

                            <div class="form-group" >
                              <label for="recipient-name" class="control-label">Nombres:</label>
                              <input type="text" class="form-control" id="nombres_vendedor">
                            </div>

                            <div class="form-group" >
                             <label for="recipient-name" class="control-label">Apellidos:</label>
                             <input type="text" class="form-control" id="apellidos_vendedor">
                            </div>

                            <div class="form-group" >
                             <label for="recipient-name" class="control-label">Documento:</label>
                             <input type="text" class="form-control" id="documento_vendedor">
                            </div>

                            <div class="form-group">
                             <label for="recipient-name" class="control-label">Direccion:</label>
                             <input type="text" class="form-control" id="direccion_vendedor">
                            </div>

                            <div class="form-group" >
                             <label for="recipient-name" class="control-label">Telefono:</label>
                             <input type="text" class="form-control" id="telefono_vendedor">
                            </div>

                            <div class="form-group">
                             <label for="recipient-name" class="control-label">Fecha De Nacimiento:</label>
                             <input type="date" class="form-control" id="fecha_nacimiento_vendedor">
                            </div>

                            <div class="form-group" >
                             <label for="recipient-name" class="control-label">Correo:</label>
                             <input type="text" class="form-control" id="correo_vendedor">
                            </div>
                    </form>
                    <label for="recipient-name" class="control-label" >Tiendas:</label>
                      <select class="form-control custom-select" name="tienda_vendedor" id="tienda_vendedor">
                        <option value="" selected>Selecciona Una Opción</option>
                        @foreach ( $consulta_tiendas as $reg)
                            <option  value="{{ $reg->id }}">{{ $reg->slug }}</option>
                        @endforeach
                      </select>

                      <label for="recipient-name" class="control-label" id="label_ocultar">Estado:</label>
                      <select class="form-control custom-select" name="estado_vendedor" id="estado_vendedor">
                        <option value="" selected>Selecciona Una Opción</option>
                        <option value=1 >Activo</option>
                        <option value=2 >Inactivo</option>                        
                      </select>
  
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="cerrar_modal_vendedor">Cerrar</button>
                          <button type="button" class="btn btn-success waves-effect" data-dismiss="modal" id="guardar_vendedor">Guardar</button>
                          <button type="button" class="btn btn-success waves-effect" data-dismiss="modal" id="editar_vendedor">Actualizar</button>
                      </div>
  
              </div>
              </div>
            </div>
          </div>
        </div>
@endsection