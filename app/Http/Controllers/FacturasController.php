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
use DB;
use App\zonas;
use App\Quotation;
use Illuminate\Http\Request;
use Automattic\WooCommerce\Client;

class FacturasController extends Controller
{


        public $woocommerce;

        public function __construct(){

        $this->woocommerce = new Client(
        'https://staradenimclass.com', 
        'ck_11486861d8753ac6f34131d10321357efcf60627', 
        'cs_f18bdbc742073967a66f75b580ded72471674fed',
        [
            'wp_api' => true,
            'version' => 'wc/v2',
        ]
        );

        }

    use ControlCaja;

    public function caja_registradora(Request $request)
    {
        $tienda = $request->user()->tienda;
        $caja_user = $request->user()->caja;
        $info_tienda = tiendas::find($tienda);
        $vendedores = vendedores::where('id_tienda', $tienda)
            ->where('estado', 1)->get();
        $bancos = tiposdepagos::all();
        if ($tienda != null & $caja_user != null) {
            //inicio estado de lacaja

            // $caja_user = $request->user()->caja;
            // dd($caja_user);
            if ($this->aperturaCajas($caja_user)) {
                $configuraciones = configuraciones::where('tienda', $tienda)->take(1)->get();
                //  dd($configuraciones);
                if ($configuraciones == '[]' || $configuraciones[0]->lista_tag == null) {
                    return redirect('/')->with('info', 'no se encontraron tags.');
                } else {
                    $list_tag = json_decode($configuraciones[0]['lista_tag']);

                    return view('caja.registradora', compact('list_tag', 'configuraciones', 'info_tienda', 'vendedores', 'bancos'));
                }
            } else {
                return redirect('/')->with('info', 'caja serrada.');
            }
        } else {
            if ($caja_user == null) {
                return redirect('/')->with('info', 'Usted no tiene asignada ninguna caja, pongase en contacto con el administrador.');
            }

            if ($tienda == null) {
                return redirect('/')->with('info', 'Usted no tiene ninguna tienda asignada, pongase en contacto con el administrador.');
            }

        }
    }

