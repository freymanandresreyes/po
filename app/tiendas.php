<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tiendas extends Model
{
  public function cajamenor()
  {
      return $this->hasMany('App\cajamenor');
  }

  public function facturastienda()
  {
      return $this->hasMany('App\facturas');
  }

  public function remisionestienda()
  {
      return $this->hasMany('App\remisiones');
  }

  public function productosTienda()
  {
      return $this->hasMany('App\productos');
  }

  public function vendedortienda()
    {
        return $this->hasMany('App\vendedores');
    }
  public function tiendasUser()
    {
        return $this->hasMany('App\User');
    }
}
