<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\saldos;

class SaldosController extends Controller
{
    public function buscar_saldo_devolucion(Request $request){
        $id_cliente = $request->id_cliente;
        $busqueda = saldos::where('id_cliente', $id_cliente)
                            ->where('estado', '!=', 0)->get();

        $saldo = 0;
        for ($i=0; $i < count($busqueda); $i++) { 
            $saldo = $saldo + $busqueda[$i]['saldo'];
        }
        return response(round($saldo));
    }
}
