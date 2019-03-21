@extends('layout') 
@section('contenido')

<!-- Row -->
<br>
<div class="row">
  <div class="col-lg-12">
    <div class="card ">
      <div class="card-header bg-info">
        <h4 class="m-b-0 text-white">Caja registradora</h4>
      </div>
      <br> {{-- ****************************** --}}
      <div class="container">
        <div class="row" id="">
          <!-- Column -->
          <div class="col-lg-3 col-md-6">
            <div class="card">
              <a data-toggle="collapse" data-target="#demo" class="select_pagos" style="cursor:pointer" name="1">
                <div class="d-flex flex-row">
                  <div class="p-10 bg-info">
                    <h3 class="text-white box m-b-0"><i class="ti-wallet"></i></h3>
                  </div>
                  <div class="align-self-center m-l-20">
                    <h3 class="m-b-0 text-info">POST</h3>
                    <h5 class="text-muted m-b-0"></h5>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <!-- Column -->
          <!-- Column -->
          <div class="col-lg-3 col-md-6">
            <div class="card">
              <a data-toggle="collapse" data-target="#demo" class="select_pagos" style="cursor:pointer" name="2">
                <div class="d-flex flex-row">
                  <div class="p-10 bg-success">
                    <h3 class="text-white box m-b-0"><i class="ti-wallet"></i></h3>
                  </div>
                  <div class="align-self-center m-l-20">
                    <h3 class="m-b-0 text-success">OTROS</h3>
                    <h5 class="text-muted m-b-0"></h5>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <!-- Column -->
        
  </div>
