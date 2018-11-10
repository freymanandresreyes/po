<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puntos extends Model
{
    protected $table = 'cliente_puntos';

    protected $fillable = ['id_cliente','n_factura','puntos'];
}
