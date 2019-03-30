<form>

    <div class="form-group">
        <label class="control-label">{{ $consulta2[0]->pregunta }}</label>
        <div class="col-md-12">
          <div class="input-group mb-3">
            <select name="" id="respuesta1" class="form-control">
            <option selected disabled value="0">Seleccione una categoria</option>
                @for ($i = 0 ; $i < count($consulta); $i++)
                @if($consulta[$i]->id_pregunta == $consulta2[0]->id_pregunta)
                <option value="{{ $consulta[$i]->id_opcion }}">{{ $consulta[$i]->opciones }}</option>
                @endif
                @endfor
            </select>
          </div>
        </div>
    </div>

<input id="referencia1" style="display:none" value="{{ $consulta_producto_aleatorio[0]->codigo }}">
<input id="referencia2" style="display:none" value="{{ $consulta_producto_aleatorio[1]->codigo }}">
<input id="id_formulario" style="display:none" value="{{ $consulta[0]->id_formulario }}">
<input id="pregunta1" style="display:none" value="{{ $consulta2[1]->id_pregunta }}">
<input id="pregunta2" style="display:none" value="{{ $consulta2[0]->id_pregunta }}">
<input id="pregunta3" style="display:none" value="{{ $consulta2[2]->id_pregunta }}">

    <div class="form-group">
        <label class="control-label">{{ $consulta2[1]->pregunta }}
        <br>
        <strong>{{ $consulta_producto_aleatorio[0]->codigo }}</strong>
        </label>
        <div class="col-md-12">
          <div class="input-group mb-3">
            <select name="" id="respuesta2" class="form-control">
            <option selected disabled value="0">Seleccione una categoria</option>
                @for ($i = 0 ; $i < count($consulta); $i++)
                @if($consulta[$i]->id_pregunta == $consulta2[1]->id_pregunta)
                <option value="{{ $consulta[$i]->id_opcion }}">{{ $consulta[$i]->opciones }}</option>
                @endif
                @endfor
            </select>
          </div>
        </div>
    </div>




    <div class="form-group">
        <label class="control-label">{{ $consulta2[2]->pregunta }}
        <br>
        <strong>{{ $consulta_producto_aleatorio[1]->codigo }}</strong>
        </label>
        <div class="col-md-12">
          <div class="input-group mb-3">
            <select name="" id="respuesta3" class="form-control">
            <option selected disabled value="0">Seleccione una categoria</option>
                @for ($i = 0 ; $i < count($consulta); $i++)
                @if($consulta[$i]->id_pregunta == $consulta2[2]->id_pregunta)
                <option value="{{ $consulta[$i]->id_opcion }}">{{ $consulta[$i]->opciones }}</option>
                @endif
                @endfor
            </select>
          </div>
        </div>
    </div>

</form>