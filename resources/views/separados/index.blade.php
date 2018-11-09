@extends('layout') 
@section('contenido')
<!-- Row -->
<!-- ***** estructura input crear producto **** -->
<br> {{-- AQUI INICIA LA PARTE DE COMPRAS--}}
<div class="row">
  <div class="col-lg-12">
    <div class="card ">
      <div class="card-header bg-info">
        <h4 class="m-b-0 text-white">APARTADOS</h4>
      </div>
      <div class="card-body">
        <form action="#" class="form-horizontal">
          <div class="form-body">

            <div class="row">
              <input type="hidden" id="iva_apartado" value="{{ $configuraciones[0]['iva'] }}">
              <input type="hidden" id="id_cliente" value="">
              <input type="hidden" id="precio_detal_apartado" value="">
              <input type="hidden" id="precio_mayorista_apartado" value="">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Documento:</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" placeholder="Número de documento" id="documento_cliente_apartado">
                    <small class="form-control-feedback"> Ingrese el número de documento del cliente. </small> </div>
                </div>
              </div>
              <!--/span-->
              <div class="col-md-6">
                <div class="form-group  row">
                  <label class="control-label text-right col-md-3">Nombre:</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control " placeholder="Nombre del cliente" disabled id="nombre_cliente">
                    <small class="form-control-feedback"> Nombre completo del cliente. </small> </div>
                </div>
              </div>
              <!--/span-->
            </div>

            {{-- FIN DEL ROW --}} {{-- SIGUIENTE ROW --}}

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Codigo:</label>
                  <div class="col-md-9">
                    <input type="text" id="codigo_apartado" class="form-control" disabled>
                    <input type="hidden" value="{{ Auth::user()->tienda }}" id="tienda_apartado">

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
                    <input type="text" id="cantidad" class="form-control" disabled value="">
                    <small class="form-control-feedback">Cantidad De Productos. </small>
                  </div>
                </div>
              </div>

            </div>
            <div class="row">

              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Valor:</label>
                  <div class="col-md-9">
                    <input type="text" id="valor_apartado" class="form-control" disabled onkeyup="puntitos(this,this.value.charAt(this.value.length-1))">
                  </div>
                </div>
              </div>

            </div>


            {{-- FIN DEL ROW --}}
            <div class="text-right">
              <button type="button" class="btn btn-success" id="agregar_apartado">
                <i class="fa fa-plus"></i>
                Agregar</button>

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
            <thead id="encabezado_separados">
              <tr>
                <th>Referencia</th>
                <th style="display: none">id producto</th>
                <th>Nombre</th>
                <th>Valor</th>
                <th>Cantidad</th>
                <th>P/total</th>
                <th style="display: none">precio_detal</th>
                <th style="display: none">precio_mayorista</th>
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
          <button type="button" class="btn btn-success" id="crear_apartado">
                
                Registar
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