    public function crear_facturas(Request $request)
    {
        $usuario = $request->user()->id;
        $tienda = $request->user()->tienda;
        $productos = $request->productos;
        $id_cliente = $request->id_cliente;
        $asesor = $request->id_asesor;
        $tag = $request->tag_factura;
        $tipo_pago = $request->tipo_pago;
        $consecutivo_apartado = $request->consecutivo_apartado;
      
        //Valor abono
        $valor_abono = $request->valor_abono;
        //precio total
        $precio_total = $request->precio_total;
        //valor saldo tarjeta uno
        $valor_saldo_tarjeta_uno = $request->valor_saldo_tarjeta_uno;
        //valor saldo tarjeta dos
        $valor_saldo_tarjeta_dos = $request->valor_saldo_tarjeta_dos;
        //valor saldo tarjeta tarjeta uno
        $valor_saldo_tarjeta_tarjeta_uno = $request->valor_saldo_tarjeta_tarjeta_uno;
        //saldo en efectivo pagos tarjeta y efectivo
        $valor_saldo_efectivo_tarjeta_uno = $request->valor_saldo_efectivo_tarjeta_uno;
        //saldo sistecredito
        $saldo_sistecredito = $request->saldo_sistecredito;

        //variables de bancos
        $id_pago = $request->id_pago;
        $id_banco = $request->id_banco;
        $id_pago_dos = $request->id_pago_dos;
        $id_banco_dos = $request->id_banco_dos;

        $N_factura = consecutivos::where('id_tienda', $tienda)
            ->where('tag', $tag)->get();
        $consecutivo = 0;

        // for busca el consecutivo de la factura
        for ($i = 0; $i <= (count($N_factura)) - 1; $i++) {
            $conteo = $N_factura[$i]['consecutivo'];
            if ($conteo > $consecutivo) {
                $consecutivo = $conteo;
            }
        }
        if ($request->ajax()) {
            $iva = configuraciones::where('tienda', $tienda)->get();
            // guarda el consecutivo de la factura
            $consecut_factura = new consecutivos;
            $consecut_factura->id_tienda = $tienda;
            $consecut_factura->tag = $tag;
            $consecut_factura->consecutivo = $consecutivo + 1;
            $consecut_factura->save();

            $numero_factura = $tag . "-" . ($consecutivo + 1);

            //  dd($productos);
            //*************************************************** */
            //for insertar facturas cuando el pago sea sin abonos
            //*************************************************** */
            // dd($productos);
            for ($i = 0; $i <= (count($productos)) - 1; $i++) {

                $nueva_factura = new facturas;
                $nueva_factura->id_tienda = $tienda;
                $nueva_factura->id_vendedor = $usuario;
                $nueva_factura->id_cliente = $id_cliente;
                $nueva_factura->n_factura = $numero_factura;
                $nueva_factura->titulo = $productos[$i][0];
                $nueva_factura->codigo = $productos[$i][1];
                $nueva_factura->precio_base = $productos[$i][2];
                $nueva_factura->precio_oferta = $productos[$i][8];
                $nueva_factura->descuento = $productos[$i][6];
                $nueva_factura->cantidad = $productos[$i][7];
                $nueva_factura->total = $productos[$i][8];
                if ($tipo_pago == 1) {
                    if ($valor_abono != null) {

                        // dd(floatval($precio_total) + floatval($valor_abono) );
                        $saldo = floatval($precio_total) - floatval($valor_abono);
                        $nueva_factura->pago_efectivo = $saldo / count($productos);
                        $nueva_factura->pago_tarjeta = 0;
                        $nueva_factura->pago_tarjeta_dos = 0;
                        $nueva_factura->pago_abono = floatval($valor_abono) / count($productos);
                        // dd($saldo);

                    } else {
                        // dd('sin abono');
                        $saldo = $precio_total;
                        $nueva_factura->pago_efectivo = floatval($saldo) / count($productos);
                        $nueva_factura->pago_tarjeta = 0;
                        $nueva_factura->pago_tarjeta_dos = 0;
                        $nueva_factura->pago_abono = 0;

                    }

                }
                if ($tipo_pago == 2) {

                    if ($valor_abono != null) {
                        $saldo = floatval($precio_total) - floatval($valor_abono);
                        $nueva_factura->pago_efectivo = 0;
                        $nueva_factura->pago_tarjeta = floatval($saldo) / count($productos);
                        $nueva_factura->pago_tarjeta_dos = 0;
                        $nueva_factura->pago_abono = floatval($valor_abono) / count($productos);
                        $nueva_factura->id_clase_pago = $id_pago;
                        $nueva_factura->id_franquicia = $id_banco;

                    } else {
                        $saldo = $precio_total;
                        $nueva_factura->pago_efectivo = 0;
                        $nueva_factura->pago_tarjeta = floatval($saldo) / count($productos);
                        $nueva_factura->pago_tarjeta_dos = 0;
                        $nueva_factura->pago_abono = 0;
                        $nueva_factura->id_clase_pago = $id_pago;
                        $nueva_factura->id_franquicia = $id_banco;

                    }
                }
                if ($tipo_pago == 3) {
                    if ($valor_abono != null) {

                        $nueva_factura->pago_efectivo = floatval($valor_saldo_efectivo_tarjeta_uno) / count($productos);
                        $nueva_factura->pago_tarjeta = $valor_saldo_tarjeta_uno / count($productos);
                        $nueva_factura->pago_tarjeta_dos = 0;
                        $nueva_factura->pago_abono = floatval($valor_abono) / count($productos);
                        $nueva_factura->id_clase_pago = $id_pago;
                        $nueva_factura->id_franquicia = $id_banco;

                    } else {

                        $nueva_factura->pago_efectivo = floatval($valor_saldo_efectivo_tarjeta_uno) / count($productos);
                        $nueva_factura->pago_tarjeta = floatval($valor_saldo_tarjeta_uno) / count($productos);
                        $nueva_factura->pago_tarjeta_dos = 0;
                        $nueva_factura->pago_abono = 0;
                        $nueva_factura->id_clase_pago = $id_pago;
                        $nueva_factura->id_franquicia = $id_banco;

                    }
                }
                if ($tipo_pago == 4) {
                    if ($valor_abono != null) {

                        $nueva_factura->pago_efectivo = 0;
                        $nueva_factura->pago_tarjeta = floatval($valor_saldo_tarjeta_tarjeta_uno) / count($productos);
                        $nueva_factura->pago_tarjeta_dos = floatval($valor_saldo_tarjeta_dos) / count($productos);
                        $nueva_factura->pago_abono = floatval($valor_abono) / count($productos);
                        $nueva_factura->id_clase_pago = $id_pago;
                        $nueva_factura->id_franquicia = $id_banco;
                        $nueva_factura->id_clase_pago_dos = $id_pago_dos;
                        $nueva_factura->id_franquicia_dos = $id_banco_dos;

                    } else {

                        $nueva_factura->pago_efectivo = 0;
                        $nueva_factura->pago_tarjeta = floatval($valor_saldo_tarjeta_tarjeta_uno) / count($productos);
                        $nueva_factura->pago_tarjeta_dos = floatval($valor_saldo_tarjeta_dos) / count($productos);
                        $nueva_factura->pago_abono = 0;
                        $nueva_factura->id_clase_pago = $id_pago;
                        $nueva_factura->id_franquicia = $id_banco;
                        $nueva_factura->id_clase_pago_dos = $id_pago_dos;
                        $nueva_factura->id_franquicia_dos = $id_banco_dos;

                    }
                }
                if ($tipo_pago == 5) {

                    $nueva_factura->pago_efectivo = 0;
                    $nueva_factura->pago_tarjeta = 0;
                    $nueva_factura->pago_tarjeta_dos = 0;
                    $nueva_factura->pago_abono = floatval($valor_abono) / count($productos);

                }

                if ($tipo_pago == 6) {
                    if ($valor_abono != null) {
                        // dd(floatval($precio_total) + floatval($valor_abono) );
                        $saldo = floatval($precio_total) - floatval($valor_abono);
                        $nueva_factura->pago_efectivo = 0;
                        $nueva_factura->pago_tarjeta = 0;
                        $nueva_factura->pago_tarjeta_dos = 0;
                        $nueva_factura->pago_abono = floatval($valor_abono) / count($productos);
                        $nueva_factura->pago_sistecredito = floatval($saldo_sistecredito) / count($productos);
                        // dd($saldo);
                    } else {
                        // dd('sin abono');
                        $saldo = $precio_total;
                        $nueva_factura->pago_sistecredito = floatval($saldo_sistecredito) / count($productos);
                        $nueva_factura->pago_tarjeta = 0;
                        $nueva_factura->pago_tarjeta_dos = 0;
                        $nueva_factura->pago_abono = 0;
                    }
                }

                if ($tipo_pago == 7) {
                    if ($valor_abono != null) {
                        // dd(floatval($precio_total) + floatval($valor_abono) );
                        $saldo = floatval($precio_total) - (floatval($valor_abono)+floatval($saldo_sistecredito));
                        $nueva_factura->pago_efectivo = $saldo / count($productos);
                        $nueva_factura->pago_tarjeta = 0;
                        $nueva_factura->pago_tarjeta_dos = 0;
                        $nueva_factura->pago_abono = floatval($valor_abono) / count($productos);
                        $nueva_factura->pago_sistecredito = floatval($saldo_sistecredito) / count($productos);
                        // dd($saldo);
                    } else {
                        // dd('sin abono');
                        $saldo = $precio_total - floatval($saldo_sistecredito);
                        $nueva_factura->pago_efectivo = $saldo / count($productos);
                        $nueva_factura->pago_sistecredito = floatval($saldo_sistecredito) / count($productos);
                        $nueva_factura->pago_tarjeta = 0;
                        $nueva_factura->pago_tarjeta_dos = 0;
                        $nueva_factura->pago_abono = 0;
                    }
                }

                if ($tipo_pago == 8) {
                    $saldo_tarjeta = $request->saldo_tarjeta_uno;
                    // dd($saldo_tarjeta);
                    if ($valor_abono != null) {
                        // dd(floatval($precio_total) + floatval($valor_abono) );
                        $saldo = floatval($precio_total) - (floatval($valor_abono)+floatval($saldo_sistecredito));
                        $nueva_factura->pago_efectivo = $saldo / count($productos);
                        $nueva_factura->pago_tarjeta = 0;
                        $nueva_factura->pago_tarjeta_dos = 0;
                        $nueva_factura->pago_abono = floatval($valor_abono) / count($productos);
                        $nueva_factura->pago_sistecredito = floatval($saldo_sistecredito) / count($productos);
                        // dd($saldo);
                    } else {
                        // dd('sin abono');
                        // $saldo = $precio_total - floatval($saldo_sistecredito);
                        $nueva_factura->pago_efectivo = 0;
                        $nueva_factura->pago_sistecredito = floatval($saldo_sistecredito) / count($productos);
                        $nueva_factura->pago_tarjeta = floatval($saldo_tarjeta) / count($productos);
                        $nueva_factura->pago_tarjeta_dos = 0;
                        $nueva_factura->pago_abono = 0;
                    }
                }

                if ($tipo_pago == 9) {
                    $saldo_tarjeta = $request->saldo_tarjeta_uno;
                    // dd($saldo_tarjeta);
                    if ($valor_abono != null) {
                        // dd(floatval($precio_total) + floatval($valor_abono) );
                        $saldo = floatval($precio_total) - (floatval($valor_abono)+floatval($saldo_sistecredito)+floatval($valor_saldo_tarjeta_uno));
                        $nueva_factura->pago_efectivo = $saldo / count($productos);
                        $nueva_factura->pago_tarjeta = floatval($valor_saldo_tarjeta_uno) / count($productos);
                        $nueva_factura->pago_tarjeta_dos = 0;
                        $nueva_factura->pago_abono = floatval($valor_abono) / count($productos);
                        $nueva_factura->pago_sistecredito = floatval($saldo_sistecredito) / count($productos);
                        // dd($saldo);
                    } else {
                        // dd('sin abono');
                        $saldo = $precio_total - (floatval($saldo_sistecredito)+floatval($valor_saldo_tarjeta_uno));
                        $nueva_factura->pago_efectivo = floatval($saldo) / count($productos);
                        $nueva_factura->pago_sistecredito = floatval($saldo_sistecredito) / count($productos);
                        $nueva_factura->pago_tarjeta = floatval($valor_saldo_tarjeta_uno) / count($productos);
                        $nueva_factura->pago_tarjeta_dos = 0;
                        $nueva_factura->pago_abono = 0;
                    }
                }

                if ($tipo_pago == 10) {
                    if ($valor_abono != null) {

                        $nueva_factura->pago_efectivo = 0;
                        $nueva_factura->pago_tarjeta = floatval($valor_saldo_tarjeta_tarjeta_uno) / count($productos);
                        $nueva_factura->pago_tarjeta_dos = floatval($valor_saldo_tarjeta_dos) / count($productos);
                        $nueva_factura->pago_abono = floatval($valor_abono) / count($productos);
                        $nueva_factura->id_clase_pago = $id_pago;
                        $nueva_factura->id_franquicia = $id_banco;
                        $nueva_factura->id_clase_pago_dos = $id_pago_dos;
                        $nueva_factura->id_franquicia_dos = $id_banco_dos;
                        $nueva_factura->pago_sistecredito = floatval($saldo_sistecredito) / count($productos);

                    } else {

                        $nueva_factura->pago_efectivo = 0;
                        $nueva_factura->pago_tarjeta = floatval($valor_saldo_tarjeta_tarjeta_uno) / count($productos);
                        $nueva_factura->pago_tarjeta_dos = floatval($valor_saldo_tarjeta_dos) / count($productos);
                        $nueva_factura->pago_abono = 0;
                        $nueva_factura->id_clase_pago = $id_pago;
                        $nueva_factura->id_franquicia = $id_banco;
                        $nueva_factura->id_clase_pago_dos = $id_pago_dos;
                        $nueva_factura->id_franquicia_dos = $id_banco_dos;
                        $nueva_factura->pago_sistecredito = floatval($saldo_sistecredito) / count($productos);

                    }
                }
                if ($tipo_pago == 11) {
                    
                        $nueva_factura->facturacion = $request->name_tag_factura;
                        $nueva_factura->pago_efectivo = 0;
                        $nueva_factura->pago_tarjeta = 0;
                        $nueva_factura->pago_tarjeta_dos = 0;
                        $nueva_factura->pago_abono = 0;
                        $nueva_factura->pago_sistecredito = 0;
                        $nueva_factura->pagos_bless = floatval($precio_total)/ count($productos);

                   
                }


                $nueva_factura->tipo_compra = $tipo_pago;
                $nueva_factura->porsentaje_iva = $iva[0]->iva;
                $nueva_factura->estado = 0;
                $nueva_factura->id_asesor = $asesor;
                $nueva_factura->id_franquicia = $request->id_banco;
                $nueva_factura->id_clase_pago = $request->id_pago;
                $nueva_factura->id_categoria = $productos[$i][12];
                $nueva_factura->id_subcategoria = $productos[$i][13];
                $nueva_factura->precio_costo = $productos[$i][14];
                $nueva_factura->tipo_factura = $productos[$i][17]; //tipo de factura (mayor o detal).
                $nueva_factura->id_clasificaciones = $productos[$i][15]; //tipo de factura (mayor o detal).
                // dd($productos[$i][18]);
                $nueva_factura->save();
                //actualizar la fecha si es manual la factura
                $tipo_factura = $request->tipo_factura;
                $fecha_factura = $request->fecha_factura;
                $id_fact_manual = $nueva_factura->id;
                if ($tipo_factura == 2) {
                    // dd('actualizar la factura');
                    $act_fecha = facturas::find($id_fact_manual);
                    $act_fecha->created_at = $fecha_factura;
                    $act_fecha->save();
                }
                // dd($nueva_factura);

                //actualidar inventario
                $inventario = productos::find($productos[$i][10]);
                //  dd($inventario);
                $inventario->cantidad = (($inventario->cantidad) - ($productos[$i][7]));
                $inventario->cantidad_ventas = (($inventario->cantidad_ventas) + ($productos[$i][7]));
                $inventario->save();

            }

            if ($consecutivo_apartado) {
                $busqueda = separados::where('consecutivo', $consecutivo_apartado)->get();

                for ($i = 0; $i < count($busqueda); $i++) {
                    $id = $busqueda[$i]['id'];

                    $actual = separados::find($id);
                    $actual->estado = 1;
                    $actual->save();

                }
            }
            $estado_saldo = $request->estado_saldo;
            if ($estado_saldo == 1) {
                $busqueda_saldo = saldos::where('estado', 1)
                    ->where('id_cliente', $id_cliente)->get();
                for ($i = 0; $i < count($busqueda_saldo); $i++) {
                    $id = $busqueda_saldo[$i]['id'];

                    $actual = saldos::find($id);
                    $actual->estado = 0;
                    $actual->save();
                }

            }

            //cambiamos el usuario a mayorista si cumple las reglas
            if ($request->check_mayorista == 1) {
                //calculo fecha de inicio y la de fin
                $date = date("Y/m/d");
                //Incrementando 2 meses
                $mod_date = strtotime($date."+ 2 months");
                // dd(date("Y/m/d",$mod_date));    
                // creamos una configuracion para el usuario
                $configuracion = new config_usuarios;
                $configuracion->id_tipo_usuario = 2;
                $configuracion->fecha_inicio = $date;
                $configuracion->fecha_fin = date("Y/m/d",$mod_date);
                $configuracion->estado = 1;
                $configuracion->save();

                //actualizamos la configuracion del cliente
                $update = clientes::find($id_cliente);
                $update->configuraciones = $configuracion->id;
                $update->save();
            }
            $consulta_mayor_cliente=clientes::where('id',$id_cliente)->get();
            if(count($request->productos)>=6 && $request->user()->id_zona != 2){
                $consulta_mayor_cliente[0]->configuraciones=2;
                $consulta_mayor_cliente[0]->save();
            }elseif(count($request->productos)>=12 && $request->user()->id_zona == 2){
                $consulta_mayor_cliente[0]->configuraciones=2;
                $consulta_mayor_cliente[0]->save();
            }
      /***************************************************************
          METODO PARA DESCONTAR DEL INVENTARIO DE LA TIENDA VIRTUAL STARA
          SOLO SI EL PRODUCTO SE VENDE EN STARA MEGACENTRO MEDELLIN
        /***************************************************************/
         if($tienda === 2){

        foreach($request->productos as $product){ 
       
            $full_codigo = explode("-",$product[1]);
            $codigo = $full_codigo[0];
           
            $product_virtual = json_decode(json_encode($this->woocommerce->get('products?sku='.$codigo)),true);
            
            if(!empty($product_virtual)){
            
            $variations_v = json_decode(json_encode($this->woocommerce->get('products/'.$product_virtual[0]['id'].'/variations')));
            
            if(!empty($variations_v)){
            
            foreach($variations_v as $variation){

               $variation = json_decode(json_encode($variation),true);

               $product = productos::where([['codigo','=',$variation['sku']],['id_tienda','=',2]])->select('codigo','cantidad')->first();
               
               if(isset($product->codigo)){
                   
                      $data = [
                                'stock_quantity' => $product->cantidad,
                                'manage_stock'   => true
                            ];
                            
                    $update = $this->woocommerce->put('products/'.$product_virtual[0]['id'].'/variations/'.$variation['id'], $data);
               }
            }
            }
             }
           } 
         }

        /***************************************************************
           FIN DEL METODO QUE DESCUENTA INVENTARIO TIENDA VIRTUAL
        /*****************************************************************/
            return Response()->json($numero_factura);

        } // fin ajax

    } //fin crear_facturas

