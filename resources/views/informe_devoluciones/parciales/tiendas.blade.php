<option value="">Seleccione una tienda</option>
@foreach ($consulta_tiendas as $reg)
    <option value="{{ $reg->id }}">{{ $reg->slug }}</option>
@endforeach