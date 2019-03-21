<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bonos;
use DB;
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

class ClientesController extends Controller
{


  public function index2(){
    return view('prueba.index2');
  }

  public function generar_index2(Request $request)
  {
    $desde=$request->fecha1_index2;
    $hasta=$request->fecha2_index2;
    $tiendas = DB::table('tiendas')
    ->select('id', 'slug')
    ->where('tiendas.id','!=','6')
    ->where('tiendas.id','!=','7')
    ->where('tiendas.id','!=','8')
    ->where('tiendas.id','!=','9')
    ->where('tiendas.id','!=','14')
    ->where('tiendas.id','!=','15')
    ->where('tiendas.id','!=','16')
    ->where('tiendas.id','!=','17')
    ->where('tiendas.id','!=','19')
    ->where('tiendas.id','!=','20')
    ->get();

    for ($i = 0; $i <= (count($tiendas)) - 1; $i++) {
      $var_id=$tiendas[$i]->id;
      $cant_vent_detal=DB::table('facturas')                   
      ->select('tiendas.slug','tiendas.id',DB::raw('SUM(facturas.precio_base * 1.19) total'),DB::raw('SUM(facturas.total) total_suma'))
      ->join('tiendas', 'facturas.id_tienda', '=', 'tiendas.id')
      ->where('facturas.id_tienda','=',$var_id)
      ->where('facturas.descuento','>','0')
      ->where('facturas.estado','!=','1')
      ->where('facturas.id_clasificaciones','!=','1')
      ->where('facturas.cantidad','!=','0')
      ->whereDate('facturas.created_at', '>=', $desde)
      ->whereDate('facturas.created_at','<=',$hasta)
      ->orderBy('tiendas.id')
      ->get();
      // dd($cant_vent_detal);
      $final[]=$cant_vent_detal;
      $cant_vent_detal='';
      // dd($final);
      if($final[$i][0]->total==null)
                                      
      $final[$i][0]->total=0;
      else
      
      if($final[$i][0]->total_suma==null)
      
      $final[$i][0]->total_suma=0;

      $final[$i][0]->total = $final[$i][0]->total - $final[$i][0]->total_suma;

    }
        return response()->json(view('clientes.informe_index2', compact(
          'final'
      ))->render());
  }

  // INFORME MAYOR DETAL 

  public function prueba2(){
    return view('prueba.index');
  }

  public function prueba(Request $request){

    // $desde='2018-11-27 00:00:00.0000';
    // $hasta='2018-11-27 23:59:00.0000';
    $desde=$request->fecha1_prueba;
    $hasta=$request->fecha2_prueba;

    $tiendas = DB::table('tiendas')
    ->select('id', 'slug')
    ->where('tiendas.id','!=','6')
    ->where('tiendas.id','!=','7')
    ->where('tiendas.id','!=','8')
    ->where('tiendas.id','!=','9')
    ->where('tiendas.id','!=','14')
    ->where('tiendas.id','!=','15')
    ->where('tiendas.id','!=','16')
    ->where('tiendas.id','!=','17')
    ->where('tiendas.id','!=','19')
    ->where('tiendas.id','!=','20')
    ->get();


    $final=[];
    $final2=[];
    for ($i = 0; $i <= (count($tiendas)) - 1; $i++) {
      // dd($tiendas[$i]->id);
      $var_id=$tiendas[$i]->id;
      $cant_vent_detal=DB::table('facturas')                   
      ->select('tiendas.slug','tiendas.id',DB::raw('SUM(facturas.cantidad) cant_detal'),DB::raw('SUM(facturas.total) total_detal'))
      ->join('tiendas', 'facturas.id_tienda', '=', 'tiendas.id')
      ->where('facturas.id_tienda','=',$var_id)
      ->where('facturas.tipo_factura','=','1')
      ->where('facturas.estado','!=','1')
      ->where('facturas.id_clasificaciones','!=','1')
      ->where('facturas.cantidad','!=','0')
      ->whereDate('facturas.created_at', '>=', $desde)
      ->whereDate('facturas.created_at','<=',$hasta)
      ->orderBy('tiendas.id')
      ->get();
      $final[]=$cant_vent_detal;
      $cant_vent_detal='';
      // dd($cant_vent_detal);
      $cant_vent_mayor=DB::table('facturas')                   
      ->select('tiendas.slug','tiendas.id',DB::raw('SUM(facturas.cantidad) cant_mayor'),DB::raw('SUM(facturas.total) total_mayor'))
      ->join('tiendas', 'facturas.id_tienda', '=', 'tiendas.id')
      ->where('facturas.id_tienda','=',$var_id)
      ->where('facturas.tipo_factura','=','2')
      ->where('facturas.estado','!=','1')
      ->where('facturas.id_clasificaciones','!=','1')
      ->where('facturas.cantidad','!=','0')
      ->whereDate('facturas.created_at', '>=', $desde)
      ->whereDate('facturas.created_at','<=',$hasta)
      ->orderBy('tiendas.id')
      ->get();
      $final2[]=$cant_vent_mayor;
      $cant_vent_mayor='';
    }
    // dd($final[0][0]->slug);
    // return view('clientes.prueba', compact('final','final2'));
    return response()->json(view('clientes.prueba', compact(
      'final',
      'final2'
  ))->render());
  }



