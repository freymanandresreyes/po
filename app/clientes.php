<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clientes extends Model
{
    protected $table = 'clientes';
    
    public function facturasCliente()
    {
        return $this->hasMany('App\facturas');
    }

    public function devolucionesclientes()
    {
        return $this->hasMany('App\devoluciones');
    }

    public function separadosclientes()
    {
        return $this->hasMany('App\separados');
    }

    public function confiusuariosClientes()
    {
        return $this->belongsTo('App\config_usuarios','configuraciones','id');
    }
}
