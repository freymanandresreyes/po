<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proveedores extends Model
{
    public function proveedorRemisiones()
    {
        return $this->hasMany('App\remisiones');
    }
}
