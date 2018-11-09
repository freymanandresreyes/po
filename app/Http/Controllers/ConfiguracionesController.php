<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\tiendas;
use App\configuraciones;
use Mockery\Undefined;
use App\consecutivos;

class ConfiguracionesController extends Controller
{
    public function configuraciones(Request $request)
    {   
        
        $id = $request->user()->tienda;
        if($id==null)
        {
            return redirect('/')-> with('info','Usted debe estar dentro de una tienda para poder ingresar a las configuraciones.');
        }
        else{
        if($id){
        $conteo=0;
        $id = $request->user()->tienda;
        
        $consulta_tienda=tiendas::find($id);
        $consulta_iva=configuraciones::where('tienda',$id)->get();
        for ($i = 0; $i <= (count($consulta_iva))-1; $i++) {
            $conteo = $consulta_iva[$i]['id'];
          }

        $configuraciones = configuraciones::where('tienda', $id)->take(1)->get();
        // $config=($configuraciones[0]['id']);
        // dd($configuraciones);
        if($configuraciones == '[]' || $configuraciones[0]['lista_tag']=="" )
        {
            $list_tag=0;
        }
        else
        {
            $list_tag = json_decode($configuraciones[0]['lista_tag']);

        }
      
        $consulta_iva=configuraciones::find($conteo);
        return view('configuraciones.configuraciones', compact('consulta_tienda','consulta_iva','list_tag'));
    }else{
        return redirect('/')-> with('info','Usted debe estar dentro de una tienda para poder ingresar a las configuraciones.');
    }
    }
    }

    public function buscar_iva(Request $request)
    {
        $conteo=0;
        $id=$request->id;
        $iva=$request->iva;
        $consulta_iva=configuraciones::where('tienda',$id)->get();
        for ($i = 0; $i <= (count($consulta_iva))-1; $i++) {
            $conteo = $consulta_iva[$i]['id'];
          }
        $consulta_iva=configuraciones::find($conteo);
        $consulta_iva->iva=$iva;
        $consulta_iva->save();
        $respuesta=1;
        return response()->json($respuesta);
    }

    public function crear_tag(Request $request)
    {
        $tienda = $request->user()->tienda;
        // dd($tienda);
        $tags=configuraciones::where('tienda',$tienda)->take(1)->get();
        // dd($tags);
        if($tags != '[]'){
            $id=$tags[0]['id'];
            $consulta_tag=configuraciones::find($id);

            $tag_bd=$consulta_tag->lista_tag;
            // dd($tag_bd);
            if($tag_bd=="")
            {
            $tag_request = $request->objeto;
            $comparador_tag = $tag_request[0]['nuevo_tag'];
            $consulta_tag->lista_tag = json_encode($tag_request);
            $consulta_tag->save();
            $respuesta = 0;
            return response()->json($respuesta);
            }
            else
            {
            $tag=json_decode($tag_bd);
            $tag_request=$request->objeto;
            $comparador_tag=$tag_request[0]['nuevo_tag'];
                // dd($tag);
            for ($i=0;$i<count($tag);$i++)
            {
                if($tag[$i]->nuevo_tag==$comparador_tag)
                {
                    $respuesta=1;
                    return response()->json($respuesta);
                }
            }
            $array=array_merge($tag_request,$tag);
            $consulta_tag->lista_tag=json_encode($array);
            $consulta_tag->save();
            $respuesta=0;
            return response()->json($respuesta);
            }
            
        }else{
            if($tag_bd=="")
            {
            $tag_request = $request->objeto;
            // $comparador_tag = $tag_request[0]['nuevo_tag'];
            $consulta_tag->lista_tag = json_encode($tag_request);
            $consulta_tag->save();
            $respuesta = 0;
            return response()->json($respuesta);
            }

        }
       
    }

    // FUNCION PARA RENDERIZAR EL INPUT DE VER UN TAG Y PODERLO EDITAR
    public function mostrar_tag(Request $request)
    {
        $editar_tag=$request->editar_tag;
        return response()->json(view('configuraciones.parciale.editar_tag', compact('editar_tag'))->render());
    }

    // FUNCION PARA EDITAR EL TAG SELECCIONADO POR EL REQUEST LLEGAN DOS VARIABLES CAPTURADAS
    public function editar_tag(Request $request)
    {
        $tag_request=$request->tag;
        $tag_id = $request->tag_id;
        $tienda = $request->user()->tienda;
        $tags=configuraciones::where('tienda',$tienda)->take(1)->get();
        $id=$tags[0]['id'];
        $consulta_tag=configuraciones::find($id);
        $tag_bd=$consulta_tag->lista_tag;
        $tag=json_decode($tag_bd);
        for ($i=0;$i<count($tag);$i++)
        {

            if($tag[$i]->nuevo_tag == $tag_request)
            {
                $respuesta=1;
                return response()->json($respuesta);

            }

            if($tag[$i]->nuevo_tag== $tag_id)
            {
                $tag[$i]->nuevo_tag=$tag_request;
                $tag_listo=json_encode($tag);
                $cons = configuraciones::find($id);
                $tag_bd = $cons->lista_tag;
                $cons->lista_tag = $tag_listo;
                $cons->save();
                $respuesta=0;
                return response()->json($respuesta);
            }
        }
    }

    public function traerconsecutivo(Request $request)
    {
        $tag_selecionado=$request->tag_selecionado;
        // dd($tag_selecionado);
        $consecutivos=consecutivos::where('tag',$tag_selecionado)->get();
        
        if($consecutivos=="[]")
        {
            $respuesta=1;
            return response()->json($respuesta);
        }
        if($consecutivos!="[]")
        {   
        $conteo=0;
        for ($i=0;$i<count($consecutivos);$i++)
        {
            if($conteo<$consecutivos[$i]['consecutivo'])
            {
            $conteo=$consecutivos[$i]['consecutivo'];
            }
        }
            return response()->json(view('configuraciones.parciale.enviar', compact('conteo'))->render());
        }        
    }

    public function iniciarconsecutivo(Request $request)
    {
        // dd("hola");
        $tag_selecionado=$request->tag_selecionado;
        $id_tienda = $request->user()->tienda;
        $iniciar_consecutivo=new consecutivos;
        $iniciar_consecutivo->id_tienda=$id_tienda;
        $iniciar_consecutivo->tag=$tag_selecionado;
        $iniciar_consecutivo->consecutivo=0;
        $iniciar_consecutivo->save();
        $respuesta=0;
        return response()->json($respuesta);

    }

    public function editar_consecutivo(Request $request)
    {
        $tag_selecionado=$request->tag_selecionado;
        $consecutivo=$request->consecutivo;
        $consecutivo_editar=consecutivos::where('tag',$tag_selecionado)->get();
        // dd($consecutivo_editar);
        $conteo=0;
        for ($i=0;$i<count($consecutivo_editar);$i++)
        {
            if($conteo<=$consecutivo_editar[$i]['consecutivo'])
            {
            $conteo=$consecutivo_editar[$i]['id'];
            }
        }
        // dd($conteo);
        $consulta_consecutivo=consecutivos::find($conteo);
        // dd($consulta_consecutivo->consecutivo);
        $consulta_consecutivo->consecutivo=$consecutivo;
        $consulta_consecutivo->save();
        $respuesta=1;
        return response()->json($respuesta);
        
        // dd($tag_selecionado);
    }

}