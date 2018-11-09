<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categorias extends Model
{
    
    public function productosCategoria()
    {
        return $this->hasMany('App\productos');
    }
}
