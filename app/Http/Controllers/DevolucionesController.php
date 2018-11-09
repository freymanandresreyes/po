<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\consecutivos;
use App\devoluciones;
use App\facturas;
use App\clientes;
use App\productos;
use App\saldos;
use App\tiendas;

class DevolucionesController extends Controller
{
    public function crear_devoluciones(){
        return view('devoluciones.index');
    }

    public function guardar_devolucion(Request $request){
        $usuario = $request->user()->id;
        $tienda = $request->user()->tienda;

        $consulta_grupo=tiendas::find($tienda);
        $grupo=$consulta_grupo->grupo;
        $zona=$consulta_grupo->id_zona;

        $consecutivo = consecutivos::where('id_tienda',$tienda)
        ->where('tag',"devolucion")->get();
        $consecutivo_numero=0;
        // for busca el consecutivo de la factura
        for ($i = 0; $i <= (count($consecutivo))-1; $i++) {
            $conteo = $consecutivo[$i]['consecutivo'];
            if($conteo > $consecutivo_numero){
                $consecutivo_numero = $conteo;
            }
        }

        //consecutivo que se le asigna a una devolucion
        $consecutivo_devolucion = $consecutivo_numero + 1;
  
        $nuevo_consecutivo = new consecutivos;
        $nuevo_consecutivo->id_tienda = $tienda;
        $nuevo_consecutivo->tag = "devolucion";
        $nuevo_consecutivo->consecutivo = $consecutivo_devolucion;
        $nuevo_consecutivo->save();
        
            
            $datos = $request->data;
            $factura = $request->factura;
     

        $datos = $request->data;
        $id_cliente = $request->id_cliente;
        $factura = $request->factura;
        

        for ($i=0; $i < count($datos) ; $i++) { 
            
            $registro = new devoluciones;
            $registro->factura = $factura;
            $registro->id_factura= null;
            $registro->radicado = $consecutivo_devolucion;
            $registro->producto = $datos[$i][0];
            $registro->referencia = $datos[$i][1];
            $registro->valor = $datos[$i][2];
            $registro->cantidad = $datos[$i][3];
            $registro->descripcion_recibo = $datos[$i][4];
            $registro->estado = 0;
            $registro->id_cliente = $id_cliente;
            $registro->id_tienda = $tienda;
            $registro->id_zona=$zona;
            $registro->save();
        }
        return response()->json(count($datos));

    }

    public function ver_devolucion(Request $request){
        $tienda = $request->user()->tienda;
        $consulta_grupo=tiendas::find($tienda);
        $grupo=$consulta_grupo->grupo;
        $zona=$consulta_grupo->id_zona;
       $consulta = devoluciones::where('id_zona',$zona)
                                ->where('id_tienda',$tienda)->get();
       $consulta->each(function($consulta){
        $consulta->clientesdevolucines;
        });
        return view('devoluciones.ver', compact('consulta'));
    }

    public function editar_devolucion(Request $request){
      $id = $request->identificador;
      $consulta = devoluciones::find($id);

      return response()->json($consulta);
    }

    public function editar_devolucion_guardar(Request $request){
        $id = $request->id;
        $estado = $request->estado;
        $comentario = $request->comentario;
        
        $actualizar = devoluciones::find($id);
        $actualizar->estado = $estado;
        $actualizar->descripcion_entrega = $comentario;
        $actualizar->save();
    }

    public function entregar_devolucion(Request $request){
        $tienda = $request->user()->tienda;
        $consulta = devoluciones::where('id_tienda',$tienda)->get();
        // dd($consulta);
        $consulta->each(function($consulta){
            $consulta->clientesdevolucines;
            });
         return view('devoluciones.entregar', compact('consulta'));
     }

    public function cambio(Request $request){
        $identificador=$request->identificador;
        $tienda = $request->user()->tienda;
        $consulta_grupo=tiendas::find($tienda);
        $grupo=$consulta_grupo->grupo;
        $zona=$consulta_grupo->id_zona;

        $consulta = devoluciones::find($identificador);
        $estado=$consulta->estado;
        $referencia=$consulta->referencia;
        
        $consulta_productos=productos::where('id_tienda',$tienda)
                                      ->where('codigo',$referencia)->get();
        $cantidad_bd=$consulta_productos[0]['cantidad'];
        $cantidad_ventas_bd=$consulta_productos[0]['cantidad_ventas'];
        $consulta_productos[0]['cantidad_ventas']=$cantidad_ventas_bd-1;
        $consulta_productos[0]['cantidad']=$cantidad_bd+1;
        // dd($consulta_productos);
        $consulta_productos[0]->save();

        if($estado==3){
        $saldo= $consulta->valor;
        $id_cliente= $consulta->id_cliente;
        $consulta->estado=4;
        $consulta->save();

        $busqueda=clientes::find($id_cliente);
        $id_cliente= $busqueda->id;
        $registro = new saldos;
        $registro->id_cliente=$id_cliente;
        $registro->saldo=$saldo;
        $registro->estado=1;
        $registro->id_tienda=$tienda;
        $registro->id_grupo=$grupo;
        $registro->id_zona=$zona;
        $registro->save();
        
        return response()->json($consulta);
        }

        elseif($estado==5){
        $saldo= $consulta->valor;
        $id_cliente= $consulta->id_cliente;
        $consulta->estado=4;
        $consulta->save();
        $busqueda=clientes::find($id_cliente);
        $id_cliente= $busqueda->id;
        $registro = new saldos;
        $registro->id_cliente=$id_cliente;
        $registro->saldo=$saldo;
        $registro->estado=1;
        $registro->id_tienda=$tienda;
        $registro->id_grupo=$grupo;
        $registro->id_zona=$zona;
        $registro->save(); 
        return response()->json($consulta);
        }
    }

    public function datos_cliente(Request $request){
    $factura = $request->nFactura;
    
    if($request->ajax()){
      $consulta = facturas::where('n_factura', $factura)->get();
    //  dd($consulta[0]['id_cliente']);
     $id_cliente=$consulta[0]['id_cliente'];
    //  dd($id_cliente);
     $consulta_cliente=clientes::where('id',$id_cliente)->get();
    //  dd($consulta_cliente);
    return response()->json($consulta_cliente);
    }
    }
}
