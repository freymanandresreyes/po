<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\bonos;
use DB;

class BonosController extends Controller
{
    public function registrar_bono(Request $request)
    {
        return view('bonos.registrar_bono');
    }

    public function registra_bono(Request $request){

    	$bono_cliente = bonos::where('cliente','=',$request->id_cliente)->first();//Consultar si el id de cliente ya se encuentra con un bono a su favor
    	if(empty($bono_cliente)){

    		$bono_consulta = bonos::where('codigo','=',$request->bono)->first();//Consultar si el codigo del bono ya esta asociado a otro cliente

    		if(!empty($bono_consulta)){ 

    		if(empty($bono_consulta->cliente)){//Registrar el bono al cliente 

    			$bono = bonos::where('codigo','=', $request->bono)->first();
    			$bono->cliente = $request->id_cliente;
    			$bono->id_tienda = $request->user()->tienda;
    			$bono->usuario = $request->user()->id;
    			$bono->estado = 1;
    			$bono->created_at = date('Y-m-d H:i:s');
    			$bono->save();

    			return ['estado' => 1];
    		}else{
    			return ['message' => 'El codigo que esta ingresando ya esta en uso!', 'estado' => 0];
    		}
    	}else{
    		return ['message' => 'El codigo que esta ingresando no existe!<br>Verifique el codigo porfavor.', 'estado' => 0];
    	}
    	}else{
    		return ['message' => 'El cliente ya tiene un bono registrado!', 'estado' => 0];
    	}

	}
	

	public function descuento_bono_cliente(Request $request){
		$consulta=DB::table('bonos')
        ->select('bonos.valor AS valor')
        ->where('bonos.cliente','=',$request->cliente)
		->get();
		if(count($consulta)==0)
		{
			$consulta[0]->valor=0;
			return response()->json($consulta[0]->valor);
		}else{
			return response()->json($consulta[0]->valor);
		}
	}

    
}
