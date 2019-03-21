<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar menu_ocultar">
  <!-- Sidebar scroll-->
  <div class="scroll-sidebar">
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
      <ul id="sidebarnav">



        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-tags "></i><span class="hide-menu">Caja</span></a>
          <ul aria-expanded="true" class="collapse">
            <li><a href="{{ route('caja_registradora') }}">Abrir caja</a></li>
            <li><a href="{{ route('ver_facturas') }}">Ver facturas</a></li>
            <li><a href="{{ route('caja_menor') }}">Caja Menor</a>
              <li><a href="{{ route('ver_entradas') }}">Entradas Caja Menor</a></li>
              <li><a href="{{ route('ver_salidas') }}">Salidas Caja Menor</a></li>
              <li><a href="{{ route('nuevo_separado') }}">Apartados</a></li>
              <li><a href="{{ route('ver_separados') }}">Ver Apartados</a></li>
              <li><a href="{{ route('consultar_facturas_sistecredito') }}">Abono Facturas Sistecredito</a></li>
            </li>
          </ul>
        </li>

        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-reload "></i><span class="hide-menu">Devoluciones</span></a>
          <ul aria-expanded="true" class="collapse">
            {{-- @can('vista_cajero') --}}
            <li><a href="{{ route('crear_devoluciones') }}">Crear</a></li>
            <li><a href="{{ route('entregar_devolucion') }}">Entregar</a></li>
            {{-- @endcan --}}
            {{-- @can('')
            @endcan --}}
            <li><a href="{{ route('ver_devolucion') }}">Admin Devoluciones</a></li>

          </ul>
        </li>

        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class=" ti-package"></i><span class="hide-menu">Productos</span></a>
          <ul aria-expanded="true" class="collapse">
            {{-- @can('') --}}
            <li><a href="{{ route('crear_productos') }}">Crear productos</a></li>
            <li><a href="{{ route('compras') }}">Compras</a></li>
            <li><a href="{{ route('listarcompras') }}">Aceptar Compras</a></li>
            <li><a href="{{ route('ver_productos') }}">Admin promociones</a></li>
            <li><a href="{{ route('carga_masiva_compras') }}">Carga Masiva Compras</a></li>
            <li><a href="{{ route('carga_masiva_productos') }}">Carga Masiva Productos</a></li>
            <li><a href="{{ route('ver_inventario') }}">Inventario</a></li>
            {{-- @else --}}
              {{-- @can('vista_cajero') --}}
              <li><a href="{{ route('listarcompras') }}">Aceptar Compras</a></li>
              <li><a href="{{ route('ver_inventario') }}">Inventario</a></li>
              {{-- @endcan --}}
            {{-- @endcan --}}
          </ul>
        </li>

        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-truck"></i><span class="hide-menu">Traslados</span></a>
          <ul aria-expanded="true" class="collapse">
            <li><a href="{{route('crear_remisiones')}}">Crear Traslado </a></li>
            <li><a href="{{route('aceptar_remision')}}">Aceptar Traslado </a></li>
            <li><a href="{{ route('ver_remision') }}">Ver Traslados </a></li>
            <li><a href="{{route('vista_remision')}}">ver remisiones </a></li>
          </ul>
        </li>

        {{-- @can('super_admin') --}}
{{-- @can('') --}}
        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-bag"></i><span class="hide-menu">Tiendas</span></a>
          <ul aria-expanded="true" class="collapse">
            <li><a href="{{route('crear_tienda')}}">Tiendas</a></li>
            <li><a href="{{ route('control_cajas') }}">Control Cajas</a></li>
            <li><a href="{{ route('control_tiendas') }}">Control Tiendas</a></li>
          </ul>
        </li>
        {{-- @endcan --}}
        {{-- @can('') --}}
        {{-- @can('') --}}
        <li>
          <a href="{{ route('registrar_bono') }}" class="collapse" href="javascript:void(0)" aria-expanded="true">
            <i class="ti-gift"></i>
            <span class="hide-menu">Registrar Bonos</span>
          </a>
        </li>
        {{-- @endcan --}}
        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-chart"></i><span class="hide-menu">Informes</span></a>
          <ul aria-expanded="true" class="collapse">
            {{-- @can('ver_informes_general')  --}}
            <li><a href="{{ route('info_diario') }}">Inf. Diario</a></li>
            <li><a href="{{ route('info_ventas') }}">inf. ventas</a></li>
            <li><a href="{{ route('info_compras') }}">inf. Compras</a></li>
            <li><a href="{{ route('info_devoluciones') }}">Inf. Devoluciones</a></li>
            <li><a href="{{ route('utilidad_factura') }}">Margen utilidad x factura</a></li>
            <li><a href="{{ route('ver_varios') }}">Varios</a></li>
            <li><a href="{{ route('vista_informe_mayordetal') }}">Inf. Mayor/Detal</a></li>
            <li><a href="{{ route('facturas_informe') }}">Consulta Facturas.</a></li>
            <li><a href="{{ route('productos_informe') }}">Consulta Productos.</a></li>
            <li><a href="{{ route('bless_informe') }}">Inf. Bless.</a></li>
            <li><a href="{{ route('informe_sistecredito') }}">Informe abonos sistecredito</a></li>
            <li><a href="{{ route('informe_inventario') }}">Informe inventario</a></li>
            <li><a href="{{ route('vista_informe_referencias') }}">Informe referencias</a></li>
            <li><a href="{{ route('vista_informe_elkin') }}">Informe Don Elkin</a></li>
            <li><a href="{{ route('vista_informe_elkin_devoluciones') }}">Informe Don Elkin</a></li>
            {{-- @else --}}
            {{-- @can('vista_cajero')  --}}
            {{-- <li><a href="{{ route('info_diario') }}">Inf. Diario</a></li> --}}
            {{-- @endcan --}}
            {{-- @endcan --}}
          </ul>
        </li>
        {{-- @role('admin_tiendas') --}}
        <li>
          <a href="{{ route('configuraciones') }}" class="collapse " href="javascript:void(0)" aria-expanded="true">
                      <i class="mdi mdi-wrench"></i>
                      <span class="hide-menu">Configuraciones</span>
                    </a>
        </li>
        {{-- @endrole --}}
        {{-- PANEL DE CONFIGURACION DE VENDEDORES --}}
        @role('admin_tiendas')
        <li>
          <a href="{{ route('vista_vendedores') }}" class="collapse " href="javascript:void(0)" aria-expanded="true">
              <i class="mdi mdi-account-switch"></i>
              <span class="hide-menu">Vendedores</span>
          </a>
        </li>
        @endrole

        @can('')
        {{-- PANEL DE ACTUALIZACION MASIBA TABLA PRODUCTOS --}}
        <li>
          <a href="{{ route('vista_actulizacion_masiva') }}" class="collapse " href="javascript:void(0)" aria-expanded="true">
              <i class="mdi mdi-hexagon-multiple"></i>
              <span class="hide-menu">Act. Masiva</span>
          </a>
        </li>
        @endcan

        {{-- @role('super_admin') --}}
        <!-- Menú de administracion de usuarios roles y permisos -->
        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-id-badge "></i><span class="hide-menu">Roles y permisos</span></a>
          <ul aria-expanded="true" class="collapse">
            <li><a href="{{ url('listado_usuarios')}}">Listado Usuarios</a></li>
          </ul>
        </li>
        {{-- @endrole --}}

      
        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-pie-chart"></i><span class="hide-menu">Estadísticas</span></a>
          <ul aria-expanded="true" class="collapse">
            <li><a href="{{ route('inicio_tickets') }}">Inf. tickets</a></li>
          </ul>
        </li>
        <li>
          <a href="{{ route('vista_auditorias') }}" class="collapse " href="javascript:void(0)" aria-expanded="true">
              <i class="mdi mdi-wrench"></i>
              <span class="hide-menu">Auditorias</span>
          </a>
        </li>
        <li>
          <a href="{{ route('clientes') }}" class="collapse " href="javascript:void(0)" aria-expanded="true">
              <i class="mdi mdi-wrench"></i>
              <span class="hide-menu">CLientes</span>
          </a>
        </li>
        <!-- //MODULO DICIEMBRE ENERO -->
        <li>
          <a href="{{ route('decoluciones2018') }}" class="collapse " href="javascript:void(0)" aria-expanded="true">
              <i class="mdi mdi-calendar-check"></i>
              <span class="hide-menu">Devoluciones 2018</span>
          </a>
        </li>
        <!-- // FIN DEL MODULO DICIEMBRE ENERO -->
        {{-- @can('') --}}
        <li>
          <a href="{{ route('inventario_bodega') }}" class="collapse " href="javascript:void(0)" aria-expanded="true">
              <i class="mdi mdi-wrench"></i>
              <span class="hide-menu">Inventario Bodega</span>
          </a>
        </li>
        {{-- @endcan --}}
        <!-- Fin menu -->
        <li>
          <a href="{{ route('prueba2')}}" class="collapse " href="javascript:void(0)" aria-expanded="true">
              <i class="mdi mdi-wrench"></i>
              <span class="hide-menu">PRUEBA</span>
          </a>
        </li>
        <li>
          <a href="{{ route('index2')}}" class="collapse " href="javascript:void(0)" aria-expanded="true">
              <i class="mdi mdi-wrench"></i>
              <span class="hide-menu">Descuentos / Total</span>
          </a>
        </li>
      </ul>
    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->