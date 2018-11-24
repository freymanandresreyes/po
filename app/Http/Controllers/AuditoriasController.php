<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;

class AuditoriasController extends Controller
{
    public function vista_auditorias(){
        return view('auditorias.auditorias');
    }


    public function buscar_facturas_auditorias(Request $request){
        $codigo=$request->codigo;
        $consulta=DB::table('facturas')
        ->select('facturas.n_factura AS factura','facturas.codigo as codigo','facturas.cantidad as cantidad',
        'facturas.total AS total','tiendas.slug as tienda','facturas.created_at as fecha')
        ->join('tiendas', 'facturas.id_tienda', '=', 'tiendas.id')
        ->where('facturas.estado','=',0)
        ->where('facturas.codigo','=',$codigo)
        ->get();
        return response()->json(view('auditorias.parciales.tabla_auditorias', compact('consulta'))->render());
    }
}
