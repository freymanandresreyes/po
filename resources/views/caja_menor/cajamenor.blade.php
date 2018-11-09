@extends('layout')
@section('contenido')
  <!-- Row -->
  <br>
  <div class="row">
    <div class="col-lg-12">
      <div class="card ">
        <div class="card-header bg-info">
          <h4 class="m-b-0 text-white">Caja Menor</h4>
        </div>
        <div class="card-body">
          <form action="#" class="form-horizontal">
            <div class="form-body">
              @if ($conteo == 0)
                <h3 class="box-title">$ 0</h3>
              @else
                <h3 class="box-title" name="{{ $conteo }}" id="base">$ {{ $conteo }}</h3>
              @endif

              <hr class="m-t-0 m-b-40">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Movimiento:</label>
                    <div class="col-md-9">
                      <select class="form-control custom-select" id="opcion">
                        <option value="" selected>Selecciona Una Opción</option>
                        <option value="0">Entrada</option>
                        <option value="1">Salida</option>
                      </select>
                      <small class="form-control-feedback"> Movimiento a Realizar. </small>
                    </div>
                  </div>
                </div>
                <!--/span-->
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Valor:</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" placeholder="Valor $" required id="valor" >
                      <small class="form-control-feedback"> Monto  recibir o Entregar. </small>
                    </div>
                  </div>
                </div>
                <!--/span-->
              </div>

              <!--/row-->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Nombre:</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" placeholder="Nombre" id="nombre" required>
                      <small class="form-control-feedback"> Nombre de Quien Entrega O Recibe el Dinero. </small> </div>
                    </div>
                  </div>
                  <!--/span-->
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="control-label text-right col-md-3">Cedula</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" placeholder="Cedula" id="cedula" required>
                        <small class="form-control-feedback"> Cedula de Quien Entrega O Recibe el Dinero. </small> </div>
                      </div>
                    </div>
                    <!--/span-->
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="control-label text-right col-md-3">Motivo:</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" placeholder="Motivo" id="motivo" required>
                          <small class="form-control-feedback"> Motivo De Salida O Entrada Del Dinero </small>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="control-label text-right col-md-3">Tienda:</label>
                        <div class="col-md-9">
                          @if($consulta_tienda == "")
                          <input type="text" id="tienda" disabled class="form-control" placeholder="" value="">
                          @else
                          <input type="text" id="tienda" disabled class="form-control" placeholder="{{ $consulta_tienda->slug }}" value="{{ $consulta_tienda->slug }}">
                          @endif
                          <small class="form-control-feedback"> Tienda Actual. </small> </div>
                        </div>
                      </div>

                      <!--/span-->
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="control-label text-right col-md-3">Descripción</label>
                          <div class="col-md-9">
                            <textarea class="form-control" id="descripcion" required></textarea>
                            <small class="form-control-feedback"> Descripción del Presente Movimiento en Caja Menor. </small> </div>
                          </div>
                        </div>
                        <!--/span-->
                      </div>

                      <hr>
                      <div class="text-right">
                        <button type="button" class="btn btn-success" id="caja_menor">Enviar</button>
                      </div>

                      <!--/row-->
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Row -->



        @endsection


        @section('factura')
          
          <!-- MODAL FACTURA -->
          <div id="modal_cm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
              <div class="modal-dialog">
                <div class="modal-content">
  
  
                  <div class="modal-body">
  
                    <div class="row">
                      <div class="col-md-12" >
                        <div class="contenedor_factura" >
                          <div class="contenedor_factura" id="areaImprimir">
                              <div id="nueva_factura" class="nueva_factura" style="margin-left:6%;">

                                </div>
                        
  
                            <div class="">
                            <div class="clearfix"></div>
  
                            <div class="modal-footer">
                              <button class="btn btn-default btn-outline ocultar-print" type="button" id="imprimir"> <span><i class="fa fa-print"></i> Imprimir</span> </button>
                              <button type="button" class="btn btn-danger waves-effect waves-light ocultar-print" id="cerrar_cm">Cerrar</button>
                            </div>
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
