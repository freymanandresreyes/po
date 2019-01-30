let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.scripts([
    'resources/assets/js/global/funciones_globales.js',
    'resources/assets/js/caja_registradora/clientes.js',
    'resources/assets/js/caja_registradora/funcion_formatear_numeros.js',
    'resources/assets/js/caja_registradora/funcion_calcular_precios.js',
    'resources/assets/js/caja_registradora/funcion_calcular_saldo.js',
    'resources/assets/js/caja_registradora/codigo_producto.js',
    'resources/assets/js/caja_registradora/vender_producto.js',
    'resources/assets/js/caja_registradora/tipo_pago.js',
    'resources/assets/js/caja_registradora/codigo_pagos.js',
    'resources/assets/js/caja_registradora/tarjeta_tarjeta.js',
    'resources/assets/js/caja_registradora/calculo_saldos_tarjeta_tarjeta.js',
    'resources/assets/js/caja_registradora/calcular_saldo_tarjeta_efectivo.js',
    'resources/assets/js/caja_registradora/calcular_saldo_tarjeta.js',
    'resources/assets/js/caja_registradora/calcular_saldo_efectivo.js',
    'resources/assets/js/caja_registradora/buscar_factura_mayorista.js',
    'resources/assets/js/caja_registradora/tag_facturas.js',
    'resources/assets/js/caja_registradora/cambio_mayorista.js',//nueva
    'resources/assets/js/caja_registradora/select_pagos.js',//nueva
    'resources/assets/js/caja_registradora/calcular_saldo_tarjeta.js',//nueva
    'resources/assets/js/caja_registradora/caja_agregar_producto.js',//nueva
    'resources/assets/js/caja_registradora/porsentaje_caja_descuento.js',//nueva
    'resources/assets/js/caja_registradora/eliminar_producto_compra.js',//nueva
    'resources/assets/js/graficas/grafica_ventas.js',
    'resources/assets/js/remisiones/crear_remision.js',
    'resources/assets/js/productos/producto.js',
    'resources/assets/js/productos/buscar_producto.js',
    'resources/assets/js/informes/informe_general.js',
    'resources/assets/js/informes/ver_factura_compras.js',
    'resources/assets/js/informes/informe_diario.js',
    'resources/assets/js/informes/informe_buscar_compra.js',
    'resources/assets/js/informes/informe_diario_zonas.js',
    'resources/assets/js/informes/informe_utilidad_factura.js',
    'resources/assets/js/informes/informes_varios.js',
    'resources/assets/js/informes/informes_varios_buscar.js',
    'resources/assets/js/compras/crear_proveedor.js',
    'resources/assets/js/compras/crear_compra.js',
    'resources/assets/js/compras/buscar_producto_compra.js',
    'resources/assets/js/compras/agregar_producto.js',
    'resources/assets/js/compras/modal_compras_producto.js',
    'resources/assets/js/compras/modal_compras_categoria.js',
    'resources/assets/js/compras/guardar_modal_producto.js',
    'resources/assets/js/compras/codigo_categoria_subcategoria.js',
    'resources/assets/js/compras/acction_compras.js',
    'resources/assets/js/compras/calculo_detal_mayorista.js',
    'resources/assets/js/facturas/anular_facturas.js',
    'resources/assets/js/facturas/ver_facturas.js',
    'resources/assets/js/recepcion/recepcion.js',
    'resources/assets/js/inventario/ver_inventario_zonas.js',
    
    "resources/assets/js/devoluciones/buscar_factura_devoluciones.js",
    "resources/assets/js/devoluciones/entregar.js",

    "resources/assets/js/info_tickets/tickets_promedio.js",

    "resources/assets/js/apartados/buscar_producto_apartado.js",
    "resources/assets/js/apartados/crear_apartado.js",
    "resources/assets/js/apartados/apartado_tipo_pago.js",
    "resources/assets/js/apartados/agregar_apartado.js",
    "resources/assets/js/apartados/guardar_modal_apartado.js",
    "resources/assets/js/apartados/buscar_bancos_apartados.js",
    "resources/assets/js/apartados/buscar_cliente_apartado.js",

    "resources/assets/js/remisiones/agregar_remision.js",
    "resources/assets/js/remisiones/guardar_remision.js",
    "resources/assets/js/remisiones/aceptar_remision.js",
    "resources/assets/js/remisiones/opciones.js",
    "resources/assets/js/remisiones/info_remision.js",
    // INFORME UNO
    "resources/assets/js/informeUno/generar_informeuno.js",
    // JAVASCRIPT PARA LOS VENDEDORES
    "resources/assets/js/vendedores/nuevo_vendedor.js",
    "resources/assets/js/vendedores/guardar_nuevo_vendedor.js",
    "resources/assets/js/vendedores/editar_vendedor.js",
    "resources/assets/js/vendedores/guardar_editar_vendedor.js",
    "resources/assets/js/vendedores/estado_vendedor.js",
    //JAVASCRIPT PARA LA ACTUALIZACION MASIVA DE PRODUCTOS
    "resources/assets/js/actualizacion_masiva/buscar_tiendas.js",
    "resources/assets/js/actualizacion_masiva/cargar_tabla.js",
    "resources/assets/js/actualizacion_masiva/buscar_columnas.js",
    "resources/assets/js/actualizacion_masiva/cargar_categorias.js",
    "resources/assets/js/actualizacion_masiva/cargar_subcategorias.js",
    "resources/assets/js/actualizacion_masiva/habilitar_columnas.js",
    "resources/assets/js/actualizacion_masiva/actualizar.js",
    //JAVASCRIPT PARA LA BODEGA DE INVENTARIO EN BLESS
    "resources/assets/js/inventario_bodega/inventario_bodega.js",
    //JAVASCRIPT PARA LOS INFORMES DE ALBERTO (CONSULTAS)
    "resources/assets/js/informes_consultas/facturas.js",
    "resources/assets/js/informes_consultas/productos.js", 
    //INFORME DOÑA MONICA DEVOLUCIONES
    "resources/assets/js/informe_devoluciones/informe_devoluciones.js",
    "resources/assets/js/informe_devoluciones/generar_informe.js",
    //INFORMES PAGOS SISTECREDITO
    "resources/assets/js/sistecredito/buscar_documento.js",

    //INFORMES PDON ELKIN
    "resources/assets/js/informe_elkin/buscar_informe.js",
    "resources/assets/js/informe_elkin/cargar_tiendas.js",

    //INFORMES AUDITORIAS
    "resources/assets/js/auditorias/auditorias.js",

    //INFORMES AUDITORIAS
    "resources/assets/js/informe_elkin_devoluciones/buscar_informe_devoluciones.js",

    //DEVOLUCIONES 2018
    "resources/assets/js/devoluciones2018/devoluciones2018.js"
  ],
  "public/js/compilados.js"
);
