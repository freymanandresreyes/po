<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class compras extends Model
{
    public function proveedorescompras()
    {
        return $this->belongsTo('App\proveedores','id_proveedor','id');
    }

    public function productoscompras()
    {
        return $this->belongsTo('App\productos','id_producto','id');
    }

    public function tiendascompras()
    {
        return $this->belongsTo('App\tiendas','id_tienda','id');
    }
}