    public function generar_factura(Request $request)
    {

        $tienda = $request->user()->tienda;
        $numero_factura = $request->factura;
        $documento = $request->documento;
        $asesor = $request->asesor;

        if ($request->ajax()) {
            $encabezado = tiendas::find($tienda);
            $contenido = facturas::where('n_factura', $numero_factura)->get();
            $tipo_factura = null;
            if ($contenido[0]['tipo_factura'] == 1) {
                $tipo_factura = 'DETAL';
            } elseif ($contenido[0]['tipo_factura'] == 2) {
                $tipo_factura = 'MAYOR';
            }
            $tipo_pago = null;
            if ($contenido[0]['tipo_compra'] == 1) {
                $tipo_pago = 'EFECTIVO';
            }
            if ($contenido[0]['tipo_compra'] == 2 || $contenido[0]['tipo_compra'] == 4) {
                $tipo_pago = 'TARJETA';
            }
            if ($contenido[0]['tipo_compra'] == 3) {
                $tipo_pago = 'MIXTO';
            }
            if ($contenido[0]['tipo_compra'] == 5) {
                $tipo_pago = 'DEVOLUCIÓN';
            }

            $datos_asesor = vendedores::find($asesor);
            $id_cliente = $contenido[0]['id_cliente'];
            $num_facturta = $contenido[0]['n_factura'];
            $fecha_factura = $contenido[0]['created_at'];
            $cliente = clientes::find($id_cliente);
            return response()->json(view('caja.parciale.factura', compact('encabezado', 'contenido', 'cliente', 'num_facturta', 'fecha_factura', 'datos_asesor', 'tipo_factura', 'tipo_pago'))->render());
        }
    }

