<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\categorias;
use App\facturas;
use App\zonas;
use DB;
use App\tiendas;

class infoUtilidadFacturaController extends Controller
{
    public function utilidad_factura()
    {
        $zonas = zonas::all();
        return view('informes.utilidadFactura', compact('zonas'));
    }

     public function utilidad_factura_consultar(Request $request)
    {

        $zonas = zonas::all();
        
        $tienda = $request->informe_tienda_select;
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;

        $consulta_tiendas = tiendas::find($tienda);
        
        $facturas = facturas::where('id_tienda', $tienda)
                            ->where('id_clasificaciones', '!=', 1)
                            ->where('id_clasificaciones', '!=', 2)
                            ->where('id_clasificaciones', '!=', 3)
                            ->where('estado', '!=', 1)
                            ->where('facturacion','!=',3)
                            ->whereDate('created_at', '>=', $inicio)
                            ->whereDate('created_at', '<=', $fin)->select('n_factura','created_at','precio_base',DB::raw('SUM(precio_costo) as precio_costo'),'id_cliente',DB::raw('SUM(precio_oferta) as precio_oferta'))->groupBy('n_factura')->get();
                            dd($facturas);                   
        $facturas->each(function ($facturas) {
            $facturas->clientesfactura;
        });
        
        $v_utilidad = [];
        $porcentaje = [];
        $i = 0;


        foreach($facturas as $factura){

            // if($factura->precio_base > $factura->precio_costo){
            $base1=Round($factura->precio_oferta/1.19,0);
            // $gg=$base1-$factura->precio_costo;
            $v_utilidad[$i] = $base1 - $factura->precio_costo;

            // }
            // else if($factura->precio_base < $factura->precio_costo){
                
            // $v_utilidad[$i] = round($factura->precio_base - $factura->precio_costo, 2);

            // }
            // else if($factura->precio_base == $factura->precio_costo){
                    
            // $v_utilidad[$i] = round($factura->precio_base - $factura->precio_costo, 2);

            // }


            if($v_utilidad[$i] > 0){ 

            // $porcentaje_divicion = $v_utilidad[$i]/$base1;//REVISAR ESTA LINEA DE CODIGO
            $porcentaje[$i] = Round($v_utilidad[$i]/$base1,2) * 100;
          }else{
            $porcentaje[$i] = 0;
          }
        // $suma=$base+0;
            $i++;
            
        }


        $suma_base = facturas::where('id_tienda', $tienda)
                            ->where('id_clasificaciones', '!=', 1)
                            ->where('id_clasificaciones', '!=', 2)
                            ->where('id_clasificaciones', '!=', 3)
                            ->where('estado', '!=', 1)
                            ->where('facturacion','!=',3)
                            ->whereDate('created_at', '>=', $inicio)
                            ->whereDate('created_at', '<=', $fin)->select(DB::raw('SUM(precio_oferta) as precio_oferta'))->get();
        // dd($suma_base[0]->precio_oferta);
        $ff=Intval($suma_base[0]->precio_oferta);
        // dd($ff/1.19);


        // $f=[];
        // $i=0;
        // foreach($facturas as $factura){

        // $base1=Round($factura->precio_oferta/1.19,0);
        // $costo1=Round($factura->precio_oferta/1.19,0)-$factura->precio_costo;

        // if($base1 > $costo1 ){
            
        //     $f[$i]=$base1/$costo1*100;

        //     }
        
        // else 
        // if($base1 < $costo1){

        //     $f[$i]=$base1/$costo1*100;

        //     }
        
        // else if($base1 == $costo1){

        //     $f[$i]=$base1/$costo1*100;

        //     }
        // $i++;
        // }

          return view('informes.utilidadFactura', compact(
            'facturas',
            'v_utilidad',
            'porcentaje',
            'consulta_tiendas',
            'inicio',
            'fin',
            'zonas',
        'ff'));
    }

