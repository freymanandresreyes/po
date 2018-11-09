<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class facturas extends Model
{
    public function clientesfactura()
    {
        return $this->belongsTo('App\clientes','id_cliente','id');
    }

    public function tiendafactura()
    {
        return $this->belongsTo('App\tiendas','id_tienda','id');
    }

    public function vendedoresfactura()
    {
        return $this->belongsTo('App\vendedores','id_asesor','id');
    }
    public function userfactura()
    {
        return $this->belongsTo('App\User','id_vendedor','id');
    }

    // public function tiendasfacturas()
    // {
    //     return $this->belongsTo('App\tiendas','id_tienda','id');
    // }
   

}