{{-- //********************* --}}


<!-- Row -->

<div class="row">

  <!-- sample modal content -->
  <div id="modal_cliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Registro de clientes</h4>

        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="recipient-name" class="control-label">Documento:</label>
              <input type="text" class="form-control" id="documento">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="control-label">nombres:</label>
              <input type="text" class="form-control" id="nombres">
            </div>
            <div class="form-group">
              <label for="message-text" class="control-label">apellidos:</label>
              <input class="form-control" id="apellidos">
            </div>
            <div class="form-group">
              <label for="message-text" class="control-label">Fecha de nacimiento:</label>
              <input type="date" class="form-control" id="fecha-nacimiento">
            </div>
            <div class="form-group">
              <label for="message-text" class="control-label">direccion:</label>
              <input class="form-control" id="direccion">
            </div>
            <div class="form-group">
              <label for="message-text" class="control-label">telefono:</label>
              <input class="form-control" id="telefono">
            </div>
            <div class="form-group">
              <label for="message-text" class="control-label">correo:</label>
              <input type="mail" class="form-control" id="correo">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="cerrar_cliente">Cerrar</button>
          <button type="button" class="btn btn-danger waves-effect waves-light" id="guardar_cliente_c">Guardar cliente</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('factura')




<!--  modal productos -->
<div id="modal_crear_producto_compras" class="modal fade" style="display: none;" tabindex="-1" role="dialog" aria-labelledby="modal_crear_producto_compra" aria-hidden="true"> 
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Registro apartado</h4>
      </div>
      <div class="modal-body">
        <form>


          <!--fin de tienda -->

          <div class="form-group">
            <label class="control-label">Dias habiles:</label>
            <input type="text" class="form-control" id="apartado_dias" onkeyup="puntitos(this,this.value.charAt(this.value.length-1))">

          </div>

          <!--fin subcategoria-->
          <!--/span-->
          <div class="form-group">
            <label class="control-label">Total:</label>
            <input type="text" class="form-control" disabled id="total_apartado">
          </div>
          <div class="form-group">
            <label class="control-label">Tipo de pago:</label>
            <select name="id_categoria" id="apartado_tipo_pago" class="form-control">
                <option value="">Tipo de pago</option>
                <option value="1">Efectivo</option>
                <option value="2">Tarjeta</option>
                <option value="3">Mixto efectivo tarjeta</option>
                <option value="4">Mixto tarjeta tarjeta</option>
            </select>
          </div>
          <hr>
          <div class="form-group" id="apartado_tipo_tarjeta" style="display:none">
        
            <label class="control-label">Tipo de tarjeta 1:</label>
            <select name="id_categoria" id="id_tipo_pago" class="form-control">
                <option value="">Tipo de pago</option>
                @foreach ($bancos as $reg)
                    <option value="{{ $reg->id }}">{{ $reg->nombre }}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group" id="apartado_tipo_banco" style="display:none">
            <label class="control-label">Banco 1:</label>
           
              <select type="text" class="form-control" value="0" id="lista_bancos">
              </select>
           
          </div>

          <div class="form-group" id="saldo_apartado_tarjeta" style="display:none">
            <label class="control-label">Saldo tarjeta 1:</label>
            <input type="text" class="form-control" id="input_apartado_saldo_uno">
          </div>

          <div class="form-group" id="apartado_tipo_tarjeta_dos" style="display:none">
            <label class="control-label">Tipo de tarjeta 2:</label>
            <select name="id_categoria" id="id_tipo_pago_dos" class="form-control">
                <option value="">Tipo de pago</option>
                @foreach ($bancos as $reg)
                    <option value="{{ $reg->id }}">{{ $reg->nombre }}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group" id="apartado_tipo_banco_dos" style="display:none">
            <label class="control-label">Banco 2:</label>
           
              <select type="text" class="form-control" value="0" id="lista_bancos_dos">
              </select>
           
          </div>

          <div class="form-group" id="saldo_apartado_tarjeta_dos" style="display:none">
            <label class="control-label">Saldo tarjeta 2:</label>
            <input type="text" class="form-control" id="input_apartado_saldo_dos">
          </div>
          <!--/span-->
          <div class="form-group" id="efectivo_apartado_efectivo" style="display:none">
            <label class="control-label">Efectivo:</label>
            <input type="text" class="form-control" id="input_apartado_efectivo" >
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="cerrar_modal_producto">Cerrar</button>
        <button type="button" class="btn btn-success waves-effect waves-light" id="guardar_modal_apartado">
            <i class="fa fa-save"></i>
          Guardar</button>
      </div>

    </div>
  </div>
</div>
<!-- fin modal productos -->

<!--***************************************************************** -->
<!-- ***********   MODAL FACTURA SEPARADOS  ***************************-->
<!--***************************************************************** -->
<div class="modal-body factura_venta estilo_ocultar">

  <div class="row">
    <div class="col-md-12">
      <div class="img_factura">
        <img src="{{ $info_tienda->logo }}" alt="">
      </div>
      <br>
      <br>
      <div class="contenedor_factura" id="areaImprimir">
        <div id="nueva_factura" class="nueva_factura">

        </div>

        <div class="col-md-12">


          <div class="pull-right m-t-30 text-right modal-valore">
            
            <h3><b>T/Abono :</b> $<span id="total_abono" class="precio-total"></span></h3>
            <hr>
            <p>SUB - TOTAL: $ <span id="subtotal"></span> </p>
            <p>IVA ({{ $configuraciones[0]->iva }} %) : $ <span id="iva"></span> </p>
            <hr>
            <h3><b>Total :</b> $<span id="precioTotal" class="precio-total"></span></h3>
          </div>


          <div class="clearfix"></div>

          <div class="modal-footer">
            <button class="btn btn-default btn-outline ocultar-print" type="button" id="imprimir_factura"> <span><i class="fa fa-print"></i> Imprimir</span> </button>
            <button type="button" class="btn btn-danger waves-effect waves-light ocultar-print" id="cerrar_factura">Cerrar</button>
          </div>
        </div>
        <div class="footer_factura">
          <br>
          <p>AUTORIZACION NUMERICA DE FACTURACION</p>
          <p>{{ $info_tienda->resolucion }}</p>
          <p>{{ $info_tienda->fecha_resolucion }}</p>
          <p>{{ $info_tienda->prefijo }}</p>
          <p>Gracias por su compra</p>
          <p>sis-post www.bless.com</p>
        </div>

      </div>
    </div>
  </div>


</div>

<!-- ********** FIN FACTURA SEPARADOS ******************** -->

@endsection