   /* public function utilidad_factura_consultar1(Request $request)
    {

        $zonas = zonas::all();
        
        $tienda = $request->informe_tienda_select;
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;

        $consulta_tiendas = tiendas::find($tienda);
        
        $busqueda = facturas::where('id_tienda', $tienda)
                            ->where('id_clasificaciones', '!=', 1)
                            ->where('id_clasificaciones', '!=', 2)
                            ->where('id_clasificaciones', '!=', 3)
                            ->where('estado', '!=', 1)
                            ->where('facturacion','!=',3)
                            ->whereDate('created_at', '>=', $inicio)
                            ->whereDate('created_at', '<=', $fin)->get();
                            // dd($busqueda);                   
        $busqueda->each(function ($busqueda) {
            $busqueda->clientesfactura;
        });
     
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
        
        //variables
        $objeto_final = [];
        $objeto_final_totales = [];
        $objeto = [];
        $objeto_totales = [];
        
        $numero_factura = null;
        $fecha = null;
        $documento = null;
        $nombre = null;
        $p_base = 0;
        $promedio_p_base = 0;
        $p_costo = 0;
        $promedio_p_costo = 0;
        $v_utilidad = 0;
        $porcentaje = 0;
        // $cantidad_item = 0;
        // dd($facturas_unicas);
        //totales
        $total_base = 0;
        $total_costo = 0;
        $total_utilidad = 0;
        $id_producto = null;
        
        // dd($facturas_unicas);

        for ($i = 0; $i < count($facturas_unicas); $i++) {
            foreach ($busqueda as $value) {
                // dd($value->n_factura);
                //
                if ($facturas_unicas[$i] == $value->n_factura) {
                    $numero_factura = $value->n_factura;
                    $fecha = $value->created_at->format('d/m/Y');
                    $documento = $value->clientesfactura->documento;
                    $nombre = $value->clientesfactura->nombres;
                    $id_producto = $value->id;
                    // $cantidad_item = $cantidad_item + 1;
                    // calcula precio base por producto
                    $valor = floatval($value->precio_oferta);
                    // dd($value->n_factura);
                    // dd($valor);
                    $iva = floatval(1 . '.' . $value->porsentaje_iva);
                    
                    $resta = $valor / $iva;
                    // dd($resta);
                    $data2 = bcdiv($resta, '1', 2);
                    $p_base = $p_base + floatval($data2);
                    
                    $p_costo = $p_costo + $value->precio_costo;

                }
              
        } //fin del for
          // dd($cantidad_item);
        //promedio del precio base
        $promedio_p_base = round($p_base, 2);
        $total_base = $total_base + $promedio_p_base;
        //promedio del precio costo
        $promedio_p_costo = round($p_costo, 2);
        $total_costo = $total_costo + $promedio_p_costo;
        //calculo del valor de la utilidad
        $v_utilidad = round($promedio_p_base - $promedio_p_costo, 2);
        $total_utilidad = $total_utilidad + $v_utilidad;
        //calculo porcentaje de ganancia
        $porcentaje_divicion = round(($v_utilidad/$promedio_p_base), 2);//REVISAR ESTA LINEA DE CODIGO
        $porcentaje = $porcentaje_divicion *100;
        // dd($porcentaje);
        $objeto[] = $numero_factura;
        $objeto[] = $fecha;
        $objeto[] = $documento;
        $objeto[] = $nombre;
        $objeto[] = $promedio_p_base;
        $objeto[] = $promedio_p_costo;
        $objeto[] = $v_utilidad;
        $objeto[] = $porcentaje;
        $objeto[] = $id_producto;
        $objeto_final[] = $objeto;
        $objeto = null;
        $numero_factura = null;
        $fecha = null;
        $documento = null;
        $nombre = null;
        $promedio_p_base = null;
        $promedio_p_costo = null;
        $v_utilidad = null;
        $porcentaje = null;
        $id_producto = null;
        $p_costo = 0;
        $p_base = 0;
        // $cantidad_item = 0;
        $objeto_totales[] = $total_base;
        $objeto_totales[] = $total_costo;
        $objeto_totales[] = $total_utilidad;
            } //fin foreach
        // dd(current($objeto_final));
        // return view('informes.utilidadFactura', compact('zonas'));
        return view('informes.utilidadFactura', compact(
            'objeto_final',
            'objeto_totales',
            'consulta_tiendas',
            'inicio',
            'fin',
            'zonas'));

    }*/

   
}
