<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class config_usuarios extends Model
{
   
    public function clientesConfiusuarios()
    {
        return $this->hasMany('App\clientes');
    }
}
