<option value="0">seleciona una tienda</option>
@foreach($consulta as $reg)
    <option value='{{$reg->id}}'>{{$reg->slug}}</option>
@endforeach
