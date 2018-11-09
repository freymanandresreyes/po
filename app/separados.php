<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class separados extends Model
{
    public function productosSeparados(){

      return $this->belongsTo('App\productos','id_producto','id');
  }


  public function codigoproducto()
  {
      return $this->belongsTo('App\productos','id_producto','id');
  }

  public function clienteseparados()
  {
      return $this->belongsTo('App\clientes','id_cliente','id');
  }
}
