<?php 

namespace App\Traits;

use App\controlcajas;

trait ControlCaja
{
    public function aperturaCajas($caja)
    {
        // dd($caja);
   //lavariable $t hace referencia a la tienda 
   //la variable $c hace referencia a la caja
   
    $hora_serve = date("H:i:s");
    $consulta_caja = controlcajas::find($caja);
    // dd($consulta_caja);
    $hora_inicio = $consulta_caja->hora_inicio;
    $hora_fin = $consulta_caja->hora_fin;
    //el estado 0 es activo
    //el estado 1 es inactivo
    // dd($consulta_caja->estado);
    if($consulta_caja->estado == 0 ){
     if($hora_serve >= $hora_inicio && $hora_serve <= $hora_fin){  
      return true;
      }
    }else{
      return false;
    }
   }


}