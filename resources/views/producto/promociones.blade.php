@extends('layout') 
@section('contenido')
<!-- ***** estructura input crear producto **** -->
<br>

<div class="row menu_ocultar">
    <div class="col-lg-12">
      <div class="card ">
        <div class="card-header bg-info">
          <h4 class="m-b-0 text-white">MARGEN DE UTILIDAD POR FACTURA</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('utilidad_factura_consultar') }}" class="form-horizontal" method="POST">
            {{ csrf_field() }}
            <div class="form-body"> 
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Zonas:</label>
                    <div class="col-md-9">
                      <select type="date" class="form-control custom-select" id="informe_zona">
                        <option value="">Elija una zona.</option>
                        @foreach ($zonas as $reg)
                          <option value="{{ $reg->id }}">{{ $reg->nombre }}</option>                          
                        @endforeach
                      </select>
  
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Tienda:</label>
                    <div class="col-md-9">
                      <select type="" name="informe_tienda_select" class="form-control custom-select" id="informe_tienda_select" disabled>
                        <option value="">Elija una tienda</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Inicio:</label>
                    <div class="col-md-9">
                      <input type="date" name="fecha_inicio" class="form-control custom-select" id="fecha_inicio">
  
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Fin:</label>
                    <div class="col-md-9">
                      <input type="date" name="fecha_fin" class="form-control custom-select" id="fecha_fin">
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-right">         
               <button type="submit" class="btn btn-success" id="buscar_informe_utilidad_factura">Generar</button>  
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  



