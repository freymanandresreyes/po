@extends('layout') 
@section('contenido')
<!-- Row -->
<br>
<!--inicio alertas-->
  @include('producto.parciales.error')
  @include('producto.parciales.info')
<!--fin alertas-->

<!-- ***** estructura input crear producto **** -->
<div class="row">
  <div class="col-lg-12">
    <div class="card ">
      <div class="card-header bg-info">
        <h4 class="m-b-0 text-white">TRASLADOS</h4>
      </div>
      <div class="card-body">
        <form action="#" class="form-horizontal">
          <div class="form-body">

            <div class="row">
              <input type="hidden" id="id_producto_remision" value="">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Opciones:</label>
                  <div class="col-md-9">
                    <select id="opciones_remisiones" class="form-control custom-select">
                      <option value="" selected>Selecciona Una Opción</option>
                      <option value="1">TRASLADO</option>
                      <option value="2">REMISION</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">

              <input type="hidden" id="id_producto_remision" value="">
              <div class="col-md-6">
                <div class="form-group row">

                  
                    <label class="control-label text-right col-md-3" id="t_r_uno" style="display:block">Tiendas:</label>
                    <div class="col-md-9" style="display:block" id="i_r_uno">
                      <select id="tienda_remisiones" class="form-control custom-select" disabled>
                        <option value="" selected>Selecciona Una Opción</option>
                        @foreach ( $lista_tiendas as $reg)
                          <option  value="{{ $reg->id }}">{{ $reg->slug }}</option>
                        @endforeach
                      </select>
                    </div>
                  

                  {{-- <div style="display:none" id="proveedor_remisiones">  --}}
                    <label class="control-label text-right col-md-3" id="t_r_dos" style="display:none">Proveedor:</label>
                    <div class="col-md-9" style="display:none" id="i_r_dos">
                      <select id="proveedor_remisiones" class="form-control custom-select" disabled>
                        <option value="" selected>Selecciona Una Opción</option>
                        @foreach ( $proveedor as $reg)
                          <option  value="{{ $reg->id }}">{{ $reg->nombre }}</option>
                        @endforeach
                      </select>
                    </div>
                
                </div>
              </div>


              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Codigo:</label>
                  <div class="col-md-9">
                    <input type="text" id="codigo_remision" disabled class="form-control" placeholder="Codigo Del Producto">
                  </div>
                  
                </div>
              </div>
            </div>
          </div>

          <div class="row">

              <input type="hidden" id="id_producto_remision" value="">

              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Cantidad:</label>
                  <div class="col-md-9">
                    <input type="text" id="cantidad_remision" disabled class="form-control" placeholder="Cantidad">
                  </div>
                </div>
              </div>


              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Precio:</label>
                  <div class="col-md-9">
                    <input type="text" id="precio_remision" disabled class="form-control" placeholder="Precio $">
                  </div>
                </div>
              </div>

            </div>
            <div class="text-right">
              <button type="button" class="btn btn-success" id="agregar_remision">Aceptar</button>
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
        <h4 class="card-title">Productos De Traslado</h4>
        <h6 class="card-subtitle"></h6>
        <div class="table-responsive">
          <table id="demo-foo-addrow" class="table m-t-30 table-hover contact-list" data-page-size="10">
            <thead id="encabezado_remision">
              <tr>
                <th>Referencia</th>
                <th style="display: none">id producto</th>
                <th>precio</th>
                <th>cantidad</th>
                <th>tienda</th>
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
          <button type="button" class="btn btn-success" id="crear_remision">
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
@endsection