<div class="form-group row">
    <label class="control-label text-right col-md-3">Tienda Asignada:</label>
    <div class="col-md-9">
      <input type="text" id="tienda_quitar" disabled class="form-control" value="{{ $user_tienda->slug }}"  name="{{ $user_tienda->id }}">
      <small class="form-control-feedback"> Slug De La Tienda. </small> 
    </div>
  </div>