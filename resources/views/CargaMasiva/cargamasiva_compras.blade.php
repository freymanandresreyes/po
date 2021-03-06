@extends('layout')
@section('contenido')
<br>
<div id="appVue">
  <div class="row">
    <div class="col-lg-12">
      <div class="card ">
        <div class="card-header bg-info">
          <h4 class="m-b-0 text-white">CARGA MASIVA DE COMPRAS POR TIENDA</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('subir_carga_masiva_compras') }}" class="form-horizontal" id="file-compras" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Tipo de masivo:</label>
                    <div class="col-md-9">
                      <select  class="form-control custom-select" name="opcion" required="" id="opcion" @change="optionsCargaMasiva">
                          <option disabled value="" selected>Selecciona Una Opcion</option>
                          <option value="1">COMPRAS</option>
                          <option value="2">TRASLADO</option>           
                      </select>
                      <small class="form-control-feedback">Tipo de masivo. </small>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Archivo:</label>
                    <div class="col-md-9">
                      <input required="" id="excel" class="file-upload-input" type="file" onchange="readURL(this);"  accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" name="excel" />
                      <small class="form-control-feedback">Archivos (csv, xlsx). </small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
              <div class="col-md-6" style="display: none;" id="contTienda">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Selecciona una tienda:</label>
                    <div class="col-md-9">
                      <select  class="form-control custom-select" name="tienda" required="" id="tienda">
                          <option disabled value="" selected>Selecciona Una tienda</option>
                          @foreach ($data as $consulta)
                              <option value="{{ $consulta->id }}">{{ $consulta->slug }}</option>
                          @endforeach                 
                      </select>
                      <small class="form-control-feedback">Selecciona una tienda. </small>
                    </div>
                  </div>
                </div>
                <div class="col-md-6" style="display: none;" id="contBodega">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Selecciona una bodega:</label>
                    <div class="col-md-9">
                      <select  class="form-control custom-select" name="bodega" id="bodega">
                          <option disabled value="" selected>Selecciona Una Opcion</option>
                          @foreach ($data as $consulta)
                              <option value="{{ $consulta->id }}">{{ $consulta->slug }}</option>
                          @endforeach                 
                      </select>
                      <small class="form-control-feedback">Selecciona una bodega. </small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-right">
                <button type="submit" id="submit-compras" class="btn btn-success" onclick="return confirm('¿Esta seguro de cargar el archivo?')">Cargar archivo</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
  @endsection
  @section('codigo')
  <script type="text/javascript">

  function readURL(input) {
  if (input.files && input.files[0]) {
    if(input.files[0].type == "application/vnd.ms-excel" || input.files[0].type == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){

  }else{
    input.files[0] = '';
    alert("Solo son permitidos archivos de extension: .csv, .xlsx");
    $("#excel").val("");
  }

}
}

$("#file-compras").submit(function(){
    $("#submit-compras").attr('disabled', true);
    $("#submit-compras").html("<i class='fa fa-refresh fa-spin'></i> Cargando archivo...")
});
</script>
  @endsection
