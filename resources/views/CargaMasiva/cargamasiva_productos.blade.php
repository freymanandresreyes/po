@extends('layout')
@section('contenido')
<br>
  <div class="row">
    <div class="col-lg-12">
      <div class="card ">
        <div class="card-header bg-info">
          <h4 class="m-b-0 text-white">CARGA MASIVA DE PRODUCTOS POR TIENDA</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('subir_carga_masiva_productos') }}" class="form-horizontal" id="file-productos" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Tiendas:</label>
                    <div class="col-md-9">
                      <select  class="form-control custom-select" name="tienda" required="">
                          <option disabled value="" selected>Selecciona Una Opcion</option>
                          @foreach ( $consulta as $consulta)
                              <option value="{{ $consulta->id }}">{{ $consulta->slug }}</option>
                          @endforeach                 
                      </select>
                      <small class="form-control-feedback">Todas las Tiendas. </small>
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
              <div class="text-right">
                <button type="submit" id="submit-productos" class="btn btn-success" onclick="return confirm('¿Esta seguro de cargar el archivo?')">Cargar archivo</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<div class="row">
<div class="col-lg-12">
  <div class="card ">
    <div class="card-header bg-info">
      <h4 class="m-b-0 text-white">CARGA MASIVA DE PRODUCTOS POR GRUPO DE TIENDAS</h4>
    </div>
    <div class="card-body">
      <form action="{{ route('subir_carga_masiva_productos_grupo_tienda') }}" class="form-horizontal" id="file-productos-grupo" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="control-label text-right col-md-3">Grupos:</label>
                <div class="col-md-9">
                  <select  class="form-control custom-select" name="grupo" required="">
                      <option disabled value="" selected>Selecciona Una Opcion</option>
                      @foreach ( $grupos as $grupo)
                          <option value="{{ $grupo->id }}">{{ $grupo->nombre_grupo }}</option>
                      @endforeach                 
                  </select>
                  <small class="form-control-feedback">Todos las grupos. </small>
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
          <div class="text-right">
            <button type="submit" id="submit-productos-grupo" class="btn btn-success" onclick="return confirm('¿Esta seguro de cargar el archivo?')">Cargar archivo</button>
          </div>
        </div>
      </form>
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

$("#file-productos").submit(function(){
    $("#submit-productos").attr('disabled', true);
    $("#submit-productos").html("<i class='fa fa-refresh fa-spin'></i> Cargando archivo...")
});
$("#file-productos-grupo").submit(function(){
    $("#submit-productos-grupo").attr('disabled', true);
    $("#submit-productos-grupo").html("<i class='fa fa-refresh fa-spin'></i> Cargando archivo...")
});
</script>
  @endsection
