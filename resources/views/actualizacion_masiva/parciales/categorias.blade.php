<option value="">Elija una Categoria.</option>
@for ($i = 0 ; $i < count($consulta_categorias); $i++)
  <option value="{{ $consulta_categorias[$i]->id }}">{{ $consulta_categorias[$i]->categoria }}</option>                          
@endfor