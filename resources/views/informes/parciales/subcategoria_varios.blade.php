<option value="">Seleccione una opción</option>
@foreach ($subcategorias as $reg)
    <option value="{{ $reg->id }}">{{ $reg->nombre_categoria }}</option>
@endforeach