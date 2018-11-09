<?php

namespace App\Http\Controllers;

use App\compras;
use App\entradamenor;
use App\facturas;
use App\Http\Controllers\Controller;
use App\salidamenor;
use App\separados;
use App\tiendas;
use App\zonas;
use DB;
use App\AbonoSistecredito;
use App\Quotation;
use Illuminate\Http\Request;

global $estado;
class InformesController extends Controller
{
    public function informes()
    {
        return view('informes.grafica');
    }

    public function info_ventas(Request $request)
    {
        $zonas = zonas::all();
        $lista_tiendas = tiendas::all();
        // dd($lista_tiendas);
        return view('informes.diario', compact('lista_tiendas', 'zonas'));
    }
    // }
    public function tiendas_zonas(Request $request)
    {
        $zona = $request->zona;
        $consulta = tiendas::where('id_zona', $zona)->get();

        return response()->json(view('informes.parciales.tiendas_infor_diario', compact('consulta'))->render());
    }

    public function generar_informe(Request $request)
    {
        $zonas = zonas::all();
        $lista_tiendas = tiendas::all();
        // dd('ok');
        $tienda = $request->diario_tienda;
        $pago = $request->diario_pago;
        $fecha1 = $request->diario_inicio;
        $fecha2 = $request->diario_fin;
        $consulta_tiendas = tiendas::find($tienda);

            if ($fecha1 != null && $fecha2 != null && $tienda != null && $pago != null) {
                // dd("hhh");
                if ($pago == 0) {
                    $busqueda = facturas::where('id_tienda', $tienda)
                        ->where('facturacion','!=',3)
                        ->whereDate('created_at', '>=', $fecha1)->whereDate('created_at', '<=', $fecha2)->get();
                    $busqueda->each(function ($busqueda) {
                        $busqueda->clientesfactura;
                    });
                } else {
                    $busqueda = facturas::where('id_tienda', $tienda)
                        ->where('tipo_compra', $pago)
                        ->whereDate('created_at', '>=', $fecha1)->whereDate('created_at', '<=', $fecha2)->get();
                    $busqueda->each(function ($busqueda) {
                        $busqueda->clientesfactura;
                    });
                }
                // dd($busqueda[0]->clientesfactura->nombres);
                // almacenamos todos los consecutivos
                $facturas_consecutivo = [];
                foreach ($busqueda as $value) {
                    $facturas_consecutivo[] = $value->n_factura;
                }
                //eliminamos las facturas duplicadas
                $consecutivos = array_unique($facturas_consecutivo);
                //reordenamos los valores
                $lista_consecutivos = [];
                foreach ($consecutivos as $value) {
                    $lista_consecutivos[] = $value;
                }

                // dd($lista_consecutivos);
                //    contamos los registros
                //variables
                $objeto_final = [];
                $objeto = [];
                $var_precio = [];
                $precio_total = null;
                $precio_base = null;
                $precio_iva = null;
                $numero_factura = null;
                $fecha = null;
                $codigo = null;
                $nombre = null;
                $id_producto = null;

                for ($i = 0; $i < count($lista_consecutivos); $i++) {
                    foreach ($busqueda as $value) {
                        if ($lista_consecutivos[$i] == $value->n_factura) {
                            $precio_total = $precio_total + $value->total;
                            $numero_factura = $value->n_factura;
                            $fecha = $value->created_at->format('d/m/Y');
                            $codigo = $value->clientesfactura->documento;
                            $nombre = $value->clientesfactura->nombres;
                            $id_producto = $value->id;
                        }
                    } //fin foreach
                    $var_precio[] = $precio_total;
                    $precio_base = $precio_total / 1.19;
                    $precio_iva = $precio_total - $precio_base;
                    $objeto[] = $numero_factura;
                    $objeto[] = $fecha;
                    $objeto[] = $codigo;
                    $objeto[] = $nombre;
                    $objeto[] = round($precio_base);
                    $objeto[] = round($precio_iva);
                    $objeto[] = $precio_total;
                    $objeto[] = $id_producto;
                    $objeto_final[] = $objeto;
                    $objeto = null;

                    $precio_total = null;
                } //fin primer for
                // dd($objeto_final);
                // return response->json(["message" => "Model status successfully updated!", "data" => $model->toJson()], 200);
                // return response()->json(view('informes.parciales.info_1', compact('objeto_final', 'consulta_tiendas', 'fecha1', 'fecha2'))->render());
                return view('informes.diario', compact('lista_tiendas', 'zonas','objeto_final', 'consulta_tiendas', 'fecha1', 'fecha2'));
            }else{
                return view('informes.diario', compact('lista_tiendas', 'zonas'));

            }
            
      

    }

    public function info_diario(Request $request)
    {
        $zonas = zonas::all();
        $tienda = $request->user()->tienda;
        $info_tienda = tiendas::find($tienda);
        return view('informes.diario_caja', compact('info_tienda', 'zonas'));
    }

