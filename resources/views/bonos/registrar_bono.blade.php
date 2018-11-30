@extends('layout')
@section('contenido')
<br>
<div id="appVue">
  <div class="row">
    <div class="col-lg-12">
      <div class="card ">
        <div class="card-header bg-info">
          <h4 class="m-b-0 text-white">REGISTRAR BONOS A CLIENTES</h4>
        </div>
        <div class="card-body">
          <form class="form-horizontal">
            <div class="form-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Documento del cliente:</label>
                    <div class="col-md-9">
                      <input type="text"  v-on:keyup.enter="consultaCliente" id="documentoCliente" v-model="documentoCliente" required=""  class="form-control" >
                      <small class="form-control-feedback">Documento del cliente. </small>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Nombre del cliente:</label>
                    <div class="col-md-9">
                      <input type="text" disabled  class="form-control" id="nombreCliente">
                      <small class="form-control-feedback" > Nombre del cliente. </small>
                    </div>
                  </div>
                </div>              
              </div>
              <div class="text-right">
                <button type="button" v-on:click="consultaCliente" class="btn btn-success">Consultar cliente</button>
              </div>
            </div>
          </form>
          <hr>
          <div class="col-lg-12 col-md-12" style="display: none;" id="contBono">
            <form class="form-horizontal" v-on:submit.prevent>
               <div class="form-body">
            <div class="form-group row">
               <label class="control-label text-right col-md-3">Digite el codigo del bono:</label>
              <div class="col-md-9">
                <input type="text" id="codigoBono" required="" v-model="codigoBono" class="form-control" v-on:keyup.enter="registraBono">
                <small class="form-control-feedback"> Codigo del bono. </small>
              </div>
            </div>
             <div class="text-right">
                <button type="button" v-on:click="registraBono" class="btn btn-success">REGISTRAR BONO</button>
              </div>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<div class="modal fade text-left" id="modalBono" tabindex="-1" role="dialog" aria-labelledby="modalLabelBono" style="padding-right: 0px !important;">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="factura_compra">
      <div class="modal-header" style="display: block;background-color: #272933;color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalLabelBono"><i class="fa fa-user"></i> REGISTRAR CLIENTE</h4>
      </div>
      <div class="modal-body">
        <form action="#" method="POST" role="form" v-on:submit.prevent="registraCliente">
          <div class="form-group">
          <label for="documento">Documento</label>
          <input type="text" name="documento" id="documento" placeholder="Documento del cliente" class="form-control" disabled="">
        </div>
        <div class="form-group">
          <label for="nombre">Nombres</label>
          <input type="text" name="nombre" id="nombre" placeholder="Nombres del cliente" class="form-control" required="">
        </div>
         <div class="form-group">
          <label for="apellido">Apellidos</label>
          <input type="text" name="apellido" id="apellido" placeholder="Apellidos del cliente" class="form-control" required="">
        </div>
         <div class="form-group">
          <label for="fecha">Fecha de nacimiento</label>
          <input type="date" name="fecha" id="fecha" class="form-control" required="">
        </div>
          <div class="form-group">
          <label for="direccion">Direccion</label>
          <input type="text" name="direccion" id="direccion" placeholder="Direccion del cliente" class="form-control" required="">
        </div>
           <div class="form-group">
          <label for="telefono">Telefono</label>
          <input type="tel" name="telefono" id="telefono" placeholder="Telefono del cliente" class="form-control" required="">
        </div>
           <div class="form-group">
          <label for="correo">Correo electronico</label>
          <input type="email" name="correo" id="correo" placeholder="Correo electronico del cliente" class="form-control" required="">
        </div>
        <br>
        <div class="form-group">
          <button type="submit" class="btn btn-success">REGISTRAR CLIENTE</button>
        </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
</div>
  @endsection