@extends('layout') 
@section('contenido')
<!-- Row -->
<!-- ***** estructura input crear producto **** -->
<br> {{-- AQUI INICIA LA PARTE DE COMPRAS--}}
<div class="row">
  <div class="col-lg-12">
    <div class="card ">
      <div class="card-header bg-info">
        <h4 class="m-b-0 text-white">COMPRAS</h4>
      </div>
      <div class="card-body">
        <form action="#" class="form-horizontal">
          <div class="form-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Acción:</label>
                  <div class="col-md-9">
                    <select type="text" class="form-control" id="acction_compras">
                                <option value="1">COMPRAS</option>
                                <option value="2">TRASLADOS</option>
                              </select>
                  </div>
                </div>
              </div>
              <!--fin de tienda -->
              <div class="col-md-6" id="compras_uno" style="display:none">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Bodega:</label>
                  <div class="col-md-9">
                    <input type="text" id="bodega" disabled name="{{ (Auth::user()->userTienda->id)}}" class="form-control" value="{{ (Auth::user()->userTienda->slug)}}">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Zonas:</label>
                  <div class="col-md-9">
                    <select type="text" class="form-control" id="tienda_zona_crear">
                            <option value="">Seleccione una zona</option>
                            @foreach ($zonas as $reg )
                                <option value="{{ $reg->id }}">{{ $reg->nombre }}</option>
                            @endforeach
                          </select>

                  </div>
                </div>
              </div>
              <!--fin de tienda -->
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Tiendas:</label>
                  <div class="col-md-9">
                    <select type="text" class="form-control" id="tienda_c_p">
                            <option value="">Seleccione una tienda</option>
                            </select>

                  </div>
                </div>
              </div>
            </div>
            {{-- PRIMER ROW --}} {{-- FIN PRIMER ROW --}} {{-- PRIMER ROW --}}
            <div class="row" >
              <div class="col-md-6" style="display: block" id="compras_dos">
                <div class="form-group  row">
                  <label class="control-label text-right col-md-3">Proveedores:</label>
                  <div class="col-md-9">
                    <div class="input-group mb-3">
                      <select class="form-control custom-select" id="proveedor">
                                  <option value="" selected>Selecciona Una Opción</option>
                                @foreach ( $proveedores as $reg )
                                  <option value="{{ $reg->id }}" >{{ $reg->nombre }}</option>    
                                @endforeach
                                </select>
                      <div class="input-group-append">
                        <button class="btn btn-outline-primary" id="agregar_proveedor" type="button" data-toggle="tooltip" data-placement="left"
                          title="" data-original-title="Agregar un proveedor"><i class="fa fa-plus"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6" style="display: block" id="compras_tres">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Numero De Factura:</label>
                  <div class="col-md-9">
                    <input type="text" id="numero_factura" class="form-control">

                  </div>
                </div>
              </div>


            </div>

            <div class="row">

              <div class="col-md-6" style="display: block" id="compras_cuatro">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Forma De Pago:</label>
                  <div class="col-md-9">
                    <select class="form-control custom-select" id="forma_pago">
                              <option value="0" selected>Selecciona Una Opción</option>
                              <option value="1">Credito</option>
                              <option value="2">Contado</option>    
                            </select>
                    <small class="form-control-feedback">Forma De Pago De La Factura. </small> </div>
                </div>
              </div>
              <div class="col-md-6" style="display: block" id="compras_cinco">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Fecha:</label>
                  <div class="col-md-9">
                    <input type="date" id="fecha" class="form-control">
                    <small class="form-control-feedback">Fecha De Compra. </small>
                  </div>
                </div>
              </div>
            </div>
            {{-- FIN PRIMER ROW --}} {{-- SIGUIENTE ROW --}} {{-- FIN DEL ROW --}} {{-- SIGUIENTE ROW --}} {{-- FIN DEL ROW --}} {{--
            SIGUIENTE ROW --}} {{-- FIN DEL ROW --}} {{-- SIGUIENTE ROW --}}
            <div class="row">

              <div class="col-md-6" style="display: block" id="compras_seis">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Fecha De Vencimiento:</label>
                  <div class="col-md-9">
                    <input type="date" id="fecha_vencimiento" class="form-control">
                    <small class="form-control-feedback">Fecha De Vencimiento De La Factura.</small> </div>
                </div>
              </div>

            </div>
            {{-- FIN DEL ROW --}} {{-- SIGUIENTE ROW --}}

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Codigo:</label>
                  <div class="col-md-9">
                    <input type="text" id="codigo" class="form-control">

                  </div>
                </div>
                <input type="hidden" id="id_producto" name="" class="form-control">
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Titulo:</label>
                  <div class="col-md-9">
                    <input type="text" id="titulo" class="form-control" disabled>

                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Categoria:</label>
                  <div class="col-md-9">
                    <input type="text" id="categoria" class="form-control" disabled>
                    <small class="form-control-feedback">Categoria Del Producto. </small>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Subcategoria:</label>
                  <div class="col-md-9">
                    <input type="text" id="subcategoria" class="form-control" disabled>
                    <small class="form-control-feedback">Subcategoria Del Producto. </small>
                  </div>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Descripcion:</label>
                  <div class="col-md-9">
                    <input type="text" id="descripcion" class="form-control" disabled>
                    <small class="form-control-feedback">Descripcion del producto. </small>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Cantidad:</label>
                  <div class="col-md-9">
                    <input type="text" id="cantidad" class="form-control" disabled>
                    <small class="form-control-feedback">Cantidad De Productos. </small>
                  </div>
                </div>
              </div>

            </div>
            <div class="row">

              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Costo Unitario:</label>
                  <div class="col-md-9">
                    <input type="text" id="costo_unitario" class="form-control" disabled onkeyup="puntitos(this,this.value.charAt(this.value.length-1))">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Iva:</label>
                  <div class="col-md-9">
                    <select class="form-control custom-select" id="iva" disabled>
                                <option value="@if($consulta_iva!="[]"){{ $consulta_iva[0]->iva}}@endif">Grabado</option>
                                <option value="0">Excluido</option>    
                              </select> {{-- <input type="text" id="iva" class="form-control" value="@if($consulta_iva!="
                      [] "){{ $consulta_iva[0]->iva}}%" name="{{ $consulta_iva[0]->iva }}@endif" disabled>
                    <small class="form-control-feedback">Iva De La Tienda. </small> --}}
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Clasificación:</label>
                  <div class="col-md-9">
                    <select type="text" class="form-control" id="Clasificacion" disabled>
                            <option value="">Clasificación...</option>
                            @foreach ($clasificaciones as $reg )
                                <option value="{{ $reg->id }}">{{ $reg->nombre }}</option>
                            @endforeach
                          </select>

                  </div>
                </div>
              </div>
              <!--fin de tienda -->
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Aplicar IVA:</label>
                  <div class="col-md-9">
                    <select type="text" class="form-control" id="aplicar_iva" disabled>
                      <option value="">Seleccione...</option>
                      @foreach ($siyno as $reg)
                      <option value="{{ $reg->id }}">{{ $reg->nombre }}</option>
                      @endforeach
                    </select>

                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Valor Unidad:</label>
                  <div class="col-md-9">
                    <input type="text" id="p_detal" class="form-control" disabled >
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Valor Mayor:</label>
                  <div class="col-md-9">
                    <input type="text" id="p_mayor" class="form-control" disabled >
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">P/V detal:</label>
                  <div class="col-md-9">
                    <input type="text" id="calculo_detal" class="form-control" disabled  value="" onkeyup="puntitos(this,this.value.charAt(this.value.length-1))">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">P/V Mayor:</label>
                  <div class="col-md-9">
                    <input type="text" id="calculo_mayor" class="form-control" disabled  value="" onkeyup="puntitos(this,this.value.charAt(this.value.length-1))">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Aplicar descuento:</label>
                  <div class="col-md-9">
                    <select type="text" class="form-control" id="aplicar_oferta" disabled>
                      <option value="">Seleccione...</option>
                      @foreach ($siyno as $reg)
                      <option value="{{ $reg->id }}">{{ $reg->nombre }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <!--fin de tienda -->
              <div class="col-md-6" >
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">% Descuento:</label>
                  <div class="col-md-9">
                    <input type="text" id="porsentaje_oferta"  name="" class="form-control" value="0" disabled>
                  </div>
                </div>
              </div>
            </div>
            
            {{-- FIN DEL ROW --}}
            <div class="text-right">
              <button type="button" class="btn btn-success" id="agregar_compra">
                <i class="fa fa-plus"></i>
                Agregar</button>
              <button type="button" class="btn btn-warning" id="producto_compras">
                <i class="fa fa-archive"></i>
                Nuevo producto</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Contact Emplyee list</h4>
        <h6 class="card-subtitle"></h6>
        <div class="table-responsive">
          <table id="demo-foo-addrow" class="table m-t-30 table-hover contact-list" data-page-size="10">
            <thead id="encabezado_compras">
              <tr>
                <th>Referencia</th>
                <th style="display: none">id producto</th>
                <th>Nombre</th>
                <th>P/compra</th>
                <th>Cantidad</th>
                <th>P/detal</th>
                <th>P/mayor</th>
                <th>Desc</th>
                <th>% Desc</th>
                <th>Clasificación</th>
                <th>Aplicar IVA</th>
                <th>Acción</th>
              </tr>
            </thead>

            <tfoot>
              <tr>

                <td colspan="7">
                  <div class="text-right">
                    <ul class="pagination"> </ul>
                  </div>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="text-right">
          <button type="button" class="btn btn-success" id="crear_compra">
                <i class="fa fa-save"></i>
                Guardar
              </button>
        </div>
      </div>
    </div>
    <!-- Column -->
  </div>
</div>
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->

{{-- -------------------------------------------------------------------------//////////////////////////////////////////-----------------------------------------------------------
{{-- -------------------------------------------------------------------------//////////////////////////////////////////-----------------------------------------------------------
{{-- -------------------------------------------------------------------------//////////////////////////////////////////-----------------------------------------------------------
{{-- -------------------------------------------------------------------------//////////////////////////////////////////-----------------------------------------------------------
--}}

<!--  modal subcategorias -->
<div id="modal_crear_proveedor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
  style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Crear Proveedor</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group" id="">
            <label for="recipient-name" class="control-label">Proveedor:</label>
            <input type="text" class="form-control" id="nombre">
          </div>
          <div class="form-group" id="">
            <label for="recipient-name" class="control-label">Nit:</label>
            <input type="text" class="form-control" id="nit">
          </div>
          <div class="form-group" id="">
            <label for="recipient-name" class="control-label">Dirección:</label>
            <input type="text" class="form-control" id="direccion">
          </div>
          <div class="form-group" id="">
            <label for="recipient-name" class="control-label">Telefono:</label>
            <input type="text" class="form-control" id="telefono">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="cerrar_crear_proveedor">Cerrar</button>
        <button type="button" class="btn btn-success waves-effect waves-light" id="guardar_crear_proveedor">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- fin modal subcategorias -->

<!--  modal productos -->
<div id="modal_crear_producto_compras" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
  style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Crear Producto</h4>
      </div>
      <div class="modal-body">
        <form>


          <!--fin de tienda -->

          <div class="form-group">
            <label class="control-label">codigo:</label> {!! Form::text('codigo', null, ['class'=>'form-control', 'id'=>'codigo_modal',"placeholder"=>"Codigo
            del producto"]) !!}

          </div>


          <!--fin row-->
          <!--inicio del row-->

          <!--categoria-->

          <div class="form-group">
            <label class="control-label">Categoria:</label>
            <div class="col-md-12">
              <div class="input-group mb-3">
                <select name="id_categoria" id="categoria_modal" class="form-control">
                        <option value="">Seleccione una categoria</option>
                      </select>

                <div class="input-group-append">
                  <button class="btn btn-outline-primary" id="agregar_categoria_compras" type="button" data-toggle="tooltip" data-placement="left"
                    title="" data-original-title="Agregar una categoria"><i class="fa fa-plus"></i></button>
                </div>
              </div>
            </div>
          </div>

          <!--fin categoria-->

          <!--subcategoria-->

          <div class="form-group">
            <label class="control-label">Subcategoria:</label>
            <div class="col-md-12">
              <div class="input-group mb-3">
                <select name="" id="subcategoria_modal" class="form-control">
                      <option value="">Seleccione una subcategoria.</option>
                    </select>
                <div class="input-group-append">
                  <button class="btn btn-outline-primary" id="agregar-subcategoria" type="button" data-toggle="tooltip" data-placement="left"
                    title="" data-original-title="Agregar una subcategoria"><i class="fa fa-plus"></i></button>
                </div>
              </div>
            </div>
          </div>


          <!--fin subcategoria-->
          <!--/span-->
          <div class="form-group">
            <label class="control-label">Titulo:</label> {!! Form::text('titulo', null, ['class'=>'form-control','disabled',
            'id'=>'titulo_modal',"placeholder"=>"Titulo del producto"]) !!}
          </div>
          <!--/span-->
          <div class="form-group">
            <label class="control-label">Descripcion:</label> {!! Form::text('descripcion', null, ['class'=>'form-control','disabled',
            'id'=>'descripcion_modal',"placeholder"=>"Descripción del producto"]) !!}
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="cerrar_modal_producto">Cerrar</button>
        <button type="button" class="btn btn-success waves-effect waves-light" id="guardar_modal_producto">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- fin modal productos -->




{{-- //********************* --}}
<!--  modal categorias -->
<div id="modal-categoria" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
  style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Crear categoria</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group" id="error-categoria">
            <label for="recipient-name" class="control-label">Categoria:</label>
            <input type="text" class="form-control" id="categoria_modal_crear">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="cerrar-categoria">Cerrar</button>
        <button type="button" class="btn btn-success waves-effect waves-light" id="guardar_categoria_compras">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- fin modal categorias -->

<!--  modal subcategorias -->
<div id="modal-subcategoria" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
  style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Crear subcategoria</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group" id="error-subcategoria">
            <label for="recipient-name" class="control-label">Subcategoria:</label>
            <input type="text" class="form-control" id="subcategoria_modal_crear">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="cerrar-subcategoria">Cerrar</button>
        <button type="button" class="btn btn-success waves-effect waves-light" id="guardar_subcategoria_compras">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- fin modal subcategorias -->
@endsection