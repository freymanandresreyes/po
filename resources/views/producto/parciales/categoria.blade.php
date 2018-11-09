<option value="">Seleccione una categoria</option>
@foreach ($consulta as $reg)
    <option value="{{ $reg->id }}">{{ $reg->categoria }}</option>
@endforeach