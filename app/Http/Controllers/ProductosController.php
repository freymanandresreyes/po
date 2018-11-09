<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductosRequest;
use App\productos;
use App\tiendas;
use App\categorias;
use App\subcategorias;
use App\compras;
use App\zonas;
use App\clasificacionproductos;
use App\siyno;
use DB;
use Illuminate\Support\Facades\Schema;

class ProductosController extends Controller
{
    public function consultarProducto(Request $request){
      $userTienda = $request->user()->tienda;
      $codigo = $request->codigo_producto;
      if($request->ajax()){

      $consulta = productos::where('id_tienda', $userTienda)
                            ->where('cantidad', '>', 0)
                            ->where('codigo', $codigo)->first();
      if($consulta == null){
        return response()->json([
          'message' => 'Este producto no extiste en la tienda.',
        ], 404);
      }
    
      $consulta->categoriaProductos;     
      return Response($consulta);

      }
    }
    public function pepito(Request $request){
      dd('hola');
      $tienda = $request->tienda;
    //   dd($tienda);
      $codigo = $request->codigo;
        // dd($codigo);
      // $categoria=$request->titulo;
      // dd($categoria);
      if( $request->titulo==null  || $request->codigo==null || $request->id_categoria==null || $request->id_subcategoria==null)
      {
        return redirect()-> route('crear_productos')
                         -> with('errores','no puedes enviar campos vacios.');
      }
      $tienda_p=productos::where('id_tienda',$tienda)->get();
      
      
      $nuevo = new productos;
      $nuevo->id_tienda = $tienda;
      $nuevo->id_categoria = $request->id_categoria;
      $nuevo->id_subcategoria = $request->id_subcategoria;
      $nuevo->titulo = $request->titulo;
      $nuevo->codigo = strtoupper($request->codigo);
      $nuevo->descripcion = $request->descripcion;
      $nuevo->precio = 0;
      $nuevo->precio_mayorista = 0;
      $nuevo->descuentoOferta = 0;
      $nuevo->cantidad = 0;
      $nuevo->save();
        //**** */
        return redirect()-> route('crear_productos')
                         -> with('info','El producto fue creado con exito.');
    }
    //funcion para mostrar la vista de productos
    public function crear_productos(Request $request){
      // dd('asdas');
      $zonas = zonas::all();
      $tienda = $request->user()->tienda;
    if($tienda){
    $consulta_tienda = tiendas::find($tienda);
    $filtro_categorias = categorias::where('id_tienda', $tienda)->get();
    $categorias = $filtro_categorias->pluck('categoria', 'id');

    return view('producto.crear',compact('consulta_tienda','categorias','zonas'));
    }else{
      return redirect('/')-> with('info','Usted debe estar dentro de una tienda para poder agregar un producto.');
    }
    }

    public function tienda_zona_crear(Request $request){
      $zona = $request->zona;
      $consulta = tiendas::where('id_zona', $zona)->get();
      return response()->json(view('producto.parciales.tiendas', compact('consulta'))->render());
    }

    //funcion para crear productos
   
    

    public function buscar_categorias(Request $request){
      $tienda = $request->user()->tienda;
      $id_categoria = $request->categoria;
      if($request->ajax()){
        $consulta = subcategorias::where('id_tienda', $tienda)
                               ->where('id_categoria', $id_categoria)->get();
      if(count($consulta) != 0){
        return response()->json(view('producto.parciales.option', compact('consulta'))->render());

      }else{
        return Response()->json($consulta);
      }

      }
    }

    public function consulta_categoria(Request $request){
      $tienda = $request->tienda;
      if($request->ajax()){
        $consulta = categorias::where('id_tienda', $tienda)->get();
      
        return Response()->json($consulta);
      

      }
    }

    public function consulta_subcategoria_modal(Request $request){
      $tienda = $request->tienda;
      $categoria = $request->categoria;
      if($request->ajax()){
        $consulta = subcategorias::where('id_tienda', $tienda)
                               ->where('id_categoria', $categoria)->get();
      if($consulta){
        return response()->json(view('producto.parciales.option', compact('consulta'))->render());
      }else{
      }
      return Response()->json($consulta);

      }
    }

    //administrar productos