    public function ver_facturas(Request $request)
    {
        $usuario = $request->user()->id;
        $tienda = $request->user()->tienda;
        $info_tienda = tiendas::find($tienda);
        $consulta=DB::table('facturas')
                    ->select('facturas.estado AS estado','facturas.id AS id_factura','facturas.n_factura AS Numero_Factura','clientes.nombres AS Nombre_Cliente',
                    'clientes.documento AS Cedula_Cliente','facturas.created_at AS Fecha',
                    DB::raw('DATE_FORMAT(facturas.created_at, "%H:%i:%s") AS hora'),DB::raw('SUM(facturas.total) total'))
                    ->join('clientes', 'facturas.id_cliente', '=', 'clientes.id')
                    ->where('facturas.id_tienda',$tienda)
                    ->groupBy('facturas.n_factura')
                    ->get();
        return view('caja.facturas', compact('consulta', 'info_tienda'));
    }

    public function factura_show(Request $request)
    {
        $tienda = $request->user()->tienda;
        $seleccion = $request->seleccion;
        $contenido = facturas::where('n_factura', $seleccion)->get();
        $contenido->each(function ($contenido) {
            $contenido->clientesfactura;
            $contenido->tiendafactura;
            $contenido->vendedoresfactura;
            $contenido->userfactura;
        });
        $num_facturta = $contenido[0]['n_factura'];
        $fecha_factura = $contenido[0]['created_at']->format('d/m/Y');
        $total_venta = null;

        //  dd(count($contenido));
        for ($i = 0; $i < count($contenido); $i++) {
            $total_venta = $total_venta + ($contenido[$i]['total']);
        }

        $subtotal = $total_venta / 1.19;
        $iva_venta = $total_venta - $subtotal;
        // dd($total_venta);
        if ($request->ajax()) {
            $encabezado = tiendas::find($tienda);

            return response()->json(view('caja.parciale.factura_recuperada', compact(
                'encabezado',
                'contenido',
                'num_facturta',
                'fecha_factura',
                'total_venta',
                'subtotal',
                'iva_venta'
            ))->render());
        }

    } // fin ver_factura

