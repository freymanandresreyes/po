<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\tiendas;
use App\productos;
use App\remisiones;
use App\proveedores;
use App\consecutivos;
use DB;

class RemisionesController extends Controller
{
    public function crear_remisiones(Request $request){
        $proveedor = proveedores::all();
        $tienda = $request->user()->tienda;
        $consulta=tiendas::find($tienda);
        $consulta_grupo=$consulta->grupo;
        $zona_user=$consulta->id_zona;
        $lista_tiendas = tiendas::where('grupo',$consulta_grupo)
                                 ->where('id_zona',$zona_user)->get();
        return view('remisiones.crear', compact('lista_tiendas','proveedor'));
    }

    public function buscar_productos(Request $request){
        $codigo = $request->codigo;
        $tienda = $request->tienda;
        $tienda_user = $request->user()->tienda;
        if($tienda==$tienda_user){
            $respuesta=1;
            return response()->json($respuesta);
        }
        $consulta_tienda_user=productos::where('codigo',$codigo)
                                       ->where('id_tienda',$tienda_user)->first();
        if($consulta_tienda_user=="[]"){
            $respuesta=2;
            return response()->json($respuesta);
        }
        $consulta_tienda_remision=productos::where('codigo',$codigo)
                                       ->where('id_tienda',$tienda)->first();
        if($consulta_tienda_remision=="[]"){
            $respuesta=3;
            return response()->json($respuesta);
        }
        return response()->json($consulta_tienda_user);
    }

    public function guardar_remision_agregada(Request $request){
        $tienda_user = $request->user()->tienda;
        $tienda_recibe = $request->id_tienda;
        $datos = $request->datos;
        $opcion = $request->opcion;

        if ($opcion == 1) {
            # code...
            for ($i=0; $i < count($datos) ; $i++) {
        
                $nueva_remision= new remisiones;
                $nueva_remision->codigo=$datos[$i][0];
                $nueva_remision->precio=$datos[$i][2];
                $nueva_remision->cantidad=$datos[$i][3];
                $nueva_remision->tienda_envia=$tienda_user;
                $nueva_remision->tienda_recibe=$tienda_recibe;
                $nueva_remision->codigo_producto=$datos[$i][1];
                $nueva_remision->tipo=$request->opcion;
                $nueva_remision->estado=0;
                
                $nueva_remision->save();
              }
              $respuesta=1;
              return response()->json($respuesta);
        }elseif ($opcion == 2) {
            # code...
            $consecutivo = consecutivos::where('tag','REMI')->get();
            $valor = 0;
            foreach ($consecutivo as $value){
                # code...
                if($value->consecutivo > $valor){
                    $valor = $value->consecutivo;
                }
            }
            $n = new consecutivos;
            $n->tag = 'REMI';
            $n->consecutivo = $valor+1;
            $n->save();
            $c = 'REMI-'.($valor+1);
            //  dd($c);
            for ($i=0; $i < count($datos) ; $i++) {
        
                $nueva_remision= new remisiones;
                $nueva_remision->codigo=$datos[$i][0];
                $nueva_remision->precio=$datos[$i][2];
                $nueva_remision->cantidad=$datos[$i][3];
                $nueva_remision->tienda_envia=$tienda_user;
                $nueva_remision->id_proveedor = $request->id_proveedor;
                $nueva_remision->codigo_producto=$datos[$i][1];
                $nueva_remision->tipo=$request->opcion;
                $nueva_remision->estado=0;
                $nueva_remision->consecutivo= $c;
                
                $nueva_remision->save();
              }
              $respuesta=1;
              return response()->json($respuesta);
        }
        
    }//fin

    public function aceptar_remision(Request $request){
        $tienda_user = $request->user()->tienda;
        $consulta = remisiones::where('tienda_recibe',$tienda_user)
                                ->where('tipo', 1)
                                ->where('estado', 0)->get();

        // $consulta=DB::table('remisiones')
        //             ->where('estado','==',0)->get();
        // dd($consulta);        
        $consulta->each(function($consulta){
            $consulta->tiendaremisionrecibe;
            $consulta->tiendaremisionenvia;
        });
        return view('remisiones.aceptar', compact('consulta'));
    }

