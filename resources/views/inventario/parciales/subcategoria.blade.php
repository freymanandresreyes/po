<option value="">Seleccionar subcategoria</option>
@foreach ($consulta as $reg)
    <option value="{{ $reg->id }}">{{ $reg->nombre_categoria }}</option>
@endforeach