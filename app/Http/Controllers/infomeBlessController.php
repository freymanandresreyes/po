<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\zonas;
use App\tiendas;
use App\facturas;

class infomeBlessController extends Controller
{
    public function index(){
        $zonas = zonas::all();
       return view('informe_bless.index', compact('zonas')); 
    }

    public function generarInforme(Request $request){
        $zonas = zonas::all();
        
        $tienda = $request->tienda;
        $inicio = $request->inicio;
        $fin = $request->fin;

        $consulta_tiendas = tiendas::find($tienda);
        // dd($consulta_tiendas);
        $busqueda = facturas::where('id_tienda', $tienda)
                            ->where('facturacion', 3)
                            ->whereDate('created_at', '>=', $inicio)
                            ->whereDate('created_at', '<=', $fin)->get();
                            // dd($busqueda);                   
        $busqueda->each(function ($busqueda) {
            $busqueda->clientesfactura;
        });

        return view('informe_bless.index', compact('busqueda','zonas')); 
    }
}
