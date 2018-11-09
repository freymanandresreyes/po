<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\vendedores;
use App\tiendas;
use App\siyno;

class VendedoresController extends Controller
{
    public function vista_vendedores(){
        $consulta=vendedores::all();
        $consulta->each(function ($consulta) {
            $consulta->tiendavendedor;
        });
        $consulta_tiendas=tiendas::all();
        return view('vendedores.vendedores', compact('consulta','consulta_tiendas'));
    }

    public function guardar_vendedor(Request $request){
        $nombres = $request->nombres;
        $apellidos = $request->apellidos;
        $documento = $request->documento;
        $direccion = $request->direccion;
        $telefono = $request->telefono;
        $fecha_nacimiento = $request->fecha_nacimiento;
        $correo = $request->correo;
        $tienda = $request->tienda;        
        $estado = $request->estado;

        //Insercion de un nuevo vendedor
        $guardar_vendedor=new vendedores;
        $guardar_vendedor->nombres=$nombres;
        $guardar_vendedor->apellidos=$apellidos;
        $guardar_vendedor->documento=$documento;
        $guardar_vendedor->direccion=$direccion;
        $guardar_vendedor->telefono=$telefono;
        $guardar_vendedor->fecha_nacimiento=$fecha_nacimiento;
        $guardar_vendedor->correo=$correo;
        $guardar_vendedor->id_tienda=$tienda;
        $guardar_vendedor->estado=$estado; 
        $guardar_vendedor->save();
        $respuesta=1;
        return response()->json($respuesta);
    }

    public function buscar_editar_vendedor(Request $request){
        $id_vendedor = $request->id_vendedor;
        $consulta_vendedor=vendedores::where('id',$id_vendedor)->get();
        $consulta_vendedor->each(function ($consulta_vendedor) {
            $consulta_vendedor->tiendavendedor;
            $consulta_vendedor->siynovendedor;
        });
        return response()->json($consulta_vendedor);
    }

    public function guardar_editar_vendedor(Request $request){
        $id = $request->id;        
        $nombres = $request->nombres;
        $apellidos = $request->apellidos;
        $documento = $request->documento;
        $direccion = $request->direccion;
        $telefono = $request->telefono;
        $fecha_nacimiento = $request->fecha_nacimiento;
        $correo = $request->correo;
        $tienda = $request->tienda;
        $consulta_vendedor_editar=vendedores::find($id);
        $consulta_vendedor_editar->nombres=$nombres;
        $consulta_vendedor_editar->apellidos=$apellidos;
        $consulta_vendedor_editar->documento=$documento;
        $consulta_vendedor_editar->direccion=$direccion;
        $consulta_vendedor_editar->telefono=$telefono;
        $consulta_vendedor_editar->fecha_nacimiento=$fecha_nacimiento; 
        $consulta_vendedor_editar->correo=$correo;
        $consulta_vendedor_editar->id_tienda=$tienda;      
        $consulta_vendedor_editar->save();
        $respuesta=1;
        return response()->json($respuesta);
    }

    public function estado_vendedor(Request $request){
        $id = $request->id_vendedor;
        $consulta_vendedor_estado=vendedores::find($id);
        if($consulta_vendedor_estado->estado==1)
        {
        $consulta_vendedor_estado->estado=2;
        $consulta_vendedor_estado->save();
        }
        else{
        $consulta_vendedor_estado->estado=1;
        $consulta_vendedor_estado->save();
        }
        $respuesta=1;
        return response()->json($respuesta);
    }
}