</div>
      {{-- ****************************** --}}
      <div class="container">


        <div id="demo" class="collapse">
          <!-- List group -->
          <ul class="list-group" id="tipo_pago">

            <div class="funkyradio">
              <div id="pagos_post" style="display:none" >
                <div class="funkyradio-warning">
                  <input type="radio" name="tipopago" value="1" id="radio1" checked/>
                  <label for="radio1"><i class="ti-harddrive "></i>   Caja - pagos en efectivo.</label>
                </div>
                <div class="funkyradio-warning">
                  <input type="radio" name="tipopago" value="2" id="radio2" />
                  <label for="radio2"><i class="ti-credit-card "></i> Caja - pagos con tarjeta.</label>
                </div>
                <div class="funkyradio-warning">
                  <input type="radio" name="tipopago" value="3" id="radio3" />
                  <label for="radio3"> <i class="ti-info-alt"></i> Caja - Pagos mixtos.</label>
                </div>
                <div class="funkyradio-warning">
                  <input type="radio" name="tipopago" value="4" id="radio4" />
                  <label for="radio4"><i class="ti-credit-card"></i> Caja - Pagos tarjeta - tarjeta.</label>
                </div>
                <div class="funkyradio-warning">
                  <input type="radio" name="tipopago" value="5" id="radio5" />
                  <label for="radio5"><i class="ti-exchange-vertical"></i> Devoluciones mayoristas.</label>
                </div>
              </div>
              {{-- ******************** --}}
              <div id="pagos_otros" style="display: none" id="select_pagos_dos">
                <div class="funkyradio-warning">
                  <input type="radio" name="tipopago" value="6" id="radio6" />
                  <label for="radio6"><i class="ti-harddrive "></i>  Pagos con Sistecredito.</label>
                </div>
                <div class="funkyradio-warning">
                  <input type="radio" name="tipopago" value="7" id="radio7" />
                  <label for="radio7"><i class="ti-credit-card "></i> Pagos con Sistecredito y efectivo.</label>
                </div>
                <div class="funkyradio-warning">
                  <input type="radio" name="tipopago" value="8" id="radio8" />
                  <label for="radio8"><i class="ti-credit-card "></i> Pagos con Sistecredito y tarjeta.</label>
                </div>
                <div class="funkyradio-warning">
                  <input type="radio" name="tipopago" value="9" id="radio9" />
                  <label for="radio9"> <i class="ti-info-alt"></i> Pagos mixtos con Sistecredito.</label>
                </div>
                <div class="funkyradio-warning">
                  <input type="radio" name="tipopago" value="10" id="radio10" />
                  <label for="radio10"><i class="ti-credit-card"></i> Pagos Sistecredito y tarjeta - tarjeta.</label>
                </div>
                <div class="funkyradio-warning">
                  <input type="radio" name="tipopago" value="11" id="radio11" />
                  <label for="radio11"><i class="ti-credit-card"></i> Pagos Bless.</label>
                </div>
                <div class="funkyradio-warning">
                  <input type="radio" name="tipopago" value="12" id="radio12" />
                  <label for="radio12"><i class="ti-credit-card"></i> Pagos con Transaccion.</label>
                </div>
                <div class="funkyradio-warning">
                  <input type="radio" name="tipopago" value="13" id="radio13" />
                  <label for="radio13"><i class="ti-credit-card"></i> Pago A Credito.</label>
                </div>
                  <div class="funkyradio-warning">
                  <input type="radio" name="tipopago" value="14" id="radio14" />
                  <label for="radio14"><i class="ti-credit-card"></i> Pagos con cheque.</label>
                </div>
                  <div class="funkyradio-warning">
                  <input type="radio" name="tipopago" value="15" id="radio15" />
                  <label for="radio15"><i class="ti-credit-card"></i> Pagos con bono.</label>
                </div>
              </div>
              {{-- ******************** --}}
            </div>
          </ul>
        </div>

      </div>
      <div class="row">
                      <div class="col-lg-6">
                        <div class="row">
                          <!-- column -->
                          <div class="col-md-6">
                            <div class="card">
                              <div class="card-body">
                                <h5 class="card-title">Puntos Acumulados</h5>
                                <div class="d-flex m-t-30 m-b-20 no-block align-items-center">
                                  <span class="display-5 text-info"><i class="ti ti-medall"></i></span>
                                  <a class="link display-5 ml-auto" id="ind_total_puntos">0</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- column -->
                        </div>
                      </div>
      {{-- ======================================================== --}} {{-- ========================================================
      --}}
      <div class="card-body">
        {{-- CAJA GENERAL --}}
        <form action="#" class="form-horizontal">
          <div class="form-body">
            <h3 class="box-title">Información del cliente</h3>
            <hr class="m-t-0 m-b-40">
            <div class="row">
              <input type="hidden" id="id_cliente" value="">
              <input type="hidden" id="consecutivo_apartado" value="">
              <input type="hidden" id="estado_saldo" value="">
              <input type="hidden" id="tipo_tienda" value="{{ $info_tienda->mayorista}}">
              <input type="hidden" id="tipo_cliente" value="">
              <input type="hidden" id="check_mayorista" value="">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Documento:</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" placeholder="Número de documento" id="documento_cliente">
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
            <!--/iva-->
            <input type="hidden" value="{{  $configuraciones[0]->iva }}" id="iva_caja">
            <!--/iva-->
            
            <!--/row-->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">codigo:</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" id="codigo_producto" disabled>
                  </div>
                </div>
              </div>
              <div class="col-md-6" style="display: none" id="numero_factura">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">N de factura:</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" id="codigo_factura">
                  </div>
                </div>
              </div>
              <div class="col-md-6" style="display: none" id="seleccionar_iva">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">N de factura:</label>
                  <div class="col-md-9">
                    <select type="text" class="form-control" id="select_seleccionar_iva">
                      <option value="1">Si</option>
                      <option value="2">No</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <!--/row-->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">titulo:</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" id="caja_titulo" disabled>
                  </div>
                </div>
              </div>
              <div class="col-md-6" id="numero_factura">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Precio:</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" id="caja_precio" disabled>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Descuento:</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" id="caja_descuento">
                  </div>
                </div>
              </div>
              <div class="col-md-6" id="numero_factura">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Total:</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" id="caja_total" disabled>
                  </div>
                </div>
              </div>
            </div>
            <input type="hidden" id="caja_precio_detal" value="">
            <input type="hidden" id="caja_precio_mayor" value="">
            <input type="hidden" id="caja_precio_sin_iva" value="">
            <input type="hidden" id="caja_porsentaje" value=""> 
            <input type="hidden" id="caja_cantidad" value=""> 
            <input type="hidden" id="caja_descuento_oferta" value=""> 
            <input type="hidden" id="caja_id_producto" value=""> 
            <input type="hidden" id="caja_oferta" value=""> 
            <input type="hidden" id="caja_id_categoria" value=""> 
            <input type="hidden" id="caja_id_subcategoria" value=""> 
            <input type="hidden" id="caja_precio_costo" value=""> 
            <input type="hidden" id="caja_configuraciones" value=""> 
            <input type="hidden" id="caja_aplicar_iva" value=""> 
            <input type="hidden" id="caja_tipo_factura" value=""> 
            <input type="hidden" id="caja_clasificacion_producto" value=""> 
            <!--/row-->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Tipo de factura:</label>
                  <div class="col-md-9">
                    <select type="text" class="form-control" id="tag_factura" disabled>
                
                      @for($i = 0 ; $i < (count($list_tag )); $i++)
                        <option value="{{ $list_tag[$i]->nuevo_tag }}" name="{{ $list_tag[$i]->tipo }}">{{ $list_tag[$i]->nombre }}</option>
                      @endfor
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Vendedor:</label>
                  <div class="col-md-9">
                    <select type="text" class="form-control" id="vendedor_factura" disabled>
                      <option value="">Seleccione un vendedor</option>
                      @foreach ($vendedores as $reg)
                        <option value="{{ $reg->id }}">{{ $reg->nombres }}</option>            
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <!--/span-->
            <div class="row">
              <div class="col-md-6" style="display: none" id="mostrar_fecha">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Fecha de factura:</label>
                  <div class="col-md-9">
                    <input type="date" class="form-control" id="fecha_factura">
                  </div>
                </div>
              </div>

              <div class="col-md-6">

              </div>
            </div>
            <div class="text-right">
              <button id="caja_agregar_producto" class="btn btn-success btn-outline" type="button"> <span><i class="fa ti-shopping-cart-full"></i> Agregar</span> </button>
            </div>
            <!--/row-->
            <!-- ============================================================== -->
            <!--                 Start Page Content                             -->
            <!-- ============================================================== -->
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Listado de productos</h4>
                    <div class="row button-group">
                      <div class="col-lg-2 col-md-4">
                          <button type="button" class="btn btn-block btn-outline-info" disabled id="boton_mayor" alt="alert" class="img-responsive model_img">
                            <i class="fa fa-money"></i>
                            Mayor</button>
                      </div>
                  </div>
                    
                    <div class="table-responsive">
                      <table id="demo-foo-addrow" class="table m-t-30 table-hover contact-list" data-page-size="10">
                        <thead id="encabezado">
                          <tr class="dato">

                            <th>Producto</th>
                            <th>Ref</th>
                            <th style="display: none">precio_base</th>
                            <th style="display: none">precio_mayorista</th>
                            <th style="display: none">iva</th>
                            <th>Valor</th>
                            <th>%</th>
                            <th>Cant</th>
                            <th>Total</th>
                            <th style="display: none">descuento</th>
                            <th style="display: none">id</th>
                            <th style="display: none">categoria</th>
                            <th style="display: none">id_categoria</th>
                            <th style="display: none">id_subcategoria</th>
                            <th style="display: none">precio_costo</th>
                            <th style="display: none">configuraciones</th>
                            <th style="display: none">aplicar_iva</th>
                            <th style="display: none">tipo_factura</th>
                            <th style="display: none">clasificacion</th>
                            <th>opción</th>

                          </tr>
                        </thead>
                      </table>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="row">
                          <!-- column -->
                          <div class="col-md-6">
                            <div class="card">
                              <div class="card-body">
                                <h5 class="card-title">TOTAL PRODUCTOS</h5>
                                <div class="d-flex m-t-30 m-b-20 no-block align-items-center">
                                  <span class="display-5 text-info"><i class="icon-basket-loaded"></i></span>
                                  <a class="link display-5 ml-auto" id="ind_total_productos">0</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- column -->
                          <div class="col-md-6">
                            <div class="card">
                              <div class="card-body">
                                <h5 class="card-title">BOLSAS Y OBSEQUIOS</h5>
                                <div class="d-flex m-t-30 m-b-20 no-block align-items-center">
                                  <span class="display-5 text-purple"><i class="icon-handbag"></i></span>
                                  <a class="link display-5 ml-auto" id="ind_total_otros">0</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- column -->
                          <!-- column -->

                          <!-- column -->

                          <!-- column -->
                        </div>
                      </div>
                      <div class="col-lg-6">

                        <div class="pull-right m-t-30 text-right">
                          <p>Sub - TOTAL: $ <span id="subtotal">0</span> </p>
                          <p>Iva ({{ $configuraciones[0]->iva }}%) : $ <span id="iva">0</span> </p>
                          <hr>
                          <h3><b>TOTAL :</b> $<span id="precioTotal">0</span></h3>
                        </div>
                        <div class="clearfix"></div>
                        {{-- <!--********** INPUT PARA PAGO SISTECREDITO Y EFECTIVO--> --}}
                        <div class="row" id="saldo_sistecredito" style="display: none">
                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="control-label text-right col-md-8">Sistecredito:</label>
                              <div class="col-md-4">
                                <input type="text" class="form-control" value="0" id="valor_sistecredito" onkeyup="puntitos(this,this.value.charAt(this.value.length-1))">
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/FIN SISTECREDITO Y EFECTIVO-->

                        {{-- <!--/******** INPUT ABONOS **************--> --}}
                        <div class="row" id="saldo_abono" style="display: none">
                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="control-label text-right col-md-8">Abono:</label>
                              <div class="col-md-4">
                                <input type="text" class="form-control" value="" id="abono" disabled> 
                              </div>
                            </div>
                          </div>
                        </div>
                         {{-- ****** FIN INPUT ABONO **************  --}}

                        {{-- <!--/***** RADIO PAGO CON TAREJETA (1)--> --}}
                        <div class="row" id="tipo_pago_select" style="display: none">
                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="control-label text-right col-md-8">Tarjeta:</label>
                              <div class="col-md-4">
                                <div class="form-group btn-group" data-toggle="buttons" role="group" id="radio_selec_pago">
                                  <label class="btn btn-outline btn-info active" style="display: none">
                                  <input type="radio" name="pago" autocomplete="off" value="" checked="">
                                  <i class="ti-check text-active" aria-hidden="true"></i> 
                                  </label>
                                  @foreach ($bancos as $reg)
                                    <label class="btn btn-outline btn-info">
                                      <input type="radio" name="pago" autocomplete="off" value="{{ $reg->id }}" >
                                      <i class="ti-check text-active" aria-hidden="true"></i> {{ $reg->nombre }}
                                    </label> 
                                  @endforeach
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- <!--/**** FIN RADIO PAGO CON TARJETA (1) ************-->
                        <!--/**** FIN FANQUICIA PAGO CON TARJETA (1) ************--> --}}
                        <div class="row" id="franquicias" style="display: none">
                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="control-label text-right col-md-8">Banco:</label>
                              <div class="col-md-4">
                                <select type="text" class="form-control" value="0" id="lista_bancos">
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- <!--/**** FIN FRANQUICIA PAGO CON TARJETA (1)-->
                        <!--/************* INPUT PAGO CON TARJETA (1) ********--> --}}
                        <div class="row" id="input_tarjeta_dos" style="display: none">
                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="control-label text-right col-md-8">Tarjeta:</label>
                              <div class="col-md-4">
                                <input type="text" class="form-control" value="0" disabled id="caja_tarjeta_dos" onkeyup="puntitos(this,this.value.charAt(this.value.length-1))">
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- <!--/****** FIN PAGO CON TARJETA (1) *************--> --}}
                        <div class="row" id="valor_uno" style="display: none">
                          <!--/span-->
                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="control-label text-right col-md-8">Valor:</label>
                              <div class="col-md-4">
                                <input type="text" class="form-control" value="0" id="saldo_valor" onkeyup="puntitos(this,this.value.charAt(this.value.length-1))">
                              </div>
                            </div>
                          </div>
                          <!--/span-->
                        </div>
                        <div class="row" id="tipo_pago_select_dos" style="display: none">
                          <!--/span-->
                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="control-label text-right col-md-8">Tarjeta:</label>
                              <div class="col-md-4">
                                <div class="btn-group" data-toggle="buttons" role="group" id="radio_selec_pago_dos">
                                  <label class="btn btn-outline btn-info active" style="display: none">
                                                <input type="radio" name="pago2" autocomplete="off" value="n/a" checked="">
                                                <i class="ti-check text-active" aria-hidden="true"></i> N/A
                                            </label> @foreach ($bancos as $reg)
                                  <label class="btn btn-outline btn-info">
                                                    <input type="radio" name="pago2" autocomplete="off" value="{{ $reg->id }}" >
                                                    <i class="ti-check text-active" aria-hidden="true"></i> {{ $reg->nombre }}
                                                </label> @endforeach

                                </div>

                              </div>
                            </div>
                          </div>
                          <!--/span-->
                        </div>
                        <div class="row" id="franquicias_dos" style="display: none">
                          <!--/span-->
                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="control-label text-right col-md-8">Banco:</label>
                              <div class="col-md-4">
                                <select type="text" class="form-control" value="0" id="lista_bancos_dos">
                                        </select>
                              </div>
                            </div>
                          </div>
                          <!--/span-->
                        </div>

                        <div class="row" id="valor_dos" style="display: none">
                          <!--/span-->
                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="control-label text-right col-md-8">Valor:</label>
                              <div class="col-md-4">
                                <input type="text" class="form-control" value="0" id="saldo_valor_dos" onkeyup="puntitos(this,this.value.charAt(this.value.length-1))">

                              </div>
                            </div>
                          </div>
                          <!--/span-->
                        </div>



                        <div class="row" id="input_tarjeta" style="display: none">
                          <!--/span-->
                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="control-label text-right col-md-8">Tarjeta:</label>
                              <div class="col-md-4">
                                <input type="text" class="form-control" value="0" disabled id="caja_tarjeta" onkeyup="puntitos(this,this.value.charAt(this.value.length-1))">
                              </div>
                            </div>
                          </div>
                          <!--/span-->
                        </div>


                        {{-- <!--/*********** INPUT PARA PAGOS EN EFECTIVO ************--> --}}
                        <div class="row" id="input_efectivo_efectivo">
                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="control-label text-right col-md-8">Efectivo:</label>
                              <div class="col-md-4">
                                <input type="text" class="form-control" value="0" id="caja_efectivo_efectivo" onkeyup="puntitos(this,this.value.charAt(this.value.length-1))">
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- <!--/**** FIN INPUT PAGOS EN EFECTIVO *****************--> --}}
                        <div class="row" id="input_efectivo" style="display: none">
                          <!--/span-->
                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="control-label text-right col-md-8">Efectivo:</label>
                              <div class="col-md-4">
                                <input type="text" class="form-control" value="0" id="caja_efectivo" onkeyup="puntitos(this,this.value.charAt(this.value.length-1))">
                              </div>
                            </div>
                          </div>
                          <!--/span-->
                        </div>




                        {{-- <!--/**** PAGO CON TRANSACCION *****************--> --}}
                        <div class="row" id="input_transaccion" style="display: none">
                          <!--/span-->
                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="control-label text-right col-md-8">Total transaccion:</label>
                              <div class="col-md-4">
                                <input type="text" class="form-control" value="0" disabled id="caja_transacciones" onkeyup="puntitos(this,this.value.charAt(this.value.length-1))">
                              </div>
                            </div>
                          </div>
                          <!--/span-->
                        </div>
 
 
 
 
 
                        <div class="row" id="input_credito" style="display: none">
                          <!--/span-->
                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="control-label text-right col-md-8">Total credito:</label>
                              <div class="col-md-4">
                                <input type="text" class="form-control" value="0" disabled id="caja_credito" onkeyup="puntitos(this,this.value.charAt(this.value.length-1))">
                              </div>
                            </div>
                          </div>
                          <!--/span-->
                        </div>




                        {{-- <!--/************* INPUT PARA MOSTRAR EL CAMBIO ************--> --}}
                        <div class="row" id="input_cambio" style="display: block">
                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="control-label text-right col-md-8">Cambio:</label>
                              <div class="col-md-4">
                                <input type="text" class="form-control" value="0" disabled id="caja_cambio">
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- <!--/************* FIN INPUT CAMBIO ****************--> --}}

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
              <input type="mail" class="form-control" id="correo" required>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="cerrar_cliente">Cerrar</button>
          <button type="button" class="btn btn-danger waves-effect waves-light" id="guardar_cliente_caja">Guardar cliente</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
 
@section('factura')
<!-- /.modal -->
<!-- MODAL FACTURA estilo_ocultar -->
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
            <p>Total Efectivo: <span id="efectivo_cambio"></span></p>
            <p>Cambio: <span id="cambio_cambio"></span></p>
            <br>
            <p>SUB - TOTAL: $ <span id="subtotal1"></span> </p>
            <p>IVA ({{ $configuraciones[0]->iva }} %) : $ <span id="iva1"></span> </p>
            <hr>
            <h3><b>Total :</b> $<span id="precioTotal1" class="precio-total"></span></h3>
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
{{-- <!-- /.modal --> --}}
@endsection