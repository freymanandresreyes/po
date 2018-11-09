<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\zonas;
use App\facturas;

class ticketController extends Controller
{
    public function inicio_tickets(){
        $zonas = zonas::all();
        return view('info_tickets.index', compact('zonas'));
    }


    public function ticket_buscar(Request $request){
    
        $tienda = $request->tienda;
        $fecha_inicio = $request->fecha_inicio;
        $fecha_fin = $request->fecha_fin;
        
        $datos = facturas::where('estado', '==', 0)
                            ->where('id_tienda', $tienda)
                            ->whereDate('created_at', '>=', $fecha_inicio)->whereDate('created_at', '<=', $fecha_fin)->get();
        $datos->each(function($datos){
            $datos->vendedoresfactura;
        });
        
        return response()->json($datos);
    }
    public function resumen_ticket(Request $request){
        $tienda = $request->tienda;
        $fecha_inicio = $request->fecha_inicio;
        $fecha_fin = $request->fecha_fin;
        
        $datos = facturas::where('estado', '==', 0)
                            ->where('id_tienda', $tienda)
                            ->whereDate('created_at', '>=', $fecha_inicio)->whereDate('created_at', '<=', $fecha_fin)->get();
        $datos->each(function($datos){
            $datos->vendedoresfactura;
        });
        
        
        $empleados = [];
        //usuarios
        foreach ($datos as $value) {    
            $empleados[] = $value->vendedoresfactura->nombres;
        }
        //reordenamos los valores
        $e_unico = array_unique($empleados);
        $empleados_unico = [];
        foreach ($e_unico as $value) {
            $empleados_unico[] = $value;
        }

        $facturas = [];
        //usuarios
        foreach ($datos as $value) {    
            $facturas[] = $value->codigo;
        }
 
        //reordenamos los valores
        $f_unico = array_unique($facturas);
        $facturas_unico = [];
        foreach ($f_unico as $value) {
            $facturas_unico[] = $value;
        }

        $objeto_final = [];
        $objeto = []; 
        $nombres = null;
        $cantidad_productos = [];
        $total_venta = null;
       
        for ($i=0; $i < count($empleados_unico); $i++) { 
            foreach ($datos as $value) {
                if($empleados_unico[$i] == $value->vendedoresfactura->nombres){
                    // dd($value->vendedoresfactura->nombres);
                    $nombres = $value->vendedoresfactura->nombres;
                    $cantidad_productos[] = $value->n_factura;
                    $total_venta = $total_venta + (($value->total)/1.19);//haver dinamico el iva
                }
            }
            $objeto[]= $nombres;
            $objeto[]= count($cantidad_productos);
            // dd(count(array_unique($cantidad_productos)));
            $objeto[]= count(array_unique($cantidad_productos));
            $objeto[]= (intval($total_venta))/(count(array_unique($cantidad_productos)));
            $objeto[]= (count($cantidad_productos))/(count(array_unique($cantidad_productos)));
            $objeto[]= intval($total_venta);
            $objeto_final[] = $objeto;
            $objeto = null;
            $nombres = null;
            $cantidad_productos = null;
            $total_venta = null;
           
        }//fin for
        // dd($objeto_final);
        return response()->json(view('info_tickets.parciales.tabla', compact('objeto_final'))->render());

    }
}
