<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\compras;
USE App\proveedores;
use App\tiendas;
use App\User;
use App\cajamenor;
use App\entradamenor;
use App\salidamenor;
use App\consecutivos;
use App\controlcajas;
use App\productos;
use App\categorias;
use App\subcategorias;
use App\configuraciones;
use App\zonas;
use App\siyno;
use App\clasificacionproductos;
use App\devoluciones;
use App\devoluciones2018;
use App\clientes;
use App\saldos;

class Devoluciones2018Controller extends Controller
{
    public function decoluciones2018()
    {
        return view('devoluciones2018.index');
    }

    public function guardar_devolucion2018(Request $request){
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
            $registro->estado = 4;
            $registro->id_cliente = $id_cliente;
            $registro->id_tienda = $tienda;
            $registro->id_zona=$zona;
            $registro->save();


        $consulta_productos=productos::where('id_tienda',$tienda)
                                      ->where('codigo',$datos[$i][1])->get();
        $cantidad_bd=$consulta_productos[0]['cantidad'];
        $cantidad_ventas_bd=$consulta_productos[0]['cantidad_ventas'];
        $consulta_productos[0]['cantidad_ventas']=$cantidad_ventas_bd-1;
        $consulta_productos[0]['cantidad']=$cantidad_bd+1;
        // dd($consulta_productos);
        $consulta_productos[0]->save();


        $busqueda=clientes::find($id_cliente);
        $id_cliente= $busqueda->id;
        $registro = new saldos;
        $registro->id_cliente=$id_cliente;
        $registro->saldo=$datos[$i][2];
        $registro->estado=1;
        $registro->id_tienda=$tienda;
        $registro->id_grupo=$grupo;
        $registro->id_zona=$zona;
        $registro->save();
        }



        for ($i=0; $i < count($datos) ; $i++) { 
            
            $registro = new devoluciones2018;
            $registro->id_factura= null;
            $registro->id_cliente = $id_cliente;
            $registro->codigo_producto = $datos[$i][1];
            $registro->precio_producto = $datos[$i][2];
            $registro->cantidad = $datos[$i][3];
            $registro->n_factura = $factura;
            $registro->id_tienda = $tienda;
            $registro->save();
        }
        return response()->json(count($datos));

    }
}
