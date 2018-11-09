@extends('layout') 
@section('contenido')
<!-- ***** estructura input crear producto **** -->
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="card ">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">Registro de Inventario</h4>
            </div>
            @role('compras')
            <div class="card-body">
                <form action="{{ route('ver_inventario_zona') }}" method="get" class="form-horizontal">
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
                                        <select type="" name="tienda" class="form-control custom-select" id="informe_tienda_select" disabled>
                                    <option value="">Elija una tienda</option>
                                </select>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="text-right">
                            <button type="submit" class="btn btn-success">Generar</button>

                        </div>
                    </div>
                </form>
            </div>
            @else

            @role('administrativo')
            <div class="card-body">
                <form action="{{ route('ver_inventario_zona') }}" method="get" class="form-horizontal">
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
                                        <select type="" name="tienda" class="form-control custom-select" id="informe_tienda_select" disabled>
                                    <option value="">Elija una tienda</option>
                                </select>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="text-right">
                            <button type="submit" class="btn btn-success">Generar</button>

                        </div>
                    </div>
                </form>
            </div>
            @endrole


            @endrole 
           
            {{-- ***************** inicio tabla **************** --}} 
            {{-- @role('compras') --}}
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive m-t-40">
                        <table id="example23" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Categoria</th>
                                    <th>Subcategoria</th>
                                    <th>Titulo</th>
                                    <th>Codigo</th>
                                    <th>C/Ingreso</th>
                                    <th>C/Bodega</th>
                                    <th>C/Ventas</th>
                                    <th>Precio Costo</th>
                                    <th>Precio detal</th>
                                    <th>Precio mayor</th>
                                    <th>Oferta</th>
                                    <th>% Des</th>
                                    <th>T/Producto</th>
                                    <th>Opcion</th>
                                </tr>
                            </thead>
                            <tbody id="cont_inventario">
                                @foreach ($consulta as $reg)
                                <tr>
                                    <td>{{ $reg->categoriaProductos->categoria }}</td>
                                    <td>{{ $reg->subcategoriaProductos->nombre_categoria }}</td>
                                    <td>{{ $reg->titulo }}</td>
                                    <td>{{ $reg->codigo }}</td>
                                    <td>{{ $reg->cantidad_ingreso }}</td>
                                    <td>{{ $reg->cantidad }}</td>
                                    <td>{{ $reg->cantidad_ventas }}</td>
                                    <td>{{ " $ ".$reg->precio_costo }}</td>
                                    <td>{{ " $ ".$reg->precio }}</td>
                                    <td>{{ " $ ".$reg->Precio_mayorista }}</td>
                                    <td>
                                        @if($reg->oferta==1)
                                        <span class="label label-success">SI</span>
                                        @else
                                        <span class="label label-danger">NO</span>
                                        @endif
                                    </td>
                                    <td>{{ $reg->descuentoOferta }}</td>
                                    
                                    <td><span class="label label-success">{{ $reg->clasificacion['nombre']}}</span></td>
                                    
                                    <td>
                                        <button class="btn btn-success editar_inv" name="{{ $reg->id }}">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- ***************** fin tabla *************** --}} 
            {{-- @else --}}

            <div class="card">
                <div class="card-body">

                    <div class="table-responsive m-t-40">
                        <table id="example23" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Categoria</th>
                                    <th>Subcategoria</th>
                                    <th>Titulo</th>
                                    <th>Codigo</th>
                                    <th>Cantidad</th>
                                    <th>Precio detal</th>
                                    <th>Precio mayor</th>
                                    <th>Oferta</th>

                                </tr>
                            </thead>
                            <tbody id="cont_inventario">
                                @foreach ($consulta as $reg)
                                <tr>
                                    <td>{{ $reg->categoriaProductos->categoria }}</td>
                                    <td>{{ $reg->subcategoriaProductos->nombre_categoria }}</td>
                                    <td>{{ $reg->titulo }}</td>
                                    <td>{{ $reg->codigo }}</td>
                                    <td>{{ $reg->cantidad }}</td>
                                    <td>{{ " $ ".$reg->precio }}</td>
                                    <td>{{ " $ ".$reg->Precio_mayorista }}</td>
                                    <td>{{ $reg->descuentoOferta }}</td>


                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- ***************** fin tabla *************** --}} 
            {{-- @endrole --}}


        </div>
    </div>
