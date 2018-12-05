<?php

namespace App\Http\Controllers;
use App\tiendas;
use App\zonas;
use DB;

use Illuminate\Http\Request;

class InformeElkinDevolucionesController extends Controller
{
    public function vista_informe_elkin_devoluciones()
    {
        $zonas = zonas::all();
        return view('informe_elkin_devoluciones.informe_elkin_devoluciones', compact('zonas'));
    }


    public function generar_informe_elkin_devoluciones(Request $request)
    {
        $tienda=$request->tienda;
        $fecha1=$request->fecha1;
        $fecha2=$request->fecha2;
        $consulta=DB::table('devoluciones')
                    ->select('devoluciones.referencia AS codigo','tiendas.slug as bodega','devoluciones.valor AS total')
                    ->join('tiendas', 'devoluciones.id_tienda', '=', 'tiendas.id')
                    ->where('devoluciones.id_tienda','=',$tienda)
                    ->whereDate('devoluciones.created_at','>=',$fecha1)
                    ->whereDate('devoluciones.created_at','<=',$fecha2)     
                    // ->where('facturas.estado','=',0)
                    ->get();

        return response()->json(view('informe_elkin_devoluciones.parciales.tabla', compact('consulta'))->render());

    }
}
