<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\tiendas;
use App\User;
use App\cajamenor;
use App\salidamenor;

class entradamenor extends Model
{
  public function cajamenor()
  {
      return $this->hasMany('App\cajamenor');
  }
}
