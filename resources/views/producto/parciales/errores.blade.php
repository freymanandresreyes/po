@if (Session::has('errores'))
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">
      &times;
    </button>
    {{Session::get('errores')}}
  </div>
@endif
