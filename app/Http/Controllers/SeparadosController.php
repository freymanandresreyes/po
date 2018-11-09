<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\configuraciones;
use App\tiposdepagos;
use App\separados;
use App\tiendas;
use App\consecutivos;
use App\clientes;

class SeparadosController extends Controller
{
    public function nuevo_separado(Request $request){
        $tienda = $request->user()->tienda;

        $info_tienda = tiendas::find($tienda);
        $configuraciones = configuraciones::where('tienda', $tienda)->get();
        $bancos = tiposdepagos::all();
        
 
        // dd($nuevafecha);

        return view('separados.index', compact('configuraciones','bancos','info_tienda'));
    }

    public function guardar_modal_apartado(Request $request){
        $tienda = $request->user()->tienda;
        $data = $request->data;
        $cliente = $request->id_cliente;
        $tipo_pago = $request->tipo_pago;
        $cantidad_articulos = count($data);
        $efectivo = $request->efectivo;

        $saldo_tarjeta_uno = $request->saldo_tarjeta_uno;
        $tipo_pago_uno = $request->tipo_pago_uno;
        $bancos_uno = $request->bancos_uno;

        $saldo_tarjeta_dos = $request->saldo_tarjeta_dos;
        $tipo_pago_dos = $request->tipo_pago_dos;
        $bancos_dos = $request->bancos_dos;

        
        $dias = '+'.$request->dias_apartado . ' day';
        $fecha = date('Y-m-j');
        $nuevafecha = strtotime ( $dias , strtotime ( $fecha ) ) ;
        $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
        $encabezado = tiendas::find($tienda);
        $info_cliente = clientes::find($cliente);
        //genera en nuevo consecutio  
        $consecutivo = consecutivos::where('id_tienda', $tienda)
                                     ->where('tag','APART')->get();
        $suma = null;
        foreach ($consecutivo as $value) {
            if($value->consecutivo > $suma){
                $suma = $value->consecutivo;
            }
        }
        $nuevo_consecutivo = new consecutivos;
        $nuevo_consecutivo->id_tienda = $tienda;
        $nuevo_consecutivo->tag = "APART";
        $nuevo_consecutivo->consecutivo = $suma + 1;
        $nuevo_consecutivo->save();

        // dd($nuevo_consecutivo);


        // TIPOS DE PAGO
        // [1] EFECTIVO
        // [2] TARJETA
        // [3] MIXTO TARJETA EFECTIVO
        // [4] MIXTO TARJETA TARJETA

        for ($i=0; $i < count($data); $i++) { 
            $nuevo = new separados;
            $nuevo->id_tienda = $tienda;
            $nuevo->id_cliente = $cliente;
            $nuevo->id_producto = $data[$i][1];
            $nuevo->precio_producto = $data[$i][5];
            $nuevo->tipo_pago = $tipo_pago;
            if($tipo_pago == 1){
                $nuevo->pago_efectivo = $efectivo/$cantidad_articulos;
            }
            if($tipo_pago == 2){
                $nuevo->pago_tarjeta_uno = $saldo_tarjeta_uno/$cantidad_articulos;
                $nuevo->id_clase_pago = $tipo_pago_uno;
                $nuevo->id_franquicia = $bancos_uno;
            }
            if($tipo_pago == 3){
                $nuevo->pago_efectivo = $efectivo/$cantidad_articulos;
                $nuevo->pago_tarjeta_uno = $saldo_tarjeta_uno/$cantidad_articulos;
                $nuevo->id_clase_pago = $tipo_pago_uno;
                $nuevo->id_franquicia = $bancos_uno;
            }
            if($tipo_pago == 4){
        
                $nuevo->pago_tarjeta_uno = $saldo_tarjeta_uno/$cantidad_articulos;
                $nuevo->id_clase_pago = $tipo_pago_uno;
                $nuevo->id_franquicia = $bancos_uno;
                
                $nuevo->pago_tarjeta_dos = $saldo_tarjeta_dos/$cantidad_articulos;
                $nuevo->id_clase_pago_dos = $tipo_pago_dos;
                $nuevo->id_franquicia_dos = $bancos_dos;
            }
            $nuevo->fecha_vencimiento = $nuevafecha;
            $nuevo->precio_detal = $data[$i][6];
            $nuevo->precio_mayorista = $data[$i][7];
            $nuevo->estado = 0;
            $nuevo->consecutivo = $nuevo_consecutivo->tag.'-'.$nuevo_consecutivo->consecutivo;
            $nuevo->save();
            // dd($nuevo);
    
        }
        // dd($data);
        return response()->json(view('separados.parciales.factura', compact(
            'nuevo_consecutivo',
            'encabezado',
            'info_cliente',
            'data'
            ))->render());
        

    }

    /******************* BUSQUEDA SI EL CLIENTE TIENE UN SEPARADO *************** */

    public function buscar_apartado_caja(Request $request){
        $id_cliente = $request->id_cliente;
        $tienda = $request->user()->tienda;
        $buscar = separados::where('id_tienda', $tienda)
                            ->where('id_cliente',$id_cliente)
                            ->where('estado', 0)->get();
        $buscar->each(function($buscar){
            $buscar->productosSeparados;
        });
        return response()->json($buscar);
    }

    public function ver_separados(Request $request){
        $tienda = $request->user()->tienda;
        $consulta=separados::where('id_tienda',$tienda)->get();
        $consulta->each(function($consulta){
        $consulta->codigoproducto;
        $consulta->clienteseparados;
        // $consulta->siyno;
        // $consulta->clasificacion;
      });
        // dd($consulta);
        //return $consulta;
        $id_tienda = $request->user()->tienda;
        $tienda = tiendas::where('id', $id_tienda)->select('nombre_tienda', 'encargado','nit_tienda','direccion_tienda','ciudad','logo')->first();
        return view('ver_separados.ver_separados', compact('consulta', 'tienda'));
    }

    public function visualizar_apartado(Request $request){
        
       $separados = Separados::where([['consecutivo', $request->consecutivo],['id_tienda',$request->user()->tienda]])->get();
       $separados->each(function($separados){ 
       $separados->clienteseparados;
       $separados->codigoproducto;
       }); 
       return $separados;
    }
}
