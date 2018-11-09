<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\inventario_bodega;

class InventarioBodegaController extends Controller
{
    public function inventario_bodega(){
        return view('inventario_bodega.inventario_bodega');
    }

    public function buscar_producto_bodega(Request $request){
        $codigo=$request->codigo;

        $codigo = str_replace("'", '-', $codigo);

        $consulta=inventario_bodega::where('codigo',$codigo)->get();
        if(count($consulta)!=0){
            $cantidad_bd=$consulta[0]->cantidad;
            $consulta[0]->cantidad=$cantidad_bd+1;
            $consulta[0]->save();
            $consulta_tabla=inventario_bodega::all();
            // return response()->json($consulta_tabla);
            return response()->json(view('inventario_bodega.parciales.tabla', compact('consulta_tabla'))->render());
        }
        elseif(count($consulta)==0){
            $insercion=new inventario_bodega;
            $insercion->codigo=$codigo;
            $insercion->cantidad=1;
            $insercion->save();
            $consulta_tabla=inventario_bodega::all();
            // return response()->json($consulta_tabla);
            return response()->json(view('inventario_bodega.parciales.tabla', compact('consulta_tabla'))->render());
        }
    }
}
