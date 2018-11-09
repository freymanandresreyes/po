<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\categorias;

class CategoriasController extends Controller
{
    public function nueva_categoria(Request $request){
        $userTienda = $request->user()->tienda;
        $nuevo = new categorias;
        $nuevo->id_tienda = $userTienda;
        $nuevo->categoria = $request->categoria;
        $nuevo->save();

        $consulta = categorias::where('id_tienda', $userTienda)->get();

        return response()->json(view('producto.parciales.categoria', compact('consulta'))->render()); 

    }

    public function nueva_categoria_compras(Request $request){
        $tienda = $request->tienda;
        // dd($request->categoria);
        $nuevo = new categorias;
        $nuevo->id_tienda = $tienda;
        $nuevo->categoria = $request->categoria;
        $nuevo->save();
        // dd($nuevo);
        $consulta = categorias::where('id_tienda', $tienda)->get();

        return response()->json(view('producto.parciales.categoria', compact('consulta'))->render()); 

    }

}
