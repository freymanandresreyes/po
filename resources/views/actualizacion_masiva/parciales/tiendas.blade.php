  <option value="">Elija una Tienda.</option>
@foreach ($consulta_tiendas as $reg)
  <option value="{{ $reg->id }}">{{ $reg->slug }}</option>                          
@endforeach