    public function visualizar(Request $request){
      $tienda = $request->user()->tienda;
      $filtro_categorias = categorias::where('id_tienda', $tienda)->get();
      $categorias = $filtro_categorias->pluck('categoria', 'id');
      $zonas = zonas::all();

      // $consulta = productos::where('id_tienda', $tienda)->get();
      // $consulta->each(function($consulta){
      // $consulta->categoriaProductos;
      // $consulta->subcategoriaProductos;
      // });
      // dd($consulta);
      return view('producto.promociones', compact(
        'consulta',
        'categorias',
        'zonas'));
    }

    //funcion para buscar y mostrar productos
    // segun los parametros de busqueda

    public function buscar_producto(Request $request){
      
      $tienda = $request->user()->tienda;
      //  dd($tienda);
      $categorias = $request->categoria;
      $subcategoria = $request->subcategoria;
      $titulo = $request->titulo;

      if($request->ajax()){
        $consulta = productos::where('id_tienda', $tienda)
                              ->categoria($categorias)
                              ->subcategoria($subcategoria)
                              ->titulo($titulo)
                              ->get();
        //dd($consulta);
        $consulta->each(function($consulta){
        $consulta->categoriaProductos;
        $consulta->subcategoriaProductos;
        });
        return response()->json(view('producto.parciales.tabla-productos', compact('consulta'))->render());
      }//fin ajax
  

    }

    public function actualizar_oferta(Request $request){

      $tienda = $request->user()->tienda;
      $categorias = $request->categoria;
      $subcategoria = $request->subcategoria;
      $titulo = $request->titulo;
      $valor_promo = $request->valor_promo;

      $consulta_actualizar = productos::where('id_tienda', $tienda)
                              ->categoria($categorias)
                              ->subcategoria($subcategoria)
                              ->titulo($titulo)
                              ->get();
    
        for ($i=0; $i <= (count($consulta_actualizar))-1 ; $i++) { 
          $id = $consulta_actualizar[$i]['id'];
          $actualizar = productos::find($id);
          $actualizar->oferta = $valor_promo;
          $actualizar->save();
        }

        $consulta = productos::where('id_tienda', $tienda)
                              ->categoria($categorias)
                              ->subcategoria($subcategoria)
                              ->titulo($titulo)
                              ->get();
        //dd($consulta);
        $consulta->each(function($consulta){
        $consulta->categoriaProductos;
        $consulta->subcategoriaProductos;
        });
        return response()->json(view('producto.parciales.tabla-productos', compact('consulta'))->render());

    }


    public function buscar_c_p(Request $request)
    {
      $codigo = $request->codigo;
      $tienda = $request->tienda;
    //   dd($tienda);
      $tienda_p=productos::where('id_tienda',$tienda)->get();
      
      $tienda_p->each(function($tienda_p){
        $tienda_p->categoriaProductos;

        $tienda_p->subcategoriaProductos; 
      });
      // dd($tienda_p->categoria);
    //   dd($tienda_p);
      if(count($tienda_p)==0)
      {
        $respuesta = 1;
        return response()->json($respuesta);
      }
      elseif(count($tienda_p)>=1)
      {
        
        for ($i=0;$i<count($tienda_p);$i++)
        {
            if($tienda_p[$i]->codigo==$codigo)
            {
            //   dd($tienda_p[$i]['precio']);
              return response()->json($tienda_p[$i]);
            }
        }
        // dd($tienda_p);
        $respuesta = 1;
        return response()->json($respuesta);
      }
    }

    public function select_categorias(Request $request)
    {
      $tienda = $request->user()->tienda;
      $consulta_c_p=categorias::where('id_tienda',$tienda)->get();
      return response()->json(view('producto.parciales.select', compact('consulta_c_p'))->render());
    }

    // listar compras
    public function listarcompras(Request $request)
    { 
      $tienda = $request->user()->tienda;
      $consulta=compras::where('id_tienda',$tienda)
                        ->where('estado',0)->get();
      // dd($consulta);
      return view('recepcion.recepcion',compact('consulta'));
    }

