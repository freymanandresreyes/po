@extends('layout')
@section('contenido')
<br>
<div id="appVue">
  <div class="row">
    <div class="col-lg-12">
      <div class="card ">
        <div class="card-header bg-info">
          <h4 class="m-b-0 text-white">INFORME ABONOS SISTECREDITO POR CLIENTE</h4>
        </div>
        <div class="card-body">
                <form class="form-horizontal">
                <div class="form-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="control-label col-md-3">Documento cliente:</label>
                        <div class="col-md-9">
                          <input v-on:keyup.enter="buscaFacturasCliente" type="number" placeholder="Digite documento del cliente" required="" class="form-control custom-select" v-model="documentoSistecredito">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="control-label col-md-3">Nombres:</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control custom-select" disabled :value="nombresClienteSistecredito">
                        </div>
                      </div>
                    </div>
                      <div class="col-md-6">
                      <div class="form-group row">
                        <label class="control-label col-md-3">Apellidos:</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control custom-select" disabled :value="apellidosClienteSistecredito">
                        </div>
                      </div>
                    </div>
                      <div class="col-md-6">
                      <div class="form-group row">
                        <label class="control-label col-md-3">Telefono:</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control custom-select" disabled :value="telefonoClienteSistecredito">
                        </div>
                      </div>
                    </div>
                  </div>
                 
                  <!--<div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="control-label text-right col-md-3">Inicio:</label>
                        <div class="col-md-9">
                          <input type="date" class="form-control custom-select" name="inicio" id="fecha_inicio">
      
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="control-label text-right col-md-3">Fin:</label>
                        <div class="col-md-9">
                          <input type="date" class="form-control custom-select" name="fin" id="fecha_fin">
                        </div>
                      </div>
                    </div>
                   
                  </div>-->
                  <div class="text-right">
                      <button type="button" class="btn btn-success" v-on:click="buscaFacturasCliente">Buscar abonos</button>
                    </div>
                </div>
              </form>
        </div>
      </div>
    </div>
  </div>
    <div v-if="loaderVue" class="text-center">
    <h2><i class="fa fa-refresh fa-spin"></i> Consultando abonos sistecredito de este cliente</h2>
  </div>
          <div class="card" v-if="(facturasCliente.cliente && facturasCliente.facturas_cliente)">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">Facturas con pagos de sistecredito del cliente: <b>@{{ facturasCliente.cliente.nombres }} @{{ facturasCliente.cliente.apellidos }}</b></h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example23" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nº factura</th>
                                    <th>Saldo sistecredito</th>
                                    <th>Total abonos</th>
                                    <th>Saldo pendiente</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(factura, index) in facturasCliente.facturas_cliente">
                                  <td>@{{ factura.n_factura }}</td>
                                    <td>$ @{{ formatNumber(factura.saldo_sistecredito) }}</td>
                                    <td>$ @{{ formatNumber(valorTotalAbonosFacturaSistecredito[index]) }}</td>
                                    <td>$ @{{ formatNumber(factura.saldo_sistecredito - valorTotalAbonosFacturaSistecredito[index]) }}</td>
                                    <td>
                                      <span v-if="((factura.saldo_sistecredito - valorTotalAbonosFacturaSistecredito[index]) > 0)" class="label label-danger">Pendiente</span>
                                      <span v-if="((factura.saldo_sistecredito - valorTotalAbonosFacturaSistecredito[index]) <= 0)" class="label label-success">Pagada</span>
                                    </td>
                                    <td class="text-center"><button v-on:click="buscaAbonosFactura(facturasCliente.cliente.id, factura.n_factura)" class="btn btn-default" type="button" title="Consultar abonos de esta factura" data-toggle="modal" :data-target="'#modalAbonoFactura' + index"><i class="fa fa-money"></i></button>
                                    <!--MODAL PARA ABONAR A LA FACTURA DE UN CLIENTE-->
                                    <div class="modal fade text-left" :id="'modalAbonoFactura' + index" tabindex="-1" role="dialog" aria-labelledby="modalLabelFactura" style="padding-right: 0px !important;top: -148px;">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content" id="factura_compra">
                                        <div class="modal-header" style="display: block;background-color: #272933;color: white;">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                          <h4 class="modal-title" id="modalLabelFactura"><i class="fa fa-money"></i> Abonos de la factura <b>@{{ factura.n_factura }}</b> del cliente <b>@{{ nombresClienteSistecredito }} @{{ apellidosClienteSistecredito }}</b></h4>
                                        </div>
                                        <div class="modal-body">
                                          <div v-if="(abonosFactura != '')">
                                          <div v-if="parseInt(abonosFactura.total_abonos) >= parseInt(factura.saldo_sistecredito)">
                                            <div class="alert alert-success">
                                            <strong><i class="fa fa-check-circle"></i> Esta factura ya ha cumplido con su saldo pendiente de sistecredito</strong>
                                          </div>
                                         </div>
                                          <h4>Abonos realizados a esta factura:</h4>
                                          <div v-if="abonosFactura.abonosFactura.length <= 0">
                                           <p><em></em></p>
                                             <div class="alert alert-warning">
                                            <strong><i class="fa fa-info-circle"></i> No se han realizado abonos a esta factura</strong>
                                          </div>
                                         </div>
                                            <div v-else class="table-responsive ">
                                            <table class="table table-bordered table-striped">
                                              <thead>
                                                <tr>
                                                  <th>Valor abono</th>
                                                  <th>Forma pago</th>
                                                  <th>Fecha</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr v-for="abono in abonosFactura.abonosFactura">
                                                  <td>$ @{{ abono.valor }}</td>
                                                  <td>
                                                    <span v-if="abono.tipo_pago == 0">Efectivo</span>
                                                    <span v-if="abono.tipo_pago == 1">Tarjeta</span>
                                                  </td>
                                                   <td>@{{ abono.created_at }}</td>
                                                </tr>
                                              </tbody>
                                            </table>
                                            <div class="text-right" style="padding-right: 10px;">
                                              <h4><b>* Total abonos: $ @{{ formatNumber(abonosFactura.total_abonos) }}</b><br><br>
                                              <b>* Total saldo pendiente: $ @{{ formatNumber(factura.saldo_sistecredito - valorTotalAbonosFacturaSistecredito[index]) }}</b></h4>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  </td>
                                  <!--FIN MODAL ABONO-->
                                </tr>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
    <div class="text-center" v-if="(facturasCliente.cliente != '' && facturasCliente.facturas_cliente == '')">
       <div class="alert alert-warning">
        <strong><i class="fa fa-info-circle"></i> El cliente no tiene facturas con saldos en sistecredito</strong>
      </div>
    </div>
</div>
<style type="text/css">
  @media (min-width: 576px){  
.modal-dialog {
    max-width: 700px !important;
}
}
</style>
@endsection