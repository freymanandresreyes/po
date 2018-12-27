<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\clientes;
use App\bonos;
use DB;

class ClientesController extends Controller
{
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
