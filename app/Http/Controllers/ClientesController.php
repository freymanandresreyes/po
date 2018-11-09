<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\clientes;

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
}
