<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tiendas;
use App\User;
use App\controlcajas;
use App\configuraciones;
use App\grupos;

class TiendasController extends Controller
{
  public function crear_tienda(Request $request)
  {
    $zona = $request->user()->id_zona;
    if($zona == null || $zona== ""){
      return redirect('/')-> with('info','Usted no se encuentra asignado a ningun grupo de tiendas.');
    }else{
      $consulta=tiendas::where('id_zona', $zona)->get();
      $consulta_grupo=grupos::pluck('nombre_grupo','id');
      return view ('tienda.crear_tienda', compact('consulta','consulta_grupo'));
    }
    
  }

  // FUNCION PARA CREAR NUEVA TIENDA
  public function nueva_tienda(Request $request)
  {
     $zona = $request->user()->id_zona;
     
    //  dd($request->nombre_tienda);
      $nueva_tienda = new tiendas;
      $nueva_tienda->nombre_tienda = $request->nombre_tienda;
      $nueva_tienda->encargado=$request->encargado;
      $nueva_tienda->telefono=$request->telefono;
      $nueva_tienda->nit_tienda = $request->nit_tienda;
      $nueva_tienda->direccion_tienda = $request->direccion_tienda;
      $nueva_tienda->ciudad = $request->ciudad;
      $nueva_tienda->resolucion = $request->resolucion;
      $nueva_tienda->fecha_resolucion = $request->fecha_resolucion;
      $nueva_tienda->prefijo = $request->prefijo;
      $nueva_tienda->slug = $request->slug;
      $nueva_tienda->id_zona = $zona;
      $nueva_tienda->grupo = $request->grupo;
      $nueva_tienda->save();
      $id=$nueva_tienda->id;
      $nuevo_iva=new configuraciones;
      $nuevo_iva->iva=0;
      $nuevo_iva->tienda=$id;
      $nuevo_iva->save();
      return redirect()->route('crear_tienda');

  }


  // FUNCION PARA BUSCAR UNA TIENDA EN ESPECIFICO
  public function buscar_tienda(Request $request)
  {
    $id=$request->id;
    $consulta = tiendas::find($id);
    return response()->json($consulta);
  }


  // FUNCION PARA EDITAR UNA TIENDA
  public function tienda_editar(Request $request)
  {
    if ($request->ajax())
    {
      $id=$request->id;
      $tiendas = tiendas::find($id);
      $tiendas->nombre_tienda = $request->nombre_tienda;
      $tiendas->encargado=$request->encargado;
      $tiendas->telefono=$request->telefono;
      $tiendas->nit_tienda = $request->nit_tienda;
      $tiendas->direccion_tienda = $request->direccion_tienda;
      $tiendas->ciudad = $request->ciudad;
      $tiendas->resolucion = $request->resolucion;
      $tiendas->fecha_resolucion = $request->fecha_resolucion;
      $tiendas->prefijo = $request->prefijo;
      $tiendas->slug = $request->slug;
      $tiendas->save();
      // return redirect()-> route('crear_tienda');
      // $consulta= tiendas::all();
      $respuesta=1;
      return response()->json($respuesta);
    }
  }

  public function cambiar_tienda(Request $request)
  {
    //$zona = $request->user()->id_zona;
    //$consulta=tiendas::where('id_zona', $zona)->get();
    $consulta = tiendas::all();
    
    return response()->json(view('tienda.parciale.cambiar_tienda', compact('consulta'))->render());
    }


  public function cambiotienda(Request $request)
  {
    // $tienda_cambiar = $request->tienda;
    
    if($request->tienda==0)
    {
      return redirect('/');
    }
    // dd($tienda_cambiar);
    $tienda = $request->user()->tienda;
    $user = $request->user()->id;
    $tienda_cambiar = $request->tienda;
    $actualizar = User::find($user);
    $actualizar->tienda = $tienda_cambiar;
    $actualizar->caja = null;
    $actualizar->save();
    $actualizar_usuario_cajas=controlcajas::where('id_vendedor',$user)->get();
    if($actualizar_usuario_cajas!="[]")
    {
    $id=$actualizar_usuario_cajas[0]['id'];
    $actualizar_id=controlcajas::find($id);
    $actualizar_id->id_vendedor=null;
    $actualizar_id->save();
  }
    return redirect('/');
  }

  public function control_tiendas(Request $request)
  { 
    $zona = $request->user()->id_zona;
    $consultavendedores=User::where("id_zona", $zona)->get();
    $consultatiendas=tiendas::where("id_zona", $zona)->get();
    return view('control_tiendas.control_tiendas',compact('consultavendedores','consultatiendas'));
  }

  public function asignar_tienda(Request $request)
  {
    $id=$request->id;
    $locales=$request->locales;
    $consultauser=User::find($id);
    $user_tienda=$consultauser->tienda;
    if($user_tienda!=null)
    {
      $respuesta=1;
      return response()->json($respuesta);
    }
    else
    {
      $consultauser->tienda=$locales;
      $consultauser->save();
      $respuesta=0;
      return response()->json($respuesta);
    }
  }

  public function cargar_tienda_id(Request $request)
  {
    $id=$request->id;
    if($id==0 || $id==null  )
    {
      return response()->json(view('control_tiendas.parciale.vacio')->render());
    }
    $consultauser=User::find($id);
    $user_tienda=$consultauser->tienda;
    if($user_tienda==null )
    {
      return response()->json(view('control_tiendas.parciale.vacio')->render());
    }
    elseif($user_tienda!=null)
    {
      $user_tienda=tiendas::find($user_tienda);
      return response()->json(view('control_tiendas.parciale.listar_tienda', compact('user_tienda'))->render());
    }
  }

  public function quitar(Request $request)
  {
    $id=$request->id;
    $consultauser=User::find($id);
    $user_tienda=$consultauser->tienda;
    if($user_tienda!=null)
    {
      $consultauser->tienda=null;
      $consultauser->save();
      $respuesta=0;
      return response()->json($respuesta);
    }
  }

  public function enquetiendaestoy(Request $request)
  {

    $tienda = $request->user()->tienda;
    // dd($tienda);
    if($tienda==null || $tienda==0)
    {
      // $respuesta=0;
      return response()->json(view('tienda.parciale.tienda_actual')->render());
    }
    else{
      $tiendas = tiendas::find($tienda);
      // dd($tiendas);
      $nombretienda=$tiendas->slug;
      // dd($nombretienda);
      return response()->json(view('tienda.parciale.tiendactual', compact('nombretienda'))->render());
    }
  }

  public function buscar_tienda_zona(Request $request){

      return $tiendas = tiendas::where('id_zona', '=', $request->zona)->select('id','slug')->get(); 
  }
}
