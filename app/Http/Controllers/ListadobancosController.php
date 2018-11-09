<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\listadobancos;

class ListadobancosController extends Controller
{
    public function buscar_banco(Request $request){

        $datos = listadobancos::where('id_tipo_pago', $request->id_pago)->get();

        return response()->json(view('caja.parciale.bancos', compact('datos'))->render());


    }
}
