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
          {{-- CAJA GENERAL --}}
          <form action="#" class="form-horizontal">
            <div class="form-body">
              <h3 class="box-title">Factura</h3>
              <hr class="m-t-0 m-b-40">
              <div class="row">
                <input type="hidden" id="id_cliente" value="">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Factura:</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" placeholder="Número de factura" id="numero_factura_devolucion">
                    </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="control-label text-right col-md-3">Nombre del cliente:</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" disabled  id="nombre_cliente">
                      </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="control-label text-right col-md-3">Cedula del cliente:</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" disabled  id="cedula_cliente">
                        </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="control-label text-right col-md-3">Direccion del cliente:</label>
                          <div class="col-md-9">
                            <input type="text" class="form-control" disabled  id="direccion_cliente">
                          </div>
                          </div>
                        </div>
                     
                  <!--/span-->
                  
                    <!--/span-->
                  </div>
                  <!--/row-->
                

                      <!-- ============================================================== -->
                      <!-- Start Page Content -->
                      <!-- ============================================================== -->
                      <div class="row">
                        <div class="col-12">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title"></h4>
                              <h6 class="card-subtitle"></h6>
                              <div class="table-responsive">
                                <table id="" class="table m-t-30 table-hover contact-list" data-page-size="10" name="tabla1">
                                  <thead id="encabezado">
                                    <tr class="dato">
                                      <th>Fecha</th>
                                      <th>Producto</th>
                                      <th>Ref</th>
                                      <th>Valor</th>
                                      <th>Cant</th>
                                      
                                      <th>Opciones</th>

                                    </tr>
                                  </thead>
                                  <tbody id="contenido_factura">
                                  </tbody>

                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- ============================================================== -->
                      <!-- End PAge Content -->
                      <!-- ============================================================== -->
                      <div class="row">
                          <div class="col-12">
                            <div class="card">
                              <div class="card-body">
                      <h3 class="box-title">Devoluciones</h3>
                      <hr class="m-t-0 m-b-40">
                      <div class="form-group">
                        <div class="table-responsive">
                          <table id="demo-foo-addrow" class="table m-t-30 table-hover contact-list" data-page-size="10" name="tabla1">
                            <thead id="encabezado_devoluciones">
                              <tr class="dato">
                                <th>Producto</th>
                                <th>Ref</th>
                                <th>Valor</th>
                                <th>Cant</th>
                                <th>Descripción</th>
                                <th>Tipo</th>
                                <th>Opciones</th>
                              </tr>
                            </thead>
                            <tbody id="contenido_devolucion">
                            </tbody>

                          </table>
                        </div>
                          
                      </div>
                    </div>

                    <div class="col-md-12">
                        
                        <div class="clearfix"></div>
                        <hr>
                        <div class="text-right">
                          <button type="button" class="btn btn-success" id="guardar_devolucion2018">Registrar devolución</button>
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
            <div id="modal_devolucion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Devolucion</h4>

                  </div>
                  <div class="modal-body">
                    <form>
                      <div class="form-group">
                        <label for="recipient-name" class="control-label">fecha de la factura:</label>
                        <input type="text" class="form-control" id="fecha" disabled>
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="control-label">producto:</label>
                        <input type="text" class="form-control" id="producto" disabled>
                      </div>
                      <div class="form-group">
                        <label for="message-text" class="control-label">referencia:</label>
                        <input class="form-control" id="referencia" disabled>
                      </div>
                      <div class="form-group">
                        <label for="message-text" class="control-label">valor:</label>
                        <input class="form-control" id="valor" disabled>
                      </div>
                      <div class="form-group">
                        <label for="message-text" class="control-label">cantidad:</label>
                        <input class="form-control" id="cantidad" disabled>
                      </div>
                      <div class="alert alert-danger" id="alerta_devolucion" style="display: none"> <i class="ti-close"></i> 
                        la cantidad de devoluciones no puede estar vacio o supera la cantidad.   
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">tipo:</label>
                        <br>
                        <!-- <input class="form-control" id="cantidad" disabled> -->
                        <select class="form-control" id="tipo_devolucion">
                          <option selected disabled value="">selecciona una opcion</option>
                          <option value="cambio">cambio</option>
                          <option value="devolucion">devolucion</option>
                        </select>
                      </div>
                    <div class="form-group">
                      <label for="message-text" class="control-label">descripcion:</label>
                      <textarea class="form-control" id="descripcion_devolucion"></textarea>
                    </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="cerrar_devolucion">Cerrar</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="registrar_devolucion2018">Registrar</button>
                  </div>
                </div>
              </div>
            </div>
            

          </div>

        @endsection
        @section('factura')
          <!-- /.modal -->

            <!-- MODAL FACTURA -->
            <div id="modal_factura" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header ocultar-print">
                    <p>ZARETH PREMIUM</p>

                  </div>
                  
                  <div class="modal-body">

                    <div class="row">
                      <div class="col-md-12" >
                        <div class="contenedor_factura" id="areaImprimir">  
                            <div id="nueva_factura" class="nueva_factura">

                            </div>

                            <div class="">

                              <div class="pull-left m-t-30 text-right">
                                <p >Sub - Total amount: $ <span id="subtotal1"></span> </p>
                                <p >vat (10%) : $ <span id="iva1"></span>   </p>
                                <hr>
                                <h3><b>Total :</b> $<span id="precioTotal1"></span></h3>
                              </div>
                              <div class="clearfix"></div>
                              
                                <div class="modal-footer">
                                  <button class="btn btn-default btn-outline ocultar-print" type="button" id="imprimir_factura"> <span><i class="fa fa-print"></i> Imprimir</span> </button>
                                  <button type="button" class="btn btn-danger waves-effect waves-light ocultar-print" id="cerrar_factura">Cerrar</button>
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

        @endsection