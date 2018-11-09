<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subcategorias extends Model
{
    public function productosSubcategoria()
    {
        return $this->hasMany('App\productos');
    }
}
