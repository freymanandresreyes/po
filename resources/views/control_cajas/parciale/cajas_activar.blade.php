<option value="" selected>Selecciona Una Opción</option>
@foreach ( $cajas as $reg)
  <option  value="{{ $reg->id }}">{{ $reg->n_caja }}</option>
@endforeach