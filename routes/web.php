<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Registration Routes...
 //rutas en caso de perdida del usuario administrador
// $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// $this->post('register', 'Auth\RegisterController@register');
// Route::post('crear_usuario', 'UsuariosController@crear_usuario');//descomentar en caso de perdida de usuario

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
  // Route::get('/', function () {
  //     return view('caja.registradora');
  // });

 Route::get('/', function () {
     return view('layout');
  });




//   Route::get('/', function () {
//     $consulta = App\configuraciones::find(1);
//     $json = $consulta->lista_tag;
//     dd(json_decode($json, true));
//  })



  Route::get('/home', 'HomeController@index');
  Route::get('/listado_usuarios', 'UsuariosController@listado_usuarios');//->middleware('permissionshinobi:listar_usuarios');
  Route::post('crear_usuario', 'UsuariosController@crear_usuario');//->middleware('permissionshinobi:crear_usuario');
  Route::post('editar_usuario', 'UsuariosController@editar_usuario');//->middleware('permissionshinobi:editar_usuario');
  Route::post('buscar_usuario', 'UsuariosController@buscar_usuario');//->middleware('permissionshinobi:buscar_usuario');
  Route::post('borrar_usuario', 'UsuariosController@borrar_usuario');//->middleware('permissionshinobi:borrar_usuario');
  Route::post('editar_acceso', 'UsuariosController@editar_acceso');//->middleware('permissionshinobi:editar_acceso');


  Route::post('crear_rol', 'UsuariosController@crear_rol');//->middleware('permissionshinobi:crear_rol');
  Route::post('crear_permiso', 'UsuariosController@crear_permiso');//->middleware('permissionshinobi:crear_permiso');
  Route::post('asignar_permiso', 'UsuariosController@asignar_permiso');//->middleware('permissionshinobi:asignar_permiso');
  Route::get('quitar_permiso/{idrol}/{idper}', 'UsuariosController@quitar_permiso');//->middleware('permissionshinobi:quitar_permiso');


  Route::get('form_nuevo_usuario', 'UsuariosController@form_nuevo_usuario');//->middleware('permissionshinobi:form_nuevo_usuario');
  Route::get('form_nuevo_rol', 'UsuariosController@form_nuevo_rol');//->middleware('permissionshinobi:form_nuevo_rol');
  Route::get('form_nuevo_permiso', 'UsuariosController@form_nuevo_permiso');//->middleware('permissionshinobi:form_nuevo_permiso');
  Route::get('form_editar_usuario/{id}', 'UsuariosController@form_editar_usuario');//->middleware('permissionshinobi:form_editar_usuario');
  Route::get('confirmacion_borrado_usuario/{idusuario}', 'UsuariosController@confirmacion_borrado_usuario');//->middleware('permissionshinobi:confirmacion_borrado_usuario');
  Route::get('asignar_rol/{idusu}/{idrol}', 'UsuariosController@asignar_rol');//->middleware('permissionshinobi:asignar_rol');
  Route::get('quitar_rol/{idusu}/{idrol}', 'UsuariosController@quitar_rol');//->middleware('permissionshinobi:quitar_rol');
  Route::get('form_borrado_usuario/{idusu}', 'UsuariosController@form_borrado_usuario');//->middleware('permissionshinobi:form_borrado_usuario');
  Route::get('borrar_rol/{idrol}', 'UsuariosController@borrar_rol');//->middleware('permissionshinobi:borrar_rol');

  // Registration Routes...
  $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
  $this->post('register', 'Auth\RegisterController@register');

  // Password Reset Routes...
  $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');//->middleware('roleshinobi:administrador');
  $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');//->middleware('roleshinobi:administrador');
  $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');//->middleware('roleshinobi:administrador');
  $this->post('password/reset', 'Auth\ResetPasswordController@reset');//->middleware('roleshinobi:administrador');
  /* ======================================================================*/
  /* ======================= NUEVAS RUTAS =================================*/
  /* ======================================================================*/
     /*==================================================*/
    /* RUTAS PARA EL CONTROLADOR ClientesController
    /* =================================================*/
    Route::get('clienteConsultar', 'ClientesController@clienteConsultar');
    Route::get('crearcliente', 'ClientesController@crearcliente');
    Route::post('crear_cliente', 'ClientesController@crear_cliente');
    Route::post('consulta_cliente', 'ClientesController@consulta_cliente');
    /*==================================================*/
    /* RUTAS PARA EL CONTROLADOR CREAR ProductosController
    /* =================================================*/
    Route::get('consulta_producto',"ProductosController@consultarProducto");//usa la vista caja para buscar productos en la tabla
    //ruta para consultar categorias y sub categorias
    Route::get('buscar_categorias',"ProductosController@buscar_categorias");//BUSCA SUBCATEGORIAS
    Route::get('consulta_categoria', 'ProductosController@consulta_categoria');
    Route::get('consulta_subcategoria_modal', 'ProductosController@consulta_subcategoria_modal');
    Route::get('guardar_modal_producto', 'ProductosController@guardar_modal_producto');



    
    Route::get('crear_productos',"ProductosController@crear_productos")->name('crear_productos');//solo lleva ala vista de crear productos
    Route::get('nuevo_producto',"ProductosController@nuevo_producto");
    Route::post('pepito', "ProductosController@pepito")->name('pepito');
    Route::get('ver_productos','ProductosController@visualizar')->name('ver_productos');
    Route::get('buscar_producto','ProductosController@buscar_producto');
    Route::get('actualizar_oferta','ProductosController@actualizar_oferta');

    Route::get('tienda_zona_crear','ProductosController@tienda_zona_crear');


    /*==================================================*/
    /* RUTAS PARA EL CONTROLADOR CREAR FacturasController
    /* =================================================*/
    Route::get('caja_registradora', 'FacturasController@caja_registradora')->name('caja_registradora');
    Route::post('crear_facturas', 'FacturasController@crear_facturas');
    Route::get('generar_factura', 'FacturasController@generar_factura');
    Route::get('ver_facturas', "FacturasController@ver_facturas")->name('ver_facturas');
    Route::get('factura_show', 'FacturasController@factura_show');
    Route::get('devoluciones', 'FacturasController@devoluciones_ver')->name('devoluciones_ver');
    Route::get('buscar_factura','FacturasController@buscar_factura');
    Route::get('anular_factura','FacturasController@anular_factura');
    Route::post('buscar_factura_mayorista','FacturasController@buscar_factura_mayorista');//new

    /*==================================================*/
    /* RUTAS PARA LAS DEVOLUCIONES ECHO POR FREYMAN
    /* =================================================*/
    Route::get('entregar_devolucion', 'DevolucionesController@entregar_devolucion')->name('entregar_devolucion');
    Route::get('cambio','DevolucionesController@cambio')->name('cambio');



    /*==================================================*/
    /* RUTAS PARA EL CONTROLADOR CREAR TiendasController
    /* =================================================*/
    Route::get('crear_tienda', ['as'=>'crear_tienda', 'uses'=>'TiendasController@crear_tienda'] );
    Route::get('nueva_tienda', ['as'=>'nueva_tienda.crear', 'uses'=>'TiendasController@nueva_tienda'] );
    Route::get('tienda_editar','TiendasController@tienda_editar');
    Route::get('buscar_tienda','TiendasController@buscar_tienda');
    Route::post('buscar_tienda_zona','TiendasController@buscar_tienda_zona');
    /*==================================================*/
    // RUTA PARA CAMBIAR DE Tienda
    /*==================================================*/
    Route::get('cambiar_tienda',['as'=>'cambiar_tienda', 'uses'=>'TiendasController@cambiar_tienda'] );
    Route::post('cambiotienda', ['as'=>'cambiotienda','uses'=>'TiendasController@cambiotienda']);


    /*==================================================*/
    /* RUTAS PARA EL CONTROLADOR CREAR CategoriasController
    /* =================================================*/
    Route::get('nueva_categoria','CategoriasController@nueva_categoria');
    Route::get('nueva_categoria_compras','CategoriasController@nueva_categoria_compras');
    /*==================================================*/
    /* RUTAS PARA EL CONTROLADOR CREAR SubcategoriasController
    /* =================================================*/
    Route::get('nueva_subcategoria','SubcategoriasController@nueva_subcategoria');
    Route::get('nueva_subcategoria_compras','SubcategoriasController@nueva_subcategoria_compras');

    /*==================================================*/
    // RUTAS PARA LA CAJA MENOR 
    /*==================================================*/
    Route::get('caja_menor',['as'=>'caja_menor', 'uses'=>'CajamenorController@caja_menor'])->middleware('permissionshinobi:caja_menor');
    Route::get('inser_caja_menor', ['as'=>'inser_caja_menor', 'uses'=>'CajamenorController@inser_caja_menor'])->middleware('permissionshinobi:inser_caja_menor');
    Route::get('ver_entradas',['as'=>'ver_entradas','uses'=>'CajamenorController@ver_entradas'])->middleware('permissionshinobi:ver_entradas');
    Route::get('ver_salidas',['as'=>'ver_salidas','uses'=>'CajamenorController@ver_salidas'])->middleware('permissionshinobi:ver_salidas');

     /*==================================================*/
    // RUTAS PARA DEVOLUCIONES
    /*==================================================*/
    Route::get('crear_devoluciones', 'DevolucionesController@crear_devoluciones')->name('crear_devoluciones');
    Route::get('guardar_devolucion', 'DevolucionesController@guardar_devolucion');
    Route::get('ver_devolucion', 'DevolucionesController@ver_devolucion')->name('ver_devolucion');
    Route::get('editar_devolucion', 'DevolucionesController@editar_devolucion');
    Route::get('editar_devolucion_guardar', 'DevolucionesController@editar_devolucion_guardar');

    /*==================================================*/
    // RUTAS PARA EL CONTROL DE CAJAS
    /*==================================================*/
    Route::get('control_cajas', ['as'=>'control_cajas', 'uses'=>'ControlcajasController@control_cajas']);
    Route::get('buscarcajas',['as'=>'buscarcajas', 'uses'=>'ControlcajasController@buscarcajas']);
    Route::get('buscarcajarelacionada',['as'=>'buscarcajarelacionada', 'uses'=>'ControlcajasController@buscarcajarelacionada']);
    Route::get('nuevacaja',['as'=>'nuevacaja', 'uses'=>'ControlcajasController@nuevacaja']);
    Route::get('asignar_caja_usuario',['as'=>'asignar_caja_usuario','uses'=>'ControlcajasController@asignar_caja_usuario']);
    Route::get('quitarcaja',['as'=>'quitarcaja', 'uses'=>'ControlcajasController@quitarcaja']);
    Route::get('eliminar_caja',['as'=>'eliminar_caja','uses'=>'ControlcajasController@eliminar_caja']);
    Route::get('buscar_tiendas_activar',['as'=>'buscar_tiendas_activar','uses'=>'ControlcajasController@buscar_tiendas_activar']);
    Route::get('activar_desactivar_caja',['as'=>'activar_desactivar_caja','uses'=>'ControlcajasController@activar_desactivar_caja']);

    /*==================================================*/
    // RUTAS PARA EL CONTROL DE TIENDAS
    /*==================================================*/
    Route::get('control_tiendas',['as'=>'control_tiendas','uses'=>'TiendasController@control_tiendas']);
    Route::get('asignar_tienda',['as'=>'asignar_tienda','uses'=>'TiendasController@asignar_tienda']);
    Route::get('cargar_tienda_id',['as'=>'cargar_tienda_id','uses'=>'TiendasController@cargar_tienda_id']);
    Route::get('quitar',['as'=>'quitar','uses'=>'TiendasController@quitar']);

    /*==================================================*/
    // RUTAS PARA LAS CONFIGURACIONES DEL POST
    /*==================================================*/
    Route::get('configuraciones',['as'=>'configuraciones','uses'=>'ConfiguracionesController@configuraciones']);//->middleware('permissionshinobi:configuraciones');
    Route::get('buscar_iva',['as'=>'buscar_iva','uses'=>'ConfiguracionesController@buscar_iva']);
    Route::get('crear_tag',['as'=>'crear_tag','uses'=>'ConfiguracionesController@crear_tag']);
    Route::get('mostrar_tag',['as'=>'mostrar_tag','uses'=>'ConfiguracionesController@mostrar_tag']);
    Route::get('editar_tag',['as'=>'editar_tag','uses'=>'ConfiguracionesController@editar_tag']);
    Route::get('traerconsecutivo',['as'=>'traerconsecutivo','uses'=>'ConfiguracionesController@traerconsecutivo']);
    Route::get('iniciarconsecutivo',['as'=>'iniciarconsecutivo','uses'=>'ConfiguracionesController@iniciarconsecutivo']);
    Route::get('editar_consecutivo',['as'=>'editar_consecutivo','uses'=>'ConfiguracionesController@editar_consecutivo']);

    /*==================================================*/
    // RUTAS PARA LOS INFORMES DEL POST
    /*==================================================*/
    Route::get('informes',['as'=>'informes','uses'=>'InformesController@informes']);
    Route::get('info_ventas','InformesController@info_ventas')->name('info_ventas');//->middleware('permissionshinobi:info_ventas');
    Route::get('info_diario','InformesController@info_diario')->name('info_diario');//new
    Route::post('generar_informe','InformesController@generar_informe')->name('generar_informe');//new
    Route::get('generar_informe_diario','InformesController@generar_informe_diario');
    Route::get('generar_informe_diario_zonas','InformesController@generar_informe_diario_zonas');
    Route::get('tiendas_zonas','InformesController@tiendas_zonas');
    Route::get('informe_diario_imprimir','InformesController@informe_diario_imprimir');
    Route::get('informe_diario_imprimir_zona','InformesController@informe_diario_imprimir_zona');
    Route::get('info_compras','InformesController@info_compras')->name('info_compras');//->middleware('permissionshinobi:info_compras');
    Route::get('generar_informe_compras','InformesController@generar_informe_compras')->name('generar_informe_compras');
    Route::get('ver_factura_compra','InformesController@ver_factura_compra')->name('ver_factura_compra');
    Route::get('info_devoluciones','InformeDevolucionesController@info_devoluciones')->name('info_devoluciones');
    Route::get('cargar_tiendas_informe','InformeDevolucionesController@cargar_tiendas_informe')->name('cargar_tiendas_informe');
    Route::get('informe_devoluciones_generar','InformeDevolucionesController@informe_devoluciones_generar')->name('informe_devoluciones_generar');
    Route::get('informe_inventario','InformesController@informe_inventario')->name('informe_inventario');
    Route::get('informe_referencias','InformesController@vista_informe_referencias')->name('vista_informe_referencias');
    Route::post('informe_referencias','InformesController@informe_referencias');
    /*==================================================*/
    // RUTAS PARA SABER EN QUE TIENDA ESTOY
    /*==================================================*/
    Route::get('enquetiendaestoy', 'TiendasController@enquetiendaestoy')->name('enquetiendaestoy');


    /*==================================================*/
    // RUTAS PARA LOS BONOS
    /*==================================================*/
    Route::get('registrar_bono','BonosController@registrar_bono')->name('registrar_bono');
    Route::post('registra_bono','BonosController@registra_bono')->name('registra_bono');
    /*==================================================*/
    // RUTAS PARA REMISIONES
    /*==================================================*/
    Route::get('crear_remisiones', 'RemisionesController@crear_remisiones')->name('crear_remisiones');
    Route::get('buscar_productos', 'RemisionesController@buscar_productos')->name('buscar_productos');
    Route::get('vista_remision', 'RemisionesController@vista_remision')->name('vista_remision');
    Route::post('informe_remision', 'RemisionesController@informe_remision');


    /*==================================================*/
    // RUTAS PARA LOS PRODUCTOS FASE FREYMAN
    /*==================================================*/
    Route::get('buscar_c_p',['as'=>'buscar_c_p','uses'=>'ProductosController@buscar_c_p']);
    Route::get('select_categorias',['as'=>'select_categorias','uses'=>'ProductosController@select_categorias']);

    /*==================================================*/
    // RUTAS PARA LAS COMPRAS
    /*==================================================*/
    Route::get('compras',['as'=>'compras','uses'=>'ComprasController@compras']);
    Route::get('crear_proveedor',['as'=>'crear_proveedor','uses'=>'ComprasController@crear_proveedor']);
    Route::post('crear_compra',['as'=>'crear_compra','uses'=>'ComprasController@crear_compra']);
    Route::get('buscar_producto_compra',['as'=>'buscar_producto_compra','uses'=>'ComprasController@buscar_producto_compra']);

    /*==================================================*/
    // RUTAS PARA ACEPTAR COMPRAS
    /*==================================================*/
    Route::get('listarcompras',['as'=>'listarcompras','uses'=>'ProductosController@listarcompras']);
    Route::get('aceptarcompra',['as'=>'aceptarcompra','uses'=>'ProductosController@aceptarcompra']);

    /*==================================================*/
    // RUTAS PARA INVENTARIO
    /*==================================================*/
    Route::get('ver_inventario','ProductosController@ver_inventario')->name('ver_inventario');
    Route::get('ver_inventario_zona','ProductosController@ver_inventario_zona')->name('ver_inventario_zona');
    
    Route::get('inventario_buscar','ProductosController@inventario_buscar');
    Route::get('inventario_guardar','ProductosController@inventario_guardar');
    Route::get('inventario_buscar_subcategoria','ProductosController@inventario_buscar_subcategoria');

     /*==================================================*/
    // RUTAS PARA TICKETS
    /*==================================================*/

    Route::get('inicio_tickets', 'ticketController@inicio_tickets')->name('inicio_tickets');
    Route::get('ticket_buscar', 'ticketController@ticket_buscar')->name('ticket_buscar');
    Route::post('resumen_ticket', 'ticketController@resumen_ticket');

    /*==================================================*/
    // RUTAS PARA LISTADO DE BANCOS
    /*==================================================*/
    Route::get('buscar_banco','ListadobancosController@buscar_banco');

    
    /*==================================================*/
    // RUTAS PARA LISTADO APARTADOS
    /*==================================================*/

    Route::get('utilidad_factura','infoUtilidadFacturaController@utilidad_factura')->name('utilidad_factura');
    Route::post('utilidad_factura_consultar','infoUtilidadFacturaController@utilidad_factura_consultar')->name('utilidad_factura_consultar');
    //Nueva ruta para visualizar àpartado
    Route::post('visualizar_apartado', 'SeparadosController@visualizar_apartado');
    /*==================================================*/
    // RUTAS PARA LISTADO APARTADOS
    /*==================================================*/

    Route::get('nuevo_separado', 'SeparadosController@nuevo_separado')->name('nuevo_separado');
    Route::get('guardar_modal_apartado', 'SeparadosController@guardar_modal_apartado');
    Route::get('ver_separados', 'SeparadosController@ver_separados')->name('ver_separados');

    Route::post('buscar_apartado_caja','SeparadosController@buscar_apartado_caja');

    /*==================================================*/
    // RUTAS PARA LISTADO INFORMES VARIOS
    /*==================================================*/

    Route::get('ver_varios','VariosController@ver_varios')->name('ver_varios');
    Route::get('buscar_categoria_varios','VariosController@buscar_categoria_varios');
    Route::get('generar_informe_varios','VariosController@generar_informe_varios');

    /*==================================================*/
    // RUTAS PARA LAS DEVOLUCIONES FREYMAN FASE 2
    /*==================================================*/

    Route::get('datos_cliente', 'DevolucionesController@datos_cliente')->name('datos_cliente');

    /*==================================================*/
    // RUTAS PARA LAS REMISIONES FREYMAN FASE 2
    /*==================================================*/
    
    Route::post('guardar_remision_agregada', 'RemisionesController@guardar_remision_agregada')->name('guardar_remision_agregada');
    Route::get('aceptar_remision', 'RemisionesController@aceptar_remision')->name('aceptar_remision');
    Route::get('aceptar_remision_seleccionada', 'RemisionesController@aceptar_remision_seleccionada')->name('aceptar_remision_seleccionada');
    Route::get('rechazar_remision_seleccionada', 'RemisionesController@rechazar_remision_seleccionada')->name('rechazar_remision_seleccionada');
    Route::get('ver_remision', 'RemisionesController@ver_remision')->name('ver_remision');  
    //Ruta para visualizar el traslado
    Route::post('visualizar_traslado', 'RemisionesController@visualizar_traslado')->name('visualizar_traslado');  
    /*==================================================*/
    // RUTAS PARA EL INFORME DE VENTAS AL MAYOR Y DETAL ALMACENES STARA
    //                    INFORME UNO
    /*==================================================*/
    
    Route::get('vista_informe_mayordetal', 'InformeUnoController@vista_informe_mayordetal')->name('vista_informe_mayordetal');
    Route::get('generar_informeuno', 'InformeUnoController@generar_informeuno')->name('generar_informeuno');//NUEVA RUTA
    
    /*==================================================*/
    // RUTAS PARA SALDOS
    /*==================================================*/
    Route::post('buscar_saldo_devolucion','SaldosController@buscar_saldo_devolucion');

    /*==================================================*/
    // RUTAS PARA LOS VENDEDORES
    /*==================================================*/
    Route::get('vista_vendedores','VendedoresController@vista_vendedores')->name('vista_vendedores');
    Route::get('guardar_vendedor','VendedoresController@guardar_vendedor')->name('guardar_vendedor');
    Route::get('buscar_editar_vendedor', 'VendedoresController@buscar_editar_vendedor')->name('buscar_editar_vendedor');
    Route::get('guardar_editar_vendedor', 'VendedoresController@guardar_editar_vendedor')->name('guardar_editar_vendedor');
    Route::get('estado_vendedor', 'VendedoresController@estado_vendedor')->name('estado_vendedor');


    /*==================================================*/
    // RUTAS PARA LA ACTUALIZACIN MASIVA DE PRODUCTOS
    /*==================================================*/
    Route::get('vista_actulizacion_masiva', 'ProductosController@vista_actulizacion_masiva')->name('vista_actulizacion_masiva');
    Route::get('buscar_tiendas', 'ProductosController@buscar_tiendas')->name('buscar_tiendas');
    Route::get('cargar_tabla', 'ProductosController@cargar_tabla')->name('cargar_tabla');
    Route::get('buscar_columnas', 'ProductosController@buscar_columnas')->name('buscar_columnas');
    Route::get('cargar_categorias', 'ProductosController@cargar_categorias')->name('cargar_categorias');
    Route::get('cargar_subcategorias', 'ProductosController@cargar_subcategorias')->name('cargar_subcategorias');
    Route::get('actualizar_masivamente', 'ProductosController@actualizar_masivamente')->name('actualizar_masivamente');


    /*==================================================*/
    // RUTAS PARA INVENTARIO DE BODEGA
    /*==================================================*/
    Route::get('inventario_bodega','InventarioBodegaController@inventario_bodega')->name('inventario_bodega');
    Route::get('buscar_producto_bodega','InventarioBodegaController@buscar_producto_bodega')->name('buscar_producto_bodega');

    /*==================================================*/
    // RUTAS PARA CONTROL DE INVENTARIO
    /*==================================================*/

    Route::get('contol_index', 'ControlinventarioController@index')->name('contol_index');
    
    // RUTAS PARA INFORMES ALBERTO DE CONSULTA // FACTURAS // PRODUCTOS
    /*==================================================*/
    Route::get('facturas_informe','FacturasController@facturas_informe')->name('facturas_informe');
    Route::get('productos_informe','productosController@productos_informe')->name('productos_informe');
    Route::get('consulta_informa_facturas','FacturasController@consulta_informa_facturas')->name('consulta_informa_facturas');
    Route::get('consulta_informa_productos','ProductosController@consulta_informa_productos')->name('consulta_informa_productos');
    
    /*==================================================*/
    // RUTAS PARA INFORME PAGOS BLESS
    /*==================================================*/
    Route::get('bless_informe','infomeBlessController@index')->name('bless_informe');
    Route::post('bless_generar','infomeBlessController@generarInforme')->name('bless_generar');
    
    /*==================================================*/
    // RUTAS PARA sistecredito
    /*==================================================*/
    /********RUTAS PARA REGISTRAR Y CONSULTAR ABONOS A FACTURAS DE SISTECREDITO POR CLIENTE************/
    Route::get('consultar_facturas_sistecredito','SistecreditoController@consultar_facturas_sistecredito')->name('consultar_facturas_sistecredito');
    Route::post('buscar_facturas_sistecredito','SistecreditoController@buscar_facturas_sistecredito');
    Route::post('buscar_abonos_factura_sistecredito','SistecreditoController@buscar_abonos_factura_sistecredito');
    Route::post('abonar_factura_sistecredito','SistecreditoController@abonar_factura_sistecredito');
    /********RUTAS PARA GENERAR INFORME DE FACTURAS SISTECREDITO POR CLIENTE*******************/
    Route::get('informe_sistecredito', 'SistecreditoController@informe_sistecredito')->name('informe_sistecredito');
    Route::post('total_abonos_factura_sistecredito', 'SistecreditoController@total_abonos_factura_sistecredito');
    /*==================================================*/
    // RUTAS PARA CARGA MASIVA
    /*==================================================*/
    Route::get('carga_masiva_compras', 'CargaMasivaController@carga_masiva_compras')->name('carga_masiva_compras');
    Route::post('subir_carga_masiva_compras', 'CargaMasivaController@subir_carga_masiva_compras')->name('subir_carga_masiva_compras');
    Route::get('carga_masiva_productos', 'CargaMasivaController@carga_masiva_productos')->name('carga_masiva_productos');
    Route::post('subir_carga_masiva_productos', 'CargaMasivaController@subir_carga_masiva_productos')->name('subir_carga_masiva_productos');
    Route::post('subir_carga_masiva_productos_grupo_tienda', 'CargaMasivaController@subir_carga_masiva_productos_grupo_tienda')->name('subir_carga_masiva_productos_grupo_tienda');
    /*==================================================*/
    // RUTAS PARA INFORME DON ELKIN
    /*==================================================*/
    Route::get('vista_informe_elkin', 'InformeElkinController@vista_informe_elkin')->name('vista_informe_elkin');
    Route::get('generar_informe_elkin', 'InformeElkinController@generar_informe_elkin')->name('generar_informe_elkin');
    
    /*==================================================*/
    // RUTAS PARA VISTA AUDITORIAS
    /*==================================================*/
    Route::get('vista_auditorias', 'AuditoriasController@vista_auditorias')->name('vista_auditorias');
    Route::get('buscar_facturas_auditorias', 'AuditoriasController@buscar_facturas_auditorias')->name('buscar_facturas_auditorias');
    
    
    /*==================================================*/
    // RUTAS PARA los bonos en caja
    /*==================================================*/
    Route::get('descuento_bono_cliente', 'BonosController@descuento_bono_cliente')->name('descuento_bono_cliente');
    
    
    
    /*==================================================*/
    // RUTAS PARA INFORME ELKIN DEVOLUCIOINES
    /*==================================================*/
    Route::get('vista_informe_elkin_devoluciones', 'InformeElkinDevolucionesController@vista_informe_elkin_devoluciones')->name('vista_informe_elkin_devoluciones');
    Route::get('generar_informe_elkin_devoluciones', 'InformeElkinDevolucionesController@generar_informe_elkin_devoluciones')->name('generar_informe_elkin_devoluciones');


    /*==================================================*/
    // RUTAS PARA CLIENTES
    /*==================================================*/
    Route::get('clientes', 'ClientesController@clientes')->name('clientes');

  });
