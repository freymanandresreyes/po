@foreach($consulta_c_p as $reg)
<option value="{{ $reg->id }}">{{ $reg->categoria }}</option>
@endforeach