    // aceptar compra
    public function aceptarcompra(Request $request)
    {
      // consulta tabla compras
      // para traer datos relacionados a productos
      $id_compra = $request->id_compra;
      
      $consulta=compras::find($id_compra);
      $tienda = $consulta->id_tienda;
      $codigo=$consulta->codigo_producto;
      $cantidad=$consulta->cantidad;
      $precio_detal = $consulta->precio_detal;
      $precio_mayor = $consulta->precio_mayor;
      $precio_costo = $consulta->costo_und;
      $oferta = $consulta->oferta;
      $descuento_oferta = $consulta->descuento_oferta;
      $configuraciones = $consulta->configuraciones;
      $aplicar_iva = $consulta->aplicar_iva;
      // dd($consulta);
      
      // consulta a la tabla productos
      $producto=productos::where('id_tienda',$tienda)
      ->where('codigo',$codigo)->get();
      $cantidad_producto=$producto[0]['cantidad'];
      $cantidad_producto_ingreso=$producto[0]['cantidad_ingreso'];
      //  dd($producto);
      if($cantidad_producto==0)
      {
        $producto[0]['cantidad_ingreso']=($cantidad + $cantidad_producto_ingreso);
        $producto[0]['cantidad']=$cantidad;
        $producto[0]['precio']=$precio_detal;
        $producto[0]['precio_mayorista']=$precio_mayor;
        $producto[0]['precio_costo']=$precio_costo;
        $producto[0]['oferta']=$oferta;
        $producto[0]['descuentoOferta']=$descuento_oferta;
        $producto[0]['id_configuraciones']=$configuraciones;
        $producto[0]['aplicar_iva']=$aplicar_iva;
        $producto[0]->save();
        $consulta->estado=1;
        $consulta->save();
        $respuesta=0;
        return response()->json($respuesta);
      }
      elseif ($cantidad_producto>0) {
        // PROMEDIO PONDERADO
        // PARTE DE SOLO PRECIO
        $precio_bd=$producto[0]['precio'];
        $cantidad_bd=$producto[0]['cantidad'];
        $total_bd=$precio_bd*$cantidad_bd;
        $precio_r=floatval($precio_detal);
        $cantidad_r=$cantidad;
        $total_r=$precio_r*$cantidad_r;
        $total=$total_bd+$total_r;
        $total_cantidades=$cantidad_r+$cantidad_bd;
        $fintotal=$total/$total_cantidades;
        
        //  PROMEDIO PONDERADO
        // PARTE DE SOLO PRECIO MAYORISTA
        $precio_mayorista_bd=$producto[0]['Precio_mayorista'];
        $cantidad_mayorista_bd=$producto[0]['cantidad'];
        $total_mayorista_bd=$precio_mayorista_bd*$cantidad_mayorista_bd;
        $precio_mayorista_r=floatval($precio_mayor);
        $cantidad_mayorista_r=$cantidad;
        $total_mayorista_r=$precio_mayorista_r*$cantidad_mayorista_r;
        $total_mayorista=$total_mayorista_bd+$total_mayorista_r;
        $total_cantidades_mayorista=$cantidad_mayorista_bd+$cantidad_mayorista_r;
        $fintotal_mayorista=$total_mayorista/$total_cantidades_mayorista;
        
        $fintotalredondeado=round($fintotal);
        $mayoristaredondeado=round($fintotal_mayorista);
        
        // INSERTANDO EL PROMEDIO PONDERADO
        $producto[0]['precio']=$fintotalredondeado;
        $producto[0]['cantidad_ingreso']=($cantidad + $cantidad_producto_ingreso);
        $producto[0]['cantidad']=$total_cantidades;
        $producto[0]['precio_mayorista']=$mayoristaredondeado;
        $producto[0]['precio_costo']=$precio_costo;
        $producto[0]['oferta']=$oferta;
        $producto[0]['descuentoOferta']=$descuento_oferta;
        $producto[0]['id_configuraciones']=$configuraciones;
        $producto[0]['aplicar_iva']=$aplicar_iva;
        // dd($producto[0]);
        $producto[0]->save();
        $consulta->estado=1;
        $consulta->save();
            $respuesta=0;
            return response()->json($respuesta);
      }
    }
    public function ver_inventario(Request $request){

      $tienda = $request->user()->tienda;
      $zonas = zonas::all();
      $categorias_modal = categorias::where('id_tienda', $tienda)->get();
 
      $filtro_categorias = categorias::where('id_tienda', $tienda)->get();
      $categorias = $filtro_categorias->pluck('categoria', 'id');

      $consulta_oferta=siyno::all();
      $filtro_oferta=$consulta_oferta->pluck('nombre','id');
      
      $consulta_configuracion=clasificacionproductos::all();
      $filtro_configuracion=$consulta_configuracion->pluck('nombre','id');
      
      $consulta = productos::where('id_tienda', $tienda)->get();
      $consulta->each(function($consulta){
      $consulta->categoriaProductos;
      $consulta->subcategoriaProductos;
      $consulta->siyno;
      $consulta->clasificacion;
      });
      
      return view('inventario.inicio', compact('consulta','zonas','categorias_modal','filtro_oferta','filtro_configuracion'));
    }

