<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\tiendas;
use App\User;
use App\preguntas;
use App\preguntas_opciones;
use App\respuestas;
use App\formularios;
use App\form_preguntas;
use App\opciones;
use DB;

class FormulariosController extends Controller
{
    public function traer_encuesta (Request $request){
        
        $userTienda = $request->informe_tienda_select;
        $fecha_inicio = $request->fecha_inicio;
        $fecha_fin = $request->fecha_fin;

        $consulta=DB::table('form_preguntas')
        ->select('preguntas_opciones.pregunta AS id_pregunta', 'opciones.id AS id_opcion' ,'opciones.opciones AS opciones','form_preguntas.id_formulario AS id_formulario')
        ->join('preguntas_opciones', 'form_preguntas.pregunta_opcion', '=', 'preguntas_opciones.id')
        ->join('preguntas', 'preguntas.id', '=', 'preguntas_opciones.pregunta')
        ->join('opciones', 'opciones.id', '=', 'preguntas_opciones.opcion')
        ->join('formularios', 'form_preguntas.id_formulario', '=', 'formularios.id')
        ->where('formularios.activo', '=', 1 )
        // ->groupby('preguntas.pregunta')
        ->get();

        $consulta2=DB::table('form_preguntas')
        ->select('preguntas_opciones.pregunta AS id_pregunta','preguntas.pregunta AS pregunta')
        ->join('preguntas_opciones', 'form_preguntas.pregunta_opcion', '=', 'preguntas_opciones.id')
        ->join('preguntas', 'preguntas.id', '=', 'preguntas_opciones.pregunta')
        ->join('opciones', 'opciones.id', '=', 'preguntas_opciones.opcion')
        ->join('formularios', 'form_preguntas.id_formulario', '=', 'formularios.id')
        ->where('formularios.activo', '=', 1 )
        ->groupby('preguntas.pregunta')
        ->get();
        
        // dd($consulta2);
        // $id=[];
        // $opciones=[];
        // for ($i = 0 ; $i< count($consulta); $i++){
        //     $id[]=$consulta[$i]->id_pregunta;
        // }

        // dd($id);

        $consulta_producto_aleatorio=DB::table('facturas')
        ->select('facturas.codigo AS codigo')
        ->where('facturas.id_tienda','=',$userTienda)
        ->where('facturas.codigo','!=','0')
        ->whereDate('facturas.created_at', '>=', $fecha_inicio)->whereDate('facturas.created_at','<=',$fecha_fin)
        ->inRandomOrder()
        ->limit(2)
        ->get();

        // dd($consulta_producto_aleatorio[1]);

        return response()->json(view('informes.parciales.encuesta_cargada', compact('consulta','consulta2','consulta_producto_aleatorio'))->render());
    }
}
