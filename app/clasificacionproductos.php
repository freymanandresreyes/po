<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clasificacionproductos extends Model
{
     public function productosclasificaion()
    {
        return $this->hasMany('App\productos');
    }
}
