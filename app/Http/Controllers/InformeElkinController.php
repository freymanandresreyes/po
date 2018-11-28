<?php

namespace App\Http\Controllers;
use App\tiendas;
use App\zonas;
use DB;


use Illuminate\Http\Request;

class InformeElkinController extends Controller
{
    public function vista_informe_elkin()
    {
        $zonas = zonas::all();
        return view('informe_elkin.informe_elkin', compact('zonas'));
    }


    public function generar_informe_elkin(Request $request)
    {
        $tienda=$request->tienda;
        $fecha1=$request->fecha1;
        $fecha2=$request->fecha2;
        $consulta=DB::table('facturas')
                    ->select('facturas.codigo AS codigo','tiendas.slug as bodega','facturas.total AS total')
                    ->join('tiendas', 'facturas.id_tienda', '=', 'tiendas.id')
                    ->where('facturas.total','>',100)
                    ->where('facturas.id_clasificaciones','!=',1)
                    // ->where('facturas.codigo','!=',0)
                    ->where('facturas.estado','=',0)
                    ->where('facturas.id_tienda','=',$tienda)
                    ->whereDate('facturas.created_at','>=',$fecha1)
                    ->whereDate('facturas.created_at','<=',$fecha2)     
                    ->get();

        return response()->json(view('informe_elkin.parciales.tabla', compact('consulta'))->render());

    }
}
