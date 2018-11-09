<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class devoluciones extends Model
{
    public function clientesdevolucines()
    {
        return $this->belongsTo('App\clientes','id_cliente','id');
    }
}
