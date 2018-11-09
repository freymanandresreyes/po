<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\zonas;
use App\categorias;
use App\subcategorias;
use App\facturas;
use App\tiendas;

class VariosController extends Controller
{
    public function ver_varios(){
        $zonas = zonas::all();

        return view('informes.info_varios', compact('zonas'));
    }

    public function buscar_categoria_varios(Request $request){

        $tienda = $request->tienda;

        $categoria = categorias::where('id_tienda', $tienda)
                                ->where('categoria', 'OTROS')->get();
        $id_categoria = $categoria[0]['id'];

        $subcategorias = subcategorias::where('id_categoria', $id_categoria)->get();

        return response()->json(view('informes.parciales.subcategoria_varios', compact('subcategorias'))->render());
    }

    public function generar_informe_varios(Request $request){

        $tienda = $request->tienda;
        $inicio = $request->inicio;
        $fin = $request->fin;
        $subcategoria = $request->subcategoria;
        $consulta_tiendas = tiendas::find($tienda);

        $busqueda = facturas::where('id_tienda', $tienda)
             ->where('id_subcategoria', $subcategoria)
             ->whereDate('created_at', '>=', $inicio)
             ->whereDate('created_at', '<=', $fin)->get();
        $busqueda->each(function ($busqueda) {
            $busqueda->clientesfactura;
        });
        //   dd($busqueda);
        if($busqueda){

            $facturas = [];
    
            for ($i = 0; $i < count($busqueda); $i++) {
                $facturas[] = $busqueda[$i]['n_factura'];
            }
    
            //listado de consecutivos, No duplicados.
            $orden = array_unique($facturas);
            
            //reordenamos los valores
            $facturas_unicas = [];
            foreach ($orden as $value) {
                $facturas_unicas[] = $value;
            }
    
            $cantidad_facturas = count($facturas);
            $valor_total = null;
            $codigo = null;
            $descripcion = null;
            $valor_producto = null;

            foreach ($busqueda as $value) {
                $valor_total = $valor_total + $value->total;
                $codigo = $value->codigo;
                $descripcion = $value->titulo;
                $valor_producto = $value->total;
            }


            return response()->json(view('informes.parciales.info_varios', compact(
            'consulta_tiendas',
            'inicio',
            'fin',
            'cantidad_facturas',
            'valor_total',
            'codigo',
            'descripcion',
            'valor_producto'
            ))->render());
        }else{}

        //variables

    }
}