    public function ver_inventario_zona(Request $request){

      $zonas = zonas::all();
      $tienda = $request->tienda;

      $categorias_modal = categorias::where('id_tienda', $tienda)->get();
      // dd($categorias);
      $consulta = productos::where('id_tienda', $tienda)->get();

      $consulta_oferta=siyno::all();
      $filtro_oferta=$consulta_oferta->pluck('nombre','id');
      
      $consulta_configuracion=clasificacionproductos::all();
      $filtro_configuracion=$consulta_configuracion->pluck('nombre','id');

      $consulta->each(function($consulta){
      $consulta->categoriaProductos;
      $consulta->subcategoriaProductos;
      $consulta->siyno;
      $consulta->clasificacion;
      });

      return view('inventario.inicio', compact('consulta','zonas','categorias_modal','filtro_oferta','filtro_configuracion'));
    }

    public function guardar_modal_producto(Request $request){
      $tienda = $request->tienda;
      $categoria = $request->categoria;
      $subcategoria = $request->subcategoria;
      $titulo = $request->titulo;
      $descripcion = $request->descripcion;
      $codigo = $request->codigo;
    //  dd($categoria);
      $nuevo = new productos;
      $nuevo->id_tienda = $tienda;
      $nuevo->id_categoria = $categoria;
      $nuevo->id_subcategoria = $subcategoria;
      $nuevo->titulo = $titulo;
      $nuevo->codigo = strtoupper($codigo);
      $nuevo->descripcion = $descripcion;
      $nuevo->precio = 0;
      $nuevo->precio_mayorista = 0;
      $nuevo->descuentoOferta = 0;
      $nuevo->cantidad = 0;
      $nuevo->cantidad_ventas = 0;
      $nuevo->save();
      // dd($nuevo);
      $nuevo->categoriaProductos;
      $nuevo->subcategoriaProductos; 
      
      // dd($nuevo);
      
      
      return response()->json($nuevo);
    }


    //************FUNCIONES PARA INVENTARIO ************* */

    public function inventario_buscar(Request $request){
      $id = $request->id_producto;
      // dd($datos);
      
      $datos = productos::find($id);
      $datos->categoriaProductos;
      $datos->subcategoriaProductos;
      $datos->siyno;
      $datos->clasificacion;
      
      return response($datos);


    }

    public function inventario_guardar(Request $request){

      $actualizar = productos::find($request->id);
      $actualizar->id_categoria = $request->categoria;
      $actualizar->id_subcategoria = $request->subcategoria;
      $actualizar->titulo = $request->titulo;
      $actualizar->codigo = $request->codigo;
      $actualizar->descripcion = $request->descripcion;
      $actualizar->precio_costo = $request->costo;
      $actualizar->precio = $request->precio;
      $actualizar->cantidad = $request->cantidad;
      $actualizar->descuentoOferta = $request->descuento;
      $actualizar->oferta = $request->estado_oferta;
      $actualizar->Precio_mayorista = $request->precio_mayor;
      $actualizar->id_configuraciones = $request->clasificacion;
      $actualizar->save();
      
      return response($actualizar);
    }

    public function inventario_buscar_subcategoria(Request $request){
      $categoria = $request->categoria;
      $consulta=subcategorias::where('id_categoria',$categoria)->get();
      return response()->json(view('inventario.parciales.subcategoria', compact('consulta'))->render());
    }

    //INIO DE LA ACTUALIZACION MASIVA
    // A LOS PRODUCTOS

    public function vista_actulizacion_masiva(){
      $consulta_zona=zonas::all();
      return view('actualizacion_masiva.actualizacion_masiva', compact('consulta_zona'));
    }

    public function buscar_tiendas(Request $request){
      $id_zona = $request->id_zona;
      $consulta_tiendas=tiendas::where('id_zona',$id_zona)->get();
      if($consulta_tiendas=='[]')
      {
        $respuesta=1;
        return response($respuesta);
      }
      else{
      return response()->json(view('actualizacion_masiva.parciales.tiendas', compact('consulta_tiendas'))->render());
      }
    }

