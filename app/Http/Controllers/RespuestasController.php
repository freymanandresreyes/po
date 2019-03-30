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

class RespuestasController extends Controller
{
    public function guardar_encuesta(Request $request)
    {
        $user = $request->user()->id;
        $pregunta1 = $request->pregunta1;
        $pregunta2 = $request->pregunta2;
        $pregunta3 = $request->pregunta3;
        $respuesta1 = $request->respuesta1;
        $respuesta2 = $request->respuesta2;
        $respuesta3 = $request->respuesta3;
        $referencia1 = $request->referencia1;
        $referencia2 = $request->referencia2;
        $informe_tienda_select = $request->informe_tienda_select;
        $id_formulario = $request->id_formulario;

        $nueva_respuesta = new respuestas;
        $nueva_respuesta->id_formulario = $id_formulario;
        $nueva_respuesta->id_pregunta = $pregunta1;
        $nueva_respuesta->id_respuesta = $respuesta2;
        $nueva_respuesta->respuesta_abierta = $referencia1;
        $nueva_respuesta->id_tienda = $informe_tienda_select;
        $nueva_respuesta->id_usuario = $user;
        $nueva_respuesta->save();

        $nueva_respuesta = new respuestas;
        $nueva_respuesta->id_formulario = $id_formulario;
        $nueva_respuesta->id_pregunta = $pregunta2;
        $nueva_respuesta->id_respuesta = $respuesta1;
        $nueva_respuesta->respuesta_abierta = 'PREGUNTA SIN REFERENCIA';
        $nueva_respuesta->id_tienda = $informe_tienda_select;
        $nueva_respuesta->id_usuario = $user;
        $nueva_respuesta->save();

        $nueva_respuesta = new respuestas;
        $nueva_respuesta->id_formulario = $id_formulario;
        $nueva_respuesta->id_pregunta = $pregunta3;
        $nueva_respuesta->id_respuesta = $respuesta3;
        $nueva_respuesta->respuesta_abierta = $referencia2;
        $nueva_respuesta->id_tienda = $informe_tienda_select;
        $nueva_respuesta->id_usuario = $user;
        $nueva_respuesta->save();

        $consulta = preguntas::find($pregunta1);
        $consulta->Referencia=$referencia1;
        $consulta->save();

        $consulta = preguntas::find($pregunta3);
        $consulta->Referencia=$referencia2;
        $consulta->save();

        return response()->json('consulta');      
    }
}