<div class="card-body">
  
    <div class="row">
      <div class="col-lg-12">
        <div class="card ">
          <div class="card-header bg-info">
            <h4 class="m-b-0 text-white">Caja registradora</h4>
          </div>
          <br>
          <button data-toggle="collapse" data-target="#demo">Opciones</button>
          <form action="" class="form-horizontal">
          <div id="demo" class="collapse">
            <br>
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
                    <small class="form-control-feedback"> Tienda Actual. </small>
                  </div>
                </div>
              </div>
              <!--fin de tienda -->
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Tiendas:</label>
                  <div class="col-md-9">

                    {!!Form::select('tienda', [],null,['id'=>'tienda_c_p','class'=>'form-control'])!!}
                    <small class="form-control-feedback"> Tienda Actual. </small>
                  </div>
                </div>
              </div>
            </div>
            <!--fin row-->
            <!--inicio del row-->
            <div class="row">
              <!--categoria-->
              <div class="col-md-6">
                <div class="form-group  row">
                  <label class="control-label text-right col-md-3">Categoria:</label>
                  <div class="col-md-9">
                    <div class="input-group mb-3">
                      {!! Form::select('id_categoria',$categorias, null, ['placeholder' => 'Seleccione una categoria', "class"=>"form-control","disabled"=>"true",
                      "id"=>"categoria"]) !!}
                      <div class="input-group-append">
                        <button class="btn btn-outline-primary" id="agregar-categoria" type="button" data-toggle="tooltip" data-placement="left"
                          title="" data-original-title="Agregar una categoria"><i class="fa fa-plus"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--fin categoria-->

              <!--subcategoria-->
              <div class="col-md-6">
                <div class="form-group  row">
                  <label class="control-label text-right col-md-3">Subcategoria:</label>
                  <div class="col-md-9">
                    <div class="input-group mb-3">

                      {!! Form::select('id_subcategoria',[], null, ['placeholder' => 'Seleccione una subcategoria', "class"=>"form-control","disabled"
                      => "true", "id"=>"subcategoria"]) !!}
                      <div class="input-group-append">
                        <button disabled class="btn btn-outline-primary" id="agregar-subcategoria" type="button" data-toggle="tooltip" data-placement="left"
                          title="" data-original-title="Agregar una subcategoria"><i class="fa fa-plus"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <!--categoria-->
              <div class="col-md-6">
                <div class="form-group  row">
                  <label class="control-label text-right col-md-3">Categoria:</label>
                  <div class="col-md-9">
                    <div class="input-group mb-3">
                      {!! Form::select('id_categoria',$categorias, null, ['placeholder' => 'Seleccione una categoria', "class"=>"form-control","disabled"=>"true",
                      "id"=>"categoria"]) !!}
                      <div class="input-group-append">
                        <button class="btn btn-outline-primary" id="agregar-categoria" type="button" data-toggle="tooltip" data-placement="left"
                          title="" data-original-title="Agregar una categoria"><i class="fa fa-plus"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--fin categoria-->

              <!--subcategoria-->
              <div class="col-md-6">
                <div class="form-group  row">
                  <label class="control-label text-right col-md-3">Subcategoria:</label>
                  <div class="col-md-9">
                    <div class="input-group mb-3">

                      {!! Form::select('id_subcategoria',[], null, ['placeholder' => 'Seleccione una subcategoria', "class"=>"form-control","disabled"
                      => "true", "id"=>"subcategoria"]) !!}
                      <div class="input-group-append">
                        <button disabled class="btn btn-outline-primary" id="agregar-subcategoria" type="button" data-toggle="tooltip" data-placement="left"
                          title="" data-original-title="Agregar una subcategoria"><i class="fa fa-plus"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--fin subcategoria-->
            <!--/span-->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group  row">
                  <label class="control-label text-right col-md-3">Titulo:</label>
                  <div class="col-md-9">
                    {!! Form::text('titulo', null, ['class'=>'form-control',"disabled"=>"true", 'id'=>'titulo',"placeholder"=>"Titulo del producto"])
                    !!}
                  </div>
                </div>
              </div>
              <!--/span-->
              <div class="col-md-6">
                <div class="form-group  row">
                  <label class="control-label text-right col-md-3">Descripci贸n:</label>
                  <div class="col-md-9">
                    {!! Form::text('descripcion', null, ['class'=>'form-control',"disabled"=>"true", 'id'=>'descripcion',"placeholder"=>"Descripci贸n
                    del producto"]) !!}
                    <small class="form-control-feedback"> Telefono del cliente. </small>
                  </div>
                </div>
              </div>
            </form>
          </div>

  




  {{-- <div class="form-group">
    {!! Form::open(['route' => 'pepito','class' => 'form-horizontal']) !!}
  @include('producto.parciales.form-filtro') {!! Form::close()
    !!}
  </div> --}}
  </div>
  <div class="card-body">




    {{-- ***************** inicio tabla **************** --}}
    <div class="card">
      <div class="card-body">

        <div class="table-responsive m-t-40">
          <table id="myTable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Categoria</th>
                <th>Subcategoria</th>
                <th>Titulo</th>
                <th>codigo</th>
                <th>precio</th>
                <th>oferta</th>
              </tr>
            </thead>
            <tbody>
              {{-- @foreach ($consulta as $reg)
              <tr>
                <td>{{ $reg->categoriaProductos->categoria }}</td>
                <td>{{ $reg->subcategoriaProductos->nombre_categoria }}</td>
                <td>{{ $reg->titulo }}</td>
                <td>{{ $reg->precio }}</td>
                <td>2011/04/25</td>
                <td><span class="badge badge-pill badge-info">{{ $reg->oferta }} %</span></td>
              </tr>
              @endforeach --}}
            </tbody>
          </table>
        </div>
      </div>
    </div>
    {{-- ***************** fin tabla *************** --}}


  </div>
  </div>
  </div>
  </div>
</div>
<!-- ***** fin estructura input crear producto **** -->
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
            <input type="text" class="form-control" id="categoria-modal">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="cerrar-categoria">Cerrar</button>
        <button type="button" class="btn btn-success waves-effect waves-light" id="guardar-categoria">Guardar</button>
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
            <input type="text" class="form-control" id="subcategoria-modal">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="cerrar-subcategoria">Cerrar</button>
        <button type="button" class="btn btn-success waves-effect waves-light" id="guardar-subcategoria">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- fin modal subcategorias -->
@endsection