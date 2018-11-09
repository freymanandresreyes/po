<option value="">Elija una Columna.</option>
@for ($i = 0 ; $i < count($consulta_columnas); $i++)
  <option value="{{ $consulta_columnas[$i] }}">{{ $consulta_columnas[$i] }}</option>                          
@endfor