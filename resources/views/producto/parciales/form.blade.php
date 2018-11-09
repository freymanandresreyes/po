<div class="row">
  <div class="col-md-6">
    <div class="form-group row">
      <label class="control-label text-right col-md-3">Zonas:</label>
      <div class="col-md-9">
        <select type="text" class="form-control"  id="tienda_zona_crear">
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
          <!--<select type="text" class="form-control"  id="tienda_c_p"-->
          <!--value="{{ $consulta_tienda->slug}}" name="{{ $consulta_tienda->id }}">-->
          <!--<option value="">Seleccione una tienda</option>-->
          <!--</select>-->
          {!!Form::select('tienda', [],null,['id'=>'tienda_c_p','class'=>'form-control'])!!}
          <small class="form-control-feedback"> Tienda Actual. </small>
        </div>
      </div>
    </div>
</div>

<div class="row">
  <!--fin de tienda -->
  <div class="col-md-6">
    <div class="form-group  row">
      <label class="control-label text-right col-md-3">codigo:</label>
      <div class="col-md-9">
        {!! Form::text('codigo', null, ['class'=>'form-control', 'id'=>'codigo_c_p',"placeholder"=>"Codigo del producto"]) !!}
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
            {!! Form::select('id_categoria',$categorias, null, ['placeholder' => 'Seleccione una categoria', "class"=>"form-control","disabled"=>"true", "id"=>"categoria"]) !!}
            <div class="input-group-append">
              <button class="btn btn-outline-primary" id="agregar-categoria" type="button" data-toggle="tooltip" data-placement="left" title="" data-original-title="Agregar una categoria"><i class="fa fa-plus"></i></button>
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

          {!! Form::select('id_subcategoria',[], null,
          ['placeholder' => 'Seleccione una subcategoria', "class"=>"form-control","disabled" => "true", "id"=>"subcategoria"]) !!}
          <div class="input-group-append">
            <button disabled class="btn btn-outline-primary" id="agregar-subcategoria" type="button" data-toggle="tooltip" data-placement="left" title="" data-original-title="Agregar una subcategoria"><i class="fa fa-plus"></i></button>
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
        {!! Form::text('titulo', null, ['class'=>'form-control',"disabled"=>"true", 'id'=>'titulo',"placeholder"=>"Titulo del producto"]) !!}
      </div>
    </div>
  </div>
  <!--/span-->
  <div class="col-md-6">
      <div class="form-group  row">
        <label class="control-label text-right col-md-3">Descripci贸n:</label>
        <div class="col-md-9">
          {!! Form::text('descripcion', null, ['class'=>'form-control',"disabled"=>"true", 'id'=>'descripcion',"placeholder"=>"Descripci贸n del producto"]) !!}
          <small class="form-control-feedback"> Telefono del cliente. </small>
        </div>
      </div>
    </div>

</div>
<!--fin row-->

<!--inicio del row-->
{{-- <div class="row">
  <!--subcategoria-->
  <div class="col-md-6">
      <div class="form-group  row">
        <label class="control-label text-right col-md-3">Precio:</label>
        <div class="col-md-9">
          {!! Form::text('precio', null, ['class'=>'form-control',"disabled"=>"true", 'id'=>'precio',"placeholder"=>"$"]) !!}
        </div>
      </div>
    </div>
    <!--fin subcategoria-->
    <div class="col-md-6">
        <div class="form-group  row">
          <label class="control-label text-right col-md-3">Precio Mayorista:</label>
          <div class="col-md-9">
            {!! Form::text('precio_mayorista', null, ['class'=>'form-control',"disabled"=>"true", 'id'=>'precio_mayorista',"placeholder"=>"$"]) !!}
          </div>
        </div>
      </div>
  <!--fin subcategoria-->
</div> --}}
<!--fin row-->

<!--inicio del row-->
{{-- <div class="row"> --}}
  <!--subcategoria-->

  <!--/span-->
  {{-- <div class="col-md-6">
    <div class="form-group  row">
      <label class="control-label text-right col-md-3">Cantidad:</label>
      <div class="col-md-9">
          {!! Form::text('cantidad', null, ['class'=>'form-control',"disabled"=>"true", 'id'=>'cantidad']) !!}
      </div>
    </div>
  </div> --}}
  <!--/span-->
  {{-- <div class="col-md-6">
      <div class="form-group  row">
        <label class="control-label text-right col-md-3">oferta:</label>
        <div class="col-md-9">
              {!! Form::select('oferta', ['1' => 'No', '0' => 'Si'], null, ['placeholder' => 'Agregar oferta', "class"=>"form-control ","disabled"=>"true", 'id'=>'oferta']) !!}
        </div>
      </div>
    </div>
</div> --}}
<!--fin row-->




{{-- <div class="row"> --}}

    <!--/span-->
    {{-- <div class="col-md-6">
        <div class="form-group  row">
          <label class="control-label text-right col-md-3">Descuento:</label>
          <div class="col-md-9">
            {!! Form::text('descuentoOferta', 0, ['class'=>'form-control',"disabled"=>"true","placeholder"=>"%","id"=>"descuento"]) !!}
          </div>
        </div>
      </div>
    <!--/span-->
    <div class="col-md-6">
        <div class="form-group  row">
          <label class="control-label text-right col-md-3">fecha de inicio:</label>
          <div class="col-md-9">
            <input type="date" name="fechaInicio" class="form-control " placeholder="N煤mero de telefono" disabled id="fechaInicio">
          </div>
        </div>
      </div>
  </div> --}}


<!--inicio del row-->
{{-- <div class="row">

  <!--/span-->
  <div class="col-md-6">
    <div class="form-group  row">
      <label class="control-label text-right col-md-3">fecha fin:</label>
      <div class="col-md-9">
        <input type="date" name="fechaFin" class="form-control " placeholder="N煤mero de telefono" disabled id="fechaFin">
      </div>
    </div>
  </div>
  <!--/span-->
</div> --}}
<!--fin row-->

<div class="modal-footer">
  <button id="productoguardar" type="submit" class="btn btn-success waves-effect waves-light">Guardar</button>
</div>
