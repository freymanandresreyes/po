<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\grupos;
use App\tiendas;
use App\facturas;
use DB;
use App\Quotation;
class InformeUnoController extends Controller
{
    public function vista_informe_mayordetal(){
        // $consulta_tiendas=tiendas::where('grupo',1)->get();
        return view('informeUno.informeuno');
    }

    public function generar_informeuno(Request $request){

        $fecha1=$request->fecha1;
        $fecha2=$request->fecha2;
        $rango1=$request->rango1;
        $rango2=$request->rango2;
        // dd($fecha1);
        $consulta=DB::table('facturas')

                    ->whereDate('facturas.created_at','>=',$fecha1)
                    ->whereDate('facturas.created_at','<=',$fecha2)                    
                    // ->where('precio_oferta','<','55000')
                    ->whereIn('id_clasificaciones', [6])
                    // ->where('id_clasificaciones','!=',[1,2,3])                    
                    ->select('tiendas.slug as tienda','tipofacturas.nombre as tipo_factura',DB::raw('precio_oferta as oferta'), DB::raw('SUM(total) as total'), DB::raw('SUM(cantidad) as cantidad'))
                    ->join('tiendas', 'tiendas.id', '=', 'id_tienda')
                    ->join('tipofacturas', 'tipofacturas.id', '=', 'tipo_factura')
                    ->having('oferta', '<', 55000)
                    // ->having('oferta', '>', 40000)
                    ->groupBy('tiendas.slug','tipofacturas.nombre','facturas.precio_oferta')
                    ->orderBy('tiendas.slug')
                    
                    
                    // ->havingRaw('precio_oferta > 55000')
                    ->get();
        // $consulta=DB::select('select tiendas.slug as tienda, tipofacturas.nombre as tipo from facturas JOIN tiendas ON tiendas.id = facturas.id_tienda JOIN  tipofacturas on tipofacturas.id = tipo_factura where id_tienda = 1 group by tiendas.slug,tipo_factura ORDER BY tiendas.slug');
        // $consulta=DB::table('facturas')->select('tiendas.slug as tienda, tipofacturas.nombre as tipo,ROUND(SUM(total), -1) AS total from facturas JOIN tiendas ON tiendas.id = facturas.id_tienda JOIN  tipofacturas on tipofacturas.id = tipo_factura where id_tienda = 1 AND facturas.created_at  BETWEEN 2018-05-1 16:55:00 AND 2018-05-31 16:55:00  group by tiendas.slug,tipo_factura ORDER BY tiendas.slug')->get();
        dd($consulta);
        // $consulta->from('facturas JOIN tiendas ON tiendas.id = facturas.id_tienda')->JOIN('tipofacturas on tipofacturas.id = tipo_factura');
        //  -1) AS total from facturas JOIN tiendas ON tiendas.id = facturas.id_tienda JOIN  tipofacturas on tipofacturas.id = tipo_factura where id_tienda = 1 AND facturas.created_at  BETWEEN 2018-05-1 16:55:00 AND 2018-05-31 16:55:00  group by tiendas.slug,tipo_factura ORDER BY tiendas.slug');
        // $consulta=DB::select('select tiendas.slug as tienda, tipofacturas.nombre as tipo,ROUND(SUM(total), -1) AS total from facturas JOIN tiendas ON tiendas.id = facturas.id_tienda JOIN  tipofacturas on tipofacturas.id = tipo_factura where id_tienda = 1 AND facturas.created_at  BETWEEN '. $fecha1 .' AND '. $fecha2.  ' group by tiendas.slug,tipo_factura ORDER BY tiendas.slug');
        // dd($consulta);
        // select('select * from books where 1');
        // SELECT (tiendas.slug as 'tienda', tipofacturas.nombre as 'tipo',ROUND(SUM(total), -1) AS 'total' from facturas JOIN tiendas ON tiendas.id = facturas.id_tienda JOIN  tipofacturas on tipofacturas.id = tipo_factura where id_tienda = 1 AND facturas.created_at  BETWEEN $fecha1 AND $fecha2  group by tiendas.slug,tipo_factura ORDER BY tiendas.slug)->get();



        // DB::raw('ROUND(SUM(total), -1) as total')

            // $consulta_detal = facturas::where('tipo_factura',1)
            // ->whereDate('created_at','>=',$fecha1)
            // ->whereDate('created_at','<=',$fecha2)->get();
            
            // for ($i = 0; $i < count($consulta_detal); $i++) {
            //     if($consulta_detal[$i]['precio_oferta']>=72000){
            //         $detal_alto[]=$consulta_detal[$i];
            //     }
            //     elseif($consulta_detal[$i]['precio_oferta']<72000){
            //         $detal_bajo[]=$consulta_detal[$i];
            //     }
            // }
            // for ($i = 0; $i < count($consulta_detal); $i++) {
            //         $id_tienda_detal[]=$consulta_detal[$i]['id_tienda'];    
            //     }
            // $id_tienda_detal=array_values(array_unique($id_tienda_detal));
            
            // for ($i = 0; $i < count($id_tienda_detal); $i++) {

            // }

            // $consulta_mayor = facturas::where('tipo_factura',2)
            // ->whereDate('created_at','>=',$fecha1)
            // ->whereDate('created_at','<=',$fecha2)->get();
            
            // dd($consulta_mayor);

            // $consulta_mayor->each(function ($consulta_mayor) {
            //     $consulta_mayor->tiendafactura;
            // });

            // $consulta_menor = facturas::where('id_clasificaciones',4)
            // ->where('precio_oferta','>=',$rango1)
            // ->where('precio_oferta','<=',$rango2)
            // ->whereDate('created_at','>=',$fecha1)
            // ->whereDate('created_at','<=',$fecha2)->get();
            
            // $consulta_menor->each(function ($consulta_menor) {
            //     $consulta_menor->tiendafactura;
            // });

            // if($consulta_mayor=='[]' && $consulta_menor=='[]'){
            //     $respuesta=0;
            //     return Response()->json($respuesta);
            // }

            // $id_tienda_mayor=[];
            // for ($i = 0; $i < count($consulta_mayor); $i++) {
            //     $id_tienda_mayor[]=$consulta_mayor[$i]['id_tienda'];    
            // }
            // $id_tienda_mayor=array_values(array_unique($id_tienda_mayor));
            // // dd($id_tienda_mayor);
            // for ($i = 0; $i < count($id_tienda_mayor); $i++) {
            //     $consulta_mayor_final[] = facturas::where('id_clasificaciones',3)
            //     ->where('id_tienda',$id_tienda_mayor[$i])
            //     ->where('precio_oferta','>=',$rango1)
            //     ->where('precio_oferta','<=',$rango2)
            //     ->whereDate('created_at','>=',$fecha1)
            //     ->whereDate('created_at','<=',$fecha2)->get();
            // }
            // // dd($consulta_mayor_final[0]);
            // $suma=0;
            // for ($i = 0; $i < count($consulta_mayor_final); $i++) {
            //     for ($a = 0; $a < count($consulta_mayor_final[$i]); $a++) {
            //         $suma=$consulta_mayor_final[$i][$a]['precio_oferta']+$suma;
                    
            //     }
            //     $resultado_total[]=$suma;
            // }
            // dd($resultado_total);







            // // CODIGO PARA CUANDO ES AL DETAL
            // $id_tienda_menor_consulta=tiendas::where('grupo',1)->get();
            // $id_tienda_menor=[];
            // for ($i = 0; $i < count($id_tienda_menor_consulta); $i++) {
            //     $id_tienda_menor[]=$id_tienda_menor_consulta[$i]['id'];    
            // }
            // $id_tienda_menor=array_values(array_unique($id_tienda_menor));
            // dd($id_tienda_menor);
            // dd($id_tienda_mayor);
    }
}
