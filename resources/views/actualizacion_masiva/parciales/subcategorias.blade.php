<option value="">Elija una Categoria.</option>
@for ($i = 0 ; $i < count($consulta_subcategorias); $i++)
  <option value="{{ $consulta_subcategorias[$i]->id }}">{{ $consulta_subcategorias[$i]->nombre_categoria }}</option>                          
@endfor