    public function generar_informe_diario(Request $request)
    {
        // dd('f');
        $tienda = $request->User()->tienda;
        $fecha1 = $request->fecha_inicio;
        $fecha2 = $request->fecha_fin;

        if ($request->ajax()) {

            if ($fecha1 != null && $fecha2 != null) {
                // dd("hhh");
                $busqueda = facturas::where('estado', '==', 0)
                    ->where('id_tienda', $tienda)
                    ->where('facturacion','!=',3)
                    ->whereDate('created_at', '>=', $fecha1)->whereDate('created_at', '<=', $fecha2)->get();
                $busqueda->each(function ($busqueda) {
                    $busqueda->clientesfactura;
                });

                // dd($consultacajamenor[0]->entradamenor);
                $consultaentradas = entradamenor::where('tiendas_id', $tienda)
                    ->whereDate('created_at', '>=', $fecha1)->whereDate('created_at', '<=', $fecha2)->get();

                $consultasalidas = salidamenor::where('tiendas_id', $tienda)
                    ->whereDate('created_at', '>=', $fecha1)->whereDate('created_at', '<=', $fecha2)->get();

                $apartado = separados::where('id_tienda', $tienda)
                    ->whereDate('created_at', '>=', $fecha1)->whereDate('created_at', '<=', $fecha2)->get();

                $totalentradas = 0;
                for ($i = 0; $i < count($consultaentradas); $i++) {
                    $totalentradas = $consultaentradas[$i]['entrada'] + $totalentradas;
                }

                $totalsalidas = 0;
                for ($i = 0; $i < count($consultasalidas); $i++) {
                    $totalsalidas = $consultasalidas[$i]['salida'] + $totalsalidas;
                }

                // almacenamos todos los consecutivos
                $facturas_consecutivo = [];
                foreach ($busqueda as $value) {
                    $facturas_consecutivo[] = $value->n_factura;
                }
                //eliminamos las facturas duplicadas
                $consecutivos = array_unique($facturas_consecutivo);
                //reordenamos los valores
                $lista_consecutivos = [];
                foreach ($consecutivos as $value) {
                    $lista_consecutivos[] = $value;
                }
                // almacenamos todos los consecutivos apartados
                $consecutivo_apartado = [];
                foreach ($apartado as $value) {
                    $consecutivo_apartado[] = $value->consecutivo;
                }

                //eliminamos las facturas duplicadas
                $consecutivos_orden_apartado = array_unique($consecutivo_apartado);
                //reordenamos los valores
                $lista_consecutivos_apartado = [];
                foreach ($consecutivos_orden_apartado as $value) {
                    $lista_consecutivos_apartado[] = $value;
                }

                // dd($lista_consecutivos_apartado);
                // dd($lista_consecutivos);
                //    contamos los registros
                //variables
                $objeto_final = [];
                $objeto = [];
                $var_precio = [];
                $precio_total = null;
                $precio_base = null;
                $precio_iva = null;
                $numero_factura = null;
                $fecha = null;
                $codigo = null;
                $nombre = null;
                $tipo_pago = null;
                $pago_efectivo = null;
                $pago_tarjeta = null;
                $pago_tarjeta_dos = null;
                $pago_abono = null;
                $pago_sistecredito = null;
                // dd($busqueda);
                for ($i = 0; $i < count($lista_consecutivos); $i++) {
                    foreach ($busqueda as $value) {
                        if ($lista_consecutivos[$i] == $value->n_factura) {
                            $precio_total = $precio_total + $value->total;
                            $numero_factura = $value->n_factura;
                            $fecha = $value->created_at->format('d/m/Y');
                            $codigo = $value->clientesfactura->documento;
                            $nombre = $value->clientesfactura->nombres;
                            $tipo_pago = $value->tipo_compra;
                            $pago_efectivo = $pago_efectivo + $value->pago_efectivo;
                            $pago_tarjeta = $pago_tarjeta + $value->pago_tarjeta;
                            $pago_tarjeta_dos = $pago_tarjeta_dos + $value->pago_tarjeta_dos;
                            $pago_abono = $pago_abono + $value->pago_abono;
                            $pago_sistecredito = $pago_sistecredito + $value->pago_sistecredito;
                        }
                    } //fin foreach
                    $var_precio[] = $precio_total;
                    $precio_base = $precio_total / 1.19;
                    $precio_iva = $precio_total - $precio_base;
                    $objeto[] = $numero_factura; //0
                    $objeto[] = $fecha; //1
                    $objeto[] = $codigo; //2
                    $objeto[] = $nombre; //3
                    $objeto[] = round($precio_base); //4
                    $objeto[] = round($precio_iva); //5
                    $objeto[] = $precio_total; //6
                    $objeto[] = $tipo_pago; //7
                    $objeto[] = $pago_efectivo; //8
                    $objeto[] = $pago_tarjeta; //9
                    $objeto[] = $pago_tarjeta_dos; //10
                    $objeto[] = $pago_abono; //11
                    $objeto[] = $pago_sistecredito; //12
                    $objeto_final[] = $objeto;
                    $objeto = null;

                    $precio_total = null;
                    $pago_efectivo = null;
                    $pago_tarjeta = null;
                    $pago_tarjeta_dos = null;
                    $pago_abono = null;
                    $pago_sistecredito = null;

                    // dd($objeto_final);
                } //fin primer for
                // *******************************************
                // ---------  CICLO DE APARTADOS  ------------
                //********************************************
                $objeto_final_apartado = [];
                $objeto_apartado = [];
                $numero_factura_apartado = null;
                $fecha_apartado = null;
                $pago_efectivo_apartado = null;
                $pago_tarjeta_apartado = null;
                $pago_tarjeta_dos_apartado = null;
                // $pago_sistecredito = null;
                // dd($busqueda);
                for ($i = 0; $i < count($lista_consecutivos_apartado); $i++) {
                    foreach ($apartado as $value) {
                        if ($lista_consecutivos_apartado[$i] == $value->consecutivo) {
                            $numero_factura_apartado = $value->consecutivo;
                            $fecha_apartado = $value->created_at->format('d/m/Y');
                            $pago_efectivo_apartado = $pago_efectivo_apartado + $value->pago_efectivo;
                            $pago_tarjeta_apartado = $pago_tarjeta_apartado + $value->pago_tarjeta_uno;
                            $pago_tarjeta_dos_apartado = $pago_tarjeta_dos_apartado + $value->pago_tarjeta_dos;
                            // $pago_sistecredito = $pago_sistecredito + $value->pago_sistecredito;
                        }
                    } //fin foreach
                    $objeto_apartado[] = $numero_factura_apartado; //0
                    $objeto_apartado[] = $fecha_apartado; //1
                    $objeto_apartado[] = $pago_efectivo_apartado; //2
                    $objeto_apartado[] = $pago_tarjeta_apartado; //3
                    $objeto_apartado[] = $pago_tarjeta_dos_apartado; //4
                    $objeto_final_apartado[] = $objeto_apartado;
                    $objeto_apartado = null;

                    $numero_factura_apartado = null;
                    $fecha_apartado = null;
                    $pago_efectivo_apartado = null;
                    $pago_tarjeta_apartado = null;
                    $pago_tarjeta_dos_apartado = null;
                    // dd($objeto_final);
                } //fin primer for

                // totales
                // dd($objeto_final);
                //TOTAL VENTA DIARIA
                $total_venta_diaria = 0;
                for ($i = 0; $i < count($objeto_final); $i++) {
                    $total_venta_diaria = $total_venta_diaria + $objeto_final[$i][6];
                }
                //TOTAL VENTA DIARIA EFECTIVO
                $total_venta_diaria_efectivo = 0;
                for ($i = 0; $i < count($objeto_final); $i++) {
                    $total_venta_diaria_efectivo = $total_venta_diaria_efectivo + $objeto_final[$i][8];
                }
                //TOTAL VENTA DIARIA TARJETA
                $total_venta_diaria_tarjeta_uno = 0;
                $total_venta_diaria_tarjeta_dos = 0;
                for ($i = 0; $i < count($objeto_final); $i++) {
                    $total_venta_diaria_tarjeta_uno = $total_venta_diaria_tarjeta_uno + $objeto_final[$i][9];
                    $total_venta_diaria_tarjeta_dos = $total_venta_diaria_tarjeta_dos + $objeto_final[$i][10];
                }
                
                $total_tarjetas = $total_venta_diaria_tarjeta_uno + $total_venta_diaria_tarjeta_dos;
                //TOTAL VENTA DIARIA ABONO
                // dd($objeto_final[0]);
                $total_venta_diaria_abono = 0;
                for ($i = 0; $i < count($objeto_final); $i++) {
                    // $consulta=devoluciones::where('',)->get()
                    $total_venta_diaria_abono = $total_venta_diaria_abono + floatval($objeto_final[$i][11]);
                }
                /******************************** */
                //TOTAL TARJETAS
                $total_pago_tarjeta = null;
                $total_pago_tarjeta_uno = null;
                $total_pago_tarjeta_dos = null;
                $total_pago_tarjeta_abono = null;
                for ($i = 0; $i < count($objeto_final); $i++) {
                    if ($objeto_final[$i][7] == 2 || $objeto_final[$i][7] == 4) {
                        $total_pago_tarjeta = $total_pago_tarjeta + $objeto_final[$i][6];
                        $total_pago_tarjeta_uno = $total_pago_tarjeta_uno + $objeto_final[$i][9];
                        $total_pago_tarjeta_dos = $total_pago_tarjeta_dos + $objeto_final[$i][10];
                        $total_pago_tarjeta_abono = $total_pago_tarjeta_abono + $objeto_final[$i][11];
                    }

                }
                $total_pago_tarjeta_total = $total_pago_tarjeta_uno + $total_pago_tarjeta_dos;

                /**************************** */
                /**  TOTAL EFECTIVO */
                $total_pago_efectivo = null;
                $total_pago_efectivo_efectivo = null;
                $total_pago_efectivo_abono = null;

                for ($i = 0; $i < count($objeto_final); $i++) {
                    if ($objeto_final[$i][7] == 1) {
                        $total_pago_efectivo = $total_pago_efectivo + $objeto_final[$i][6];
                        $total_pago_efectivo_efectivo = $total_pago_efectivo_efectivo + $objeto_final[$i][8];
                        $total_pago_efectivo_abono = $total_pago_efectivo_abono + $objeto_final[$i][11];
                    }

                }
                /******************************** */
                /** TOTAL MIXTO */
                $total_pago_mixto = null;
                $total_pago_mixto_efectivo = null;
                $total_pago_mixto_tarjeta = null;
                $total_pago_mixto_abono = null;
                for ($i = 0; $i < count($objeto_final); $i++) {
                    if ($objeto_final[$i][7] == 3) {
                        $total_pago_mixto = $total_pago_mixto + $objeto_final[$i][6];
                        $total_pago_mixto_efectivo = $total_pago_mixto_efectivo + $objeto_final[$i][8];
                        $total_pago_mixto_tarjeta = $total_pago_mixto_tarjeta + $objeto_final[$i][9];
                        $total_pago_mixto_abono = $total_pago_mixto_abono + $objeto_final[$i][11];
                    }
                    
                }
                /**************************** */
                /**  TOTAL APARTADOS */
                $total_pago_efectivo_apartado = null;
                $tarjeta_apartado_uno = null;
                $tarjeta_apartado_dos = null;
                // dd($objeto_final_apartado);
                for ($i = 0; $i < count($objeto_final_apartado); $i++) {
                    
                    $total_pago_efectivo_apartado = $total_pago_efectivo_apartado + $objeto_final_apartado[$i][2];
                    $tarjeta_apartado_uno = $tarjeta_apartado_uno + $objeto_final_apartado[$i][3];
                    $tarjeta_apartado_dos = $tarjeta_apartado_dos + $objeto_final_apartado[$i][4];
                    
                }

                //TOTAL VENTA SISTECREDITO
                $total_venta_diaria_sistecredito = 0;
                for ($i = 0; $i < count($objeto_final); $i++) {
                    $total_venta_diaria_sistecredito = $total_venta_diaria_sistecredito + $objeto_final[$i][12];
                }
               
                $total_pago_tarjeta_apartado = $tarjeta_apartado_uno + $tarjeta_apartado_dos;
                // dd($total_pago_mixto);
                // dd($total_pago_tarjeta_apartado);
                $totales_tarjetas=$total_pago_tarjeta+$total_pago_tarjeta_apartado;
                // dd($total_pago_mixto_tarjeta);
                // return response()->json($busqueda);
                return response()->json(view('informes.parciales.info_2', compact('objeto_final', 'total_venta_diaria', 'total_pago_tarjeta','totales_tarjetas', 'total_pago_efectivo',
                    'consultasalidas',
                    'consultaentradas',
                    'totalentradas',
                    'totalsalidas',
                    'total_pago_mixto',
                    'total_pago_mixto_efectivo',
                    'total_pago_mixto_tarjeta',
                    'total_venta_diaria_efectivo',
                    'total_tarjetas',
                    'total_venta_diaria_abono',
                    'lista_consecutivos',
                    //total tarjeta
                    'total_pago_tarjeta_total',
                    'total_pago_tarjeta_abono',
                    //total efectivo
                    'total_pago_efectivo_efectivo',
                    'total_pago_efectivo_abono',
                    //total mixto
                    'total_pago_mixto_abono',
                    //APARTADOS
                    'objeto_final_apartado',
                    'total_pago_tarjeta_apartado',
                    'total_pago_efectivo_apartado',
                    //total sistecredito
                    'total_venta_diaria_sistecredito'


                ))->render());
            }

        }
    }

