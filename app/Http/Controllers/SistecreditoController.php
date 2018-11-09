<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AbonoSistecredito;
use App\facturas;
use App\clientes;
use Illuminate\Support\Facades\DB;

class SistecreditoController extends Controller
{
    public function consultar_facturas_sistecredito(){

        return view('sistecredito.registrar_abono');
    }

    public function buscar_facturas_sistecredito(Request $request){
        //retornar el id del cliente buscando por su documento
        $info_cliente = clientes::where('documento','=', $request->cliente)->select('documento','id','nombres','apellidos','telefono')->first();
        //Retornar las facturas de un cliente especifico que tenga un saldo pendiente con sistecredito
        if(!empty($info_cliente)){ 
        $facturas_cliente = DB::table('facturas')
        ->select('n_factura',DB::raw('ROUND(SUM(pago_sistecredito),0) AS saldo_sistecredito'))
        ->where([['id_cliente', $info_cliente->id],['pago_sistecredito', '>', 0]])->groupBy('n_factura')->get();
        //Verificar que el cliente haya hecho pagos con sistecredito
        if(!empty($facturas_cliente)){

        return [ 
                'facturas_cliente' => $facturas_cliente,
                'cliente' => $info_cliente,
              ];
        }else{
            $message = 'El cliente no ha realizado pagos con sistecredito';
            return ['message' => $message];
        }
    }else{
        $message = 'No existe un cliente con ese documento';
        return ['message' => $message];
    }
        
    }

    public function buscar_abonos_factura_sistecredito(Request $request){
        //Buscar los abonos realizados a una factura especifica de un cliente especifico
        $abonosFactura = DB::table('abono_sistecredito')
        ->select(DB::raw('FORMAT(ROUND(valor), 2) AS valor'),'created_at','tipo_pago')
        ->where([['id_cliente','=', $request->id_cliente],['n_factura','=', $request->n_factura]])->get();
        //Retornar el valor total de abonos por factura y cliente
         $total_abonos = DB::table('abono_sistecredito')
        ->select(DB::raw('ROUND(SUM(valor),2) AS total_abonos'))
        ->where([['id_cliente','=', $request->id_cliente],['n_factura','=', $request->n_factura]])->first();
        return [
                 'abonosFactura' => $abonosFactura,
                 'total_abonos'  => $total_abonos->total_abonos
               ];
    }

    public function abonar_factura_sistecredito(Request $request){
        
        $data = request()->validate([
                'id_cliente'    => 'required',
                'n_factura'     => 'required',
                'valor'         => 'required|numeric',
                'forma_pago'    => 'required|numeric'
         ]);
        //Consultar saldo total de la factura del cliente
        $saldo_sistecredito_factura = DB::table('facturas')
        ->select(DB::raw('ROUND(SUM(pago_sistecredito),0) AS saldo_sistecredito'))
        ->where([['id_cliente', $request->id_cliente],['n_factura', $request->n_factura]])->first();
        //Consultar el total de abonos realizados a la factura de el cliente
        $total_abonos = DB::table('abono_sistecredito')
        ->select(DB::raw('ROUND(SUM(valor),0) AS total_abonos'))
        ->where([['id_cliente', $request->id_cliente],['n_factura', $request->n_factura]])->first();
        //Validar que el valor del abono sea mayor a 0 y menor al saldo total de la factura
        if($request->valor > 0 && $request->valor <= ($saldo_sistecredito_factura->saldo_sistecredito - $total_abonos->total_abonos)){
            //Registrar el abono a la factura del cliente
            $abono = new AbonoSistecredito();
            $abono->id_cliente = $request->id_cliente;
            $abono->id_tienda = $request->user()->tienda;
            $abono->n_factura = $request->n_factura;
            $abono->valor = $request->valor;
            $abono->tipo_pago = $request->forma_pago;
            $abono->save();
        }
        return;
        

    }

    public function informe_sistecredito(){

        return view('sistecredito.informe');
    }

    public function total_abonos_factura_sistecredito(Request $request){
        //Consultar el total de abonos realizados a la factura de el cliente
        $total_abonos = DB::table('abono_sistecredito')
        ->select(DB::raw('ROUND(SUM(valor),0) AS total_abonos'))
        ->where([['id_cliente', $request->id_cliente],['n_factura', $request->n_factura]])->first();
        
        return $total_abonos->total_abonos;
    }
}