    /* devoluciones*/

    public function devoluciones_ver()
    {

        return view('caja.devoluciones');
    }

    public function buscar_factura(request $request)
    {
        $factura = $request->nFactura;

        if ($request->ajax()) {
            $consulta = facturas::where('n_factura', $factura)->get();
            //  dd($consulta[0]['id_cliente']);
            $id_cliente = $consulta[0]['id_cliente'];
            //  dd($id_cliente);
            $consulta_cliente = clientes::where('id', $id_cliente)->get();
            //  dd($consulta_cliente);
            return response()->json(view('devoluciones.parciales.lista', compact('consulta', 'consulta_cliente'))->render());
        }

    }

    public function anular_factura(Request $request)
    {
        $factura = $request->factura;
        $tienda = $request->user()->tienda;

        $datos = facturas::where('n_factura', $factura)->get();
        // dd($datos[0]['id']);
        for ($i = 0; $i < count($datos); $i++) {
            $id = $datos[$i]['id'];
            $datos1 = facturas::find($id);
            $datos1->estado = 1;
            $datos1->precio_base = 0;
            $datos1->precio_oferta = 0;
            $datos1->pago_tarjeta = 0;
            $datos1->pago_efectivo = 0;
            $datos1->pago_abono = 0;
            $datos1->total = 0;
            $datos1->save();

            $cantidad = $datos1->cantidad;
            $producto = $datos1->codigo;
            // dd($producto);

            $producto = productos::where('id_tienda', $tienda)
                ->where('codigo', $producto)->get();
            $id_producto = $producto[0]['id'];
            $actualizar = productos::find($id_producto);
            $actualizar->cantidad = ($actualizar->cantidad) + ($cantidad);
            $actualizar->cantidad_ventas = ($actualizar->cantidad_ventas) - ($cantidad);
            $actualizar->save();
        }

        $notificacion = User::find(7);
        // dd($notificacion);
        $notificacion->notify(new MensajeFacturaAnulada($datos));

    }