    //METODO PARA IMPRIMIR INFORME DIARIO

    public function informe_diario_imprimir(Request $request)
    {
        $tienda = $request->User()->tienda;
        $fecha1 = $request->fecha_inicio;
        $fecha2 = $request->fecha_fin;

        $encabezado = tiendas::find($tienda);

        if ($request->ajax()) {

            if ($fecha1 != null && $fecha2 != null) {
                // dd("hhh");
                $busqueda = facturas::where('estado', '==', 0)
                    ->where('id_tienda', $tienda)
                    ->where('facturacion','!=',3)
                    ->whereDate('created_at', '>=', $fecha1)->whereDate('created_at', '<=', $fecha2)->get();
                $busqueda->each(function ($busqueda) {
                    $busqueda->clientesfactura;
                });

// dd($consultacajamenor[0]->entradamenor);
                $consultaentradas = entradamenor::where('tiendas_id', $tienda)
                    ->whereDate('created_at', '>=', $fecha1)->whereDate('created_at', '<=', $fecha2)->get();

                $consultasalidas = salidamenor::where('tiendas_id', $tienda)
                    ->whereDate('created_at', '>=', $fecha1)->whereDate('created_at', '<=', $fecha2)->get();

                $apartado = separados::where('id_tienda', $tienda)
                    ->whereDate('created_at', '>=', $fecha1)->whereDate('created_at', '<=', $fecha2)->get();

                $totalentradas = 0;
                for ($i = 0; $i < count($consultaentradas); $i++) {
                    $totalentradas = $consultaentradas[$i]['entrada'] + $totalentradas;
                }

                $totalsalidas = 0;
                for ($i = 0; $i < count($consultasalidas); $i++) {
                    $totalsalidas = $consultasalidas[$i]['salida'] + $totalsalidas;
                }

                // almacenamos todos los consecutivos
                $facturas_consecutivo = [];
                foreach ($busqueda as $value) {
                    $facturas_consecutivo[] = $value->n_factura;
                }
                //eliminamos las facturas duplicadas
                $consecutivos = array_unique($facturas_consecutivo);
                //reordenamos los valores
                $lista_consecutivos = [];
                foreach ($consecutivos as $value) {
                    $lista_consecutivos[] = $value;
                }

                // almacenamos todos los consecutivos apartados
                $consecutivo_apartado = [];
                foreach ($apartado as $value) {
                    $consecutivo_apartado[] = $value->consecutivo;
                }

                //eliminamos las facturas duplicadas
                $consecutivos_orden_apartado = array_unique($consecutivo_apartado);
                //reordenamos los valores
                $lista_consecutivos_apartado = [];
                foreach ($consecutivos_orden_apartado as $value) {
                    $lista_consecutivos_apartado[] = $value;
                }

                // dd($lista_consecutivos);
                //    contamos los registros
                //variables
                $objeto_final = [];
                $objeto = [];
                $var_precio = [];
                $precio_total = null;
                $precio_base = null;
                $precio_iva = null;
                $numero_factura = null;
                $fecha = null;
                $codigo = null;
                $nombre = null;
                $tipo_pago = null;
                $pago_efectivo = null;
                $pago_tarjeta = null;
                $pago_tarjeta_dos = null;
                $pago_abono = null;
                $pago_sistecredito = null;

                for ($i = 0; $i < count($lista_consecutivos); $i++) {
                    foreach ($busqueda as $value) {
                        if ($lista_consecutivos[$i] == $value->n_factura) {
                            $precio_total = $precio_total + $value->total;
                            $numero_factura = $value->n_factura;
                            $fecha = $value->created_at->format('d/m/Y');
                            $codigo = $value->clientesfactura->documento;
                            $nombre = $value->clientesfactura->nombres;
                            $tipo_pago = $value->tipo_compra;
                            $pago_efectivo = $pago_efectivo + $value->pago_efectivo;
                            $pago_tarjeta = $pago_tarjeta + $value->pago_tarjeta;
                            $pago_tarjeta_dos = $pago_tarjeta_dos + $value->pago_tarjeta_dos;
                            $pago_abono = $pago_abono + $value->pago_abono;
                            $pago_sistecredito = $pago_sistecredito + $value->pago_sistecredito;

                        }
                    } //fin foreach
                    $var_precio[] = $precio_total;
                    $precio_base = $precio_total / 1.19;
                    $precio_iva = $precio_total - $precio_base;
                    $objeto[] = $numero_factura;
                    $objeto[] = $fecha;
                    $objeto[] = $codigo;
                    $objeto[] = $nombre;
                    $objeto[] = round($precio_base);
                    $objeto[] = round($precio_iva);
                    $objeto[] = $precio_total;
                    $objeto[] = $tipo_pago;
                    $objeto[] = $pago_efectivo;
                    $objeto[] = $pago_tarjeta;
                    $objeto[] = $pago_tarjeta_dos; //10
                    $objeto[] = $pago_abono; //11
                    $objeto[] = $pago_sistecredito; //12
                    $objeto_final[] = $objeto;
                    $objeto = null;

                    $precio_total = null;
                    $pago_efectivo = null;
                    $pago_tarjeta = null;
                    $pago_tarjeta_dos = null;
                    $pago_abono = null;
                    $pago_sistecredito = null;

                } //fin primer for
                // totales
                // dd($objeto_final);

                // *******************************************
                // ---------  CICLO DE APARTADOS  ------------
                //********************************************
                $objeto_final_apartado = [];
                $objeto_apartado = [];
                $numero_factura_apartado = null;
                $fecha_apartado = null;
                $pago_efectivo_apartado = null;
                $pago_tarjeta_apartado = null;
                $pago_tarjeta_dos_apartado = null;
                // dd($busqueda);
                for ($i = 0; $i < count($lista_consecutivos_apartado); $i++) {
                    foreach ($apartado as $value) {
                        if ($lista_consecutivos_apartado[$i] == $value->consecutivo) {
                            $numero_factura_apartado = $value->consecutivo;
                            $fecha_apartado = $value->created_at->format('d/m/Y');
                            $pago_efectivo_apartado = $pago_efectivo_apartado + $value->pago_efectivo;
                            $pago_tarjeta_apartado = $pago_tarjeta_apartado + $value->pago_tarjeta_uno;
                            $pago_tarjeta_dos_apartado = $pago_tarjeta_dos_apartado + $value->pago_tarjeta_dos;
                        }
                    } //fin foreach
                    $objeto_apartado[] = $numero_factura_apartado; //0
                    $objeto_apartado[] = $fecha_apartado; //1
                    $objeto_apartado[] = $pago_efectivo_apartado; //2
                    $objeto_apartado[] = $pago_tarjeta_apartado; //3
                    $objeto_apartado[] = $pago_tarjeta_dos_apartado; //4
                    $objeto_final_apartado[] = $objeto_apartado;
                    $objeto_apartado = null;

                    $numero_factura_apartado = null;
                    $fecha_apartado = null;
                    $pago_efectivo_apartado = null;
                    $pago_tarjeta_apartado = null;
                    $pago_tarjeta_dos_apartado = null;
                    // dd($objeto_final);
                } //fin primer for
                // totales

                //TOTAL VENTA DIARIA
                $total_venta_diaria = 0;
                for ($i = 0; $i < count($objeto_final); $i++) {
                    $total_venta_diaria = $total_venta_diaria + $objeto_final[$i][6];
                }
                //TOTAL VENTA DIARIA EFECTIVO
                $total_venta_diaria_efectivo = 0;
                for ($i = 0; $i < count($objeto_final); $i++) {
                    $total_venta_diaria_efectivo = $total_venta_diaria_efectivo + $objeto_final[$i][8];
                }
                //TOTAL VENTA DIARIA TARJETA
                $total_venta_diaria_tarjeta_uno = 0;
                $total_venta_diaria_tarjeta_dos = 0;
                for ($i = 0; $i < count($objeto_final); $i++) {
                    $total_venta_diaria_tarjeta_uno = $total_venta_diaria_tarjeta_uno + $objeto_final[$i][9];
                    $total_venta_diaria_tarjeta_dos = $total_venta_diaria_tarjeta_dos + $objeto_final[$i][10];
                }
                $total_tarjetas = $total_venta_diaria_tarjeta_uno + $total_venta_diaria_tarjeta_dos;
                //TOTAL VENTA DIARIA ABONO
                $total_venta_diaria_abono = 0;
                for ($i = 0; $i < count($objeto_final); $i++) {

                    $total_venta_diaria_abono = $total_venta_diaria_abono + floatval($objeto_final[$i][11]);
                }
                /******************************** */
                //TOTAL TARJETAS
                $total_pago_tarjeta = null;
                $total_pago_tarjeta_uno = null;
                $total_pago_tarjeta_dos = null;
                $total_pago_tarjeta_abono = null;
                for ($i = 0; $i < count($objeto_final); $i++) {
                    if ($objeto_final[$i][7] == 2 || $objeto_final[$i][7] == 4) {
                        $total_pago_tarjeta = $total_pago_tarjeta + $objeto_final[$i][6];
                        $total_pago_tarjeta_uno = $total_pago_tarjeta_uno + $objeto_final[$i][9];
                        $total_pago_tarjeta_dos = $total_pago_tarjeta_dos + $objeto_final[$i][10];
                        $total_pago_tarjeta_abono = $total_pago_tarjeta_abono + $objeto_final[$i][11];
                    }

                }
                $total_pago_tarjeta_total = $total_pago_tarjeta_uno + $total_pago_tarjeta_dos;

                /**************************** */
                /**  TOTAL EFECTIVO */
                $total_pago_efectivo = null;
                $total_pago_efectivo_efectivo = null;
                $total_pago_efectivo_abono = null;

                for ($i = 0; $i < count($objeto_final); $i++) {
                    if ($objeto_final[$i][7] == 1) {
                        $total_pago_efectivo = $total_pago_efectivo + $objeto_final[$i][6];
                        $total_pago_efectivo_efectivo = $total_pago_efectivo_efectivo + $objeto_final[$i][8];
                        $total_pago_efectivo_abono = $total_pago_efectivo_abono + $objeto_final[$i][11];
                    }

                }
                /******************************** */
                /** TOTAL MIXTO */
                $total_pago_mixto = null;
                $total_pago_mixto_efectivo = null;
                $total_pago_mixto_tarjeta = null;
                $total_pago_mixto_abono = null;
                for ($i = 0; $i < count($objeto_final); $i++) {
                    if ($objeto_final[$i][7] == 3) {
                        $total_pago_mixto = $total_pago_mixto + $objeto_final[$i][6];
                        $total_pago_mixto_efectivo = $total_pago_mixto_efectivo + $objeto_final[$i][8];
                        $total_pago_mixto_tarjeta = $total_pago_mixto_tarjeta + $objeto_final[$i][9];
                        $total_pago_mixto_abono = $total_pago_mixto_abono + $objeto_final[$i][11];
                    }

                }

                 /**************************** */
                /**  TOTAL APARTADOS */
                $total_pago_efectivo_apartado = null;
                $tarjeta_apartado_uno = null;
                $tarjeta_apartado_dos = null;
                // dd($objeto_final_apartado);
                for ($i = 0; $i < count($objeto_final_apartado); $i++) {
                    
                    $total_pago_efectivo_apartado = $total_pago_efectivo_apartado + $objeto_final_apartado[$i][2];
                    $tarjeta_apartado_uno = $tarjeta_apartado_uno + $objeto_final_apartado[$i][3];
                    $tarjeta_apartado_dos = $tarjeta_apartado_dos + $objeto_final_apartado[$i][4];
                    
                }

                 //TOTAL VENTA SISTECREDITO
                 $total_venta_diaria_sistecredito = 0;
                 for ($i = 0; $i < count($objeto_final); $i++) {
                     $total_venta_diaria_sistecredito = $total_venta_diaria_sistecredito + $objeto_final[$i][12];
                 }
                
                
                $total_pago_tarjeta_apartado = $tarjeta_apartado_uno + $tarjeta_apartado_dos;
                
                // dd($total_pago_tarjeta);
                // dd($total_pago_tarjeta_apartado);
                $totales_tarjetas=$total_pago_tarjeta+$total_pago_tarjeta_apartado;
                // return response()->json($busqueda);
                // dd($total_venta_diaria);
                return response()->json(view('informes.parciales.factura_info_diario', compact(
                    'totales_tarjetas',
                    'encabezado',
                    'objeto_final',
                    'total_venta_diaria',
                    'total_pago_tarjeta',
                    'total_pago_efectivo',
                    'fecha1',
                    'fecha2',
                    'consultasalidas',
                    'consultaentradas',
                    'totalentradas',
                    'totalsalidas',
                    'total_pago_mixto',
                    'total_pago_mixto_efectivo',
                    'total_pago_mixto_tarjeta',
                    'total_venta_diaria_efectivo',
                    'total_tarjetas',
                    'total_venta_diaria_abono',
                    'lista_consecutivos',
                    //total tarjeta
                    'total_pago_tarjeta_total',
                    'total_pago_tarjeta_abono',
                    //total efectivo
                    'total_pago_efectivo_efectivo',
                    'total_pago_efectivo_abono',
                    //total mixto
                    'total_pago_mixto_abono',
                    //APARTADOS
                    'objeto_final_apartado',
                    'total_pago_tarjeta_apartado',
                    'total_pago_efectivo_apartado',
                    //TOTAL SISTECREDITO
                    'total_venta_diaria_sistecredito'
                ))->render());
            }

        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////
    // INFORMES DE COMPRAS
    //////////////////////////////////////////////////////////////////////////////////////////////////

    public function info_compras()
    {
        return view('informes.informes_compras');
    }

    public function generar_informe_compras(Request $request)
    {
        $tienda = $request->user()->tienda;
        $fecha1 = $request->fecha1;
        $fecha2 = $request->fecha2;

        $busqueda = compras::where('id_tienda', $tienda)
            ->whereDate('created_at', '>=', $fecha1)->whereDate('created_at', '<=', $fecha2)->get();
        $busqueda->each(function ($busqueda) {
            $busqueda->proveedorescompras;
        });

        // dd($busqueda);

        // almacenamos todos los consecutivos
        $compras_consecutivo = [];
        foreach ($busqueda as $value) {
            $compras_consecutivo[] = $value->numero_factura;
        }

        //eliminamos las facturas duplicadas
        $consecutivos = array_unique($compras_consecutivo);

        //reordenamos los valores
        $lista_consecutivos = [];
        foreach ($consecutivos as $value) {
            $lista_consecutivos[] = $value;
        }

        //    contamos los registros
        //variables
        $objeto_final = [];
        $objeto = [];
        $proveedor = null;
        $nit = null;
        $fecha = null;
        // $precio_base = null;

        for ($i = 0; $i < count($lista_consecutivos); $i++) {
            foreach ($busqueda as $value) {
                if ($lista_consecutivos[$i] == $value->numero_factura) {

                    $numero_factura = $value->numero_factura;
                    $proveedor = $value->proveedorescompras->nombre;
                    $nit = $value->proveedorescompras->nit;
                    $fecha = $value->created_at->format('d/m/Y');
                }
            } //fin foreach
            $objeto[] = $numero_factura;
            $objeto[] = $proveedor;
            $objeto[] = $nit;
            $objeto[] = $fecha;
            $objeto_final[] = $objeto;
            $objeto = null;

            $precio_total = null;
        } //fin primer for

        // dd($objeto_final);

        return response()->json(view('informes.parciales.tabla_facturas_compras', compact('objeto_final'))->render());
    }

    public function ver_factura_compra(Request $request)
    {
        $numero_factura = $request->id;
        // dd($numero_factura);
        $consulta_factura = compras::where('numero_factura', $numero_factura)->get();

        $consulta_factura->each(function ($consulta_factura) {
            $consulta_factura->productoscompras;
            $consulta_factura->proveedorescompras;
            $consulta_factura->tiendascompras;
        });
        // dd($consulta_factura[0]->proveedorescompras['nombre']);
        $totalcantidad = 0;
        $subtotal = 0;
        $subiva = 0;
        for ($i = 0; $i < count($consulta_factura); $i++) {
            $subtotal = $consulta_factura[$i]['compra_total'] + $subtotal;
            //    dd($subtotal);
            $subiva = $consulta_factura[$i]['iva_compra'] + $subiva;
            $totalcantidad = $consulta_factura[$i]['cantidad'] + $totalcantidad;
        } //fin primer for

        $total = $subiva + $subtotal;
        if ($consulta_factura[0]['forma_pago'] == 2) {
            $forma_pago = "CONTADO";
            // dd($forma_pago);
        }
        if ($consulta_factura[0]['forma_pago'] == 1) {
            $forma_pago = "CREDITO";
            // dd($forma_pago);
        }
        // dd($subiva);
        // dd($subtotal);
        // dd($total);
        // dd($totalcantidad);
        return response()->json(view('informes.parciales.ver_factura_compras', compact('consulta_factura', 'subtotal', 'subiva', 'total', 'totalcantidad', 'forma_pago'))->render());
    }

    public function generar_informe_diario_zonas(Request $request)
    {
        // dd('ff');
        $tienda = $request->tienda;
        $inicio = $request->inicio;
        $fin = $request->fin;
        // dd($tienda);

        if ($request->ajax()) {

            if ($inicio != null && $fin != null && $tienda != null) {
                // dd("hhh");
                $busqueda = facturas::where('estado', '==', 0)
                    ->where('id_tienda', $tienda)
                    ->where('facturacion','!=',3)
                    ->whereDate('created_at', '>=', $inicio)->whereDate('created_at', '<=', $fin)->get();
                $busqueda->each(function ($busqueda) {
                    $busqueda->clientesfactura;
                });

                // dd($consultacajamenor[0]->entradamenor);
                $consultaentradas = entradamenor::where('tiendas_id', $tienda)
                    ->whereDate('created_at', '>=', $inicio)->whereDate('created_at', '<=', $fin)->get();

                $consultasalidas = salidamenor::where('tiendas_id', $tienda)
                    ->whereDate('created_at', '>=', $inicio)->whereDate('created_at', '<=', $fin)->get();

                $apartado = separados::where('id_tienda', $tienda)
                    ->whereDate('created_at', '>=', $inicio)->whereDate('created_at', '<=', $fin)->get();

                $totalentradas = 0;
                for ($i = 0; $i < count($consultaentradas); $i++) {
                    $totalentradas = $consultaentradas[$i]['entrada'] + $totalentradas;
                }

                $totalsalidas = 0;
                for ($i = 0; $i < count($consultasalidas); $i++) {
                    $totalsalidas = $consultasalidas[$i]['salida'] + $totalsalidas;
                }

                // almacenamos todos los consecutivos
                $facturas_consecutivo = [];
                foreach ($busqueda as $value) {
                    $facturas_consecutivo[] = $value->n_factura;
                }
                //eliminamos las facturas duplicadas
                $consecutivos = array_unique($facturas_consecutivo);
                //reordenamos los valores
                $lista_consecutivos = [];
                foreach ($consecutivos as $value) {
                    $lista_consecutivos[] = $value;
                }
                // almacenamos todos los consecutivos apartados
                $consecutivo_apartado = [];
                foreach ($apartado as $value) {
                    $consecutivo_apartado[] = $value->consecutivo;
                }

                //eliminamos las facturas duplicadas
                $consecutivos_orden_apartado = array_unique($consecutivo_apartado);
                //reordenamos los valores
                $lista_consecutivos_apartado = [];
                foreach ($consecutivos_orden_apartado as $value) {
                    $lista_consecutivos_apartado[] = $value;
                }

                // dd($lista_consecutivos);
                //    contamos los registros
                //variables
                $objeto_final = [];
                $objeto = [];
                $var_precio = [];
                $precio_total = null;
                $precio_base = null;
                $precio_iva = null;
                $numero_factura = null;
                $fecha = null;
                $codigo = null;
                $nombre = null;
                $tipo_pago = null;
                $pago_efectivo = null;
                $pago_tarjeta = null;
                $pago_tarjeta_dos = null;
                $pago_abono = null;
                $pago_sistecredito = null;
                // dd($busqueda);
                for ($i = 0; $i < count($lista_consecutivos); $i++) {
                    foreach ($busqueda as $value) {
                        if ($lista_consecutivos[$i] == $value->n_factura) {
                            $precio_total = $precio_total + $value->total;
                            $numero_factura = $value->n_factura;
                            $fecha = $value->created_at->format('d/m/Y');
                            $codigo = $value->clientesfactura->documento;
                            $nombre = $value->clientesfactura->nombres;
                            $tipo_pago = $value->tipo_compra;
                            $pago_efectivo = $pago_efectivo + $value->pago_efectivo;
                            $pago_tarjeta = $pago_tarjeta + $value->pago_tarjeta;
                            $pago_tarjeta_dos = $pago_tarjeta_dos + $value->pago_tarjeta_dos;
                            $pago_abono = $pago_abono + $value->pago_abono;
                            $pago_sistecredito = $pago_sistecredito + $value->pago_sistecredito;                            
                        }
                    } //fin foreach
                    $var_precio[] = $precio_total;
                    $precio_base = $precio_total / 1.19;
                    $precio_iva = $precio_total - $precio_base;
                    $objeto[] = $numero_factura; //0
                    $objeto[] = $fecha; //1
                    $objeto[] = $codigo; //2
                    $objeto[] = $nombre; //3
                    $objeto[] = round($precio_base); //4
                    $objeto[] = round($precio_iva); //5
                    $objeto[] = $precio_total; //6
                    $objeto[] = $tipo_pago; //7
                    $objeto[] = $pago_efectivo; //8
                    $objeto[] = $pago_tarjeta; //9
                    $objeto[] = $pago_tarjeta_dos; //10
                    $objeto[] = $pago_abono; //11
                    $objeto[] = $pago_sistecredito; //12
                    $objeto_final[] = $objeto;
                    $objeto = null;

                    $precio_total = null;
                    $pago_efectivo = null;
                    $pago_tarjeta = null;
                    $pago_tarjeta_dos = null;
                    $pago_abono = null;
                    $pago_sistecredito = null;
                    // dd($objeto_final);
                } //fin primer for

                // *******************************************
                // ---------  CICLO DE APARTADOS  ------------
                //********************************************
                $objeto_final_apartado = [];
                $objeto_apartado = [];
                $numero_factura_apartado = null;
                $fecha_apartado = null;
                $pago_efectivo_apartado = null;
                $pago_tarjeta_apartado = null;
                $pago_tarjeta_dos_apartado = null;
                // dd($busqueda);
                for ($i = 0; $i < count($lista_consecutivos_apartado); $i++) {
                    foreach ($apartado as $value) {
                        if ($lista_consecutivos_apartado[$i] == $value->consecutivo) {
                            $numero_factura_apartado = $value->consecutivo;
                            $fecha_apartado = $value->created_at->format('d/m/Y');
                            $pago_efectivo_apartado = $pago_efectivo_apartado + $value->pago_efectivo;
                            $pago_tarjeta_apartado = $pago_tarjeta_apartado + $value->pago_tarjeta_uno;
                            $pago_tarjeta_dos_apartado = $pago_tarjeta_dos_apartado + $value->pago_tarjeta_dos;
                        }
                    } //fin foreach
                    $objeto_apartado[] = $numero_factura_apartado; //0
                    $objeto_apartado[] = $fecha_apartado; //1
                    $objeto_apartado[] = $pago_efectivo_apartado; //2
                    $objeto_apartado[] = $pago_tarjeta_apartado; //3
                    $objeto_apartado[] = $pago_tarjeta_dos_apartado; //4
                    $objeto_final_apartado[] = $objeto_apartado;
                    $objeto_apartado = null;

                    $numero_factura_apartado = null;
                    $fecha_apartado = null;
                    $pago_efectivo_apartado = null;
                    $pago_tarjeta_apartado = null;
                    $pago_tarjeta_dos_apartado = null;
                    // dd($objeto_final);
                } //fin primer for
                // totales

                //TOTAL VENTA DIARIA
                $total_venta_diaria = 0;
                for ($i = 0; $i < count($objeto_final); $i++) {
                    $total_venta_diaria = $total_venta_diaria + $objeto_final[$i][6];
                }
                //TOTAL VENTA DIARIA EFECTIVO
                $total_venta_diaria_efectivo = 0;
                for ($i = 0; $i < count($objeto_final); $i++) {
                    $total_venta_diaria_efectivo = $total_venta_diaria_efectivo + $objeto_final[$i][8];
                }
                //TOTAL VENTA DIARIA TARJETA
                $total_venta_diaria_tarjeta_uno = 0;
                $total_venta_diaria_tarjeta_dos = 0;
                for ($i = 0; $i < count($objeto_final); $i++) {
                    $total_venta_diaria_tarjeta_uno = $total_venta_diaria_tarjeta_uno + $objeto_final[$i][9];
                    $total_venta_diaria_tarjeta_dos = $total_venta_diaria_tarjeta_dos + $objeto_final[$i][10];
                }
                $total_tarjetas = $total_venta_diaria_tarjeta_uno + $total_venta_diaria_tarjeta_dos;
                //TOTAL VENTA DIARIA ABONO
                $total_venta_diaria_abono = 0;
                for ($i = 0; $i < count($objeto_final); $i++) {

                    $total_venta_diaria_abono = $total_venta_diaria_abono + floatval($objeto_final[$i][11]);
                }
                /******************************** */
                //TOTAL TARJETAS
                $total_pago_tarjeta = null;
                $total_pago_tarjeta_uno = null;
                $total_pago_tarjeta_dos = null;
                $total_pago_tarjeta_abono = null;
                // dd($objeto_final);
                for ($i = 0; $i < count($objeto_final); $i++) {
                    if ($objeto_final[$i][7] == 2 || $objeto_final[$i][7] == 4) {
                        $total_pago_tarjeta = $total_pago_tarjeta + $objeto_final[$i][6];
                        $total_pago_tarjeta_uno = $total_pago_tarjeta_uno + $objeto_final[$i][9];
                        $total_pago_tarjeta_dos = $total_pago_tarjeta_dos + $objeto_final[$i][10];
                        $total_pago_tarjeta_abono = $total_pago_tarjeta_abono + $objeto_final[$i][11];
                    }

                }
                // dd($total_pago_tarjeta_dos);
                $total_pago_tarjeta_total = $total_pago_tarjeta_uno + $total_pago_tarjeta_dos;

                /**************************** */
                /**  TOTAL EFECTIVO */
                $total_pago_efectivo = null;
                $total_pago_efectivo_efectivo = null;
                $total_pago_efectivo_abono = null;

                for ($i = 0; $i < count($objeto_final); $i++) {
                    if ($objeto_final[$i][7] == 1) {
                        $total_pago_efectivo = $total_pago_efectivo + $objeto_final[$i][6];
                        $total_pago_efectivo_efectivo = $total_pago_efectivo_efectivo + $objeto_final[$i][8];
                        $total_pago_efectivo_abono = $total_pago_efectivo_abono + $objeto_final[$i][11];
                    }

                }
                /******************************** */
                /** TOTAL MIXTO */
                $total_pago_mixto = null;
                $total_pago_mixto_efectivo = null;
                $total_pago_mixto_tarjeta = null;
                $total_pago_mixto_abono = null;
                for ($i = 0; $i < count($objeto_final); $i++) {
                    if ($objeto_final[$i][7] == 3) {
                        $total_pago_mixto = $total_pago_mixto + $objeto_final[$i][6];
                        $total_pago_mixto_efectivo = $total_pago_mixto_efectivo + $objeto_final[$i][8];
                        $total_pago_mixto_tarjeta = $total_pago_mixto_tarjeta + $objeto_final[$i][9];
                        $total_pago_mixto_abono = $total_pago_mixto_abono + $objeto_final[$i][11];
                    }

                }

                /**************************** */
                /**  TOTAL APARTADOS */
                $total_pago_efectivo_apartado = null;
                $tarjeta_apartado_uno = null;
                $tarjeta_apartado_dos = null;
                // dd($objeto_final_apartado);
                for ($i = 0; $i < count($objeto_final_apartado); $i++) {
                    
                    $total_pago_efectivo_apartado = $total_pago_efectivo_apartado + $objeto_final_apartado[$i][2];
                    $tarjeta_apartado_uno = $tarjeta_apartado_uno + $objeto_final_apartado[$i][3];
                    $tarjeta_apartado_dos = $tarjeta_apartado_dos + $objeto_final_apartado[$i][4];
                    
                }

                //TOTAL VENTA SISTECREDITO
                $total_venta_diaria_sistecredito = 0;
                for ($i = 0; $i < count($objeto_final); $i++) {
                    $total_venta_diaria_sistecredito = $total_venta_diaria_sistecredito + $objeto_final[$i][12];
                }
                $total_pago_tarjeta_apartado = $tarjeta_apartado_uno + $tarjeta_apartado_dos;


                $consulta = facturas::where('estado', '==', 0)
                    ->where('id_tienda', $tienda)
                    ->where('facturacion','!=',3)
                    ->where('facturas.facturacion','=',0)
                    ->where('facturas.estado','=',0)
                    ->whereDate('created_at', '>=', $inicio)->whereDate('created_at', '<=', $fin)->select('pago_sistecredito')->get();

                $total_sistecredito=0;
                for ($i = 0; $i < count($consulta); $i++) {
                    if($consulta[$i]['pago_sistecredito']==null){
                        $consulta[$i]['pago_sistecredito'] = 0;
                    }
                    $total_sistecredito = $total_sistecredito + $consulta[$i]['pago_sistecredito'];
                }


                $consulta_abonos_sistecredito = AbonoSistecredito::where('id_tienda', $tienda)
                    ->whereDate('created_at', '>=', $inicio)->whereDate('created_at', '<=', $fin)->sum('valor');

                // dd($total_pago_mixto);
                // dd($total_pago_tarjeta);
                // dd($objeto_final);
                // return response()->json($busqueda);
                return response()->json(view('informes.parciales.info_2', compact('objeto_final', 'total_venta_diaria', 'total_pago_tarjeta', 'total_pago_efectivo',
                    'consultasalidas',
                    'consultaentradas',
                    'totalentradas',
                    'totalsalidas',
                    'total_pago_mixto',
                    'total_pago_mixto_efectivo',
                    'total_pago_mixto_tarjeta',
                    'total_venta_diaria_efectivo',
                    'total_tarjetas',
                    'total_venta_diaria_abono',
                    'lista_consecutivos',
                    //total tarjeta
                    'total_pago_tarjeta_total',
                    'total_pago_tarjeta_abono',
                    //total efectivo
                    'total_pago_efectivo_efectivo',
                    'total_pago_efectivo_abono',
                    //total mixto
                    'total_pago_mixto_abono',
                    //APARTADOS
                    'objeto_final_apartado',
                    'total_pago_tarjeta_apartado',
                    'total_pago_efectivo_apartado',
                    //TOTAL SISTECREDITO
                    // 'total_venta_diaria_sistecredito'
                    'total_sistecredito',
                    //TOTAL ABONOS DEL DIA
                    'consulta_abonos_sistecredito'
                ))->render());
            }

        }
    }

    public function informe_diario_imprimir_zona(Request $request)
    {
        $tienda = $request->tienda;
        $fecha1 = $request->fecha_inicio;
        $fecha2 = $request->fecha_fin;
        // dd($tienda);

        $encabezado = tiendas::find($tienda);

        if ($request->ajax()) {

            if ($fecha1 != null && $fecha2 != null && $tienda != null) {
                // dd("hhh");
                $busqueda = facturas::where('estado', '==', 0)
                    ->where('id_tienda', $tienda)
                    ->where('facturacion','!=',3)
                    ->whereDate('created_at', '>=', $fecha1)->whereDate('created_at', '<=', $fecha2)->get();
                $busqueda->each(function ($busqueda) {
                    $busqueda->clientesfactura;
                });

// dd($consultacajamenor[0]->entradamenor);
                $consultaentradas = entradamenor::where('tiendas_id', $tienda)
                    ->whereDate('created_at', '>=', $fecha1)->whereDate('created_at', '<=', $fecha2)->get();

                $consultasalidas = salidamenor::where('tiendas_id', $tienda)
                    ->whereDate('created_at', '>=', $fecha1)->whereDate('created_at', '<=', $fecha2)->get();
                $apartado = separados::where('id_tienda', $tienda)
                    ->whereDate('created_at', '>=', $fecha1)->whereDate('created_at', '<=', $fecha2)->get();

                $totalentradas = 0;
                for ($i = 0; $i < count($consultaentradas); $i++) {
                    $totalentradas = $consultaentradas[$i]['entrada'] + $totalentradas;
                }

                $totalsalidas = 0;
                for ($i = 0; $i < count($consultasalidas); $i++) {
                    $totalsalidas = $consultasalidas[$i]['salida'] + $totalsalidas;
                }

                // almacenamos todos los consecutivos
                $facturas_consecutivo = [];
                foreach ($busqueda as $value) {
                    $facturas_consecutivo[] = $value->n_factura;
                }
                //eliminamos las facturas duplicadas
                $consecutivos = array_unique($facturas_consecutivo);
                //reordenamos los valores
                $lista_consecutivos = [];
                foreach ($consecutivos as $value) {
                    $lista_consecutivos[] = $value;
                }
                // almacenamos todos los consecutivos apartados
                $consecutivo_apartado = [];
                foreach ($apartado as $value) {
                    $consecutivo_apartado[] = $value->consecutivo;
                }

                //eliminamos las facturas duplicadas
                $consecutivos_orden_apartado = array_unique($consecutivo_apartado);
                //reordenamos los valores
                $lista_consecutivos_apartado = [];
                foreach ($consecutivos_orden_apartado as $value) {
                    $lista_consecutivos_apartado[] = $value;
                }

                // dd($lista_consecutivos);
                //    contamos los registros
                //variables
                $objeto_final = [];
                $objeto = [];
                $var_precio = [];
                $precio_total = null;
                $precio_base = null;
                $precio_iva = null;
                $numero_factura = null;
                $fecha = null;
                $codigo = null;
                $nombre = null;
                $tipo_pago = null;
                $pago_efectivo = null;
                $pago_tarjeta = null;
                $pago_tarjeta_dos = null;
                $pago_abono = null;
                $pago_sistecredito = null;


                for ($i = 0; $i < count($lista_consecutivos); $i++) {
                    foreach ($busqueda as $value) {
                        if ($lista_consecutivos[$i] == $value->n_factura) {
                            $precio_total = $precio_total + $value->total;
                            $numero_factura = $value->n_factura;
                            $fecha = $value->created_at->format('d/m/Y');
                            $codigo = $value->clientesfactura->documento;
                            $nombre = $value->clientesfactura->nombres;
                            $tipo_pago = $value->tipo_compra;
                            $pago_efectivo = $pago_efectivo + $value->pago_efectivo;
                            $pago_tarjeta = $pago_tarjeta + $value->pago_tarjeta;
                            $pago_tarjeta_dos = $pago_tarjeta_dos + $value->pago_tarjeta_dos;
                            $pago_abono = $pago_abono + $value->pago_abono;
                            $pago_sistecredito = $pago_sistecredito + $value->pago_sistecredito;                            
                        }
                    } //fin foreach
                    $var_precio[] = $precio_total;
                    $precio_base = $precio_total / 1.19;
                    $precio_iva = $precio_total - $precio_base;
                    $objeto[] = $numero_factura;
                    $objeto[] = $fecha;
                    $objeto[] = $codigo;
                    $objeto[] = $nombre;
                    $objeto[] = round($precio_base);
                    $objeto[] = round($precio_iva);
                    $objeto[] = $precio_total;
                    $objeto[] = $tipo_pago;
                    $objeto[] = $pago_efectivo;
                    $objeto[] = $pago_tarjeta;
                    $objeto[] = $pago_tarjeta_dos; //10
                    $objeto[] = $pago_abono; //11
                    $objeto[] = $pago_sistecredito; //12
                    $objeto_final[] = $objeto;
                    $objeto = null;

                    $precio_total = null;
                    $pago_efectivo = null;
                    $pago_tarjeta = null;
                    $pago_tarjeta_dos = null;
                    $pago_abono = null;
                    $pago_sistecredito = null;

                } //fin primer for
                // totales
                // dd($objeto_final);
                // totales

                // *******************************************
                // ---------  CICLO DE APARTADOS  ------------
                //********************************************
                $objeto_final_apartado = [];
                $objeto_apartado = [];
                $numero_factura_apartado = null;
                $fecha_apartado = null;
                $pago_efectivo_apartado = null;
                $pago_tarjeta_apartado = null;
                $pago_tarjeta_dos_apartado = null;
                // dd($busqueda);
                for ($i = 0; $i < count($lista_consecutivos_apartado); $i++) {
                    foreach ($apartado as $value) {
                        if ($lista_consecutivos_apartado[$i] == $value->consecutivo) {
                            $numero_factura_apartado = $value->consecutivo;
                            $fecha_apartado = $value->created_at->format('d/m/Y');
                            $pago_efectivo_apartado = $pago_efectivo_apartado + $value->pago_efectivo;
                            $pago_tarjeta_apartado = $pago_tarjeta_apartado + $value->pago_tarjeta_uno;
                            $pago_tarjeta_dos_apartado = $pago_tarjeta_dos_apartado + $value->pago_tarjeta_dos;
                        }
                    } //fin foreach
                    $objeto_apartado[] = $numero_factura_apartado; //0
                    $objeto_apartado[] = $fecha_apartado; //1
                    $objeto_apartado[] = $pago_efectivo_apartado; //2
                    $objeto_apartado[] = $pago_tarjeta_apartado; //3
                    $objeto_apartado[] = $pago_tarjeta_dos_apartado; //4
                    $objeto_final_apartado[] = $objeto_apartado;
                    $objeto_apartado = null;

                    $numero_factura_apartado = null;
                    $fecha_apartado = null;
                    $pago_efectivo_apartado = null;
                    $pago_tarjeta_apartado = null;
                    $pago_tarjeta_dos_apartado = null;
                    // dd($objeto_final);
                } //fin primer for
                //TOTAL VENTA DIARIA
                $total_venta_diaria = 0;
                for ($i = 0; $i < count($objeto_final); $i++) {
                    $total_venta_diaria = $total_venta_diaria + $objeto_final[$i][6];
                }
                //TOTAL VENTA DIARIA EFECTIVO
                $total_venta_diaria_efectivo = 0;
                for ($i = 0; $i < count($objeto_final); $i++) {
                    $total_venta_diaria_efectivo = $total_venta_diaria_efectivo + $objeto_final[$i][8];
                }
                //TOTAL VENTA DIARIA TARJETA
                $total_venta_diaria_tarjeta_uno = 0;
                $total_venta_diaria_tarjeta_dos = 0;
                for ($i = 0; $i < count($objeto_final); $i++) {
                    $total_venta_diaria_tarjeta_uno = $total_venta_diaria_tarjeta_uno + $objeto_final[$i][9];
                    $total_venta_diaria_tarjeta_dos = $total_venta_diaria_tarjeta_dos + $objeto_final[$i][10];
                }
                $total_tarjetas = $total_venta_diaria_tarjeta_uno + $total_venta_diaria_tarjeta_dos;
                //TOTAL VENTA DIARIA ABONO
                $total_venta_diaria_abono = 0;
                for ($i = 0; $i < count($objeto_final); $i++) {

                    $total_venta_diaria_abono = $total_venta_diaria_abono + floatval($objeto_final[$i][11]);
                }
                /******************************** */
                //TOTAL TARJETAS
                $total_pago_tarjeta = null;
                $total_pago_tarjeta_uno = null;
                $total_pago_tarjeta_dos = null;
                $total_pago_tarjeta_abono = null;
                for ($i = 0; $i < count($objeto_final); $i++) {
                    if ($objeto_final[$i][7] == 2 || $objeto_final[$i][7] == 4) {
                        $total_pago_tarjeta = $total_pago_tarjeta + $objeto_final[$i][6];
                        $total_pago_tarjeta_uno = $total_pago_tarjeta_uno + $objeto_final[$i][9];
                        $total_pago_tarjeta_dos = $total_pago_tarjeta_dos + $objeto_final[$i][10];
                        $total_pago_tarjeta_abono = $total_pago_tarjeta_abono + $objeto_final[$i][11];
                    }

                }
                $total_pago_tarjeta_total = $total_pago_tarjeta_uno + $total_pago_tarjeta_dos;

                /**************************** */
                /**  TOTAL EFECTIVO */
                $total_pago_efectivo = null;
                $total_pago_efectivo_efectivo = null;
                $total_pago_efectivo_abono = null;

                for ($i = 0; $i < count($objeto_final); $i++) {
                    if ($objeto_final[$i][7] == 1) {
                        $total_pago_efectivo = $total_pago_efectivo + $objeto_final[$i][6];
                        $total_pago_efectivo_efectivo = $total_pago_efectivo_efectivo + $objeto_final[$i][8];
                        $total_pago_efectivo_abono = $total_pago_efectivo_abono + $objeto_final[$i][11];
                    }

                }
                /******************************** */
                /** TOTAL MIXTO */
                $total_pago_mixto = null;
                $total_pago_mixto_efectivo = null;
                $total_pago_mixto_tarjeta = null;
                $total_pago_mixto_abono = null;
                for ($i = 0; $i < count($objeto_final); $i++) {
                    if ($objeto_final[$i][7] == 3) {
                        $total_pago_mixto = $total_pago_mixto + $objeto_final[$i][6];
                        $total_pago_mixto_efectivo = $total_pago_mixto_efectivo + $objeto_final[$i][8];
                        $total_pago_mixto_tarjeta = $total_pago_mixto_tarjeta + $objeto_final[$i][9];
                        $total_pago_mixto_abono = $total_pago_mixto_abono + $objeto_final[$i][11];
                    }

                }

                /**************************** */
                /**  TOTAL APARTADOS */
                $total_pago_efectivo_apartado = null;
                $tarjeta_apartado_uno = null;
                $tarjeta_apartado_dos = null;
                // dd($objeto_final_apartado);
                for ($i = 0; $i < count($objeto_final_apartado); $i++) {
                    
                    $total_pago_efectivo_apartado = $total_pago_efectivo_apartado + $objeto_final_apartado[$i][2];
                    $tarjeta_apartado_uno = $tarjeta_apartado_uno + $objeto_final_apartado[$i][3];
                    $tarjeta_apartado_dos = $tarjeta_apartado_dos + $objeto_final_apartado[$i][4];
                    
                }
                $total_pago_tarjeta_apartado = $tarjeta_apartado_uno + $tarjeta_apartado_dos;
                

                $consulta = facturas::where('estado', '==', 0)
                    ->where('id_tienda', $tienda)
                    ->where('facturacion','!=',3)
                    ->where('facturas.facturacion','=',0)
                    ->where('facturas.estado','=',0)
                    ->whereDate('created_at', '>=', $fecha1)->whereDate('created_at', '<=', $fecha2)->select('pago_sistecredito')->get();

                $total_sistecredito=0;
                for ($i = 0; $i < count($consulta); $i++) {
                    if($consulta[$i]['pago_sistecredito']==null){
                        $consulta[$i]['pago_sistecredito'] = 0;
                    }
                    $total_sistecredito = $total_sistecredito + $consulta[$i]['pago_sistecredito'];
                }

                $consulta_abonos_sistecredito = AbonoSistecredito::where('id_tienda', $tienda)
                    ->whereDate('created_at', '>=', $inicio)->whereDate('created_at', '<=', $fin)->sum('valor');

                // dd($objeto_final);
                // return response()->json($busqueda);
                // dd($total_venta_diaria);
                return response()->json(view('informes.parciales.factura_info_diario', compact(
                    'encabezado',
                    'objeto_final',
                    'total_venta_diaria',
                    'total_pago_tarjeta',
                    'total_pago_efectivo',
                    'fecha1',
                    'fecha2',
                    'consultasalidas',
                    'consultaentradas',
                    'totalentradas',
                    'totalsalidas',
                    'total_pago_mixto',
                    'total_pago_mixto_efectivo',
                    'total_pago_mixto_tarjeta',
                    'total_venta_diaria_efectivo',
                    'total_tarjetas',
                    'total_venta_diaria_abono',
                    'lista_consecutivos',
                    //total tarjeta
                    'total_pago_tarjeta_total',
                    'total_pago_tarjeta_abono',
                    //total efectivo
                    'total_pago_efectivo_efectivo',
                    'total_pago_efectivo_abono',
                    //total mixto
                    'total_pago_mixto_abono',
                    //APARTADOS
                    'objeto_final_apartado',
                    'total_pago_tarjeta_apartado',
                    'total_pago_efectivo_apartado',
                    //SISTECREDITO
                    'total_sistecredito',
                    //ABONOS SISTECREDITO DEL DIA
                    'consulta_abonos_sistecredito'
                ))->render());
            }

        }
    }

    public function informe_inventario(Request $request){

    if(isset($request->tienda)){ 
    //Informe inventario por tienda
    $data = DB::table('productos')
    ->select('productos.codigo AS CODIGO', 'cantidad_ingreso AS U_COMPRA', 'productos.cantidad AS U_INVENTARIO',
     'cantidad_ventas AS U_VENDIDAS', 'cant_recibida AS U_RECIBIDAS', 'cant_enviada AS U_ENVIADAS',
        DB::raw('((COALESCE(cantidad_ingreso,0) + COALESCE(cant_recibida,0)) - (COALESCE(productos.cantidad,0) + COALESCE(cantidad_ventas,0) +
        COALESCE(cant_enviada,0))) AS RESUL_PRODUCTOS'), DB::raw('(select COALESCE(sum(compras.cantidad ),0) from compras WHERE
        productos.codigo=compras.codigo_producto and compras.estado = 1 and compras.id_tienda = '. $request->tienda .') AS UC'),
        DB::raw('(select COALESCE(sum(remisiones.cantidad ),0) from remisiones WHERE productos.codigo=remisiones.codigo and remisiones.estado = 1 and
        remisiones.tienda_recibe = '. $request->tienda .') AS UR'), DB::raw('(select COALESCE(sum(facturas.cantidad ),0) from facturas WHERE productos.codigo =
        facturas.codigo and facturas.estado = 0 and facturas.id_tienda = '. $request->tienda .') AS UF'), DB::raw('(select COALESCE(sum(remisiones.cantidad ),0) from remisiones WHERE productos.codigo=remisiones.codigo and remisiones.estado = 1 and remisiones.tienda_envia = '. $request->tienda .') as UE'),DB::raw('(((select COALESCE(sum(remisiones.cantidad ),0) from remisiones WHERE productos.codigo=remisiones.codigo and remisiones.estado = 1 and remisiones.tienda_recibe = '. $request->tienda .')+
        (select COALESCE(sum(compras.cantidad ),0) from compras WHERE productos.codigo=compras.codigo_producto and compras.estado = 1 and compras.id_tienda = '. $request->tienda .')) - ((COALESCE(SUM( productos.cantidad),0)) + (select COALESCE(sum(facturas.cantidad ),0) from facturas WHERE productos.codigo =
        facturas.codigo and facturas.estado = 0 and facturas.id_tienda = '. $request->tienda .')+ (select COALESCE(sum(remisiones.cantidad ),0) from remisiones WHERE
        productos.codigo=remisiones.codigo and remisiones.estado = 1 and remisiones.tienda_envia = '. $request->tienda .'))) AS RE_FINAL_INVENTARIO'))
    ->where('productos.id_tienda', '=', $request->tienda)
    ->groupBy('productos.codigo')->get(); 
   }else{
    $data = [];
   } 
   //Retornar todas las zonas de tiendas
   $zonas = DB::table('zonas')->select('id','nombre')->get();

   $tienda = tiendas::where('id', '=', $request->tienda)->select('slug')->first();

    return view('informes.informe_inventario',compact('data','request','zonas','tienda'));
    }

    public function vista_informe_referencias(Request $request){

        return view('informes.informe_referencias');

    }

    public function informe_referencias(Request $request){

        $total = DB::table('facturas')
        ->select(DB::raw('count(*) AS total'))
        ->where([['facturacion', '=', 0],['estado', '=', 0],['codigo', '=', $request->referencia]])
        ->whereDate('created_at', '>=', $request->desde)->whereDate('created_at', '<=', $request->hasta)->first();

        return response()->json(compact('total'),200);
    }

}
