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

class CajamenorController extends Controller
{
  // FUNCION PARA ENVIAR DATOS A LA VISTA DE CAJAMENOR
  public function caja_menor(Request $request)
  {
    $conteo=0;
    $tienda = $request->user()->tienda;
    $consulta= cajamenor::where('tiendas_id',$tienda)->get();
    for ($i = 0; $i <= (count($consulta))-1; $i++) {
      $conteo = $consulta[$i]['base'];
    }
    $consulta_tienda= tiendas::find($tienda);
    return view('caja_menor.cajamenor',compact('conteo','consulta_tienda'));
  }

  // FUNCION PARA INSERTAR REGISTROS DE MOVIMIENTOS EN CAJAMENOR
  public function inser_caja_menor(Request $request)
  {
    $conteo=0;
    $conteoconsecutivo=0;
    $valor=$request->valor;
    $opcion=$request->opcion;
    $descripcion=$request->descripcion;
    $motivo=$request->motivo;
    $nombre=$request->nombre;
    $cedula=$request->cedula;
    $tienda_id=$request->user()->tienda;
    $user=$request->user()->id;
    $consultacaja= cajamenor::where('tiendas_id',$tienda_id)->get();
    for ($i = 0; $i <= (count($consultacaja))-1; $i++) {
      $conteo = $consultacaja[$i]['base'];
    }
    // $cajamenor="cajamenor";
    $consultaconsecutivo= consecutivos::where('tag','CAJA MENOR')->get();
    // dd($consultaconsecutivo);
    for ($i = 0; $i <= (count($consultaconsecutivo))-1; $i++) {
      $conteoconsecutivo = $consultaconsecutivo[$i]['consecutivo'];
    }
    // dd($conteoconsecutivo);

    if ($request->ajax())
    {

      // DINERO QUE SALE DE CAJA MENOR
      if($request->opcion == 1)
      {
        $crear_salida= new salidamenor;
        $crear_salida->salida=$valor;
        $crear_salida->recibe=$nombre;
        $crear_salida->cedula_recibe=$cedula;
        $crear_salida->motivo=$motivo;
        $crear_salida->tiendas_id=$tienda_id;
        $crear_salida->save();
        $id_salida=$crear_salida->id;

        if ($conteo != 0 ) {
          $base=$conteo-$valor;
          $crear_base= new cajamenor;
          $crear_base->base=$base;
          $crear_base->descripcion=$descripcion;
          $crear_base->salida_id=$id_salida;
          $crear_base->tiendas_id=$tienda_id;
          $crear_base->id_usuario=$user;
          $crear_base->numero_factura=$conteoconsecutivo+1;
          $crear_base->save();
          $id_base=$crear_base->id;
          $consecutivo= new consecutivos;
          $consecutivo->id_tienda=$tienda_id;
          $consecutivo->tag='CAJA MENOR';
          $consecutivo->consecutivo=$conteoconsecutivo+1;
          $consecutivo->save();
          $id_consecutivo=$consecutivo->id;
          $id_consecutivo=consecutivos::find($id_consecutivo);
          $id_base=cajamenor::find($id_base);
          $id_salida=salidamenor::find($id_salida);
          $tienda=tiendas::find($id_salida->tiendas_id);
          return response()->json(view('caja_menor.parciale.factura_caja_menor_salida', compact('id_base','id_salida','tienda','id_consecutivo'))->render());
        }
      }


      // DINERO QUE ENTRA A CAJA MENOR
      elseif($request->opcion == 0)
      {
        $crear_entrada= new entradamenor;
        $crear_entrada->entrada=$valor;
        $crear_entrada->entrega=$nombre;
        $crear_entrada->cedula_entrega=$cedula;
        $crear_entrada->motivo=$motivo;
        $crear_entrada->tiendas_id=$tienda_id;
        
        $crear_entrada->save();
        $id_entrada=$crear_entrada->id;
        if ($conteo == 0 ) {
          $crear_base= new cajamenor;
          $crear_base->base=$valor;
          $crear_base->descripcion=$descripcion;
          $crear_base->entrada_id=$id_entrada;
          $crear_base->tiendas_id=$tienda_id;
          $crear_base->numero_factura=$conteoconsecutivo+1;
          $crear_base->id_usuario=$user;
          $crear_base->save();
          $id_base=$crear_base->id;
          $consecutivo= new consecutivos;
          $consecutivo->id_tienda=$tienda_id;
          $consecutivo->tag='CAJA MENOR';
          $consecutivo->consecutivo=$conteoconsecutivo+1;
          $consecutivo->save();
          $id_consecutivo=$consecutivo->id;
          $id_consecutivo=consecutivos::find($id_consecutivo);
          $id_base=cajamenor::find($id_base);
          $id_entrada=entradamenor::find($id_entrada);
          $tienda=tiendas::find($id_entrada->tiendas_id);
          return response()->json(view('caja_menor.parciale.factura_caja_menor_entrada', compact('id_base','id_entrada','tienda','id_consecutivo'))->render());
        }
        elseif ($conteo != 0 ) {
          $base=$conteo+$valor;
          $crear_base= new cajamenor;
          $crear_base->base=$base;
          $crear_base->descripcion=$descripcion;
          $crear_base->entrada_id=$id_entrada;
          $crear_base->tiendas_id=$tienda_id;
          $crear_base->numero_factura=$conteoconsecutivo+1;
          $crear_base->id_usuario=$user;
          $crear_base->save();
          $id_base=$crear_base->id;
          $consecutivo= new consecutivos;
          $consecutivo->id_tienda=$tienda_id;
          $consecutivo->tag='CAJA MENOR';
          $consecutivo->consecutivo=$conteoconsecutivo+1;
          $consecutivo->save();
          $id_consecutivo=$consecutivo->id;
          $id_consecutivo=consecutivos::find($id_consecutivo);
          $id_base=cajamenor::find($id_base);
          $id_entrada=entradamenor::find($id_entrada);
          $tienda=tiendas::find($id_entrada->tiendas_id);
          return response()->json(view('caja_menor.parciale.factura_caja_menor_entrada', compact('id_base','id_entrada','tienda','id_consecutivo'))->render());
        }
      }
    }
  }

  public function ver_entradas()
  {
    $entradas=entradamenor::all();
    return view( 'caja_menor.entradas' ,compact('entradas'));
  }

  public function ver_salidas()
  {
    $salidas=salidamenor::all();
    return view( 'caja_menor.salidas' ,compact('salidas'));
  }

}
