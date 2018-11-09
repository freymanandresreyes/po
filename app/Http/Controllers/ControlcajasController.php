<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\tiendas;
use App\User;
use App\cajamenor;
use App\entradamenor;
use App\salidamenor;
use App\consecutivos;
use App\controlcajas;

class ControlcajasController extends Controller
{
    public function control_cajas(Request $request)
    {
      $zona = $request->user()->id_zona;
        $tienda = $request->user()->tienda;
        $consultausuarios=User::where('id_zona',$zona)->get();
        $tiendas=tiendas::where('id_zona',$zona)->get();
        return view('control_cajas.control_cajas',compact('consultausuarios','tiendas'));
    }

    public function buscarcajas(Request $request)
    {
        $tienda = $request->user()->tienda;
        $consultausuarios = controlcajas::where('id_tienda',$tienda)->get();
        return response()->json(view('control_cajas.parciale.numero_cajas', compact('consultausuarios'))->render());
    }

    public function buscarcajarelacionada(Request $request)
    {
        $id=$request->id;
        $tienda = $request->user()->tienda;
        $consulta=controlcajas::where('id',$id)->where('id_tienda',$tienda)->get();
        $consulta=$consulta->id_vendedor;
        if($consulta != null)
        {
        $consulta=1;
        return response()->json($consulta);           
        }
    }

    public function nuevacaja(Request $request)
    {
        $conteo=0;
        $saldo=$request->saldo;
        $estado=$request->estado;
        $inicio=$request->inicio;
        $fin=$request->fin;
        $n_caja=$request->n_caja;
        $tienda = $request->user()->tienda;
        $conteocaja= controlcajas::where('id_tienda',$tienda)->get();
        // dd($tienda);
        // dd($conteocaja);
        if($tienda=="[]" || $tienda==null)
        {
          $respuesta=0;
          return response()->json($respuesta);
        }
        for ($i = 0; $i <= (count($conteocaja))-1; $i++) 
        {
          $conteo = $conteocaja[$i]['n_caja'];
        }
        $nueva_caja= new controlcajas;
        $nueva_caja->id_tienda=$tienda;
        $nueva_caja->n_caja=$conteo+$n_caja;
        $nueva_caja->saldo=$saldo;
        $nueva_caja->estado=$estado;
        $nueva_caja->hora_inicio=$inicio;
        $nueva_caja->hora_fin=$fin;
        $nueva_caja->save();
        $respuesta=1;
        return response()->json($respuesta);
    }

    public function asignar_caja_usuario(Request $request)
    {
      $usuario_r=$request->usuario;
      $cajas_r=$request->cajas;
      $usuario = User::find($usuario_r);
      $usuario_caja=$usuario->caja;
      $cajas = controlcajas::find($cajas_r);
      $cajas_usuario=$cajas->id_vendedor;
      
      if($usuario_caja == null && $cajas_usuario == null)
      {
        $usuario->caja=$cajas_r;
        $cajas->id_vendedor=$usuario_r;
        $usuario->save();
        $cajas->save();
        $respuesta=1;
        return response()->json($respuesta);
      }
      elseif($usuario_caja != null || $cajas_usuario != null)
      {
        $respuesta=0;
        return response()->json($respuesta);
      }
    }

    public function quitarcaja(Request $request)
    {
      $id=$request->id;
      if($id==0)
      {
        $respuesta="";
        return response()->json(view('control_cajas.parciale.vacio', compact('respuesta'))->render());
      }
      else
      {
      $usuario = User::find($id);
      $usuario_=$usuario->caja;
      $cajas = controlcajas::find($usuario_);
      if($usuario_ == null && $cajas == null)
      {
        $respuesta=0;
        return response()->json(view('control_cajas.parciale.vacio', compact('respuesta'))->render());
      }
      $cajas_=$cajas->id_vendedor;

      if($usuario_ != null || $cajas_ != null)
      {
        $respuesta_caja=controlcajas::find($usuario_);
        return response()->json(view('control_cajas.parciale.numero_cajas_quitar', compact('respuesta_caja'))->render());
      }    
    }  
    }


    public function eliminar_caja(Request $request)
    {
      $id=$request->id;
      $usuario = User::find($id);
      $usuario_=$usuario->caja;
      $cajas = controlcajas::find($usuario_);
      $cajas_=$cajas->id_vendedor;

      if($usuario_ != null || $cajas_ != null)
      {
        $usuario->caja=null;
        $cajas->id_vendedor=null;
        $usuario->save();
        $cajas->save();
        $respuesta=1;
        return response()->json($respuesta);
      }
    }


    public function buscar_tiendas_activar(Request $request)
    {
      $tienda_id=$request->tienda_id;
      $cajas=controlcajas::where('id_tienda',$tienda_id)->get();
      if($cajas=='[]'||$cajas==null||$cajas=="")
      {
        return response()->json(view('control_cajas.parciale.no_cajas')->render());
      }
      else
      {
        return response()->json(view('control_cajas.parciale.cajas_activar', compact('cajas'))->render());
      }
    }

    public function activar_desactivar_caja(Request $request)
    {
      $caja_id=$request->caja_id;
      $estado=$request->estado;
      $caja_estado=controlcajas::find($caja_id);
      $caja_estado->estado=$estado;
      $caja_estado->save();
      $respuesta=1;
      return response()->json($respuesta);
    }
}