</div>
</div>
</div>
<!-- ***** fin estructura input crear producto **** -->



<!--  modal productos -->
<div id="modal_inventario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content" id="factura_compra">
            <div class="modal-header">
                <h4 class="modal-title">Editar producto</h4>
            </div>
            <div class="modal-body">
                <form>


                    <!--fin de tienda -->

                    <div class="form-group">
                        <label class="control-label">codigo:</label> {!! Form::text('codigo', null, ['class'=>'form-control',
                        'id'=>'editar_codigo',"placeholder"=>"Codigo del producto"]) !!}
                        <input type="hidden" id="editar_id" value="">
                    </div>


                    <!--fin row-->
                    <!--inicio del row-->

                    <!--categoria-->

                    <div class="form-group">
                        <label class="control-label">Categoria:</label>
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <select name="" id="editar_categoria" class="form-control">
                                    <option value="">Seleccione una categoria</option>
                                    @foreach ($categorias_modal as $reg)
                                    <option value="{{ $reg->id }}">{{ $reg->categoria }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!--fin categoria-->

                    <!--subcategoria-->

                    <div class="form-group">
                        <label class="control-label">Subcategoria:</label>
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <select name="" id="editar_subcategoria" class="form-control">
                                    <option value="">Seleccione una subcategoria.</option>
                                </select>

                            </div>
                        </div>
                    </div>


                    <!--fin subcategoria-->
                    <!--/span-->
                    <div class="form-group">
                        <label class="control-label">Titulo:</label> {!! Form::text('titulo', null, ['class'=>'form-control',
                        'id'=>'editar_titulo',"placeholder"=>"Titulo del producto"]) !!}
                    </div>
                    <!--/span-->
                    <div class="form-group">
                        <label class="control-label">Descripcion:</label> {!! Form::text('descripcion', null, ['class'=>'form-control',
                        'id'=>'editar_descripcion',"placeholder"=>"Descripción del producto"]) !!}
                    </div>

                    <div class="form-group">
                        <label class="control-label">Cantidad:</label> {!! Form::text('descripcion', null, ['class'=>'form-control',
                        'id'=>'editar_cantidad',"placeholder"=>"Descripción del producto"]) !!}
                    </div>

                    <div class="form-group">
                        <label class="control-label">Precio Costo:</label> {!! Form::text('descripcion', null, ['class'=>'form-control',
                        'id'=>'editar_costo',"placeholder"=>"Costo del producto"]) !!}
                    </div>

                    <div class="form-group">
                        <label class="control-label">Precio detal:</label> {!! Form::text('descripcion', null, ['class'=>'form-control',
                        'id'=>'editar_detal',"placeholder"=>"Descripción del producto"]) !!}
                    </div>
                    <div class="form-group">
                        <label class="control-label">Precio mayor:</label> {!! Form::text('descripcion', null, ['class'=>'form-control',
                        'id'=>'editar_mayor',"placeholder"=>"Descripción del producto"]) !!}
                    </div>
                    <div class="form-group">
                        <label class="control-label">% Oferta:</label> {!! Form::text('descripcion', null, ['class'=>'form-control',
                        'id'=>'editar_oferta',"placeholder"=>"Descripción del producto"]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('editar_estado_oferta', 'Oferta',['class'=>'control-label']) !!}
                        {!!Form::select('editar_estado_oferta_producto', $filtro_oferta ,null,['class'=>'form-control','id'=>'editar_estado_oferta_producto','placeholder'=>'Selecione Una Opción'])!!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('editar_configuracion', 'Configuracion Del Producto',['class'=>'control-label']) !!}
                        {!!Form::select('editar_configuracion', $filtro_configuracion ,null,['class'=>'form-control','id'=>'editar_configuracion_producto','placeholder'=>'Selecione Una Opción'])!!}
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="cerrar_editar_producto">Cerrar</button>
                <button type="button" class="btn btn-success waves-effect waves-light" id="guardar_editar_producto">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- fin modal productos -->
@endsection