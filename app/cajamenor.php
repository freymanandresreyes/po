<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\tiendas;
use App\User;
use App\entradamenor;
use App\salidamenor;

class cajamenor extends Model
{
    public function tiendas()
    {
        return $this->belongsTo('App\tiendas', 'tiendas_id', 'id');
    }

    public function salidamenor()
    {
        return $this->belongsTo('App\salidamenor', 'salida_id', 'id');
    }

    public function entradamenor()
    {
        return $this->belongsTo('App\entradamenor', 'entrada_id', 'id');
    }
}
