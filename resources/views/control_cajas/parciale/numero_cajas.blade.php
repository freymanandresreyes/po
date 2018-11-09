<option value="" selected>Selecciona Una Caja</option>
    @foreach ( $consultausuarios as $reg)
        <option  value="{{ $reg->id }}">{{ $reg->n_caja }}</option>
    @endforeach