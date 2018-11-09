<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class siyno extends Model
{
    protected $table = 'siyno';
    public function vendedorsiyno()
    {
        return $this->hasMany('App\vendedores');
    }

    public function productossiyno()
    {
        return $this->hasMany('App\productos');
    }
}