    public function cargar_tabla(Request $request){
      $id_tienda = $request->id_tienda;
      $consulta=productos::where('id_tienda',$id_tienda)->get();
      $consulta_columnas=Schema::getColumnListing('productos');
      return response()->json(view('actualizacion_masiva.parciales.tabla', compact('consulta','consulta_columnas'))->render());
    }

    public function buscar_columnas(){
      $consulta_columnas=Schema::getColumnListing('productos');
      return response()->json(view('actualizacion_masiva.parciales.columnas', compact('consulta_columnas'))->render());
    }

    public function cargar_categorias(Request $request){
      $id_tienda = $request->id_tienda;
      $consulta_categorias=categorias::where('id_tienda',$id_tienda)->get();
      return response()->json(view('actualizacion_masiva.parciales.categorias', compact('consulta_categorias'))->render());
    }

    public function cargar_subcategorias(Request $request){
      $id_categoria = $request->id_categoria;
      $consulta_subcategorias=subcategorias::where('id_categoria',$id_categoria)->get();
      return response()->json(view('actualizacion_masiva.parciales.subcategorias', compact('consulta_subcategorias'))->render());
    }

    public function actualizar_masivamente(Request $request){
      $id_categoria = $request->id_categoria;
      $id_tienda = $request->id_tienda;
      $id_subcategoria = $request->id_subcategoria;
      $columna = $request->columna;
      $dato = $request->dato;
      $consulta=productos::where('id_tienda',$id_tienda)
                          ->where('id_categoria',$id_categoria)
                          ->where('id_subcategoria',$id_subcategoria)->get();
      // dd($consulta);
      if($consulta=='[]'){
        $respuesta=0;
        return response($respuesta);
      }
      else{
      for ($i=0;$i<count($consulta);$i++)
        {
           $consulta[$i]->$columna=$dato;
           $consulta[$i]->save();
        }
        $respuesta=1;
        return response($respuesta);
      }
    }

    public function productos_informe(){
        $tiendas=tiendas::all();
        // dd($consulta_tiendas);
        return view('consultas_facturas_productos.productos', compact('tiendas'));
    }

    public function consulta_informa_productos(Request $request){
      $tienda=$request->tienda;
      $consulta=DB::table('productos')
                    ->select('productos.titulo AS titulo','productos.codigo AS codigo',DB::raw('RIGHT(productos.codigo, 2) AS talla'),'productos.cantidad_ingreso AS cantidad_ingreso'
                        ,'productos.cantidad AS cantidad_bodega','productos.cantidad_ventas AS cantidad_vendidas','siyno.nombre AS aplica_oferta','productos.descuentoOferta AS descuento_oferta','productos.inicioOferta as inicio_oferta'
                        ,'productos.finOferta AS fin_oferta','productos.updated_at AS fecha_ingreso','categorias.categoria AS categoria','subcategorias.nombre_categoria AS subcategoria'
                        ,'tiendas.slug AS nombre_tienda','zonas.nombre as zona_tienda','productos.cant_enviada AS cantidad_enviada_traslado','productos.cant_recibida AS cantidad_recibida_traslado'
                        )
                    ->join('siyno', 'productos.oferta', '=', 'siyno.id')
                    ->join('tiendas', 'productos.id_tienda', '=', 'tiendas.id')
                    ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
                    ->join('subcategorias', 'productos.id_subcategoria', '=', 'subcategorias.id')
                    ->join('zonas', 'tiendas.id_zona', '=', 'zonas.id')
                    ->where('productos.id_tienda',$tienda)
                    ->get();


        for ($i = 0; $i < count($consulta); $i++) {
        $consulta[$i]->inicio_oferta=date('d-m-Y', strtotime($consulta[$i]->inicio_oferta));
        $consulta[$i]->fin_oferta=date('d-m-Y', strtotime($consulta[$i]->fin_oferta));
        $consulta[$i]->fecha_ingreso=date('d-m-Y', strtotime($consulta[$i]->fecha_ingreso));

        $consulta[$i]->inicio_oferta = str_replace("-", '/', $consulta[$i]->inicio_oferta);
        $consulta[$i]->fin_oferta = str_replace("-", '/', $consulta[$i]->fin_oferta);
        $consulta[$i]->fecha_ingreso = str_replace("-", '/', $consulta[$i]->fecha_ingreso);
        // dd($consulta[$i]->fecha_nacimiento_cliente);
        }
        return response()->json(view('consultas_facturas_productos.tablas.consulta_productos', compact('consulta'))->render());
    }
}