    public function aceptar_remision_seleccionada(Request $request){
        $tienda_user = $request->user()->tienda;
        $id_remision = $request->identificador;
        $consulta_remision = remisiones::find($id_remision);

        $id_producto_enviado = $consulta_remision->codigo_producto;
        $codigo_producto = $consulta_remision->codigo;
        $tienda_envia = $consulta_remision->tienda_envia;

        //consulta si el producto existe en la tienda a la que se envio.
        $consulta_productos_recibe = productos::where('codigo',$codigo_producto)
                                                ->where('id_tienda',$tienda_user)->first();

        if($consulta_productos_recibe == null){
            return response()->json([
                'message' => 'Este producto no extiste en la tienda.',
            ], 404);
        }
        
        //Consulta si el codigo del producto enviado existe.
        $consulta_productos_envia = productos::find($id_producto_enviado);
        if($consulta_productos_envia == null){
            return response()->json([
                'message' => 'el codigo del producto no es correcto.',
            ], 404);
        }

        $cantidad_enviada = $consulta_remision->cantidad;
        $consulta_remision->estado=1;
        $consulta_remision->save();
        
        
        //verificar si el producto al cuan viene tiene precio si no agregar toda la configuracion.
        $precio_producto=$consulta_productos_recibe->precio;
        
        // cantidades de quien recibe
        $cantidad_producto=$consulta_productos_recibe->cantidad;
        $cantidad_recibido=$consulta_productos_recibe->cant_recibida;

        //cantidades de quien envia
        $und_producto = $consulta_productos_envia->cantidad;
        $und_enviadas = $consulta_productos_envia->cant_enviada;
        
        // ***************************************************************************
        $precio_mayorista=$consulta_productos_envia->precio_mayorista;
        $precio_costo=$consulta_productos_envia->precio_costo;
        // ***************************************************************************    
        
        
        if($precio_producto == 0){
            //actualizamos el producto al aceptar del que recibe
            $consulta_productos_recibe->precio = $consulta_productos_envia->precio;
            $consulta_productos_recibe->Precio_mayorista = $consulta_productos_envia->Precio_mayorista;
            $consulta_productos_recibe->precio_costo = $consulta_productos_envia->precio_costo;
            $consulta_productos_recibe->cant_recibida = $cantidad_recibido + $cantidad_enviada;
            $consulta_productos_recibe->cantidad = $cantidad_producto + $cantidad_enviada;
            $consulta_productos_recibe->oferta = $consulta_productos_envia->oferta;
            $consulta_productos_recibe->id_configuraciones = $consulta_productos_envia->id_configuraciones;
            $consulta_productos_recibe->aplicar_iva = $consulta_productos_envia->aplicar_iva;
            $consulta_productos_recibe->save();

            //actualizamos el producto de quien envio.
            $consulta_productos_envia->cantidad = $und_producto - $cantidad_enviada;
            $consulta_productos_envia->cant_enviada = $und_enviadas + $cantidad_enviada;
            $consulta_productos_envia->save();
      
            return response()->json($consulta_productos_envia);
        }
        else{
            //actualizamos el producto al aceptar del que recibe
            $consulta_productos_recibe->cant_recibida = $cantidad_recibido + $cantidad_enviada;
            $consulta_productos_recibe->cantidad = $cantidad_producto + $cantidad_enviada;
            $consulta_productos_recibe->save();

            //actualizamos el producto de quien envio.
            $consulta_productos_envia->cantidad = $und_producto - $cantidad_enviada;
            $consulta_productos_envia->cant_enviada = $und_enviadas + $cantidad_enviada;
            $consulta_productos_envia->save();
            
            return response()->json($consulta_productos_envia);            
        }
    }

    public function ver_remision(Request $request){
        $tienda_user = $request->user()->tienda;
        $consulta=remisiones::where('tienda_envia',$tienda_user)
                            ->orwhere('tienda_recibe',$tienda_user)->get();
        // dd($consulta);
        $id_tienda = $request->user()->tienda;
        $tienda = tiendas::find($id_tienda)->select('nombre_tienda', 'encargado','nit_tienda','direccion_tienda','ciudad','logo')->first();
        return view('remisiones.ver', compact('consulta','tienda'));
    }
    public function vista_remision(Request $request){
        $consulta = remisiones::where('tipo', 2)->get();
        $consulta->each(function($consulta){
            $consulta->remisionProveedor;
        });
        // dd($consulta);
        $u = [];
        foreach ($consulta as $value) {
            $u[] = $value->consecutivo;
        }
        // dd($u);
        //eliminamos las facturas duplicadas
        $v = array_unique($u);
        //reordenamos los valores
        $lista_consecutivos = [];
        foreach ($v as $value) {
            $lista_consecutivos[] = $value;
        }
        $objeto_final = [];
        $objeto = [];
        $c = null;//almacena el consecutivo
        $f = null; // almacena la fecha DE LA REMISION
        $p = null; // nombre del proveedor
        for ($i=0; $i <count($lista_consecutivos) ; $i++) { 
            
            foreach ($consulta as $value) {
                # code...
                if ($value->consecutivo == $lista_consecutivos[$i]) {
                    $c = $value->consecutivo;
                    $f = $value->created_at->format('d-m-Y');
                    $p = $value->remisionProveedor->nombre;
                }
            }
            $objeto[]= $c;
            $objeto[]= $f;
            $objeto[]= $p;
            $objeto_final[] = $objeto;
            
            $objeto = null;
            $c = null;//almacena el consecutivo
            $f = null; // almacena la fecha DE LA REMISION
            $p = null; // nombre del proveedor
            // $cantidad;
        }
        
        // dd($objeto_final);
        return view('remisiones.lista_remisiones', compact('objeto_final'));
    }
    
    public function informe_remision(Request $request){
        $consecutivo = $request->conse;
        $cantidad = 0;
        
        $consulta = remisiones::where('consecutivo', $consecutivo)->get();
        $consulta->each(function($consulta){
            $consulta->remisionProveedor;
            $consulta->remisionProducto;
            $consulta->tiendaremisionenvia;
        });

        foreach ($consulta as $value) {
            $cantidad = $cantidad + $value->cantidad;
        }
        // dd($consulta);
        return response()->json(view('remisiones.parciales.info_remisiones', compact('consulta','cantidad'))->render());
    }

    public function rechazar_remision_seleccionada(Request $request){
        // 0 = enviada
        // 1 = aceptada
        // 2 = rechazada
        // dd('rechazada');
        $identificador = $request->identificador;
        $producto = remisiones::find($identificador);
        $producto->estado = 2;
        $producto->save();

        return response($producto);
    }

    public function visualizar_traslado(Request $request){
        $traslado = remisiones::where('id', $request->traslado_id)->first();
        $traslado->tiendaremisionrecibe;
        $traslado->tiendaremisionenvia;
        $traslado->remisionProducto;
        return $traslado;
    }
}