    /********* BUSCAR FACTURA MAYORISTA ******** */
    public function buscar_factura_mayorista(Request $request)
    {
        $codigo_factura = $request->codigo_factura;
        $datos = facturas::where('n_factura', $codigo_factura)
                            // ->where('facturacion','!=',3)
                            ->get();
        if (count($datos) != 0) {

            $respuesta = $datos[0]['tipo_factura'];
            $id_cliente = $datos[0]['id_cliente'];
            $clientes = clientes::find($id_cliente);
            return response([$respuesta, $id_cliente, $clientes]);
        } else {
            return response('null');
        }

    }

    public function facturas_informe(){
        return view('consultas_facturas_productos.facturas');
    }

    public function consulta_informa_facturas(Request $request){
        $fecha1=$request->fecha1;
        $fecha2=$request->fecha2;
        $consulta=DB::table('facturas')
                    ->select('facturas.n_factura AS numero_factura','facturas.titulo AS titulo_factura','facturas.codigo AS codigo_producto',DB::raw('RIGHT(facturas.codigo, 2) AS talla')
                        ,'facturas.precio_oferta AS precio_oferta','facturas.descuento AS descuento','facturas.cantidad AS cantidad_productos','facturas.pago_efectivo AS pago_efectivo','facturas.pago_tarjeta AS pago_tarjeta'
                        ,'facturas.total AS total_facturas','vendedores.nombres AS nombre_asesor','facturas.precio_costo AS precio_costo','categorias.categoria AS nombre_categoria','subcategorias.nombre_categoria AS nombre_subcategoria'
                        ,'facturas.created_at AS fecha_factura','tiendas.slug AS nombre_tienda','zonas.nombre as zona_tienda','vendedores.nombres AS nombre_vendedor','clientes.nombres AS nombre_cliente','clientes.telefono AS telefono_cliente'
                        ,'clientes.fecha_nacimiento AS fecha_nacimiento_cliente','clientes.correo AS correo_cliente')
                    ->join('tiendas', 'facturas.id_tienda', '=', 'tiendas.id')
                    ->join('categorias', 'facturas.id_categoria', '=', 'categorias.id')
                    ->join('subcategorias', 'facturas.id_subcategoria', '=', 'subcategorias.id')
                    ->join('zonas', 'tiendas.id_zona', '=', 'zonas.id')
                    ->join('clientes', 'facturas.id_cliente', '=', 'clientes.id')
                    ->join('users', 'facturas.id_vendedor', '=', 'users.id')
                    ->join('vendedores', 'facturas.id_asesor', '=', 'vendedores.id')
                    ->whereDate('facturas.created_at','>=',$fecha1)
                    ->whereDate('facturas.created_at','<=',$fecha2)     
                    ->get();

        // dd($consulta);
        // return view('consultas_facturas_productos.consulta_facturas', compact('consulta')->render());
        for ($i = 0; $i < count($consulta); $i++) {
        $consulta[$i]->fecha_factura=date('d-m-Y', strtotime($consulta[$i]->fecha_factura));
        $consulta[$i]->fecha_nacimiento_cliente=date('d-m-Y', strtotime($consulta[$i]->fecha_nacimiento_cliente));
        $consulta[$i]->fecha_factura = str_replace("-", '/', $consulta[$i]->fecha_factura);
        $consulta[$i]->fecha_nacimiento_cliente = str_replace("-", '/', $consulta[$i]->fecha_nacimiento_cliente);
        // dd($consulta[$i]->fecha_nacimiento_cliente);
        }
        
        return response()->json(view('consultas_facturas_productos.tablas.consulta_facturas', compact('consulta'))->render());
    }
}
