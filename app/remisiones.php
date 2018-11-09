<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class remisiones extends Model
{
    public function tiendaremisionrecibe()
    {
        return $this->belongsTo('App\tiendas','tienda_recibe','id');
    }

    public function tiendaremisionenvia()
    {
        return $this->belongsTo('App\tiendas','tienda_envia','id');
    }
    
    public function remisionProveedor()
    {
        return $this->belongsTo('App\proveedores','id_proveedor','id');
    }
    public function remisionProducto()
    {
        return $this->belongsTo('App\productos','codigo_producto','id');
    }

}
