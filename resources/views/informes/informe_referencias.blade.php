@extends('layout') 
@section('contenido')
<br>
<div id="appVue">
<div class="card">
 <div class="card-header bg-info">
      <h4 class="m-b-0 text-white">INFORME VENTAS POR REFERENCIA</h4>
    </div>
    <div class="card-body">
     <form method="POST" v-on:submit.prevent="buscaFacturasReferencia">
    <div class="row">
    <div class="col-md-4">
      <div class="form-group row">
        <label class="control-label col-md-3">COD REFERENCIA:</label>
        <div class="col-md-9">
          <input type="text" id="referencia" name="referencia" class="form-control custom-select" required="">
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group row">
        <label class="control-label col-md-3">DESDE:</label>
        <div class="col-md-9">
            <input type="date" name="desde" class="form-control custom-select" id="desde" required="">
        </div>
      </div>
    </div>
      <div class="col-md-4">
      <div class="form-group row">
        <label class="control-label col-md-3">HASTA:</label>
        <div class="col-md-9">
            <input type="date" name="hasta" class="form-control custom-select" id="hasta" required="">
        </div>
      </div>
    </div>
  </div>
      <div class="text-right">
  <button type="submit" class="btn btn-success">GENERAR INFORME</button>
</div>
</form>
<hr>
    <div v-if="loaderVue" class="text-center">
    <h2><i class="fa fa-refresh fa-spin"></i> Consultando facturas de la referencia...</h2>
    </div>
        <div class="alert alert-info" v-if="facturasReferencia != ''">
            <h3><i class="fa fa-info-circle"></i> ESTE PRODUCTO SE HA VENDIDO <b>@{{ facturasReferencia.total.total }} VECES EN ESE RANGO DE FECHAS.</b></h3>
        </div>
    </div>
</div>
</div>
@endsection
 