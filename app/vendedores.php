<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vendedores extends Model
{
    public function facturasvendedores()
    {
        return $this->hasMany('App\facturas');
    }

    public function tiendavendedor()
    {
        return $this->belongsTo('App\tiendas','id_tienda','id');
    }

    public function siynovendedor()
    {
        return $this->belongsTo('App\siyno','estado','id');
    }
}
