<div class="row">
    
    <!--fin de tienda -->
    <!--categoria-->
    <div class="col-md-3">
      <div class="form-group  row">
        <div class="col-md-12">
          <div class="input-group mb-3">
            {!! Form::select('id_categoria',$categorias, null, ['placeholder' => 'Seleccione una categoria', "class"=>"form-control", "id"=>"categoria"]) !!}
            
          </div>
        </div>
      </div>
    </div>
    <!--fin categoria-->
    <div class="col-md-3">
        <div class="form-group  row">
            <div class="col-md-12">
                <div class="input-group mb-3">
                
                {!! Form::select('id_subcategoria',[], null, 
                ['placeholder' => 'Seleccione una subcategoria', "class"=>"form-control","disabled", "id"=>"subcategoria"]) !!}
                
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group  row">
            <div class="col-md-12">
                {!! Form::text('titulo', null, ['class'=>'form-control', 'id'=>'titulo',"placeholder"=>"Titulo del producto"]) !!}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group row">
            <div class="col-md-3">
                <button type="button" class="btn btn-warning waves-effect waves-light" id="vista">Vista</button>         
            </div>

            <div class="col-md-3">         
                {!! Form::text('titulo', null, ['class'=>'form-control', 'id'=>'titulo',"placeholder"=>"%","id"=>"valor-promo"]) !!}                     
            </div>

            <div class="col-md-3">        
                <button type="button" class="btn btn-success waves-effect waves-light" id="actualizar-promo">Actualizar</button>
            </div>

        </div>
    </div>
</div>
  <!--fin row-->