  public function clienteConsultar(Request $request){
    $documento = $request->cedula;

    if($request->ajax()){

     $consulta = clientes::where('documento', $documento)->first();
    //  dd($consulta);
     if($consulta != NULL){
       $consulta->confiusuariosClientes;
        return Response()->json($consulta);
     }else{
      return Response()->json($consulta);
     }
      //return response()->json($consulta)->render();

    }

  }

  public function crearcliente(Request $request){

    if($request->ajax()){
     $nuevo = new clientes;
     $nuevo->nombres = $request->nombre;
     $nuevo->apellidos = $request->apellido;
     $nuevo->documento = $request->documento;
     $nuevo->direccion = $request->direccion;
     $nuevo->telefono = $request->telefono;
     $nuevo->fecha_nacimiento = $request->fecha;
     $nuevo->correo = $request->correo;
     $nuevo->save();
     
     $id_cliente = $nuevo->id;

     return Response()->json($id_cliente);
      //return response()->json($consulta)->render();

    }

  }

  public function consulta_cliente(Request $request){

    $data = clientes::where('documento','=',$request->documento)->select('id','nombres','apellidos','documento')->first();

    if(!empty($data)){
      
      $consulta_bono = bonos::where('cliente', '=',$data->id)->first();

      if(!empty($consulta_bono)){
        return ['info' => $data,'estado' => 0];
      }else{
         return ['info' => $data,'estado' => 1];
      }

    }else{
    return response()->json($data,200);
    }
  }


  public function crear_cliente(Request $request){

     $nuevo = new clientes;
     $nuevo->nombres = $request->nombre;
     $nuevo->apellidos = $request->apellido;
     $nuevo->documento = $request->documento;
     $nuevo->direccion = $request->direccion;
     $nuevo->telefono = $request->telefono;
     $nuevo->fecha_nacimiento = $request->fecha;
     $nuevo->correo = $request->correo;
     $nuevo->configuraciones = 1;
     $nuevo->save();
     
     return $nuevo->id;
      //return response()->json($consulta)->render()

  }


  public function clientes(Request $request){
    $consulta=DB::table('clientes')
        ->select('clientes.id AS id','clientes.nombres as nombres','clientes.apellidos as apellidos',
        'clientes.documento as documento','clientes.direccion as direccion','clientes.telefono as telefono',
        'clientes.fecha_nacimiento AS fecha_nacimiento','clientes.correo as correo','clientes.configuraciones as configuracion'
        ,'clientes.puntos as puntos_acumulados')
        ->groupBy('clientes.documento')
        ->get();
    // dd($consulta[0]);
    return view('clientes.clientes', compact('consulta'));
  }
}
