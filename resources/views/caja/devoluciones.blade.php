@extends('layout')
@section('contenido')
  <!-- Row -->
  <br>
  <div class="row">
    <div class="col-lg-12">
      <div class="card ">
        <div class="card-header bg-info">
          <h4 class="m-b-0 text-white">Devoluciones</h4>
        </div>
        <div class="card-body">
          <form action="#" class="form-horizontal">
            <div class="form-body">
              <h3 class="box-title">Información del cliente</h3>
              <hr class="m-t-0 m-b-40">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Nº factura:</label>
                            <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Número de factura" id="numero_factura">
                            <small class="form-control-feedback"> Ingrese el número de factura del cliente. </small> </div>
                        </div>
                    </div>
                </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Documento:</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" placeholder="Número de documento" id="documento_cliente" disabled>
                    </div>
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
                  <!--/row-->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group  row">
                        <label class="control-label text-right col-md-3">Dirección:</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control " placeholder="Dirección del cliente" disabled id="direccion_cliente">
                          <small class="form-control-feedback"> Dirección de residencia. </small> </div>
                        </div>
                      </div>
                      <!--/span-->
                      <div class="col-md-6">
                        <div class="form-group  row">
                          <label class="control-label text-right col-md-3">Teléfono:</label>
                          <div class="col-md-9">
                            <input type="text" class="form-control " placeholder="Número de telefono" disabled id="telefono_cliente">
                            <small class="form-control-feedback"> Telefono del cliente. </small> </div>
                          </div>
                        </div>
                        <!--/span-->
                      </div>
                      <!--/row-->

                      <h3 class="box-title">Información de producto</h3>
                      <hr class="m-t-0 m-b-40">
                      <!--/row-->
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="control-label text-right col-md-3" >codigo:</label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" id="codigo_producto">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="control-label text-right col-md-3" >Producto:</label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" disabled id="producto">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="control-label text-right col-md-3" >precio base:</label>
                            <div class="col-md-9">
                              <input type="text" class="form-control"disabled id="precio_base">
                            </div>
                          </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="control-label text-right col-md-3">Precio descuento:</label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" disabled id="precio_descuento">
                            </div>
                          </div>
                        </div>
                        <!--/span-->
                      </div>
                      <!--/row-->
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="control-label text-right col-md-3">% descuento:</label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" disabled id="porsentaje_descuento">
                            </div>
                          </div>
                        </div>
                        <!--/span-->

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="control-label text-right col-md-3">cantida:</label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" id="cantidad_producto">
                            </div>
                          </div>
                        </div>
                        <!--/span-->
                      </div>
                      <!--/row-->
                      <!--inicio tabla -->
                      <!-- ============================================================== -->
                      <!-- Start Page Content -->
                      <!-- ============================================================== -->
                      <div class="row">
                        <div class="col-12">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">Listado de productos</h4>
                              <h6 class="card-subtitle"></h6>
                              <div class="table-responsive">
                                <table id="demo-foo-addrow" class="table m-t-30 table-hover contact-list" data-page-size="10">
                                  <thead id="encabezado">
                                    <tr class="dato">

                                      <th>Producto</th>
                                      <th>Ref</th>
                                      <th style="display: none">precio_base</th>
                                      <th>Valor</th>
                                      <th>%</th>
                                      <th>Cant</th>
                                      <th>Total</th>

                                    </tr>
                                  </thead>

                                </table>
                                <div class="col-md-12">
                                  <div class="pull-right m-t-30 text-right">
                                    <p >Sub - Total amount: $ <span id="subtotal">13,848</span> </p>
                                    <p >vat (10%) : $ <span id="iva">138</span>   </p>
                                    <hr>
                                    <h3><b>Total :</b> $<span id="precioTotal"></span></h3>
                                  </div>
                                  <div class="clearfix"></div>
                                  <hr>
                                  <div class="text-right">

                                    <button type="button" class="btn btn-success" id="vender_producto">Vender</button>
                                    <button type="button" class="btn btn-inverse">Cancel</button>

                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- ============================================================== -->
                      <!-- End PAge Content -->
                      <!-- ============================================================== -->
                      <!--fin tabla-->
                    </div>
                    <hr>



                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Row -->

          <div class="row">
            <!-- sample modal content -->
            <div id="modal_cliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Modal Content is Responsive</h4>

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
                        <textarea class="form-control" id="apellidos"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="message-text" class="control-label">direccion:</label>
                        <textarea class="form-control" id="direccion"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="message-text" class="control-label">telefono:</label>
                        <textarea class="form-control" id="telefono"></textarea>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="cerrar_cliente">Cerrar</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="guardar_cliente">Guardar cliente</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.modal -->

            <!-- MODAL FACTURA -->
            <div id="modal_factura" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">FACTURA</h4>

                  </div>
                  <div class="modal-footer">
                    <button id="print-factura" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Imprimir</span> </button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="cerrar_factura">Cerrar</button>
                  </div>
                  <div class="modal-body">

                    <div class="row">
                      <div class="col-md-12">
                        <div class="card card-body printableArea">
                          <h3><b>FACTURA Nº.</b> <span class="pull-right" id="numero_factura"></span></h3>
                          <hr>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="pull-left">
                                <address>
                                  <h3> &nbsp;<b class="text-danger">ORGANIZACION BLESS S.A.S</b></h3>
                                  <p class="text-muted m-l-5" id="datos_cliente">
                                  </p>
                                </address>
                              </div>

                            </div>
                            <div id="nueva_factura" class="nueva_factura">

                            </div>

                            <div class="col-md-12">

                              <div class="pull-left m-t-30 text-right">
                                <p >Sub - Total amount: $ <span id="subtotal1"></span> </p>
                                <p >vat (10%) : $ <span id="iva1"></span>   </p>
                                <hr>
                                <h3><b>Total :</b> $<span id="precioTotal1"></span></h3>
                              </div>
                              <div class="clearfix"></div>
                              <hr>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


                  </div>


                </div>
              </div>
            </div>
            <!-- /.modal -->

          </div>

        @endsection