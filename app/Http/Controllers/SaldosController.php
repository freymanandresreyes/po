<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\saldos;
use DB;

class SaldosController extends Controller
{
    public function buscar_saldo_devolucion(Request $request){
        $id_cliente = $request->id_cliente;
        $saldo=DB::table('saldos')
                ->select(DB::raw('sum(saldo) as saldo'))
                ->where([['id_cliente',$id_cliente],['estado','!=',0]])
                ->first();
        return response($saldo->saldo);
    }
}
