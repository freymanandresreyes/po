<option value="">Seleccione...</option>
@foreach ($datos as $reg )
  <option value="{{ $reg->id }}">{{ $reg->nombre }}</option>  
@endforeach