<?php

namespace App\Http\Controllers;

use App\clientes;
use App\configuraciones;
use App\consecutivos;
use App\facturas;
use App\Notifications\MensajeFacturaAnulada;
use App\productos;
use App\saldos;
use App\separados;
use App\tiendas;
use App\tiposdepagos;
use App\Traits\ControlCaja;
use App\User;
use App\vendedores;
use App\config_usuarios;
use App\categorias;
use App\subcategorias;
use App\devoluciones;
use DB;
use App\zonas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InformeDevolucionesController extends Controller
{
    public function info_devoluciones(){
        $consulta_zonas=zonas::all();
        return view('informe_devoluciones.informe_devoluciones',compact('consulta_zonas'));
    }

    public function cargar_tiendas_informe(Request $request)
    {
        $id_zona=$request->zona;
        // dd($id_zona);
        $consulta_tiendas=tiendas::where('id_zona',$id_zona)->get();
        // dd($consulta_tiendas);
        return response()->json(view('informe_devoluciones.parciales.tiendas', compact('consulta_tiendas'))->render());
    }


    public function informe_devoluciones_generar(Request $request){
        $tienda=$request->tienda;
        $fecha1=$request->inicio;
        $fecha2=$request->fin;

        $consulta_grupo=tiendas::find($tienda);
        $grupo=$consulta_grupo->grupo;
        $zona=$consulta_grupo->id_zona;
        $consulta = devoluciones::where('id_zona',$zona)
                                ->where('id_tienda',$tienda)
                                ->whereDate('devoluciones.created_at','>=',$fecha1)
                                ->whereDate('devoluciones.created_at','<=',$fecha2) 
                                ->get();
       $consulta->each(function($consulta){
        $consulta->clientesdevolucines;
        });
        // for ($i = 0; $i < count($consulta); $i++) {
            
        // }
        // dd($consulta);
        return response()->json(view('informe_devoluciones.parciales.tabla', compact('consulta'))->render());
    }
}
