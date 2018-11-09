<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\subcategorias;

class SubcategoriasController extends Controller
{
    public function nueva_subcategoria(Request $request){
        $userTienda = $request->user()->tienda;
        $id_categoria = $request->id_categoria;
        $nuevo = new subcategorias;
        $nuevo->id_tienda = $userTienda;
        $nuevo->id_categoria = $request->id_categoria;
        $nuevo->nombre_categoria = $request->categoria;
        $nuevo->save();

        $consulta = subcategorias::where('id_tienda', $userTienda)
                                   ->where('id_categoria', $id_categoria)->get();

        return response()->json(view('producto.parciales.subcategoria', compact('consulta'))->render()); 

    }

    public function nueva_subcategoria_compras(Request $request){
        $subcategoria_nombre= $request->subcategoria_nombre;
        $tienda = $request->tienda;
        $id_categoria = $request->id_categoria;
        $nuevo = new subcategorias;
        $nuevo->id_tienda = $tienda;
        $nuevo->id_categoria = $id_categoria;
        $nuevo->nombre_categoria = $subcategoria_nombre;
        $nuevo->save();
        // dd($nuevo);
        $consulta = subcategorias::where('id_tienda', $tienda)
                                   ->where('id_categoria', $id_categoria)->get();

        return response()->json(view('producto.parciales.subcategoria', compact('consulta'))->render()); 

    }
}
