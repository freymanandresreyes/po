@extends('layout')
@section('contenido')


{{-- AQUI INICI LA PARTE DE EDITAR EL IVA DE UNA TIENDA --}}
<br>
  <div class="row">
    <div class="col-lg-12">
      <div class="card ">
        <div class="card-header bg-info">
          <h4 class="m-b-0 text-white">EDITAR IVA DE UNA TIENDA</h4>
        </div>
        <div class="card-body">
          <form action="#" class="form-horizontal">
            <div class="form-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Tienda:</label>
                    <div class="col-md-9">
                      <input type="text" id="tiendas_iva" disabled class="form-control" value="{{ $consulta_tienda->slug }}"  name="{{ $consulta_tienda->id }}">
                      <small class="form-control-feedback"> Tienda En La Cual Me Encuentro. </small>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Iva %:</label>
                    <div class="col-md-9">
                      <input type="text" id="iva" value=" @if($consulta_iva){{ $consulta_iva->iva }}@else 0 @endif "  class="form-control">
                      <small class="form-control-feedback"> Iva De La Actual Tienda. </small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-right">
                <button type="button" class="btn btn-success" id="actualizar_iva">Actualizar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


{{-- AQUI INICIA LA PARTE DE PANEL DE PREFIJO--}}
  <div class="row">
    <div class="col-lg-12">
      <div class="card ">
        <div class="card-header bg-info">
          <h4 class="m-b-0 text-white">PANEL DE PREFIJOS</h4>
        </div>
        <div class="card-body">
          <form action="#" class="form-horizontal">
            <div class="form-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Crear Prefijo:</label>
                    <div class="col-md-7">
                      <input type="text" id="tag_nuevo" class="form-control" placeholder="Tag"  >
                      <small class="form-control-feedback"> Crear Un Nuevo Prefijo Para Las Facturas. </small>
                    </div>
                    <div class="text-right">
                      <button type="button" class="btn btn-success" id="crear_tag">Crear</button>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Editar Prefijo:</label>
                    <div class="col-md-9">
                      <select  class="form-control custom-select" id="tags_tienda">
                        @if($list_tag==0)
                          <option value="0" selected>No Hay Prefijos Para Esta Tienda</option>                    
                        @elseif($list_tag!=0)
                        <option value="0" selected>Selecciona Una Opción</option>
                        @for($i = 0 ; $i < (count($list_tag)); $i++)
                        <option value="{{ $list_tag[$i]->nuevo_tag }}">{{ $list_tag[$i]->nuevo_tag }}</option>
                        @endfor
                        @endif
                      </select>
                      <small class="form-control-feedback"> Prefijo De Las Facturas. </small>
                    </div>
                  </div>
                </div>
              </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

{{-- AQUI INICIA LA PARTE DE INICIALIZAR UN CONSECUTIVO --}}

  <div class="row">
      <div class="col-lg-12">
        <div class="card ">
          <div class="card-header bg-info">
            <h4 class="m-b-0 text-white">INICIALIZAR TAG</h4>
          </div>
          <div class="card-body">
            <form action="#" class="form-horizontal">
              <div class="form-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="control-label text-right col-md-3">Tienda:</label>
                      <div class="col-md-9">
                          <select  class="form-control custom-select" id="tag_selecionado">
                              @if($list_tag==0)
                                <option value="0" selected>No Hay Tags Para Esta Tienda</option>                    
                              @elseif($list_tag!=0)
                              <option value="0" selected>Selecciona Una Opción</option>
                              @for($i = 0 ; $i < (count($list_tag)); $i++)
                              <option value="{{ $list_tag[$i]->nuevo_tag }}">{{ $list_tag[$i]->nuevo_tag }}</option>
                              @endfor
                              @endif
                            </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6" id="input_consecutivo">
                    
                  </div>
                </div>
                <div class="text-right">
                    <button type="button" disabled class="btn btn-success" id="inicializar">inicializar</button>
                    <button type="button" disabled class="btn btn-success" id="enviar_consecutivo">enviar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>














{{-- MODAL DE EDITAR UN TAG --}}
          <div class="row">
           <!-- sample modal content -->
            <div id="modal_tag" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-body">
                    <form>
                      <div class="form-group" id="editar_tag">
      
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" id="cerrar_tag">Cerrar</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" id="editar_tag_selecionado">Editar Tag</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
    @endsection
